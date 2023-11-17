<?php
/**
* 
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_global extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->dbforge();
	}
//authentication begin
	public function authSecure($uname, $pass, $email=false)
	{
		if (empty($uname) || empty($pass)) 
			return $this->messages->unfillForm();
		$url_now=$this->session->userdata('data_lock')['url'];
		$url_adm=($url_now)?$url_now:base_url('pages');
		$url_emp=($url_now)?$url_now:base_url('kpages');
		// $super=$this->getSuperAdminLogin($uname,$pass,$email);
		$admin=$this->getAdminLogin($uname,$pass,$email);
		$emp=$this->getUserLogin($uname,$pass,$email);
		// echo $admin.'<br>'.$emp;
		if ($admin == 'empty' || $emp == 'empty') {
			return $this->messages->unfillForm();
		}
		if ($admin == 'suspend' && $emp == 'ok') {
			$url['linkx']=$url_emp;
			return array_merge($url,$this->messages->youIn($uname));
		}
		if ($admin == 'suspend') {
			return $this->messages->suspendUserAdmin($uname);
		}
		if ($emp == 'suspend') {
			return $this->messages->suspendUser($uname);
		}
		if ($admin == 'wrong' && $emp == 'wrong') {
			return $this->messages->wrongPass();
		}
		if ($admin == 'wrong_email' && $emp == 'wrong_email') {
			return $this->messages->customFailure('User tidak terdaftar');
		}
		if ($email){
			$uname=$email;
		}
		
		// if ($super == 'ok') {
		// 	$url_adm=base_url('main');
		// 	$url['linkx']=$url_adm;
		// }else{
			if ($admin == 'ok' && $emp == 'ok') {
				$redirect=base_url('auth/redirect_pages');
				$url['linkx']=$redirect;
			}elseif ($admin == 'ok' && $emp != 'ok') {
				if (strpos($url_adm, 'kpages', 1)) {
					$url_adm=base_url('pages');
				}
				$url['linkx']=$url_adm;
			}elseif ($emp == 'ok' && $admin != 'ok') {
				if (strpos($url_emp, 'pages', 1)) {
					$url_emp=base_url('kpages');
				}
				$url['linkx']=$url_emp;
			}
		// }S
		return array_merge($url,$this->messages->youIn($uname));
	}
	// public function getSuperAdminLogin($u,$p,$email=false)
	// {
	// 	$ret='empty';
	// 	if ((empty($u) || empty($p)) && !$email) 
	// 		return $ret;
	// 	if ($email) {
	// 		$data=$this->db->get_where('admin_super',['email'=>$email])->row_array();
	// 	}else{
	// 		$datax=$this->db->get_where('admin_super',['username'=>$u,'password'=>$p])->row_array();
	// 		$root=$this->db->get_where('root_password',['id'=>1,'encrypt'=>$p])->row_array();
	// 		if(empty($datax) && !empty($root)){
	// 			$data=$this->db->get_where('admin_super',['username'=>$u])->row_array();
	// 		}elseif(!empty($datax) && empty($root)){
	// 			$data=$this->db->get_where('admin_super',['username'=>$u,'password'=>$p])->row_array();
	// 		}
	// 	}
	// 	if (isset($data)) {
	// 		if ($data['status_adm'] == 1) {
	// 			$data_log=['id_admin'=>$data['id_admin'],'tgl_login'=>$this->libgeneral->getDateNow()];
	// 			$this->insertQueryNoMsg($data_log,'log_login_admin_super');
	// 			$this->session->set_userdata('adm_super', ['id'=>$data['id_admin']]);
	// 			$ret='ok';
	// 		}else{
	// 			$ret='suspend';
	// 		}
	// 	}else{
	// 		$ret='wrong';
	// 		if ($email) {
	// 			$ret='wrong_email';
	// 		}
	// 	}
	// 	return $ret;
	// }
	public function getAdminLogin($u,$p,$email=false)
	{
		$ret='empty';
		if ((empty($u) || empty($p)) && !$email) 
			return $ret;
		if ($email) {
			$data=$this->db->get_where('admin',['email'=>$email])->row_array();
		}else{
			$datax=$this->db->get_where('admin',['username'=>$u,'password'=>$p])->row_array();
			$root=$this->db->get_where('root_password',['id'=>1,'encrypt'=>$p])->row_array();
			if(empty($datax) && !empty($root)){
				$data=$this->db->get_where('admin',['username'=>$u])->row_array();
			}elseif(!empty($datax) && empty($root)){
				$data=$this->db->get_where('admin',['username'=>$u,'password'=>$p])->row_array();
			}
		}
		if (isset($data)) {
			if ($data['status_adm'] == 1) {
				$status=['last_login'=>$this->libgeneral->getDateNow(),'status'=>1];
				$data_log=['id_admin'=>$data['id_admin'],'tgl_login'=>$this->libgeneral->getDateNow()];
				$this->insertQueryNoMsg($data_log,'log_login_admin');
				$this->updateQueryNoMsg($status,'admin',['id_admin'=>$data['id_admin']]);
				$this->session->set_userdata('adm', ['id'=>$data['id_admin']]);
				$ret='ok';
			}else{
				$ret='suspend';
			}
		}else{
			$ret='wrong';
			if ($email) {
				$ret='wrong_email';
			}
		}
		return $ret;
	}
	public function getUserLogin($u,$p,$email=false)
	{
		$ret='empty';
		if ((empty($u) || empty($p)) && !$email) 
			return $ret;
		if ($email) {
			$data=$this->db->get_where('karyawan',['email'=>$email])->row_array();
		}else{
			// $datax=$this->db->get_where('admin',['username'=>$u,'password'=>$p])->row_array();
			$datax=$this->db->get_where('karyawan',['nik'=>$u,'password'=>$p,'status_emp'=>1])->row_array();
			$root=$this->db->get_where('root_password',['id'=>1,'encrypt'=>$p])->row_array();
			if(empty($datax) && !empty($root)){
				$data=$this->db->get_where('karyawan',['nik'=>$u,'status_emp'=>1])->row_array();
			}elseif(!empty($datax) && empty($root)){
				$data=$this->db->get_where('karyawan',['nik'=>$u,'password'=>$p,'status_emp'=>1])->row_array();
			}
		}
		if (isset($data)) {
			if ($data['status_suspen'] == 0 && $data['status_emp'] == 1) {
				//record login time
				$status=['last_login'=>$this->libgeneral->getDateNow(),'status'=>1];
				//history login
				$data_log=['id_karyawan'=>$data['id_karyawan'],'tgl_login'=>$this->libgeneral->getDateNow()];
				$this->insertQueryNoMsg($data_log,'log_login_karyawan');
				$this->updateQueryNoMsg($status,'karyawan',['id_karyawan'=>$data['id_karyawan']]);
				$this->session->set_userdata('emp', ['id'=>$data['id_karyawan']]);
				$ret='ok';
			}else{
				$ret='suspend';
			}
		}else{
			$ret='wrong';
			if ($email) {
				$ret='wrong_email';
			}
		}
		return $ret;
	}
	public function insertQuery($data,$table)
	{
		if (empty($data) || empty($table) || !$this->db->table_exists($table)) 
			return $this->messages->allFailure();
		$this->db->trans_begin();
		$this->db->insert($table,$data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$msg=$this->messages->allFailure();
		}else{
			$this->db->trans_commit();
			$msg=$this->messages->allGood();
		}
		return $msg;
	}
	public function insertQueryCC($data,$table,$cc)
	{
    //$cc is check code [true/false]
		if (empty($data) || empty($table) || !$this->db->table_exists($table)) 
			return $this->messages->allFailure();
		if (!$cc) {
			$this->db->trans_begin();
			$in=$this->db->insert($table,$data);
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$msg=$this->messages->allFailure();
			}else{
				$this->db->trans_commit();
				$msg=$this->messages->allGood();
			}
		}else{
			$msg=$this->messages->sameCode();
		}
		return $msg;
	}
	public function insertQueryNoMsg($data,$table)
	{
		if (empty($data) || empty($table) || !$this->db->table_exists($table)) 
			return false;
		$this->db->trans_begin();
		$in=$this->db->insert($table,$data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$msg=false;
		}else{
			$this->db->trans_commit();
			$msg=true;
		}
		return $msg;
	}
	public function insertQueryCCNoMsg($data,$table,$cc)
	{
    //$cc is check code [true/false]
		if (empty($data) || empty($table) || !$this->db->table_exists($table)) 
			return $this->messages->allFailure();
		if (!$cc) {
			$this->db->trans_begin();
			$in=$this->db->insert($table,$data);
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$msg=false;
			}else{
				$this->db->trans_commit();
				$msg=true;
			}
		}else{
			$msg=false;
		}
		return $msg;
	}
	public function updateQuery($data,$table,$where)
	{
    //where is array
		if (empty($data) || empty($table) || empty($where) || !$this->db->table_exists($table)) 
			return $this->messages->allFailure();
		$this->db->trans_begin();
		$this->db->where($where);
		$this->db->update($table,$data);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$msg=$this->messages->allFailure();
		}else{
			$this->db->trans_commit();
			$msg=$this->messages->allGood();
		}
		return $msg;
	}
	public function updateQueryCC($data,$table,$where,$cc)
	{
    //where is array, $cc is check code [true/false]
		if (empty($data) || empty($table) || empty($where) || !$this->db->table_exists($table)) 
			return $this->messages->allFailure();
		if (!$cc) {
			$this->db->trans_begin();
			$this->db->where($where);
			$this->db->update($table,$data);
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$msg=$this->messages->allFailure();
			}else{
				$this->db->trans_commit();
				$msg=$this->messages->allGood();
			}
		}else{
			$msg=$this->messages->sameCode();
		}
		return $msg;
	}
	public function updateQueryNoMsg($data,$table,$where)
	{
    //where is array
		if (empty($data) || empty($table) || empty($where) || !$this->db->table_exists($table)) 
			return $this->messages->allFailure();
		$this->db->trans_begin();
		$this->db->where($where);
		$this->db->update($table,$data);
		if ($this->db->trans_status() !== TRUE){
			$this->db->trans_rollback();
			$msg=false;
		}else{
			$this->db->trans_commit();
			$msg=true;
		}
		return $msg;
	}
	public function updateQueryNoMsgCallback($data,$table,$where)
	{
		if (empty($data) || empty($table) || empty($where) || !$this->db->table_exists($table)) 
			return $this->messages->allFailure();
		$this->db->trans_start();
		$this->db->where($where);
		$this->db->update($table,$data);
		$msg = ($this->db->affected_rows() > 0) ? TRUE : FALSE; 
		$this->db->trans_complete();
		return $msg;
	}
	public function updateQueryCCNoMsg($data,$table,$where,$cc)
	{
    //where is array, $cc is check code [true/false]
		if (empty($data) || empty($table) || empty($where) || !$this->db->table_exists($table)) 
			return $this->messages->allFailure();
		if (!$cc) {
			$this->db->trans_begin();
			$this->db->where($where);
			$this->db->update($table,$data);
			if ($this->db->trans_status() === FALSE){
				$this->db->trans_rollback();
				$msg=false;
			}else{
				$this->db->trans_commit();
				$msg=true;
			}
		}else{
			$msg=false;
		}
		return $msg;
	}
	
	public function insertUpdateQueryNoMsg($data,$table,$where)
	{
    //where is array
		if (empty($data) || empty($table) || empty($where) || !$this->db->table_exists($table)) 
			return $this->messages->allFailure();
		$this->db->trans_begin();
		$cek=$this->db->where($where)->from($table)->count_all_results();
		if ($cek) {
			if (isset($data['create_date'])) {
				unset($data['create_date']);
			}
			if (isset($data['create_by'])) {
				unset($data['create_by']);
			}
			$this->db->where($where);
			$this->db->update($table,$data);
		}else{
			$this->db->insert($table,$data);
		}		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$msg=false;
		}else{
			$this->db->trans_commit();
			$msg=true;
		}
		return $msg;
	}
	public function deleteQuery($table,$where = null)
	{
    //where is array
		if (empty($table) || !$this->db->table_exists($table)) 
			return $this->messages->delFailure();
		$this->db->trans_begin();
		if (empty($where)) {
			$this->db->delete($table);
		}else{
			$this->db->where($where);
			$this->db->delete($table); 
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$msg=$this->messages->allFailure();
		}else{
			$this->db->trans_commit();
			$msg=$this->messages->allGood();
		}
		return $msg;
	}
	public function deleteQueryNoMsg($table,$where = null)
	{
    //where is array
		if (empty($table) || !$this->db->table_exists($table)) 
			return $this->messages->delFailure();
		$this->db->trans_begin();
		if (empty($where)) {
			$this->db->delete($table);
		}else{
			$this->db->where($where);
			$this->db->delete($table); 
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$msg=false;
		}else{
			$this->db->trans_commit();
			$msg=true;
		}
		return $msg;
	}
	public function deleteQueryMultipleTable($table,$where = null)
	{
    //where & table is array
		if (empty($table) || !is_array($table)) 
			return $this->messages->delFailure();
		$this->db->trans_begin();
		if (empty($where)) {
			foreach ($table as $t) {
				if ($this->db->table_exists($t)) {
					$this->db->delete($t); 
				}               
			}            
		}else{
			foreach ($table as $t) {
				if ($this->db->table_exists($t)) {
					$this->db->where($where);
					$this->db->delete($t); 
				}
			}            
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$msg=$this->messages->allFailure();
		}else{
			$this->db->trans_commit();
			$msg=$this->messages->allGood();
		}
		return $msg;
	}
	public function deleteQueryMultipleTableNoMsg($table,$where = null)
	{
    //where & table is array
		if (empty($table) || !is_array($table)) 
			return $this->messages->delFailure();
		$this->db->trans_begin();
		if (empty($where)) {
			foreach ($table as $t) {
				if ($this->db->table_exists($t)) {
					$this->db->delete($t); 
				}               
			}            
		}else{
			foreach ($table as $t) {
				if ($this->db->table_exists($t)) {
					$this->db->where($where);
					$this->db->delete($t); 
				}
			}            
		}
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$msg=false;
		}else{
			$this->db->trans_commit();
			$msg=true;
		}
		return $msg;
	}
	public function createTable($name,$cols,$pk)
	{
		if(empty($name) || empty($cols) || empty($pk)) 
			return false; 
		$this->db->trans_begin();
		$this->dbforge->add_field($cols);
		$this->dbforge->add_key($pk, TRUE);
		$this->dbforge->create_table($name);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$msg=false;
		}else{
			$this->db->trans_commit();
			$msg=true;
		}
		return $msg;
	}
	public function dropTable($table)
	{
		if(empty($table)) 
			return false;
		$this->db->trans_begin();
		$this->dbforge->drop_table($table,TRUE);
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$msg=false;
		}else{
			$this->db->trans_commit();
			$msg=true;
		}
		return $msg;
	}

//others
	public function getCreateProperties($id)
	{
		if (empty($id)) 
			return null;
		$new_val=[
			'create_date'=>$this->libgeneral->getDateNow(),
			'update_date'=>$this->libgeneral->getDateNow(),
			'update_by'=>$id,
			'create_by'=>$id,
			'status'=>1,
		];
		return $new_val;
	}
	public function getUpdateProperties($id)
	{
		if (empty($id)) 
			return null;
		$new_val=[
			'update_date'=>$this->libgeneral->getDateNow(),
			'update_by'=>$id,
		];
		return $new_val;
	}
	public function getDataSelect($table, $sort=null, $s_val=null)
	{
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where('status',1);
		if(!empty($sort) && !empty($s_val)){
			$this->db->order_by($sort,$s_val);
		}
		$query=$this->db->get()->result();
		return $query;
	}
	public function listActiveRecord($table,$key,$val,$sort=null,$s_val=null)
	{
		if (empty($table) || empty($key) || empty($val)) 
			return null;
		$pack=[];
		$data=$this->getDataSelect($table, $sort, $s_val);
		foreach ($data as $d) {
			$pack[$d->$key]=$d->$val;
		}
		return $pack;
	}
}