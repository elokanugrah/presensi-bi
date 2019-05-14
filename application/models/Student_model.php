<?php 
	/**
	* 
	*/
	class Student_model extends CI_Model
	{
		private $nama_table	='student';
		private $id			='student_id';
		private $order		='DESC';

		function __construct()
		{
			parent::__construct();
		}

		function ambil_data()
		{
			$this->db->select('student.student_id, student.qrcode_id, student.name, student.id_number, student.name, student.sex, student.collage, student.vocational, student.address, student.phone, student.date_in, student.date_out, student.active, mentor.mentor_id, mentor.name AS mentor_name, mentor.nip, unit.unit_name, edulvl.edulvl_name');
			$this->db->join('mentor', 'mentor.mentor_id=student.mentor_id');
			$this->db->join('unit', 'unit.unit_id=student.unit_id');
			$this->db->join('edulvl', 'edulvl.edulvl_id=student.edulvl_id');
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

		function get_data_activeonly()
		{
			$this->db->where('active','Aktif');
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

		function get_data_activelevel()
		{
			$this->db->select("COUNT(student.student_id) AS total, edulvl.edulvl_name, edulvl.edulvl_id");
			$this->db->join('edulvl', 'edulvl.edulvl_id=student.edulvl_id');
			$this->db->where('student.active','Aktif');
			$this->db->group_by('edulvl.edulvl_name');
			return $this->db->get($this->nama_table)->result();
		}

		function get_data_level()
		{
			$this->db->select("COUNT(student.student_id) AS total, edulvl.edulvl_name, edulvl.edulvl_id");
			$this->db->join('edulvl', 'edulvl.edulvl_id=student.edulvl_id');
			$this->db->group_by('edulvl.edulvl_name');
			return $this->db->get($this->nama_table)->result();
		}

		function get_max_qr()
		{
			$this->db->select_max('qrcode_id');
			return $this->db->get($this->nama_table)->row();
		}

		function get_max_mth()
		{
			$this->db->select_max('date_out');
			return $this->db->get($this->nama_table)->row();
		}

		function get_data_activeorigin($edulvl_id)
		{
			$this->db->select("COUNT(student.student_id) AS total, student.collage");
			$this->db->join('edulvl', 'edulvl.edulvl_id=student.edulvl_id');
			$this->db->where('student.active','Aktif');
			$this->db->where('edulvl.edulvl_id',$edulvl_id);
			$this->db->group_by('student.collage');
			return $this->db->get($this->nama_table)->result();
		}

		function get_data_origin($edulvl_id)
		{
			$this->db->select("COUNT(student.student_id) AS total, student.collage");
			$this->db->join('edulvl', 'edulvl.edulvl_id=student.edulvl_id');
			$this->db->where('edulvl.edulvl_id',$edulvl_id);
			$this->db->group_by('student.collage');
			return $this->db->get($this->nama_table)->result();
		}

		function getdata_by_id($id)
		{
			$this->db->select('student.qrcode, student.qrcode_id, student.student_id, student.date_in, student.date_out, student.name, student.id_number, student.name, student.sex, student.collage, student.vocational, student.address, student.phone, student.active, mentor.mentor_id, mentor.name AS mentor_name, mentor.nip, unit.unit_id, unit.unit_name, edulvl.edulvl_id, edulvl.edulvl_name');
			$this->db->join('mentor', 'mentor.mentor_id=student.mentor_id');
			$this->db->join('unit', 'unit.unit_id=student.unit_id');
			$this->db->join('edulvl', 'edulvl.edulvl_id=student.edulvl_id');
			$this->db->where($this->id,$id);
			return $this->db->get($this->nama_table)->row();
		}

		function getdata_by_qr($qr)
		{
			$this->db->where('qrcode_id',$qr);
			return $this->db->get($this->nama_table)->row();
		}

		function data_yearandcount()
		{
			$this->db->select("YEAR(date_in) AS year, MAX(MONTH(date_in)) AS max_month, COUNT(student_id) AS total");
			$this->db->from($this->nama_table);
			$this->db->group_by('YEAR(date_in)');
			return $this->db->get()->result();
		}

		function data_monthandcount($yr, $mt)
		{
			$this->db->select("date_in, YEAR(date_in) AS year, MONTH(date_in) AS month, SUBSTRING('Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec ', (MONTH(date_in) * 4)- 3, 3) AS month_name, CASE WHEN COUNT(1) > 0 THEN COUNT(student_id) ELSE 0 END AS total");
			$this->db->from($this->nama_table);
			$this->db->where('YEAR(date_in)',$yr);
			$this->db->where('MONTH(date_in)',$mt);
			return $this->db->get()->result();
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

		/*function _deleteImage($id)
		{
		    $student = $this->getdata_by_id($id);
		    if ($student->qrcode != "default.jpg") {
			    $filename = explode(".", $student->qrcode)[0];
				return array_map('unlink', glob(FCPATH."./upload/$filename.*"));
		    }
		}

		function _deleteOldImage($old)
		{
		    if ($old != "default.jpg") {
			    $filename = explode(".", $old)[0];
				return array_map('unlink', glob(FCPATH."./upload/$filename.*"));
		    }
		}*/

		// Buat sebuah fungsi untuk melakukan insert lebih dari 1 data
		public function insert_multiple($data){
			$this->db->insert_batch($this->nama_table, $data);
		}
	}
	?>