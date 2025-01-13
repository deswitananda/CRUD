<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun_pelajaran extends CI_Controller
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
			'content' => 'backend/tahunPelajaranKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

	public function table_tahun_pelajaran()
	{

		$q = $this->md->getAllTahunPelajaran();
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
	public function save_tahun_pelajaran()
    {
        $data = $this->input->post();
        // Validasi
        if (empty($data['nama_tahun_pelajaran'])) {
            echo json_encode(['status' => false, 'message' => 'Nama tahun pelajaran harus diisi']);
            return;
        }

        $saveData = [
            'nama_tahun_pelajaran' => $data['nama_tahun_pelajaran'],
            'tanggal_mulai' => $data['tanggal_mulai'],
            'tanggal_akhir' => $data['tanggal_akhir'],
            'status_tahun_pelajaran' => $data['status_tahun_pelajaran'],
        ];

        if (isset($data['id']) && $data['id']) {
            $this->md->updateTahunPelajaran($data['id'], $saveData);
        } else {
            $this->md->insertTahunPelajaran($saveData);
        }

        echo json_encode(['status' => true, 'message' => 'Data berhasil disimpan!']);
    }
}

/* End of file: Tahun_pelajaran.php */