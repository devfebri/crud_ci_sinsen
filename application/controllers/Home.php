<?php

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('halaman_utama');
	}

	public function kontak()
	{
		$this->load->view('halaman_kontak');
	}

	public function about()
	{
		$this->load->view('halaman_about');
	}
}
