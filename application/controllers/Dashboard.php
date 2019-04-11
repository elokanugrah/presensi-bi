<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        /*if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('Login');
        }*/
        $this->load->model('Attendance_model');
        $this->load->model('Student_model');
        $this->load->model('Workinghours_model');
        $this->load->model('Mentor_model');
        $this->load->model('Workinghours_model');
    }

    public function index()
    {
        $start=date("Y-m-d", strtotime('first day of this month'));
        $end=date("Y-m-d");
        $date = date("d-M-Y", strtotime($start)).' - '.date("d-M-Y", strtotime($end));
        $attendance=$this->Attendance_model->get_date($start,$end);
        $activestudent=$this->Student_model->get_data_activeonly();
        $origin=$this->Student_model->get_data_origin();
        $mentor=$this->Mentor_model->ambil_data();
        $working=$this->Workinghours_model->getTime(1);
        $alreadynotyet=$this->Attendance_model->get_alreadynotyet();
        if(!$this->input->get())
        {
            $data=array(
                'data_attendance'  => $attendance,
                'date'             => $date,
                'active_student'    => count($activestudent),
                'mentor'        => count($mentor),
                'working_hours' => $working,
                'already_notyet' => $alreadynotyet,
                'origin'        => $origin
            );
            $this->load->view('admin/dashboard',$data);
        }
        else
        {
        $start = date("Y-m-d", strtotime(substr($this->input->get('date'), 0, 11)));
        $end = date("Y-m-d", strtotime(substr($this->input->get('date'), 14, 11)));
        $attendance=$this->Attendance_model->get_date($start,$end);
        $date = date("d-M-Y", strtotime($start)).' - '.date("d-M-Y", strtotime($end));
        $data=array(
            'data_attendance'  => $attendance,
            'date'             => $date,
            'active_student'    => count($activestudent),
            'mentor'        => count($mentor),
            'working_hours' => $working,
            'already_notyet' => $alreadynotyet,
            'origin'        => $origin
        );
        $this->load->view('admin/dashboard',$data);
        } 
    }
}

?>