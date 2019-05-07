<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Login extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Login_model');
	}

	public function index()
	{
		if($this->session->userdata('logined_att') && $this->session->userdata('uname_att') == true)
		{
			redirect('Dashboard');
		}
		
		if(!$this->input->post())
		{
			$this->load->view('login');
		}
		else
		{
			$cek_uname=$this->Login_model->getUserByUname(
				$this->input->post('username')
				);
			if(!empty($cek_uname))
			{
				$salt = $cek_uname->salt;
				$encrypted_password = $cek_uname->encrypted_password;
				$hash = base64_encode(sha1($this->input->post('password') . $salt, true) . $salt);
				//$this->session->set_userdata('logined', true);
				if ($encrypted_password == $hash) {
                // autentikasi user berhasil
					$this->session->set_userdata('logined_att', true);
					$this->session->set_userdata('uname_att', $cek_uname->username);
					redirect("Dashboard");
            	} else {
            		$this->session->set_flashdata('login_message','Password salah!');
					redirect("Login");
            	}
			}
			else 
			{
				$this->session->set_flashdata('login_message','username tidak ditemukan!');
				redirect("Login");
			}
		}
	}

	public function logout()
    {
		$this->session->unset_userdata('logined_att');
		$this->session->unset_userdata('uname_att');
		redirect("Login");
    }
}

?>