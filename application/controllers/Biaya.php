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

    // Mendapatkan data jenis biaya
public function getJenisBiaya()
{
    $q = $this->md->getAllJenisBiaya();
    $dt = [];
    if ($q->num_rows() > 0) {
        foreach ($q->result() as $row) {
            $dt[] = $row;
        }
        $ret['status'] = true;
        $ret['data'] = $dt;
    } else {
        $ret['status'] = false;
        $ret['data'] = [];
        $ret['message'] = 'Data tidak tersedia';
    }
    echo json_encode($ret);
}

    // Mendapatkan harga biaya per kelas
    public function getHargaBiayaPerKelas()
    {
        $q = $this->md->getAllHargaBiayaPerKelas();
        $dt = [];
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $dt[] = $row;
            }
            $ret['status'] = true;
            $ret['data'] = $dt;
        } else {
            $ret['status'] = false;
            $ret['data'] = [];
            $ret['message'] = 'Data tidak tersedia';
        }
        echo json_encode($ret);
    }

        public function getKelas()
    {
        $q = $this->md->getAllKelas();
        $dt = [];
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $dt[] = $row;
            }
            $ret['status'] = true;
            $ret['data'] = $dt;
        } else {
            $ret['status'] = false;
            $ret['data'] = [];
            $ret['message'] = 'Data tidak tersedia';
        }
        echo json_encode($ret);
    }

        public function saveKelas(){

        $id = $this->input->post('id');
        $data['nama_kelas'] = $this->input->post('nama_kelas');
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        if ($data['nama_kelas']) {
            if ($id) {
                $q = $this->md->updateKelas($id, $data);
                if ($q) {
                    $ret['status'] = true;
                    $ret['message'] = 'Data kelas berhasil diupdate';
                } else {
                    $ret['status'] = false;
                    $ret['message'] = 'Data kelas gagal diupdate';
                }
            } else {
                $q = $this->md->saveKelas($data);
                if ($q) {
                    $ret['status'] = true;
                    $ret['message'] = 'Data kelas berhasil disimpan';
                } else {
                    $ret['status'] = false;
                    $ret['message'] = 'Data kelas gagal disimpan';
                }
            }
        } else {
            $ret['status'] = false;
            $ret['message'] = 'Data kelas gagal disimpan';
        }
        echo json_encode($ret);
    }

    public function deleteKelas()
    {
        $id = $this->input->post('id');
        $q = $this->md->deleteKelas($id);
        if ($q) {
            $ret['status'] = true;
            $ret['message'] = 'Data kelas berhasil dihapus';
        } else {
            $ret['status'] = false;
            $ret['message'] = 'Data kelas gagal dihapus';
        }
        echo json_encode($ret);
    }
    
    public function editKelas()
    {
        $id = $this->input->post('id');
        $q = $this->md->getKelasByID($id);
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
                'message' => 'Data tidak ditemukan'
            );
        }
        echo json_encode($ret);
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

	public function save()
	{
		$id = $this->input->post('id');
		$data['nama_biaya'] = $this->input->post('nama_biaya');
		$data['jumlah_biaya'] = $this->input->post('jumlah_biaya');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['deleted_at'] = 0;

		if ($data['nama_biaya']) {
			if ($id) {
				$q = $this->md->updateBiaya($id, $data);
				if ($q) {
					$ret['status'] = true;
					$ret['message'] = 'Data berhasil diupdate';
				} else {
					$ret['status'] = false;
					$ret['message'] = 'Data gagal diupdate';
				}
			} else {
				$q = $this->md->saveBiaya($data);
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

	public function edit()
	{
		$id = $this->input->post('id');
		$q = $this->md->getBiayaByID($id);
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
