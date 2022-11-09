<?php
class SifatModel extends CI_model
{
    public function getAllSifat()
    {
        return $this->db->get('sifat')->result_array();
    }
    public function tambahSifat()
    {
        $data = [
            "nama_sifat" => $this->input->post("nama_sifat"),
        ];
        $this->db->insert('sifat', $data);
    }
    public function getSifatById($id)
    {
        return $this->db->get_where('sifat', ['id_sifat' => $id])->row_array();
    }
    public function ubahSifat($id)
    {
        $data = [
            "nama_sifat" => $this->input->post("nama_sifat"),
        ];
        $this->db->where('id_sifat', $id);
        $this->db->update('sifat', $data);
    }
     public function hapusSifat($id)
    {
        $this->db->where('id_sifat', $id);
        $this->db->delete('sifat');
    }
}