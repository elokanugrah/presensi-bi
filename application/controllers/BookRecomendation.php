<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Bookrecomendation extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Bookrecomendation_model');
		$this->load->model('Booktype_model');
		$this->load->model('Guest_model');
		$this->load->model('Guestbook_model');
	}

	public function index()
	{
		date_default_timezone_set("Asia/Bangkok");
		if(!$this->input->post())
		{
			$booktype=$this->Booktype_model->getall_data();
			$data=array(
	            'data_booktype'  => $booktype
	            );
	        $this->load->view('book_recomendation',$data);
		}
		else
		{
			$cek_guest=$this->Guest_model->cek_member(
				$this->input->post('id_number'),
				$this->input->post('name')
				);
			if(!empty($cek_guest))
			{
				$cek_guestbook=$this->Guestbook_model->cek_member_today(
					$cek_guest->member_id,
					date("Y-m-d")
					);
				if(!empty($cek_guestbook))
				{
					$data=array(
		            'member_id'    => $cek_guest->member_id,
					'type'    => $this->input->post('type'),
					'title'    => $this->input->post('title'),
					'author'    => $this->input->post('author'),
					'version'    => $this->input->post('version'),
					'publisher'    => $this->input->post('publisher'),
					'publication_year'    => $this->input->post('publication_year'),
					'date'    => date("Y-m-d")
			        );
			        $this->Bookrecomendation_model->add_data($data);
					$this->session->set_flashdata('success_message', 'Berhasil-berhasil hore!');
					redirect("BookRecomendation");
				}
				else 
				{
					$this->session->set_flashdata('failed_message', 'Silahkan masuk ke <a href="'.site_url('/').'">buku tamu</a> terlebih dahulu');
					redirect("BookRecomendation");
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
}

?>