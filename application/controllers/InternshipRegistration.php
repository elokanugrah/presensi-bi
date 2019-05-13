<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class InternshipRegistration extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logined_att') || $this->session->userdata('logined_att') != true)
        {
            redirect('Login');
        }
        $this->load->model('Mentor_model');
        $this->load->model('Student_model');
	}

	public function index()
	{
        $mentor=$this->Mentor_model->ambil_data();
        $data=array(
            'data_mentor' => $mentor
        );
        $this->load->view('admin/registration_table',$data);
    }
}

?>