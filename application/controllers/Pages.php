<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Pages extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		if ($this->session->has_userdata('adm')) {
			$this->admin = $this->session->userdata('adm')['id'];
		}else{
			redirect('auth');
		}
	    $this->rando = $this->codegenerator->getPin(6,'number');
		$dtroot['admin']=$this->model_admin->getAdmin($this->admin, true);
		$l_acc=$this->libgeneral->getYourAccess($this->admin);
		$l_ac=$this->libgeneral->getAllAccess();
		if (isset($l_ac['stt'])) {
			if (in_array($l_ac['stt'], $l_acc)) {
		      $attr='type="submit"';
		    }else{
		      $attr='type="button" data-toggle="tooltip" title="Tidak Diizinkan"';
		    }
		    if (!in_array($l_ac['edt'], $l_acc) && !in_array($l_ac['del'], $l_acc)) {
		      $not_allow='<label class="label label-danger">Tidak Diizinkan</label>';
		    }else{
		      $not_allow=NULL;
		    }
		}else{
			$not_allow=null;
			$attr=null;
		}
		
		$this->link=$this->libgeneral->getYourMenu($this->admin);
		$this->access=['access'=>$l_acc,'l_ac'=>$l_ac,'b_stt'=>$attr,'n_all'=>$not_allow];
		$nm=explode(" ", $dtroot['admin']['nama']);
		$datax['adm'] = array( 
				'nama'=>$nm[0],
				'email'=>$dtroot['admin']['email'],
				'username'=>$dtroot['admin']['username'],
				'kelamin'=>$dtroot['admin']['kelamin'],
				'foto'=>$dtroot['admin']['foto'],
				'create'=>$dtroot['admin']['create_date'],
				'update'=>$dtroot['admin']['update_date'],
				'login'=>$dtroot['admin']['last_login'],
				'level'=>$dtroot['admin']['level'],
				'skin'=>$dtroot['admin']['skin'],
				// 'list_bagian'=>$dtroot['admin']['list_filter_bagian'],
				'menu'=>$this->model_master->getListMenuActive(),
				'your_menu'=>$this->libgeneral->getYourMenuId($this->admin),
				'your_url'=>$this->libgeneral->getYourMenu($this->admin),
				// 'notif'=>$this->libgeneral->getYourNotification($this->admin,'admin'),
				'id_admin'=>$this->admin,
				'access'=>$this->access,
			);
		$this->dtroot=$datax;
	}
	public function index(){
		redirect('pages/dashboard');
	}
	public function dashboard(){
		// $this->load->view('admin/temp/head');
		$this->load->view('admin/temp/header',$this->dtroot);
		$this->load->view('admin/temp/sidebar',$this->dtroot);
		$this->load->view('admin/home');
		$this->load->view('admin/temp/footer',$this->dtroot);
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
		// setcookie('nik', '', 0, '/');
		// setcookie('pages', '', 0, '/');
		$this->session->sess_destroy();
		redirect('auth');
	}
	public function load_modal_delete()
	{
		if (!$this->input->is_ajax_request()) 
		   redirect('not_found');
		$id=$this->input->post('table');
		if (!empty($id)) {
			$data['modal']=$this->load->view('admin/temp/_delete_modal_confirm','',TRUE);
			echo json_encode($data);
		}else{
			echo json_encode($this->messages->sessNotValidParam());
		}
	}
	public function setting_admin(){
		if($this->dtroot['adm']['level'] == 0){
			$level=$this->libgeneral->getLevelAdminList();
		}else{
			$level=$this->libgeneral->getLevelAdminList(1);
		}
		$data=[
			'access'=>$this->access,
			'level'=>$level,
		];
		// $this->load->view('admin/temp/head');
		$this->load->view('admin/temp/header', $this->dtroot);
		$this->load->view('admin/temp/sidebar', $this->dtroot);
		$this->load->view('admin/setting_admin', $data);
		$this->load->view('admin/temp/footer', $this->dtroot);
	}
	public function setting_user_group(){
		// $this->load->view('admin/temp/head');
		$this->load->view('admin/temp/header', $this->dtroot);
		$this->load->view('admin/temp/sidebar', $this->dtroot);
		$this->load->view('admin/setting_user_group');
		$this->load->view('admin/temp/footer', $this->dtroot);
	}
	public function setting_menu(){
		// $this->load->view('admin/temp/head');
		$this->load->view('admin/temp/header', $this->dtroot);
		$this->load->view('admin/temp/sidebar', $this->dtroot);
		$this->load->view('admin/setting_menu');
		$this->load->view('admin/temp/footer', $this->dtroot);
	}
}
