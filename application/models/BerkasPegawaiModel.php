<?php
class BerkasPegawaiModel extends CI_model
{
    public function getAllBerkasPegawai()
    {
        return $this->db->select('berkas_pegawai.*, jenis_berkas.nama_berkas')
            ->join('jenis_berkas', 'berkas_pegawai.id_berkas_pegawai=berkas_pegawai')->get_where('berkas_pegawai', ['nik' => $this->session->userdata('nik')])->result_array();
    }
    public function tambahBerkasPegawai()
    {
        $format = 'SF' . date('Ymd');
        $db = $this->db->from('surat')->like('kode_surat', $format)->order_by('kode_surat', 'DESC')->get()->row_array();
        $nourut = substr($db['nomor_surat'], 10, 3);
        $kodePengajuanSekarang = $nourut + 1;
        $data = [
            "nomor_surat" => "SF" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang),
            "nik" => $this->session->userdata('nik'),
            "id_jenis_cuti" => $this->input->post("jenis_cuti"),
            "alamat" => $this->input->post("alamat"),
            "kepentingan" => $this->input->post("kepentingan"),
            "tanggal_awal" => $this->input->post("cuti_mulai"),
            "tanggal_akhir" => $this->input->post("cuti_berakhir"),
            "jumlah" => $this->input->post("jumlah_hari"),
            "nik_pj" => $this->input->post("nik_pj"),
            "status" => 'Proses Pengajuan',
            "tanggal" => date('Y-m-d'),
            
        ];
        $this->db->insert('cuti', $data);
    }
    public function getCutiById($id)
    {
        return $this->db->get_where('cuti', ['nomor_surat' => $id])->row_array();
    }
    public function ubahCuti($id)
    {
          $data = [
            "nik" => $this->session->userdata('nik'),
            "id_jenis_cuti" => $this->input->post("jenis_cuti"),
            "alamat" => $this->input->post("alamat"),
            "kepentingan" => $this->input->post("kepentingan"),
            "tanggal_awal" => $this->input->post("cuti_mulai"),
            "tanggal_akhir" => $this->input->post("cuti_berakhir"),
            "jumlah" => $this->input->post("jumlah_hari"),
            "nik_pj" => $this->input->post("nik_pj"),
            "status" => 'Proses Pengajuan',
            "tanggal" => date('Y-m-d'),
            
        ];
        $this->db->where('nomor_surat', $id);
        $this->db->update('cuti', $data);
    }
     public function hapusCuti($id)
    {
        $this->db->where('nomor_surat', $id);
        $this->db->delete('cuti');
    }
    public function getCetakCutiById($id)
    {
        return $this->db->select('cuti.*, jenis_cuti.jenis_cuti')
            ->join('jenis_cuti', 'cuti.id_jenis_cuti=jenis_cuti.id_jenis_cuti')
            ->get_where('cuti', ['nomor_surat' => $id])->row_array();
    }
    public function getGroupByTotalCuti()
    {
        $tahun=date("Y");
        return $this->db->select('sum(cuti.jumlah) AS totalsemuacuti, jenis_cuti.jenis_cuti AS jenis_cutix')
            ->join('jenis_cuti', 'cuti.id_jenis_cuti=jenis_cuti.id_jenis_cuti')
            ->like('tanggal', $tahun)->group_by('cuti.id_jenis_cuti')->get_where('cuti', ['nik' => $this->session->userdata('nik')])->result_array();
    }
    public function VerifikasiSurat($id,$image_name)
    {
        $data = [
            "status" => $this->session->userdata('verifikasi_surat'),
            "qrcode" => $image_name,
        ];
        $this->db->where('nomor_surat', $id);
        $this->db->update('cuti', $data);
    }
}