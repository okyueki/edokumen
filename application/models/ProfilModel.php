<?php
class ProfilModel extends CI_model
{
    public function getAllProfil()
    {
        return $this->db2->select('pegawai.nik,pegawai.nama,pegawai.tmp_lahir,pegawai.alamat,pegawai.kota,pegawai.jbtn,pegawai.tmp_lahir,pegawai.no_ktp,pegawai.tgl_lahir,departemen.nama as nama_departemen,pegawai.bidang,nip,stts_nikah,no_telp,photo')
        ->join('departemen', 'departemen.dep_id=pegawai.departemen')
        ->join('petugas','petugas.nip=pegawai.nik')->get_where('pegawai', ['nik' => $this->session->userdata('nik')])->row_array();
    }
}