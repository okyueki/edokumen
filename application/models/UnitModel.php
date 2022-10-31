<?php
class UnitModel extends CI_model
{
    public function getAllUnit()
    {
        return $this->db->get('unit')->result_array();
    }
    public function tambahUnit()
    {
        $data = [
            "nama_unit" => $this->input->post("nama_unit"),
        ];
        $this->db->insert('unit', $data);
    }
    public function getUnitById($id)
    {
        return $this->db->get_where('unit', ['id_unit' => $id])->row_array();
    }
    public function ubahUnit($id)
    {
        $data = [
            "nama_unit" => $this->input->post("nama_unit"),
        ];
        $this->db->where('id_unit', $id);
        $this->db->update('unit', $data);
    }
     public function hapusUnit($id)
    {
        $this->db->where('id_unit', $id);
        $this->db->delete('unit');
    }
}