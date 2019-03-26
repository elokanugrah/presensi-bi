<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class GuestBook extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Guest_model');
		$this->load->model('Guestbook_model');
		$this->load->model('Occupation_model');
	}

	public function index()
	{
		
		if(!$this->input->post())
		{
			$this->load->view('guestbook');
		}
		else
		{
			$cek_guest=$this->Guest_model->cek_member(
				$this->input->post('id_number'),
				$this->input->post('name')
				);
			if(!empty($cek_guest))
			{
				date_default_timezone_set("Asia/Bangkok");
				$cek_guestbook=$this->Guestbook_model->getdata_by_memberid($cek_guest->member_id);
				if(empty($cek_guestbook)){
					$data=array(
			            'member_id' => $cek_guest->member_id,
			            'date'		=> date("Y-m-d"),
			            'time'		=> date("H.i")
			        );
			        $this->Guestbook_model->data_adding($data);
					$this->session->set_flashdata('input_success', 'Selamat datang '.$cek_guest->name);
					redirect("/");
				} 
				if (!empty($cek_guestbook) && (date("H.i") >= date("H.i", strtotime($cek_guestbook->time)+14400))) {
					$data=array(
			            'member_id' => $cek_guest->member_id,
			            'date'		=> date("Y-m-d"),
			            'time'		=> date("H.i")
			        );
			        $this->Guestbook_model->data_adding($data);
					$this->session->set_flashdata('input_success', 'Selamat datang '.$cek_guest->name);
					redirect("/");
				}
				else {
					$this->session->set_flashdata('failed_message', 'Maaf anda sudah mengisi buku tamu sebelumnya');
					redirect("/");
				}
			}
			else 
			{
				$this->session->set_flashdata('guest_message','Identitas tidak ditemukan');
				$this->session->set_flashdata('id_number', $this->input->post('id_number'));
				$this->session->set_flashdata('name', $this->input->post('name'));
				redirect("/");
			}
		}
	}

    public function register_action()
    {
    	if (!empty($this->input->post('occupation')))
			{
				$data=array(
	            'id_number'  => $this->input->post('id_number'),
	            'name'      => $this->input->post('name'),
	            'sex'      => $this->input->post('sex'),
	            'occupation'    => $this->input->post('occupation'),
	            'instance' => $this->input->post('instance'),
	            'address' => $this->input->post('address')
        		);
			} else {
				$data=array(
	            'id_number'  => $this->input->post('id_number'),
	            'name'      => $this->input->post('name'),
	            'sex'      => $this->input->post('sex'),
	            'occupation'    => 'Lainnya',
	            'instance' => $this->input->post('instance'),
	            'address' => $this->input->post('address')
        		);
			}
        $this->Guest_model->data_adding($data);
        $this->session->set_flashdata('input_success', 'Data baru berhasil ditambahkan');
        redirect(site_url('/'));
    }
}

?>