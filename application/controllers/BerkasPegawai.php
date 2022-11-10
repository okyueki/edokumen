<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BerkasPegawai extends CI_Controller
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
        $this->load->model('BerkasPegawaiModel');
        $this->load->model('JenisBerkasModel');
    }

    public function index()
    {
        $data['judul'] = "Berkas Pegawai";
        $data['berkaspegawai'] = $this->BerkasPegawaiModel->getAllBerkasPegawai();
        $data['totalberkas_pegawaix'] = $this->BerkasPegawaiModel->getGroupByTotalBerkasPegawai();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/berkaspegawai', $data);
        $this->load->view('admin/_partials/footer');
    }
}
