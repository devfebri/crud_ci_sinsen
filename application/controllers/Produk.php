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
		
		$data=[
			'nama'			=> $this->input->post('nama'),
			'harga'			=> $this->input->post('harga'),
			'status'		=> $this->input->post('status'),
			'kode_produk'	=> $this->input->post('kode_produk'),
			'foto'			=> $this->input->post('foto')
		];
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
		$this->Produk_m->delete_data($id);
		redirect($_SERVER['HTTP_REFERER']);
	}

	
}
