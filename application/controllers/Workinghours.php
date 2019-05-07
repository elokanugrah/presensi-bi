<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Workinghours extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('logined_att') || $this->session->userdata('logined_att') != true)
        {
            redirect('Login');
        }
		$this->load->model('Workinghours_model');
		$this->load->model('Student_model');
	}

	public function index()
	{
		$time=$this->Workinghours_model->getTime("1");
		$data=array(
			'time'	=> $time,
            'action'	=> site_url('Workinghours/timeupdate_action')
        );
		$this->load->view('admin/workinghours', $data);
	}

	public function timeupdate_action()
	{
		$time_in = $this->input->post('time_in');
		if (strlen($this->input->post('time_in')) == 4){
			$time_in = '0' . $this->input->post('time_in');
		}
		$time_out = $this->input->post('time_out');
		if (strlen($this->input->post('time_out')) == 4){
			$time_out = '0' . $this->input->post('time_out');
		}
		$data=array(
            'time_in'  => $time_in,
            'time_out'  => $time_out
        );
        $id='1';
        $this->Workinghours_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Waktu magang berhasil diubah!');
        redirect(site_url('Workinghours'));
	}
}

?>