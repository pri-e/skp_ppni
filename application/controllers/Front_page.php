<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Front_page extends CI_Controller {	
	function __construct(){
		parent::__construct();		
		$this->load->helper('tgl_indo');		
		$this->load->model('Skp_model');
		$this->load->library('myencryption');
	}
	function index(){				
	}
	
	function info_skp($id_peserta){
		$iddecode = $this->myencryption->decode($id_peserta);
		$cekdata = $this->db->get_where('t_peserta', array('id_peserta'=>$iddecode));
		if ($cekdata->num_rows() >0) {
			$datapeserta = $this->Skp_model->peserta_byid($iddecode);
		}else{
			$datapeserta =NULL;
		}
		

		$data = array(
			'title1'		=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'		=> 'Verivikasi Data Peserta Pelatihan',
			'datapeserta'	=> $datapeserta
		);

		//echo "<pre>";
		//print_r($datapeserta);
		//print_r($data['datapeserta']);
		//echo "</pre>";		

		$this->load->view('templates/front_page/info',$data);
	}
	/* Global Variable */
	function assign_var($var){
		if(is_array($var)){
			foreach($var as $name=>$value){
				$this->smarty->assign($name, $value);
			}
		}		
	}	
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */