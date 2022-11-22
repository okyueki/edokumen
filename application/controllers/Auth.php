<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->db=$this->load->database('default', TRUE);
        $this->db2=$this->load->database('serverkhanza', TRUE);

    }
    public function index()
    {
        $this->load->view('login');
    }
    public function proses()
    {
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            $this->load->view('login');
        } else {
            $this->_login();
        }
    }
    private function _login()
    {
        $username = $this->input->post('nik');
        $password = $this->input->post('password');

        $cek_user = $this->db->join('unit', 'unit.id_unit=hak_akses.id_unit')->join('jabatan', 'jabatan.id_jabatan=hak_akses.id_jabatan')->get_where('hak_akses', ['nik' => $username])->row_array();
        $pegawaix=$this->db2->get_where('pegawai', ['nik' =>  $username])->row_array();

        if ($cek_user) {
            $data = [
                'id' => $pegawaix['id'],
                'nama' => $pegawaix['nama'],
                'nik' => $pegawaix['nik'],
                'hak_akses' => $cek_user['hak_akses'],
                'jk' => $pegawaix['jk'],
                'id_unit' => $cek_user['id_unit'],
                'nama_jabatan' => $cek_user['nama_jabatan']
            ];
            $this->session->set_userdata($data);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Username Belum Terdaftar Silahkan Hubungi IT/Admin
          </div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('id');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('nik');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">
            Anda Sudah Melakukan Logout!
          </div>');
        redirect('auth');
    }
}
