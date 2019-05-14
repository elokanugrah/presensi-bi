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
        $student=$this->Student_model->ambil_data();
        $mentor=$this->Mentor_model->ambil_data();
        $amonthbefore = 0;
        foreach ($student as $key => $row){
            if (date('Y-m', strtotime('+1 Month')) <= date('Y-m', strtotime($row->date_out))){
                $amonthbefore++;
            }
        }
        $data=array(
            'data_mentor' => $mentor,
            'data_student' => $student,
            'slot'  => $amonthbefore,
            'nextmonth' => date('n', strtotime('+1 Month')),
            'lastmonth' => date('n', strtotime('2019-05-01')),
            'lastmonthh' => $this->Student_model->get_max_mth()
        );
        $this->load->view('admin/registration_table',$data);
    }
}

?>