<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sifat extends CI_Controller
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
        $this->load->model('SifatModel');
    }

    public function index()
    {
        $data['judul'] = "Sifat";
        $data['sifat'] = $this->SifatModel->getAllSifat();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/sifat', $data);
        $this->load->view('admin/_partials/footer');
    }
     public function tambahSifat()
    {
        $data['judul'] = "Tambah Sifat";
        $this->form_validation->set_rules('nama_sifat', 'Nama Sifat', 'required');

        if ($this->form_validation->run() == false) {
            $data['sifat'] = $this->SifatModel->getAllSifat();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/tambahsifat',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $this->SifatModel->tambahSifat();
            $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
            redirect('sifat');
        }
    }
    public function ubahSifat($id)
    {
        $data['judul'] = "Ubah Sifat";
        $data['sifat'] = $this->SifatModel->getSifatById($id);

        $this->form_validation->set_rules('nama_sifat', 'Nama Sifat', 'required');

        if ($this->form_validation->run() == false) {
            //$data['Sifat'] = $this->SifatModel->getAllSifat();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahsifat', $data);
           $this->load->view('admin/_partials/footer');
        } else {
            //echo "Berhasil";
            $this->SifatModel->ubahSifat($id);
            $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
            redirect('Sifat');
        }
    }
    public function hapussifat($id)
    {
        $this->SifatModel->hapusSifat($id);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect('Sifat');
    }
}
