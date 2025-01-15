<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seragam extends CI_Controller
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
			'content' => 'backend/seragamKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

	public function table_jenis_seragam()
{
    $q = $this->md->getAllSeragamNotDeleted();
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

public function table_stok_seragam()
{
    $q = $this->md->getStokSeragam();
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


	public function save()
	{
		$id = $this->input->post('id');
		$data['jenis_seragam'] = $this->input->post('jenis_seragam');
		$data['ukuran_seragam'] = $this->input->post('ukuran_seragam');
		$data['jumlah_seragam'] = $this->input->post('jumlah_seragam');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['deleted_at'] = 0;

		if ($data['jenis_seragam'] && $data['ukuran_seragam'] && $data['jumlah_seragam']) {
			if ($id) {
				$q = $this->md->updateSeragam($id, $data);
				if ($q) {
					$ret['status'] = true;
					$ret['message'] = 'Data berhasil diupdate';
				} else {
					$ret['status'] = false;
					$ret['message'] = 'Data gagal diupdate';
				}
			} else {
				$q = $this->md->saveSeragam($data);
				if ($q) {
					$ret['status'] = true;
					$ret['message'] = 'Data berhasil disimpan';
				} else {
					$ret['status'] = false;
					$ret['message'] = 'Data gagal disimpan';
				}
			}
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal disimpan';
		}
		echo json_encode($ret);
	}

	public function delete()
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

	public function edit()
	{
		$id = $this->input->post('id');
		$q = $this->md->getSeragamByID($id);
		if ($q->num_rows() > 0) {
			$ret = array(
				'status' => true,
				'data' => $q->row(),
				'message' => ''
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
}
