<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller {
	public function index()
	{
		$this->load->model("Produk_m",'produk');

		// PAGINATION
		$this->load->library('pagination');

		$config['base_url'] = 'http://[::1]/belajarcrud/Produk/index';
		$config['total_rows'] = $this->produk->countAllProduk();
		$config['per_page'] = 10;
		$config['full_tag_open'] = '<nav><ul class="pagination">';
  		$config['full_tag_close'] = ' </ul></nav>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item">';
		$config['first_tag_close'] = '</li>';

		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = '&raquo';
		$config['next_tag_open'] = '<li class="page-item">';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = '&laquo';
		$config['prev_tag_open'] = '<li class="page-item">';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li class="page-item ">';
		$config['num_tag_close'] = '</li>';

		$config['attributes'] = array('class' => 'page-link');
		// cek value
		// var_dump($config['total_rows']);
		// die;

		$this->pagination->initialize($config);
		// $limit = $config['per_page'];
		// $start = html_escape($this->input->get('per_page'));
		
		
		$data['start']=$this->uri->segment(3);
		$data['dataproduk']=$this->produk->getProduk($config['per_page'],$data['start']);

		// print_r($dataproduk);
		$data['_view']="produk/index";
		$data['_js']="produk/js";
		$this->load->view("layout/main",$data);
	}

	public function tambah()
	{
		
		$data=[
			'nama'			=>$this->input->post('nama'),
			'harga'			=> $this->input->post('harga'),
			'status'		=> $this->input->post('status'),
			'kode_produk'	=> $this->input->post('kode_produk'),
			'foto'			=> $this->input->post('foto')
		];
		$this->Produk_m->input_data($data,'produk');
		redirect('Produk/index');
	}

	public function delete($id)
	{
		$this->Produk_m->delete_data($id);
		redirect(base_url(''));
	}

	
}
