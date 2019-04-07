<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Report extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        /*if(!$this->session->userdata('logined') || $this->session->userdata('logined') != true)
        {
            redirect('/');
        }*/
        $this->load->model('Attendance_model');
        $this->load->model('Student_model');
        $this->load->model('Workinghours_model');
	}

	public function index()
	{
		$attendance=$this->Attendance_model->getall_data_comp();
        $active_student=$this->Student_model->get_data_activeonly();
        $data=array(
            'data_attendance'  => $attendance,
            'data_student'     => $active_student
        );
		$this->load->view('admin/attendance_table',$data);
    }

    public function add_perdate()
    {
        $active_student=$this->Student_model->get_data_activeonly();
        $data=array(
            'data_student'     => $active_student,
            'action'    => site_url('Report/add_perdate_action')
        );
        $this->load->view('admin/attendance_form',$data);
    }

    function add_perdate_action()
    {
        $time=$this->Workinghours_model->getTime("1");
        $time_in=date('H:i:s', strtotime($time->time_in));
        $time_out=date('H:i:s', strtotime($time->time_out));
        $active_student=$this->Student_model->get_data_activeonly();
        $i=0;
        foreach ($active_student as $key) {
            $time_in_post=date('H:i:s', strtotime($this->input->post('time_in'.$i)));
            $time_out_post=date('H:i:s', strtotime($this->input->post('time_out'.$i)));
            $status_in='on time';
            $status_out='on time';
            if(!empty($this->input->post('time_in'.$i))){
                if ($time_in_post > $time_in) {
                    $status_in='telat';
                    }
            } else {
                $status_in='';
            }

            if (!empty($this->input->post('time_out'.$i))) {
                if ($time_out_post < $time_out) {
                    $status_out='pulang cepat';
                }
            } else {
                $status_out='';
            }
            $data=array(
                'student_id' => $this->input->post('student_id'.$i),
                'date'      => date("Y-m-d", strtotime($this->input->post('date_in'))),
                'time_in'      => $this->input->post('time_in'.$i),
                'time_out'      => $this->input->post('time_out'.$i),
                'status_in'      => $status_in,
                'status_out'      => $status_out,
                'note'      => $this->input->post('note'.$i)
            );
            $this->Attendance_model->add_data($data);
            $i++;
        }
        $date = $hari[ date('N', strtotime($this->input->post('date_in'))) ] .', '. date("d M Y", strtotime($this->input->post('date_in')));
        $this->session->set_flashdata('input_success', 'Data kehadiran siswa magang aktif per tanggal '.$date.' berhasil ditambahkan!');
        redirect('Report');
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
        if(!empty($this->input->post('time_in'))){
            if ($time_in_post > $time_in) {
                $status_in='telat';
                }
        } else {
            $status_in='';
        }

        if (!empty($this->input->post('time_out'))) {
            if ($time_out_post < $time_out) {
                $status_out='pulang cepat';
            }
        } else {
            $status_out='';
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
        $student = $this->Student_model->getdata_by_id($s_id);
        $this->Attendance_model->add_data($data);
        $date = $hari[ date('N', strtotime($this->input->post('date_in'))) ] .', '. date("d M Y", strtotime($this->input->post('date_in')));
        $this->session->set_flashdata('input_success', 'Data kehadiran siswa a/n '.$student->name.' pada tanggal '.$date.' berhasil ditambahkan!');
        redirect('Report');
    }

    function edit_studentnote_action()
    {
        $data=array(
            'note'      => $this->input->post('note')
        );
        $id=$this->input->post('attendance_id');
        $s_id=$this->input->post('student_id');
        $name=$this->input->post('name2');
        $hari = array ( 
          1 => 'Senin',
          'Selasa',
          'Rabu',
          'Kamis',
          'Jumat',
          'Sabtu',
          'Minggu'
        ); 
        $date = $hari[ date('N', strtotime($this->input->post('date_inn'))) ] .', '. date("d M Y", strtotime($this->input->post('date_inn')));
        $this->Attendance_model->edit_data($id,$data);
        $this->session->set_flashdata('edit_success', 'Keterangan siswa magang a/n '.$name.' pada hari '.$date.' diubah!');
        redirect('Report');
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
        if(!empty($this->input->post('time_in'))){
            if ($time_in_post > $time_in) {
                $status_in='telat';
                }
        } else {
            $status_in='';
        }

        if (!empty($this->input->post('time_out'))) {
            if ($time_out_post < $time_out) {
                $status_out='pulang cepat';
            }
        } else {
            $status_out='';
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
        $this->session->set_flashdata('edit_success', 'Tanggal / waktu kehadiran a/n '.$this->input->post('name3').' berhasil diubah!');
        redirect('Report');
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
        $student = $this->Student_model->getdata_by_id($s_id);
        $date = $hari[ date('N', strtotime($attendance->date)) ] .', '. date("d M Y", strtotime($attendance->date));
        $this->Attendance_model->delete_data($id);
        $this->session->set_flashdata('delete_success', 'Data kehadiran a/n '.$student->name.' pada hari '.$date.' berhasil dihapus!');
        redirect('Report');
    }
}

?>