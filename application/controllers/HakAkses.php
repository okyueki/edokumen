<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HakAkses extends CI_Controller
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
        $this->load->model('HakAksesModel');
        $this->load->model('PegawaiModel');
    }

    public function index()
    {
        $data['judul'] = "Hak Akses";
        $data['hakakses'] = $this->HakAksesModel->getAllHakAkses();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/hakakses', $data);
        $this->load->view('admin/_partials/footer');
    }
     public function tambahhakakses()
    {
        $data['judul'] = "Tambah Hak Akses";
        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('hak_akses', 'Hak Akses', 'required');

        if ($this->form_validation->run() == false) {
            $data['hakakses'] = $this->HakAksesModel->getAllHakAkses();
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/tambahhakakses',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $this->HakAksesModel->tambahHakAkses();
            $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
            redirect('hakakses');
        }
    }
    public function ubahhakakses($id)
    {
        $data['judul'] = "Ubah Lemari";
        $data['hakakses'] = $this->HakAksesModel->getHakAksesById($id);

        $this->form_validation->set_rules('nik', 'NIK', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('hak_akses', 'Hak Akses', 'required');

        if ($this->form_validation->run() == false) {
            //$data['lemari'] = $this->LemariModel->getAllLemari();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahhakakses', $data);
           $this->load->view('admin/_partials/footer');
        } else {
            //echo "Berhasil";
            $this->HakAksesModel->ubahHakAkses($id);
            $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
            redirect('hakakses');
        }
    }
    public function hapushakakses($id)
    {
        $this->HakAksesModel->hapusHakAkses($id);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect('hakakses');
    }
}
