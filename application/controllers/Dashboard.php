<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller 
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
    }
    public function index()
    {
        $data['judul'] = "Dashboard";
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/dashboard',$data);
        $this->load->view('admin/_partials/footer');
    }
}