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
        $this->load->model('SuratMasukModel');
        $this->load->model('PegawaiModel');
        $this->load->model('CutiModel');
        $this->load->model('VerifikasiSuratModel');
        $this->load->model('DisposisiSuratModel');
        $this->load->model('SifatModel');
    }

    public function index()
    {
        $data['judul'] = "Surat Masuk";
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $data['suratmasuk'] = $this->SuratMasukModel->getAllSurat();
        $this->load->view('admin/suratmasuk', $data);
        $this->load->view('admin/_partials/footer');
    }
    public function verifikasisurat($id)
    {
        $data['judul'] = "Verifikasi Surat";
        $this->form_validation->set_rules('verifikasi_surat', 'Verifikasi Surat', 'required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required');
         if($this->session->userdata('nama_jabatan')!="Direktur"){
            $this->form_validation->set_rules('nik_pj', 'NIK', '');
         }else{
            $this->form_validation->set_rules('nik_pj[]', 'NIK', '');
         }
        if ($this->form_validation->run() == false) {
            //$this->SuratModel->VerifikasiSurat($id);
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $data['suratmasuk'] = $this->SuratMasukModel->getVerifikasiSuratById($id);
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
            if($this->session->userdata('nama_jabatan')!="Direktur"){
                $this->VerifikasiSuratModel->tambahVerifikasiSurat($id);
            }else{
                $this->SuratMasukModel->UpdateStatusSuratDisposisi($id);
                $this->DisposisiSuratModel->tambahDisposisiSurat($id,$image_name);
            }
            }elseif($this->input->post("verifikasi_surat")=="Ditolak"){
                $this->VerifikasiSuratModel->UpdateVerifikasiSuratDitolak($id);
            }
            $this->session->set_flashdata('sukses', 'Data Berhasil Diverifikasi');
            redirect('suratmasuk');
        }
    }
    public function disposisisurat($id)
    {
        $data['judul'] = "Disposisi Surat";
        //$this->form_validation->set_rules('verifikasi_surat', 'Verifikasi Surat', 'required');
        $this->form_validation->set_rules('catatan', 'Catatan', 'required');
        $this->form_validation->set_rules('nik_pj[]', 'NIK', '');
        if ($this->form_validation->run() == false) {
            //$this->SuratModel->VerifikasiSurat($id);
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $data['suratmasuk'] = $this->SuratMasukModel->getDisposisiSuratById($id);
            $data['disposisisurat'] = $this->DisposisiSuratModel->getAllDisposisi($id);
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/disposisisurat', $data);
            $this->load->view('admin/_partials/footer');
        }else{
           
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
            $this->DisposisiSuratModel->UpdateDisposisiSurat($id,$image_name);
            $this->DisposisiSuratModel->tambahDisposisiSurat($id,$image_name);
            $this->session->set_flashdata('sukses', 'Data Berhasil Diverifikasi');
            redirect('suratmasuk');
        }
    }
    public function detailsuratmasuk($id){
            $data['judul'] = "Detail Surat";
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $suratmasuk=$this->db->get_where('surat',['kode_surat'=>$id])->row_array();
            $data['verifikasisurat'] = $this->VerifikasiSuratModel->getAllVerifikasi($id);
            if($suratmasuk["status"]=="Disposisi"){
                $data['suratmasuk'] = $this->SuratMasukModel->getVerifikasiSuratByKdSurat($id);
            }else{
                $data['suratmasuk'] = $this->SuratMasukModel->getVerifikasiSuratById($id);
            }
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/detailsuratmasuk', $data);
            $this->load->view('admin/_partials/footer');
    }
    
    public function cetakdisposisi($id){
        $data['sifat'] = $this->SifatModel->getAllSifat();
        $data['cetakdisposisi']=$this->DisposisiSuratModel->cetakDisposisi($id);
        $this->load->view('admin/cetakdisposisi', $data);
    }
}
