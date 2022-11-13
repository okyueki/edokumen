<?php
class BidangModel extends CI_model
{
    public function getAllBidang()
    {
        return $this->db2->get('bidang')->result_array();
    }
}