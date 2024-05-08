<?php

class Transaksi extends CI_Controller {
	public function index(){


		$this->load->model("Transaksi_m", "transaksi");
		$this->load->model("Produk_m", "produk");
		$data['datatransaksi'] = $this->transaksi->getTransaksi();
		$data['dataproduk']=$this->produk->getAllProduk();
		$data['_view'] = "transaksi/index";
		$data['_js']="transaksi/js";
		$this->load->view("layout/main", $data);
	}

	public function getProduk($data_id){
		return 
		var_dump('ok');
		die;

	}
}


