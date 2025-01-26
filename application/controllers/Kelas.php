<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
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
			'content' => 'backend/kelasKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
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

	public function option_jurusan($id = null)
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

	public function table_kelas()
	{
		$q = $this->md->dataTablesKelas();

		$data  = array();
		$no    = $_POST['start'];
		foreach ($q['data'] as $da) {
			$no++;
			$row   = array();
			$row[] = '<input type="checkbox" class="data-check" value="' . $da->id . '">';
			$row[] = $no;
			$row[] = $da->nama_tahun_pelajaran;
			$row[] = $da->nama_jurusan;
			$row[] = $da->nama_kelas;
			$row[] = actbtn($da->id, 'kelas');
			$data[] = $row;
		}

		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $q['recordTotal'],
			"recordsFiltered" => $q['recordFiltered'],
			"data" => $data,
		);
		echo json_encode($output);
	}

	public function save_kelas()
	{

		$id = $this->input->post('id');
		$data['id_tahun_pelajaran'] = $this->input->post('id_tahun_pelajaran');
		$data['id_jurusan'] = $this->input->post('id_jurusan');
		$data['nama_kelas'] = $this->input->post('nama_kelas');
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['deleted_at'] = 0;

		$this->form_validation->set_rules('id_tahun_pelajaran', 'Tahun Pelajaran', 'trim|required', array('required' => '%s harus diisi'));
		$this->form_validation->set_rules('id_jurusan', 'Jurusan', 'trim|required', array('required' => '%s harus diisi'));
		$this->form_validation->set_rules('nama_kelas', 'Kelas', 'trim|required|alpha_numeric_spaces', array('required' => '%s harus diisi', 'alpha_numeric_spaces' => '%s hanya boleh mengandung huruf, angka dan spasi'));

		if ($this->form_validation->run() == FALSE) {
			$ret['status'] = false;
			foreach ($_POST as $key => $value) {
				$ret['error'][$key] = form_error($key);
			}
			
		} else {
			if ($id) {
				$this->md->updateKelas($id, $data);
				$ret['status'] = true;
				$ret['message'] = 'Data berhasil diupdate';
			} else {
				$this->md->insertKelas($data);
				$ret['status'] = true;
				$ret['message'] = 'Data berhasil disimpan';
				$ret['query'] = $this->db->last_query();
			}
		}

		echo json_encode($ret);
	}

	public function edit_kelas()
	{
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

	public function delete_kelas()
	{
		$id = $this->input->post('id');
		$data['deleted_at'] = time();
		$q = $this->md->updateKelas($id, $data);
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