<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class GuestBookList extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }
		$this->load->model('Guest_model');
		$this->load->model('Guestbook_model');
	}

	public function index()
	{
		$guestbook=$this->Guestbook_model->data_yearandcount();
        $data=array(
            'data_guestbook'  => $guestbook,
            'text'			=> 'tahun'
        );
		$this->load->view('admin/guestbook_list',$data);
	}

	function year($yr)
    {
        $guestbook=$this->Guestbook_model->data_monthcount($yr);
        $data=array(
            'data_guestbook'  => $guestbook,
            'text'			=> 'bulan'
        );
        $this->load->view('admin/guestbook_list',$data);
    }

    function month($yr, $mt, $mt_name)
    {
        $guestbook=$this->Guestbook_model->data_by_yearmonth($yr, $mt);
        $data=array(
            'data_guestbook'  => $guestbook,
            'text'			=> $mt_name . ' ' .$yr
        );
        $this->load->view('admin/guestbook_list',$data);
    }

    function delete($id)
    {
        $guestbook = $this->Guestbook_model->getdata_by_id($id);
        $this->Guestbook_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data dengan nomor identitas '.$guestbook->id_number.' a/n '.$guestbook->name.' berhasil dihapus!');
        redirect(site_url('GuestBookList/month/'.$guestbook->year.'/'.$guestbook->month.'/'.$guestbook->month_name));
    }
}

?>