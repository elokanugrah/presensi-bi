<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Guest extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }
		$this->load->model('Guest_model');
        $this->load->model('Occupation_model');
	}

	public function index()
	{
		$guest=$this->Guest_model->ambil_data();
        $data=array(
            'data_guest'  => $guest,
            'action'        => site_url('Guest/edit_action')
        );
		$this->load->view('admin/guest_table',$data);
    }

    function edit($id)
	{
		$guest=$this->Guest_model->getdata_by_id($id);
        $occupation_data=$this->Occupation_model->getall_data();
        $data=array(
            'member_id'           => set_value('member_id',$guest->member_id),    
            'id_number'           => set_value('id_number',$guest->id_number),
            'name'          => set_value('name',$guest->name),
            'sex'  => set_value('sex',$guest->sex),
            'occupation'       => set_value('occupation',$guest->occupation),
            'instance'       => set_value('instance',$guest->instance),
            'address'       => set_value('address',$guest->address),
            'occupation_data' => $occupation_data,
            'action'    => site_url('Guest/edit_action')
        );
        $this->load->view('admin/guest_form',$data);
	}

    function edit_action()
    {
        $data=array(
            'id_number'  => $this->input->post('id_number'),
            'name'      => $this->input->post('name'),
            'sex'    => $this->input->post('sex'),
            'occupation' => $this->input->post('occupation'),
            'instance' => $this->input->post('instance'),
            'address' => $this->input->post('address')
        );
        $id=$this->input->post('member_id');
        $this->Guest_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Data dengan nomor identitas '.$this->input->post('id_number').' a/n '.$this->input->post('name').' berhasil diubah!');
        redirect(site_url('Guest'));
    }

    function delete($id)
    {
        $guest = $this->Guest_model->getdata_by_id($id);
        $this->Guest_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data dengan nomor identitas '.$guest->id_number.' a/n '.$guest->name.' berhasil dihapus!');
        redirect(site_url('Guest'));
    }
}

?>