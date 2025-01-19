<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Seragam extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('Masterdata_model', 'md');
	}

	public function index()	{
		$data = array(
			'menu' => 'backend/menu',
			'content' => 'backend/seragamKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

	public function table_seragam(){
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

	public function save_seragam(){
		$id = $this->input->post('id');
		$nama_seragam = $this->input->post('nama_seragam');
		$data = array(
			'nama_seragam' => $nama_seragam,
			'updated_at' => date('Y-m-d H:i:s'),
			'deleted_at' => 0
		);

		if ($data['nama_seragam']) {
			$cek = $this->md->cekSeragamDuplicate($data['nama_seragam'], $id);
			if ($cek->num_rows() > 0) {
				$ret['status'] = false;
				$ret['message'] = 'Nama Seragam sudah ada';
				$ret['query'] = $this->db->last_query();
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
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data tidak boleh kosong';
            $ret['query'] = $this->db->last_query();
		}
		echo json_encode($ret);
	}

    public function edit_seragam(){
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

    public function delete_seragam(){
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


    // Data Stok Seragam
    public function table_stok(){
		$q = $this->md->getAllStokNotDeleted();
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

    public function option_tahun_pelajaran(){
		$q = $this->md->getAllTahunPelajaranNotDeleted();
		$ret = '<option value="">Pilih Tahun Pelajaran</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$ret .= '<option value="' . $row->id . '">' . $row->nama_tahun_pelajaran . '</option>';
			}
		}
		echo $ret;
	}

    public function option_seragam(){
		$q = $this->md->getAllSeragamNotDeleted();
		$ret = '<option value="">Pilih Seragam</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$ret .= '<option value="' . $row->id . '">' . $row->nama_seragam . '</option>';
			}
		}
		echo $ret;
	}

    public function save_stok(){
    	$id = $this->input->post('id');
    	$data['id_seragam'] = $this->input->post('id_seragam');
    	$data['id_tahun_pelajaran'] = $this->input->post('id_tahun_pelajaran');
    	$data['ukuran'] = $this->input->post('ukuran');
    	$data['stok'] = $this->input->post('stok');

    	$data['updated_at'] = date('Y-m-d H:i:s');
    	$data['deleted_at'] = 0;

    	// Validasi input
    	if (empty($data['id_seragam']) || empty($data['id_tahun_pelajaran']) || empty($data['ukuran']) || !is_numeric($data['stok'])) {
    	    $ret = [
    	        'status' => false,
    	        'message' => 'Semua data harus diisi dan stok harus berupa angka',
    	    ];
    	    echo json_encode($ret);
    	    return;
    	}

    	if ($data['stok'] < 0) {
    	    $ret = [
    	        'status' => false,
    	        'message' => 'Stok tidak boleh bernilai negatif',
    	    ];
    	    echo json_encode($ret);
    	    return;
    	}

    	$cek = $this->md->cekStokDuplicate($data['id_tahun_pelajaran'], $data['ukuran'], $data['id_seragam'], $id);
    	if ($cek->num_rows() > 0) {
    	    $ret = [
    	        'status' => false,
    	        'message' => 'Data stok seragam sudah ada',
    	        'query' => $this->db->last_query(),
    	    ];
    	    echo json_encode($ret);
    	    return;
    	}

    	if ($id) {
    	    $update = $this->md->updateStok($id, $data);
    	    if ($update) {
    	        $ret = [
    	            'status' => true,
    	            'message' => 'Data berhasil diupdate',
    	        ];
    	    } else {
    	        $ret = [
    	            'status' => false,
    	            'message' => 'Data gagal diupdate',
    	        ];
    	    }
    	} else {
    	    $data['created_at'] = date('Y-m-d H:i:s');
    	    $insert = $this->md->insertStok($data);
    	    if ($insert) {
    	        $ret = [
    	            'status' => true,
    	            'message' => 'Data berhasil disimpan',
    	        ];
    	    } else {
    	        $ret = [
    	            'status' => false,
    	            'message' => 'Data gagal disimpan',
    	        ];
    	    }
    	}

    	echo json_encode($ret);
	}


    public function edit_stok(){
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

    public function delete_stok()	{
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