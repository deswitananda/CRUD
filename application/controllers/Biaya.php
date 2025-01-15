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

    public function table_biaya()
	{

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

    public function saveBiaya()
	{	
		$id = $this->input->post('id');
		$data['nama_biaya'] = $this->input->post('nama_biaya');
		$data['deskripsi'] = $this->input->post('deskripsi');
		$data['created_at'] = date('Y-m-d H:i:s');
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

    public function editBiaya()
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

    public function deleteBiaya()
	{

		$id = $this->input->post('id');
		$q = $this->md->deleteBiaya($id);

		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}

		echo json_encode($ret);
	}


    // harga biaya
    public function table_harga_biaya()
	{

		$q = $this->md->getAllHargaBiayaNotDeleted();
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

	public function option_jurusan($id)
	{

		$q = $this->md->getJurusanByTahunPelajaranID($id);
		$ret = '<option value="">Pilih Jurusan</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$ret .= '<option value="' . $row->id . '">' . $row->nama_jurusan . '</option>';
			}
		}
		echo $ret;
	}

    public function option_kelas($id)
	{

		$q = $this->md->getKelasByJurusanID($id);
		$ret = '<option value="">Pilih kelas</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$ret .= '<option value="' . $row->id . '">' . $row->nama_kelas . '</option>';
			}
		}
		echo $ret;
	}

    public function option_biaya()
	{

		$q = $this->md->getAllBiayaNotDeleted();
		$ret = '<option value="">Pilih Biaya</option>';
		if ($q->num_rows() > 0) {
			foreach ($q->result() as $row) {
				$ret .= '<option value="' . $row->id . '">' . $row->nama_biaya . '</option>';
			}
		}
		echo $ret;
	}

    public function saveHargaBiaya()
	{	
		$id = $this->input->post('id');
		$data['id_biaya'] = $this->input->post('id_biaya');
		$data['id_tahun_pelajaran'] = $this->input->post('id_tahun_pelajaran');
		$data['id_jurusan'] = $this->input->post('id_jurusan');
		$data['id_kelas'] = $this->input->post('id_kelas');
		$data['harga'] = $this->input->post('harga');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['deleted_at'] = 0;

		if ($data['harga']) {
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
			
			} else {
			$ret['status'] = false;
			$ret['message'] = 'Data tidak boleh kosong';
            $ret['query'] = $this->db->last_query();
		
	}
    echo json_encode($ret);
    }

    public function editHargaBiaya()
	{

		$id = $this->input->post('id');
		$q = $this->md->getHargaBiayaByID($id);

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

    public function deleteHargaBiaya()
	{

		$id = $this->input->post('id');
		$q = $this->md->deleteHargaBiaya($id);

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

