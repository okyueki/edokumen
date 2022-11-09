<?php
class DisposisiSuratModel extends CI_model
{
    public function getDisposisiById($id)
    {
        return $this->db->get_where('disposisi', ['kode_surat' => $id])->row_array();
    }
    public function tambahDisposisiSurat($id,$image_name)
    {
        $disposis_ke = implode(",", $this->input->post('nik_disposisi'));
        $data = [
            "kode_surat" => $id,
            "nik_disposisi_dari" => $this->session->userdata('nik'),
            "nik_disposisi_ke" => $disposis_ke,
            "catatan_disposisi" => $this->input->post("catatan"),
            "qrcode_disposisi" => $image_name,
            "tanggal_disposisi" => date('Y-m-d'),
        ];
        $this->db->insert('disposisi', $data);
    }
    public function updateDisposisiSurat($id,$image_name)
    {
        $disposis_ke = implode(",", $this->input->post('nik_disposisi'));
        $data = [
            "kode_surat" => $id,
            "nik_disposisi_dari" => $this->session->userdata('nik'),
            "nik_disposisi_ke" => $disposis_ke,
            "catatan_disposisi" => $this->input->post("catatan"),
            "qrcode_disposisi" => $image_name,
            "tanggal_disposisi" => date('Y-m-d'),
        ];
        $this->db->where('kode_surat', $id);
        $this->db->update('disposisi', $data);
    }
}