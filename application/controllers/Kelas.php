<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
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
			'content' => 'backend/kelasKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

	public function table_Kelas()
	{

		$q = $this->md->getAllKelas();
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
}

/* End of file: Kelas.php */