<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
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
        $this->load->model('JabatanModel');
    }

    public function index()
    {
        $data['judul'] = "Jabatan";
        $data['jabatan'] = $this->JabatanModel->getAllJabatan();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/jabatan', $data);
        $this->load->view('admin/_partials/footer');
    }
     public function tambahjabatan()
    {
        $data['judul'] = "Tambah Jabatan";
        $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');

        if ($this->form_validation->run() == false) {
            //$data['Jabatan'] = $this->JabatanModel->getAllJabatan();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/tambahjabatan',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $this->JabatanModel->tambahJabatan();
            $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
            redirect('jabatan');
        }
    }
    public function ubahJabatan($id)
    {
        $data['judul'] = "Ubah Jabatan";
        $data['jabatan'] = $this->JabatanModel->getJabatanById($id);

        $this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required');

        if ($this->form_validation->run() == false) {
            //$data['Jabatan'] = $this->JabatanModel->getAllJabatan();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahjabatan', $data);
           $this->load->view('admin/_partials/footer');
        } else {
            //echo "Berhasil";
            $this->JabatanModel->ubahJabatan($id);
            $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
            redirect('jabatan');
        }
    }
    public function hapusJabatan($id)
    {
        $this->JabatanModel->hapusJabatan($id);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect('jabatan');
    }
}
