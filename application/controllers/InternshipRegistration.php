<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class InternshipRegistration extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logined_att') || $this->session->userdata('logined_att') != true)
        {
            redirect('Login');
        }
        $this->load->model('Student_model');
        $this->load->model('Regis_model');
        $this->load->model('Regisauto_model');
	}

	public function index()
	{
        $student=$this->Student_model->ambil_data();
        $max_date=$this->Student_model->get_max_mth();
        $active=count($this->Student_model->get_data_activeonly());
        $lastmonth=date('Y-m-d', strtotime($max_date->date_out));
        $regis=$this->Regisauto_model->getdata();
        $open = ($regis->start == '0000-00-00') ? date("d-m-Y") : date('d-m-Y', strtotime($regis->start));
        $end = ($regis->end == '0000-00-00') ? date("d-m-Y", strtotime('+30 days')) : date('d-m-Y', strtotime($regis->end));
        $registered=$this->Regis_model->ambil_data();
        $amonthafter = 0;
        $twomonthbafter = 0;
        foreach ($student as $key => $row){
            if (date('Y-m', strtotime('+1 Month')) == date('Y-m', strtotime($row->date_out))){
                $amonthafter++;
            }
            if (date('Y-m', strtotime('+2 Month')) <= date('Y-m', strtotime($row->date_out))) {
                $twomonthbafter++;
            }
        }

        $data=array(
            'data_regis' => $registered,
            'data_student' => $student,
            'realslot'  => ($regis->slot-$twomonthbafter)-$amonthafter,
            'nextmonth' => date('n', strtotime('+1 Month')),
            'lastmonth' => $lastmonth,
            'regis' => $regis,
            'open' => $open,
            'close' => $end
        );
        $this->load->view('admin/registration_table',$data);
    }

    public function post_action()
    {
        $regis_auto = ($this->input->post('regis_auto')!=true)?0:1;
        $regis_open = ($this->input->post('regis_open')!=true)?0:1;

        if ($this->input->post('regis_auto')!=true) {
            if ($this->input->post('regis_open')==true) {
                $start = date('Y-m-d', strtotime($this->input->post('start')));
                $end = date('Y-m-d', strtotime($this->input->post('end')));
            }else{
               $start = '';
               $end = '';
            }
        } else {
            $start = '';
            $end = '';
        }
        $data=array(
            'regis_open'  => $regis_open,
            'regis_auto'  => $regis_auto,
            'start'       => $start,
            'end'         => $end
        );
        $this->Regisauto_model->edit_data('1',$data);
        redirect(site_url('InternshipRegistration'));
    }

    public function slot_action()
    {
        $data=array(
            'slot'  => $this->input->post('slot')
        );
        $this->Regisauto_model->edit_data('1',$data);
        redirect(site_url('InternshipRegistration'));
    }

    public function applicant($id)
    {
        $applicant=$this->Regis_model->getdata_by_id($id);
        $data=array(
            'applicant'  => $applicant,
            'approve_action' => site_url('InternshipRegistration/approve')
        );
        $data2=array(
            'already_read'  => 1
        );
        $this->Regis_model->edit_data($id, $data2);
        $this->load->view('admin/applicant_detil', $data);
    }

    public function approve()
    {
        $id=$this->input->post('reg');
        $data=array(
            'approve'      => $this->input->post('submit')
        );
        $this->Regis_model->edit_data($id,$data);
        $this->load->view('admin/applicant_detil', $data);
    }

}

?>