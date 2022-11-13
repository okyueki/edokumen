<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuratMasuk extends CI_Controller
{
     function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('nik')){
             $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Anda Belum Login!
          </div>');
            redirect(base_url("auth"));
        }
        //$this->load->library('form_validation');
        $this->db=$this->load->database('default', TRUE);
        $this->db2=$this->load->database('serverkhanza', TRUE);
        $this->load->model('SuratModel');
        $this->load->model('PegawaiModel');
        $this->load->model('CutiModel');
        $this->load->model('VerifikasiSuratModel');
        $this->load->model('DisposisiSuratModel');
        $this->load->model('SifatModel');
    }

    public function index()
    {
        $data['judul'] = "Surat Masuk";
        $data['suratmasuk'] = $this->SuratModel->getSuratMasuk();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/suratmasuk', $data);
        $this->load->view('admin/_partials/footer');
    }
    public function verifikasisurat($id)
    {
        $data['judul'] = "Verifikasi Surat";
        $this->form_validation->set_rules('verifikasi_surat', 'Verifikasi Surat', 'required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required');
        $this->form_validation->set_rules('nik_disposisi[]', 'NIK', '');
        if ($this->form_validation->run() == false) {
            //$this->SuratModel->VerifikasiSurat($id);
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $data['suratmasuk'] = $this->SuratModel->getVerifikasiSuratById($id);
            $data['verifikasisurat'] = $this->VerifikasiSuratModel->getAllVerifikasi($id);
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/verifikasisurat', $data);
            $this->load->view('admin/_partials/footer');
        }else{
            if($this->input->post("verifikasi_surat")=="Disetujui"){
            $this->load->library('ciqrcode'); //pemanggilan library QR CODE
    
            $config['cacheable']    = true; //boolean, the default is true
            $config['cachedir']     = './assets/'; //string, the default is application/cache/
            $config['errorlog']     = './assets/'; //string, the default is application/logs/
            $config['imagedir']     = './assets/qrcode/'; //direktori penyimpanan qr code
            $config['quality']      = true; //boolean, the default is true
            $config['size']         = '1024'; //interger, the default is 1024
            $config['black']        = array(224,255,255); // array, default is array(255,255,255)
            $config['white']        = array(70,130,180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);
    
            $image_name=$this->session->userdata('nik')."_".$id.'.png'; //buat name dari qr code sesuai dengan nim
    
            $params['data'] = "Dikeluarkan Oleh RS. Aisyiyah Siti Fatimah Tulangan, Kabupaten/Kota Sidoarjo Ditanda Tangani Secara Elektronik Oleh ".$this->session->userdata('nama')." ID ".$id; //data yang akan di jadikan QR CODE
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
            $this->VerifikasiSuratModel->UpdateVerifikasiSurat($id,$image_name);
            $this->CutiModel->VerifikasiSurat($id);
            $kode_surat=substr($id,0,2);
            if($kode_surat == "SF"){
                $this->SuratModel->UpdateStatusSelesai($id);
            }
            }else{
                $this->CutiModel->VerifikasiSurat($id);
                $this->VerifikasiSuratModel->UpdateVerifikasiSuratDitolak($id);
            }

            $unitx=$this->db->get_where('unit', ['id_unit' =>  $this->session->userdata('id_unit')])->row_array();
            if($unitx['nama_unit']=="Direktur"){
                $disposisix=$this->db->like('nik_disposisi_dari', $this->session->userdata('nik'))->get_where('disposisi', ['kode_surat' => $id])->row_array();
                if(empty($disposisix)){
                    $this->DisposisiSuratModel->tambahDisposisiSurat($id,$image_name);
                    //$this->SuratModel->UpdateStatusSelesai($id);
                }else{
                    $this->DisposisiSuratModel->updateDisposisiSurat($id,$image_name);
                    //$this->SuratModel->UpdateStatusSelesai($id);
                }
                $this->SuratModel->UpdateStatusDisposisi($id);
            }
            
            $this->session->set_flashdata('sukses', 'Data Berhasil Diverifikasi');
            redirect('suratmasuk');
        }
    }
    public function detailsuratmasuk($id){
            $data['judul'] = "Detail Surat";
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $data['suratmasuk'] = $this->SuratModel->getVerifikasiSuratById($id);
            $data['verifikasisurat'] = $this->VerifikasiSuratModel->getAllVerifikasi($id);
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/detailsuratmasuk', $data);
            $this->load->view('admin/_partials/footer');
    }
    public function cetakdisposisi($id){
        $data['sifat'] = $this->SifatModel->getAllSifat();
        $data['cetakdisposisi']=$this->SuratModel->cetakDisposisi($id);
        $this->load->view('admin/cetakdisposisi', $data);
    }
}
