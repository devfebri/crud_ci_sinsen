<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	public function index()
	{
		$this->load->model("Produk_m",'produk');

		// PAGINATION
		$this->load->library('pagination');

		if($this->input->post('submit')){
			$data['carinama']=$this->input->post('carinama');
			$data['caristatus']=$this->input->post('caristatus');

			$this->session->set_userdata('carinama',$data['carinama']);
			$this->session->set_userdata('caristatus',$data['caristatus']);
			// var_dump($this->input->post('caristatus'));
			// die;
		}else{
			$data['carinama']=$this->session->userdata('carinama');
			$data['caristatus']= $this->session->userdata('caristatus');
		}

		$this->db->like('nama', $data['carinama']);
		$this->db->like('status', $data['caristatus']);
		$this->db->from('produk');
		$config['total_rows'] = $this->db->count_all_results();
		$data['total_rows']=$config['total_rows'];
		$config['per_page'] = 10;

		// cek value
		// var_dump($config['total_rows']);
		// die;

		$this->pagination->initialize($config);
		// $limit = $config['per_page'];
		// $start = html_escape($this->input->get('per_page'));
		
		
		$data['start']=$this->uri->segment(3);
		$data['dataproduk']=$this->produk->getProduk($config['per_page'],$data['start'],$data['carinama'],$data['caristatus']);

		// print_r($dataproduk);
		$data['_view']="produk/index";
		$data['_js']="produk/js";
		$this->load->view("layout/main",$data);
	}

	public function tambah()
	{
		$config['upload_path']          = './foto/';
		$config['allowed_types']        = 'gif|jpg|png|PNG';
		$config['max_size']             = 10000;
		$config['max_width']            = 10000;
		$config['max_height']           = 10000;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('foto')) {
			echo 'gagal tambah';
		} else {
			$foto=$this->upload->data();
			$foto=$foto['file_name'];
			
			$data = [
				'nama'			=> $this->input->post('nama'),
				'harga'			=> $this->input->post('harga'),
				'status'		=> $this->input->post('status'),
				'kode_produk'	=> $this->input->post('kode_produk'),
				'foto'			=> $foto
			];
		}

		
		$this->Produk_m->input_data($data,'produk');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function edit(){
		$data = [
			'id'			=> $this->input->post('id'),
			'nama'			=> $this->input->post('nama'),
			'harga'			=> $this->input->post('harga'),
			'status'		=> $this->input->post('status'),
			'kode_produk'	=> $this->input->post('kode_produk'),
			'foto'			=> $this->input->post('foto')
		];
		
		$this->Produk_m->edit_data($data, 'produk');
		redirect($_SERVER['HTTP_REFERER']);
	}

	public function delete($id)
	{
		$this->load->helper("file");
		$namefoto=$this->db->from('produk')->where('id',$id)->get()->row()->foto;
		// var_dump($namefoto);
		// die;
		$path = './foto/'.$namefoto;
		// @unlink($path);
		// $path= './foto/'+$namefoto;
		if(file_exists($path)){
			unlink($path);
		}
		$this->Produk_m->delete_data($id);
		redirect($_SERVER['HTTP_REFERER']);
	}

	
}
