<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Tahun_pelajaran extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Masterdata_model', 'md');
		$this->load->helper('actionbtn');
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

		$q = $this->md->dataTablesTahunPelajaran();

		$data  = array();
		$no    = $_POST['start'];
		foreach ($q['data'] as $da) {
			$no++;
			$row   = array();
			$row[] = '<input type="checkbox" class="data-check" value="' . $da->id . '">';
			$row[] = $no;
			$row[] = $da->nama_tahun_pelajaran;
			$row[] = $da->tanggal_mulai == '0000-00-00' ? 'tanggal belum diisi' : date('d-m-Y', strtotime($da->tanggal_mulai));
			$row[] = $da->tanggal_akhir;
			$row[] = $da->status_tahun_pelajaran;
			$row[] = actbtn($da->id, 'tahun_pelajaran');
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $q['recordTotal'],
			"recordsFiltered" => $q['recordFiltered'],
			"data" => $data,
		);
		//output to json format


		echo json_encode($output);
	}


	public function edit_tahun_pelajaran()
	{

		$id = $this->input->post('id');
		$q = $this->md->getTahunPelajaranByID($id);

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

	
	public function delete_tahun_pelajaran()
	{

		$id = $this->input->post('id');
		$q = $this->md->deleteTahunPelajaran($id);

		if ($q) {
			$ret['status'] = true;
			$ret['message'] = 'Data berhasil dihapus';
		} else {
			$ret['status'] = false;
			$ret['message'] = 'Data gagal dihapus';
		}

		echo json_encode($ret);
	}

	public function save_tahun_pelajaran()
	{	
		
		$id = $this->input->post('id');
		$data['nama_tahun_pelajaran'] = $this->input->post('nama_tahun_pelajaran');
		$data['tanggal_mulai'] = $this->input->post('tanggal_mulai');
		$data['tanggal_akhir'] = $this->input->post('tanggal_akhir');
		$data['status_tahun_pelajaran'] = $this->input->post('status_tahun_pelajaran');

		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['deleted_at'] = 0;

		$this->form_validation->set_rules('nama_tahun_pelajaran', 'Tahun Pelajaran', 'trim|required|regex_match[/^\d{4}-\d{4}$/]', array('required' => '%s harus diisi', 'regex_match' => 'Format Tahun Pelajaran salah. Harus dalam format YYYY-YYYY.'));
		$this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'trim|required', array('required' => '%s harus diisi'));
		$this->form_validation->set_rules('tanggal_akhir', 'Tanggal Akhir', 'trim|required', array('required' => '%s harus diisi'));
		$this->form_validation->set_rules('status_tahun_pelajaran', 'Status Tahun Pelajaran', 'trim|required', array('required' => '%s harus diisi'));
		
		if ($this->form_validation->run() == FALSE) {
			$ret['status'] = false;
			foreach ($_POST as $key => $value) {
				$ret['error'][$key] = form_error($key);
			}
		} else {
		
					if ($id) {
						$update = $this->md->updateTahunPelajaran($id, $data);
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
						$insert = $this->md->insertTahunPelajaran($data);

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
		

}