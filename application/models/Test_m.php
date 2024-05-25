<?php

class Test_m extends CI_Model{
	var $table = 'produk'; //nama tabel dari database
	var $column_order = array(null,null, 'kode_produk','nama', 'harga', 'status',  null); //Sesuaikan dengan field
	var $column_search = array('kode_produk', 'nama', 'harga', 'status'); //field yang diizin untuk pencarian 
	var $order = array('nama' => 'asc'); // default order 

	
	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		if($_POST['produk']!=null){
			$this->db->where('id', $_POST['produk']);
		}
		if($_POST['status']!=null){
			$this->db->where('status', $_POST['status']);
		}
		$i = 0;
		$jmlstring = 0;

		foreach ($this->column_search as $item) // looping awal
		{
			$jmlstring= strlen($_POST['search']['value']);
			if ($_POST['search']['value']) // jika datatable mengirimkan pencarian dengan metode POST
			{
				// if($jmlstring>=3|| $jmlstring == 0){
					if ($i === 0) // looping awal
					{
						$this->db->group_start();
						$this->db->like($item, $_POST['search']['value']);
					}else{
						$this->db->or_like($item, $_POST['search']['value']);
					}
					if (count($this->column_search) - 1 == $i)
						$this->db->group_end();
				// }	
			}
			$i++;
		}

		if (isset($_POST['order'])) {
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if (isset($this->order)) {
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if ($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_produk(){
		return $this->db->from('produk')->get()->result_array();
	}
	public function hapusbanyak($id, $jmldata)
	{
		for ($i = 0; $i < $jmldata; $i++) {
			$this->load->helper("file");
			$namefoto = $this->db->from('produk')->where('id', $id[$i])->get()->row()->foto;
			$path = './foto/' . $namefoto;
			if (file_exists($path)) {
				unlink($path);
			}
			$this->db->delete('produk', ['id' => $id[$i]]);
			$this->db->delete('transaksi_detail', ['id_produk' => $id[$i]]);
		}

		return true;
	}
	public function create_update_data($data)
	{
		if($data['id']){
			$this->db->where('id', $data['id']);
			$this->db->update('produk', $data);
		}else{
			$this->db->insert('produk', $data);
		}
	}

	public function hapus($id)
	{
		$this->db->delete('transaksi_detail', ['id_produk'=> $id]);
		return $this->db->delete('produk', ['id' => $id]);
	}

	public function ambildata($id)
	{
		return $this->db->get_where('produk', ['id' => $id]);
	}
}
