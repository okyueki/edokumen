<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
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
        $this->load->model('UnitModel');
    }

    public function index()
    {
        $data['judul'] = "Unit";
        $data['unit'] = $this->UnitModel->getAllUnit();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/unit', $data);
        $this->load->view('admin/_partials/footer');
    }
     public function tambahunit()
    {
        $data['judul'] = "Tambah Unit";
        $this->form_validation->set_rules('nama_unit', 'Nama Unit', 'required');

        if ($this->form_validation->run() == false) {
            //$data['unit'] = $this->UnitModel->getAllUnit();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/tambahunit',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $this->UnitModel->tambahunit();
            $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
            redirect('unit');
        }
    }
    public function ubahunit($id)
    {
        $data['judul'] = "Ubah Unit";
        $data['unit'] = $this->UnitModel->getUnitById($id);

        $this->form_validation->set_rules('nama_unit', 'Nama Unit', 'required');

        if ($this->form_validation->run() == false) {
            //$data['Unit'] = $this->UnitModel->getAllUnit();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahunit', $data);
           $this->load->view('admin/_partials/footer');
        } else {
            //echo "Berhasil";
            $this->UnitModel->ubahUnit($id);
            $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
            redirect('unit');
        }
    }
    public function hapusunit($id)
    {
        $this->UnitModel->hapusunit($id);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect('unit');
    }
}
