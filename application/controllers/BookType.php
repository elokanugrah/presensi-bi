<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Booktype extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('Login');
        }
        $this->load->model('Booktype_model');
	}

	public function index()
	{
		$booktype=$this->Booktype_model->getall_data();
        $data=array(
            'data_booktype'  => $booktype,
            'action'        => site_url('Booktype/edit_action')
        );
		$this->load->view('admin/booktype_table',$data);
    }

    function add_action()
    {
        $data=array(
            'booktype_name'    => $this->input->post('booktype_name')
        );
        $this->Booktype_model->add_data($data);
        $this->session->set_flashdata('input_success', 'Data dengan jenis buku '.$this->input->post('booktype_name').' berhasil ditambahkan!');
        redirect(site_url('Booktype'));
    }

    function edit_action()
    {
        $data=array(
            'booktype_name'      => $this->input->post('booktype_name')
        );
        $id=$this->input->post('booktype_id');
        $this->Booktype_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Data dengan jenis buku '.$this->input->post('booktype_name').' berhasil diubah!');
        redirect(site_url('Booktype'));
    }

    function delete($id)
    {
        $booktype = $this->Booktype_model->getdata_by_id($id);
        $this->Booktype_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data dengan jenis buku '.$Booktype->booktype_name.' berhasil dihapus!');
        redirect(site_url('Booktype'));
    }
}

?>