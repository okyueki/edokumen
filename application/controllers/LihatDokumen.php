<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LihatDokumen extends CI_Controller
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
        $this->load->model('DokumenModel');
        $this->load->model('PegawaiModel');
        $this->load->model('LemariModel');
        $this->load->model('RakModel');
        $this->load->model('JenisDokumenModel');
        $this->load->model('UnitModel');
    }

    public function spo()
    {
        $data['judul'] = "Data SPO";
        $data['dokumen'] = $this->DokumenModel->getAllSPO();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/spo', $data);
        $this->load->view('admin/_partials/footer');
    }
    public function pedoman()
    {
        $data['judul'] = "Data Pedoman";
        $data['dokumen'] = $this->DokumenModel->getAllPedoman();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/pedoman', $data);
        $this->load->view('admin/_partials/footer');
    }
}