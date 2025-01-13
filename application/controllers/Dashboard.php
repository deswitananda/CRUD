<?php
<<<<<<< HEAD
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
	}


	public function index()
	{
		$q = $this->User_model->getUserAll();
		$data['users'] = $q->result();

		$this->load->view('view_dashboard', $data);
	}

	public function add()
	{
		$this->load->view('view_add_user');
	}

	public function save()
	{
		$data['username'] = $this->input->post('username');
		$data['password'] = $this->input->post('password');

		$insert = $this->User_model->insertUser($data);

		if ($insert) {
			redirect('dashboard', 'refresh');
		} else {
			$this->session->set_flashdata('insert_error', 'Data gagal disimpan');
			$this->load->view('view_add_user', $data);
		}
	}

	public function edit($id = null)
	{
		$q = $this->User_model->getUserByID($id);
		$data['user'] = $q->row();

		$this->load->view('view_edit_user', $data);
	}

	public function update_user()
	{
		$id = $this->input->post('id');
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$data = array(
			'username' => $username,
			'password' => $password
		);

		$update = $this->User_model->updateUser($id, $data);

		if ($update) {
			redirect('dashboard', 'refresh');
		} else {
			$this->session->set_flashdata('update_error', 'Data gagal diupdate');
			redirect('dashboard/edit/' . $id, 'refresh');
		}
	}

	public function delete($id = null)
	{
		$this->User_model->deleteUser($id);
		redirect('dashboard', 'refresh');
	}
}

/* End of file: Dashboard.php */
=======
defined('BASEPATH') or exit('Akses langsung tidak diperbolehkan');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Memuat model yang diperlukan
        $this->load->model('User_model');

        // Periksa apakah pengguna sudah login
        log_message('debug', 'Session User ID: ' . $this->session->userdata('user_id'));
        if (!$this->session->userdata('user_id') && $this->router->fetch_class() !== 'login') {
            redirect('login');
        }
    }

    public function index()
    {
        // Ambil data semua pengguna dari database
        $q = $this->User_model->getUserAll();
        $data['users'] = $q->result();

        // Memuat tampilan dashboard dan mengirimkan data pengguna
        $this->load->view('view_dashboard', $data);
    }

    public function add()
    {
        $this->load->view('view_add_user');
    }

    public function save()
    {
        $data['username'] = $this->input->post('username');
        $data['password'] = $this->input->post('password');

        $insert = $this->User_model->insertUser($data);

        if ($insert) {
            redirect('dashboard');  // Arahkan ke halaman dashboard setelah data berhasil disimpan
        } else {
            echo 'Data gagal disimpan';
        }
    }

    // Fungsi AJAX untuk menyimpan atau memperbarui user
    public function ajax_save()
    {
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if ($id) {
            // Jika ada ID, lakukan update
            $data = ['username' => $username, 'password' => $password];
            $this->User_model->updateUser($id, $data);
            echo json_encode([
                'status' => true,
                'message' => 'User berhasil diperbarui',
                'id' => $id,
                'username' => $username,
                'password' => $password
            ]);
        } else {
            // Jika tidak ada ID, lakukan insert (tambah user baru)
            $exists = $this->User_model->getUserByUsername($username);
            if ($exists->num_rows() > 0) {
                echo json_encode(['status' => false, 'message' => 'Username sudah digunakan']);
                return;
            }

            $data = ['username' => $username, 'password' => $password];
            $insert = $this->User_model->insertUser($data);

            echo json_encode([
                'status' => $insert ? true : false,
                'message' => $insert ? 'User berhasil ditambahkan' : 'Gagal menambahkan user',
                'id' => $insert ? $this->db->insert_id() : null,
                'username' => $username,
                'password' => $password
            ]);
        }
    }

    public function edit($id = null)
    {
        $userId = $this->session->userdata('user_id');
        
        // Mengecek jika yang ingin diedit adalah akun pengguna yang sedang login
        if ($id == $userId) {
            $this->session->set_flashdata('notification', 'Anda tidak dapat mengedit akun Anda sendiri!');
            redirect('dashboard');
        }

        $q = $this->User_model->getUserByID($id);
        $data['user'] = $q->row();

        $this->load->view('view_edit_user', $data);
    }

    public function update_user()
    {
        $id = $this->input->post('id');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $data = [
            'username' => $username,
            'password' => $password,
        ];

        $update = $this->User_model->updateUser($id, $data);

        if ($update) {
            $this->session->set_flashdata('notification', 'Data berhasil diperbarui!');
        } else {
            $this->session->set_flashdata('notification', 'Data gagal diperbarui!');
        }

        redirect('dashboard');
    }

    public function delete($id = null)
    {
        $userId = $this->session->userdata('user_id');
        
        // Mengecek jika yang ingin dihapus adalah akun pengguna yang sedang login
        if ($id == $userId) {
            $this->session->set_flashdata('notification', 'Anda tidak dapat menghapus akun Anda sendiri!');
            redirect('dashboard');
        }
    
        $this->User_model->deleteUser($id);
        redirect('dashboard');
    }
}
?>
>>>>>>> cd2defb (Update AdminLTE)