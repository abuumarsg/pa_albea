<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Master extends CI_Controller
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
		$this->max_range=$this->libgeneral->poin_max_range();
		$this->max_month=$this->libgeneral->column_value_max_range();
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
	//===MASTER DATA PENILAIAN BEGIN===//
	//--------------------------------------------------------------------------------------------------------------//
	//Master Jenis Batasan Poin
	public function master_jenis_batasan_poin()
	{
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$usage=$this->uri->segment(3);
		if ($usage == null) {
			echo json_encode($this->messages->notValidParam());
		}else{
			if ($usage == 'view_all') {
				$data=$this->model_master->getListBatasanPoin();
				$access=$this->codegenerator->decryptChar($this->input->post('access'));
				$no=1;
				$datax['data']=[];
				foreach ($data as $d) {
					$var=[
						'id'=>$d->id_batasan_poin,
						'create'=>$d->create_date,
						'update'=>$d->update_date,
						'access'=>$access,
						'status'=>$d->status,
					];
					$properties=$this->libgeneral->getPropertiesTable($var);
					$tb=[];
					for ($i=1; $i <=$this->max_range ; $i++) { 
						$poin='poin_'.$i;
						$satuan='satuan_'.$i;
						if ($d->$satuan != null) {
							$var='<tr>
							<td>'.$d->$poin.'</td>
							<td>'.$d->$satuan.'</td>
							</tr>';
							array_push($tb, $var);
						}
					}
					if (isset($tb)) {
						$tb=implode('', $tb);
					}else{
						$tb='<tr>
						<td>'.$this->libgeneral->getMark(null).'</td>
						<td>'.$this->libgeneral->getMark(null).'</td>
						</tr>';
					}
					$datax['data'][]=[
						$d->id_batasan_poin,
						$d->kode_batasan_poin,
						$d->nama,
						(($d->lebih_max)?'Ya':'Tidak'),
						'<div style="max-height:300px;overflow:auto"><table class="table table-bordered table-striped table-responsive"><thead><tr class="bg-blue"><th>Poin</th><th>Satuan</th></tr></thead><tbody>'.$tb.'</tbody></table></div>',
						$properties['tanggal'],
						$properties['status'],
						$properties['aksi'],
					];
					$no++;
				}
				echo json_encode($datax);
			}elseif ($usage == 'view_one') {
				$id = $this->input->post('id_batasan_poin');
				$data=$this->model_master->getBatasanPoin($id);
				$datax=[];
				foreach ($data as $d) {
					$tb=[];
					for ($i=1; $i <=$this->max_range ; $i++) { 
						$poin='poin_'.$i;
						$satuan='satuan_'.$i;
						if ($d->$satuan != '') {
							$var='<tr>
							<td>'.$d->$poin.'</td>
							<td>'.$d->$satuan.'</td>
							</tr>';
							array_push($tb, $var);
						}
					}
					if (isset($tb)) {
						$tb=implode('', $tb);
					}else{
						$tb='<tr>
						<td>'.$this->otherfunctions->getMark(null).'</td>
						<td>'.$this->otherfunctions->getMark(null).'</td>
						</tr>';
					}
					$datax=[
						'id'=>$d->id_batasan_poin,
						'kode_batasan_poin'=>$d->kode_batasan_poin,
						'nama'=>$d->nama,
						'lebih_max'=>(($d->lebih_max)?'Ya':'Tidak'),
						'lebih_max_val'=>$d->lebih_max,
						'tr_table'=>$tb,
						'status'=>$d->status,
						'create_date'=>$this->formatter->getDateTimeMonthFormatUser($d->create_date),
						'update_date'=>$this->formatter->getDateTimeMonthFormatUser($d->update_date),
						'create_by'=>$d->create_by,
						'update_by'=>$d->update_by,
						'nama_buat'=>(!empty($d->nama_buat)) ? $d->nama_buat:$this->otherfunctions->getMark($d->nama_buat),
						'nama_update'=>(!empty($d->nama_update))?$d->nama_update:$this->otherfunctions->getMark($d->nama_update)
					];
					for ($i=1;$i<=$this->max_range;$i++){
						$p='poin_'.$i;
						$s='satuan_'.$i;
						if ($d->$s == '') {
							$d->$p=null;
						}
						$datax[$p]=$d->$p;
						$datax[$s]=$d->$s;
					}
				}
				echo json_encode($datax);
			}elseif ($usage == 'kode') {
				$data = $this->codegenerator->kodeBatasanPoin();
				echo json_encode($data);
			}else{
				echo json_encode($this->messages->notValidParam());
			}
		}
	}
	function add_jenis_batasan_poin(){
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$kode=$this->input->post('kode');
		if ($kode != "") {
			$data=[
				'kode_batasan_poin'=>$kode,
				'nama'=>ucwords($this->input->post('nama')),
				'lebih_max'=>$this->input->post('lebih_max'),
			];
			for ($i=1;$i<=$this->max_range;$i++){
				$p='poin_'.$i;
				$s='satuan_'.$i;
				$data[$p]=$this->input->post($p);
				$data[$s]=$this->input->post($s);
				if ($data[$p] == null) {
					$data[$s]=null;
				}
			}
			$data=array_merge($data,$this->model_global->getCreateProperties($this->admin));
			$datax = $this->model_global->insertQueryCC($data,'master_jenis_batasan_poin',$this->model_master->checkBatasanPoinCode($kode));		
		}else{
			$datax=$this->messages->notValidParam(); 
		}
		echo json_encode($datax);
	}
	function edt_jenis_batasan_poin(){
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$id=$this->input->post('id');
		$kode=$this->input->post('kode');
		if ($id != "") {
			$data=[
				'kode_batasan_poin'=>$kode,
				'nama'=>ucwords($this->input->post('nama')),
				'lebih_max'=>$this->input->post('lebih_max'),
			];
			$data_to_kpi=[];
			for ($i=1;$i<=$this->max_range;$i++){
				$p='poin_'.$i;
				$s='satuan_'.$i;
				$data[$p]=$this->input->post($p);
				$data[$s]=$this->input->post($s);
				if ($data[$p] == null) {
					$data[$s]=null;
				}
				$data_to_kpi[$p]=$data[$p];
				$data_to_kpi[$s]=$data[$s];
			}
			$data_to_kpi['lebih_max']=$data['lebih_max'];
			$data_to_trans=$data;
			$data=array_merge($data,$this->model_global->getUpdateProperties($this->admin));
			//cek data
			$old=$this->input->post('kode_old');
			if ($old != $data['kode_batasan_poin']) {
				$cek=$this->model_master->checkBatasanPoinCode($data['kode_batasan_poin']);
			}else{
				$cek=false;
			}
			$datax = $this->model_global->updateQueryCC($data,'master_jenis_batasan_poin',['id_batasan_poin'=>$id],$cek);
			$this->model_global->updateQueryNoMsg($data_to_kpi,'master_kpi',['id_jenis_batasan_poin'=>$id]);
			if (!$cek){
				$data_to_kpi['id_jenis_batasan_poin']=$id;
				$this->model_concept->updateFromMasterKPI($data_to_kpi);//update to concept
				$this->model_agenda->updateAgendaFromConceptMaster($data_to_kpi,'master');//update to agenda
			}
		}else{
			$datax=$this->messages->notValidParam();
		}
		echo json_encode($datax);
	}
}