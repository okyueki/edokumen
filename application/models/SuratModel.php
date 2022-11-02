<?php
class SuratModel extends CI_model
{
    public function getAllSuratKeluar()
    {
         return $this->db->not_like('kode_surat','SF')->get_where('surat', ['nik_pengirim' =>  $this->session->userdata('nik')])->result_array();
    }
    public function getSuratMasuk()
    {
         return $this->db->from('surat')->like("nik_penerima",$this->session->userdata('nik'))->get()->result_array();
    }
    public function tambahSurat($kategori)
    {
        if($kategori=="surat"){
           $count = count($this->input->post('nik_pj'));
            $penerima = implode(",", $this->input->post('nik_pj'));
            $format = 'SK' . date('Ymd');
            $db = $this->db->get_where('surat', ['nomor_surat' =>  $format])->row_array();
            $nourut = substr($db['nomor_surat'], 10, 3);
            $kodePengajuanSekarang = $nourut + 1;
                $data = [
                    "kode_surat" => "SK" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang),
                    "nomor_surat" => $this->input->post("nomor_surat"),
                    "judul_surat" => $this->input->post("judul_surat"),
                    "nik_pengirim" => $this->session->userdata('nik'),
                    "nik_penerima" => $penerima,
                    "status" => 'Belum Dibaca',
                    "tanggal" => date('Y-m-d H:i:s'),
                    "isi_surat" => $this->input->post("isi_surat")
                ];
                $this->db->insert('surat', $data);
                for($i=0 ; $i < $count; $i++){
                    $data2[$i] = [
                        "kode_surat" => "SK" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang),
                        "nik" => $this->input->post('nik_pj['.$i.']'),
                        "status_verifikasi" => "Proses Verifikasi"
                    ];
                    $this->db->insert('verifikasi_surat', $data2[$i]);
                }     
        }else{
            $jeniscutix=$this->db->get_where('jenis_cuti', ['id_jenis_cuti' =>  $this->input->post("jenis_cuti")])->row_array();
            $format = 'SF' . date('Ymd');
            $db = $this->db->get_where('surat', ['nomor_surat' =>  $format])->row_array();
            $nourut = substr($db['nomor_surat'], 10, 3);
            $kodePengajuanSekarang = $nourut + 1;
            $data = [
                "nomor_surat" => "SF" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang),
                "judul_surat" => "Cuti ".$jeniscutix['jenis_cuti'],
                "nik_pengirim" => $this->session->userdata('nik'),
                "nik_penerima" => $this->input->post("nik_pj"),
                "status" => 'Belum Dibaca',
                "tanggal" => date('Y-m-d H:i:s')
            ];
            $this->db->insert('surat', $data);
        }
    }
    public function getSuratById($id,$kategori)
    {
         if($kategori=="surat"){
            return $this->db->get_where('surat', ['kode_surat' => $id])->row_array();
         }else{
        return $this->db->get_where('surat', ['nomor_surat' => $id])->row_array();
         }
    }
    public function ubahSurat($id,$kategori)
    {
        $this->db->where('kode_surat', $id);
        $this->db->delete('verifikasi_surat');
        if($kategori=="surat"){
             $count = count($this->input->post('nik_pj'));
            $penerima = implode(",", $this->input->post('nik_pj'));
            $data = [
                "nomor_surat" => $this->input->post("nomor_surat"),
                "judul_surat" => $this->input->post("judul_surat"),
                "nik_pengirim" => $this->session->userdata('nik'),
                "nik_penerima" => $penerima,
                "tanggal" => date('Y-m-d H:i:s'),
                "isi_surat" => $this->input->post("isi_surat")
            ];
            $this->db->where('kode_surat', $id);
        $this->db->update('surat', $data);
        
        for($i=0 ; $i < $count; $i++){
            
                    $data2[$i] = [
                        "kode_surat" => $id,
                        "nik" => $this->input->post('nik_pj['.$i.']'),
                        "status_verifikasi" => "Proses Verifikasi"
                    ];
                  $this->db->insert('verifikasi_surat', $data2[$i]);
                }  
        }else{
       $jeniscutix=$this->db->get_where('jenis_cuti', ['id_jenis_cuti' =>  $this->input->post("jenis_cuti")])->row_array();
        $data = [
            "judul_surat" => "Cuti ".$jeniscutix['jenis_cuti'],
            "nik_pengirim" => $this->session->userdata('nik'),
            "nik_penerima" => $this->input->post("nik_pj"),
            "status" => 'Belum Dibaca',
            "tanggal" => date('Y-m-d H:i:s'),
        ];
         $this->db->where('nomor_surat', $id);
        $this->db->update('surat', $data);
    }
       
    }
    public function hapusSurat($id,$kategori)
    {
         if($kategori=="surat"){
            $this->db->where('kode_surat', $id);
        $this->db->delete('verifikasi_surat');
        $this->db->where('kode_surat', $id);
        $this->db->delete('surat');
         }else{
            $this->db->where('nomor_surat', $id);
        $this->db->delete('surat');
         }
    }
     public function VerifikasiSurat($id)
    {
        $data = [
            "status" => "Sudah Dibaca"
        ];
        $this->db->where('kode_surat', $id);
        $this->db->update('surat', $data);
    }
    public function getVerifikasiSuratById($id,$kategori)
    {
         if($kategori=="surat"){
            return $this->db
            ->like("nik_penerima",$this->session->userdata('nik'))
            ->get_where('surat', ['kode_surat' => $id])->row_array();
         }else{
        return $this->db->get_where('surat', ['nomor_surat' => $id])->row_array();
         }
    }
}