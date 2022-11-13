<?php
class PegawaiModel extends CI_model
{
    public function getAllPegawai()
    {
        return $this->db2->select('nik,nama')->get_where('pegawai', ['stts_aktif' =>'AKTIF'])->result_array();
    }
    public function getAllTablePegawai()
    {
        return $this->db2->select('id,nik,nama,jk,jbtn,tmp_lahir,tgl_lahir,alamat,stts_aktif,bidang')->get_where('pegawai', ['stts_aktif' =>'AKTIF'])->result_array();
    }
    public function getPegawaiById($id)
    {
        return $this->db2->select('id,nik,nama,jk,jbtn,tmp_lahir,tgl_lahir,alamat,stts_aktif,bidang')->get_where('pegawai', ['id' => $id])->row_array();
    }
}