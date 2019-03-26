<?php 
	/**
	* 
	*/
	class Guest_model extends CI_Model
	{
		public $nama_table	='member';
		public $id			='member_id';
		public $order		='DESC';

		function __construct()
		{
			parent::__construct();
		}

		function ambil_data()
		{
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

		function getdata_by_id($id)
		{
			$this->db->where($this->id,$id);
			return $this->db->get($this->nama_table)->row();
		}

		function get_count()
		{
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->num_rows();
		}

		function cek_member($id_number, $name)
		{
			$this->db->where('id_number',$id_number);
			$this->db->where('name',$name);
			return $this->db->get($this->nama_table)->row();
		}

		function data_adding($data)
		{
			return $this->db->insert($this->nama_table,$data);
		}
		
		function get_by_idnumber($id)
		{
			$this->db->where('id_number',$id);
			return $this->db->get($this->nama_table)->row();
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