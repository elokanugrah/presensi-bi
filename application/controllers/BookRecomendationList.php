<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class BookrecomendationList extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('Login');
        }
		$this->load->model('Bookrecomendation_model');
	}

	public function index()
	{
		$booktype=$this->Bookrecomendation_model->get_data_group();
        $data=array(
            'data_booktype'  => $booktype,
            'data_bookrecomendation'  => '',
        );
		$this->load->view('admin/bookrecomendation_list',$data);
	}

	function type($tp)
    {
        $bookrecomendation=$this->Bookrecomendation_model->data_by_type($tp);
        $data=array(
            'data_bookrecomendation'  => $bookrecomendation
        );
        $this->load->view('admin/bookrecomendation_list',$data);
    }

    function delete($id)
    {
        $bookrecomendation = $this->Bookrecomendation_model->getdata_by_id($id);
        $this->Bookrecomendation_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data dengan judul '.$bookrecomendation->title.' berhasil dihapus!');
        redirect(site_url('BookrecomendationList/type/'.$bookrecomendation->type));
    }
}

?>