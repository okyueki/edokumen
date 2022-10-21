<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
     function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->db2=$this->load->database('serverkhanza', TRUE);
        $this->load->model('PegawaiModel');
    }

    public function index()
    {
        $data['judul'] = "Pegawai";
        $data['pegawai'] = $this->PegawaiModel->getAllTablePegawai();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/pegawai', $data);
        $this->load->view('admin/_partials/footer');
    }
}
