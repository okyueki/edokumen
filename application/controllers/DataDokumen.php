<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataDokumen extends CI_Controller
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
        $this->load->model('DokumenModel');
        $this->load->model('PegawaiModel');
        $this->load->model('LemariModel');
        $this->load->model('RakModel');
        $this->load->model('JenisDokumenModel');
    }

    public function index()
    {
        $data['judul'] = "Data Dokumen";
        $data['dokumen'] = $this->DokumenModel->getAllDokumen();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/datadokumen', $data);
        $this->load->view('admin/_partials/footer');
    }
     public function tambahdatadokumen()
    {
        $data['judul'] = "Tambah Data Dokumen";
        $this->form_validation->set_rules('nama_dokumen', 'Nama Dokumen', 'required');
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tanggal_berakhir', 'Tanggal Berakhir', 'required');
        $this->form_validation->set_rules('lemari', 'Lemari', 'required');
        $this->form_validation->set_rules('rak', 'Rak', 'required');
        $this->form_validation->set_rules('jenis_dokumen', 'Jenis Dokumen', 'required');
        $this->form_validation->set_rules('nomor_dokumen', 'Nomor Dokumen', 'required');
        if (empty($_FILES['file']['name'])){
            $this->form_validation->set_rules('file', 'File', 'required');
        }
        if ($this->form_validation->run() == false) {
            $data['dokumen'] = $this->DokumenModel->getAllDokumen();
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $data['rak'] = $this->RakModel->getAllRak();
            $data['lemari'] = $this->LemariModel->getAllLemari();
            $data['jenisdokumen'] = $this->JenisDokumenModel->getAllJenisDokumen();
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/tambahdatadokumen',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $config['upload_path']          = './uploads/dokumen/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 10000;
            $config['file_name']            = $_FILES['file']['name'];

            $this->upload->initialize($config);

            if($this->upload->do_upload('file')){
                $uploadData = $this->upload->data(); 
                $filename = $uploadData['file_name']; 
                $this->DokumenModel->tambahDokumen($filename);
                $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
                redirect('datadokumen');
            }else{
                 $this->session->set_flashdata('error', 'File kosong/maksimal 10 MB/hanya bisa file PDF saja!');
                 redirect('datadokumen');
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
        $this->form_validation->set_rules('lemari', 'Lemari', 'required');
        $this->form_validation->set_rules('rak', 'Rak', 'required');
        $this->form_validation->set_rules('jenis_dokumen', 'Jenis Dokumen', 'required');
        $this->form_validation->set_rules('nomor_dokumen', 'Nomor Dokumen', 'required');

        if (empty($_FILES['file']['name'])){
            $this->form_validation->set_rules('file', 'File', '');
        }

        if ($this->form_validation->run() == false) {
            //$data['dokumen'] = $this->DokumenModel->getAllDokumen();
            $data['pegawai'] = $this->PegawaiModel->getAllPegawai();
            $data['rak'] = $this->RakModel->getAllRak();
            $data['lemari'] = $this->LemariModel->getAllLemari();
            $data['jenisdokumen'] = $this->JenisDokumenModel->getAllJenisDokumen();
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
    public function detaildatadokumen($id)
    {
         $data['judul'] = "Detail Data Dokumen";
        $data['dokumen'] = $this->DokumenModel->detailDokumenById($id);
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/detaildatadokumen', $data);
        $this->load->view('admin/_partials/footer');
    }


}