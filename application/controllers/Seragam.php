<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seragam extends CI_Controller
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
			'content' => 'backend/seragamKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

	public function table_seragam(){

		$q = $this->md->dataTablesSeragam();

		$data  = array();
		$no    = $_POST['start'];
		foreach ($q['data'] as $da) {
			$no++;
			$row   = array();
			$row[] = '<input type="checkbox" class="data-check" value="' . $da->id . '">';
			$row[] = $no;
			$row[] = $da->nama_seragam;
			$row[] = actbtn($da->id, 'seragam');
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $q['recordTotal'],
			"recordsFiltered" => $q['recordFiltered'],
			"data" => $data,
		);

		// $q = $this->md->getAllSeragamNotDeleted();
		// $dt = [];
		// if ($q->num_rows() > 0) {
		// 	foreach ($q->result() as $row) {
		// 		$dt[] = $row;
		// 	}

		// 	$ret['status'] = true;
		// 	$ret['data'] = $dt;
		// 	$ret['message'] = '';
		// } else {
		// 	$ret['status'] = false;
		// 	$ret['data'] = [];
		// 	$ret['message'] = 'Data tidak tersedia';
		// }

		echo json_encode($output);
	}

	public function save_seragam(){
		$id = $this->input->post('id');
		$nama_seragam = $this->input->post('nama_seragam');

		$data = array(
			'nama_seragam' => $nama_seragam,

			'updated_at' => date('Y-m-d H:i:s'),
			'deleted_at' => 0
		);

		$this->form_validation->set_rules('nama_seragam', 'Nama Seragam', 'trim|required|alpha_numeric_space', array('required' => '%s harus diisi', 'alpha_numeric_space' => '%s hanya boleh mengandung huruf, angka dan spasi'));

		if ($this->form_validation->run() == FALSE) {
			$ret['status'] = false;
			foreach ($_POST as $key => $value) {
				$ret['error'][$key] = form_error($key);
			}	
		
		} else {
			if ($id) {
				$update = $this->md->updateSeragam($id, $data);
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
				$insert = $this->md->insertSeragam($data);

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
	

    public function edit_seragam()
	{

		$id = $this->input->post('id');
		$q = $this->md->getSeragamByID($id);

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

    public function delete_seragam()
	{

		$id = $this->input->post('id');
		$data['deleted_at'] = time();
		$q = $this->md->updateSeragam($id, $data);

		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}

		echo json_encode($ret);
	}


    // stok
    public function table_stok()
	{

		// $q = $this->md->getAllStokNotDeleted();
		// $dt = [];
		// if ($q->num_rows() > 0) {
		// 	foreach ($q->result() as $row) {
		// 		$dt[] = $row;
		// 	}

		// 	$ret['status'] = true;
		// 	$ret['data'] = $dt;
		// 	$ret['message'] = '';
		// } else {
		// 	$ret['status'] = false;
		// 	$ret['data'] = [];
		// 	$ret['message'] = 'Data tidak tersedia';
		// }

		$q = $this->md->dataTablesStok();

		$data  = array();
		$no    = $_POST['start'];
		foreach ($q['data'] as $da) {
			$no++;
			$row   = array();
			$row[] = '<input type="checkbox" class="data-check" value="' . $da->id . '">';
			$row[] = $no;
			$row[] = $da->nama_seragam;
			$row[] = $da->nama_tahun_pelajaran;
			$row[] = $da->ukuran;
			$row[] = $da->stok;
			$row[] = actbtn($da->id, 'stok');
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


    public function option_seragam()
	{

		$q = $this->md->getAllSeragamNotDeleted();
		$ret = '<option value="">Pilih Seragam</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$ret .= '<option value="' . $row->id . '">' . $row->nama_seragam . '</option>';
			}
		}
		echo $ret;
	}

    public function save_stok()
	{	
		$id = $this->input->post('id');
		$data['id_seragam'] = $this->input->post('id_seragam');
		$data['id_tahun_pelajaran'] = $this->input->post('id_tahun_pelajaran');
		$data['ukuran'] = $this->input->post('ukuran');
		$data['stok'] = $this->input->post('stok');

		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['deleted_at'] = 0;

		$this->form_validation->set_rules('id_seragam', 'Nama Seragam', 'trim|required', array('required' => '%s harus diisi'));
		$this->form_validation->set_rules('id_tahun_pelajaran', 'Tahun Pelajaran', 'trim|required', array('required' => '%s harus diisi'));
		$this->form_validation->set_rules('ukuran', 'Ukuran', 'trim|required', array('required' => '%s harus diisi'));
		$this->form_validation->set_rules('stok', 'Stok', 'trim|required|integer', array('required' => '%s harus diisi', 'numeric' => 'Diisi harus angka'));


		if ($this->form_validation->run() == FALSE) {
			$ret['status'] = false;
			foreach ($_POST as $key => $value) {
				$ret['error'][$key] = form_error($key);
			}
		} else {
			if ($id) {
				$update = $this->md->updateStok($id, $data);
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
				$insert = $this->md->insertStok($data);

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
	

		// if ($id) {
		// 	$q = $this->md->updateStok($id, $data);
		// 	if ($q) {
		// 		$ret['status'] = true;
		// 		$ret['message'] = 'Data berhasil diupdate';
		// 	} else {
		// 		$ret['status'] = false;
		// 		$ret['message'] = 'Data gagal diupdate';
		// 	}
		// } else {
		// 	$data['created_at'] = date('Y-m-d H:i:s');
		// 	$q = $this->md->insertStok($data);

		// 	if ($q) {
		// 		$ret['status'] = true;
		// 		$ret['message'] = 'Data berhasil disimpan';
		// 	} else {
		// 		$ret['status'] = false;
		// 		$ret['message'] = 'Data gagal disimpan';
		// 	}
		// }
    	echo json_encode($ret);
    }

    public function edit_stok()
	{

		$id = $this->input->post('id');
		$q = $this->md->getStokByID($id);

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

    public function delete_stok()
	{

		$id = $this->input->post('id');
		$data['deleted_at'] = time();
		$q = $this->md->updateStok($id, $data);

		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}

		echo json_encode($ret);
	}
}