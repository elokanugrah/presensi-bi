<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Profile extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('Login');
        }
		$this->load->model('Login_model');
        $this->load->model('Token_model');
	}

	public function index()
	{
        $uname = $this->session->userdata('uname');
        $admin=$this->Login_model->getUserByUname($uname);
        $data=array(
            'resetpassword' => false,
            'data_admin'  => $admin,
            'action_username' => site_url('Profile/edit_action'),
            'action_password' => site_url('Profile/reset_password')
            );
		$this->load->view('admin/Profile', $data);
    }

    function edit_action()
    {
        $data=array(
            'username'  => $this->input->post('username'),
            'email'  => $this->input->post('email')
        );
        $id=$this->input->post('admin_id');
        $this->Login_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Profil berhasil diubah, silahkan login kembali dengan username baru');
        $this->session->unset_userdata('logined');
        $this->session->unset_userdata('uname');
        redirect(site_url('Login'));
    }

    function reset_password()
    {
        $uname = $this->session->userdata('uname');
        $cek_uname=$this->Login_model->getUserByUname($uname);
        $salt = $cek_uname->salt;
        $encrypted_password = $cek_uname->encrypted_password;
        $hash = base64_encode(sha1($this->input->post('old_password') . $salt, true) . $salt);

        if ($encrypted_password == $hash) {
            // autentikasi user berhasil
            $salt = sha1(rand());
            $salt = substr($salt, 0, 10);
            $data=array(
                'encrypted_password' => base64_encode(sha1($this->input->post('confirm_password') . $salt, true) . $salt),
                'salt' => $salt
                );
            $id=$this->input->post('admin_id');
            $this->Login_model->edit_data($id,$data);
            $this->session->set_flashdata('edit_success', 'Passsword berhasil direset, silahkan login kembali dengan username baru');
            $this->session->unset_userdata('logined');
            $this->session->unset_userdata('uname');
            redirect(site_url('Login'));
        } else {
            $this->session->set_flashdata('failed_message','Password lama salah!');
            redirect("Profile");
        }
    }

    public function password_reset()
    {
        if (!$this->session->has_userdata('reset_password')){
            $resetpassword=false;
            redirect("Profile");
        } else {
            $resetpassword=true;
        }
        $uname = $this->session->userdata('uname');
        $admin=$this->Login_model->getUserByUname($uname);
        $data=array(
            'resetpassword' => $resetpassword,
            'data_admin'  => $admin,
            'action_username' => site_url('Profile/edit_action'),
            'action_resetpassword' => site_url('Profile/action_resetpassword')
            );
        $this->load->view('admin/Profile', $data);
        
    }

    function action_resetpassword()
    {
        $uname = $this->session->userdata('uname');

        // autentikasi user berhasil
        $salt = sha1(rand());
        $salt = substr($salt, 0, 10);
        $data=array(
            'encrypted_password' => base64_encode(sha1($this->input->post('confirm_password') . $salt, true) . $salt),
            'salt' => $salt
            );
        $id=$this->input->post('admin_id');
        $this->Login_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Passsword berhasil direset, silahkan login kembali dengan username baru');
        $this->session->unset_userdata('logined');
        $this->session->unset_userdata('uname');
        redirect(site_url('Login'));
    }
}

?>