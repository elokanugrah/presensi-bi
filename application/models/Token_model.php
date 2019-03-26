<?php 
	/**
	* 
	*/
	class Token_model extends CI_Model
	{
		public $nama_table	='token';
		public $id			='token_id';
		public $order		='DESC';

		function __construct()
		{
			parent::__construct();
		}

		function get_last_data()
		{
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->row();
		}

		function add_data($data)
		{
			return $this->db->insert($this->nama_table,$data);
		}

		function delete_data($id)
		{
			$this->db->where($this->id,$id);
			$this->db->delete($this->nama_table);
		}
	}
	?>