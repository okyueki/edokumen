<?php
class BerkasPegawaiModel extends CI_model
{
    public function getAllBerkasPegawai()
    {
        return $this->db->select('berkas_pegawai.*, jenis_berkas.jenis_berkas')
            ->join('jenis_berkas', 'berkas_pegawai.id_jenis_berkas=jenis_berkas.id_jenis_berkas')->get_where('berkas_pegawai', ['nik' => $this->session->userdata('nik')])->result_array();
    }
}