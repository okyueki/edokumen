<?php
class CutiModel extends CI_model
{
    public function getAllCuti()
    {
        return $this->db->select('cuti.*, jenis_cuti.jenis_cuti')
            ->join('jenis_cuti', 'cuti.id_jenis_cuti=jenis_cuti.id_jenis_cuti')->get_where('cuti', ['nik' => $this->session->userdata('nik')])->result_array();
    }
    public function getVeryAllCuti()
    {
        return $this->db->select('cuti.*, jenis_cuti.jenis_cuti, SUM(cuti.jumlah) AS total')
            ->join('jenis_cuti', 'cuti.id_jenis_cuti=jenis_cuti.id_jenis_cuti')->group_by("cuti.id_jenis_cuti")->get_where('cuti', ['jenis_cuti.jenis_cuti' => "Tahunan"])->result_array();
    }
    public function tambahCuti()
    {
        $format = 'SF' . date('Ymd');
        $db = $this->db->from('surat')->like('kode_surat', $format)->order_by('kode_surat', 'DESC')->get()->row_array();
        $nourut = substr($db['nomor_surat'], 10, 3);
        $kodePengajuanSekarang = $nourut + 1;
         $this->load->library('ciqrcode'); //pemanggilan library QR CODE
    
            $config['cacheable']    = true; //boolean, the default is true
            $config['cachedir']     = './assets/'; //string, the default is application/cache/
            $config['errorlog']     = './assets/'; //string, the default is application/logs/
            $config['imagedir']     = './assets/qrcode/'; //direktori penyimpanan qr code
            $config['quality']      = true; //boolean, the default is true
            $config['size']         = '1024'; //interger, the default is 1024
            $config['black']        = array(224,255,255); // array, default is array(255,255,255)
            $config['white']        = array(70,130,180); // array, default is array(0,0,0)
            $this->ciqrcode->initialize($config);
    
            $image_name=$this->session->userdata('nik')."_SF" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang).'.png'; //buat name dari qr code sesuai dengan nim
    
            $params['data'] = "Dikeluarkan Oleh RS. Aisyiyah Siti Fatimah Tulangan, Kabupaten/Kota Sidoarjo Ditanda Tangani Secara Elektronik Oleh ".$this->session->userdata('nama')." ID "."SK" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang); //data yang akan di jadikan QR CODE
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE
        $data = [
            "kode_surat" => "SF" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang),
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
            "qrcode" => $image_name
            
        ];
        $this->db->insert('cuti', $data);

        $jeniscutix=$this->db->get_where('jenis_cuti', ['id_jenis_cuti' =>  $this->input->post("jenis_cuti")])->row_array();
        $data2 = [
            "kode_surat" => "SF" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang),
            "nomor_surat" => "SF" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang),
            "id_sifat"=> 1,
            "judul_surat" => "Cuti ".$jeniscutix['jenis_cuti'],
            "nik_pengirim" => $this->session->userdata('nik'),
            "tanggal_surat" => date('Y-m-d'),
            "status" => 'Belum Dibaca',
            "qrcode_surat" => $image_name,
            "tanggal" => date('Y-m-d H:i:s')
        ];
        $this->db->insert('surat', $data2);

        $data3 = [
            "kode_surat" => "SF" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang),
            "nik_penerima" => $this->input->post('nik_pj'),
            "status_verifikasi" => "Proses Verifikasi"
        ];
        $this->db->insert('verifikasi_surat', $data3);
    }
    public function getCutiById($id)
    {
        return $this->db->get_where('cuti', ['kode_surat' => $id])->row_array();
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
        $this->db->where('kode_surat', $id);
        $this->db->update('cuti', $data);

        $jeniscutix=$this->db->get_where('jenis_cuti', ['id_jenis_cuti' =>  $this->input->post("jenis_cuti")])->row_array();
        $data2 = [
            "judul_surat" => "Cuti ".$jeniscutix['jenis_cuti'],
            "nik_pengirim" => $this->session->userdata('nik'),
            "status" => 'Belum Dibaca',
            "tanggal" => date('Y-m-d H:i:s'),
        ];
        $this->db->where('kode_surat', $id);
        $this->db->update('surat', $data2);

        $data3 = [
            "kode_surat" => $id,
            "nik_penerima" => $this->input->post('nik_pj'),
            "status_verifikasi" => "Proses Verifikasi"
        ];
        $this->db->where('kode_surat', $id);
        $this->db->update('verifikasi_surat', $data3);
    }
     public function hapusCuti($id)
    {
        $this->db->where('kode_surat', $id);
        $this->db->delete('cuti');
        $this->db->where('kode_surat', $id);
        $this->db->delete('surat');
    }
    public function getCetakCutiById($id)
    {
        return $this->db->select('cuti.*, jenis_cuti.jenis_cuti')
            ->join('jenis_cuti', 'cuti.id_jenis_cuti=jenis_cuti.id_jenis_cuti')
            ->get_where('cuti', ['kode_surat' => $id])->row_array();
    }
    public function getGroupByTotalCuti($id)
    {
        $tahun=date("Y");
        return $this->db->select('sum(cuti.jumlah) AS totalsemuacuti, jenis_cuti.jenis_cuti AS jenis_cutix')
            ->join('jenis_cuti', 'cuti.id_jenis_cuti=jenis_cuti.id_jenis_cuti')
            ->like('tanggal', $tahun)->group_by('cuti.id_jenis_cuti')->get_where('cuti', ['kode_surat' => $id])->result_array();
    }
    public function getGroupByTotalCutiAll()
    {
        $tahun=date("Y");
        return $this->db->select('sum(cuti.jumlah) AS totalsemuacuti, jenis_cuti.jenis_cuti AS jenis_cutix')
            ->join('jenis_cuti', 'cuti.id_jenis_cuti=jenis_cuti.id_jenis_cuti')
            ->like('tanggal', $tahun)->group_by('cuti.id_jenis_cuti')->get_where('cuti', ['nik' => $this->session->userdata('nik')])->result_array();
    }
    public function VerifikasiSurat($id)
    {
        $data = [
            "status" => $this->input->post('verifikasi_surat')
        ];
        $this->db->where('kode_surat', $id);
        $this->db->update('cuti', $data);
    }
}