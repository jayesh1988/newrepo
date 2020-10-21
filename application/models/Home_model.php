<?php
Class Home_model extends CI_Model
{
	public function __construct()
	{
		$this->load->database();
	}

	public function list_appointments($slug = FALSE)
	{
		if( $slug === FALSE )
		{
			$this->db->select('*');
			$this->db->from('appointment_master');
			$this->db->where('appointment_status','ACTIVE');
			$this->db->order_by('created_at','desc');
			$query	=	$this->db->get();
			return $query->result_array();
		}
		else
		{
			$this->db->select('*');
			$this->db->from('appointment_master');
			$where	=	array('appointment_status'=>'ACTIVE', 'appointment_id'=>$slug);
			$this->db->where($where);
			$query	=	$this->db->get();
			return $query->row_array();
		}
	}

	public function add_appointment($data)
	{
		return $this->db->insert('appointment_booking', $data);
	}
}