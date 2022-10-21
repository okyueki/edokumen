<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rak extends CI_Controller
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
        $this->load->model('RakModel');
    }

    public function index()
    {
        $data['judul'] = "Rak";
        $data['rak'] = $this->RakModel->getAllRak();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/rak', $data);
        $this->load->view('admin/_partials/footer');
    }
     public function tambahrak()
    {
        $data['judul'] = "Tambah Rak";
        $this->form_validation->set_rules('nama_rak', 'Nama Rak', 'required');

        if ($this->form_validation->run() == false) {
            $data['rak'] = $this->RakModel->getAllRak();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/tambahrak',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $this->RakModel->tambahrak();
            $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
            redirect('rak');
        }
    }
    public function ubahrak($id)
    {
        $data['judul'] = "Ubah Rak";
        $data['rak'] = $this->RakModel->getRakById($id);

        $this->form_validation->set_rules('nama_rak', 'Nama Rak', 'required');

        if ($this->form_validation->run() == false) {
            //$data['rak'] = $this->RakModel->getAllRak();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahrak', $data);
           $this->load->view('admin/_partials/footer');
        } else {
            //echo "Berhasil";
            $this->RakModel->ubahRak($id);
            $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
            redirect('rak');
        }
    }
    public function hapusrak($id)
    {
        $this->RakModel->hapusRak($id);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect('rak');
    }
}
