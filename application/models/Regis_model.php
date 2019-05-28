<?php 
	/**
	* 
	*/
	class Regis_model extends CI_Model
	{
		public $nama_table	='regis';
		public $id			='regis_id';
		public $order		='DESC';

		function __construct()
		{
			parent::__construct();
		}

		function ambil_data()
		{
			$this->db->select('regis.regis_id, regis.registered_name, regis.idsch_num, regis.sex, regis.pob, regis.dob, regis.email, regis.phone, regis.origin, regis.vocational, regis.address, regis.story, regis.start, regis.end, regis.resume, regis.approve, regis.already_read, regis.date_received, regis.date_sent, regis.invitation_date, regis.invitation_time, regis.edulvl_id, edulvl.edulvl_name');
			$this->db->join('edulvl', 'edulvl.edulvl_id=regis.edulvl_id');
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

		function get_data_origin($edulvl_id)
		{
			$this->db->select("COUNT(regis.regis_id) AS total, regis.origin");
			$this->db->join('edulvl', 'edulvl.edulvl_id=regis.edulvl_id');
			$this->db->where('regis.edulvl_id',$edulvl_id);
			$this->db->group_by('regis.origin');
			return $this->db->get($this->nama_table)->result();
		}

		function get_voc()
		{
			$this->db->select("COUNT(regis_id) AS total, vocational");
			$this->db->group_by('vocational');
			return $this->db->get($this->nama_table)->result();
		}

		function get_unread()
		{
			$this->db->where('already_read',0);
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

		function get_notapr()
		{
			$this->db->where('approve',0);
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

		function get_apr()
		{
			$this->db->where('approve',1);
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->result();
		}

		function getdata_by_id($id)
		{
			$this->db->select('regis.regis_id, regis.registered_name, regis.idsch_num, regis.sex, regis.pob, regis.dob, regis.email, regis.phone, regis.origin, regis.vocational, regis.address, regis.story, regis.start, regis.end, regis.resume, regis.approve, regis.already_read, regis.date_received, regis.date_sent, regis.invitation_date, regis.invitation_time, regis.edulvl_id, edulvl.edulvl_name');
			$this->db->join('edulvl', 'edulvl.edulvl_id=regis.edulvl_id');
			$this->db->where($this->id,$id);
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

		function _deleteImage($pdf)
		{
		    if ($pdf != false) {
			    $filename = explode(".", $pdf)[0];
				return array_map('unlink', glob(FCPATH."./upload/pdf/$filename.*"));
		    }
		}
	}
	?>