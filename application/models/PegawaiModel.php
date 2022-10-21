<?php
class PegawaiModel extends CI_model
{
    public function getAllPegawai()
    {
        return $this->db2->select('nik,nama')->get('pegawai')->toArray();
    }
    public function getAllTablePegawai()
    {
        return $this->db2->select('id,nik,nama,jk,jbtn,tmp_lahir,tgl_lahir,alamat,stts_aktif')->get_where('pegawai', ['stts_aktif' =>'AKTIF'])->result_array();
    }
}