<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class EduLvl extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logined_att') || $this->session->userdata('logined_att') != true)
        {
            redirect('Login');
        }
        $this->load->model('EduLvl_model');
        $this->load->model('Student_model');
        $this->load->model('Regis_model');
        $this->load->model('Regisauto_model');
	}

	public function index()
	{
        $level=$this->EduLvl_model->ambil_data();
        $data=array(
            'data_level' => $level
        );
		$this->load->view('admin/edulevel_table',$data);
    }

    function add_action()
    {
        $data=array(
            'edulvl_name'  => $this->input->post('level')
        );
        $this->EduLvl_model->data_adding($data);
        $this->session->set_flashdata('input_success', 'Data dengan nama level pendidikan <u>'.$this->input->post('level').'</u> berhasil ditambahkan!');
        redirect(site_url('EduLvl'));
    }

    function edit($id)
	{
		$data=$this->EduLvl_model->getdata_by_id($id);
        echo json_encode($data);
	}

    function edit_action()
    {
        $data=array(
            'edulvl_name'  => $this->input->post('level'),
        );
        $id=$this->input->post('edulvl_id');
        $old_name=$this->EduLvl_model->getdata_by_id($id)->edulvl_name;
        $this->EduLvl_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Data dengan nama level pendidikan <u>'.$old_name.'</u> berhasil diubah menjadi <u>'.$this->input->post('level').'</u>');
        redirect(site_url('EduLvl'));
    }
    
    function delete($id)
    {
        $level = $this->EduLvl_model->getdata_by_id($id);
        $this->EduLvl_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data dengan nama level pendidikan <u>'.$level->edulvl_name.'</u> berhasil dihapus!');
        redirect(site_url('EduLvl'));
    }
}

?>