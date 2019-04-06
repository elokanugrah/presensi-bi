<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class StudentIntern extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        /*if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }*/
		$this->load->model('Student_model');
        $this->load->model('Attendance_model');
	}

	public function index()
	{
		$student=$this->Student_model->ambil_data();
        $data=array(
            'data_student'  => $student
        );
		$this->load->view('admin/student_table',$data);
    }

    public function student($id)
    {
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
        $this->load->view('admin/student_attendance',$data);
    }

    function add_action()
    {
        $data=array(
            'id_number'  => $this->input->post('id_number'),
            'name'      => $this->input->post('name'),
            'sex'    => $this->input->post('sex'),
            'active' => $this->input->post('active'),
            'collage' => $this->input->post('collage'),
            'address' => $this->input->post('address')
        );
        $this->Student_model->data_adding($data);
        $this->session->set_flashdata('input_success', 'Data dengan NIM '.$this->input->post('id_number').' a/n '.$this->input->post('name').' berhasil ditambahkan!');
        redirect(site_url('StudentIntern'));
    }

    function edit($id)
	{
		$data=$this->Student_model->getdata_by_id($id);
        echo json_encode($data);
	}

    function edit_action()
    {
        $data=array(
            'id_number'  => $this->input->post('id_number'),
            'name'      => $this->input->post('name'),
            'sex'    => $this->input->post('sex'),
            'active' => $this->input->post('active'),
            'collage' => $this->input->post('collage'),
            'address' => $this->input->post('address')
        );
        $id=$this->input->post('student_id');
        $this->Student_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Data dengan NIM '.$this->input->post('id_number').' a/n '.$this->input->post('name').' berhasil diubah!');
        redirect(site_url('StudentIntern'));
    }

    function print($id)
    {
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
    
    function delete($id)
    {
        $student = $this->Student_model->getdata_by_id($id);
        $this->Student_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data dengan NIM '.$student->id_number.' a/n '.$student->name.' berhasil dihapus!');
        redirect(site_url('StudentIntern'));
    }
}

?>