<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendaftaran_Awal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pendaftaranawal_model');
    }

    public function index()
    {
        $data = array(
            'menu' => 'backend/menu',
            'content' => 'backend/pendaftaranAwalKonten',
            'title' => 'Admin'
        );
        $this->load->view('template', $data);
    }

    public function option_tahun_pelajaran()
    {
        $q = $this->pendaftaranawal_model->getAllTahunPelajaranNotDeleted();
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
        // Validasi apakah $id ada
        if (!$id) {
            echo '<option value="">Pilih Jurusan</option>';
            return;
        }

        // Ambil data jurusan berdasarkan ID tahun pelajaran
        $q = $this->pendaftaranawal_model->getJurusanByTahunPelajaranID($id);
        $ret = '<option value="">Pilih Jurusan</option>';
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $ret .= '<option value="' . $row->id . '">' . $row->nama_jurusan . '</option>';
            }
        }
        echo $ret;
    }


    public function option_kelas($id = null)
    {
        // Validasi apakah $id ada
        if (!$id) {
            echo '<option value="">Pilih Kelas</option>';
            return;
        }

        // Ambil data kelas berdasarkan ID jurusan
        $q = $this->pendaftaranawal_model->getKelasByJurusanID($id);
        $ret = '<option value="">Pilih Kelas</option>';
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $ret .= '<option value="' . $row->id . '">' . $row->nama_kelas . '</option>';
            }
        }
        echo $ret;
    }


    public function table_pendaftaran_awal()
    {
        $this->db->select([
            'data_pendaftaran_awal.id',
            'data_pendaftaran_awal.id_tahun_pelajaran',
            'tahun_pelajaran.nama_tahun_pelajaran',
            'data_pendaftaran_awal.id_jurusan',
            'jurusan.nama_jurusan',
            'data_pendaftaran_awal.id_kelas',
            'kelas.nama_kelas',
            'data_pendaftaran_awal.no_pendaftaran',
        ]);

        $this->db->from('data_pendaftaran_awal');

        $this->db->join(
            'data_tahun_pelajaran as tahun_pelajaran',
            'data_pendaftaran_awal.id_tahun_pelajaran = tahun_pelajaran.id',
            'left'
        ); // Pastikan menggunakan left join atau jenis join yang sesuai

        $this->db->join(
            'data_jurusan as jurusan',
            'data_pendaftaran_awal.id_jurusan = jurusan.id',
            'left'
        ); // Sama dengan di atas, pastikan jenis join benar

        $this->db->join(
            'data_kelas as kelas',
            'data_pendaftaran_awal.id_kelas = kelas.id',
            'left'
        ); 

        $this->db->where('data_pendaftaran_awal.deleted_at', 0);

        // Eksekusi query
        $query = $this->db->get();

        // Menyusun data hasil query
        $response = [];

        if ($query->num_rows() > 0) {
            $data = [];
            foreach ($query->result() as $row) {
                $data[] = [
                    'id' => $row->id,
                    'id_tahun_pelajaran' => $row->id_tahun_pelajaran,
                    'nama_tahun_pelajaran' => $row->nama_tahun_pelajaran,
                    'id_jurusan' => $row->id_jurusan,
                    'nama_jurusan' => $row->nama_jurusan,
                    'id_kelas' => $row->id_kelas,
                    'nama_kelas' => $row->nama_kelas,
                    'no_pendaftaran' => $row->no_pendaftaran,
                ];
            }

            // Menyusun response sukses
            $response['status'] = true;
            $response['data'] = $data;
            $response['message'] = '';
        } else {
            // Response ketika data tidak ditemukan
            $response['status'] = false;
            $response['data'] = [];
            $response['message'] = 'Data tidak tersedia';
        }

        // Mengirimkan response dalam format JSON
        echo json_encode($response);
    }

    public function table_siswa()
    {
        $q = $this->pendaftaranawal_model->getAllPendaftaranAwalNotDeleted();
        $dt = [];
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $dt[] = [
                    'id' => $row->id,
                    'nama_siswa' => $row->nama_siswa,
                    'nik' => $row->nik,
                    'agama' => $row->agama,
                    'nisn' => $row->nisn,
                    'jenis_kelamin' => $row->jenis_kelamin,
                    'tempat_lahir' => $row->tempat_lahir,
                    'tanggal_lahir' => $row->tanggal_lahir,
                    
                    'no_telepon_siswa' => $row->no_telepon_siswa,
                    'email' => $row->email,
                    'asal_sekolah' => $row->asal_sekolah,
                ];
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

    public function table_orangtua()
    {
        $q = $this->pendaftaranawal_model->getAllPendaftaranAwalNotDeleted();
        $dt = [];
        if ($q->num_rows() > 0) {
            foreach ($q->result() as $row) {
                $dt[] = [
                    'id' => $row->id,
                    'nama_ayah' => $row->nama_ayah,
                    'nama_ibu' => $row->nama_ibu,
                    'no_telepon_ayah' => $row->no_telepon_ayah,
                    'no_telepon_ibu' => $row->no_telepon_ibu,
                    'pekerjaan_ayah' => $row->pekerjaan_ayah,
                    'pekerjaan_ibu' => $row->pekerjaan_ibu,
                    'nama_wali' => $row->nama_wali,
                    'no_telepon_wali' => $row->no_telepon_wali,
                    'pekerjaan_wali' => $row->pekerjaan_wali,
                    'alamat_orang_tua' => $row->alamat_orang_tua,
                    'sumber_informasi' => $row->sumber_informasi,
                ];
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
    public function save_pendaftaran_awal()
    {
        $this->load->library('form_validation');

        //Awal Pendaftaran
        $this->form_validation->set_rules('id_tahun_pelajaran', 'Tahun Pelajaran', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('id_jurusan', 'Jurusan', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('id_kelas', 'Kelas', 'trim|required', array('required' => '%s harus diisi'));

        $this->form_validation->set_rules('nama_siswa', 'Nama', 'trim|required|max_length[40]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 40 karakter'));
        $this->form_validation->set_rules('nik', 'NIK', 'trim|required|numeric|min_length[16]|max_length[16]', array('required' => '%s harus diisi', 'min_length' => 'Tidak boleh kurang dari 16 angka', 'max_length' => 'Tidak boleh lebih dari 16 angka', 'numeric' => 'Hanya boleh mengandung angka'));
        $this->form_validation->set_rules('agama', 'Agama', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('nisn', 'NISN', 'trim|required|numeric|max_length[10]|min_length[10]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 10 angka', 'min_length' => 'Tidak boleh kurang dari 10 angka', 'numeric' => 'Hanya boleh mengandung angka'));
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'trim|required|exact_length[10]', array('required' => '%s harus diisi', 'exact_length' => 'Format Salah'));
        // $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('no_telepon_siswa', 'No Telepon', 'trim|required|numeric|max_length[13]|min_length[7]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 13 angka', 'min_length' => 'Tidak boleh kurang dari 7 angka', 'numeric' => 'Hanya boleh mengandung angka'));
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array('required' => '%s harus diisi', 'valid_email' => 'format email salah'));
        $this->form_validation->set_rules('asal_sekolah', 'Asal Sekolah', 'trim|required', array('required' => '%s harus diisi'));

        $this->form_validation->set_rules('nama_ayah', 'Nama Ayah', 'trim|required|max_length[40]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 40 karakter'));
        $this->form_validation->set_rules('nama_ibu', 'Nama Ibu', 'trim|required|max_length[40]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 40 karakter'));
        $this->form_validation->set_rules('no_telepon_ayah', 'No Telepon Ayan', 'trim|required|numeric|max_length[13]|min_length[7]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 13 angka', 'min_length' => 'Tidak boleh kurang dari 7 angka', 'numeric' => 'Hanya boleh mengandung angka'));
        $this->form_validation->set_rules('no_telepon_ibu', 'No Telepon Ibu', 'trim|required|numeric|max_length[13]|min_length[7]', array('required' => '%s harus diisi', 'max_length' => 'Tidak boleh lebih dari 13 angka', 'min_length' => 'Tidak boleh kurang dari 7 angka', 'numeric' => 'Hanya boleh mengandung angka'));
        $this->form_validation->set_rules('pekerjaan_ayah', 'Pekerjaan Ayah', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('pekerjaan_ibu', 'Pekerjaan Ibu', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('nama_wali', 'Nama Wali', 'trim', array());
        $this->form_validation->set_rules('no_telepon_wali', 'No Telepon Wali', 'trim|required', array('required' => 'harus diisi'));
        $this->form_validation->set_rules('pekerjaan_wali', 'Pekerjaan Wali', 'trim', array());

        $this->form_validation->set_rules('alamat_orang_tua', 'Alamat', 'trim|required', array('required' => '%s harus diisi'));
        $this->form_validation->set_rules('sumber_informasi', 'Sumber Informasi', 'trim|required', array('required' => '%s harus diisi'));
        
        if ($this->form_validation->run() == FALSE) {
            echo json_encode([
                'status' => false,
                'error' => $this->form_validation->error_array() // Mengembalikan error dalam format array
            ]);
        } else {
            $id = $this->input->post('id');

            $data['id_tahun_pelajaran'] = $this->input->post('id_tahun_pelajaran');
            $data['id_jurusan'] = $this->input->post('id_jurusan');


            $urutan = $this->pendaftaranawal_model->hitungUrutanPendaftaran($data['id_tahun_pelajaran'], $data['id_jurusan']);

            $no_pendaftaran = $this->pendaftaranawal_model->generate($data['id_jurusan'], $data['id_tahun_pelajaran'], $urutan);

            $data['no_pendaftaran'] = $no_pendaftaran;

            $data['id_kelas'] = $this->input->post('id_kelas');
		

            $data_siswa = array(
                'id_tahun_pelajaran' => $this->input->post('id_tahun_pelajaran'),
                'id_jurusan' => $this->input->post('id_jurusan'),
                'id_kelas' => $this->input->post('id_kelas'),
                // 'nama_pendaftaran' => $this->input->post('nama_pendafataran'),
                'nama_siswa' => $this->input->post('nama_siswa'),
                'nik' => $this->input->post('nik'),
                'agama' => $this->input->post('agama'),
                'nisn' => $this->input->post('nisn'),
                'jenis_kelamin' => $this->input->post('jenis_kelamin'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tanggal_lahir' => $this->input->post('tanggal_lahir'),
                // 'alamat_siswa' => $this->input->post('alamat_siswa'),
                'no_telepon_siswa' => $this->input->post('no_telepon_siswa'),
                'email' => $this->input->post('email'),
                'asal_sekolah' => $this->input->post('asal_sekolah'),
                'updated_at' => date('Y-m-d H:i:s'),
                'deleted_at' => 0,
                'nama_ayah' => $this->input->post('nama_ayah'),
                'nama_ibu' => $this->input->post('nama_ibu'),
                'no_telepon_ayah' => $this->input->post('no_telepon_ayah'),
                'no_telepon_ibu' => $this->input->post('no_telepon_ibu'),
                'pekerjaan_ayah' => $this->input->post('pekerjaan_ayah'),
                'pekerjaan_ibu' => $this->input->post('pekerjaan_ibu'),
                'nama_wali' => $this->input->post('nama_wali'),
                'no_telepon_wali' => $this->input->post('no_telepon_wali'),
                'pekerjaan_wali' => $this->input->post('pekerjaan_wali'),
                'alamat_orang_tua' => $this->input->post('alamat_orang_tua'),
                'sumber_informasi' => $this->input->post('sumber_informasi')
            );

           

            if (!empty($id)) {
                // Jika ada ID, berarti ini adalah update
                $data_siswa['updated_at'] = date('Y-m-d H:i:s'); // Pastikan waktu update diperbarui
                $siswa_updated = $this->pendaftaranawal_model->updatePendaftaranAwal($id, $data_siswa);
                if ($siswa_updated) {
                    $ret['status'] = true;
                    $ret['message'] = 'Data berhasil diupdate';
                } else {
                    $ret['status'] = false;
                    $ret['message'] = 'Data gagal diupdate';
                }
            } else {
                // Jika tidak ada ID, berarti ini adalah insert
                $data_siswa['created_at'] = date('Y-m-d H:i:s'); // Menetapkan waktu pembuatan
                $id = $this->pendaftaranawal_model->savePendaftaranAwal($data_siswa);
                if ($id) {
                    $ret['status'] = true;
                    $ret['message'] = 'Data berhasil disimpan';
                } else {
                    $ret['status'] = false;
                    $ret['message'] = 'Data gagal disimpan';
                }
            }

            echo json_encode($ret);
        }
    }

    public function validate_date($date)
    {
        $date = date_create_from_format('Y-m-d', $date);
        if ($date) {
            return true;
        } else {
            $this->form_validation->set_message('validate_date', 'Format tanggal tidak valid.');
            return false;
        }
    }
    public function edit_pendaftaran_awal()
    {
        $id = $this->input->post('id');
        $q = $this->pendaftaranawal_model->getPendaftaranAwalByID($id);

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

    public function delete_pendaftaran_awal()
    {
        $id = $this->input->post('id');
        $data['deleted_at'] = time();
        $q = $this->pendaftaranawal_model->updatePendaftaranAwal($id, $data);
        if ($q) {
            $ret = [
                'status' => true,
                'message' => 'Data berhasil dihapus'
            ];
        } else {
            $ret = [
                'status' => false,
                'message' => 'Data gagal dihapus'
            ];
        }
        echo json_encode($ret);
    }
    public function tambah_nama_pendaftaran()
    {
        $this->load->model('Masterdata_model', 'pendaftaranawal_model');

        // Contoh input
        $id_tahun_pelajaran = $this->input->post('id_tahun_pelajaran'); // 2025
        $id_jurusan = $this->input->post('id_jurusan'); // TI

        // Generate nomor pendaftaran
        $no_pendaftaran = $this->pendaftaranawal_model->generateNamaPendaftaran($id_tahun_pelajaran, $id_jurusan);

        // Data untuk disimpan
        $data = [
            'id_tahun_pelajaran' => $id_tahun_pelajaran,
            'id_jurusan' => $id_jurusan,
            'nama_pendaftaran' => $nama_pendaftaran,
        ];

        // Insert ke database
        $this->pendaftaranawal_model->insertNamapendaftaran($data);

        
    }
    
}