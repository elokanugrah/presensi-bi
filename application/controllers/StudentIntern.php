<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class StudentIntern extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }
		$this->load->model('Student_model');
	}

	public function index()
	{
		$student=$this->Student_model->ambil_data();
        $data=array(
            'data_student'  => $student,
            'action'        => site_url('student/edit_action')
        );
		$this->load->view('admin/student_table',$data);
    }

    function add()
    {
        $data=array(
            'student_id'    => set_value('pegawai_id'),
            'id_number'     => set_value('nip'),
            'name'          => set_value('nidn'),
            'sex'           => set_value('nama_pegawai'),
            'active'        => set_value('inisial'),
            'collage'       => set_value('prodi_id'),
            'address'       => set_value('prodi_idd'),
            'action'        => site_url('StudentIntern/add_action')
        );
        $this->load->view('admin/student_form',$data);
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
		$student=$this->Student_model->getdata_by_id($id);
        $data=array(
            'student_id'           => set_value('student_id',$student->student_id),    
            'id_number'           => set_value('id_number',$student->id_number),
            'name'          => set_value('name',$student->name),
            'sex'  => set_value('sex',$student->sex),
            'active'       => set_value('active',$student->active),
            'collage'       => set_value('collage',$student->collage),
            'address'       => set_value('address',$student->address),
            'action'    => site_url('StudentIntern/edit_action')
        );
        $this->load->view('admin/student_form',$data);
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

    function delete($id)
    {
        $student = $this->Student_model->getdata_by_id($id);
        $this->Student_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data dengan NIM '.$student->id_number.' a/n '.$student->name.' berhasil dihapus!');
        redirect(site_url('StudentIntern'));
    }
}

?>