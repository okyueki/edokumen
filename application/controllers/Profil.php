<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
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
        $this->load->library('form_validation');
        $this->db=$this->load->database('default', TRUE);
        $this->db2=$this->load->database('serverkhanza', TRUE);
        //$this->load->model('PegawaiModel');
        $this->load->model('ProfilModel');
        $this->load->model('BerkasPegawaiModel');
        $this->load->model('SertifikatModel');
    }

    public function index()
    {
        $data['judul'] = "Profil";
        $data['pegawai'] = $this->ProfilModel->getAllProfil();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/profil', $data);
        $this->load->view('admin/_partials/footer');
    }
     public function databerkas()
    {
        $data['judul'] = "Data Berkas";
        $data['pegawai'] = $this->ProfilModel->getAllProfil();
        $data['berkas'] = $this->BerkasPegawaiModel->getDataBerkasPegawaiById();
        $data['sertifikat'] = $this->SertifikatModel->getDataSertifikatByNIK();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/databerkas', $data);
        $this->load->view('admin/_partials/footer');
    }
}
