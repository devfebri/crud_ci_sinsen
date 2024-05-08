<?php

class Transaksi_m extends CI_Model{

	var $table="transaksi_header";

	public function getTransaksi(){
		return $this->db->get('transaksi_header')->result_array();
	}
}
