<?php 
	/**
	* 
	*/
	class Attendance_model extends CI_Model
	{
		public $nama_table	='attendance';
		public $id			='attendance_id';
		public $order		='DESC';

		function __construct()
		{
			parent::__construct();
		}

		function getall_data()
		{
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

		function getall_data_comp()
		{
			$this->db->select('student.student_id, student.name, student.qrcode_id, attendance.attendance_id, attendance.date, attendance.time_in, attendance.time_out, attendance.status_in, attendance.status_out, attendance.note');
			$this->db->join('student', 'student.student_id=attendance.student_id');
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

		function getall_data_bydate($start, $end)
		{
			$this->db->select('student.student_id, student.name, student.id_number, student.qrcode_id, attendance.attendance_id, attendance.date, attendance.time_in, attendance.time_out, attendance.status_in, attendance.status_out, attendance.note');
			$this->db->join('student', 'student.student_id=attendance.student_id');
			$this->db->where('date >=', $start);
			$this->db->where('date <=', $end);
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

		function check_date($date)
		{
			$this->db->where('date',$date);
			$num_rows = $this->db->count_all_results('attendance');
			if ($num_rows > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

		function check_stddate($student_id, $date)
		{
			$this->db->where('student_id',$student_id);
			$this->db->where('date',$date);
			$num_rows = $this->db->count_all_results('attendance');
			if ($num_rows > 0){
		        return true;
		    }
		    else{
		        return false;
		    }
		}

		function check_studentdate($student_id, $date)
		{
			$this->db->where('student_id',$student_id);
			$this->db->where('date',$date);
			return $this->db->get($this->nama_table)->row();
		}

		function add_all($date, $student_id, $data)
		{
			$query = $this->db->query("INSERT INTO attendance(student_id, date) 
				      	SELECT student.student_id,'$date'
				      	FROM student
				      	WHERE student.active = 'Aktif'");
			if ($query) {
				$this->db->where('student_id',$student_id);
				$this->db->where('date',$date);
				$this->db->update($this->nama_table,$data);
			}
		}

		/*function getdata_by_studentdate($id, $date)
		{
			$this->db->where('student_id',$id);
			$this->db->where('date',$date);
			return $this->db->get($this->nama_table)->row();
		}*/

		function getall_by_student($id)
		{
			$this->db->where('student_id',$id);
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

		function get_earliest()
		{
			$this->db->select_min('date');
			return $this->db->get($this->nama_table)->row();
		}

		function get_latest()
		{
			$this->db->select_max('date');
			return $this->db->get($this->nama_table)->row();
		}

		function getdata_by_id($id)
		{
			$this->db->where($this->id,$id);
			return $this->db->get($this->nama_table)->row();
		}

		function getdata_by_date($date)
		{
			$this->db->where('date',$date);
			return $this->db->get($this->nama_table)->row();
		}

		function get_date($start,$end)
		{
			$this->db->select("date");
			$this->db->where('date >=', $start);
			$this->db->where('date <=', $end);
			$this->db->group_by('date');
			return $this->db->get($this->nama_table)->result();
		}

		function get_countperdate($date)
		{
			$telat = "telat";
			$hadir = 'Hadir';
			$alpha = 'Alpha';
			$sakit = 'Sakit';
			$izin = 'Izin';
			$nan = '';
			$this->db->select('	(SELECT COUNT(attendance_id) FROM attendance
								WHERE status_in = "'.$telat.'"
								AND date = "'.$date.'"
								) AS late,
								(
								SELECT COUNT(attendance_id) FROM attendance
								WHERE note = "'.$hadir.'"
								AND date = "'.$date.'"
								) AS present,
								(
								SELECT COUNT(attendance_id) FROM attendance
								WHERE note = "'.$alpha.'"
								AND date = "'.$date.'"
								) AS alpha,
								(
								SELECT COUNT(attendance_id) FROM attendance
								WHERE note = "'.$sakit.'"
								AND date = "'.$date.'"
								) AS sick,
								(
								SELECT COUNT(attendance_id) FROM attendance
								WHERE note = "'.$izin.'"
								AND date = "'.$date.'"
								) AS permit,
								(
								SELECT COUNT(attendance_id) FROM attendance
								WHERE note = "'.$nan.'"
								AND date = "'.$date.'"
								) AS nan');
			$this->db->where('date', $date);
			$this->db->group_by('date');
			return $this->db->get($this->nama_table)->row();
		}

		function get_percentage($s_id)
		{
			$hadir = 'Hadir';
			$alpha = 'Alpha';
			$sakit = 'Sakit';
			$izin = 'Izin';
			$nan = '';
			$this->db->select('((
							    SELECT COUNT(attendance_id) FROM attendance
							    WHERE student_id = '.$s_id.'
							    AND (note = "'.$hadir.'"
							    OR note = "'.$sakit.'"
							    OR note = "'.$izin.'")
								)*100 / COUNT(attendance_id)) 
								AS percentage, 
								(
							    SELECT COUNT(attendance_id) FROM attendance
							    WHERE student_id = '.$s_id.'
							    AND note = "'.$alpha.'"
								) AS alpha,
								(
								SELECT COUNT(attendance_id) FROM attendance
							    WHERE student_id = '.$s_id.'
							    AND note = "'.$sakit.'"
								) AS sick,
								(
								SELECT COUNT(attendance_id) FROM attendance
							    WHERE student_id = '.$s_id.'
							    AND note = "'.$izin.'"
								) AS permit,
								(
								SELECT COUNT(attendance_id) FROM attendance
							    WHERE student_id = '.$s_id.'
							    AND note = "'.$nan.'"
								) AS nan,
								(
								SELECT COUNT(attendance_id) FROM attendance
							    WHERE student_id = '.$s_id.'
							    AND note = "'.$hadir.'"
								) AS present,
								COUNT(attendance_id) AS total');
			$this->db->where('student_id', $s_id);
			return $this->db->get($this->nama_table)->row();
		}

		function get_instats($s_id)
		{
			$ontime = 'on time';
			$late = 'telat';
			$nan = '';
			$this->db->select('((
							    SELECT COUNT(attendance_id) FROM attendance
							    WHERE student_id = '.$s_id.'
							    AND status_in = "'.$ontime.'"
								)) AS ontime,
								((
							    SELECT COUNT(attendance_id) FROM attendance
							    WHERE student_id = '.$s_id.'
							    AND status_in = "'.$late.'"
								)) AS late,
								((
							    SELECT COUNT(attendance_id) FROM attendance
							    WHERE student_id = '.$s_id.'
							    AND status_in = "'.$nan.'"
								)) AS nan');
			$this->db->where('student_id', $s_id);
			return $this->db->get($this->nama_table)->row();
		}

		function get_alreadynotyet(){
			$already = 'on time';
			$late = 'telat';
			$notyet = '';
			$date = $this->get_latest()->date;
			$this->db->select('((
								SELECT COUNT(attendance_id) FROM attendance
								WHERE date = "'.$date.'"
								AND (status_in = "'.$already.'"
							    OR status_in = "'.$late.'")
								)*100 / COUNT(attendance_id)) 
								AS ontime_percentage,
						        ((
								SELECT COUNT(attendance_id) FROM attendance
								WHERE date = "'.$date.'"
								AND status_in = "'.$notyet.'"
								)*100 / COUNT(attendance_id)) 
								AS nan_percentage,
						        (
								SELECT COUNT(attendance_id) FROM attendance
								WHERE date = "'.$date.'"
								AND status_in = "'.$already.'"
								) AS ontime,
								(
								SELECT COUNT(attendance_id) FROM attendance
								WHERE date = "'.$date.'"
								AND status_in = "'.$late.'"
								) AS late,
						        (
						        SELECT COUNT(attendance_id) FROM attendance
								WHERE date = "'.$date.'"
								AND status_in = "'.$notyet.'"
								) AS nan');
			$this->db->where('date', $date);
			return $this->db->get($this->nama_table)->row();
		}

		function add_data($data)
		{
			return $this->db->insert($this->nama_table,$data);
		}

		function edit_data($id,$data)
		{
			$this->db->where($this->id,$id);
			$this->db->update($this->nama_table,$data);
		}

		function delete_data($id)
    	{
        	$this->db->where($this->id,$id);
        	$this->db->delete($this->nama_table);
    	}

    	// Fungsi untuk melakukan proses upload file
		public function upload_file($filename)
		{
			$this->load->library('upload'); // Load librari upload

			$config['upload_path'] = './excel/';
			$config['allowed_types'] = 'xlsx';
			$config['max_size']  = '1024';
			$config['overwrite'] = true;
			$config['file_name'] = $filename;

			$this->upload->initialize($config); // Load konfigurasi uploadnya
			if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil
			  // Jika berhasil :
			  $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
			  return $return;
			}else{
			  // Jika gagal :
			  $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
			  return $return;
			}
		}

		// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
		public function insert_multiple($data){
			$this->db->insert_batch($this->nama_table, $data);
		}
	}
	?>