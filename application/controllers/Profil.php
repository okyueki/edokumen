<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
     function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->db2=$this->load->database('serverkhanza', TRUE);
        $this->load->model('ProfilModel');
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
}
