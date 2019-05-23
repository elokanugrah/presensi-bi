<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Mentor extends CI_Controller
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
        $mentor=$this->Mentor_model->ambil_data();
        $data=array(
            'data_mentor' => $mentor
        );
		$this->load->view('admin/mentor_table',$data);
    }

    function add_action()
    {
        $data=array(
            'nip'  => $this->input->post('nip'),
            'name'  => $this->input->post('name')
        );
        $this->Mentor_model->data_adding($data);
        $this->session->set_flashdata('input_success', 'Data dengan NIP '.$this->input->post('nip').' a/n '.$this->input->post('name').' berhasil ditambahkan!');
        redirect(site_url('Mentor'));
    }

    function edit($id)
	{
		$data=$this->Mentor_model->getdata_by_id($id);
        echo json_encode($data);
	}

    function edit_action()
    {
        $data=array(
            'nip'  => $this->input->post('nip'),
            'name'  => $this->input->post('name')
        );
        $id=$this->input->post('mentor_id');
        $this->Mentor_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Data dengan NIP '.$this->input->post('nip').' a/n '.$this->input->post('name').' berhasil diubah!');
        redirect(site_url('Mentor'));
    }
    
    function delete($id)
    {
        $mentor = $this->Mentor_model->getdata_by_id($id);
        $this->Mentor_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data dengan NIP '.$mentor->nip.' a/n '.$mentor->name.' berhasil dihapus!');
        redirect(site_url('Mentor'));
    }
}

?>