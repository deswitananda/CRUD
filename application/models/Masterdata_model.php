<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterdata_model extends CI_Model
{

	protected $tableTahunPelajaran = 'data_tahun_pelajaran';
	protected $tableKelas = 'data_kelas';
	protected $tableJurusan = 'data_jurusan';

	public function __construct()
	{
		parent::__construct();
	}


	public function getAllTahunPelajaran()
	{
		return $this->db->get($this->tableTahunPelajaran);
	}

	public function getAllKelas() {
        return $this->db->get($this->tableKelas);
    }

	public function getAllJurusan() {
        return $this->db->get($this->tableJurusan);
    }

	# code...

}

/* End of file: Masterdata_model.php */