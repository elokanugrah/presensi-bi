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
			$this->db->select('student.student_id, student.name, student.id_number, attendance.attendance_id, attendance.date, attendance.time_in, attendance.time_out, attendance.status_in, attendance.status_out, attendance.note');
			$this->db->join('student', 'student.student_id=attendance.student_id');
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

		function getall_data_bydate($start, $end)
		{
			$this->db->select('student.student_id, student.name, student.id_number, attendance.attendance_id, attendance.date, attendance.time_in, attendance.time_out, attendance.status_in, attendance.status_out, attendance.note');
			$this->db->join('student', 'student.student_id=attendance.student_id');
			$this->db->where('date >=', $start);
			$this->db->where('date <=', $end);
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

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

		function getdata_by_id($id)
		{
			$this->db->where($this->id,$id);
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
	}
	?>