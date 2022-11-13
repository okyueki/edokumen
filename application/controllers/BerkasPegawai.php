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
        $this->load->model('PegawaiModel');
    }

    public function index()
    {
        $data['judul'] = "Berkas Pegawai";
        $data['pegawai'] = $this->PegawaiModel->getAllTablePegawai();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/berkaspegawai', $data);
        $this->load->view('admin/_partials/footer');
    }
     public function ubahberkaspegawai($id)
    {
        $data['judul'] = "Tambah Berkas Pegawai";
        $data['pegawai'] = $this->PegawaiModel->getPegawaiById($id);

        $this->form_validation->set_rules('jenis_berkas', 'Nama Jenis Berkas', 'required');
        $this->form_validation->set_rules('kategori_berkas', 'Kategori Berkas', 'required');

        if ($this->form_validation->run() == false) {
            
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahberkaspegawai',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $this->BerkasPegawaiModel->tambahBerkasPegawai();
            $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
            redirect('jenisberkas');
        }
    }
}
