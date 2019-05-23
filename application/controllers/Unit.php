<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Unit extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        $this->load->helper(array('form', 'url'));
        if(!$this->session->userdata('logined_att') || $this->session->userdata('logined_att') != true)
        {
            redirect('Login');
        }
        $this->load->model('Unit_model');
        $this->load->model('Student_model');
        $this->load->model('Regis_model');
	}

	public function index()
	{
        $unit=$this->Unit_model->ambil_data();
        $data=array(
            'data_unit' => $unit
        );
		$this->load->view('admin/unit_table',$data);
    }

    function add_action()
    {
        $data=array(
            'unit_icon'    => $this->_uploadImage(),
            'unit_name'  => $this->input->post('unit'),
            'description'  => 'Belum ada deskripsi',
            'active'  => $this->input->post('active')
        );
        $this->Unit_model->data_adding($data);
        $this->session->set_flashdata('input_success', 'Data dengan nama unit <u>'.$this->input->post('unit').'</u> berhasil ditambahkan!. Selahkan tambahkan deskripsi pada tabel.');
        redirect(site_url('Unit'));
    }

    function active($id)
    {
        $unit=$this->Unit_model->getdata_by_id($id);
        $active=($unit->active != true)? 1 : 0;
        $data=array(
            'active'    => $active
        );
        $this->Unit_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Data dengan nama Unit <u>'.$unit->unit_name.'</u> berhasil <u>di'.(($unit->active != true)? 'tampilkan' : 'sembunyikan').'</u>!');
        redirect(site_url('Unit'));
    }

    function description($id)
    {
        $unit=$this->Unit_model->getdata_by_id($id);
        $data=array(
            'id'    => $id,
            'description'    => $unit->description,
            'action'    => site_url('Unit/description_action')
        );
        $this->load->view('admin/unit_desc',$data);
    }

    function description_action()
    {
        $id=$this->input->post('unit_id');
        $data=array(
            'description'    => $this->input->post('description')
        );
        $this->Unit_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Deskripsi data dengan nama Unit <u>'.$id->unit_name.'</u> berhasil diubah!');
        redirect(site_url('Unit'));
    }

    function edit($id)
	{
		$data=$this->Unit_model->getdata_by_id($id);
        echo json_encode($data);
	}

    function edit_action()
    {
        $old=$this->input->post('old_icon');
        if($_FILES['unit_icon']['name'] != "") {
            $this->Unit_model->_deleteImage($old);
            $img = $this->_uploadImage();
        } else {
            $img = $old;
        }
        $data=array(
            'unit_icon'    => $img,
            'unit_name'  => $this->input->post('unit'),
            'active'  => $this->input->post('active'),
        );
        $id=$this->input->post('unit_id');
        $old_name=$this->Unit_model->getdata_by_id($id)->unit_name;
        $this->Unit_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Data dengan nama Unit <u>'.$old_name.'</u> berhasil diubah menjadi <u>'.$this->input->post('unit').'</u>');
        redirect(site_url('Unit'));
    }
    
    function delete($id)
    {
        $unit = $this->Unit_model->getdata_by_id($id);
        $this->Unit_model->_deleteImage($unit->unit_icon);
        $this->Unit_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data dengan nama unit <u>'.$unit->unit_name.'</u> berhasil dihapus!');
        redirect(site_url('Unit'));
    }

    private function _uploadImage()
    {
        $config['upload_path']          = './upload';
        $config['allowed_types']        = 'png';
        $config['file_name']            = uniqid();
        $config['overwrite']            = true;
        $config['max_size']             = 200; // 200KB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('unit_icon')) {
            return $this->upload->data("file_name");
        }
        
        return "default.jpg";
    }
}

?>