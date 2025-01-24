<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaranawal_model extends CI_Model{

    protected $tableTahunPelajaran = 'data_tahun_pelajaran';
	protected $tableKelas = 'data_kelas';
	protected $tableJurusan = 'data_jurusan';
	protected $tablePendaftaranAwal = 'data_pendaftaran_awal';

    public function __construct(){
		parent::__construct();
	}


 // pendaftaran awal
	public function getAllPendaftaranAwal()
	{
		$this->db->where('deleted_at', 0);
		return  $this->db->get($this->tablePendaftaranAwal);
	}

	public function getAllPendaftaranAwalNotDeleted()
	{
		$this->db->select($this->tablePendaftaranAwal . '.*, ' . $this->tableTahunPelajaran . '.nama_tahun_pelajaran, ' . $this->tableJurusan . '.nama_jurusan,' . $this->tableKelas . '.nama_kelas');
		$this->db->join($this->tableJurusan, $this->tableJurusan . '.id = ' . $this->tablePendaftaranAwal . '.id_jurusan');
		$this->db->join($this->tableTahunPelajaran, $this->tableTahunPelajaran . '.id = ' . $this->tableJurusan . '.id_tahun_pelajaran');
		$this->db->join($this->tableKelas, $this->tableKelas . '.id = ' . $this->tablePendaftaranAwal . '.id_kelas');
		$this->db->where($this->tablePendaftaranAwal . '.deleted_at', 0);
		return $this->db->get($this->tablePendaftaranAwal);
	}

	public function getPendaftaranAwalByID($id=null)
	{
		$this->db->where('id', $id);
		return $this->db->get($this->tablePendaftaranAwal);
	}

	public function getKelasByJurusanID($id)
	{
		$this->db->where('deleted_at', 0);
		$this->db->where('id_jurusan', $id);
		return $this->db->get($this->tableKelas);
	}

	public function cekPendaftaranAwalDuplicate($email, $nik, $nisn, $id = null)
	{
		// Jika ID ada, pastikan kita mengecualikan ID tersebut
		if ($id !== null) {
			$this->db->where('id !=', $id);
		}

		// Periksa email, nik, nisn yang duplikat
		$this->db->where('email', $email);
		$this->db->where('nik', $nik);
		$this->db->where('nisn', $nisn);
		$this->db->where('deleted_at', 0); // Pastikan data tidak dihapus

		// Lakukan query
		$query = $this->db->get($this->tablePendaftaranAwal);

		// Jika ada hasil (email, nik, atau nisn sudah terdaftar)
		if ($query->num_rows() > 0) {
			return true;  // Data duplikat ditemukan
		}

		return false;  // Tidak ada duplikat
	}




	public function updatePendaftaranAwal($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update($this->tablePendaftaranAwal, $data);
		return $this->db->affected_rows();
	}

	public function savePendaftaranAwal($data)
	{
		return $this->db->insert($this->tablePendaftaranAwal, $data);
	}


	

	public function getTableDataKelas()
	{
		$this->db->select('no_pendaftaran, id_tahun_pelajaran, id_jurusan, id_kelas');
		$this->db->from($this->tablePendaftaranAwal);
		$query = $this->db->get();
		return $query;
	}

	public function getTahunPelajaranNama($id)
	{
		// Mengambil nama_tahun_pelajaran berdasarkan id_tahun_pelajaran
		$this->db->select('nama_tahun_pelajaran');
		$this->db->from('data_tahun_pelajaran');  // Sesuaikan nama tabel
		$this->db->where('id', $id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->nama_tahun_pelajaran;  // Mengembalikan nama_tahun_pelajaran
		} else {
			return null;  // Jika tidak ditemukan
		}
	}


	// Fungsi untuk mengambil jurusan berdasarkan ID
	public function getJurusanNama($id)
	{
		// Mengambil nama_jurusan berdasarkan id_jurusan
		$this->db->select('nama_jurusan');
		$this->db->from('data_jurusan');  // Sesuaikan nama tabel
		$this->db->where('id', $id);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->nama_jurusan;  // Mengembalikan nama_jurusan
		} else {
			return null;  // Jika tidak ditemukan
		}
	}


	public function getNamaJurusanByIdJurusan($id_jurusan)
	{
		$this->db->select('nama_jurusan');
		$this->db->from($this->tableJurusan);
		$this->db->where('id', $id_jurusan);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->nama_jurusan; // Mengembalikan nama_jurusan
		}

		return null; // Jika tidak ditemukan
	}
	public function getNamaTahunPelajaranByIdTahunPelajaran($id_tahun_pelajaran)
	{
		$this->db->select('nama_tahun_pelajaran');
		$this->db->from($this->tableTahunPelajaran);
		$this->db->where('id', $id_tahun_pelajaran);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			return $query->row()->nama_tahun_pelajaran; // Mengembalikan nama_jurusan
		}

		return null; // Jika tidak ditemukan
	}

	public function formatTahunPelajaran($nama_tahun_pelajaran){
		// Pastikan formatnya adalah "2024/2025"
		$tahun = explode('/', $nama_tahun_pelajaran);

		// Validasi apakah format sesuai
		if (count($tahun) < 2) {
			return '0000'; // Berikan nilai default jika format tidak sesuai
		}

		// Ambil dua digit terakhir dari masing-masing tahun
		$tahun_awal = substr($tahun[0], -2); // Contoh: "2024" jadi "24"
		$tahun_akhir = substr($tahun[1], -2); // Contoh: "2025" jadi "25"

		// Gabungkan menjadi format "2425"
		return $tahun_awal . $tahun_akhir;
	}


	public function hitungUrutanPendaftaran($id_tahun_pelajaran, $id_jurusan)
	{
		// Ambil ID terbesar untuk jurusan dan tahun pelajaran yang sesuai
		$this->db->select_max('id'); // Cari ID tertinggi
		$this->db->where('id_tahun_pelajaran', $id_tahun_pelajaran);
		$this->db->where('id_jurusan', $id_jurusan);
		$query = $this->db->get('data_pendaftaran_awal');
		$result = $query->row();

		// Jika belum ada data, urutan dimulai dari 1
		if (empty($result) || empty($result->id)) {
			return 1;
		}

		// Urutan berdasarkan ID tertinggi + 1
		return $result->id + 1;
	}



	public function generate($id_jurusan, $id_tahun_pelajaran, $id)
	{
		// Dapatkan nama jurusan dan tahun pelajaran
		$nama_jurusan = $this->getNamaJurusanByIdJurusan($id_jurusan);
		$nama_tahun_pelajaran = $this->getNamaTahunPelajaranByIdTahunPelajaran($id_tahun_pelajaran);

		// Format tahun pelajaran
		$format_tahun = $this->formatTahunPelajaran($nama_tahun_pelajaran);

		// Nomor pendaftaran: Tahun-Jurusan-Urutan
		$no_pendaftaran = $format_tahun . '-' . $nama_jurusan . '-' . str_pad($id, 4, '0', STR_PAD_LEFT);

		return $no_pendaftaran;
	}





	public function getById($tablePendaftaranAwal, $id)
	{
		$this->db->where('id', $id);  // Menambahkan kondisi untuk ID
		$query = $this->db->get($tablePendaftaranAwal);  // Melakukan query untuk mengambil data
		return $query->row();  // Mengembalikan baris pertama data yang ditemukan
	}public function getAllTahunPelajaran()
	{
		return  $this->db->get($this->tableTahunPelajaran);
	}


	public function getAllTahunPelajaranNotDeleted(){
		$this->db->where('deleted_at', 0);
		return  $this->db->get($this->tableTahunPelajaran);
	}

	public function getJurusanByTahunPelajaranID($id){
		$this->db->where('deleted_at', 0);
		$this->db->where('id_tahun_pelajaran', $id);
		return $this->db->get($this->tableJurusan);
	}

	// public function getNamaTahunPelajaran($nama_tahun_pelajaran)
	// {
	// 	$q = $this->db->where('nama_tahun_pelajaran', $nama_tahun_pelajaran)->get($this->tableTahunPelajaran);
	// 	return $q;
	// }

	// public function getTahunPelajaranByID($id = null){

	// 	return $this->db->where('id', $id)->get($this->tableTahunPelajaran);
	// }

	// public function cekTahunPelajaranDuplicate($nama_tahun_pelajaran, $id){
	// 	if($id){
	// 		$this->db->where('id !=', $id);
	// 	}
	// 	$this->db->where('deleted_at', 0);
	// 	$this->db->where('nama_tahun_pelajaran', $nama_tahun_pelajaran);
	// 	return $this->db->get($this->tableTahunPelajaran);
	// }
	
	// public function deleteTahunPelajaran($id = null)
	// {
	// 	$this->db->where('id', $id);
	// 	$this->db->delete($this->tableTahunPelajaran);
	// 	return $this->db->affected_rows();
	// }

	// public function updateTahunPelajaran($id, $data)
	// {
	// 	$this->db->where('id', $id);
	// 	$this->db->update($this->tableTahunPelajaran, $data);
	// 	return $this->db->affected_rows();
	// }

	// public function insertTahunPelajaran($data)
	// {
	// 	$this->db->insert($this->tableTahunPelajaran, $data);
	// 	return $this->db->insert_id();
	// }




}