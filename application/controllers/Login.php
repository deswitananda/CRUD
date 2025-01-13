<?php
<<<<<<< HEAD
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    
    const VALID_EMAIL = 'admin';
    const VALID_PASSWORD = '12345';

=======
defined('BASEPATH') or exit('No direct scirpt access allowed');

class Login extends CI_Controller
{
>>>>>>> cd2defb (Update AdminLTE)
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('view_login');
    }

    public function proses_login()
    {
<<<<<<< HEAD
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $errors = [];
        if (empty($email)) {
            $errors['email'] = 'Email wajib diisi';
        }
        if (empty($password)) {
            $errors['password'] = 'Password wajib diisi';
        }

        if (!empty($errors)) {
          
            echo json_encode([
                'status' => false,
                'element' => array_keys($errors),
                'error' => array_values($errors),
                'message' => 'Login Gagal'
            ]);
            return;
        }

      
        if ($email === self::VALID_EMAIL && $password === self::VALID_PASSWORD) {
            echo json_encode([
                'status' => true,
                'email' => $email,
                'password' => $password,
                'message' => 'Login Berhasil'
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'element' => ['email', 'password'],
                'error' => ['Email atau password salah', 'Email atau password salah'],
                'message' => 'Login Gagal'
            ]);
        }
    }
}
=======
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        log_message('debug', 'Proses login dimulai');
        log_message('debug', 'Username: ' . $username);
        log_message('debug', 'Password: ' . $password);

        // Cek username dan password di database
        $user = $this->db->where('username', $username)->where('password', $password)->get('user')->row();

        if ($user) {
            // Set session untuk pengguna yang berhasil login
            $this->session->set_userdata(['user_id' => $user->id]);
            log_message('debug', 'Login sukses, session user_id diset: ' . $user->id);

            // Arahkan ke halaman dashboard
            redirect('dashboard');
        } else {
            log_message('debug', 'Login gagal, username atau password salah');
            $this->session->set_flashdata('error', 'Username atau password salah');
            redirect('login');
        }
    }

    // Fungsi untuk logout
    public function logout()
    {
        // Hapus session pengguna
        $this->session->sess_destroy();

        // Arahkan ke halaman login
        redirect('login');
    }
}
?>
>>>>>>> cd2defb (Update AdminLTE)
