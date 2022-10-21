<?php
class RakModel extends CI_model
{
    public function getAllRak()
    {
        return $this->db->get('rak')->result_array();
    }
    public function tambahRak()
    {
        $data = [
            "nama_rak" => $this->input->post("nama_rak"),
        ];
        $this->db->insert('rak', $data);
    }
    public function getRakById($id)
    {
        return $this->db->get_where('rak', ['id_rak' => $id])->row_array();
    }
    public function ubahRak($id)
    {
        $data = [
            "nama_rak" => $this->input->post("nama_rak"),
        ];
        $this->db->where('id_rak', $id);
        $this->db->update('rak', $data);
    }
     public function hapusRak($id)
    {
        $this->db->where('id_rak', $id);
        $this->db->delete('rak');
    }
}