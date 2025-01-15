<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun_pengguna extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Masterdata_model', 'md');
        $this->load->library('form_validation');
	}

	public function index()
	{

		$data = array(
			'menu' => 'backend/menu',
			'content' => 'backend/akunPenggunaKonten',
			'title' => 'Admin'
		);
		$this->load->view('template', $data);
	}

    public function table_user(){
        $q = $this->md->getUserAll();
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


	public function get_all(){
		$q = $this->md->getUserAll(); 
		echo json_encode($q); 
	}

	public function save(){
        $this->form_validation->set_rules('usernmae', 'Username', 'required|tirm');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => false, 'message' => validation_errors()]);
            return;
        }


        $data = array(
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT) // Enkripsi password
        );
    
        $this->md->insertUser($data);
        $users = $this->md->getUserAll()->result(); // Ambil semua user
        echo json_encode($users);
    }
    
    public function update_user(){
        $id = $this->input->post('id');

        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            echo json_encode(['status' => false, 'message' => validation_errors()]);
            return;
        }
    
        $data = array(
            'username' => $this->input->post('username'),
            'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT) // Enkripsi password
        );
    
        $update = $this->md->updateUser($id, $data);
        echo json_encode(['status' => $update > 0, 'message' => 'Update berhasil']);
    }
    

	public function edit($id = null){
        $edit = $this->md->getUserByID($id)->row(); // Ambil data tunggal
        echo json_encode($edit);
    }
    

	public function delete(){
        $id = $this->input->post('id'); // Ambil dari POST
        $delete = $this->md->deleteUser($id);
        echo json_encode(['status' => $delete > 0, 'message' => 'Hapus berhasil']);
    }
    

	public function logout() {
        $this->session->sess_destroy();
        echo json_encode(['status' => true, 'message' => 'Logout berhasil.']);
    }

}