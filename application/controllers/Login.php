<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		if($this->session->userdata('is_login')){
			redirect('home','refresh');
		}
	}
	
	public function index(){
		
		$var = array(
				'form_open'=>form_open('login/proses_login'),
				'form_close'=>form_close(),
				'msg'=>$this->session->flashdata('msg'),
				'title'=>$this->config->item('APP_NAME'),
				'instansi'=>$this->config->item('INSTANSI'),
				'versi'=>$this->config->item('APP_VERSION')
			);
		$this->assign_var($var);		
		$this->smarty->view('login');
	}
	
	function proses_login(){

		$this->form_validation->set_rules('username','Username','trim|required|xss_clean|htmlspecialchars');
		$this->form_validation->set_rules('password','Password','trim|required|xss_clean|htmlspecialchars');

		if($this->form_validation->run() == FALSE){
			$this->session->set_flashdata('msg','<div><p class="alert alert-danger">Harap melengkapi Informasi Login Anda!!</p></div>');
			redirect('login','refresh');
		}else{
			$login = $this->db->get_where('m_pengguna', array(
					'namapengguna'=>$this->input->post('username'),
					'sandi'=>do_hash($this->input->post('password'))
				));
			if($login->num_rows() == 1){
				if($login->row()->id_level == 1){
					$rs = $this->db
						->join('m_pengguna_level','m_pengguna_level.id_level=m_pengguna.id_level')
						->join('m_pengguna_instansi','m_pengguna_instansi.id_instansi=m_pengguna.id_instansi')
						->get_where('m_pengguna', array('id_user'=>$login->row()->id_user));
					$sessi = array(
							'is_login'		=>TRUE,
							'nama'			=>$login->row()->nama,
							'is_admin'		=>TRUE,
							'username'		=>$login->row()->namapengguna,
							'id_user'		=>$login->row()->id_user,
							'level'			=>$rs->row()->level,
							'instansi'		=>$rs->row()->instansi,
							'id_instansi'	=>$rs->row()->id_instansi,
						);
				}elseif ($login->row()->id_level == 2) {
					$rs = $this->db
						->join('m_pengguna_level','m_pengguna_level.id_level=m_pengguna.id_level')
						->join('m_pengguna_instansi','m_pengguna_instansi.id_instansi=m_pengguna.id_instansi')
						->get_where('m_pengguna', array('id_user'=>$login->row()->id_user));
					if($rs->num_rows() == 1){
						$sessi = array(
								'is_login'		=>TRUE,
								'nama'			=>$login->row()->nama,
								'is_admin'		=>FALSE,
								'username'		=>$login->row()->namapengguna,
								'id_user'		=>$login->row()->id_user,
								'level'			=>$rs->row()->level,
								'instansi'		=>$rs->row()->instansi,
								'id_instansi'	=>$rs->row()->id_instansi,
							);
					}
				}else{
					$rs = $this->db
						->join('m_pengguna_level','m_pengguna_level.id_level=m_pengguna.id_level')
						->join('m_pengguna_instansi','m_pengguna_instansi.id_instansi=m_pengguna.id_instansi')
						->get_where('m_pengguna', array('id_user'=>$login->row()->id_user));
					if($rs->num_rows() == 1){
						$sessi = array(
								'is_login'	=>TRUE,
								'nama'		=>$login->row()->nama,
								'is_admin'	=>FALSE,
								'username'	=>$login->row()->namapengguna,
								'id_user'		=>$login->row()->id_user,
								'level'			=>$rs->row()->level,
								'instansi'		=>$rs->row()->instansi,
								'id_instansi'	=>$rs->row()->id_instansi,
							);
					}
				}
				$this->session->set_userdata($sessi);
				redirect('home','refresh');
			}else{
				$this->session->set_flashdata('msg','<p class="alert alert-danger"><strong>Login Gagal !!! </strong>Username Atau Password Tidak dikenali</p>');
				redirect('login','refresh');
			}
		}
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