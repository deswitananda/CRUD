<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation'); // Load library form_validation
        $this->load->database(); // Load database
        $this->load->helper(['url', 'form']); // Load helper untuk URL dan Form
        $this->load->library('session'); // Load library session
    }

    // Menampilkan form login
    public function index()
    {
        $this->load->view('view_login');
    }

    // Proses login
    public function proses_login()
    {
        // Aturan validasi input
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == FALSE) {
            // Jika validasi gagal
            $this->session->set_flashdata('error', 'Username dan Password harus diisi!');
            redirect('login');
        } else {
            // Ambil input dari form
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            // Cari pengguna di database
            $user = $this->db->where('username', $username)->get('user')->row();

            // Cek apakah username dan password cocok
            if ($user && $user->password === $password) {
                // Login berhasil
                $this->session->set_userdata(['user_id' => $user->id, 'username' => $user->username]);
                redirect('admin'); // Arahkan ke halaman admin
            } else {
                // Login gagal
                $this->session->set_flashdata('error', 'Username atau password salah');
                redirect('login');
            }
        }
    }

    // Logout
    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}
