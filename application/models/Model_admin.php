<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_admin extends CI_Model
{
	function __construct()
    {
        parent::__construct();
		// $this->load->model('model_master');
		// $this->filter_admin=[];
		// if ($this->session->has_userdata('adm')) {
		// 	$id_adm = $this->session->userdata('adm')['id'];
		// 	$data_admin=$this->getAdmin($id_adm);
		// 	if (isset($data_admin[0])) {
		// 		$this->filter_admin=[
		// 			'list_filter_bagian'=>$this->otherfunctions->getParseOneLevelVar($data_admin[0]->list_filter_bagian),
		// 			'filter_status'=>$this->model_master->checkAccessFilter($data_admin[0]->list_access),
		// 			'kode_bagian'=>$data_admin[0]->kode_bagian,
		// 		];
		// 	}
		// }
    }
	// public function getAdminSuper($id)
	// {
	// 	$this->db->select('a.*,b.nama as nama_buat, c.nama as nama_update');
	// 	$this->db->from('admin_super AS a');
	// 	$this->db->join('admin_super AS b', 'b.id_admin = a.create_by', 'inner'); 
	// 	$this->db->join('admin_super AS c', 'c.id_admin = a.update_by', 'inner');
	// 	$this->db->where('a.id_admin',$id); 
	// 	$query=$this->db->get()->result();
	// 	return $query;
	// }
	public function getAdmin($id, $row=false)
	{
		$this->db->select('xa.*,b.nama as nama_buat, c.nama as nama_update,d.nama as nama_group,d.list_access');
		$this->db->from('admin AS xa');
		$this->db->join('admin AS b', 'b.id_admin = xa.create_by', 'inner'); 
		$this->db->join('admin AS c', 'c.id_admin = xa.update_by', 'inner'); 
		$this->db->join('master_user_group AS d', 'd.id_group = xa.id_group', 'left');
		$this->db->where('xa.id_admin',$id);
		if($row){
			$query=$this->db->get()->row_array();
		}else{
			$query=$this->db->get()->result();
		}
		return $query;
	}
	public function getListAdmin()
	{
		$where=['a.id_admin !='=>1];
		$this->db->select('a.*,b.nama as nama_group');
		$this->db->from('admin AS a');
		$this->db->join('master_user_group AS b', 'b.id_group = a.id_group', 'left'); 
		$this->db->order_by('update_date','DESC');
		$this->db->where($where); 
		$query=$this->db->get()->result();
		return $query;
	}
}