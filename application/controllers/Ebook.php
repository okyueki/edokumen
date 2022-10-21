<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ebook extends CI_Controller
{
     function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->db2=$this->load->database('serverkhanza', TRUE);
        $this->load->model('EbookModel');
    }

    public function index()
    {
        $data['judul'] = "Ebook";
        $data['perpustakaan_ebook'] = $this->EbookModel->getAllEbook();
        $this->load->view('admin/_partials/header');
        $this->load->view('admin/_partials/navbar');
        $this->load->view('admin/ebook', $data);
        $this->load->view('admin/_partials/footer');
    }
}
