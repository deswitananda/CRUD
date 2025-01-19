<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Biaya extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Masterdata_model', 'md');
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
	

	// Data Biaya
    public function table_biaya(){
		$q = $this->md->getAllBiayaNotDeleted();
		$dt = [];
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$dt[] = $row;
			}

			$ret['status'] = true;
			$ret['data'] = $dt;
			$ret['message'] = '';
		} else {
			$ret['status'] = false;
			$ret['data'] = [];
			$ret['message'] = 'Data tidak tersedia';
		}

		echo json_encode($ret);
	}

    public function save_biaya(){	
		$id = $this->input->post('id');
		$data['nama_biaya'] = $this->input->post('nama_biaya');
		$data['deskripsi'] = $this->input->post('deskripsi');

		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['deleted_at'] = 0;

		if ($data['nama_biaya']) {
			$cek = $this->md->cekBiayaDuplicate($data['nama_biaya'], $id);
			if ($cek->num_rows() > 0) {
				$ret['status'] = false;
				$ret['message'] = 'Nama Biaya sudah ada';
				$ret['query'] = $this->db->last_query();
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
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data tidak boleh kosong';
            $ret['query'] = $this->db->last_query();
		}
		echo json_encode($ret);
	}

    public function edit_biaya(){
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

    public function delete_biaya(){
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


    // Data Harga Biaya
	public function table_harga_biaya(){
		$q = $this->md->getAllHargaBiaya();
		$dt = [];
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$dt[] = $row;
			}

			$ret['status'] = true;
			$ret['data'] = $dt;
			$ret['message'] = '';
		} else {
			$ret['status'] = false;
			$ret['data'] = [];
			$ret['message'] = 'Data tidak tersedia';
		}

		echo json_encode($ret);
	}

	public function save_harga_biaya(){
		$id = $this->input->post('id');
		$data['id_biaya'] = $this->input->post('id_biaya');
		$data['id_tahun_pelajaran'] = $this->input->post('id_tahun_pelajaran');
		$data['harga'] = $this->input->post('harga');
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['deleted_at'] = 0;
	
		// Validasi harga
		if (empty($data['harga'])) {
			$ret['status'] = false;
			$ret['message'] = 'Harga tidak boleh kosong';
			echo json_encode($ret);
			return;
		}
	
		if (!is_numeric($data['harga'])) {
			$ret['status'] = false;
			$ret['message'] = 'Harga harus berupa angka';
			echo json_encode($ret);
			return;
		}
	
		if ($data['id_biaya']) {
			$cek = $this->md->cekHargaBiayaDuplicate($data['id_biaya'], $data['id_tahun_pelajaran'], $id);
			if ($cek->num_rows() > 0) {
				$ret['status'] = false;
				$ret['message'] = 'Nama Biaya sudah ada';
				$ret['query'] = $this->db->last_query();
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
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data tidak boleh kosong';
			$ret['query'] = $this->db->last_query();
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


}