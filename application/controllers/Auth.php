<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}
	public function index(){
		if(!empty($_COOKIE['nik'])){
			if(!empty($_COOKIE['pages']) == 'adm_super'){
				redirect('main');
			}
			if(!empty($_COOKIE['pages']) == 'adm'){
				redirect('pages');
			}
			if(!empty($_COOKIE['pages']) == 'emp'){
				redirect('kpages');
			}
		}
		if ($this->session->has_userdata('adm_super')) {
			redirect('main'); 	
		}elseif ($this->session->has_userdata('adm')) {
			redirect('pages');
		}elseif ($this->session->has_userdata('emp')) {
			redirect('kpages');
		}
		$this->load->view('utama/temp/header');
		$this->load->view('utama/login');
		$this->load->view('utama/temp/footer');
	}
	public function google()
	{
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$jwt_token=$this->input->post('token');
		echo $jwt_token;
		$parser=$this->codegenerator->jwtParser($jwt_token);
		if ($parser) {
			echo json_encode($auth=$this->model_global->authSecure('google','google',$parser->email));
		}else{
			echo json_encode($this->messages->unfillForm());
		}
	}
	public function login(){
		redirect('pages/dashboard');
	}
	public function logout()
	{
		if ($this->session->has_userdata('adm')) {
			$data=['status'=>0];
			$this->db->where('id_admin',$this->session->userdata('adm')['id']);
			$this->db->update('admin',$data);
		}
		if ($this->session->has_userdata('emp')) {
			$data=['status'=>0];
			$this->db->where('id_karyawan',$this->session->userdata('emp')['id']);
			$this->db->update('karyawan',$data);
		}
		setcookie('nik', '', 0, '/');
		setcookie('pages', '', 0, '/');
		$this->session->sess_destroy();
		redirect('auth');
	}
	public function do_login()
	{
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$this->load->model('model_global');
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$remember=$this->input->post('remember');
		if($remember == 'on'){
			// setcookie('nik', $username, strtotime('+1 year'), '/');
		}
		$password=$this->codegenerator->genPassword($password);
		// if ($captcha != $this->session->userdata('captcha_word')) {
		// 	echo json_encode($this->messages->customFailure('Captcha Salah, Mohon Input Dengan Benar'));
		// }else{
		// }
		if (empty($username) || empty($password)) {
			echo json_encode($this->messages->unfillForm());
		}else{
			echo json_encode($this->model_global->authSecure($username, $password));
		}
	}
}
