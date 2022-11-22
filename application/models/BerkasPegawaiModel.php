<?php
class BerkasPegawaiModel extends CI_model
{
    public function getDataBerkasPegawaiById()
    {
        return $this->db->select('berkas_pegawai.*, jenis_berkas.jenis_berkas')
            ->join('jenis_berkas', 'berkas_pegawai.id_jenis_berkas=jenis_berkas.id_jenis_berkas')->get_where('berkas_pegawai', ['nik_pegawai' => $this->session->userdata('nik')])->result_array();
    }

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
                $berkas=$this->db->get_where('berkas_pegawai',['nik_pegawai' => $id, 'id_jenis_berkas' => $jb['id_jenis_berkas']])->row_array();
                echo $jb['id_jenis_berkas'];
                $config['file_name'] = $_FILES['file'.$jb['id_jenis_berkas'].'']['name'];
            
                $this->upload->initialize($config);
                $this->upload->do_upload('file'.$jb['id_jenis_berkas'].'');
                $uploadData = $this->upload->data(); 
                $filename = $uploadData['file_name'];
                if(empty($berkas['nik_pegawai'])){
                 $data = [
                    "nik_pegawai" => $id,
                    "id_jenis_berkas" => $jb['id_jenis_berkas'],
                    "nomor_berkas" => $this->input->post('nomor_berkas'.$jb['id_jenis_berkas']).'',
                    "status_berkas" => $this->input->post('status_berkas'.$jb['id_jenis_berkas'].''),
                    "file" => $filename
                ];
                
                $this->db->insert('berkas_pegawai', $data);

                if($jb['masa_berlaku']=="Iya"){
                    $data2 = [
                    "nik_pegawai" => $id,
                    "id_jenis_berkas" => $jb['id_jenis_berkas'],
                    "tanggal_awal" => $this->input->post('tanggal_awal'.$jb['id_jenis_berkas']).'',
                    "tanggal_akhir" => $this->input->post('tanggal_akhir'.$jb['id_jenis_berkas'].''),
                ];
                    $this->db->insert('masa_berlaku_berkas', $data2);
                }

                }else{
                    if(empty($_FILES['file'.$jb['id_jenis_berkas'].'']['name'])){
                     $data = [
                        "nik_pegawai" => $id,
                        "id_jenis_berkas" => $jb['id_jenis_berkas'],
                        "nomor_berkas" => $this->input->post('nomor_berkas'.$jb['id_jenis_berkas']).'',
                        "status_berkas" => $this->input->post('status_berkas'.$jb['id_jenis_berkas'].'')
                    ];
                    }else{
                        $data = [
                        "nik_pegawai" => $id,
                        "id_jenis_berkas" => $jb['id_jenis_berkas'],
                        "nomor_berkas" => $this->input->post('nomor_berkas'.$jb['id_jenis_berkas']).'',
                        "status_berkas" => $this->input->post('status_berkas'.$jb['id_jenis_berkas'].''),
                        "file" => $filename
                    ];
                    }
                    $this->db->where('nik_pegawai', $id);
                    $this->db->where('id_jenis_berkas', $jb['id_jenis_berkas']);
                    $this->db->update('berkas_pegawai', $data);

                    if($jb['masa_berlaku']=="Iya"){
                        $data2 = [
                        "nik_pegawai" => $id,
                        "id_jenis_berkas" => $jb['id_jenis_berkas'],
                        "tanggal_awal" => $this->input->post('tanggal_awal'.$jb['id_jenis_berkas']).'',
                        "tanggal_akhir" => $this->input->post('tanggal_akhir'.$jb['id_jenis_berkas'].''),
                    ];
                    $this->db->where('nik_pegawai', $id);
                    $this->db->where('id_jenis_berkas', $jb['id_jenis_berkas']);
                    $this->db->update('masa_berlaku_berkas', $data2);
                    }
                }

            endforeach;
    }
}