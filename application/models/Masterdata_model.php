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
        $this->db->where('deleted_at IS NULL', null, false); // Tidak mengambil data yang sudah dihapus
        return $this->db->get($this->tableTahunPelajaran);
    }

    public function insertTahunPelajaran($data)
    {
        return $this->db->insert($this->tableTahunPelajaran, $data);
    }

    public function updateTahunPelajaran($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->tableTahunPelajaran, $data);
    }

    public function deleteTahunPelajaran($id)
    {
        return $this->db->where('id', $id)->update($this->tableTahunPelajaran, ['deleted_at' => date('Y-m-d H:i:s')]);
    }

    public function getAllKelas($idTahunPelajaran, $idJurusan)
    {
        $this->db->where('id_tahun_pelajaran', $idTahunPelajaran);
        $this->db->where('id_jurusan', $idJurusan);
        return $this->db->get($this->tableKelas);
    }

    public function getAllJurusan($idTahunPelajaran)
    {
        $this->db->where('id_tahun_pelajaran', $idTahunPelajaran);
        return $this->db->get($this->tableJurusan);
    }

    // Fungsi tambahan: ambil data kelas berdasarkan tahun pelajaran saja
    public function getKelasByTahunPelajaran($idTahunPelajaran)
    {
        $this->db->where('id_tahun_pelajaran', $idTahunPelajaran);
        return $this->db->get($this->tableKelas);
    }

    // Fungsi tambahan: ambil jurusan berdasarkan ID kelas
    public function getJurusanByKelas($idKelas)
    {
        $this->db->where('id_kelas', $idKelas);
        return $this->db->get($this->tableJurusan);
    }
}

/* End of file: Masterdata_model.php */
