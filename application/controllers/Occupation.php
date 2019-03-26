<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Occupation extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }
        $this->load->model('Occupation_model');
	}

	public function index()
	{
		$occupation=$this->Occupation_model->getall_data();
        $data=array(
            'data_occupation'  => $occupation,
            'action'        => site_url('Occupation/edit_action')
        );
		$this->load->view('admin/occupation_table',$data);
    }

    function add_action()
    {
        $data=array(
            'occupation_name'    => $this->input->post('occupation_name')
        );
        $this->Occupation_model->add_data($data);
        $this->session->set_flashdata('input_success', 'Data dengan status pekerjaan '.$this->input->post('occupation_name').' berhasil ditambahkan!');
        redirect(site_url('Occupation'));
    }

    function edit_action()
    {
        $data=array(
            'occupation_name'      => $this->input->post('occupation_name')
        );
        $id=$this->input->post('occupation_id');
        $this->Occupation_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Data dengan status pekerjaan '.$this->input->post('occupation_name').' berhasil diubah!');
        redirect(site_url('Occupation'));
    }

    function delete($id)
    {
        $occupation = $this->Occupation_model->getdata_by_id($id);
        $this->Occupation_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data dengan status pekerjaan '.$occupation->occupation_name.' berhasil dihapus!');
        redirect(site_url('Occupation'));
    }
}

?>