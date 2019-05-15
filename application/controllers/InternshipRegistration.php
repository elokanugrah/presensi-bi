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
        $this->load->model('Regis_model');
	}

	public function index()
	{
        $student=$this->Student_model->ambil_data();
        $max_date=$this->Student_model->get_max_mth();
        $active=count($this->Student_model->get_data_activeonly());
        $lastmonth=date('Y-m-d', strtotime($max_date->date_out));
        $regis=$this->Regis_model->getdata();
        $mentor=$this->Mentor_model->ambil_data();
        $amonthafter = 0;
        $twomonthbafter = 0;
        foreach ($student as $key => $row){
            if (date('Y-m', strtotime('+1 Month')) == date('Y-m', strtotime($row->date_out))){
                $amonthafter++;
            }
            if (date('Y-m', strtotime('+2 Month')) <= date('Y-m', strtotime($row->date_out))) {
                $twomonthbafter++;
            }
        }

        $data=array(
            'data_mentor' => $mentor,
            'data_student' => $student,
            'realslot'  => (15-$twomonthbafter)-$amonthafter,
            'nextmonth' => date('n', strtotime('+1 Month')),
            'lastmonth' => $lastmonth,
            'regis' => $regis
        );
        $this->load->view('admin/registration_table',$data);
    }

    public function post_action()
    {
        $regis_open = ($this->input->post('regis_open')!=true)?0:1;
        $regis_auto = ($this->input->post('regis_auto')!=true)?0:1;
        $data=array(
            'regis_open'  => $regis_open,
            'regis_auto'  => $regis_auto
        );
        $this->Regis_model->edit_data('1',$data);
        redirect(site_url('InternshipRegistration'));
    }
}

?>