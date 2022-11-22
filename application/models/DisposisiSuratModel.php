<?php
class DisposisiSuratModel extends CI_model
{
     public function getSuratMasukDisposisi()
    {
        return $this->db->select("surat.*, disposisi.*")
        ->join("disposisi","surat.kode_surat=disposisi.kode_surat")
        ->get_where("surat",["disposisi.nik_disposisi_ke"=>$this->session->userdata('nik')])->result_array();
    }
    public function getAllDisposisi($id)
    {
         return $this->db->get_where('disposisi', ['kode_surat' => $id])->result_array();
    }
    public function tambahDisposisiSurat($id,$image_name)
    {
        $count = count($this->input->post('nik_pj'));
       for($i=0 ; $i < $count; $i++){
        $data2[$i] = [
            "kode_surat" => $id,
            "nik_disposisi_dari" => $this->session->userdata('nik'),
            "nik_disposisi_ke" => $this->input->post('nik_pj['.$i.']'),
            "catatan_disposisi" => $this->input->post("catatan"),
            "qrcode_disposisi" => $image_name,
            "tanggal_disposisi" => date('Y-m-d'),
        ];
         $this->db->insert('disposisi', $data2[$i]);
    }
    }
    public function UpdateDisposisiSurat($id)
    {
        $data = [
            "status_disposisi" => "Sudah"
        ];
        $this->db->where('kode_surat', $id)->where('nik_disposisi_ke', $this->session->userdata('nik'));
        $this->db->update('disposisi', $data);
    }
     public function cetakDisposisi($id)
    {
        return $this->db->select('surat.*, disposisi.*')
        ->join('disposisi', 'surat.kode_surat=disposisi.kode_surat')
        ->get_where('surat', ['surat.kode_surat' => $id])->row_array();
    }
}