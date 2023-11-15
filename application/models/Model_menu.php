<?php
/**
* 
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_menu extends CI_Model
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
	public function getListMenu()
	{
		$this->db->select('*');
		$this->db->from('master_menu');
		$this->db->where('status="1"');
		$query=$this->db->get()->result();
		return $query;
	}
}