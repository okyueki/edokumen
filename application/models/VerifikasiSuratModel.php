<?php
class VerifikasiSuratModel extends CI_model
{
    public function getAllVerifikasi($id)
    {
         return $this->db->get_where('verifikasi_surat', ['kode_surat' => $id])->result_array();
    }
    public function UpdateVerifikasiSurat($id,$image_name){
        $data = [
                "catatan" => $this->input->post("catatan"),
                "status_verifikasi" => $this->input->post("verifikasi_surat"),
                "qrcode_verifikasi_surat" => $image_name,
                "tanggal" => date('Y-m-d')
        ];
        $this->db->where('kode_surat', $id)->where('nik_penerima', $this->session->userdata('nik'));
        $this->db->update('verifikasi_surat', $data);
    }
    public function UpdateVerifikasiSuratDitolak($id){
        $data = [
                "catatan" => $this->input->post("catatan"),
                "status_verifikasi" => $this->input->post("verifikasi_surat"),
                "tanggal" => date('Y-m-d')
        ];
        $this->db->where('kode_surat', $id)->where('nik', $this->session->userdata('nik'));
        $this->db->update('verifikasi_surat', $data);
    }
    public function tambahVerifikasiSurat($id){
        $data = [
                "kode_surat" => $id,
                "nik_penerima" => $this->input->post('nik_pj'),
                "status_verifikasi" => "Proses Verifikasi"
            ];
            $this->db->insert('verifikasi_surat', $data);
    }
    public function hapusVerifikasiSurat($id)
    {
        $this->db->where('kode_surat', $id);
        $this->db->delete('verifikasi_surat');
    }
}
