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
        $data['surat'] = $this->SuratModel->getAllSurat();
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
        $this->form_validation->set_rules('pengirim', 'Pengirim', 'required');
        $this->form_validation->set_rules('penerima', 'Penerima', '');

        if (empty($_FILES['file']['name'])){
            $this->form_validation->set_rules('file', 'File', 'required');
        }

        if ($this->form_validation->run() == false) {
            $data['surat'] = $this->SuratModel->getAllSurat();
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
                $this->SuratModel->tambahSurat($filename);
                $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
                redirect('suratkeluar');
            }else{
                 $this->session->set_flashdata('error', 'File kosong/maksimal 10 MB/hanya bisa file PDF saja!');
                 redirect('suratkeluar');
            }
        }
    }

    public function ubahdatadokumen($id)
    {
        $data['judul'] = "Ubah Data Dokumen";
        $data['dokumen'] = $this->DokumenModel->getDokumenById($id);

        $this->form_validation->set_rules('nama_dokumen', 'Nama Dokumen', 'required');
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tanggal_berakhir', 'Tanggal Berakhir', 'required');
        $this->form_validation->set_rules('pegawai', 'Pegawai', 'required');
        $this->form_validation->set_rules('lemari', 'Lemari', 'required');
        $this->form_validation->set_rules('rak', 'Rak', 'required');
        if (empty($_FILES['file']['name'])){
            $this->form_validation->set_rules('file', 'File', '');
        }

        if ($this->form_validation->run() == false) {
            //$data['dokumen'] = $this->DokumenModel->getAllDokumen();
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $data['rak'] = $this->RakModel->getAllRak();
            $data['lemari'] = $this->LemariModel->getAllLemari();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahdatadokumen', $data);
           $this->load->view('admin/_partials/footer');
        } else {
            //echo "Berhasil";
            $config['upload_path']          = './uploads/dokumen/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 10000;
            $config['file_name']            = $_FILES['file']['name'];

            $this->upload->initialize($config);

            if(empty($_FILES['file'])){
                $filename = ""; 
                $this->DokumenModel->ubahDokumen($id,$filename);
                $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
                redirect('datadokumen');
            }elseif(!empty($_FILES['file'])){
                $this->upload->do_upload('file');
                $uploadData = $this->upload->data(); 
                $filename = $uploadData['file_name'];
                $this->DokumenModel->ubahDokumen($id,$filename);
                $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
                redirect('datadokumen');
            }else{
                 $this->session->set_flashdata('error', 'File kosong/maksimal 10 MB/hanya bisa file PDF saja!');
                 redirect('datadokumen');
            }
        }
    }
     public function hapusdatadokumen($id)
    {
        $dokumenx=$this->db->get_where('dokumen', ['id_dokumen' =>  $id])->row_array();
        $path = './uploads/dokumen/'.$dokumenx['file'];
        unlink($path);
        $this->DokumenModel->hapusDokumen($id);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect('datadokumen');
    }
}