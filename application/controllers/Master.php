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
						<td>'.$this->libgeneral->getMark(null).'</td>
						<td>'.$this->libgeneral->getMark(null).'</td>
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
						'create_date'=>$this->libgeneral->getDateTimeMonthFormatUser($d->create_date),
						'update_date'=>$this->libgeneral->getDateTimeMonthFormatUser($d->update_date),
						'create_by'=>$d->create_by,
						'update_by'=>$d->update_by,
						'nama_buat'=>(!empty($d->nama_buat)) ? $d->nama_buat:$this->libgeneral->getMark($d->nama_buat),
						'nama_update'=>(!empty($d->nama_update))?$d->nama_update:$this->libgeneral->getMark($d->nama_update)
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
			$datax = $this->model_global->insertQuery($data,'master_jenis_batasan_poin');		
			// $datax = $this->model_global->insertQueryCC($data,'master_jenis_batasan_poin',$this->model_master->checkBatasanPoinCode($kode));		
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
	//Master KPI
	public function master_kpi()
	{
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$usage=$this->uri->segment(3);
		if ($usage == null) {
			echo json_encode($this->messages->notValidParam());
		}else{
			if ($usage == 'view_all') {
				$data=$this->model_master->getListKpi();
				$access=$this->codegenerator->decryptChar($this->input->post('access'));
				$no=1;
				$datax['data']=[];
				foreach ($data as $d) {
					$var=[
						'id'=>$d->id_kpi,
						'create'=>$d->create_date,
						'update'=>$d->update_date,
						'access'=>$access,
						'status'=>$d->status,
					];
					$properties=$this->libgeneral->getPropertiesTable($var);
					$datax['data'][]=[
						$d->id_kpi,
						$d->kode_kpi,
						$d->kpi,
						$d->detail_rumus,
						($d->unit != null) ? $d->unit : $this->libgeneral->getMark(null),
						($d->nama_batasan_poin != null) ? $d->nama_batasan_poin : $this->libgeneral->getMark(null),
						($d->sifat != null) ? $this->libgeneral->getSifatKpi($d->sifat) : $this->libgeneral->getMark(null),
						$this->libgeneral->getYesNo($d->kpi_utama),
						$properties['status'],
						$properties['aksi'],
					];
					$no++;
				}
				echo json_encode($datax);
			}elseif ($usage == 'view_one') {
				$id = $this->input->post('id_kpi');
				$data=$this->model_master->getKpi($id);
				foreach ($data as $d) {
					$tb=[];
					for ($i=1; $i <= $this->max_range; $i++) { 
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
						<td>'.$this->otherfunctions->getMark(null).'</td>
						<td>'.$this->otherfunctions->getMark(null).'</td>
						</tr>';
					}
					$datax=[
						'id'=>$d->id_kpi,
						'kode_kpi'=>$d->kode_kpi,
						'nama'=>$d->kpi,
						'rumus'=>$d->rumus,
						'rumus_view'=>(!empty($d->rumus)) ? $d->rumus : $this->otherfunctions->getMark(null),
						'unit'=>$d->unit,
						'detail_rumus'=>$d->detail_rumus,
						'sumber_data'=>$d->sumber_data,
						'kaitan'=>$d->kaitan,
						'cara_menghitung'=>$d->cara_menghitung,
						'cara_menghitung_view'=>($d->cara_menghitung)?$this->model_master->getRumusFunction($d->cara_menghitung)['nama']:$this->otherfunctions->getMark(null),
						'kaitan_view'=>$this->otherfunctions->getKaitanNilai($d->kaitan),
						'jenis_satuan'=>$d->jenis_satuan,
						'jenis_satuan_view'=>$this->otherfunctions->getJenisSatuan($d->jenis_satuan),
						'sifat'=>$d->sifat,
						'sifat_view'=>$this->otherfunctions->getSifatKpi($d->sifat),
						'kode_bagian'=>$d->kode_bagian,
						'min'=>$d->min,
						'max'=>$d->max,
						'lebih_max'=>(($d->lebih_max)?'Ya':'Tidak'),
						'lebih_max_val'=>$d->lebih_max,
						'batasan_poin'=>$d->id_jenis_batasan_poin,
						'nama_batasan_poin'=>(!empty($d->nama_batasan_poin)) ? $d->nama_batasan_poin : $this->otherfunctions->getMark(),
						'bagian'=>(!empty($d->nama_bagian)) ? $d->nama_bagian : $this->otherfunctions->getMark(),
						'tr_table'=>$tb,
						'status'=>$d->status,
						'create_date'=>$this->formatter->getDateTimeMonthFormatUser($d->create_date),
						'update_date'=>$this->formatter->getDateTimeMonthFormatUser($d->update_date),
						'create_by'=>$d->create_by,
						'update_by'=>$d->update_by,
						'nama_buat'=>(!empty($d->nama_buat)) ? $d->nama_buat:$this->otherfunctions->getMark($d->nama_buat),
						'nama_update'=>(!empty($d->nama_update))?$d->nama_update:$this->otherfunctions->getMark($d->nama_update),
						'kpi_utama'=>$this->otherfunctions->getYesNo($d->kpi_utama),
						'e_kpi_utama'=>$d->kpi_utama,
					];
					for ($i=1;$i<=$this->max_range;$i++){
						$p='poin_'.$i;
						$s='satuan_'.$i;
						if ($d->$s == null) {
							$d->$p=null;
						}
						$datax[$p]=$d->$p;
						$datax[$s]=$d->$s;
					}
				}
				echo json_encode($datax);
			}elseif ($usage == 'kode') {
				$data = $this->codegenerator->kodeKpi();
				echo json_encode($data);
			}else{
				echo json_encode($this->messages->notValidParam());
			}
		}
	}
	function add_kpi(){
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$kode=$this->input->post('kode');
		if ($kode != "") {
			$data=[
				'kode_kpi'=>$kode,
				'kpi'=>ucwords($this->input->post('kpi')),
				'rumus'=>$this->input->post('rumus'),
				'unit'=>$this->input->post('unit'),
				'detail_rumus'=>$this->input->post('detail_rumus'),
				'sumber_data'=>$this->input->post('sumber_data'),
				'kaitan'=>$this->input->post('kaitan'),
				'jenis_satuan'=>$this->input->post('jenis_satuan'),
				'sifat'=>$this->input->post('sifat'),
				'cara_menghitung'=>strtoupper($this->input->post('cara_menghitung')),
				'kode_bagian'=>$this->input->post('bagian'),
				'min'=>$this->input->post('min'),
				'max'=>$this->input->post('max'),
				'id_jenis_batasan_poin'=>$this->input->post('batasan_poin'),
				'lebih_max'=>$this->input->post('lebih_max'),
				'kpi_utama'=>$this->input->post('kpi_utama'),
			];
			if ($data['sifat'] == 'MAX') {
				$data['min']=null;
				$data['max']=null;
			}
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
			$datax = $this->model_global->insertQueryCC($data,'master_kpi',$this->model_master->checkKpiCode($kode));		
		}else{
			$datax=$this->messages->notValidParam(); 
		}
		echo json_encode($datax);
	}
	function edt_kpi(){
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$id=$this->input->post('id');
		$kode=$this->input->post('kode');
		if ($id != "") {
			$data=[
				'kode_kpi'=>$kode,
				'kpi'=>ucwords($this->input->post('kpi')),
				'rumus'=>$this->input->post('rumus'),
				'unit'=>$this->input->post('unit'),
				'detail_rumus'=>$this->input->post('detail_rumus'),
				'sumber_data'=>$this->input->post('sumber_data'),
				'kaitan'=>$this->input->post('kaitan'),
				'jenis_satuan'=>$this->input->post('jenis_satuan'),
				'sifat'=>$this->input->post('sifat'),
				'cara_menghitung'=>strtoupper($this->input->post('cara_menghitung')),
				'kode_bagian'=>$this->input->post('bagian'),
				'min'=>$this->input->post('min'),
				'max'=>$this->input->post('max'),
				'id_jenis_batasan_poin'=>$this->input->post('batasan_poin'),
				'lebih_max'=>$this->input->post('lebih_max'),
				'kpi_utama'=>$this->input->post('kpi_utama'),
			];
			if ($data['sifat'] == 'MAX') {
				$data['min']=null;
				$data['max']=null;
			}
			for ($i=1;$i<=$this->max_range;$i++){
				$p='poin_'.$i;
				$s='satuan_'.$i;
				$data[$p]=$this->input->post($p);
				$data[$s]=$this->input->post($s);
				if ($data[$p] == null) {
					$data[$s]=null;
				}
			}
			$data_to_trans=$data;
			$data=array_merge($data,$this->model_global->getUpdateProperties($this->admin));
			//cek data
			$old=$this->input->post('kode_old');
			if ($old != $data['kode_kpi']) {
				$cek=$this->model_master->checkKpiCode($data['kode_kpi']);
			}else{
				$cek=false;
			}
			$datax = $this->model_global->updateQueryCC($data,'master_kpi',['id_kpi'=>$id],$cek);
			if (!$cek){
				unset($data_to_trans['kode_bagian']);
				$this->model_concept->updateFromMasterKPI($data_to_trans);//update to concept
				$this->model_agenda->updateAgendaFromConceptMaster($data_to_trans,'master');//update to agenda
			}
		}else{
			$datax=$this->messages->notValidParam();
		}
		echo json_encode($datax);
	}
	function export_kpi()
	{
		$data['properties']=[
			'title'=>"Template Master KPI",
			'subject'=>"Template Master KPI",
			'description'=>"Template untuk master KPI",
			'keywords'=>"Template Master, Template KPI",
			'category'=>"Template",
		];
		
		$head=['KODE KPI (KPIYYYYMMDDXXXX)','KPI','CARA MENGHITUNG (AVG/SUM)','UNIT / SATUAN','DETAIL RUMUS','KAITAN NILAI (0/1)','SUMBER DATA','MIN/MAX','JENIS SATUAN (0/1)','NILAI MINIMAL','NILAI MAKSIMAL'];
		for ($i=1;$i<=$this->max_range;$i++){
			array_push($head,'POIN '.$i);
			array_push($head,'NILAI '.$i);
		}
		$sheet[0]=[
			'range_huruf'=>3,
			'sheet_title'=>'Template Master KPI',
			'head'=>[
				'row_head'=>1,
				'data_head'=>$head,
			]
		];
		$data['data']=$sheet;
		$this->rekapgenerator->genExcel($data);
	}
	function export_data_kpi()
	{
		$data['properties']=[
			'title'=>"Data Master KPI",
			'subject'=>"Data Master KPI",
			'description'=>"Data untuk master KPI",
			'keywords'=>"Data Master, Data KPI",
			'category'=>"Data",
		];
		
		$body=[];
		$datax=$this->model_master->getListKpi(true);
		$row_body=2;
		$row=$row_body;
		foreach ($datax as $d) {
			$arr[$row]=[];
			for ($i=1; $i <= $this->max_range ; $i++) { 
				$col_p='poin_'.$i;
				$col_s='satuan_'.$i;
				array_push($arr[$row],$d->$col_p);
				array_push($arr[$row],$d->$col_s);
			}
			$body[$row]=[
				$d->kode_kpi,
				$d->kpi,
				// $d->rumus,
				$d->cara_menghitung,
				$d->unit,
				$d->detail_rumus,
				// $d->definisi,
				$d->kaitan,
				$d->sumber_data,
				$d->jenis,
				$d->sifat,
				$d->jenis_satuan,
				$d->min,
				$d->max,
			];
			$body[$row]=array_merge($body[$row],$arr[$row]);
			$row++;
		}
		$head=['KODE KPI (KPIYYYYMMDDXXXX)','KPI','CARA MENGHITUNG (AVG/SUM)','UNIT / SATUAN','DETAIL RUMUS','KAITAN NILAI (0/1)','SUMBER DATA','MIN/MAX','JENIS SATUAN (0/1)','NILAI MINIMAL','NILAI MAKSIMAL'];
		for ($i=1;$i<=$this->max_range;$i++){
			array_push($head,'POIN '.$i);
			array_push($head,'NILAI '.$i);
		}
		$sheet[0]=[
			'range_huruf'=>3,
			'sheet_title'=>'Data Master KPI',
			'head'=>[
				'row_head'=>1,
				'data_head'=>$head,
			],
			'body'=>[
				'row_body'=>$row_body,
				'data_body'=>$body
			],
		];
		$data['data']=$sheet;
		$this->rekapgenerator->genExcel($data);
	}
	function import_kpi()
	{
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$data['properties']=[
			'post'=>'file',
			'data_post'=>$this->input->post('file', TRUE),
		];
		
		$col=['kode_kpi','kpi','cara_menghitung','unit','detail_rumus','kaitan','sumber_data','sifat','jenis_satuan','min','max'];
		for ($i=1;$i<=$this->max_range;$i++){
			array_push($col,'poin_'.$i);
			array_push($col,'satuan_'.$i);
		}
		$sheet[0]=[
			'range_huruf'=>3,
			'row'=>2,
			'table'=>'master_kpi',
			'column_code'=>'kode_kpi',
			'column_proerties'=>$this->model_global->getCreateProperties($this->admin),
			//urutan sama dengan export
			'column'=>$col,
		];
		$data['data']=$sheet;
		$datax=$this->rekapgenerator->importFileExcel($data);
		echo json_encode($datax);
	}
}