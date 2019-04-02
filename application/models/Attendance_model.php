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

		function getall_by_student($id)
		{
			$this->db->where('student_id',$id);
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
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
			$this->db->select('((
							    SELECT COUNT(attendance_id) FROM attendance
							    WHERE student_id = '.$s_id.'
							    AND status_in = "'.$ontime.'"
								)) AS ontime,
								((
							    SELECT COUNT(attendance_id) FROM attendance
							    WHERE student_id = '.$s_id.'
							    AND status_in = "'.$late.'"
								)) AS late');
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