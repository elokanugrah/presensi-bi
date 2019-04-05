<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Attendance extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Student_model');
        $this->load->model('Attendance_model');
        $this->load->model('Workinghours_model');
	}

	public function index()
	{
		
		$this->load->view('attendance');
	}

	function edit_student_attendance($id)
    {
        $data=$this->Attendance_model->getdata_by_id($id);
        $data->date = ($data->date == '0000-00-00') ? '' : $data->date; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    function edit_studentnote_action()
    {
        $data=array(
            'note'      => $this->input->post('note')
        );
        $id=$this->input->post('attendance_id');
        $s_id=$this->input->post('student_id');
        $hari = array ( 
          1 => 'Senin',
          'Selasa',
          'Rabu',
          'Kamis',
          'Jumat',
          'Sabtu',
          'Minggu'
        ); 
        $date = $hari[ date('N', strtotime($this->input->post('date_inn'))) ] .', '. date("d-M-Y", strtotime($this->input->post('date_inn')));
        $this->Attendance_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Keterangan pada hari '.$date.' diubah!');
        redirect(site_url('StudentIntern/student/'.$s_id));
    }

    function add_studentatt_action()
    {
        $time=$this->Workinghours_model->getTime("1");
        $time_in=date('H:i:s', strtotime($time->time_in));
        $time_out=date('H:i:s', strtotime($time->time_out));
        $time_in_post=date('H:i:s', strtotime($this->input->post('time_in')));
        $time_out_post=date('H:i:s', strtotime($this->input->post('time_out')));
        $status_in='on time';
        $status_out='on time';
        if ($time_in_post > $time_in) {
            $status_in='telat';
        }
        if ($time_out_post < $time_out) {
            $status_out='pulang cepat';
        }
        $s_id=$this->input->post('student_id');
        $data=array(
            'student_id' => $s_id,
            'date'      => date("Y-m-d", strtotime($this->input->post('date_in'))),
            'time_in'      => $this->input->post('time_in'),
            'time_out'      => $this->input->post('time_out'),
            'status_in'      => $status_in,
            'status_out'      => $status_out,
            'note'      => $this->input->post('note')
        );
        $this->Attendance_model->add_data($data);
        $this->session->set_flashdata('input_success', 'Data kehadiran pada tanggal '.$this->input->post('date_in').' berhasil ditambahkan!');
        redirect(site_url('StudentIntern/student/'.$s_id));
    }

    function edit_studentatt_action()
    {
        $time=$this->Workinghours_model->getTime("1");
        $time_in=date('H:i:s', strtotime($time->time_in));
        $time_out=date('H:i:s', strtotime($time->time_out));
        $time_in_post=date('H:i:s', strtotime($this->input->post('time_in')));
        $time_out_post=date('H:i:s', strtotime($this->input->post('time_out')));
        $status_in='on time';
        $status_out='on time';
        if ($time_in_post > $time_in) {
            $status_in='telat';
        }
        if ($time_out_post < $time_out) {
            $status_out='pulang cepat';
        }
        $data=array(
            'date'      => date("Y-m-d", strtotime($this->input->post('date_in'))),
            'time_in'      => $this->input->post('time_in'),
            'time_out'      => $this->input->post('time_out'),
            'status_in'      => $status_in,
            'status_out'      => $status_out
        );
        $id=$this->input->post('attendance_id');
        $s_id=$this->input->post('student_id');
        $this->Attendance_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Tanggal / waktu kehadiran berhasil diubah!');
        redirect(site_url('StudentIntern/student/'.$s_id));
    }

    function delete($id)
    {
        $attendance = $this->Attendance_model->getdata_by_id($id);
        $hari = array ( 
          1 => 'Senin',
          'Selasa',
          'Rabu',
          'Kamis',
          'Jumat',
          'Sabtu',
          'Minggu'
        ); 
        $s_id=$attendance->student_id;
        $date = $hari[ date('N', strtotime($attendance->date)) ] .', '. date("d-M-Y", strtotime($attendance->date));
        $this->Attendance_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data kehadiran pada hari '.$date.' berhasil dihapus!');
        redirect(site_url('StudentIntern/student/'.$s_id));
    }
}

?>