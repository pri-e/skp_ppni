<?php defined('BASEPATH') OR exit('No direct script access allowed');
class My404 extends CI_Controller {
	function __construct(){
		parent::__construct();
		if($this->session->userdata('is_login')==FALSE){
			$this->session->set_flashdata('msg','<p class="alert alert-danger"><strong>Akses Ditolak!!</strong> Anda harus login terlebih dahulu</p>');
			redirect('login','refresh');
		}		
	}
	function index(){
		$data = array(
			'title1'=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2' => 'error_404',
			'subjek' => 'Halaman Tidak Ditemukan'
			);

		$this->general->assign_var($data);
		$this->smarty->_render_template('custom404/error_404');
	}
	function insufficient_privileges(){
		$data = array(
			'title1'=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2' => 'insufficient privileges',
			'subjek' => 'Halaman Tidak Ditemukan'
			);

		$this->general->assign_var($data);
		$this->smarty->_render_template('custom404/insufficient_privileges');
	}
}