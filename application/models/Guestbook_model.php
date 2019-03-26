<?php 
	/**
	* 
	*/
	class Guestbook_model extends CI_Model
	{
		public $nama_table	='guestbook';
		public $id			='guestbook_id';
		public $order		='DESC';

		function __construct()
		{
			parent::__construct();
		}

		function get_count()
		{
			$this->db->where('date', date("Y-m-d"));
			return $this->db->get($this->nama_table)->num_rows();
		}

		function data_adding($data)
		{
			return $this->db->insert($this->nama_table,$data);
		}

		function getdata_by_id($id)
		{
			$this->db->select("guestbook.guestbook_id, member.id_number, member.name, YEAR(guestbook.date) AS year, MONTH(guestbook.date) AS month, MONTHNAME(guestbook.date) AS month_name");
			$this->db->join('member', 'member.member_id=guestbook.member_id');
			$this->db->where($this->id,$id);
			return $this->db->get($this->nama_table)->row();
		}

		function getdata_by_memberid($id)
		{
			$this->db->where('member_id',$id);
			$this->db->where('date', date("Y-m-d"));
			$this->db->order_by($this->id,$this->order);
			return $this->db->get($this->nama_table)->row();
		}

		function data_yearandcount()
		{
			$this->db->select("YEAR(date) AS year, MAX(MONTH(date)) AS max_month, COUNT(guestbook_id) AS total");
			$this->db->from($this->nama_table);
			$this->db->group_by('YEAR(date)');
			return $this->db->get()->result();
		}

		function data_monthcount($yr)
		{
			$this->db->select("date, YEAR(date) AS year, MONTH(date) AS month, SUBSTRING('Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec ', (MONTH(date) * 4)- 3, 3) AS month_name, COUNT(guestbook_id) AS total");
			$this->db->from($this->nama_table);
			$this->db->where('YEAR(date)',$yr);
			$this->db->group_by('MONTH(date)');
			return $this->db->get()->result();
		}

		function data_monthandcount($yr, $mt)
		{
			$this->db->select("date, YEAR(date) AS year, MONTH(date) AS month, SUBSTRING('Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec ', (MONTH(date) * 4)- 3, 3) AS month_name, CASE WHEN COUNT(1) > 0 THEN COUNT(guestbook_id) ELSE 0 END AS total");
			$this->db->from($this->nama_table);
			$this->db->where('YEAR(date)',$yr);
			$this->db->where('MONTH(date)',$mt);
			return $this->db->get()->result();
		}

		function data_by_yearmonth($yr, $mt)
		{
			$this->db->select("guestbook.guestbook_id, member.id_number, member.name, guestbook.date, guestbook.time");
			$this->db->from($this->nama_table);
			$this->db->join('member', 'member.member_id=guestbook.member_id');
			$this->db->where('YEAR(date)', $yr);
			$this->db->where('MONTH(date)', $mt);
			$this->db->order_by($this->id,$this->order);
			return $this->db->get()->result();
		}

		function data_by_date($date)
		{
			$this->db->select("DAY(date) AS day, MONTHNAME(date) AS month, YEAR(date) AS year, COUNT(guestbook_id) AS total");
			$this->db->where('date', $date);
			return $this->db->get($this->nama_table)->row();
		}

		function data_by_week()
		{
			$start = date("Y-m-d", strtotime('-7 days'));
			$end = date("Y-m-d");
			$this->db->select("COUNT(guestbook_id) AS total");
			$this->db->where('date >=', $start);
			$this->db->where('date <=', $end);
			return $this->db->get($this->nama_table)->row();
		}

		function data_occupation($date)
		{
			$start = substr($date, 0, 10);
			$end = substr($date, 13, 10);
			$this->db->select("COUNT(guestbook.guestbook_id) AS total, guestbook.date, member.occupation");
			$this->db->from($this->nama_table);
			$this->db->join('member', 'member.member_id=guestbook.member_id');
			$this->db->where('guestbook.date >=', $start);
			$this->db->where('guestbook.date <=', $end);
			$this->db->group_by('member.occupation');
			return $this->db->get()->result();
		}

		function data_occupationandinstance($date, $occupation)
		{
			$start = substr($date, 0, 10);
			$end = substr($date, 13, 10);
			$this->db->select("COUNT(guestbook.guestbook_id) AS total, guestbook.date, member.occupation, member.instance");
			$this->db->from($this->nama_table);
			$this->db->join('member', 'member.member_id=guestbook.member_id');
			$this->db->where('guestbook.date >=', $start);
			$this->db->where('guestbook.date <=', $end);
			$this->db->where('member.occupation ', $occupation);
			$this->db->group_by('member.instance');
			return $this->db->get()->result();
		}

		function cek_member_today($m_id, $date)
		{
			$this->db->where('member_id',$m_id);
			$this->db->where('date',$date);
			return $this->db->get($this->nama_table)->row();
		}

		function delete_data($id)
    	{
        	$this->db->where($this->id,$id);
        	$this->db->delete($this->nama_table);
    	}
	}
	?>