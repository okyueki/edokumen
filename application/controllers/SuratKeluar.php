<?php
defined('BASEPATH') or exit('No direct script access allowed');

class SuratKeluar extends CI_Controller
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
        $this->load->model('SuratModel');
        $this->load->model('PegawaiModel');;
    }

    public function index()
    {
        $data['judul'] = "Data Surat";
        $data['surat'] = $this->SuratModel->getAllSuratKeluar();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/suratkeluar', $data);
        $this->load->view('admin/_partials/footer');
    }
     public function tambahsuratkeluar()
    {
        $data['judul'] = "Tambah Surat Keluar";
        $this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('judul_surat', 'Judul Surat', 'required');
        $this->form_validation->set_rules('nik_pj[]', 'Dikirim Ke', 'required');
        $this->form_validation->set_rules('isi_surat', 'Isi Surat', 'required');

        if ($this->form_validation->run() == false) {
            $data['surat'] = $this->SuratModel->getAllSuratKeluar();
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/tambahsuratkeluar',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $this->SuratModel->tambahSurat($kategori='surat');
            $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
            redirect('suratkeluar');
        }
    }

    public function ubahsuratkeluar($id)
    {
        $data['judul'] = "Ubah Data Surat";
        $data['surat'] = $this->SuratModel->getSuratById($id,$kategori='surat');

        $this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('judul_surat', 'Judul Surat', 'required');
        $this->form_validation->set_rules('nik_pj[]', 'Dikirim Ke', 'required');
        $this->form_validation->set_rules('isi_surat', 'Isi Surat', 'required');

        if ($this->form_validation->run() == false) {
            //$data['surat'] = $this->SuratModel->getAllSurat();
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahsuratkeluar', $data);
           $this->load->view('admin/_partials/footer');
        } else {
        
            $this->SuratModel->ubahSurat($id,$kategori='surat');
            $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
            redirect('suratkeluar');
             
        }
    }
     public function hapussuratkeluar($id,$kategori='surat')
    {
        $this->SuratModel->hapusSurat($id,$kategori);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect('suratkeluar');
    }
}