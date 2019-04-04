<?php 
	/**
	* 
	*/
	class Workinghours_model extends CI_Model
	{
		public $nama_table	='working_hours';
		public $id			='workinghours_id';
		public $order		='DESC';

		function __construct()
		{
			parent::__construct();
		}

		function getTime($id)
		{
			$this->db->where($this->id,$id);
			return $this->db->get($this->nama_table)->row();
		}

		function edit_data($id,$data)
		{
			$this->db->where($this->id,$id);
			$this->db->update($this->nama_table,$data);
		}
	}
	?>