<?php 
	/**
	* 
	*/
	class EduLvl_model extends CI_Model
	{
		public $nama_table	='edulvl';
		public $id			='edulvl_id';
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

		function getdata_by_name($edulvl_name)
		{
			$this->db->where('edulvl_name',$edulvl_name);
			return $this->db->get($this->nama_table)->row();
		}

		function get_count()
		{
			$this->db->select("edulvl_id, edulvl_name, COUNT(edulvl_id) AS total");
			$this->db->group_by('edulvl_name');
			return $this->db->get($this->nama_table)->result();
		}

		function get_edulvl($edulvl_id)
		{
			$this->db->select("edulvl.edulvl_id, edulvl.edulvl_name AS name, COUNT(edulvl.edulvl_id) AS total");
			$this->db->join('regis', 'edulvl.edulvl_id=regis.edulvl_id');
			$this->db->where('edulvl.edulvl_id',$edulvl_id);
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
	}
	?>