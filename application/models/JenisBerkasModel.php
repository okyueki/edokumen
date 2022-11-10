<?php
class JenisBerkasModel extends CI_model
{
    public function getAllJenisBerkas()
    {
        return $this->db->get('jenis_berkas')->result_array();
    }
    public function tambahJenisBerkas()
    {
        $data = [
            "jenis_berkas" => $this->input->post("jenis_berkas"),
        ];
        $this->db->insert('jenis_berkas', $data);
    }
    public function getJenisBerkasById($id)
    {
        return $this->db->get_where('jenis_berkas', ['id_jenis_berkas' => $id])->row_array();
    }
    public function ubahJenisBerkas($id)
    {
        $data = [
            "jenis_berkas" => $this->input->post("jenis_berkas"),
        ];
        $this->db->where('id_jenis_berkas', $id);
        $this->db->update('jenis_berkas', $data);
    }
     public function hapusJenisBerkas($id)
    {
        $this->db->where('id_jenis_berkas', $id);
        $this->db->delete('jenis_berkas');
    }
}