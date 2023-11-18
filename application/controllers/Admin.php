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
						$d->username,
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
						'last_login'=>$this->libgeneral->getDateTimeMonthFormatUser($d->last_login),
						'create_date'=>$this->libgeneral->getDateTimeMonthFormatUser($d->create_date),
						'update_date'=>$this->libgeneral->getDateTimeMonthFormatUser($d->update_date),
						'create_by'=>$d->create_by,
						'update_by'=>$d->update_by,
						'nama_buat'=>(!empty($d->nama_buat)) ? $d->nama_buat:$this->libgeneral->getMark($d->nama_buat),
						'nama_update'=>(!empty($d->nama_update))?$d->nama_update:$this->libgeneral->getMark($d->nama_update)
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
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$retype_password = $this->input->post('retype_password');
		$u_group = $this->input->post('u_group');
		if($password == $retype_password){
			if (!isset($nama)) {
				$datax=$this->messages->notValidParam(); 
			}else{
				$data=array(
					'nama'=>$nama,
					'alamat'=>null,
					'email'=>null,
					'username'=>$username,
					'password'=>hash('sha512', $password),
					'foto'=>null,
					'id_group'=>$u_group,
					'status_adm'=>1,
					'level'=>$this->input->post('level'),
				);
				$data=array_merge($data, $this->model_global->getCreateProperties($this->admin));
				$datax=$this->model_global->insertQuery($data,'admin');
				if (isset($datax)) {
					$datax=$datax;	
				}else{
					$datax=$this->messages->notValidParam();
				}
			}
		}else{
			$datax=$this->messages->customFailure('Password Tidak sama');
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
	//------------------------------------------------------------------------------------------------------//
	//Setting User Group
	public function master_user_group()
	{
		if (!$this->input->is_ajax_request()) 
		   redirect('not_found');
		$usage=$this->uri->segment(3);
		if ($usage == null) {
		   echo json_encode($this->messages->notValidParam());
		}else{
			if ($usage == 'view_all') {
				$data=$this->model_master->getListUserGroup();
				$access=$this->codegenerator->decryptChar($this->input->post('access'));
				$no=1;
				$datax['data']=[];
				foreach ($data as $d) {
					$var=[
						'id'=>$d->id_group,
						'create'=>$d->create_date,
						'update'=>$d->update_date,
						'access'=>$access,
						'status'=>$d->status,
					];

					$properties=$this->libgeneral->getPropertiesTable($var);

					$idm=array_filter(explode(';', $d->list_id_menu));
					$amenu = count($idm).' Menu';
					$amenux ='';
					foreach ($idm as $menul) {
						$mnuu=$this->db->get_where('master_menu',array('id_menu'=>$menul,'id_menu !='=>1))->row_array();
						$amenux .= '<i class="'.$mnuu['icon'].'"></i> '.$mnuu['nama'].'<br>';
					}

					$hak=array_filter(explode(';', $d->list_access));
					$ahak = count($hak).' Hak Akses';
					$ahakx ='';
					foreach ($hak as $hakl) {
						$haku=$this->db->get_where('master_access',array('id_access'=>$hakl))->row_array();
						$ahakx .= '<i class="fa fa-link"></i> '.$haku['nama'].'<br>';
					}

					$datax['data'][]=[
						$d->id_group,
						$d->nama,
						$amenu,
						$ahak,
						$properties['status'],
						$properties['tanggal'],
						$properties['aksi'],
						$amenux,
						$ahakx

					];
					$no++;
				}
				echo json_encode($datax);
			}elseif ($usage == 'view_one') {
				$id = $this->input->post('id_group');
				$data=$this->model_master->getUserGroupOne($id);
				foreach ($data as $d) {

					$idm=explode(';', $d->list_id_menu);
						$amenu = count($idm).' Menu';
					$amenux ='';
					foreach ($idm as $menul) {
						$mnuu=$this->db->get_where('master_menu',array('id_menu'=>$menul,'id_menu !='=>1))->row_array();
						$amenux .= '<i class="'.$mnuu['icon'].'"></i> '.$mnuu['nama'].'<br>';
					}
					
					$aks=explode(';', $d->list_access);
						$ahak = count($aks).' Hak Akses';
					$ahakx ='';
					foreach ($aks as $hakl) {
						$haku=$this->db->get_where('master_access',array('id_access'=>$hakl))->row_array();
						$ahakx .= '<i class="fa fa-link"></i> '.$haku['nama'].'<br>';
					}
					$list_bagian=$this->libgeneral->getParseOneLevelVar($d->list_bagian);
					$bg_detail=$this->libgeneral->getMark();
					if (!empty($list_bagian)){
						$bg_detail='<ol>';
						foreach ($list_bagian as $lb){
							$db=$this->model_master->getBagian(null,['a.kode_bagian'=>$lb]);
							if (isset($db[0])){
								$bg_detail.='<li>'.$db[0]->nama.(($db[0]->nama_level_struktur)?' ('.$db[0]->nama_level_struktur.')':null).'</li>';
							}
						}
						$bg_detail.='</ol>';
					}
					$datax=[
						'id'=>$d->id_group,
						'nama'=>$d->nama,
						'menu'=>$amenu,
						'akses'=>$ahak,
						'list_bagian'=>$list_bagian,
						'list_bagian_detail'=>$bg_detail,
						'status'=>$d->status,
						'create_date'=>$this->libgeneral->getDateTimeMonthFormatUser($d->create_date),
						'update_date'=>$this->libgeneral->getDateTimeMonthFormatUser($d->update_date),
						'create_by'=>$d->create_by,
						'update_by'=>$d->update_by,
						'nama_buat'=>(!empty($d->nama_buat)) ? $d->nama_buat:$this->libgeneral->getMark($d->nama_buat),
						'nama_update'=>(!empty($d->nama_update))?$d->nama_update:$this->libgeneral->getMark($d->nama_update),
						'checked_menu'=>$idm,
						'checked_akses'=>$aks,
						'detail_menu'=>$amenux,
						'detail_akses'=>$ahakx
					];
				}
				echo json_encode($datax);
			}else{
				echo json_encode($this->messages->notValidParam());
			}
		}
	}
	function add_user_group(){
		if (!$this->input->is_ajax_request()) 
		   redirect('not_found');
		$nama=ucwords($this->input->post('nama'));
		$menu_add=$this->input->post('menu_add');
		$akses_add=$this->input->post('akses_add');
		$bagian = $this->input->post('list_bagian');
		if ($nama != "") {
			$data=array(
				'nama'=>$nama,
				'list_id_menu'=>str_replace(",",";",$menu_add),
				// 'list_access'=>str_replace(",",";",$akses_add),
				'list_access'=>$this->libgeneral->packingArray(explode(',',$akses_add)),
			);
			if(!empty($bagian)){
				if(in_array('all',$bagian)){
					$datac = $this->model_master->getListBagian(true);
					foreach ($datac as $dx) {
						$op5[]=$dx->kode_bagian;
					}
					$data['list_bagian']=implode(';', $op5);
				}else{
					$cek_filter=$this->model_master->checkAccessFilter($data['list_access']);
					$data['list_bagian']=(($cek_filter)?$this->libgeneral->packingArray($this->input->post('list_bagian')):null);
				}
			}
			$data=array_merge($data,$this->model_global->getCreateProperties($this->admin));
			$datax = $this->model_global->insertQueryCC($data,'master_user_group',null);
		}else{
			$datax=$this->messages->notValidParam();
		}
		echo json_encode($datax); 
	}
	function edt_user_group(){
		if (!$this->input->is_ajax_request()) 
		   redirect('not_found');
		$id=$this->input->post('id');
		$menu_edit=$this->input->post('menu_edit');
		$akses_edit=$this->input->post('akses_edit');
		$bagian = $this->input->post('list_bagian');
		if ($id != "") {
			$data=array(
				'nama'=>ucwords($this->input->post('nama')),
				'list_id_menu'=>str_replace(",",";",$menu_edit),
				// 'list_access'=>str_replace(",",";",$akses_edit),
				'list_access'=>$this->libgeneral->packingArray(explode(',',$akses_edit)),
			);
			if(!empty($bagian)){
				if(in_array('all',$bagian)){
					$datac = $this->model_master->getListBagian(true);
					foreach ($datac as $dx) {
						$op5[]=$dx->kode_bagian;
					}
					$data['list_bagian']=implode(';', $op5);
				}else{
					$cek_filter=$this->model_master->checkAccessFilter($data['list_access']);
					$data['list_bagian']=(($cek_filter)?$this->libgeneral->packingArray($this->input->post('list_bagian')):null);
				}
			}
			$data=array_merge($data,$this->model_global->getUpdateProperties($this->admin));
			$datax = $this->model_global->updateQueryCC($data,'master_user_group',['id_group'=>$id],null);
		}else{
			$datax = $this->messages->notValidParam(); 
		}
	   	echo json_encode($datax);
	}
	//------------------------------------------------------------------------------------------------------//
	//Setting Manajemen Menu
	public function master_menu(){
		if (!$this->input->is_ajax_request()) 
		   redirect('not_found');
		$usage=$this->uri->segment(3);
		if ($usage == null) {
		   echo json_encode($this->messages->notValidParam());
		}else{
			if ($usage == 'view_all') {
				$data=$this->model_master->getListMenu();
				$access=$this->codegenerator->decryptChar($this->input->post('access'));
				$no=1;
				$datax['data']=[];
				foreach ($data as $d) {
					$var=[
						'id'=>$d->id_menu,
						'create'=>$d->create_date,
						'update'=>$d->update_date,
						'access'=>$access,
						'status'=>$d->status,
					];
					$properties=$this->libgeneral->getPropertiesTable($var);
		      		$sb=$this->libgeneral->getParseOneLevelVar($d->sub_url);
					$res=null;
					if (count($sb) > 0) {
						$res='<ol>';	
						foreach ($sb as $sbb) {
							$res.='<li>'.$sbb.'</li>';
						}
						$res.='</ol>';
					}
					$datax['data'][]=[
						$d->id_menu,
						'<i class="fa '.$d->icon.'"></i> '.$d->nama,
						$d->parent_name,
						$d->sequence,
						$d->url,
						$res,
						$properties['tanggal'],
						$properties['status'],
						$properties['aksi']
					];
					$no++;
				}
				echo json_encode($datax);
			}elseif ($usage == 'view_one') {
				$id = $this->input->post('id_menu');
				$data=$this->model_master->getAllMenubyId($id);
				foreach ($data as $d) {
					$sb=$this->libgeneral->getParseOneLevelVar($d->sub_url);
					$res=null;
					if (count($sb) > 0) {
						$res='<ol>';	
						foreach ($sb as $sbb) {
							$res.='<li>'.$sbb.'</li>';
						}
						$res.='</ol>';
					}
					$datax=[
						'id'=>$d->id_menu,
						'nama'=>$d->nama,
						'parent'=>$d->parent_name,
						'parent_val'=>$d->parent,
						'url'=>$d->url,
						'sub_url'=>$res,
						'sub_url_val'=>$d->sub_url,
						'icon'=>$d->icon,
						'sequence'=>$d->sequence,
						'status'=>$d->status,
						'create_date'=>$this->libgeneral->getDateTimeMonthFormatUser($d->create_date),
						'update_date'=>$this->libgeneral->getDateTimeMonthFormatUser($d->update_date),
						'create_by'=>$d->create_by,
						'update_by'=>$d->update_by,
						'nama_buat'=>(!empty($d->nama_buat)) ? $d->nama_buat:$this->libgeneral->getMark($d->nama_buat),
						'nama_update'=>(!empty($d->nama_update))?$d->nama_update:$this->libgeneral->getMark($d->nama_update)
					];
				}
				echo json_encode($datax);
			}else{
				echo json_encode($this->messages->notValidParam());
			}
		}
	}
	function add_menu(){
		if (!$this->input->is_ajax_request()) 
		   redirect('not_found');
		$nama=$this->input->post('nama');
		$seq=$this->input->post('sequence');
		$parent=$this->input->post('parent');
		$sub_in=$this->input->post('sub_url');
		if ($nama == "" || $seq == "" || $parent == ""){
			echo json_encode($this->messages->notValidParam());
		}else{
			$icon =$this->input->post('icon');
			if ($icon == '') {
				$icon = 'fas fa-chevron-circle-right';
			}
			$url=strtolower($this->input->post('url'));
			$par=$this->model_master->getAllMenubyId($parent);
			foreach ($par as $px) {
				$sub_url=$this->libgeneral->addValueToArrayDb($px->sub_url,$url,';');
				// if ($px->parent !) {
					
				// }
			}
			if ($parent != 0) {
				$this->model_global->updateQuery(['sub_url'=>$sub_url],'master_menu',['id_menu'=>$parent]);
			}
			$data=[
				'nama'=>ucwords($nama),
				'parent'=>$parent,
				'sequence'=>$seq,
				'icon'=>$icon,
				'url'=>$url,
				'sub_url'=>$sub_in,
			]; 
			$data=array_merge($data,$this->model_global->getCreateProperties($this->admin));
			echo json_encode($this->model_global->insertQuery($data,'master_menu'));
		}
	}
	function edt_menu(){
		if (!$this->input->is_ajax_request()) 
		   redirect('not_found');
		$id=$this->input->post('id');
		$nama=$this->input->post('nama');
		$seq=$this->input->post('sequence');
		$parent=$this->input->post('parent');
		$parent_old=$this->input->post('parent_old');
		$sub_in=$this->input->post('sub_url');
		if ($id == "" || $parent_old == "" || $nama == "" || $seq == "" || $parent == ""){
			echo json_encode($this->messages->unfillForm());
		}else{
			$icon =$this->input->post('icon');
			if ($icon == '') {
				$icon = 'fas fa-chevron-circle-right';
			}
			$url=strtolower($this->input->post('url'));
			$par=$this->model_master->getAllMenubyId($parent);
			if ($parent_old == $parent) {
				foreach ($par as $px) {
					$sub_url_add=$this->libgeneral->addValueToArrayDb($px->sub_url,$url,';');
				}
				if ($parent != 0) {
					$this->model_global->updateQuery(['sub_url'=>$sub_url_add],'master_menu',['id_menu'=>$parent]);
				}
			}else{
				$par_old=$this->model_master->getAllMenubyId($parent_old);
				foreach ($par_old as $px_old) {
					$sub_url_del=$this->libgeneral->removeValueToArrayDb($px_old->sub_url,$url,';');
				}
				foreach ($par as $px) {
					$sub_url_add=$this->libgeneral->addValueToArrayDb($px->sub_url,$url,';');
				}
				if ($parent_old != 0 && $parent != 0) {
					$this->model_global->updateQuery(['sub_url'=>$sub_url_add],'master_menu',['id_menu'=>$parent]);
					$this->model_global->updateQuery(['sub_url'=>$sub_url_del],'master_menu',['id_menu'=>$parent_old]);
				}
			}
			$data=[
				'nama'=>ucwords($nama),
				'parent'=>$parent,
				'sequence'=>$seq,
				'icon'=>$icon,
				'url'=>$url,
				'sub_url'=>$sub_in,
			]; 
			$data=array_merge($data,$this->model_global->getCreateProperties($this->admin));
			echo json_encode($this->model_global->updateQuery($data,'master_menu',['id_menu'=>$id]));
		}
	}
}