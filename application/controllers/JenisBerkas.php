<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisBerkas extends CI_Controller
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
        $this->load->model('JenisBerkasModel');
    }

    public function index()
    {
        $data['judul'] = "Jenis Berkas";
        $data['jenisberkas'] = $this->JenisBerkasModel->getAllJenisBerkas();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/jenisberkas', $data);
        $this->load->view('admin/_partials/footer');
    }
     public function tambahjenisberkas()
    {
        $data['judul'] = "Tambah Jenis Berkas";
        $this->form_validation->set_rules('jenis_berkas', 'Nama Jenis Berkas', 'required');

        if ($this->form_validation->run() == false) {
            $data['jenisberkas'] = $this->JenisBerkasModel->getAllJenisBerkas();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/tambahJenisBerkas',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $this->JenisBerkasModel->tambahJenisBerkas();
            $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
            redirect('jenisberkas');
        }
    }
    public function ubahjenisberkas($id)
    {
        $data['judul'] = "Ubah Jenis Berkas";
        $data['jenisberkas'] = $this->JenisBerkasModel->getJenisBerkasById($id);

        $this->form_validation->set_rules('jenis_berkas', 'Nama Jenis Berkas', 'required');

        if ($this->form_validation->run() == false) {
            //$data['JenisBerkas'] = $this->JenisBerkasModel->getAllJenisBerkas();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahjenisberkas', $data);
           $this->load->view('admin/_partials/footer');
        } else {
            //echo "Berhasil";
            $this->JenisBerkasModel->ubahJenisBerkas($id);
            $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
            redirect('jenisberkas');
        }
    }
    public function hapusjenisberkas($id)
    {
        $this->JenisBerkasModel->hapusJenisBerkas($id);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect('jenisberkas');
    }
}
