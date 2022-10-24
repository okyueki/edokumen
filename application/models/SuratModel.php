<?php
class SuratModel extends CI_model
{
    public function getAllSuratKeluar()
    {
         return $this->db->not_like('nomor_surat','SF')->get_where('surat', ['nik_pengirim' =>  $this->session->userdata('nik')])->result_array();
    }
    public function getSuratMasuk()
    {
         return $this->db->get_where('surat', ['nik_penerima' =>  $this->session->userdata('nik')])->result_array();
    }
    public function tambahSurat($filename,$kategori)
    {
        if($kategori=="surat"){
            $data = [
                "nomor_surat" => $this->input->post("nomor_surat"),
                "judul_surat" => $this->input->post("judul_surat"),
                "nik_pengirim" => $this->session->userdata('nik'),
                "nik_penerima" => $this->input->post("nik_pj"),
                "status" => 'Belum Dibaca',
                "tanggal" => date('Y-m-d H:i:s'),
                "file" => $filename
            ];
        }else{
            $jeniscutix=$this->db->get_where('jenis_cuti', ['id_jenis_cuti' =>  $this->input->post("jenis_cuti")])->row_array();
            $format = 'SF' . date('Ymd');
            $db = $this->db->get_where('surat', ['nomor_surat' =>  $format])->row_array();
            $nourut = substr($db['nomor_surat'], 10, 3);
            $kodePengajuanSekarang = $nourut + 1;
            $data = [
                "nomor_surat" => "SF" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang),
                "judul_surat" => "Cuti ".$jeniscutix['jenis_cuti'],
                "nik_pengirim" => $this->session->userdata('nik'),
                "nik_penerima" => $this->input->post("nik_pj"),
                "status" => 'Belum Dibaca',
                "tanggal" => date('Y-m-d H:i:s'),
                "file" => $filename
            ];
        }
        
        $this->db->insert('surat', $data);
           
    }
    public function getSuratById($id,$kategori)
    {
         if($kategori=="surat"){
            return $this->db->get_where('surat', ['id_surat' => $id])->row_array();
         }else{
        return $this->db->get_where('surat', ['nomor_surat' => $id])->row_array();
         }
    }
    public function ubahSurat($id,$filename,$kategori)
    {
        if($kategori=="surat"){
            $data = [
                "nomor_surat" => $this->input->post("nomor_surat"),
                "judul_surat" => $this->input->post("judul_surat"),
                "nik_pengirim" => $this->session->userdata('nik'),
                "nik_penerima" => $this->input->post("nik_pj"),
                "status" => 'Belum Dibaca',
                "tanggal" => date('Y-m-d H:i:s'),
                "file" => $filename
            ];
            $this->db->where('id_surat', $id);
        $this->db->update('surat', $data);
        }else{
       $jeniscutix=$this->db->get_where('jenis_cuti', ['id_jenis_cuti' =>  $this->input->post("jenis_cuti")])->row_array();
        $data = [
            "judul_surat" => "Cuti ".$jeniscutix['jenis_cuti'],
            "nik_pengirim" => $this->session->userdata('nik'),
            "nik_penerima" => $this->input->post("nik_pj"),
            "status" => 'Belum Dibaca',
            "tanggal" => date('Y-m-d H:i:s'),
            "file" => $filename
        ];
         $this->db->where('nomor_surat', $id);
        $this->db->update('surat', $data);
    }
       
    }
    public function hapusSurat($id,$kategori)
    {
         if($kategori=="surat"){
        $this->db->where('id_surat', $id);
        $this->db->delete('surat');
         }else{
            $this->db->where('nomor_surat', $id);
        $this->db->delete('surat');
         }
    }
     public function VerifikasiSurat($id)
    {
        $data = [
            "status" => "Sudah Dibaca"
        ];
        $this->db->where('nomor_surat', $id);
        $this->db->update('surat', $data);
    }
}