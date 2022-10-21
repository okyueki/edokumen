<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lemari extends CI_Controller
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
        $this->load->model('LemariModel');
    }

    public function index()
    {
        $data['judul'] = "Lemari";
        $data['lemari'] = $this->LemariModel->getAllLemari();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/lemari', $data);
        $this->load->view('admin/_partials/footer');
    }
     public function tambahlemari()
    {
        $data['judul'] = "Tambah Lemari";
        $this->form_validation->set_rules('nama_lemari', 'Nama Lemari', 'required');

        if ($this->form_validation->run() == false) {
            $data['lemari'] = $this->LemariModel->getAllLemari();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/tambahlemari',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $this->LemariModel->tambahLemari();
            $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
            redirect('lemari');
        }
    }
    public function ubahLemari($id)
    {
        $data['judul'] = "Ubah Lemari";
        $data['lemari'] = $this->LemariModel->getLemariById($id);

        $this->form_validation->set_rules('nama_lemari', 'Nama Lemari', 'required');

        if ($this->form_validation->run() == false) {
            //$data['lemari'] = $this->LemariModel->getAllLemari();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahlemari', $data);
           $this->load->view('admin/_partials/footer');
        } else {
            //echo "Berhasil";
            $this->LemariModel->ubahLemari($id);
            $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
            redirect('lemari');
        }
    }
    public function hapuslemari($id)
    {
        $this->LemariModel->hapusLemari($id);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect('lemari');
    }
}
