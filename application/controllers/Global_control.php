<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_control extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->date = $this->libgeneral->getDateNow();
		if (!$this->session->has_userdata('adm') && !$this->session->has_userdata('emp')) {
			redirect('not_found'); 
		}
		if (isset($_SESSION['adm'])) {
			$this->admin = $_SESSION['adm']['id'];	
		}
	}
	public function index(){
		redirect('not_found');
	}
//update select option
	public function select2_global() 
	{
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$table=$this->input->post('table');
		$column=$this->input->post('column');
		$name=$this->input->post('name');
		$sort=$this->input->post('sort');
		$s_val=$this->input->post('s_val');
		if (empty($table) || empty($column) || empty($name))
			echo json_encode($this->messages->notValidParam());
		$datax=$this->model_global->listActiveRecord($table,$column,$name,$sort,$s_val);
		echo json_encode($datax);
	}
	public function change_status()
	{
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$table=$this->input->post('table');
		$data=$this->input->post('data');
		$where=$this->input->post('where');
		
		if (empty($table) || empty($data) || empty($where))
			echo json_encode($this->messages->notValidParam());
		$datax=$this->model_global->updateQuery($data,$table,$where);
		echo json_encode($datax);
	}
	public function change_status2()
	{
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$tahun=$this->input->post('tahun');
		$table=$this->input->post('table');
		$data=$this->input->post('data');
		$where=$this->input->post('where');
		$data=array_merge($data,$this->model_global->getUpdateProperties($this->admin));
		if (empty($table) || empty($data) || empty($where))
			echo json_encode($this->messages->notValidParam());
		$datax=$this->model_global->updateQuery($data,$table,$where);
		echo json_encode($datax);
	}
	public function delete()
	{
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$table=$this->input->post('table');
		$column=$this->input->post('column');
		$id=$this->input->post('id');
		$table2=$this->input->post('table2');
		$column2=$this->input->post('column2');
		$id2=$this->input->post('id2');
		$drop_table=$this->input->post('table_drop');
		$link_table=$this->input->post('link_table');
		$link_col=$this->input->post('link_col');
		$link_data_col=$this->input->post('link_data_col');
		$file=$this->input->post('file');
		if (empty($table) || empty($column) || empty($id))
			echo json_encode($this->messages->notValidParam());
		if (isset($drop_table)) {
			$this->model_global->dropTable($drop_table);
		}
		if (!empty($link_table) && !empty($link_col) && !empty($link_data_col)) {
			$wh=[$link_col=>$link_data_col];
			$this->model_global->deleteQueryNoMsg($link_table,$wh);
		}
		if(!empty($file)){
			unlink($file);
		}
		if (!empty($table2) && !empty($column2) && !empty($id2)){
			$where2=[$column2=>$id2];
			$this->model_global->deleteQuery($table2,$where2);
		}
		$where=[$column=>$id];
		$datax=$this->model_global->deleteQuery($table,$where);
		echo json_encode($datax);
	}
	public function select2_custom()
	{
		if (!$this->input->is_ajax_request()) 
			redirect('not_found');
		$usage=$this->uri->segment(3);
		$table=$this->codegenerator->decryptChar($this->input->post('table'));
		if (empty($usage) && empty($table))
			echo json_encode($this->messages->notValidParam());
		if ($usage == 'master_periode_penilaian') {
			$datax=$this->model_master->getListPeriodePenilaianActive();
		}else if ($usage == 'get_agenda_kpi') {
			$kpi=$this->model_agenda->getListAgendaKpi();
			$datax=[];
			foreach ($kpi as $k) {
				$datax[$k->nama_tabel]=$k->nama.' ('.$k->nama_periode.' - '.$k->tahun.')';
			}
		}else{			
			$datax=$this->messages->notValidParam();
		}
		echo json_encode($datax);
	}
	public function file_download()
	{
		if (empty($this->uri->segment(3))) {
			redirect('not_found');
		}
		$file=$this->codegenerator->decryptChar($this->uri->segment(3));
		// print_r($file);
		$do=$this->filehandler->doDownload($file);
		if (!$do) {
			redirect('not_found');
		}
	}
	public function encryptChar()
	{
		$val = $this->input->post('val');
		$new_val = $this->codegenerator->encryptChar($val);
		echo json_encode($new_val);
	}

	public function decryptChar()
	{
		$val = $this->input->post('val');
		$new_val = $this->codegenerator->decryptChar($val);
		echo json_encode($new_val);
	}
}