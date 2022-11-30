<?php
defined('BASEPATH') or exit('No direct script access allowed');

class eCuti extends CI_Controller
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
        $this->load->model('CutiModel');
        $this->load->model('PegawaiModel');
        $this->load->model('JenisCutiModel');
        //$this->load->model('SuratModel');
        $this->load->model('VerifikasiSuratModel');
    }

    public function index()
    {
        $data['judul'] = "Cuti";
        $data['cuti'] = $this->CutiModel->getAllCuti();
        $data['totalcutix'] = $this->CutiModel->getGroupByTotalCutiAll();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/cuti', $data);
        $this->load->view('admin/_partials/footer');
    }
     public function tambahcuti()
    {
        $data['judul'] = "Tambah Cuti";
        $this->form_validation->set_rules('jenis_cuti', 'Jenis Cuti', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kepentingan', 'Kepentingan', 'required');
        $this->form_validation->set_rules('cuti_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('cuti_berakhir', 'Tanggal Akhir', 'required');
        $this->form_validation->set_rules('jumlah_hari', 'Jumlah', '');
        $this->form_validation->set_rules('nik_pj', 'NIK Koordinator', 'required');

        if ($this->form_validation->run() == false) {
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $data['cuti'] = $this->CutiModel->getAllCuti();
            $data['jeniscuti'] = $this->JenisCutiModel->getAllJenisCuti();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/tambahcuti',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $this->CutiModel->tambahCuti();
            //$this->SuratModel->tambahSurat($kategori='cuti');
            $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
            redirect('ecuti');
        }
    }
    public function ubahcuti($id)
    {
        $data['judul'] = "Ubah Cuti";
        $data['cuti'] = $this->CutiModel->getCutiById($id,$kategori="cuti");

        $this->form_validation->set_rules('jenis_cuti', 'Jenis Cuti', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kepentingan', 'Kepentingan', 'required');
        $this->form_validation->set_rules('cuti_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('cuti_berakhir', 'Tanggal Akhir', 'required');
        $this->form_validation->set_rules('jumlah_hari', 'Jumlah', '');
        $this->form_validation->set_rules('nik_pj', 'NIK Koordinator', 'required');

        if ($this->form_validation->run() == false) {
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $data['jeniscuti'] = $this->JenisCutiModel->getAllJenisCuti();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahcuti', $data);
           $this->load->view('admin/_partials/footer');
        } else {
            //echo "Berhasil";
            $this->CutiModel->ubahCuti($id);
            //$this->SuratModel->ubahSurat($id, $kategori="cuti");
            $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
            redirect('ecuti');
        }
    }
    public function hapuscuti($id){
        $this->VerifikasiSuratModel->hapusVerifikasiSurat($id);
        $this->CutiModel->hapusCuti($id);
        //$this->SuratModel->hapusSurat($id,$kategori);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect('ecuti');
    }
    public function cetakcuti($id)
    {  
        $this->load->helper('tgl_indo_helper');
        $data['judul'] = "Cetak Cuti";
        $data['totalcutix'] = $this->CutiModel->getGroupByTotalCuti($id);
        $data['cuti']=$this->CutiModel->getCetakCutiById($id);
        $this->load->view('admin/cetakcuti', $data);
    }
}
