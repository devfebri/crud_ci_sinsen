<?php

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('halaman_utama');
	}

	public function kontak()
	{
		$data['_view'] = "halaman_kontak";
		$this->load->view("layout/main", $data);
	}

	public function about()
	{
		$this->load->view('halaman_about');
	}

	public function kirim_data()
	{

		$this->form_validation->set_rules('txtnama', 'Nama', 'required');
		$this->form_validation->set_rules('txtalamat', 'Alamat', 'required');
		$this->form_validation->set_rules('txtnohp', 'Handphone', 'required');
		
		$data=[
			'nama'=>$this->input->post('txtnama'),
			'alamat'=>$this->input->post('txtalamat'),
			'nohp'=>$this->input->post('txtnohp')
		];

		if($this->form_validation->run()!=false){
			$this->load->view('halaman_output',$data);
		}else{
			$this->load->view('halaman_utama');
			
		}
	}
}
	