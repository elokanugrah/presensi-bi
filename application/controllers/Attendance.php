<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Attendance extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
        if(!$this->session->userdata('logined_att') || $this->session->userdata('logined_att') != true)
        {
            redirect('Login');
        }
		$this->load->model('Student_model');
        $this->load->model('Attendance_model');
        $this->load->model('Workinghours_model');
	}

	public function index()
	{
		
		// $this->load->view('attendance');
	}

    /*function check_att($date)
    {
        $data=$this->Attendance_model->getdata_by_date($date);
        $data->date = ($data->date == '0000-00-00') ? '' : $data->date; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }

    function check_datestd($date, $st_id)
    {
        $data=$this->Attendance_model->getdata_by_studentdate($student_id, $date);
        $data->date = ($data->date == '0000-00-00') ? '' : $data->date; // if 0000-00-00 set tu empty for datepicker compatibility
        echo json_encode($data);
    }*/

    function get_byqr()
    {
        $qr=$this->input->post('qrcode_id');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $time_inout=$this->Workinghours_model->getTime("1");
        $data=$this->Student_model->getdata_by_qr($qr);
        $data->date_in = ($data->date_in == '0000-00-00') ? '' : $data->date_in; // if 0000-00-00 set tu empty for datepicker compatibility
        $data->date_out = ($data->date_out == '0000-00-00') ? '' : $data->date_out; // if 0000-00-00 set tu empty for datepicker compatibility
        $student_id=$data->student_id;
        if ($data->active == 'Aktif') {
            if ($this->Attendance_model->check_date($date)) {
                $data->date_status = 'Already';
                $studentdate=$this->Attendance_model->check_studentdate($student_id, $date);
                if (!empty($studentdate->status_in) && !empty($studentdate->status_out)) {
                $data->already=true;
                } else {
                    $data->already=false;
                    if (empty($studentdate->status_in)) {
                        $data->studentdate='Empty';
                        $data->inout='masuk';
                        $time_in=date('H:i:s', strtotime($time_inout->time_in));
                        $time_in_post=date('H:i:s', strtotime($time));
                        if(!empty($time)){
                            if ($time_in_post > $time_in) {
                                $status_in='telat';
                            } else {
                                $status_in='on time';
                            }
                        } else {
                            $status_in='';
                        }
                        $datas=array(
                            'time_in'      => $time,
                            'status_in'      => $status_in
                        );
                        $data->status=$status_in;
                        if (!$this->Attendance_model->edit_data($studentdate->attendance_id, $datas)){
                            $data->edit='edit berhasil';
                            } else {
                                $data->edit='edit gagal';
                            }
                    } else {
                        $data->studentdate='Already';
                        $data->inout='pulang';
                        $time_out=date('H:i:s', strtotime($time_inout->time_out));
                        $time_out_post=date('H:i:s', strtotime($time));
                        if(!empty($time)){
                            if ($time_out_post < $time_out) {
                                $status_out='lebih awal';
                            } else {
                                $status_out='on time';
                            }
                        } else {
                            $status_out='';
                        }
                        $datas=array(
                            'time_out'      => $time,
                            'status_out'      => $status_out,
                            'note'      => 'Hadir'
                        );
                        $data->status=$status_out;
                        if (!$this->Attendance_model->edit_data($studentdate->attendance_id, $datas)){
                            $data->edit='edit berhasil';
                            } else {
                                $data->edit='edit gagal';
                            }
                    }
                }
            } else {
                $data->date_status = 'Not ready';
                $data->inout='masuk';
                $time_in=date('H:i:s', strtotime($time_inout->time_in));
                $time_in_post=date('H:i:s', strtotime($time));
                if(!empty($time)){
                    if ($time_in_post > $time_in) {
                        $status_in='telat';
                    } else {
                        $status_in='on time';
                    }
                } else {
                    $status_in='';
                }
                $datas=array(
                    'time_in'      => $time,
                    'status_in'      => $status_in
                );
                $data->status=$status_in;
                if (!$this->Attendance_model->add_all($date, $student_id, $datas)){
                    $data->add_all='Add all berhasil';
                    } else {
                        $data->add_all='Add all gagal';
                    }
            }
        } else {
            $studentdate=$this->Attendance_model->check_studentdate($student_id, $date);
            if (!$studentdate) {
                $data->att_active=false;
            } else {
                $data->att_active=true;
                if (!empty($studentdate->status_in) && !empty($studentdate->status_out)) {
                $data->already=true;
                } else {
                    $data->already=false;
                    if (empty($studentdate->status_in)) {
                        $data->studentdate='Empty';
                        $data->inout='masuk';
                        $time_in=date('H:i:s', strtotime($time_inout->time_in));
                        $time_in_post=date('H:i:s', strtotime($time));
                        if(!empty($time)){
                            if ($time_in_post > $time_in) {
                                $status_in='telat';
                            } else {
                                $status_in='on time';
                            }
                        } else {
                            $status_in='';
                        }
                        $datas=array(
                            'time_in'      => $time,
                            'status_in'      => $status_in
                        );
                        $data->status=$status_in;
                        if (!$this->Attendance_model->edit_data($studentdate->attendance_id, $datas)){
                            $data->edit='edit berhasil';
                            } else {
                                $data->edit='edit gagal';
                            }
                    } else {
                        $data->studentdate='Already';
                        $data->inout='pulang';
                        $time_out=date('H:i:s', strtotime($time_inout->time_out));
                        $time_out_post=date('H:i:s', strtotime($time));
                        if(!empty($time)){
                            if ($time_out_post < $time_out) {
                                $status_out='lebih awal';
                            } else {
                                $status_out='on time';
                            }
                        } else {
                            $status_out='';
                        }
                        $datas=array(
                            'time_out'      => $time,
                            'status_out'      => $status_out,
                            'note'      => 'Hadir'
                        );
                        $data->status=$status_out;
                        if (!$this->Attendance_model->edit_data($studentdate->attendance_id, $datas)){
                            $data->edit='edit berhasil';
                            } else {
                                $data->edit='edit gagal';
                            }
                    }
                }
            }
        }
        echo json_encode($data);
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
        if(!empty($this->input->post('time_in'))){
            if ($time_in_post > $time_in) {
                $status_in='telat';
                }
        } else {
            $status_in='';
        }

        if (!empty($this->input->post('time_out'))) {
            if ($time_out_post < $time_out) {
                $status_out='lebih awal';
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
        $this->Attendance_model->add_data($data);
        $this->session->set_flashdata('input_success', 'Data kehadiran pada tanggal '.$this->input->post('date_in').' berhasil ditambahkan!');
        redirect(site_url('StudentIntern/student/'.$s_id));
    }

    /*function add_all()
    {
        $student_id = $this->input->post('student_id');
        $date = $this->input->post('date');
        $time = $this->input->post('time');
        $time_in=$this->Workinghours_model->getTime("1");
        $time_in=date('H:i:s', strtotime($time_in->time_in));
        $time_in_post=date('H:i:s', strtotime($time));
        $status_in='on time';
        if(!empty($time)){
            if ($time_in_post > $time_in) {
                $status_in='telat';
                }
        } else {
            $status_in='';
        }
        $data=array(
            'time_in'      => $time,
            'status_in'      => $status_in
        );
        $getatt=$this->Attendance_model->getdata_by_studentdate($student_id, $date);
        $id=$getatt->attendance_id;
        if ($this->Attendance_model->add_all($date, $student_id, $data)){

        }
        $json->status_in = $status_in;
        echo json_encode($json);
    }*/

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
                $status_out='lebih awal';
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