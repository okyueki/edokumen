<?php
class SuratKeluarModel extends CI_model
{
    public function getAllSuratKeluar()
    {
        return $this->db->not_like('kode_surat','SF')->order_by('id_surat', 'DESC')
        ->get_where('surat', ['nik_pengirim' =>  $this->session->userdata('nik')])->result_array();
    }
    public function tambahSuratKeluar()
    {
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
                "status" => 'Belum Dibaca',
                "tanggal" => date('Y-m-d H:i:s'),
                "isi_surat" => $this->input->post("isi_surat"),
                "lampiran" => $this->input->post("lampiran"),
                "qrcode_surat" => $image_name
            ];
                $this->db->insert('surat', $data);
            
            $data2 = [
                "kode_surat" => "SK" . date('Ymd') . sprintf('%03s', $kodePengajuanSekarang),
                "nik_penerima" => $this->input->post('nik_pj'),
                "status_verifikasi" => "Proses Verifikasi"
            ];
            $this->db->insert('verifikasi_surat', $data2);
                
    }
    public function getSuratById($id)
    {
        return $this->db->get_where('surat', ['kode_surat' => $id])->row_array();
         
    }
    public function ubahSuratKeluar($id)
    {
        $data = [
            "nomor_surat" => $this->input->post("nomor_surat"),
            "judul_surat" => $this->input->post("judul_surat"),
            "nik_pengirim" => $this->session->userdata('nik'),
            "tanggal_surat" => $this->input->post("tanggal_surat"),
            "id_sifat" => $this->input->post("sifat"),
            "tanggal" => date('Y-m-d H:i:s'),
            "lampiran" => $this->input->post("lampiran"),
            "isi_surat" => $this->input->post("isi_surat")
        ];
        $this->db->where('kode_surat', $id);
        $this->db->update('surat', $data);

        $data2 = [
            "kode_surat" => $id,
            "nik_penerima" => $this->input->post('nik_pj'),
            "status_verifikasi" => "Proses Verifikasi"
        ];
        $this->db->where('kode_surat', $id);
        $this->db->update('verifikasi_surat', $data2);
    }
    public function hapusSuratKeluar($id)
    {

        $this->db->where('kode_surat', $id);
        $this->db->delete('verifikasi_surat');
        $this->db->where('kode_surat', $id);
        $this->db->delete('surat');
    
    }
     public function getDetailSuratKeluar($id)
    {
         return $this->db->not_like('kode_surat','SF')->get_where('surat', ['nik_pengirim' =>  $this->session->userdata('nik'), 'kode_surat' =>  $id])->row_array();
    }
    public function cetakSurat($id)
    {
        return $this->db->get_where('surat', ['kode_surat' => $id])->row_array();
    }
}