<?php
/**
* 
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_master extends CI_Model
{
	function __construct()
    {
        parent::__construct();
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
	public function getListAccess($active=false)
	{
		if($active){
			$this->db->where('status',1); 
		}		
		$this->db->order_by('create_date','DESC');
		$query=$this->db->get('master_access')->result();
		return $query;
	}
	public function getAccess($id){
		$this->db->select('a.*,b.nama as nama_buat, c.nama as nama_update');
		$this->db->from('master_access AS a');
		$this->db->join('admin AS b', 'b.id_admin = a.create_by', 'left'); 
		$this->db->join('admin AS c', 'c.id_admin = a.update_by', 'left'); 
		$this->db->where('a.id_access',$id); 
		$query=$this->db->get()->result();
		return $query;
	}
	public function getUserGroup($id){
		return $this->db->get_where('master_user_group',array('id_group'=>$id))->row_array();
	}
	public function getMenu($id){
		return $this->db->get_where('master_menu',array('id_menu'=>$id,'status'=>1,'id_menu !='=>0))->row_array();
	}
	public function getListMenuActive()
	{
		$this->db->order_by('sequence','ASC');
		$query=$this->db->get_where('master_menu',['status'=>1,'id_menu !='=>0])->result();
		return $query;
	}
	public function getListUserGroup()
	{
		$this->db->select('a.*');
		$this->db->from('master_user_group a');
		$this->db->order_by('create_date','DESC');
		$query=$this->db->get()->result();
		return $query;
	}
	public function getUserGroupOne($id)
	{
		$this->db->select('a.*,b.nama as nama_buat, c.nama as nama_update');
		$this->db->from('master_user_group AS a');
		$this->db->join('admin AS b', 'b.id_admin = a.create_by', 'left'); 
		$this->db->join('admin AS c', 'c.id_admin = a.update_by', 'left'); 
		$this->db->where('a.id_group',$id); 
		$query=$this->db->get()->result();
		return $query;
	}
	public function getListMenu()
	{
		$where=['a.id_menu !='=>0];
		$this->db->select('a.*,b.nama as parent_name,');
		$this->db->from('master_menu AS a');
		$this->db->join('master_menu AS b', 'b.id_menu = a.parent', 'inner'); 
		$this->db->order_by('a.create_date','DESC');
		$this->db->where($where);
		$query=$this->db->get()->result();
		return $query;
	}
	public function getAllMenubyId($id){
		$where=['a.id_menu'=>$id];
		$this->db->select('a.*,b.nama as parent_name,c.nama as nama_buat, d.nama as nama_update');
		$this->db->from('master_menu AS a');
		$this->db->join('master_menu AS b', 'b.id_menu = a.parent', 'inner'); 
		$this->db->join('admin AS c', 'c.id_admin = a.create_by', 'left'); 
		$this->db->join('admin AS d', 'd.id_admin = a.update_by', 'left'); 
		$this->db->where($where);
		$query=$this->db->get()->result();
		return $query;
	}
	//===MASTER DATA PENILAIAN BEGIN===//
	//--------------------------------------------------------------------------------------------------------------//
	//Master Batasan Poin
		public function getListBatasanPoin($active = false)
		{
			$this->db->select('a.*');
			$this->db->from('master_jenis_batasan_poin AS a');
			if ($active) {
				$this->db->where('a.status',1); 
			}
			$this->db->order_by('update_date','DESC'); 
			$query=$this->db->get()->result();
			return $query;
		}
		public function getBatasanPoin($id)
		{
			$this->db->select('a.*,b.nama as nama_buat, c.nama as nama_update');
			$this->db->from('master_jenis_batasan_poin AS a');
			$this->db->join('admin AS b', 'b.id_admin = a.create_by', 'left'); 
			$this->db->join('admin AS c', 'c.id_admin = a.update_by', 'left');  
			$this->db->where('id_batasan_poin',$id); 
			$query=$this->db->get()->result();
			return $query;
		}
		public function getBatasanPoinKode($kode)
		{
			$this->db->select('a.*,b.nama as nama_buat, c.nama as nama_update');
			$this->db->from('master_jenis_batasan_poin AS a');
			$this->db->join('admin AS b', 'b.id_admin = a.create_by', 'left'); 
			$this->db->join('admin AS c', 'c.id_admin = a.update_by', 'left');  
			$this->db->where('kode_batasan_poin',$kode); 
			$query=$this->db->get()->row_array();
			return $query;
		}
		public function getListBatasanPoinActive()
		{
			return $this->model_global->listActiveRecord('master_jenis_batasan_poin','kode_batasan_poin','nama');
		}
		public function checkBatasanPoinCode($code)
		{
			return $this->model_global->checkCode($code,'master_jenis_batasan_poin','kode_batasan_poin');
		}
}