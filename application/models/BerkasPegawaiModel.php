<?php
class BerkasPegawaiModel extends CI_model
{
    public function getBerkasPegawaiById($id)
    {
        return $this->db->select('berkas_pegawai.*, jenis_berkas.jenis_berkas')
            ->join('jenis_berkas', 'berkas_pegawai.id_jenis_berkas=jenis_berkas.id_jenis_berkas')->get_where('berkas_pegawai', ['nik_pegawai' => $this->session->userdata('nik')])->result_array();
    }

    public function ubahBerkasPegawai($id)
    {
            $config['upload_path']          = './uploads/berkas/';
            $config['allowed_types']        = 'pdf';
            $config['max_size']             = 10000;
            $jenisberkas=$this->db->like('bidang', $this->input->post("bidang"))->get('jenis_berkas')->result_array();
			foreach ($jenisberkas as $jb) :
                $nama_berkas=strtolower($jb['jenis_berkas']);
                $config['file_name'] = $_FILES['file_'.$nama_berkas.'']['name'];
            
                $this->upload->initialize($config);
                $this->upload->do_upload('file_'.$nama_berkas.'');
                $uploadData = $this->upload->data(); 
                $filename = $uploadData['file_name'];

                 $data = [
                    "nik_pegawai" => $id,
                    "id_jenis_berkas" => $jb['id_jenis_berkas'],
                    "nomor_berkas" => $this->input->post('nomor_berkas_'.$nama_berkas).'',
                    "status_berkas" => $this->input->post('status_berkas_'.$nama_berkas.''),
                    "file" => $filename
                ];

                 $this->db->insert('berkas_pegawai', $data);

            endforeach;
    }
}