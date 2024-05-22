<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Transaksi extends CI_Controller {
 	function index(){
		$this->load->model("Transaksi_m", "transaksi");
		$this->load->model("Produk_m", "produk");
		
		// print_r($data['kode_trx']);
		$data['_view'] = "transaksi/index";
		$data['_js']="transaksi/js";
		$this->load->view("layout/main", $data);
	}

	function ambildata(){
		
		if($this->input->is_ajax_request()==true){
			$this->load->model('Transaksi_m','transaksi');

			$list=$this->transaksi->get_datatable();
			$data=array();

			$no = $_POST['start'];
			
			foreach($list as $field){
				$no++;
				$row=array();

				$btnEdit="<a href=".base_url('Transaksi/edit/'.$field->id_trx)." class=\"tabledit-edit-button btn btn-sm btn-warning\" style=\"float: none; margin: 5px;\"><span class=\"ti-pencil\"></span></a>";
				$btnDelete = "<button type=\"button\" class=\"btn btn-outline-danger\" title=\"Hapus Data\" onclick=\"hapus('" . $field->id_trx . "')\">
                    <i class=\"fa fa-trash\"></i>
                </button>";
				$kodeTrx="<a href=". base_url('Transaksi/open') ."/". $field->id_trx.">$field->kode_trx</a>";
				$row[]=$no;
				$row[]=$kodeTrx;
				$row[]=$field->nama_consumen;
				$row[]=$field->deskripsi;
				$row[]=$field->tanggal_trx;
				$total = "Rp " . number_format($field->total, 0, ',', '.');
				$row[]=$total;
				if ($field->status == 1) {
					$row[]= '<span class="badge badge-warning">New</span>';
				} elseif ($field->status == 2) {
					$row[]= '<span class="badge badge-secondary">Proccess</span>';
				} elseif ($field->status == 3) {
					$row[]= '<span class="badge badge-primary">Close</span>';
				}
				$row[]=$btnEdit.' '.$btnDelete;
				$data[]=$row;
			}
			$output=array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->transaksi->count_all(),
				"recordsFiltered" => $this->transaksi->count_filtered(),
				"data"=>$data,
			);
			echo json_encode($output);

		}else{
			exit('Maaf data tidak bisa ditampilkan');
		}
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

	public function edit($id){

		$this->load->model("Transaksi_m", "transaksi");
		$this->load->model("Produk_m", "produk");
		$data['kode_trx'] = $this->transaksi->getKodeTransaksi();
		$data['dataproduk'] = $this->produk->getAllProduk();
		
		$data['datatransaksi']=$this->transaksi->getDataTransaksi($id);
		$data['datatransaksidetail']=$this->transaksi->getDataTransaksiDetail($id);
		$data['jumlahdetail']=count($data['datatransaksidetail']);
		$data['_view']="transaksi/edit";
		$data['_js'] = "transaksi/editjs";
		$this->load->view("layout/main",$data);
	}

	public function kirimdataedit(){
		$this->load->model("Transaksi_m","transaksi");
		$data=$this->input->post();
		// var_dump($data['id_trx']);
		// die;
		$dataheader = [
			
			'kode_trx'			=> $data['kode_trx'],
			'nama_consumen'		=> $data['nama_consumen'],
			'deskripsi'			=> $data['deskripsi'],
			'status'			=> $data['status'],
			'total'				=> $data['total'],
		];
		$where=[
			'id_trx'			=> $data['id_trx'],
		];
		$this->transaksi->updateTransaksiHeader($where,$dataheader);
			
		$pilihproduk = $this->input->post('pilihproduk');
		$this->transaksi->deleteTransaksiDetailOld($where);
		if (count($pilihproduk) > 0) {
			foreach ($pilihproduk as $item => $value) {
				$datadetail = [
					'id_trx'			=> $data['id_trx'],
					'id_produk'			=> $data['pilihproduk'][$item],
					'harga'				=> $data['harga'][$item],
					'qty'				=> $data['qty'][$item],
					'subtotal'			=> $data['subtotal'][$item]
				];
				$this->transaksi->inputTransaksiDetailNew($where, $datadetail);
			}
		}
		redirect(base_url('Transaksi/index'));
		// $id = $data["id_trx"];
		
	}

	public function hapus()
	{
		if ($this->input->is_ajax_request() == true) {
			$this->load->model('Transaksi_m', 'transaksi');
			$id = $this->input->post('id', true);
			$hapus = $this->transaksi->delete_data($id);
			// var_dump($hapus);
			// die;
			if ($hapus) {
				$msg = [
					'sukses' => 'Transaksi berhasil terhapus'
				];
			}
			echo json_encode($msg);
		}
	}
	

	public function open($id)
	{
		// var_dump($id);
		// die;
		

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
		$data['_js'] = "transaksi/jsopen";
		$this->load->view("layout/main", $data);
	}
	public function tambahproduk(){
		

		
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
		$data['dataproduk']=$this->produk->getAllProduk();
		
		$data['_view'] = "transaksi/tambahdata1";
		$data['_js'] = "transaksi/jstambahdata1";
		$this->load->view("layout/main", $data);
	}

	public function kirimdata(){
		// var_dump($this->input->post());
		// die;
		$this->load->model('Transaksi_m', 'transaksi');
		$tgl_trx = date('Y-m-d');
		$data_trx_header = [
			'kode_trx'			=> $this->input->post('kode_trx'),
			'nama_consumen'		=> $this->input->post('nama_consumen'),
			'deskripsi'			=> $this->input->post('deskripsi'),
			'status'			=> $this->input->post('status'),
			'tanggal_trx'		=> $tgl_trx,
			'total'				=> $this->input->post('total')
		];

		$pilihproduk= $this->input->post('pilihproduk');
		$dataarray=$this->input->post();
		//INPUT DATA TRANSAKSI
		$data_header=$this->transaksi->input_data($data_trx_header, 'transaksi_header');
		$id_trx = $this->db->insert_id();
		if(count($pilihproduk)>0){
			foreach($pilihproduk as $item=>$value){
				$data_trx_detail = [
					'id_trx'			=> $id_trx,
					'id_produk'			=> $dataarray['pilihproduk'][$item],
					'harga'				=> $dataarray['harga'][$item],
					'qty'				=> $dataarray['qty'][$item],
					'subtotal'			=> $dataarray['subtotal'][$item]
				];
				$this->transaksi->tambahproduk($data_trx_detail, 'transaksi_detail');
			}	
		}
		redirect('Transaksi/index');
	}
}


