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
        $this->form_validation->set_rules('nik_pj', 'Dikirim Ke', 'required');

        if (empty($_FILES['file']['name'])){
            $this->form_validation->set_rules('file', 'File', 'required');
        }

        if ($this->form_validation->run() == false) {
            $data['surat'] = $this->SuratModel->getAllSuratKeluar();
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/tambahsuratkeluar',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $config['upload_path']          = './uploads/surat/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 10000;
            $config['file_name']            = $_FILES['file']['name'];

            $this->upload->initialize($config);

            if($this->upload->do_upload('file')){
                $uploadData = $this->upload->data(); 
                $filename = $uploadData['file_name']; 
                $this->SuratModel->tambahSurat($filename, $kategori='surat');
                $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
                redirect('suratkeluar');
            }else{
                 $this->session->set_flashdata('error', 'File kosong/maksimal 10 MB/hanya bisa file PDF saja!');
                redirect('suratkeluar');
            }
        }
    }

    public function ubahsuratkeluar($id)
    {
        $data['judul'] = "Ubah Data Surat";
        $data['surat'] = $this->SuratModel->getSuratById($id,$kategori='surat');

       $this->form_validation->set_rules('nomor_surat', 'Nomor Surat', 'required');
        $this->form_validation->set_rules('judul_surat', 'Judul Surat', 'required');
        $this->form_validation->set_rules('nik_pj', 'Dikirim Ke', 'required');

        if (empty($_FILES['file']['name'])){
            $this->form_validation->set_rules('file', 'File', '');
        }

        if ($this->form_validation->run() == false) {
            //$data['surat'] = $this->SuratModel->getAllSurat();
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahsuratkeluar', $data);
           $this->load->view('admin/_partials/footer');
        } else {
            //echo "Berhasil";
            $config['upload_path']          = './uploads/surat/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 10000;
            $config['file_name']            = $_FILES['file']['name'];

            $this->upload->initialize($config);

            if(empty($_FILES['file'])){
                $filename = ""; 
                $this->SuratModel->ubahSurat($id,$filename,$kategori='surat');
                $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
                redirect('suratkeluar');
            }elseif(!empty($_FILES['file'])){
                $this->upload->do_upload('file');
                $uploadData = $this->upload->data(); 
                $filename = $uploadData['file_name'];
                $this->SuratModel->ubahSurat($id,$filename,$kategori='surat');
                $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
                redirect('suratkeluar');
            }else{
                 $this->session->set_flashdata('error', 'File kosong/maksimal 10 MB/hanya bisa file PDF saja!');
                 redirect('suratkeluar');
            }
        }
    }
     public function hapussuratkeluar($id,$kategori='surat')
    {
        $suratx=$this->db->get_where('surat', ['id_surat' =>  $id])->row_array();
        $path = './uploads/surat/'.$suratx['file'];
        unlink($path);
        $this->SuratModel->hapusSurat($id,$kategori);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect('datadokumen');
    }
}