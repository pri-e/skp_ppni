<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Ferifikasi_admin extends CI_Controller {	
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
		$this->load->helper('tgl_indo');		
		$this->load->model('Skp_model');
		$this->load->library('myencryption');
	}
	function index(){
		redirect('ferifikasi_admin/ferif_jkegiatan','refresh');			
	}
	function ferif_jkegiatan(){
		$id_instansi = $this->session->userdata('id_instansi');

		$cek_admin = $this->session->userdata('is_admin');
		if ($cek_admin ==TRUE) {
			$jenis_kegiatan = $this->Skp_model->jenis_kegall();
		}else{

			$jenis_kegiatan = $this->Skp_model->jenis_keg_instansi($id_instansi);
		}
		$data = array(
			'title1'			=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'			=> 'Verifikasi Kuota Kegiatan/Pelatihan',
			'kegiatan'			=> $jenis_kegiatan
		);
		//echo "<pre>";
		//print_r($data['kegiatan']);
		//echo "</pre>";		
		$this->general->assign_var($data);
		$this->smarty->_render_template('skp/ferif_jkegiatan/jenis_kegiatan');
	}
	function proses_ferif($id_jenis_kegiatan){
		$iddecode = $this->myencryption->decode($id_jenis_kegiatan);
		$data_jkegiatan = $this->Skp_model->getedit_jkegiatan($iddecode);		
		
		$data = array(
			'title1'			=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'			=> 'Verifikasi Data Kegiatan/Pelatihan',
			'data_jkegiatan' 	=> $data_jkegiatan
		);
		//echo "<pre>";
		//print_r($data['data_jkegiatan']);
		//echo "</pre>";		
		$this->general->assign_var($data);
		$this->smarty->_render_template('skp/ferif_jkegiatan/edit_jkegiatan');		
	}
	function save_ferifikasi(){
		$id_jenis_kegiatan 	= $this->input->post('id_jenis_kegiatan');
		$nama_kegiatan 		= $this->input->post('nama_kegiatan');		
		$quota_peserta 		= $this->input->post('quota_peserta');				
		$tgl1 				= $this->input->post('tgl_kegiatan');
		$date_object 		= new DateTime($tgl1);
		$tanggal_keg		= $date_object->format('Y-m-d');
		$no_skp 			= $this->input->post('no_skp');
		$tempat_keg			= $this->input->post('tempat_keg');
		$id_instansi		= $this->input->post('id_instansi');
		$status 			= $this->input->post('status');
		$reg_online 		= $this->input->post('reg_online');
		$ketua_keg 			= $this->input->post('ketua_keg');
		$nira_ketua_keg		= $this->input->post('nira_ketua_keg');
		$legist_nama		= $this->input->post('nama_legist');
		$legist_jabatan		= $this->input->post('legist_jabatan');
		$legist_daerah		= $this->input->post('legist_daerah');
		$legist_nira		= $this->input->post('legist_nira');
		$keterangan 		= $this->input->post('keterangan');
		$verif_admin 		= $this->input->post('ferif_admin');
		$input_by 			= $this->input->post('input_by');
		$input_date 		= $this->input->post('input_date');
		if ($id_jenis_kegiatan > 0){
			$where = array(
				'id_jenis_kegiatan'		=>$id_jenis_kegiatan
			);
			$data = array(
				'nama_kegiatan'			=>$nama_kegiatan,
				'quota_peserta'			=>$quota_peserta,
				'tanggal'				=>$tanggal_keg,
				'no_skp'				=>$no_skp,						
				'tempat'				=>$tempat_keg,
				'id_instansi'			=>$id_instansi,
				'status'				=>$status,
				'reg_online'			=>$reg_online,
				'ketua'					=>$ketua_keg,
				'nira_ketua'			=>$nira_ketua_keg,
				'legist_nama' 			=>$legist_nama,
				'legist_jabatan' 		=>$legist_jabatan,
				'legist_daerah'			=>$legist_daerah,
				'legist_nira'			=>$legist_nira,						
				'keterangan'			=>$keterangan,
				'verif_admin' 			=>$verif_admin,
				'verif_by'				=>$input_by,
				'verif_date'			=>$input_date
			);
			$rs = $this->Skp_model->save_jkegiatan('edit', $data, $where);				
		}else{
			$data = array(									
				'nama_kegiatan'			=>$nama_kegiatan,
				'quota_peserta'			=>$quota_peserta,
				'tanggal'				=>$tanggal_keg,
				'no_skp'				=>$no_skp,						
				'tempat'				=>$tempat_keg,
				'id_instansi'			=>$id_instansi,
				'status'				=>$status,
				'reg_online'			=>$reg_online,
				'ketua'					=>$ketua_keg,
				'nira_ketua'			=>$nira_ketua_keg,
				'legist_nama' 			=>$legist_nama,
				'legist_jabatan' 		=>$legist_jabatan,
				'legist_daerah'			=>$legist_daerah,
				'legist_nira'			=>$legist_nira,						
				'keterangan'			=>$keterangan,
				'verif_admin' 			=>$verif_admin,
				'verif_by'				=>$input_by,
				'verif_date'			=>$input_date

			);
			$rs = $this->Skp_model->save_jkegiatan('add', $data);				
		}
		if($rs){
			$msg = "<p class='alert alert-success'>Data berhasil disimpan</p>";
		}else{
			$msg = "<p class='alert alert-danger'>Data tidak berhasil disimpan</p>";
		}
		$id_instansi = $this->session->userdata('id_instansi');

		$cek_admin = $this->session->userdata('is_admin');
		if ($cek_admin ==TRUE) {
			$jenis_kegiatan = $this->Skp_model->jenis_kegall();
		}else{

			$jenis_kegiatan = $this->Skp_model->jenis_keg_instansi($id_instansi);
		}
		$data = array(
			'title1'			=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'			=> 'Tambah Data Kegiatan/Pelatihan',
			'msg'				=> $msg,
			'kegiatan'			=> $jenis_kegiatan
		);
		//echo "<pre>";
		//print_r($data['kegiatan']);
		//echo "</pre>";		
		$this->general->assign_var($data);
		$this->smarty->_render_template('skp/ferif_jkegiatan/save_jkegiatan');		

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

/* End of file Ferifikasi_admin.php */
/* Location: ./application/controllers/home.php */