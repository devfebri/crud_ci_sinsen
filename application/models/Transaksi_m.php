<?php

class Transaksi_m extends CI_Model{

	var $table="transaksi_header";

	public function getTransaksi($limit, $start, $carinama = null, $caristatus = null){
		//jika keduanya terisi
		if ($carinama != null && $caristatus != null) {

			// var_dump($this->db->get_where('produk',array('status'=>0))->num_rows());
			// var_dump('true');
			// die;
			$this->db->like('kode_trx', $carinama);
			return $this->db->get_where('transaksi_header', array('status' => $caristatus), $limit, $start)->result_array();
		} else {
			if ($carinama == null && $caristatus != null) {
				// jika hanya caristatus yg diisi
				return $this->db->get_where('transaksi_header', array('status' => $caristatus), $limit, $start)->result_array();
				//fix

			} elseif ($carinama != null && $caristatus == null) {
				// jika hanya carinama yg diisi
				$this->db->like('kode_Trx', $carinama);
				return $this->db->order_by('id_trx', 'DESC')->get('transaksi_header', $limit, $start)->result_array();
				//fix
			} else {
				
				//fix
				return $this->db->order_by('id_trx', 'DESC')->get('transaksi_header', $limit, $start)->result_array();
			}
		}
	}

	public function getDataTransaksi($id){
		return $this->db->get_where('transaksi_header', array('id_trx' => $id))->row();
	}

	public function getDetailTransaksi($id){



		
		$this->db->select('transaksi_detail.*,produk.nama,produk.harga,produk.kode_produk');
		$this->db->from('transaksi_detail');
		$this->db->join('produk','produk.id = transaksi_detail.id_produk');
		$this->db->where('transaksi_detail.id_trx',$id);
		return $this->db->get()->result_array();
		// return $this->db->get_where('transaksi_detail', array('id_trx' => $id))->result_array();

	}

	public function getLastId(){
		return $this->db->select_max('id_trx')->get('transaksi_header')->row()->id_trx;
	}

	public function getKodeTransaksi(){
		$this->db->select('RIGHT(transaksi_header.kode_trx,5) as kode_trx', FALSE);
		$this->db->order_by('kode_trx', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('transaksi_header');
		if ($query->num_rows() <> 0) {
			$data = $query->row();
			$kode = intval($data->kode_trx) + 1;
		} else {
			$kode = 1;
		}
		$batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
		$kodetampil = "TRX" . $batas;
		return $kodetampil;  
	}

	
	public function input_data($data)
	{
		$this->db->insert('transaksi_header', $data);
	}


	public function delete_data($id)
	{
		$this->db->where('id_trx', $id);
		$this->db->delete('transaksi_header');
	}

	public function tambahproduk($data)
	{
		$this->db->insert('transaksi_detail', $data);
	}

	public function deleteproduk($id)
	{
		$this->db->where('id_detail', $id);
		$this->db->delete('transaksi_detail');
	} 

	public function total_transaksi($id_trx){
		$query = $this->db->query("SELECT SUM(subtotal) as total FROM transaksi_detail where id_trx=$id_trx");
		return $query->row_array(); 

	}

	public function updateTotalTransaksi($data)
	{
		$this->db->set('total', $data['total']);
		$this->db->where('id_trx', $data['id_trx']);
		$this->db->update('transaksi_header');
	}
}
