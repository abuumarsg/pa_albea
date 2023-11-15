<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Main extends CI_Controller 
{
	public function __construct() 
	{  
		parent::__construct(); 
		if(!empty($_COOKIE['nik'])){
			setcookie('main', 'adm', strtotime('+1 year'), '/');
		}else{
			setcookie('main', '', 0, '/');
		}
		$this->date = $this->libgeneral->getDateNow();
		if ($this->session->has_userdata('adm')) {
			$this->session->unset_userdata('adm');
		}
		if ($this->session->has_userdata('emp')) {
			$this->session->unset_userdata('emp');
		}
		if ($this->session->has_userdata('adm_super')) {
			$this->admin = $this->session->userdata('adm_super')['id'];
		}else{ 
			if(!empty($_COOKIE['main']) == 'adm_super'){
				$dataAdm=$this->db->get_where('admin_super',['username'=>$_COOKIE['nik']])->row_array();
				$this->session->set_userdata('adm_super', ['id'=>$dataAdm['id_admin']]);
				$this->admin = $this->session->userdata('adm_super')['id'];
			}else{
				redirect('auth');
			}
		}
        $this->load->model('model_admin');
	    $this->rando = $this->codegenerator->getPin(6,'number');
		// $dtroot['admin']=$this->model_admin->adm($this->admin);
		$dtroot['admin']=$this->libgeneral->convertResultToRowArray($this->model_admin->getAdminSuper($this->admin));
		// $l_acc=$this->otherfunctions->getYourAccess($this->admin);
		// $l_ac=$this->otherfunctions->getAllAccess();
		// if (isset($l_ac['stt'])) {
		// 	if (in_array($l_ac['stt'], $l_acc)) {
		//       $attr='type="submit"';
		//     }else{
		//       $attr='type="button" data-toggle="tooltip" title="Tidak Diizinkan"';
		//     }
		//     if (!in_array($l_ac['edt'], $l_acc) && !in_array($l_ac['del'], $l_acc)) {
		//       $not_allow='<label class="label label-danger">Tidak Diizinkan</label>';
		//     }else{
		//       $not_allow=NULL;
		//     }
		// }else{
		// 	$not_allow=null;
		// 	$attr=null;
		// }		
		// $this->link=$this->otherfunctions->getYourMenu($this->admin);
		// $this->access=['access'=>$l_acc,'l_ac'=>$l_ac,'b_stt'=>$attr,'n_all'=>$not_allow,'kode_bagian'=>$dtroot['admin']['kode_bagian']];
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
				// 'id_karyawan'=>$dtroot['admin']['id_karyawan'],
				// 'skin'=>$dtroot['admin']['skin'],
				// 'list_bagian'=>$dtroot['admin']['list_filter_bagian'],
				// 'menu'=>$this->model_master->getListMenuActive(),
				// 'your_menu'=>$this->otherfunctions->getYourMenuId($this->admin),
				// 'your_url'=>$this->otherfunctions->getYourMenu($this->admin),
				// 'notif'=>$this->otherfunctions->getYourNotification($this->admin,'admin'),
				// 'kode_bagian'=>$dtroot['admin']['kode_bagian'],
				'id_admin'=>$this->admin,
				// 'access'=>$this->access,
			);
		$this->dtroot=$datax;
	}
	public function index(){
		// redirect('main/'.reset($this->dtroot['adm']['your_url']));
		redirect('main/dashboard');
	}
	public function dashboard(){
		$nama_menu="dashboard";
		// if (in_array($nama_menu, $this->link)) {
		// 	$filter=(isset($this->access['l_ac']['ftr']))?$this->access['kode_bagian']:0;
		// 	$data=array(
		// 		'jml_emp'=>count($this->model_karyawan->getListKaryawan()),
		// 		// 'agd_actv'=>0,//(count($this->model_agenda->actv_attd_agenda_t()))+(count($this->model_agenda->agenda_aktif())),
		// 		// 'agd'=>0,//(count($this->model_agenda->log_attd_agenda()))+(count($this->model_agenda->log_agenda())),
		// 		// 'conc'=>0,//(count($this->model_master->attd_c()))+(count($this->model_master->set_ind())),
		// 		'agd_actv'=>(count($this->model_agenda->getAgendaActive('agenda_kpi')))+(count($this->model_agenda->getAgendaActive('agenda_sikap'))),
		// 		'agd'=>(count($this->model_agenda->getListLogAgendaKpi()))+(count($this->model_agenda->getListLogAgendaSikap()))+(count($this->model_agenda->getListLogAgendaReward())),
		// 		'conc'=>(count($this->model_concept->getListKonsepKpi()))+(count($this->model_concept->getListKonsepSikap())),
		// 		'access'=>$this->access,
		// 		'karyawan'=>$this->model_karyawan->getEmployeeForSelect2($filter),
		// 	);
        $data = [];
			$this->load->view('admin/temp/header', $this->dtroot);
			$this->load->view('admin/temp/sidebar', $this->dtroot);
			$this->load->view('admin/home', $data);
			$this->load->view('admin/temp/footer');
		// }else{
		// 	redirect('pages/not_found');
		// }
	}
	public function komponen_payroll(){
        $data = [];
		$this->load->view('admin/temp/header', $this->dtroot);
		$this->load->view('admin/temp/sidebar', $this->dtroot);
		$this->load->view('admin/komponen_payroll', $data);
		$this->load->view('admin/temp/footer');
	}
}