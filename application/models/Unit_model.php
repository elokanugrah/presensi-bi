<?php 
	/**
	* 
	*/
	class Unit_model extends CI_Model
	{
		public $nama_table	='unit';
		public $id			='unit_id';
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

		function getdata_by_name($unit_name)
		{
			$this->db->where('unit_name',$unit_name);
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

		function _deleteImage($img)
		{
		    if ($img != "default.jpg") {
			    $filename = explode(".", $img)[0];
				return array_map('unlink', glob(FCPATH."./upload/$filename.*"));
		    }
		}
	}
	?>