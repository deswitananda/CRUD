<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jurusan extends CI_Controller
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
			'content' => 'backend/jurusanKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

	public function table_jurusan()
	{

		$q = $this->md->getAllJurusan();
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

	public function edit()
	{

		$id = $this->input->post('id');
		$q = $this->md->getJurusanByID($id);

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

	
	public function delete()
	{

		$id = $this->input->post('id');
		$q = $this->md->deleteJurusan($id);

		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}

		echo json_encode($ret);
	}

	public function save()
	{	
		$data['nama_tahun_pelajaran'] = $this->input->post('nama_tahun_pelajaran');
        $data['tanggal_mulai'] = $this->input->post('tanggal_mulai');
        $data['tanggal_akhir'] = $this->input->post('tanggal_akhir');
        $data['status_tahun_pelajaran'] = $this->input->post('status_tahun_pelajaran');
		$id = $this->input->post('id');

		if ($data['nama_tahun_pelajaran'] == '' || $data['tanggal_mulai'] == '' || $data['tanggal_akhir'] == '' || $data['status_tahun_pelajaran'] == '') {
			$ret = array(
				'status' => false,
				'message' => 'Harap diisi semua'
			);
		} else {

				if ($id != '') {
					$update = $this->md->updateJurusan($id, $data);
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
					$insert = $this->md->insertTahunJurusan($data);

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

	public function update()
	{
		$id = $this->input->post('id');
		$nama_tahun_pelajaran = $this->input->post('nama_tahun_pelajaran');
		$tanggal_mulai = $this->input->post('tanggal_mulai');
		$tanggal_akhir = $this->input->post('tanggal_akhir');
		$status_tahun_pelajaran = $this->input('status_tahun_pelajaran');

		$data = array(
			'nama_tahun_pelajaran' => $nama_tahun_pelajaran,
			'tanggal_mulai' => $tanggal_mulai,
			'tanggal_akhir' => $tanggal_akhir,
			'status_tahun_pelajaran' => $status_tahun_pelajaran,
		);

		$update = $this->md->updateUser($id, $data);

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

		echo json_encode($ret);
	}
}