<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Attendance extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Student_model');
        $this->load->model('Attendance_model');
	}

	public function index()
	{
		
		$this->load->view('attendance');
	}

	function edit_student_attendance($id)
    {
        $data=array(
            'attendance'  => $this->Attendance_model->getdata_by_id($id)
        );
        echo json_encode($data);
    }

    function edit_student_attendance_action()
    {
        $data=array(
            'note'      => $this->input->post('note')
        );
        $id=$this->input->post('attendance_id');
        $s_id=$this->input->post('student_id');
        $this->Attendance_model->edit_data($id,$data);
        redirect(site_url('StudentIntern/student/'.$s_id));
    }
}

?>