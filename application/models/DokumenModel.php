<?php
class DokumenModel extends CI_model
{
    public function getAllDokumen()
    {
        if($this->session->userdata('hak_akses')!="User"){
             return $this->db->select('dokumen.*, lemari.nama_lemari,rak.nama_rak, jenis_dokumen.jenis_dokumen, jenis_dokumen.sifat_dokumen')->from('dokumen')
                ->join('lemari', 'dokumen.id_lemari=lemari.id_lemari')
                ->join('rak', 'dokumen.id_rak=rak.id_rak')
                ->join('jenis_dokumen', 'dokumen.id_jenis_dokumen=jenis_dokumen.id_jenis_dokumen')->get()->result_array();
        }else{
            return $this->db->select('dokumen.*, lemari.nama_lemari,rak.nama_rak, jenis_dokumen.jenis_dokumen, jenis_dokumen.sifat_dokumen')
                ->join('lemari', 'dokumen.id_lemari=lemari.id_lemari')
                ->join('rak', 'dokumen.id_rak=rak.id_rak')
                ->join('jenis_dokumen', 'dokumen.id_jenis_dokumen=jenis_dokumen.id_jenis_dokumen')->get_where('dokumen', ['jenis_dokumen.sifat_dokumen' => "Terbuka"])->result_array();
        }
    }
    public function tambahDokumen($filename)
    {
        $data = [
            "nomor_dokumen" => $this->input->post("nomor_dokumen"),
            "nama_dokumen" => $this->input->post("nama_dokumen"),
            "tanggal_mulai" => $this->input->post("tanggal_mulai"),
            "tanggal_berakhir" => $this->input->post("tanggal_berakhir"),
            "nik" => $this->session->userdata('nik'),
            "id_jenis_dokumen" => $this->input->post("jenis_dokumen"),
            "id_lemari" => $this->input->post("lemari"),
            "id_rak" => $this->input->post("rak"),
            "file" => $filename
        ];
        $this->db->insert('dokumen', $data);
               
    }
    public function getDokumenById($id)
    {
        return $this->db->get_where('dokumen', ['id_Dokumen' => $id])->row_array();
    }
    public function ubahDokumen($id,$filename)
    {
        if(empty($filename)){
            $data = [
            "nomor_dokumen" => $this->input->post("nomor_dokumen"),
            "nama_dokumen" => $this->input->post("nama_dokumen"),
            "tanggal_mulai" => $this->input->post("tanggal_mulai"),
            "tanggal_berakhir" => $this->input->post("tanggal_berakhir"),
            "nik" => $this->input->post("pegawai"),
            "id_jenis_dokumen" => $this->input->post("jenis_dokumen"),
            "id_lemari" => $this->input->post("lemari"),
            "id_rak" => $this->input->post("rak")
        ];
        }else{
        $path = './uploads/dokumen/'.$this->input->post("oldfile");
        unlink($path);
        $data = [
            "nomor_dokumen" => $this->input->post("nomor_dokumen"),
            "nama_dokumen" => $this->input->post("nama_dokumen"),
            "tanggal_mulai" => $this->input->post("tanggal_mulai"),
            "tanggal_berakhir" => $this->input->post("tanggal_berakhir"),
            "nik" => $this->input->post("pegawai"),
            "id_jenis_dokumen" => $this->input->post("jenis_dokumen"),
            "id_lemari" => $this->input->post("lemari"),
            "id_rak" => $this->input->post("rak"),
            "file" => $filename
        ];
    }
        $this->db->where('id_dokumen', $id);
        $this->db->update('dokumen', $data);
    }
     public function hapusDokumen($id)
    {
        
        $this->db->where('id_dokumen', $id);
        $this->db->delete('dokumen');
    }

    public function detailDokumenById($id)
    {
        return $this->db->select('dokumen.*, lemari.nama_lemari,rak.nama_rak, jenis_dokumen.jenis_dokumen')
            ->join('lemari', 'dokumen.id_lemari=lemari.id_lemari')
            ->join('rak', 'dokumen.id_rak=rak.id_rak')
            ->join('jenis_dokumen', 'dokumen.id_jenis_dokumen=jenis_dokumen.id_jenis_dokumen')->get_where('dokumen', ['id_Dokumen' => $id])->row_array();
    }
}