<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Student extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->helper(array('form', 'url'));
		$this->load->model('Student_model');
        $this->load->model('Attendance_model');
        $this->load->model('Mentor_model');
	}

	public function index()
	{
        if($this->session->userdata('id_std') || $this->session->userdata('student_att') == true)
        {
            redirect('Student/info');
        }
        if(!$this->input->post())
        {
            $this->load->view('student/student_qrcode');
        }
        else
        {
            $qr=$this->Student_model->getdata_by_qr(
                $this->input->post('qrcode_id')
                );
            if(!empty($qr))
            {
                $this->session->set_userdata('student_att', true);
                $this->session->set_userdata('id_std', $qr->student_id);
                redirect("Student/info");
            }
            else 
            {
                $this->session->set_flashdata('login_message','QR Code tidak ditemukan!');
                redirect("Student");
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('id_std');
        $this->session->unset_userdata('student_att');
        redirect("Student");
    }

    public function info()
    {
        if(!$this->session->userdata('id_std') || $this->session->userdata('student_att') != true)
        {
            redirect('Student');
        }
        $id=$this->session->userdata('id_std');
        $student=$this->Student_model->getdata_by_id($id);
        $attendance=$this->Attendance_model->getall_by_student($id);
        $percentage=$this->Attendance_model->get_percentage($id);
        $in_stats=$this->Attendance_model->get_instats($id);
        $data=array(
            'data_student'  => $student,
            'data_attendance'  => $attendance,
            'data_percent' => $percentage->percentage,
            'present' => $percentage->present,
            'alpha' => $percentage->alpha,
            'sick' => $percentage->sick,
            'permit' => $percentage->permit,
            'nan' => $percentage->nan,
            'total' => $percentage->total,
            'in_stats' => $in_stats
        );
        $this->load->view('student/student_info',$data);
    }

    function print($id)
    {
        if(!$this->session->userdata('id_std') || $this->session->userdata('student_att') != true)
        {
            redirect('Student');
        }
        $student=$this->Student_model->getdata_by_id($id);
        $attendance=$this->Attendance_model->getall_by_student($id);
        $percentage=$this->Attendance_model->get_percentage($id);
        $in_stats=$this->Attendance_model->get_instats($id);
        $data=array(
            'data_student'  => $student,
            'data_attendance'  => $attendance,
            'data_percent' => $percentage->percentage,
            'present' => $percentage->present,
            'alpha' => $percentage->alpha,
            'sick' => $percentage->sick,
            'permit' => $percentage->permit,
            'nan' => $percentage->nan,
            'total' => $percentage->total,
            'in_stats' => $in_stats
        );
        $this->load->view('admin/student_attendance_print',$data);
    }
}

?>