<?php
<<<<<<< HEAD
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
=======
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
>>>>>>> cd2defb (Update AdminLTE)

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

<<<<<<< HEAD
	public function selamat(){
		echo "ini fungsi selamat datang";
	}
}
=======
	public function selamat()
	{
		echo 'ini fungsi selamat datang';
	}
}
>>>>>>> cd2defb (Update AdminLTE)
