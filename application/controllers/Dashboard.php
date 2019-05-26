<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if(!$this->session->userdata('logined_att') || $this->session->userdata('logined_att') != true)
        {
            redirect('Login');
        }
        $this->load->model('Attendance_model');
        $this->load->model('Student_model');
        $this->load->model('Workinghours_model');
        $this->load->model('Mentor_model');
        $this->load->model('Workinghours_model');
        $this->load->model('Regis_model');
        $this->load->model('Regisauto_model');
    }

    public function index()
    {
        $start=date("d-m-Y", strtotime('-1 month'));
        $end=date("d-m-Y");
        $date = date("d-M-Y", strtotime($start)).' - '.date("d-M-Y", strtotime($end));
        $attendance=$this->Attendance_model->get_date(date("Y-m-d", strtotime($start)),date("Y-m-d", strtotime($end)));
        $activestudent=$this->Student_model->get_data_activeonly();
        $year_student=$this->Student_model->data_yearandcount();
        $active_level=$this->Student_model->get_data_activelevel();
        $level=$this->Student_model->get_data_level();
        $mentor=$this->Mentor_model->ambil_data();
        $working=$this->Workinghours_model->getTime(1);
        $alreadynotyet=$this->Attendance_model->get_alreadynotyet();
        $latest=$this->Attendance_model->get_latest();
        if(!$this->input->get())
        {
            $data=array(
                'data_attendance'  => $attendance,
                'year_student'  => $year_student,
                'date'             => $date,
                'active_student'    => count($activestudent),
                'mentor'        => count($mentor),
                'working_hours' => $working,
                'already_notyet' => $alreadynotyet,
                'active_level'        => $active_level,
                'level'        => $level,
                'latest'        => $latest->date,
                'start'        => $start,
                'end'        => $end
            );
            $this->load->view('admin/dashboard',$data);
        }
        else
        {
        $start = date("Y-m-d", strtotime($this->input->get('start')));
        $end = date("Y-m-d", strtotime($this->input->get('end')));
        $attendance=$this->Attendance_model->get_date($start,$end);
        $date = date("d-M-Y", strtotime($start)).' - '.date("d-M-Y", strtotime($end));
        $data=array(
            'data_attendance'  => $attendance,
            'year_student'  => $year_student,
            'date'             => $date,
            'active_student'    => count($activestudent),
            'mentor'        => count($mentor),
            'working_hours' => $working,
            'already_notyet' => $alreadynotyet,
            'active_level'        => $active_level,
            'level'        => $level,
            'latest'        => $latest->date,
            'start'        => $start,
            'end'        => $end
        );
        $this->load->view('admin/dashboard',$data);
        } 
    }
}

?>