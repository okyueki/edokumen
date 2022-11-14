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
        $data['berkas'] = $this->BerkasPegawaiModel->getBerkasPegawaiById($id);
        
        $jenisberkas=$this->db->like('bidang', $this->input->post("bidang"))->get('jenis_berkas')->result_array();

		foreach ($jenisberkas as $jb) :
            $nama_berkas=strtolower($jb['jenis_berkas']);
            $this->form_validation->set_rules('nomor_berkas_'.$nama_berkas.'', 'Nomor Berkas', '');
            $this->form_validation->set_rules('file_'.$nama_berkas.'', 'File', '');
            $this->form_validation->set_rules('status_berkas_'.$nama_berkas.'', 'Status Berkas', '');
        endforeach;

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahberkaspegawai',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $this->BerkasPegawaiModel->ubahBerkasPegawai($id);
            $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
            redirect('berkaspegawai');
        }
    }
}
