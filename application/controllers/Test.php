<?php

class Test extends CI_Controller {
	
	function index(){


		$data['_view'] = "test/index";
		$data['_js'] = "test/js";
		$this->load->model("Test_m","test");
		$data['produk']=$this->test->get_produk();
		$this->load->view("layout/main", $data);

	}	
	function ambildata(){
		
		if ($this->input->is_ajax_request() == true) {
			$this->load->model('Test_m', 'test');

			$list = $this->test->get_datatables();
			$data = array();
			
			$no = $_POST['start'];
			
			foreach ($list as $field) {

				$no++;
				$row = array();

				// Membuat Tombol
				$tomboledit = "<button type=\"button\" class=\"btn btn-outline-info\" title=\"Edit Data\" onclick=\"edit('" . $field->id . "')\">
                    <i class=\"fa fa-tags\"></i>
                </button>";
				$tombolhapus = "<button type=\"button\" class=\"btn btn-outline-danger\" title=\"Hapus Data\" onclick=\"hapus('" . $field->id . "')\">
                    <i class=\"fa fa-trash\"></i>
                </button>";

				$image= "<img src='".base_url()."foto/" . $field->foto . "' width='100'>";

				$row[] = "<input type=\"checkbox\" class=\"centangId\" value=\"$field->id\" name=\"id[]\">";
				$row[] = $no;
				$row[] = $field->kode_produk;
				$row[] = $field->nama;
				$row[] = $field->harga;
				if($field->status==1){
					$row[] = 'Ya';
				}else{
					$row[] = 'Tidak';
				}
				$row[] = $image;
				$row[] = $tomboledit . ' ' . $tombolhapus;
				$data[] = $row;
			}

			$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->test->count_all(),
				"recordsFiltered" => $this->test->count_filtered(),
				"data" => $data,
			);
			//output dalam format JSON
			echo json_encode($output);
		} else {
			exit('Maaf data tidak bisa ditampilkan');
		}
	}

	public function formedit()
	{
		$this->load->model("Test_m", "test");
		if ($this->input->is_ajax_request() == true) {
			$id = $this->input->post('id', true);
			$ambildata = $this->test->ambildata($id);
			if ($ambildata->num_rows() > 0) {
				$row = $ambildata->row_array();
				$data = [
					'id' => $id,
					'nama' => $row['nama'],
					'harga' => $row['harga'],
					'status' => $row['status'],
					'kode_produk' => $row['kode_produk'],
					'foto' => $row['foto']
				];
				echo json_encode($data);
			}
		}
	}
	public function hapus()
    {
        if ($this->input->is_ajax_request() == true) {
			$this->load->model('Test_m', 'test');
            $id = $this->input->post('id', true);
			$this->load->helper("file");
			$namefoto = $this->db->from('produk')->where('id', $id)->get()->row()->foto;
			// var_dump($namefoto);
			// die;
			$path = './foto/' . $namefoto;
			// @unlink($path);
			// $path= './foto/'+$namefoto;
			if (file_exists($path)) {
				unlink($path);
			}
            $hapus = $this->test->hapus($id);

            if ($hapus) {
                $msg = [
                    'sukses' => 'Produk berhasil terhapus'
                ];
            }
            echo json_encode($msg);
        }
    }

	public function deletemultiple()
	{
		if ($this->input->is_ajax_request() == true) {
			$this->load->model('Test_m', 'test');
			$id = $this->input->post('id', true);
			$jmldata = count($id);

			$hapusdata = $this->test->hapusbanyak($id, $jmldata);

			if ($hapusdata == true) {
				$msg = [
					'sukses' => "$jmldata data produk berhasil terhapus"
				];
			}
			echo json_encode($msg);
		} else {
			exit('Maaf tidak bisa dilanjutkan');
		}
	}

	public function simpandata()
	{
		$this->load->model("Test_m", "test");
		$idproduk= $this->input->post('id');
		if ($idproduk) {

			// EDIT
			if (isset($_FILES['foto']['name'])) {
				$config['upload_path']          = './foto/';
				$config['allowed_types']        = 'gif|jpg|png|PNG';
				$config['max_size']             = 10000;
				$config['max_width']            = 10000;
				$config['max_height']           = 10000;
				$this->load->library('upload', $config);
				
				if (!$this->upload->do_upload('foto')) {
					$data = [
						'id'			=> $this->input->post('id'),
						'nama'			=> $this->input->post('nama'),
						'harga'			=> $this->input->post('harga'),
						'status'		=> $this->input->post('status'),
						'kode_produk'	=> $this->input->post('kode_produk')
					];
				} else {
					$this->load->helper("file");
					$namefoto = $this->db->from('produk')->where('id', $idproduk)->get()->row()->foto;
					$path = './foto/' . $namefoto;
					if (file_exists($path)) {
						unlink($path);
					}

					$foto = $this->upload->data();
					$foto = $foto['file_name'];
					$data = [
						'id'			=> $this->input->post('id'),
						'nama'			=> $this->input->post('nama'),
						'harga'			=> $this->input->post('harga'),
						'status'		=> $this->input->post('status'),
						'kode_produk'	=> $this->input->post('kode_produk'),
						'foto'			=> $foto
					];
				}
			}
			
		}else{
			// TAMBAH
			if (isset($_FILES['foto']['name'])) {
				$config['upload_path']          = './foto/';
				$config['allowed_types']        = 'gif|jpg|png|PNG';
				$config['max_size']             = 10000;
				$config['max_width']            = 10000;
				$config['max_height']           = 10000;
				$this->load->library('upload', $config);
				if (!$this->upload->do_upload('foto')) {
					echo 'gagal tambah';
				} else {
					$foto = $this->upload->data();
					$foto = $foto['file_name'];
					$data = [
						'id'			=> null,
						'nama'			=> $this->input->post('nama'),
						'harga'			=> $this->input->post('harga'),
						'status'		=> $this->input->post('status'),
						'kode_produk'	=> $this->input->post('kode_produk'),
						'foto'			=> $foto
					];
				}
			}
		}
		$this->test->create_update_data($data, 'test');
		$msg = [
			'sukses' => 'data produk berhasil disimpan'
		];
		echo json_encode($msg);
	}
}
