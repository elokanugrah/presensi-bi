<?php 
	/**
	* 
	*/
	class Login_model extends CI_Model
	{
		public $nama_table	='admin';
		public $id	='admin_id';

		function __construct()
		{
			parent::__construct();
		}

		function getEmail()
		{
			$this->db->select("email");
			return $this->db->get($this->nama_table)->row();
		}

		function getUserByUname($username)
		{
			$this->db->where('username',$username);
			return $this->db->get($this->nama_table)->row();
		}

		function getUserByEmail($email)
		{
			$this->db->where('email',$email);
			return $this->db->get($this->nama_table)->row();
		}

		function edit_data($id,$data)
		{
			$this->db->where($this->id,$id);
			$this->db->update($this->nama_table,$data);
		}
	}
	?>