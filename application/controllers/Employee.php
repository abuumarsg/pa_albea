<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Employee extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->date = $this->libgeneral->getDateNow();

		if ($this->session->has_userdata('adm')) {
			$this->admin = $this->session->userdata('adm')['id'];	 
		}else{ 
			redirect('auth');
		}
		$this->rando = $this->codegenerator->getPin(6,'number');		
		$dtroot['admin']=$this->model_admin->getAdmin($this->admin, true);
		$datax['adm'] = array(
			'nama'=>$dtroot['admin']['nama'],
			'email'=>$dtroot['admin']['email'],
			'kelamin'=>$dtroot['admin']['kelamin'],
			'foto'=>$dtroot['admin']['foto'],
			'create'=>$dtroot['admin']['create_date'],
			'update'=>$dtroot['admin']['update_date'],
			'login'=>$dtroot['admin']['last_login'],
			'level'=>$dtroot['admin']['level'],
		);
		$this->dtroot=$datax;
	}
	function index(){
		redirect('pages/dashboard');
	}
}