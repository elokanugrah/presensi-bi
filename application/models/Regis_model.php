<?php 
	/**
	* 
	*/
	class Regis_model extends CI_Model
	{
		public $nama_table	='regis_auto';
		public $id			='regis_id';

		function __construct()
		{
			parent::__construct();
		}

		function getdata()
		{
			$this->db->where($this->id,'1');
			return $this->db->get($this->nama_table)->row();
		}

		function edit_data($id,$data)
		{
			$this->db->where($this->id,$id);
			$this->db->update($this->nama_table,$data);
		}
	}
	?>