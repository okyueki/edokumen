<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sertifikat extends CI_Controller
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
        $this->load->model('PegawaiModel');
        $this->load->model('SertifikatModel');
       
    }

     public function tambahsertifikat($id)
    {
        $data['judul'] = "Tambah Sertifikat";
        $data['pegawai'] = $this->PegawaiModel->getPegawaiById($id);
        $this->form_validation->set_rules('nomor_sertifikat', 'Nomor Sertifikat', 'required');
        $this->form_validation->set_rules('nama_sertifikat', 'nama_sertifikat', 'required');
        $this->form_validation->set_rules('tanggal_pelaksanaan', 'Tanggal Pelaksaan', 'required');
        $this->form_validation->set_rules('tempat_pelaksanaan', 'Tempat Pelaksaan', 'required');
       
        if (empty($_FILES['file']['name'])){
            $this->form_validation->set_rules('file', 'File', 'required');
        }
        if ($this->form_validation->run() == false) {
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/tambahsertifikat',$data);
            $this->load->view('admin/_partials/footer');
        } else {
            $config['upload_path']          = './uploads/sertifikat/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 10000;
            $config['file_name']            = $_FILES['file']['name'];

            $this->upload->initialize($config);

            if($this->upload->do_upload('file')){
                $uploadData = $this->upload->data(); 
                $filename = $uploadData['file_name']; 
                $this->SertifikatModel->tambahSertifikat($id,$filename);
                $this->session->set_flashdata('sukses', 'Data Berhasil Ditambahkan');
                redirect('berkaspegawai/ubahberkaspegawai/'.$id.'');
            }else{
                 $this->session->set_flashdata('error', 'File kosong/maksimal 10 MB/hanya bisa file PDF saja!');
                 redirect('berkaspegawai/ubahberkaspegawai/'.$id.'');
            }
        }
        
    }
    public function ubahsertifikat($id,$nik)
    {
        $data['judul'] = "Ubah Sertifikat";
        $data['sertifikat'] = $this->SertifikatModel->getSertifikatById($id,$nik);
        
        $this->form_validation->set_rules('nomor_sertifikat', 'Nomor Sertifikat', 'required');
        $this->form_validation->set_rules('nama_sertifikat', 'nama_sertifikat', 'required');
        $this->form_validation->set_rules('tanggal_pelaksanaan', 'Tanggal Pelaksaan', 'required');
        $this->form_validation->set_rules('tempat_pelaksanaan', 'Tempat Pelaksaan', 'required');

        if (empty($_FILES['file']['name'])){
            $this->form_validation->set_rules('file', 'File', '');
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('admin/_partials/header');
            $this->load->view('admin/_partials/navbar');
            $this->load->view('admin/ubahsertifikat', $data);
           $this->load->view('admin/_partials/footer');
        } else {
            //echo "Berhasil";
            $config['upload_path']          = './uploads/sertifikat/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 10000;
            $config['file_name']            = $_FILES['file']['name'];

            $this->upload->initialize($config);

            if(empty($_FILES['file']['name'])){
                $filename = ""; 
                $this->SertifikatModel->ubahSertifikat($id,$nik,$filename);
                $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
               redirect('berkaspegawai/ubahberkaspegawai/'.$nik.'');
            }elseif(!empty($_FILES['file']['name'])){
                $this->upload->do_upload('file');
                $uploadData = $this->upload->data(); 
                $filename = $uploadData['file_name'];
                $path = './uploads/sertifikat/'.$this->input->post("oldfile");
                unlink($path);
                $this->SertifikatModel->ubahSertifikat($id,$nik,$filename);
                $this->session->set_flashdata('sukses', 'Data Berhasil Diubah');
                redirect('berkaspegawai/ubahberkaspegawai/'.$nik.'');
            }else{
                 $this->session->set_flashdata('error', 'File kosong/maksimal 10 MB/hanya bisa file PDF saja!');
                 redirect('berkaspegawai/ubahberkaspegawai/'.$nik.'');
            }
        }
    }
    public function hapussertifikat($id, $nik)
    {
        $sertifikatx=$this->db->get_where('sertifikat', ['id_sertifikat' =>  $id, 'nik_pegawai' => $nik])->row_array();
        $path = './uploads/sertifikat/'.$sertifikatx['file'];
        unlink($path);
        $this->SertifikatModel->hapusSertifikat($id,$nik);
        $this->session->set_flashdata('sukses', 'Data Berhasil Dihapus');
        redirect('berkaspegawai/ubahberkaspegawai/'.$nik.'');
    }
}