<?php
class SuratModel extends CI_model
{
    public function getAllSuratKeluar()
    {
         return $this->db->not_like('kode_surat','SF')
         ->get_where('surat', ['nik_pengirim' =>  $this->session->userdata('nik')])->result_array();
    }
    public function getSuratMasuk()
    {
         return $this->db->from('surat')
         ->like("nik_penerima",$this->session->userdata('nik'))
         ->or_like("nik_disposisi",$this->session->userdata('nik'))->get()->result_array();
    }
    public function getDetailSuratKeluar($id)
    {
         return $this->db->not_like('kode_surat','SF')->get_where('surat', ['nik_pengirim' =>  $this->session->userdata('nik'), 'kode_surat' =>  $id])->row_array();
    }
    public function tambahSurat($kategori)
    {
        if($kategori=="surat"){
           $count = count($this->input->post('nik_pj'));
            $penerima = implode(",", $this->input->post('nik_pj'));
            $format = 'SK' . date('Ymd');
            $db = $this->db->from('surat')->like('kode_surat', $format)->order_by('kode_surat', 'DESC')->get()->row_array();
            $nourut = substr($db['kode_surat'], 10, 3);
            $kodePengajuanSekarang = $nourut + 1;
            //echo $nourut;
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
    
            $image_name=$this->session->userdata('nik')."_SK" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang).'.png'; //buat name dari qr code sesuai dengan nim
    
            $params['data'] = "Dikeluarkan Oleh RS. Aisyiyah Siti Fatimah Tulangan, Kabupaten/Kota Sidoarjo Ditanda Tangani Secara Elektronik Oleh ".$this->session->userdata('nama')." ID "."SK" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang); //data yang akan di jadikan QR CODE
            $params['level'] = 'H'; //H=High
            $params['size'] = 10;
            $params['savename'] = FCPATH.$config['imagedir'].$image_name; //simpan image QR CODE ke folder assets/images/
            $this->ciqrcode->generate($params); // fungsi untuk generate QR CODE

                $data = [
                    "kode_surat" => "SK" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang),
                    "nomor_surat" => $this->input->post("nomor_surat"),
                    "judul_surat" => $this->input->post("judul_surat"),
                    "tanggal_surat" => $this->input->post("tanggal_surat"),
                    "id_sifat" => $this->input->post("sifat"),
                    "nik_pengirim" => $this->session->userdata('nik'),
                    "nik_penerima" => $penerima,
                    "status" => 'Belum Dibaca',
                    "tanggal" => date('Y-m-d H:i:s'),
                    "isi_surat" => $this->input->post("isi_surat"),
                    "lampiran" => $this->input->post("lampiran"),
                    "qrcode" => $image_name
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
                "nomor_surat" => "SF" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang),
                "id_sifat"=> 1,
                "judul_surat" => "Cuti ".$jeniscutix['jenis_cuti'],
                "nik_pengirim" => $this->session->userdata('nik'),
                "tanggal_surat" => date('Y-m-d'),
                "nik_penerima" => $this->input->post("nik_pj"),
                "status" => 'Belum Dibaca',
                "qrcode" => $image_name,
                "tanggal" => date('Y-m-d H:i:s')
            ];
            $this->db->insert('surat', $data);

            $data2 = [
                "kode_surat" => "SF" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang),
                "nik" => $this->input->post('nik_pj'),
                "status_verifikasi" => "Proses Verifikasi"
            ];
            $this->db->insert('verifikasi_surat', $data2);
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
                "tanggal_surat" => $this->input->post("tanggal_surat"),
                "id_sifat" => $this->input->post("sifat"),
                "tanggal" => date('Y-m-d H:i:s'),
                "lampiran" => $this->input->post("lampiran"),
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
        $this->db->where('kode_surat', $id);
        $this->db->update('surat', $data);

        $data2 = [
            "kode_surat" => $id,
            "nik" => $this->input->post('nik_pj'),
            "status_verifikasi" => "Proses Verifikasi"
        ];
       $this->db->insert('verifikasi_surat', $data2);

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
    public function getVerifikasiSuratById($id)
    {
        return $this->db->from('surat')->where('kode_surat',$id)->like("nik_penerima",$this->session->userdata('nik'))
        ->or_like("nik_disposisi",$this->session->userdata('nik'))->get()->row_array();
    }
     public function cetakSurat($id)
    {
        return $this->db->get_where('surat', ['kode_surat' => $id])->row_array();
    }
     public function cetakDisposisi($id)
    {
        return $this->db->select('surat.*, disposisi.*')
        ->join('disposisi', 'surat.kode_surat=disposisi.kode_surat')
        ->get_where('surat', ['surat.kode_surat' => $id])->row_array();
    }
    public function UpdateStatusDisposisi($id)
    {
        $penerima_disposisi = implode(",", $this->input->post('nik_disposisi'));
        $data = [
            "status" => "Disposisi",
            "nik_disposisi" => $penerima_disposisi
        ];
        $this->db->where('kode_surat', $id);
        $this->db->update('surat', $data);
    }
    public function UpdateStatusSelesai($id)
    {
        $data = [
            "status" => "Selesai",
        ];
        $this->db->where('kode_surat', $id);
        $this->db->update('surat', $data);
    }
}