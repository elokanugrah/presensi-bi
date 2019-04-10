<?php 
	/**
	* 
	*/
	class Student_model extends CI_Model
	{
		public $nama_table	='student';
		public $id			='student_id';
		public $order		='DESC';

		function __construct()
		{
			parent::__construct();
		}

		function ambil_data()
		{
			$this->db->select('student.student_id, student.name, student.id_number, student.name, student.sex, student.collage, student.vocational, student.address, student.phone, student.active, mentor.mentor_id, mentor.name AS mentor_name, mentor.nip');
			$this->db->join('mentor', 'mentor.mentor_id=student.mentor_id');
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

		function get_data_activeonly()
		{
			$this->db->where('active','Aktif');
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

		function getdata_by_id($id)
		{
			$this->db->select('student.qrcode, student.qrcode_id, student.student_id, student.name, student.id_number, student.name, student.sex, student.collage, student.vocational, student.address, student.phone, student.active, mentor.mentor_id, mentor.name AS mentor_name, mentor.nip');
			$this->db->join('mentor', 'mentor.mentor_id=student.mentor_id');
			$this->db->where($this->id,$id);
			return $this->db->get($this->nama_table)->row();
		}

		function data_adding($data)
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

		function _deleteImage($id)
		{
		    $student = $this->getdata_by_id($id);
		    if ($student->qrcode != "default.jpg") {
			    $filename = explode(".", $student->qrcode)[0];
				return array_map('unlink', glob(FCPATH."./upload/$filename.*"));
		    }
		}
	}
	?>