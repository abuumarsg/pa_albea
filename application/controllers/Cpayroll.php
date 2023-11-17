<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cpayroll extends CI_Controller 
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
        // $this->load->model('model_admin');
        // $this->load->model('model_master');
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
		redirect('main/dashboard');
	}
	public function master_komponen()
	{
		if (!$this->input->is_ajax_request())
		   redirect('not_found');
		$usage=$this->uri->segment(3);
		if ($usage == null) {
		   echo json_encode($this->messages->notValidParam());
		}else{
			if ($usage == 'view_all') {
				$data=$this->model_master->getListMasterKomponen();
				// $access=$this->codegenerator->decryptChar($this->input->post('access'));
				$no=1;
				$datax['data']=[];
				foreach ($data as $d) {
					$var=[
						'id'=>$d->id,
						'create'=>$d->create_date,
						'update'=>$d->update_date,
						// 'access'=>$access,
						'status'=>$d->status,
					];
					$properties=$this->libgeneral->getPropertiesTable($var);
					$datax['data'][]=[
						$d->id,
						$d->kode,
						$d->nama,
						$this->libgeneral->getJenisKomponen($d->sifat),
						$d->nama1,
						$d->operation,
						$d->nama2,
						$d->kode_company,
						$properties['tanggal'],
						$properties['status'],
						$properties['aksi'],
					];
					$no++;
				}
				echo json_encode($datax);
			}elseif ($usage == 'view_one') {
				$id = $this->input->post('id');
				$data = $this->model_master->getListMasterKomponen(['a.id'=>$id], true);
				$datax=[
					'id'=>$data['id'],
					'kode'=>$data['kode'],
					'nama'=>$data['nama'],
					'sifat'=>$this->libgeneral->getJenisKomponen($data['sifat']),
					'nama1'=>$data['nama1'],
					'nama2'=>$data['nama2'],
					'operation'=>$data['operation'],
					'status'=>$data['status'],
					'create_date'=>$this->libgeneral->getDateTimeMonthFormatUser($data['create_date']),
					'update_date'=>$this->libgeneral->getDateTimeMonthFormatUser($data['update_date']),
					'create_by'=>$data['create_by'],
					'update_by'=>$data['update_by'],
					// 'nama_buat'=>(!empty($d->nama_buat)) ? $d->nama_buat:$this->otherfunctions->getMark($d->nama_buat),
					// 'nama_update'=>(!empty($d->nama_update))?$d->nama_update:$this->otherfunctions->getMark($d->nama_update)
				];
				echo json_encode($datax);
			}elseif ($usage == 'kode') {
				$data = $this->codegenerator->kodeMasterKomponen();
        		echo json_encode($data);
			}elseif ($usage == 'OperationAritmatic') {
				$data = $this->libgeneral->getOperationAritmaticList();
				$pack=[];
				foreach ($data as $d => $val) {
					$pack[$val]=$val;
				}
        		echo json_encode($pack);
			}elseif ($usage == 'getJenisKomponenList') {
				$data = $this->libgeneral->getJenisKomponenList();
				$pack=[];
				foreach ($data as $d => $val) {
					$pack[$val]=$val;
				}
        		echo json_encode($pack);
			}elseif ($usage == 'dataVariable') {
				$data=$this->model_master->getListMasterKomponen(['a.status'=>'1']);
				$pack=[];
				foreach ($data as $d) {
					$pack[$d->kode]=$d->nama;
				}
        		echo json_encode($pack);
			}else{
				echo json_encode($this->messages->notValidParam());
			}
		}
	}
	public function add_master_komponen()
	{
		$kode = $this->input->post('kode');
		if(!empty($kode)){
			$nama = $this->input->post('nama');
			$sifat = $this->input->post('sifat');
			$radio1 = $this->input->post('radio1');
			$variable_first = $this->input->post('variable_first');
			$data_first = $this->input->post('data_first');
			$operation = $this->input->post('operation');
			$radio2 = $this->input->post('radio2');
			$variable_second = $this->input->post('variable_second');
			$data_second = $this->input->post('data_second');
			$first = ($radio1 == 'data') ? $data_first : $variable_first;
			$second = ($radio2 == 'data') ? $data_second : $variable_second;
			$dataIns = [
				'kode'=>$kode,
				'nama'=>$nama,
				'sifat'=>$sifat,
				'type_first'=>$radio1,
				'first'=>$first,
				'operation'=>$operation,
				'type_second'=>$radio2,
				'second'=>$second,
			];
			$dataIns=array_merge($dataIns, $this->model_global->getCreateProperties($this->admin));
			$datax = $this->model_global->insertQuery($dataIns,'master_komponen');
		}else{
			$datax=$this->messages->notValidParam();
		}
		echo json_encode($datax);
	}
}