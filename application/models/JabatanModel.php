<?php
class JabatanModel extends CI_model
{
    public function getAllJabatan()
    {
        return $this->db->get('jabatan')->result_array();
    }
    public function tambahJabatan()
    {
        $data = [
            "nama_jabatan" => $this->input->post("nama_jabatan"),
        ];
        $this->db->insert('jabatan', $data);
    }
    public function getJabatanById($id)
    {
        return $this->db->get_where('jabatan', ['id_jabatan' => $id])->row_array();
    }
    public function ubahJabatan($id)
    {
        $data = [
            "nama_jabatan" => $this->input->post("nama_jabatan"),
        ];
        $this->db->where('id_jabatan', $id);
        $this->db->update('jabatan', $data);
    }
     public function hapusJabatan($id)
    {
        $this->db->where('id_jabatan', $id);
        $this->db->delete('jabatan');
    }
}