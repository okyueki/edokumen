<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisDokumen extends CI_Controller
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
        $this->load->model('JenisDokumenModel');
    }

    public function index()
    {
        $data['judul'] = "Jenis Dokumen";
        $data['jenisdokumen'] = $this->JenisDokumenModel->getAllJenisDokumen();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/jenisdokumen', $data);
        $this->load->view('admin/_partials/footer');
    }
     public function tambahjenisdokumen()
    {
        $data['judul'] = "Tambah Jenis Dokumen";
        $this->form_validation->set_rules('jenis_dokumen', 'Jenis Dokumen', 'required');
         $this->form_validation->set_rules('sifat_dokumen', 'Sifat Dokumen', 'required');

        if ($this->form_validation->run() == false) {
            $data['jenisdokumen'] = $this->JenisDokumenModel->getAllJenisDokumen();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/tambahjenisdokumen',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $this->JenisDokumenModel->tambahJenisDokumen();
            $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
            redirect('jenisdokumen');
        }
    }
    public function ubahJenisDokumen($id)
    {
        $data['judul'] = "Ubah Jenis Dokumen";
        $data['jenisdokumen'] = $this->JenisDokumenModel->getJenisDokumenById($id);

        $this->form_validation->set_rules('jenis_dokumen', 'Jenis Dokumen', 'required');
        $this->form_validation->set_rules('sifat_dokumen', 'Sifat Dokumen', 'required');

        if ($this->form_validation->run() == false) {
            //$data['lemari'] = $this->LemariModel->getAllLemari();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahjenisdokumen', $data);
           $this->load->view('admin/_partials/footer');
        } else {
            //echo "Berhasil";
            $this->JenisDokumenModel->ubahJenisDokumen($id);
            $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
            redirect('jenisdokumen');
        }
    }
    public function hapusJenisDokumen($id)
    {
        $this->JenisDokumenModel->hapusJenisDokumen($id);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect('jenisdokumen');
    }
}
