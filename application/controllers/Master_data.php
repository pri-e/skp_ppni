<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Master_data extends CI_Controller {
	
	function __construct(){
		parent::__construct();
		if($this->session->userdata('is_login')==FALSE){
			$this->session->set_flashdata('msg','<p class="alert alert-danger"><strong>Akses Ditolak!!</strong> Anda harus login terlebih dahulu</p>');
			redirect('login','refresh');
		}
		if($this->session->userdata('is_admin')!=1){
			$this->session->set_flashdata('msg','<p class="alert alert-danger"><strong>Anda Tidak memiliki Hak akses ke Halaman yang anda Cari!!</strong> </p>');
			redirect('My404/insufficient_privileges','refresh');
		}
		$this->load->helper('url');
		$this->config->load('grocery_crud');
		$this->grocery_crud->unset_read();
	}
	function index(){
		$this->config->set_item('grocery_crud_dialog_forms',FALSE);
		$this->grocery_crud->set_table('m_pengguna_instansi')
						   ->set_subject('Data Instansi Pengguna Aplikasi')
						   ->columns('instansi','alamat','img')
						   ->display_as('instansi',  "<span style='width: 100%; text-align: center; display: block;'>Nama Instansi</span>")
						   ->display_as('alamat', "<span style='width: 100%; text-align: center; display: block;'>Alamat Instansi </span>")
						   ->display_as('img', "<span style='width: 100%; text-align: center; display: block;'>Logo Instansi </span>")
						   ->fields('instansi','alamat','keterangan','img')
						   ->unset_texteditor('alamat','keterangan')
						   ->set_field_upload('img','assets/img/instansi')
						   ->required_fields('instansi','alamat');

		$data = array(
			'title1'=> 'SIM Satuan Kredit Profesi (SKP)',
			'halaman'=>'template_crud',
			'subjek'=>'Data Instansi Pengguna',
			'crud'=>$this->grocery_crud->render()
		);
		$this->general->assign_var($data);
		$this->smarty->_render_crudtemplate('crud/crud');
	}
	function akses_menu(){
		$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->grocery_crud->set_table('m_menu')
						   ->set_subject('Data Menu Aplikasi')
						   ->set_relation('parent_id','m_menu','nama_modul')
						   //->order_by('urutan1','asc')
						   ->order_by('urutan','asc')
						   ->columns('namamodul','link_modul','aktif','urutan','urutan1','icon')
						   ->callback_column('namamodul', array($this,'_kolom_nama_menu'))
						   ->display_as('parent_id','Sub Dari')
						   ->display_as('namamodul','Menu')
						   ->fields('parent_id','nama_modul','link_modul','aktif','urutan','urutan1','icon')
						   ->unset_export()->unset_print()
						   ->required_fields('nama_modul','link_modul','aktif','urutan');

		$data = array(
			'title1'=> 'SIM Satuan Kredit Profesi (SKP)',
			'halaman'=>'template_crud',
			'subjek'=>'Data Menu Aplikasi',
			'crud'=>$this->grocery_crud->render()
		);
		$this->general->assign_var($data);
		$this->smarty->_render_crudtemplate('crud/crud');
	}
	function _kolom_nama_menu($v, $r){
		if($r->parent_id==""){
			return $r->nama_modul;
		}elseif($r->parent_id != ""){
			$parent = $this->db->get_where('m_menu', array('id_menu'=>$r->parent_id))->row();
			return $parent->nama_modul." &rsaquo; ".$r->nama_modul;
		}
	}
	function uers_level(){
		$this->config->set_item('grocery_crud_dialog_forms',TRUE);
		$this->grocery_crud->set_table('m_pengguna_level')
						   ->set_subject('Data Level Pengguna Aplikasi')
						   ->columns('level','keterangan')
						   ->display_as('level',  "<span style='width: 100%; text-align: center; display: block;'>Level Pengguna</span>")
						   ->display_as('keterangan', "<span style='width: 100%; text-align: center; display: block;'>Keterangan</span>")
						   ->fields('level','keterangan')
						   ->unset_texteditor('alamat','keterangan')
						   ->required_fields('level','keterangan');

		$data = array(
			'title1'=> 'SIM Satuan Kredit Profesi (SKP)',
			'halaman'=>'template_crud',
			'subjek'=>'Data Level Pengguna Aplikasi',
			'crud'=>$this->grocery_crud->render()
		);
		$this->general->assign_var($data);
		$this->smarty->_render_crudtemplate('crud/crud');
	}
	function jenis_peserta(){
		$this->config->set_item('grocery_crud_dialog_forms',TRUE);
		$this->grocery_crud->set_table('m_jenis_peserta')
						   ->set_subject('Jenis Peserta')
						   ->columns('nama','nilai','nilai_text','keterangan')
						   ->display_as('nama',  "<span style=' text-align: left; display: block;'>Jenis Peserta</span>")
						   ->display_as('nilai', "<span style=' text-align: left; display: block;'>Nilai</span>")
						   ->display_as('nilai_text', "<span style=' text-align: left; display: block;'>Nilai Text</span>")
						   ->fields('nama','nilai','nilai_text','keterangan')
						   ->unset_texteditor('alamat','keterangan')
						   ->required_fields('nama','nilai','nilai_text','keterangan');

		$data = array(
			'title1'=> 'SIM Satuan Kredit Profesi (SKP)',
			'halaman'=>'template_crud',
			'subjek'=>'Data Level Pengguna Aplikasi',
			'crud'=>$this->grocery_crud->render()
		);
		$this->general->assign_var($data);
		$this->smarty->_render_crudtemplate('crud/crud');

	}
	function pengguna_aplikasi(){
		$this->config->set_item('grocery_crud_dialog_forms',false);
		$this->grocery_crud->set_table('m_pengguna')
						   ->set_subject('Data Pengguna Aplikasi')
						   ->where('id_user >', 1)
						   ->set_relation_n_n('akses', 'm_menu_pengguna', 'm_menu', 'id_user', 'id_menu', 'nama_modul','priority')
						   ->set_relation('id_instansi','m_pengguna_instansi','Instansi')
						   ->set_relation('id_level','m_pengguna_level','level')						  
						   ->columns('namapengguna','id_level','id_instansi','nama','email')
						   ->display_as('id_instansi','Instansi asal')
						   ->display_as('namapengguna','User Name')
						   //->set_rules('namapengguna', 'namapengguna','trim|required|xss_clean|callback_username_check')
						   //->set_rules('namapengguna', 'namapengguna','trim|required|xss_clean|callback_checkUniq')
						   ->callback_edit_field('sandi',array($this,'edit_field_password'))
						   ->callback_before_update(array($this,'encrypt_password_callback'))
						   ->callback_before_insert(array($this,'encrypt_password_callback'))
						   ->fields('namapengguna','sandi','id_level','id_instansi','nama','email','akses')
						   ->unique_fields(array('namapengguna','email'))
						   ->unset_export()->unset_print()						   
						   ->required_fields('namapengguna','id_level','id_instansi','nama','email');

		$data = array(
			'title1'=> 'SIM Satuan Kredit Profesi (SKP)',
			'halaman'=>'template_crud',
			'subjek'=>'Data Pengguna Aplikasi',
			'crud'=>$this->grocery_crud->render()
		);		
		$this->general->assign_var($data);
		$this->smarty->_render_crudtemplate('crud/crud');
	}
	function edit_field_password($value, $primary_key){
		return '<input type="text" maxlength="50" value="" name="sandi" style="width:120px"> <small>(* Biarkan Kosong jika tidak berubah</small> ';
	}
	function encrypt_password_callback($post_array, $primary_key=null){
	    if(!empty($post_array['sandi'])){
	        $post_array['sandi'] = do_hash($post_array['sandi']);
	    }else{
	        unset($post_array['sandi']);
	    }
	 
	  return $post_array;
	}
	public function username_check($str){
	  $id = $this->uri->segment(4);
	  if(!empty($id) && is_numeric($id))
	  {
	   $username_old = $this->db->where("id",$id)->get('m_pengguna')->row()->namapengguna;
	   $this->db->where("namapengguna !=",$username_old);
	  }
	  
	  $num_row = $this->db->where('namapengguna',$str)->get('m_pengguna')->num_rows();
	  if ($num_row >= 1)
	  {
	   $this->form_validation->set_message('username_check', 'User sudah Ada');
	   return FALSE;
	  }
	  else
	  {
	   return TRUE;
	  }
	}
	public function checkUniq($str){
	    //is_unique['.TBL_BATCH.'.batchName]
	    $id = $this->uri->segment(4);
	    $old_name = "";
	    $result = null;
	 
	    if(!empty($id) && is_numeric($id))
	    {
		    $this->db->where("namapengguna", $id);		 
		    $result = $this->db->get(m_pengguna);
		    if($result->num_rows() > 0)
		    {
			    foreach($result->result() as $row)
			    {
				    $old_name = $row->batchName;
			    }
			 
			    $this->db->where("namapengguna !=", $old_name);
			    $this->db->where("namapengguna", $str);
			    $num_rows = $this->db->get(m_pengguna)->num_rows();
			    if($num_rows > 0)
			    {
				    $this->form_validation->set_message('checkUniq',"The %s already Exist. Please try a different  name.");
				    return false;
			    }
		    }
	    }
	    else
	    {
		    $this->db->where("namapengguna", $str);
		    $num_rows = $this->db->get(m_pengguna)->num_rows();
		    if($num_rows > 0)
		    {
			    $this->form_validation->set_message('checkUniq',"The %s already Exist. Please try a different  name.");
			    return false;
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