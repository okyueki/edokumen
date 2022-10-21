<?php
defined('BASEPATH') or exit('No direct script access allowed');

class JenisCuti extends CI_Controller
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
        $this->load->model('JenisCutiModel');
    }

    public function index()
    {
        $data['judul'] = "Jenis Cuti";
        $data['jeniscuti'] = $this->JenisCutiModel->getAllJenisCuti();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/jeniscuti', $data);
        $this->load->view('admin/_partials/footer');
    }
     public function tambahjeniscuti()
    {
        $data['judul'] = "Tambah Jenis Cuti";
        $this->form_validation->set_rules('jenis_cuti', 'Nama Jenis Cuti', 'required');

        if ($this->form_validation->run() == false) {
            $data['jeniscuti'] = $this->JenisCutiModel->getAllJenisCuti();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/tambahJenisCuti',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $this->JenisCutiModel->tambahJenisCuti();
            $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
            redirect('jeniscuti');
        }
    }
    public function ubahjeniscuti($id)
    {
        $data['judul'] = "Ubah Jenis Cuti";
        $data['jeniscuti'] = $this->JenisCutiModel->getJenisCutiById($id);

        $this->form_validation->set_rules('jenis_cuti', 'Nama Jenis Cuti', 'required');

        if ($this->form_validation->run() == false) {
            //$data['JenisCuti'] = $this->JenisCutiModel->getAllJenisCuti();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahjeniscuti', $data);
           $this->load->view('admin/_partials/footer');
        } else {
            //echo "Berhasil";
            $this->JenisCutiModel->ubahJenisCuti($id);
            $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
            redirect('jeniscuti');
        }
    }
    public function hapusjeniscuti($id)
    {
        $this->JenisCutiModel->hapusJenisCuti($id);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect('jeniscuti');
    }
}
