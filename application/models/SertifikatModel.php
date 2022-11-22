<?php
class SertifikatModel extends CI_model
{
   public function getDataSertifikatByNIK()
    {
        return $this->db->get_where('sertifikat', ['nik_pegawai' => $this->session->userdata('nik')])->result_array();
    }
    public function getSertifikatByNIK($id)
    {
        return $this->db->get_where('sertifikat', ['nik_pegawai' => $id])->result_array();
    }
    public function tambahSertifikat($id, $filename)
    {
        $data = [
            "nik_pegawai" => $id,
            "nomor_sertifikat" => $this->input->post("nomor_sertifikat"),
            "nama_sertifikat" => $this->input->post("nama_sertifikat"),
            "tanggal_pelaksanaan" => $this->input->post("tanggal_pelaksanaan"),
            "tempat_pelaksanaan" => $this->input->post("tempat_pelaksanaan"),
            "file" => $filename,
        ];
        $this->db->insert('sertifikat', $data);
    }
     public function getSertifikatById($id,$nik)
    {
        return $this->db->get_where('sertifikat', ['id_sertifikat' => $id, 'nik_pegawai' => $nik])->row_array();
    }
    public function ubahSertifikat($id, $nik, $filename)
    {
        $data = [
            "nik_pegawai" => $nik,
            "nomor_sertifikat" => $this->input->post("nomor_sertifikat"),
            "nama_sertifikat" => $this->input->post("nama_sertifikat"),
            "tanggal_pelaksanaan" => $this->input->post("tanggal_pelaksanaan"),
            "tempat_pelaksanaan" => $this->input->post("tempat_pelaksanaan"),
            "file" => $filename
        ];
        $this->db->where('id_sertifikat', $id);
        $this->db->update('sertifikat', $data);
    }
    public function hapusSertifikat($id,$nik)
    {
        $this->db->where('id_sertifikat', $id);
        $this->db->where('nik_pegawai', $nik);
        $this->db->delete('sertifikat');
    }
}