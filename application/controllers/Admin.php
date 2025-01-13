<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if (!$this->session->userdata('user_id')){
			redirect('login');
		}
	}

	public function index()
	{

		$data = array(
			'menu' => 'backend/menu',
			'content' => 'backend/adminKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

	public function getTahunPelajaran()
    {
        $this->load->model('Masterdata_model', 'md');
        $tahun_pelajaran = $this->md->getAllTahunPelajaran();
        echo json_encode($tahun_pelajaran);
    }
}

/* End of file: Admin.php */