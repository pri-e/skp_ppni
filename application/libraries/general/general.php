<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General {

	private $ci;

	function __construct(){
		$this->ci =& get_instance();
		$this->asset();
	}

	function asset(){
		$asset = array(
				'js'=>base_url()."assets/production/js/",
				'css'=>base_url()."assets/production/css/",
				'instansi'=>$this->ci->config->item('INSTANSI'),
				'title'=>$this->ci->config->item('APP_NAME'),
				'versi'=>$this->ci->config->item('APP_VERSION'),
				'base_url'=>$this->ci->config->item('base_url')
			);
		$this->assign_var($asset);
	}


	function assign_var($var){
		if(is_array($var)){
			foreach($var as $name=>$value){
				$this->ci->smarty->assign($name, $value);
			}
		}		
	}

	function konversi($tgl){
	 	$tanggal = date('D, d M Y', strtotime($tgl));
	    $format = array(
	        'Sun' => 'Minggu',
	        'Mon' => 'Senin',
	        'Tue' => 'Selasa',
	        'Wed' => 'Rabu',
	        'Thu' => 'Kamis',
	        'Fri' => 'Jumat',
	        'Sat' => 'Sabtu',
	        'Jan' => 'Januari',
	        'Feb' => 'Februari',
	        'Mar' => 'Maret',
	        'Apr' => 'April',
	        'May' => 'Mei',
	        'Jun' => 'Juni',
	        'Jul' => 'Juli',
	        'Aug' => 'Agustus',
	        'Sep' => 'September',
	        'Oct' => 'Oktober',
	        'Nov' => 'November',
	        'Dec' => 'Desember'
	    );
	 
	    return strtr($tanggal, $format);
	}

}