<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller
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
//==admin==//
	public function list_admin()
	{
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$usage=$this->uri->segment(3);
		if ($usage == null) {
			echo json_encode($this->messages->notValidParam());
		}else{
			if ($usage == 'view_all') {
				$data=$this->model_admin->getListAdmin();
				$access=$this->codegenerator->decryptChar($this->input->post('access'));
				$no=1;
				$datax['data']=[];
				foreach ($data as $d) {
					$var=[
						'id'=>$d->id_admin,
						'create'=>$d->create_date,
						'update'=>$d->update_date,
						'access'=>$access,
						'status'=>$d->status_adm,
					];
					$properties=$this->libgeneral->getPropertiesTable($var);
					$datax['data'][]=[
						$d->id_admin,
						$d->nama,
						$d->email,
						$d->nama_group,
						($d->last_login == '0000-00-00 00:00:00')?'<label class="label label-danger">Belum Pernah Login</label>':$this->libgeneral->getDateTimeMonthFormatUser($d->last_login).' WIB',
						$this->libgeneral->getLevelAdmin($d->level),
						$properties['tanggal'],
						$properties['status'],
						$properties['aksi'],
						($d->status == 1) ? '<i title="online" class="fas fa-circle text-green"></i>':'<i title="offline" class="far fa-circle" style="color:red;border-color:red"></i>',
						$d->username,
						$d->level
					];
					$no++;
				}
				echo json_encode($datax);
			}elseif ($usage == 'view_one') {
				$id = $this->input->post('id_admin');
				$data=$this->model_admin->getAdmin($id);	
				foreach ($data as $d) {
					$datax=[
						'id'=>$d->id_admin,
						'nama'=>$d->nama,
						'username'=>$d->username,
						'email'=>$d->email,
						'alamat'=>$d->alamat,
						'v_level'=>$this->libgeneral->getLevelAdmin($d->level),
						'level'=>$d->level,
						'foto'=>base_url($d->foto),
						'hp'=>$d->hp,
						'kelamin'=>$this->libgeneral->getGender($d->kelamin),
						'kelamin_val'=>$d->kelamin,
						'user_group'=>$d->nama_group,
						'user_group_val'=>$d->id_group,
						'status'=>$d->status_adm,
						'last_login'=>$this->formatter->getDateTimeMonthFormatUser($d->last_login),
						'create_date'=>$this->formatter->getDateTimeMonthFormatUser($d->create_date),
						'update_date'=>$this->formatter->getDateTimeMonthFormatUser($d->update_date),
						'create_by'=>$d->create_by,
						'update_by'=>$d->update_by,
						'nama_buat'=>(!empty($d->nama_buat)) ? $d->nama_buat:$this->otherfunctions->getMark($d->nama_buat),
						'nama_update'=>(!empty($d->nama_update))?$d->nama_update:$this->otherfunctions->getMark($d->nama_update)
					];
				}
				echo json_encode($datax);
			}elseif ($usage == 'level') {
				$data=$this->model_admin->getAdmin($this->admin);	
				foreach ($data as $d) {
					$datax=['level'=>$d->level,];
				}
				echo json_encode($datax);
			}else{
				echo json_encode($this->messages->notValidParam());
			}
		}
	}
	function add_admin(){
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$emp=$this->input->post('employee');
		if (!isset($emp)) {
			$datax=$this->messages->notValidParam(); 
		}else{
			$ug=$this->input->post('u_group');
			$lv=$this->input->post('level');
			foreach ($emp as $e) {
				$kar=$this->model_karyawan->getEmployeeId($e);
				if (isset($kar)) {
					$data=array(
						'nama'=>$kar['nama'],
						'alamat'=>$kar['alamat_sekarang_jalan'].','.$kar['alamat_sekarang_desa'].','.$kar['alamat_sekarang_kecamatan'].','.$kar['alamat_sekarang_kabupaten'].','.$kar['alamat_sekarang_provinsi'].','.$kar['alamat_sekarang_pos'],
						'email'=>$kar['email'],
						'username'=>$kar['nik'],
						'password'=>$kar['password'],
						'foto'=>$kar['foto'],
						'hp'=>$kar['no_hp'],
						'id_karyawan'=>$e,
						'email_verified'=>$kar['email_verified'],
						'id_group'=>$ug,
						'level'=>$lv,
						'status_adm'=>1,
					);
					$data=array_merge($data,$this->model_global->getCreateProperties($this->admin));
					$datax=$this->model_global->insertQuery($data,'admin');
				}
			}
			if (isset($datax)) {
				$datax=$datax;	
			}else{
				$datax=$this->messages->notValidParam();
			}
		}
		echo json_encode($datax);
	}
	function edt_admin(){
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$id=$this->input->post('id');
		if ($id == "") {
			$datax=$this->messages->notValidParam();  
		}else{
			// $lv=$this->input->post('level');
			// if($lv>$this->dtroot['adm']['level']){
			// 	$datax=$this->messages->notValidParam();
			// }else{
			// 	if (isset($lv)) {
			// 		$lv1=$lv;
			// 	}else{
			// 		$lv1=2;
			// 	}
			$data=array(
				'nama'=>ucwords($this->input->post('nama')),
				'username'=>$this->input->post('username'),
				'email'=>$this->input->post('email'),
				'level'=>$this->input->post('level'),
				'alamat'=>$this->input->post('alamat'),
				'hp'=>$this->input->post('no_hp'),
				'id_group'=>$this->input->post('u_group'),
			);
			$data=array_merge($data,$this->model_global->getUpdateProperties($this->admin));
			$datax = $this->model_global->updateQuery($data,'admin',['id_admin'=>$id]);
			// }
		}
		echo json_encode($datax);
	}
}