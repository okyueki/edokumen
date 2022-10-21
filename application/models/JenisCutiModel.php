<?php
class JenisCutiModel extends CI_model
{
    public function getAllJenisCuti()
    {
        return $this->db->get('jenis_cuti')->result_array();
    }
    public function tambahJenisCuti()
    {
        $data = [
            "jenis_cuti" => $this->input->post("jenis_cuti"),
        ];
        $this->db->insert('jenis_cuti', $data);
    }
    public function getJenisCutiById($id)
    {
        return $this->db->get_where('jenis_cuti', ['id_jenis_cuti' => $id])->row_array();
    }
    public function ubahJenisCuti($id)
    {
        $data = [
            "jenis_cuti" => $this->input->post("jenis_cuti"),
        ];
        $this->db->where('id_jenis_cuti', $id);
        $this->db->update('jenis_cuti', $data);
    }
     public function hapusJenisCuti($id)
    {
        $this->db->where('id_jenis_cuti', $id);
        $this->db->delete('jenis_cuti');
    }
}