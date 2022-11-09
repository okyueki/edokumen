<?php
class LemariModel extends CI_model
{
    public function getAllLemari()
    {
        return $this->db->get('lemari')->result_array();
    }
    public function tambahLemari()
    {
        $data = [
            "nama_lemari" => $this->input->post("nama_lemari"),
        ];
        $this->db->insert('lemari', $data);
    }
    public function getLemariById($id)
    {
        return $this->db->get_where('lemari', ['id_lemari' => $id])->row_array();
    }
    public function ubahLemari($id)
    {
        $data = [
            "nama_lemari" => $this->input->post("nama_lemari"),
        ];
        $this->db->where('id_lemari', $id);
        $this->db->update('lemari', $data);
    }
     public function hapusLemari($id)
    {
        $this->db->where('id_lemari', $id);
        $this->db->delete('lemari');
    }
}