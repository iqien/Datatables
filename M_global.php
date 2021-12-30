<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_global extends CI_Model {

	public function getCount($limit,$start,$search,$order,$dir,$where=[])
	{
		if( ! method_exists($this, 'getMainQuery') )
		{
			$this->db->select('COUNT(*) as total')
			->from('view_monitoring');

		}
		else
		{
			$this->getMainQuery();
			$this->db->select('COUNT(*) as total');
		}

		if(!empty($search))
		{
			$this->db->group_start();
			foreach($search as $key => $value){
				$this->db->or_like($key,$value);
			}
			$this->db->group_end();
		}
		if($this->input->post('status') == 'In%20Progress'){
			$s = 'In Progress';
		}else{
			$s = $this->input->post('status');
		}
		$conditions = array(
			'am_id' => $this->input->post('am_id'),
			'ORDER_STATUS' =>$s,
		);
		$this->db->where($conditions);
		$this->db->where($where);
		$result = $this->db->get();

		return $result->row()->total;
	}
	public function getAllBy($limit,$start,$search,$col,$dir,$where=[])
	{
		if( ! method_exists($this, 'getMainQuery'))
		{

			$this->db->select('*')
			->from('view_monitoring');
		}
		else
		{
			$this->getMainQuery();
		}

		if(!empty($search))
		{
			$this->db->group_start();
			foreach($search as $key => $value){
				$this->db->or_like($key,$value);
			}
			$this->db->group_end();
		}
		if($this->input->post('status') == 'In%20Progress'){
			$s = 'In Progress';
		}else{
			$s = $this->input->post('status');
		}
		$conditions = array(
			'am_id' => $this->input->post('am_id'),
			'ORDER_STATUS' =>$s,
		);
		$this->db->where($conditions);
		$result = $this->db->get();
		if($result->num_rows()>0)
		{
			return $result->result();
		}
		else
		{
			return null;
		}
	}

}
