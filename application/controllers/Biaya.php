<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biaya extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Masterdata_model', 'md');
		$this->load->helper('actionbtn');
	}

	public function index()
	{

		$data = array(
			'menu' => 'backend/menu',
			'content' => 'backend/biayaKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}
	

    public function table_biaya(){

		$q = $this->md->dataTablesBiaya();

		$data  = array();
		$no    = $_POST['start'];
		foreach ($q['data'] as $da) {
			$no++;
			$row   = array();
			$row[] = '<input type="checkbox" class="data-check" value="' . $da->id . '">';
			$row[] = $no;
			$row[] = $da->nama_biaya;
			$row[] = $da->deskripsi;
			$row[] = actbtn($da->id, 'biaya');
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $q['recordTotal'],
			"recordsFiltered" => $q['recordFiltered'],
			"data" => $data,
		);

		

		echo json_encode($output);
	}

    public function save_biaya()
	{	
		$id = $this->input->post('id');
		$data['nama_biaya'] = $this->input->post('nama_biaya');
		$data['deskripsi'] = $this->input->post('deskripsi');

		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['deleted_at'] = 0;

		$this->form_validation->set_rules('nama_biaya', 'Nama Biaya', 'trim|required|alpha_numeric_spaces', array('required' => '%s harus diisi', 'alpha_numeric_spaces' => '%s hanya boleh mengandung huruf, angka dan spasi'));
		$this->form_validation->set_rules('deskripsi', 'Deskripsi', 'trim|required', array('required' => '%s harus diisi'));

		if ($this->form_validation->run() == FALSE) {
			$ret['status'] = false;
			foreach ($_POST as $key => $value) {
				$ret['error'][$key] = form_error($key);
			}
			
			
			} else {
				if ($id) {
					$update = $this->md->updateBiaya($id, $data);
					if ($update) {
						$ret = array(
							'status' => true,
							'message' => 'Data berhasil diupdate'
						);
					} else {
						$ret = array(
							'status' => false,
							'message' => 'Data gagal diupdate'
						);
					}
				} else {
					$data['created_at'] = date('Y-m-d H:i:s');
					$insert = $this->md->insertBiaya($data);

					if ($insert) {
						$ret = array(
							'status' => true,
							'message' => 'Data berhasil disimpan'
						);
					} else {
						$ret = array(
							'status' => false,
							'message' => 'Data gagal disimpan'
						);
					}
				}
		}
		echo json_encode($ret);
	}

    public function edit_biaya()
	{

		$id = $this->input->post('id');
		$q = $this->md->getBiayaByID($id);

		if ($q->num_rows() > 0) {
			$ret = array(
				'status' => true,
				'data' => $q->row(),
				'message' => '',
			);
		} else {
			$ret = array(
				'status' => false,
				'data' => [],
				'message' => 'Data tidak ditemukan',
				'query' => $this->db->last_query()
			);
		}

		echo json_encode($ret);
	}

    public function delete_biaya()
	{

		$id = $this->input->post('id');
		$data['deleted_at'] = time();
		$q = $this->md->updateBiaya($id, $data);

		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}

		echo json_encode($ret);
	}


    //harga biaya

	public function table_harga_biaya(){
		
		$q = $this->md->dataTablesHargaBiaya();

		$data  = array();
		$no    = $_POST['start'];
		foreach ($q['data'] as $da) {
			$no++;
			$row   = array();
			$row[] = '<input type="checkbox" class="data-check" value="' . $da->id . '">';
			$row[] = $no;
			$row[] = $da->nama_biaya;
			$row[] = $da->nama_tahun_pelajaran;
			$row[] = $da->harga;
			$row[] = actbtn($da->id, 'harga_biaya');
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $q['recordTotal'],
			"recordsFiltered" => $q['recordFiltered'],
			"data" => $data,
		);
		

		echo json_encode($output);
	}

	public function save_harga_biaya(){
		$id = $this->input->post('id');
		$data['id_biaya'] = $this->input->post('id_biaya');
		$data['id_tahun_pelajaran'] = $this->input->post('id_tahun_pelajaran');
		$data['harga'] = $this->input->post('harga');

		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['deleted_at'] = 0;

		$this->form_validation->set_rules('id_biaya', 'Nama Biaya', 'trim|required', array('required' => '%s harus diisi'));
		$this->form_validation->set_rules('id_tahun_pelajaran', 'Tahun Jurusan', 'trim|required', array('required' => '%s harus diisi'));
		$this->form_validation->set_rules('harga', 'Harga', 'trim|required|regex_match[/^Rp\s\d{1,3}(\.\d{3})*$/]', array('required' => '%s harus diisi', 'regex_match' => 'Format Harga salah.'));

		if ($this->form_validation->run() == FALSE) {
			$ret['status'] = false;
			foreach ($_POST as $key => $value) {
				$ret['error'][$key] = form_error($key);
			}
			
			
			} else {
				if ($id) {
					$update = $this->md->updateHargaBiaya($id, $data);
					if ($update) {
						$ret = array(
							'status' => true,
							'message' => 'Data berhasil diupdate'
						);
					} else {
						$ret = array(
							'status' => false,
							'message' => 'Data gagal diupdate'
						);
					}
				} else {
					$data['created_at'] = date('Y-m-d H:i:s');
					$insert = $this->md->insertHargaBiaya($data);

					if ($insert) {
						$ret = array(
							'status' => true,
							'message' => 'Data berhasil disimpan'
						);
					} else {
						$ret = array(
							'status' => false,
							'message' => 'Data gagal disimpan'
						);
					}
				}
		}
		echo json_encode($ret);
	}

	public function edit_harga_biaya(){
		$id = $this->input->post('id');
		$q = $this->md->getHargaBiayaByID($id);
		if ($q->num_rows() > 0) {
			$ret['status'] = true;
			$ret['data'] = $q->row();
			$ret['message'] = '';
		} else {
			$ret['status'] = false;
			$ret['data'] = [];
			$ret['message'] = 'Data tidak tersedia';
		}
		echo json_encode($ret);
	}

	public function delete_harga_biaya(){
		$id = $this->input->post('id');
		$data['deleted_at'] = time();
		$q = $this->md->updateHargaBiaya($id, $data);
		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}
		echo json_encode($ret);
	}

	public function option_biaya(){
		$q = $this->md->getBiayaNotDeleted();
		$opt = '<option value="">Pilih Jenis Biaya</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$opt .= '<option value="' . $row->id . '">' . $row->nama_biaya . '</option>';
			}
		}
		echo $opt;
	}

	public function option_tahun_pelajaran()
	{
		$q = $this->md->getAllTahunPelajaranNotDeleted();
		$ret = '<option value="">Pilih Tahun Pelajaran</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$ret .= '<option value="' . $row->id . '">' . $row->nama_tahun_pelajaran . '</option>';
			}
		}
		echo $ret;
	}



   
}