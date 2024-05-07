<?php

class Produk_m extends CI_Model{
	var $table='produk';

	public function getAllProduk(){
		
		return $this->db->get('produk')->result_array();
	
	}
	public function getProduk($limit, $start){
		
		return $this->db->get('produk',$limit,$start)->result_array();
	
	}

	
	// public function input_data($data)
	// {
	// 	$this->db->insert('produk', $data);
	// }

	// public function delete_data($id)
	// {
	// 	$this->db->where('id', $id);
	// 	$this->db->delete('produk');
	// }

	public function countAllProduk()
	{
		return $this->db->get('produk')->num_rows();
	}

}


