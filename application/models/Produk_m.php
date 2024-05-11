<?php

class Produk_m extends CI_Model{
	var $table='produk';

	public function getAllProduk(){
		
		return $this->db->get('produk')->result_array();
	
	}
	public function getProduk($limit, $start,$carinama=null,$caristatus=null){
		
		//jika keduanya terisi
		if($carinama!=null&&$caristatus!=null)
		{
			
			// var_dump($this->db->get_where('produk',array('status'=>0))->num_rows());
			// var_dump('true');
			// die;
			$this->db->like('kode_produk',$carinama);
			return $this->db->get_where('produk', array('status' => $caristatus), $limit, $start)->result_array();

		}else{
			if($carinama==null&&$caristatus!=null){
				// jika hanya caristatus yg diisi
				return $this->db->get_where('produk',array('status'=>$caristatus), $limit, $start)->result_array();
				//fix

			}elseif($carinama != null && $caristatus == null){
				// jika hanya carinama yg diisi
				$this->db->like('kode_produk', $carinama);
				return $this->db->get('produk', $limit, $start)->result_array();
				//fix
			}else{
				return $this->db->get('produk', $limit, $start)->result_array();
				//fix
			}
		}
		
	
	}

	
	public function input_data($data)
	{
		$this->db->insert('produk', $data);
	}

	public function delete_data($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('produk');
	}

	public function countAllProduk()
	{
		return $this->db->get('produk')->num_rows();
	}

	public function edit_data($data)
	{
		$this->db->where('id', $data['id']);
		$this->db->update('produk', $data);
	}

}


