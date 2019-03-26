<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class ResetPassword extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->model('Token_model');
		$this->load->model('Login_model');
        $this->load->model('Email_model');
	}

	public function reset()
	{
        date_default_timezone_set("Asia/Bangkok");
        $getemail=$this->Login_model->getEmail();
        $email = $getemail->email;
        $salt = sha1(rand());
        $salt = substr($salt, 0, 30);
        $date = date("Y-m-d");
        $time = date("H.i");
        $token = base64_encode(sha1($date, true) . $salt);
        $data=array(
                'token' => $token,
                'salt' => $salt,
                'email' => $email,
                'time' => $time
                );
        $this->Token_model->add_data($data); 
        redirect(site_url('ResetPassword/tokenisvalid/'.$token));
    }

    public function tokenisvalid($token)
    {
        date_default_timezone_set("Asia/Bangkok");
        $gettoken=$this->Token_model->get_last_data();
        $salt = $gettoken->salt;
        $email = $gettoken->email;
        $date = date("Y-m-d");
        $time = $gettoken->time;
        $qstring = base64_encode(sha1($date, true) . $salt);
        if ($qstring == $token){
            $admin=$this->Login_model->getUserByEmail($email);
            $user=$admin->name;
            $link = site_url('/ResetPassword/token/'.$token);
            $this->Email_model->sendVerificatinEmail($email,$user,$link);
            $this->session->set_flashdata('email_success','Silahkan periksa pesan masuk pada email anda!');
            redirect('Login');
        } else {
            echo "Terjadi kesalahan token, silahkan ulangi kembali. Terima kasih.";
        }
    }

    public function token($token)
    {
        date_default_timezone_set("Asia/Bangkok");
        if (!empty($gettoken=$this->Token_model->get_last_data())) {
            $salt = $gettoken->salt;
            $email = $gettoken->email;
            $date = date("Y-m-d");
            $time = $gettoken->time;
            $qstring = base64_encode(sha1($date, true) . $salt);
            if ($qstring == $token){
                if (date("H.i") <= date("H.i", strtotime($time)+300)) {
                    $admin=$this->Login_model->getUserByEmail($email);
                    $this->session->set_userdata('logined', true);
                    $this->session->set_userdata('uname', $admin->username);
                    $this->Token_model->delete_data($gettoken->token_id);
                    $this->session->set_flashdata('reset_password', true);
                    redirect(site_url('Profile/password_reset/'));
                } else {
                    $this->Token_model->delete_data($gettoken->token_id);
                    echo "Token sudah kadarluarsa";
                }
            } else {
                echo "Terjadi kesalahan";
            }
        } else {
            echo "Token sudah digunakan";
        }
        
    }
}

?>