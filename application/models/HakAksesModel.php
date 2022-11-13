<?php
class HakAksesModel extends CI_model
{
    public function getAllHakAkses()
    {
        return $this->db->select('hak_akses.*, unit.nama_unit')->join('unit', 'unit.id_unit=hak_akses.id_unit')
        ->get('hak_akses')->result_array();
    }
    public function tambahHakAkses()
    {
        $data = [
            "nik" => $this->input->post("nik"),
            "password" => $this->input->post("password"),
            "hak_akses" => $this->input->post("hak_akses"),
            "id_unit" => $this->input->post("unit")
        ];
        $this->db->insert('hak_akses', $data);
    }
    public function getHakAksesById($id)
    {
        return $this->db->get_where('hak_akses', ['id_hak_akses' => $id])->row_array();
    }
    public function ubahHakAkses($id)
    {
        $data = [
            "nik" => $this->input->post("nik"),
            "password" => $this->input->post("password"),
            "hak_akses" => $this->input->post("hak_akses"),
            "id_unit" => $this->input->post("unit")
        ];
        $this->db->where('id_hak_akses', $id);
        $this->db->update('hak_akses', $data);
    }
     public function hapusHakAkses($id)
    {
        $this->db->where('id_hak_akses', $id);
        $this->db->delete('hak_akses');
    }
}