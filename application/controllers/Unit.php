<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Unit extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logined_att') || $this->session->userdata('logined_att') != true)
        {
            redirect('Login');
        }
        $this->load->model('Unit_model');
        $this->load->model('Student_model');
	}

	public function index()
	{
        $unit=$this->Unit_model->ambil_data();
        $data=array(
            'data_unit' => $unit
        );
		$this->load->view('admin/unit_table',$data);
    }

    function add_action()
    {
        $data=array(
            'unit_name'  => $this->input->post('unit')
        );
        $this->Unit_model->data_adding($data);
        $this->session->set_flashdata('input_success', 'Data dengan nama unit <u>'.$this->input->post('unit').'</u> berhasil ditambahkan!');
        redirect(site_url('Unit'));
    }

    function edit($id)
	{
		$data=$this->Unit_model->getdata_by_id($id);
        echo json_encode($data);
	}

    function edit_action()
    {
        $data=array(
            'unit_name'  => $this->input->post('unit'),
        );
        $id=$this->input->post('unit_id');
        $old_name=$this->Unit_model->getdata_by_id($id)->unit_name;
        $this->Unit_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Data dengan nama Unit <u>'.$old_name.'</u> berhasil diubah menjadi <u>'.$this->input->post('unit').'</u>');
        redirect(site_url('Unit'));
    }
    
    function delete($id)
    {
        $unit = $this->Unit_model->getdata_by_id($id);
        $this->Unit_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data dengan nama unit <u>'.$unit->unit_name.'</u> berhasil dihapus!');
        redirect(site_url('Unit'));
    }
}

?>