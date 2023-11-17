<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Messages {

	protected $CI;
	public function __construct()
	{
		$this->CI =& get_instance();
	}

	public function index()
	{
		$this->redirect('not_found');
	}	
	//===MESSAGES BEGIN===//
	//others begin
	public function unfillForm()
	{
		$msg=['status_data'=>false,'msg'=>'Oops, Semua Inputan Tidak Boleh Kosong!'];
		return $msg;
	}
	//others end

	//auth begin
	public function wrongPass()
	{
		$msg=['status_data'=>'wrong','msg'=>'Username atau Password Anda Salah'];
		return $msg;
	}
	public function notRegistered()
	{
		$msg=['status_data'=>false,'msg'=>'Username Tidak Terdaftar'];
		return $msg;
	}
	public function suspendUserAdmin($uname)
	{
		$msg=['status_data'=>'warning','msg'=>'Username '.$uname.' (Administrator) telah disuspend!, Harap hubungi Administrator'];
		return $msg;
	}
	public function suspendUser($uname)
	{
		$msg=['status_data'=>'warning','msg'=>'Username '.$uname.' telah disuspend!, Harap hubungi Administrator'];
		return $msg;
	}
	public function youIn($name)
	{
		$msg=['status_data'=>true,'msg'=>'Hi '.$name.', Welcome Back to MyPayroll'];
		return $msg;
	}
	//auth end
	//insert db begin
	public function OK()
	{
		$msg=['status_data'=>true,'msg'=>'OK'];
		return $msg;
	}
	public function allGood()
	{
		$msg=['status_data'=>true,'msg'=>'Transaksi Berhasil'];
		return $msg;
	}
	public function allFailure()
	{
		$msg=['status_data'=>false,'msg'=>'Transaksi Gagal'];
		return $msg;
	}
	public function delGood()
	{
		$msg=['status_data'=>true,'msg'=>'Data Berhasil Dihapus'];
		return $msg;
	}
	public function customGood($string)
	{
		$msg=['status_data'=>true,'msg'=>'Transaksi Berhasil, '.$string];
		return $msg;
	}
	public function customFailure($string)
	{
		$msg=['status_data'=>false,'msg'=>'Transaksi Gagal, '.$string];
		return $msg;
	}
	public function customWarning($string)
	{
		$msg=['status_data'=>'warning','msg'=>'Transaksi Sebagian Gagal, '.$string];
		return $msg;
	}
	public function customWarning2($string)
	{
		$msg=['status_data'=>'warning','msg'=>'Transaksi Berhasil, '.$string];
		return $msg;
	}
	public function delFailure()
	{
		$msg=['status_data'=>false,'msg'=>'Data Gagal Dihapus'];
		return $msg;
		return ;
	}
	public function sameCode()
	{
		$msg=['status_data'=>false,'msg'=>'Kode Sama, Gunakan Kode yang Lain'];
		return $msg;
	}
	public function notValidParam()
	{
		$msg=['status_data'=>false,'msg'=>'Invalid Parameter'];
		return $msg;
	}
	public function sessNotValidParam()
	{
		return $this->CI->session->set_flashdata('error', 'Invalid Parameter');
	}
	public function sessSuccess($var=null)
	{
		return $this->CI->session->set_flashdata('success', ((empty($var))?'Transaksi Berhasil':$var));
	}
	public function sessError($var=null)
	{
		return $this->CI->session->set_flashdata('error', ((empty($var))?'Transaksi Gagal':$var));
	}
	public function duplicateData()
	{
		$msg=['status_data'=>false,'msg'=>'Data Sudah Ada, Cek Kembali Data Anda'];
		return $msg;
	}
	// public function formValidateRequired($form)
	// {
	// 	//form is array
	// 	if (empty($form)) 
	// 		return $this->allGood();
	// 	$pack=[];
	// 	foreach ($form as $key=>$val) {
	// 		if (empty($val)) {
	// 			array_push($pack,ucwords($key));
	// 		}
	// 	}
	// 	if (!isset($pack)) 
	// 		return $this->allGood();
		
	// 	$msg=['status_data'=>false,'form_msg'=>implode(',',$pack).' Tidak Boleh Kosong'];
	// 	return $msg;
	// }
	// //insert db end
	// //label
	public function not_allow()
	{
		return '<label class="label label-danger">Tidak Diizinkan</label>';
	}
	//===MESSAGES END===//
}