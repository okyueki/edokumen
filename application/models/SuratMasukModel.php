<?php
class SuratMasukModel extends CI_model
{
     public function getAllSurat()
    {
        return $this->db->get('surat')->result_array();
    }
    public function getSuratMasuk()
    {
        return $this->db->select("surat.*, verifikasi_surat.*")
        ->join("verifikasi_surat","surat.kode_surat=verifikasi_surat.kode_surat")
        ->get_where("surat",["verifikasi_surat.nik_penerima"=>$this->session->userdata('nik')])->result_array();
    }
    public function getVerifikasiSuratById($id)
    {
        return $this->db->select("surat.*, verifikasi_surat.*")
        ->join("verifikasi_surat","surat.kode_surat=verifikasi_surat.kode_surat")
        ->get_where("surat",["verifikasi_surat.nik_penerima"=>$this->session->userdata('nik'), "surat.kode_surat" => $id])->row_array();
    }
     public function getVerifikasiSuratByKdSurat($id)
    {
        return $this->db->select("surat.*, verifikasi_surat.*")
        ->join("verifikasi_surat","surat.kode_surat=verifikasi_surat.kode_surat")
        ->get_where("surat",["surat.kode_surat" => $id])->row_array();
    }
    public function getDisposisiSuratById($id)
    {
        return $this->db->select("surat.*, disposisi.*")
        ->join("disposisi","surat.kode_surat=disposisi.kode_surat")
        ->get_where("surat",["disposisi.nik_disposisi_ke"=>$this->session->userdata('nik'), "surat.kode_surat" => $id])->row_array();
    }
     public function UpdateStatusSuratDisposisi($id)
    {
        $data = [
            "status" => "Disposisi"
        ];
        $this->db->where('kode_surat', $id);
        $this->db->update('surat', $data);
    }
}