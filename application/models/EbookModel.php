<?php
class EbookModel extends CI_model
{
    public function getAllEbook()
    {
        return $this->db2->select('kode_ebook,judul_ebook,jml_halaman,berkas')->get('perpustakaan_ebook')->result_array();
    }
}