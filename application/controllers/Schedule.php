<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Schedule extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Student_model');
        $this->load->model('Attendance_model');
	}

	public function index()
	{
		$this->load->view('admin/schedule');
	}
}

?>