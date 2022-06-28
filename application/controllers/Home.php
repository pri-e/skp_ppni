<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Home extends CI_Controller {	
	function __construct(){
		parent::__construct();
		
		if($this->session->userdata('is_login')==FALSE){
			$this->session->set_flashdata('msg','<p class="alert alert-danger"><strong>Akses Ditolak!!</strong> Anda harus login terlebih dahulu</p>');
			redirect('login','refresh');
		}
		$this->load->library('grocery_CRUD');
		$this->grocery_crud->unset_read();		
		$this->load->helper('tgl_indo');
		$this->load->model('Home_model');
	}
	function index(){

		$id_instansi = $this->session->userdata('id_instansi');
		$cek_admin = $this->session->userdata('is_admin');
		if ($cek_admin ==TRUE) {
			$datapeserta = $this->Home_model->keg_all();
		}else{

			$datapeserta = $this->Home_model->jumah_keg_instansi($id_instansi);
		}

		//$menu = $this->skpppni->Menu_Administrator();

		$admin = do_hash('admin');

		$menu = $this->db->order_by('urutan','asc')->get_where('m_menu', array('parent_id'=>null,'aktif'=>'Ya'));
		$data = array(
			'title1'		=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'		=> 'Dashboard',
			'datapeserta'	=> $datapeserta,
			'instansi'		=> $this->session->userdata('instansi'),
			'admin'			=> $admin

		);
		//echo "<pre>";
        //print_r($data['admin']);
        //echo "</pre>"; 
				
		$this->general->assign_var($data);
		$this->smarty->_render_template('layouts/home');
				
	}
	/*
	function add_pengguna(){
		$user = "Prie";
		$pawd = "Pr1ef20.3";

		$pswd = do_hash($pawd);

		$data = array(
			'id_level'		=> 1,
			'namapengguna' 	=> $user,
			'sandi' 		=> $pswd,
			'email'			=> 'priyanto,nugroho@gmail.com'
		);
		//$this->db->insert('m_pengguna', $data);
		echo "<pre>";
		print_r($pswd);
		echo "</pre>";
	}
	*/
	function Cek(){
		
		
		
		echo "<pre>";
        print_r($this->session->all_userdata());
        echo "</pre>";        		
    }
    
	/* Global Variable */
	function assign_var($var){
		if(is_array($var)){
			foreach($var as $name=>$value){
				$this->smarty->assign($name, $value);
			}
		}		
	}	
	function logout(){
		$this->session->sess_destroy();
		redirect("login","refresh");
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */