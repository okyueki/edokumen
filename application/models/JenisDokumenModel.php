<?php
class JenisDokumenModel extends CI_model
{
    public function getAllJenisDokumen()
    {
        return $this->db->get('jenis_dokumen')->result_array();
    }
    public function tambahJenisDokumen()
    {
        $data = [
            "jenis_dokumen" => $this->input->post("jenis_dokumen"),
            "sifat_dokumen" => $this->input->post("sifat_dokumen")
        ];
        $this->db->insert('jenis_dokumen', $data);
    }
    public function getJenisDokumenById($id)
    {
        return $this->db->get_where('jenis_dokumen', ['id_jenis_dokumen' => $id])->row_array();
    }
    public function ubahJenisDokumen($id)
    {
        $data = [
            "jenis_dokumen" => $this->input->post("jenis_dokumen"),
            "sifat_dokumen" => $this->input->post("sifat_dokumen")
        ];
        $this->db->where('id_jenis_dokumen', $id);
        $this->db->update('jenis_dokumen', $data);
    }
     public function hapusJenisDokumen($id)
    {
        $this->db->where('id_jenis_dokumen', $id);
        $this->db->delete('jenis_dokumen');
    }
}