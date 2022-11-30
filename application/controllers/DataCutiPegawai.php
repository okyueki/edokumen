<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataCutiPegawai extends CI_Controller
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
    }

    public function index()
    {
        $data['judul'] = "Data Cuti Pegawai";
        $data['cuti'] = $this->CutiModel->getVeryAllCuti();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/datacutipegawai', $data);
        $this->load->view('admin/_partials/footer');
    }
}