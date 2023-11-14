<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Codegenerator{
    
    protected $CI;
    public function __construct()
    {
        $this->CI =& get_instance();
    }

    public function index()
    {
        $this->redirect('not_found');
    }
    
    //===LOGIC BEGIN===//
    //main
    public function differentValueCode($table,$columncode,$columnid,$front,$value_max_where,$column_max_where,$usefor)
    {
        if ($value_max_where == '')
			return null;
		$other_list=['lembur','ijin_pribadi','ijin_dinas','perjanjian','kode_master'];
        $romawi=['01'=>'I','02'=>'II','03'=>'III','04'=>'IV','05'=>'V','06'=>'VI','07'=>'VII','08'=>'VIII','09'=>'IX','10'=>'X','11'=>'XI','12'=>'XII'];
        $query = "SELECT $columncode FROM $table WHERE $columnid = (SELECT MAX($columnid) FROM $table WHERE $column_max_where = '$value_max_where')";
        $qq = $this->CI->db->query($query)->row_array();
        $date=$this->CI->libgeneral->getDateNow();
        $year_now=date("Y",strtotime($date));
        $month_now=date("m",strtotime($date));
        $y=$this->firstNum(4);
		$date_format=date('Ymd',strtotime($date));
		if (in_array($usefor, $other_list)) {
			$y=$this->firstNum(4);
			$date_format=date('Ymd',strtotime($date));
			if ($qq == NULL) {
				$no=$front.$date_format.$y;
			}else{
				$d_new=date('d',strtotime($date));
				$d_old=$this->getDay($front,$qq[$columncode]);
				if (($d_new != $d_old) || empty($d_old)) {
					$no=$front.$date_format.$y;
				}else{
					$num=substr($qq[$columncode], -4);
					$n1=str_replace($front, '', $qq[$columncode]);
					$date_old=substr($n1, 0, -4);
					$no=$front.$date_old.$this->magicNum($num);
				}
			}
        }elseif($usefor == 'simpleCode'){
            if ($qq == NULL) {
                $y=$this->firstNum(5);
                $no=$front.$y;
            }else{
                if(empty($qq[$columncode])){
                    $no=$front.$this->firstNum(5);
                }else{
                    $num=substr($qq[$columncode], -5);
                    $n1=str_replace($front, '', $qq[$columncode]);
                    $no=$front.$this->magicNum($num);
                }
            }
		}else{
			$no=$front.$date_format.$y;
		}
        return $no;
    }
    public function logicGenerator($table,$columncode,$columnid,$front,$usefor,$other_var=null)
    {
        if (empty($table) || empty($columncode) || empty($columnid) || empty($usefor)) 
            return null;
        //condition
        $where_penilaian=['kuisioner','aspek_sikap','c_aspek_sikap','c_output','c_assess','a_aspek_sikap','a_output','a_assess'];
        $other_list=['lembur','ijin_pribadi','ijin_dinas','perjanjian','kode_master'];

        $romawi=['01'=>'I','02'=>'II','03'=>'III','04'=>'IV','05'=>'V','06'=>'VI','07'=>'VII','08'=>'VIII','09'=>'IX','10'=>'X','11'=>'XI','12'=>'XII'];
        $query = "SELECT $columncode FROM $table WHERE $columnid = (SELECT MAX($columnid) FROM $table)";
        $qq = $this->CI->db->query($query)->row_array();
        $date=$this->CI->libgeneral->getDateNow();
        $year_now=date("Y",strtotime($date));
        $month_now=date("m",strtotime($date));
        if ($usefor == 'kecelakaan_kerja') {
            $y=$this->firstNum(3);
            if ($qq == NULL) {
                $no=$y.'/'.$front.'/'.$romawi[$month_now].'/'.$year_now; 
            }else{
                $tt=explode('/',$qq[$columncode]);
                $bl1=$tt[2];
                $no1=$tt[0];
                $blny=array_search($bl1, $romawi);
                if ($blny != $month_now) {
                    $no=$y.'/'.$front.'/'.$romawi[$month_now].'/'.$year_now; 
                }else{
                    $nn=$this->magicNum($no1);
                    $no=$nn.'/'.$front.'/'.$romawi[$month_now].'/'.$year_now;
                }
            }
        }elseif($usefor == 'simpleCode'){
            if ($qq == NULL) {
                $y=$this->firstNum(5);
                $no=$front.$y;
            }else{
                if(empty($qq[$columncode])){
                    $no=$front.$this->firstNum(5);
                }else{
                    $num=substr($qq[$columncode], -5);
                    $n1=str_replace($front, '', $qq[$columncode]);
                    $no=$front.$this->magicNum($num);
                }
            }
        }elseif ($usefor == 'inventaris_karyawan') {
            $y=$this->firstNum(4);
            if ($qq == NULL) {
                $no=$y.'/'.$romawi[$month_now].'/'.$year_now; 
            }else{
                $tt=explode('/',$qq[$columncode]);
                $no1=$tt[0];
                $year_old=$tt[2];
                if ($year_now != $year_old) {
                    $no=$y.'/'.$romawi[$month_now].'/'.$year_now;
                }else{
                    $nn=$this->magicNum($no1);
                    $no=$nn.'/'.$romawi[$month_now].'/'.$year_now;
                }
            }
        }elseif ($usefor == 'mutasi'){
            $y=$this->firstNum(3);
            if ($qq == NULL) {
                $no=$y.'/'.$front.'/HRD-GA/CWM/'.$romawi[$month_now].'/'.$year_now;
            }else{
                $tt=explode('/',$qq[$columncode]);
                $no1=$tt[0];
                $year_old=$tt[5];
                if ($year_now != $year_old) {
                    $no=$y.'/'.$front.'/HRD-GA/CWM/'.$romawi[$month_now].'/'.$year_now;
                }else{
                    $nn=$this->magicNum($no1);
                    $no=$nn.'/'.$front.'/HRD-GA/CWM/'.$romawi[$month_now].'/'.$year_now;
                }
            }

        }elseif (in_array($usefor, $other_list)) {
            $y=$this->firstNum(4);
            $date_format=date('Ymd',strtotime($date));
            if ($qq == NULL) {
                $no=$front.$date_format.$y;
            }else{
                $d_new=date('d',strtotime($date));
                $d_old=$this->getDay($front,$qq[$columncode]);
                if (($d_new != $d_old) || empty($d_old)) {
                    $no=$front.$date_format.$y;
                }else{
                    $num=substr($qq[$columncode], -4);
                    $n1=str_replace($front, '', $qq[$columncode]);
                    $date_old=substr($n1, 0, -4);
                    $no=$front.$date_old.$this->magicNum($num);
                }
            }
        }elseif ($usefor == 'nik') {
            $y=$this->firstNum(4);
            $date_format=date('Ym',strtotime($date));
            if ($qq == NULL) {
                $no=$date_format.$y;
            }else{
                $th=substr($qq[$columncode],0, -6);
                $th1=date('Y',strtotime($date));
                if ($th != $th1) {
                    $no=$date_format.$y;
                }else{
                    $no=$qq[$columncode]+1;
                }
            }
        }elseif (in_array($usefor, $where_penilaian)) {
            if ($qq == NULL) {
                $nox='1'.uniqid();
                $no=$front.md5($nox);
            }else{
                $nox=$qq[$columncode].uniqid();
                $no=$front.md5($nox); 
            }
        }elseif ($usefor == 'table_name') {
            $front=strtolower($front).'_';
            $y=$this->firstNum(1);
            $date_format=date('Ymd',strtotime($date));
            $name_old=$this->getPieceTableName($qq[$columncode],2);
            $d_old=$this->getDayNameTable($name_old);
            if ($qq == NULL) {
                $no=$front.$date_format.$y;
            }else{
                if ($date_format != $d_old) {
                    $no=$front.$date_format.$y;
                }else{
                    $no=$front.($name_old+1);
                }
            }
        }elseif ($usefor == 'nik_jkb') {
            $tgl_lahir=$other_var['tgl_lahir'];
            $tgl_masuk=$other_var['tgl_masuk'];
            $lahir=str_replace('/', null, $tgl_lahir);
            $lhr1 = substr($lahir,0,4);
            $lhr2 = substr($lahir,6,2);
            $masuk=str_replace('/', null, $tgl_masuk);
            $msk1 = substr($masuk,2,2);
            $msk2 = substr($masuk,6,2);
            $no=($lhr1.''.$lhr2.''.$msk1.''.$msk2);
        }elseif ($usefor == 'berlaku_sampai') {
            $status=$other_var['status'];
            $gettanggal=$other_var['tgl_berlaku'];;
            $status = $this->db->query("SELECT berlaku FROM master_surat_perjanjian WHERE kode_perjanjian = '$status'")->result();
            foreach ($status as $s) {
                if(substr($s->berlaku,2,1) == 'H') {
                    $d = substr($s->berlaku,0,1);
                }elseif(substr($s->berlaku,3,1) == 'H'){
                    $d = substr($s->berlaku,0,2);
                }else{
                    $d = null;
                }
                if(substr($s->berlaku,2,1) == 'M') {
                    $g = substr($s->berlaku,0,1);
                }elseif(substr($s->berlaku,3,1) == 'M'){
                    $g = substr($s->berlaku,0,2);
                }else{
                    $g = null;
                }
                if(substr($s->berlaku,2,1) == 'B') {
                    $e = substr($s->berlaku,0,1);
                }elseif(substr($s->berlaku,3,1) == 'B'){
                    $e = substr($s->berlaku,0,2);
                }else{
                    $e = null;
                }
                if(substr($s->berlaku,2,1) == 'T'){
                    $f = substr($s->berlaku,0,1);
                }elseif(substr($s->berlaku,3,1) == 'T'){
                    $f = substr($s->berlaku,0,2);
                }else{
                    $f = null;
                }
            $tanggal = substr($gettanggal,0,2);
            $bulan = substr($gettanggal,3,2);
            $tahun = substr($gettanggal,6,4);
            $tgl = mktime(0, 0, 0, date($bulan)+$e, date($tanggal)+$d+($g*7), date($tahun)+$f);
            $data = date("d/m/Y", $tgl);
            }
        }
        return $no;
    }
    //sub main
    public function getPieceTableName($name,$param)
    {
        if(empty($name) || empty($param)) 
            return null;
        $new_val = null;
        $ex=explode('_', $name);
        $new_val=$ex[$param];
        return $new_val;
    }
    public function getDayNameTable($val)
    {
        if(empty($val)) 
            return null;
        $date=substr($val, 0, 8);
        return $date;
    }
    public function getDay($front,$val)
    {
        if (empty($front) || empty($val)) 
            return null;
        $n1=str_replace($front, '', $val);
        $n2=substr($n1, 0, -4);
        $dt=str_split($n2);
        if (!isset($dt[6]) || !isset($dt[7])) 
            return null;
        $day=$dt[6].$dt[7];
        return $day;
    }
    public function firstNum($val)
    {
        if (empty($val)) 
            return null;
        $zero='%0'.$val.'d';
        $depan=sprintf($zero, 1);
        return $depan;
    }
    public function magicNum($num)
    {
        if (empty($num)) 
            return null;
        $front=str_replace((int)$num, '', $num);
        $front=str_split($front);
        $n_new=$num+1;
        if (strlen($n_new) > strlen((int)$num)) {
          array_pop($front);
          $zero=implode('',$front);
          $new=$zero.$n_new;
        }else{
          $new=implode('',$front).$n_new;
        }
        return $new;
    }
    //===LOGIC END===//

    //===BLOCK CHANGE===//

    //===GET MAIN LOGIC BEGIN===//
    // public function kodeHariLibur(){
    //     return $this->logicGenerator('master_hari_libur', 'kode_hari_libur', 'id_hari_libur', 'LBR','kode_master');
    // }
    // public function kodeCutiBersama(){
    //     return $this->logicGenerator('master_cuti_bersama', 'kode', 'id', 'HCB','kode_master');
    // }
    // public function kodeTarifLembur(){
    //     return $this->logicGenerator('master_tarif_lembur', 'kode_tarif_lembur', 'id_tarif_lembur', 'TRF','kode_master');
    // }
    // public function tablenameCSikap($front)
    // {
    //     return $this->logicGenerator('concept_sikap', 'nama_tabel', 'id_c_sikap', $front,'table_name');
    // }
    // public function tablenameCKpi($front)
    // {
    //     return $this->logicGenerator('concept_kpi', 'nama_tabel', 'id_c_kpi', $front,'table_name');
    // }
    // public function tablenameASikap($front)
    // {
    //     return $this->logicGenerator('log_agenda_sikap', 'nama_tabel', 'id_l_a_sikap', $front,'table_name');
    // }
    // public function tablenameAKpi($front)
    // {
    //     return $this->logicGenerator('log_agenda_kpi', 'nama_tabel', 'id_l_a_kpi', $front,'table_name');
    // }
    // public function nikJkb($t_in,$t_b)
    // {
    //     $other_var=['tgl_masuk'=>$t_in,'tgl_lahir'=>$t_b];
    //     return $this->logicGenerator('karyawan', 'nik', 'id_karyawan', null,'nik_jkb',$other_var);
    // }
    // public function tglPerjanjian($t_in,$stt)
    // {
    //     $other_var=['tgl_berlaku'=>$t_in,'status'=>$stt];
    //     return $this->logicGenerator('data_perjanjian_kerja', 'nik', 'id_p_kerja', null,'berlaku_sampai',$other_var);
    // }
    //switch code
    public function switchCode($usage)
    {
        if (empty($usage)) 
            return null;
        $var=null;
        switch($usage){
            case 'kpi' : $var = $this->kodeKpi(); break;
            case 'aspek' : $var = $this->kodeAspek(); break;
            case 'loker' : $var = $this->kodeLoker(); break;
        }
        return $var;
    }

    //===GET MAIN LOGIC END===//

    //===BLOCK CHANGE===//

    //===SECURITY BEGIN===//
    public function encryptChar($plain)
    {
        if (empty($plain))
            return null;
        $new_val=base64_encode(serialize($plain));
        return $new_val;
    }
    public function decryptChar($plain)
    {
        if (empty($plain))
            return null;
        if (!@unserialize(base64_decode($plain))) {
			return null;
		}
        $new_val=unserialize(base64_decode($plain));
        return $new_val;
    }
	public function jwtParser($token)
	{
		return json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))));
	}
    public function genPassword($plain)
    {
        if (empty($plain))
            return null;
        $new_val=hash('sha512', $plain);
        return $new_val;
    }
    public function genToken($length)
    {
        if (empty($length) || !is_numeric($length)) 
            return null;
        $new_val=bin2hex(random_bytes($length).uniqid());
        return $new_val;
    }
    public function matchAdminAuth($uname,$pass)
    {
        if (empty($uname) || empty($pass))
            redirect('auth/login');
        $pass=hash('sha512', $pass);
        $cek=$this->CI->model_admin->adm_cek($uname,$pass);
        if (isset($cek)) {
            $data=$cek;
        }else{
            $data=null;
        }
        return $data;
    }
    public function getPin($length,$use)
    {
        if (empty($length) || empty($use))
            return null;
        if ($use == 'full') {
            $string = '0123456789abcdefghijklmnopqrstuvwxyz';
            $string = $string.strtoupper($string);
        }elseif ($use == 'number') {
            $string = '0123456789';
        }elseif ($use == 'letter') {
            $string = 'abcdefghijklmnopqrstuvwxyz';
            $string = $string.strtoupper($string);
        }else{
            return null;
        }
        $panjang = strlen($string);
        $new_val = '';
        for ($i = 0; $i < $length; $i++) {
            $new_val .= $string[rand(0, $panjang - 1)];
        }
        return $new_val;
    }
    public function kodeMasterKomponen()
    {
        return $this->logicGenerator('master_komponen', 'kode', 'id', 'KMP','simpleCode');
    }
    //===SECURITY END===//


}
