<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi extends CI_Controller {
	public function index(){
		$this->load->model("Transaksi_m", "transaksi");
		$this->load->model("Produk_m", "produk");
		// PAGINATION
		$this->load->library('pagination');

		if ($this->input->post('submit')) {
			$data['carikodetrx'] = $this->input->post('carikodetrx');
			$data['caristatus'] = $this->input->post('caristatus');

			$this->session->set_userdata('carikodetrx', $data['carikodetrx']);
			$this->session->set_userdata('caristatus', $data['caristatus']);
			// var_dump($this->input->post('caristatus'));
			// die;
		} else {
			$data['carikodetrx'] = $this->session->userdata('carikodetrx');
			$data['caristatus'] = $this->session->userdata('caristatus');
		}
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows'] = $config['total_rows'];
		$config['per_page'] = 10;


		$this->pagination->initialize($config);

		$data['start'] = $this->uri->segment(3);
		$data['datatransaksi'] = $this->transaksi->getTransaksi($config['per_page'], $data['start'], $data['carikodetrx'], $data['caristatus']);
		$data['dataproduk']=$this->produk->getAllProduk();
		$data['kode_trx']=$this->transaksi->getKodeTransaksi();
		// print_r($data['kode_trx']);
		$data['_view'] = "transaksi/index";
		$data['_js']="transaksi/js";
		$this->load->view("layout/main", $data);
	}

	

	public function getProduk(){
		$id_data=$_POST['id_data'];
		$s="SELECT * FROM produk WHERE id='$id_data'";
		$res=$this->db->query($s)->row_array();

		echo json_encode($res);

	}

	public function getSubtotal(){
		$qty=$_POST['qty'];
		$harga=$_POST['harga'];
		$hasil=$qty*$harga;
		echo json_encode($hasil);
	}

	public function tambah(){
		$this->load->model("Transaksi_m", "transaksi");
		$tgl_trx= date('Y-m-d');
		
		$data = [
			'kode_trx'			=> $this->input->post('kode_trx'),
			'nama_consumen'		=> $this->input->post('nama_consumen'),
			'deskripsi'			=> $this->input->post('deskripsi'),
			'status'			=> $this->input->post('status'),
			'tanggal_trx'		=> $tgl_trx,
			'total'				=> 0
		];
		
		$this->transaksi->input_data($data, 'transaksi_header');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete($id)
	{
		$this->load->model("Transaksi_m", "transaksi");
		$this->transaksi->delete_data($id);
		redirect($_SERVER['HTTP_REFERER']);
	}
	

	public function open($id)
	{
		$this->load->model("Transaksi_m", "transaksi");
		$this->load->model("Produk_m", "produk");




		
		$data['dataproduk'] = $this->produk->getAllProduk();
		$data['datatransaksi'] = $this->transaksi->getDataTransaksi($id);
		$data['datadetailtransaksi'] = $this->transaksi->getDetailTransaksi($id);

		$data['nama_consumen'] = $data['datatransaksi']->nama_consumen;
		$data['kode_trx'] = $data['datatransaksi']->kode_trx;
		$data['deskripsi'] = $data['datatransaksi']->deskripsi;
		$data['tanggal'] = $data['datatransaksi']->tanggal_trx;

		// print_r($data['datatransaksi']->status);
		if ($data['datatransaksi']->status == 1) {
			$data['status'] = 'New';
		} elseif ($data['datatransaksi']->status == 2) {
			$data['status'] = 'Proccess';
		} elseif ($data['datatransaksi']->status == 3) {
			$data['status'] = 'Close';
		}
		// $data['status']= $data['datatransaksi']->status;
		$data['id_trx']=$id;
		$data['total'] = $data['datatransaksi']->total;
		// print_r($data['datatransaksi'][0]['nama_consumen']);
		$data['_view'] = "transaksi/open";
		$data['_js'] = "transaksi/js";
		$this->load->view("layout/main", $data);
	}
	public function tambahproduk(){
		$this->load->model('Transaksi_m','transaksi');
		$qty= $this->input->post('qty');
		$harga= $this->input->post('harga');
		$id_trx= $this->input->post('id_trx');
		$subtotal=$harga*$qty;
		// var_dump($subtotal=$harga*$qty);

		// die;
		$data=[
			'id_trx'			=> $id_trx,
			'id_produk'			=>$this->input->post('pilihproduk'),
			'harga'				=>$harga,
			'qty'				=>$qty,
			'subtotal'			=>$subtotal
		];


		$this->transaksi->tambahproduk($data,'transaksi_detail');
		$data['total']=$this->transaksi->total_transaksi($id_trx)['total'];
		$this->transaksi->updateTotalTransaksi($data);
		// var_dump($total);
		// die;
		redirect ($_SERVER['HTTP_REFERER']);


	}

	public function deleteproduk($id)
	{
		$this->load->model("Transaksi_m", "transaksi");
		$id_trx= $this->db->get_where('transaksi_detail', array('id_detail' => $id))->row()->id_trx;
		// var_dump($id_trx);
		// die;

		// $this->transaksi->deleteproduk($id);
		// $data['id_trx']=$id_trx;
		// $data['total'] = $this->transaksi->total_transaksi($data['id_trx'])['total'];
		// $this->transaksi->updateTotalTransaksi($data);
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function tambahdata1(){
		$this->load->model("Transaksi_m", "transaksi");
		$this->load->model("Produk_m", "produk");
		$data['kode_trx'] = $this->transaksi->getKodeTransaksi();
		$data['_view'] = "transaksi/tambahdata1";
		$data['_js'] = "transaksi/jstambahdata1";
		$this->load->view("layout/main", $data);
	}

	public function kirimdata(){
		var_dump($this->input->post());
		die;
	}
}


