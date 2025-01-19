<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('Masterdata_model', 'md');
	}

	public function index(){
		$data = array(
			'menu' => 'backend/menu',
			'content' => 'backend/kelasKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
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

	public function option_jurusan($id){
		$q = $this->md->getJurusanByTahunPelajaranID($id);
		$ret = '<option value="">Pilih Jurusan</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$ret .= '<option value="' . $row->id . '">' . $row->nama_jurusan . '</option>';
			}
		}
		echo $ret;
	}

	public function table_kelas(){
		$q = $this->md->getAllKelasNotDeleted();
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

	public function save_kelas(){
		$id = $this->input->post('id');
		$data['id_tahun_pelajaran'] = $this->input->post('id_tahun_pelajaran');
		$data['nama_kelas'] = $this->input->post('nama_kelas');
		$data['id_jurusan'] = $this->input->post('id_jurusan');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['deleted_at'] = 0;

		// Validasi
		if (empty($data['nama_kelas'])) {
			$ret['status'] = false;
			$ret['message'] = 'Nama kelas tidak boleh kosong';
			echo json_encode($ret);
			return;
		}
		if (empty($data['id_tahun_pelajaran'])) {
			$ret['status'] = false;
			$ret['message'] = 'Tahun pelajaran harus dipilih';
			echo json_encode($ret);
			return;
		}
		if (empty($data['id_jurusan'])) {
			$ret['status'] = false;
			$ret['message'] = 'Jurusan harus dipilih';
			echo json_encode($ret);
			return;
		}

		$cek = $this->md->cekKelasDuplicate($data['nama_kelas'], $data['id_jurusan'], $id);
		if ($cek->num_rows() > 0) {
			$ret['status'] = false;
			$ret['message'] = 'Kelas sudah ada';
			$ret['query'] = $this->db->last_query();
		} else {
			if ($id) {
				$this->md->updateKelas($id, $data);
				$ret['status'] = true;
				$ret['message'] = 'Data berhasil diupdate';
			} else {
				$this->md->saveKelas($data);
				$ret['status'] = true;
				$ret['message'] = 'Data berhasil disimpan';
				$ret['query'] = $this->db->last_query();
			}
		}
		echo json_encode($ret);
	}
	
	public function edit_kelas(){
		$id = $this->input->post('id');
		$q = $this->md->getKelasByID($id);
		if ($q->num_rows() > 0) {
			$ret['status'] = true;
			$ret['data'] = $q->row();
			$ret['message'] = '';
			$ret['query'] = $this->db->last_query();
		} else {
			$ret['status'] = false;
			$ret['data'] = [];
			$ret['message'] = 'Data tidak tersedia';
		}
		echo json_encode($ret);
	}

	public function delete_kelas(){
	    $id = $this->input->post('id');
	    $q = $this->md-> deleteKelas($id); // Pastikan fungsi deleteKelas ada di model

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