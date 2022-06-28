<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Skp extends CI_Controller {	
	function __construct(){
		parent::__construct();	
		if($this->session->userdata('is_login')==FALSE){
			$this->session->set_flashdata('msg','<p class="alert alert-danger"><strong>Akses Ditolak!!</strong> Anda harus login terlebih dahulu</p>');
			redirect('login','refresh');
		}
		
		$this->load->helper('tgl_indo');		
		$this->load->model('Skp_model');
		$this->load->library('myencryption');
	}
	function index(){
		$id_instansi = $this->session->userdata('id_instansi');
		$cek_admin = $this->session->userdata('is_admin');
		if ($cek_admin ==TRUE) {
			$datapeserta = $this->Skp_model->peserta_all();
		}else{

			$datapeserta = $this->Skp_model->peserta_perinstansi($id_instansi);
		}

		$data = array(
			'title1'		=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'		=> 'Data Pelatihan',
			'datapeserta'	=> $datapeserta
		);
		//echo "<pre>";
		//print_r($data['datapeserta']);		
		//echo "</pre>";		
		$this->general->assign_var($data);
		$this->smarty->_render_template('skp/peserta/list_peserta');				
	}
	function add_peserta(){
		$id_instansi = $this->session->userdata('id_instansi');
		$cek_admin = $this->session->userdata('is_admin');
		if ($cek_admin ==TRUE) {
			$jenis_kegiatan = $this->Skp_model->get_jkeg_aktif_all();
		}else{

			$jenis_kegiatan = $this->Skp_model->get_jkeg_aktif_instansi($id_instansi);
		}
		$data = array(
			'title1'			=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'			=> 'Tambah Data Peserta Kegiatan/Pelatihan',
			'jenis_peserta'		=> $this->Skp_model->get_jenis_peserta(),
			'jenis_kegiatan'	=> $jenis_kegiatan,
			'provinsi'			=> $this->Skp_model->get_propinsi()
		);
		//echo "<pre>";
		//print_r($data['jenis_kegiatan']);
		//echo "</pre>";		
		$this->general->assign_var($data);
		$this->smarty->_render_template('skp/peserta/add_peserta');
	}
	public function add_ajax_kab($id_prov){		
	    $query = $this->db->get_where('wilayah_kabupaten',array('provinsi_id'=>$id_prov));
	    $data = "<option value=''>- Pilih Kabupaten -</option>";
	    foreach ($query->result() as $value) {
	        $data .= "<option value='".$value->id."'>".$value->nama."</option>";
	    }
	    echo $data;
	}
	public function add_ajax_kec($id_kab){
	    $query = $this->db->get_where('wilayah_kecamatan',array('kabupaten_id'=>$id_kab));
	    $data = "<option value=''> - Pilih Kecamatan - </option>";
	    foreach ($query->result() as $value) {
	        $data .= "<option value='".$value->id."'>".$value->nama."</option>";
	    }
	    echo $data;
	}	
	public function add_ajax_des($id_kec){
	    $query = $this->db->get_where('wilayah_desa',array('kecamatan_id'=>$id_kec));
	    $data = "<option value=''> - Pilih Desa - </option>";
	    foreach ($query->result() as $value) {
	        $data .= "<option value='".$value->id."'>".$value->nama."</option>";
	    }
	    echo $data;
	}
	function simpan_peserta(){
		$this->form_validation->set_rules('id_jenis_kegiatan','id_jenis_kegiatan','trim|required');
		if($this->form_validation->run()!=FALSE){
			$id_peserta			= $this->input->post('id_peserta');
			$nama_peserta 		= $this->input->post('nama_peserta');
			$instansi_asal 		= $this->input->post('instansi_asal');
			$sebagai 			= $this->input->post('sebagai');
			$no_hp 				= $this->input->post('no_hp');
			$alamat 			= $this->input->post('alamat');
			$email 				= $this->input->post('email');
			$id_jenis_kegiatan 	= $this->input->post('id_jenis_kegiatan');
			$id_provinsi 		= $this->input->post('provinsi');
			$id_kabupaten 		= $this->input->post('kab');
			$id_kecamatan 		= $this->input->post('kecamatan');
			$id_desa 			= $this->input->post('desa');
			$input_by	 		= $this->input->post('input_by');
			$input_date	 		= $this->input->post('input_date');
			$id_instansi		= $this->input->post('id_instansi');

			$cekkuota = $this->db->get_where('t_jenis_kegiatan', array('id_jenis_kegiatan' => $id_jenis_kegiatan))->row()->quota_peserta;
			$cekjmlterdaftar = $this->db->get_where('t_peserta', array('id_jenis_kegiatan' => $id_jenis_kegiatan))->num_rows();
			if ($cekjmlterdaftar < $cekkuota) {			
				if ($id_peserta > 0){
					$where = array(
						'id_peserta'		=> $id_peserta
					);
					$data = array(
						'nama_peserta'		=> $nama_peserta,
						'instansi_asal'		=> $instansi_asal,
						'sebagai'			=> $sebagai,						
						'no_hp'				=> $no_hp,
						'alamat'			=> $alamat,
						'email'				=> $email,
						'id_jenis_kegiatan'	=> $id_jenis_kegiatan,
						'id_provinsi'		=> $id_provinsi,
						'id_kabupaten'		=> $id_kabupaten,						
						'id_kecamatan'		=> $id_kecamatan,
						'id_desa'			=> $id_desa,
						'edit_by'			=> $input_by,
						'edit_date'			=> $input_date,
						'id_instansi'		=> $id_instansi
					);
					$rs = $this->Skp_model->save_peserta('edit', $data, $where);				
				}else{
					$data = array(									
						'nama_peserta'		=> $nama_peserta,
						'instansi_asal'		=> $instansi_asal,
						'sebagai'			=> $sebagai,						
						'no_hp'				=> $no_hp,
						'alamat'			=> $alamat,
						'email'				=> $email,
						'id_jenis_kegiatan'	=> $id_jenis_kegiatan,
						'id_provinsi'		=> $id_provinsi,
						'id_kabupaten'		=> $id_kabupaten,						
						'id_kecamatan'		=> $id_kecamatan,
						'id_desa'			=> $id_desa,
						'input_by'			=> $input_by,
						'input_date'		=> $input_date,
						'id_instansi'		=> $id_instansi
					);
					$rs = $this->Skp_model->save_peserta('add', $data);				
				}
				if($rs){
					$msg = "<p class='alert alert-success'>Data berhasil disimpan"."<br>"."Tersisa ".($cekkuota-($cekjmlterdaftar+1))." Peserta. Dari Total  ".$cekkuota."  Quota peserta</p>";
				}else{
					$msg = "<p class='alert alert-danger'>Data tidak berhasil disimpan</p>";
				}
			}else{
				$msg = "<p class='alert alert-danger'>Data tidak berhasil disimpan Quota Peserta sudah Terpenuhi"."<br>"."Tersisa ".($cekkuota-$cekjmlterdaftar)." Peserta. Dari Total  ".$cekkuota."  Quota peserta</p>";
			}
		}else{
			$id_instansi = $this->session->userdata('id_instansi');
			$msg = "<p class='alert alert-danger'>Data tidak berhasil disimpan Data Kegiatan harus di isi</p>";
		}

		$cek_admin = $this->session->userdata('is_admin');
		if ($cek_admin ==TRUE) {
			$datapeserta = $this->Skp_model->peserta_all();
		}else{

			$datapeserta = $this->Skp_model->peserta_perinstansi($id_instansi);
		}

		$data = array(
			'title1'			=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'			=> 'Data Pelatihan',
			'datapeserta'		=> $datapeserta,
			'msg'				=> $msg,
			'cekkuota'			=> $cekkuota,
			'cekjmlterdaftar' =>$cekjmlterdaftar
		);
		//echo "<pre>";
		//print_r($data['cekjmlterdaftar']);		
		//echo "</pre>";		
		$this->general->assign_var($data);
		$this->smarty->_render_template('skp/peserta/save_peserta');		
	}
	function edit_peserta($id_peserta){
		$iddecode = $this->myencryption->decode($id_peserta);
		$data_peserta = $this->Skp_model->get_peserta_by_id($iddecode);

		$id_instansi = $this->session->userdata('id_instansi');
		$cek_admin = $this->session->userdata('is_admin');
		if ($cek_admin ==TRUE) {
			$jenis_kegiatan = $this->Skp_model->get_jkeg_aktif_all();
		}else{

			$jenis_kegiatan = $this->Skp_model->get_jkeg_aktif_instansi($id_instansi);
		}
		$data = array(
			'title1'			=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'			=> 'Edit Data Peserta Kegiatan/Pelatihan',
			'jenis_peserta'		=> $this->Skp_model->get_jenis_peserta(),
			'jenis_kegiatan'	=> $jenis_kegiatan,
			'provinsi'			=> $this->Skp_model->get_propinsi(),
			'data_peserta'		=> $data_peserta

		);
		//echo "<pre>";
		//print_r($data['data_peserta']);
		//echo "</pre>";		
		$this->general->assign_var($data);
		$this->smarty->_render_template('skp/peserta/edit_peserta');
	}
	function simpan_edit_peserta(){
		$this->form_validation->set_rules('id_jenis_kegiatan','id_jenis_kegiatan','trim|required');
		if($this->form_validation->run()!=FALSE){
			$id_peserta			= $this->input->post('id_peserta');
			$nama_peserta 		= $this->input->post('nama_peserta');
			$instansi_asal 		= $this->input->post('instansi_asal');
			$sebagai 			= $this->input->post('sebagai');
			$no_hp 				= $this->input->post('no_hp');
			$alamat 			= $this->input->post('alamat');
			$email 				= $this->input->post('email');
			$id_jenis_kegiatan 	= $this->input->post('id_jenis_kegiatan');
			$id_provinsi 		= $this->input->post('provinsi');
			$id_kabupaten 		= $this->input->post('kab');
			$id_kecamatan 		= $this->input->post('kecamatan');
			$id_desa 			= $this->input->post('desa');
			$input_by	 		= $this->input->post('input_by');
			$input_date	 		= $this->input->post('input_date');
			$id_instansi		= $this->input->post('id_instansi');

			$cekkuota = $this->db->get_where('t_jenis_kegiatan', array('id_jenis_kegiatan' => $id_jenis_kegiatan))->row()->quota_peserta;
			$cekjmlterdaftar = $this->db->get_where('t_peserta', array('id_jenis_kegiatan' => $id_jenis_kegiatan))->num_rows();
			if ($cekjmlterdaftar < $cekkuota) {			
				if ($id_peserta > 0){
					$where = array(
						'id_peserta'		=> $id_peserta
					);
					$data = array(
						'nama_peserta'		=> $nama_peserta,
						'instansi_asal'		=> $instansi_asal,
						'sebagai'			=> $sebagai,						
						'no_hp'				=> $no_hp,
						'alamat'			=> $alamat,
						'email'				=> $email,
						'id_jenis_kegiatan'	=> $id_jenis_kegiatan,
						'id_provinsi'		=> $id_provinsi,
						'id_kabupaten'		=> $id_kabupaten,						
						'id_kecamatan'		=> $id_kecamatan,
						'id_desa'			=> $id_desa,
						'edit_by'			=> $input_by,
						'edit_date'			=> $input_date,
						'id_instansi'		=> $id_instansi
					);
					$rs = $this->Skp_model->save_peserta('edit', $data, $where);				
				}else{
					$data = array(									
						'nama_peserta'		=> $nama_peserta,
						'instansi_asal'		=> $instansi_asal,
						'sebagai'			=> $sebagai,						
						'no_hp'				=> $no_hp,
						'alamat'			=> $alamat,
						'email'				=> $email,
						'id_jenis_kegiatan'	=> $id_jenis_kegiatan,
						'id_provinsi'		=> $id_provinsi,
						'id_kabupaten'		=> $id_kabupaten,						
						'id_kecamatan'		=> $id_kecamatan,
						'id_desa'			=> $id_desa,
						'input_by'			=> $input_by,
						'input_date'		=> $input_date,
						'id_instansi'		=> $id_instansi
					);
					$rs = $this->Skp_model->save_peserta('add', $data);				
				}
				if($rs){
					$msg = "<p class='alert alert-success'>Data berhasil disimpan"."<br>"."Tersisa ".($cekkuota-($cekjmlterdaftar))." Peserta. Dari Total  ".$cekkuota."  Quota peserta</p>";
				}else{
					$msg = "<p class='alert alert-danger'>Data tidak berhasil disimpan</p>";
				}
			}else{
				$msg = "<p class='alert alert-danger'>Data tidak berhasil disimpan Quota Peserta sudah Terpenuhi"."<br>"."Tersisa ".($cekkuota-$cekjmlterdaftar)." Peserta. Dari Total  ".$cekkuota."  Quota peserta</p>";
			}
		}else{
			$id_instansi = $this->session->userdata('id_instansi');
			$msg = "<p class='alert alert-danger'>Data tidak berhasil disimpan Data Kegiatan harus di isi</p>";
		}

		$cek_admin = $this->session->userdata('is_admin');
		if ($cek_admin ==TRUE) {
			$datapeserta = $this->Skp_model->peserta_all();
		}else{

			$datapeserta = $this->Skp_model->peserta_perinstansi($id_instansi);
		}

		$data = array(
			'title1'			=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'			=> 'Data Pelatihan',
			'datapeserta'		=> $datapeserta,
			'msg'				=> $msg,
			'cekkuota'			=> $cekkuota,
			'cekjmlterdaftar' 	=>$cekjmlterdaftar
		);
		//echo "<pre>";
		//print_r($data['cekjmlterdaftar']);		
		//echo "</pre>";		
		$this->general->assign_var($data);
		$this->smarty->_render_template('skp/peserta/save_edit_peserta');
	}
	function hapus_peserta($id_peserta){
		$iddecode = $this->myencryption->decode($id_peserta);
		$result 	= $this->db->delete('t_peserta', array('id_peserta' => $iddecode));

		$id_instansi = $this->session->userdata('id_instansi');
		$cek_admin = $this->session->userdata('is_admin');
		if ($cek_admin ==TRUE) {
			$datapeserta = $this->Skp_model->peserta_all();
		}else{

			$datapeserta = $this->Skp_model->peserta_perinstansi($id_instansi);
		}

		$data = array(
			'title1'		=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'		=> 'Data Pelatihan',
			'datapeserta'	=> $datapeserta
		);
		//echo "<pre>";
		//print_r($data['datapeserta']);		
		//echo "</pre>";		
		$this->general->assign_var($data);
		$this->smarty->_render_template('skp/peserta/list_peserta_delete');	
		//redirect('skp','refresh');
	}
	/*Function Jenis kegiatan start */
	function jenis_kegiatan(){
		$id_instansi = $this->session->userdata('id_instansi');

		$cek_admin = $this->session->userdata('is_admin');
		if ($cek_admin ==TRUE) {
			$jenis_kegiatan = $this->Skp_model->jenis_kegall();
		}else{

			$jenis_kegiatan = $this->Skp_model->jenis_keg_instansi($id_instansi);
		}
		$data = array(
			'title1'			=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'			=> 'Data Kegiatan/Pelatihan',
			'kegiatan'			=> $jenis_kegiatan
		);
		//echo "<pre>";
		//print_r($data['kegiatan']);
		//echo "</pre>";		
		$this->general->assign_var($data);
		$this->smarty->_render_template('skp/jenis_kegiatan/jenis_kegiatan');
	}
	function add_jkegiatan(){
		$cek_admin = $this->session->userdata('is_admin');
		if ($cek_admin ==TRUE) {
			$data = array(
				'title1'			=> 'SIM Satuan Kredit Profesi (SKP)',
				'title2'			=> 'Tambah Data Kegiatan/Pelatihan',
			);
			//echo "<pre>";
			//print_r($data['kegiatan']);
			//echo "</pre>";		
			$this->general->assign_var($data);
			$this->smarty->_render_template('skp/jenis_kegiatan/admin_add_jkegiatan');			
		}else{
			$data = array(
				'title1'			=> 'SIM Satuan Kredit Profesi (SKP)',
				'title2'			=> 'Tambah Data Kegiatan/Pelatihan',
			);
			//echo "<pre>";
			//print_r($data['kegiatan']);
			//echo "</pre>";		
			$this->general->assign_var($data);
			$this->smarty->_render_template('skp/jenis_kegiatan/add_jkegiatan');
		}
	}
		
	function edit_jkegiatan($id_jenis_kegiatan){

		$iddecode = $this->myencryption->decode($id_jenis_kegiatan);
		$data_jkegiatan = $this->Skp_model->getedit_jkegiatan($iddecode);
		
		$cek_admin = $this->session->userdata('is_admin');
		if ($cek_admin ==TRUE) {
			$data = array(
				'title1'			=> 'SIM Satuan Kredit Profesi (SKP)',
				'title2'			=> 'Edit Data Kegiatan/Pelatihan',
				'data_jkegiatan' 	=> $data_jkegiatan
			);
			//echo "<pre>";
			//print_r($data['data_jkegiatan']);
			//echo "</pre>";		
			$this->general->assign_var($data);
			$this->smarty->_render_template('skp/jenis_kegiatan/admin_edit_jkegiatan');			
		}else{
			$data = array(
				'title1'			=> 'SIM Satuan Kredit Profesi (SKP)',
				'title2'			=> 'Edit Data Kegiatan/Pelatihan',
				'data_jkegiatan' 	=> $data_jkegiatan
			);
			//echo "<pre>";
			//print_r($data['data_jkegiatan']);
			//echo "</pre>";		
			$this->general->assign_var($data);
			$this->smarty->_render_template('skp/jenis_kegiatan/edit_jkegiatan');
		}		
	}
	function simpan_jkegiatan(){
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
				'edit_by'				=>$input_by,
				'edit_date'				=>$input_date
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
				'input_by'				=>$input_by,
				'input_date'			=>$input_date
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
		$this->smarty->_render_template('skp/jenis_kegiatan/save_jkeg');		
	}
	/**/
	function print_skp($id_peserta){

		$datapeserta = $this->Skp_model->peserta_byid($id_peserta);

		$nama_peserta  	= $datapeserta->row()->nama_peserta;
		$instansi_asal	= $datapeserta->row()->instansi_asal;
		$nama_kegiatan 	= $datapeserta->row()->nama_kegiatan;
		$no_skp 		= $datapeserta->row()->no_skp;
		$tanggal 		= $datapeserta->row()->tanggal;
		$tempat 		= $datapeserta->row()->tempat;
		$id_peserta		= $datapeserta->row()->id_peserta;
		$sebagai 		= $datapeserta->row()->nama;
		$nilai 			= $datapeserta->row()->nilai.''.' SKP';

		$url = 'http://www.grhasia.jogjaprov.go.id/skp/index.php/front_page/info_skp/'.$id_peserta;
		$this->load->library('Bb_qrcode');
		
		$namag = preg_replace("/[\s_]/", "-", $nama_peserta);		
		$params['data'] = $url.'/#'."\n"."\n".'nama : '.$nama_peserta."\n".'Instansi Asal : '.$instansi_asal."\n".'Kegiatan : '.$nama_kegiatan."\n".'No SKP : '.$no_skp."\n".'Tanggal : ' .$tanggal."\n".'Tempat : '.$tempat."\n".'Sebagai : '.$sebagai."\n".'Nilai : '.$nilai;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'assets/qrcode/img/'.$namag.'.'.'png';
		$qr = $this->bb_qrcode->generate($params);

		$qrnya = $namag.'.'.'png';
		$data = array(
			'title1'		=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'		=> 'Print Peserta',			
			'datapeserta'	=> $datapeserta,
			'qrnya'			=> $qrnya,
			'nama_peserta' 	=> $nama_peserta
			
		);

		//echo "<pre>";
		//print_r($data['datapeserta']);
		//print_r($nama_peserta);
		//echo "</pre>";
				
		$this->load->view('templates/skp/print_skp',$data);		
	}
	function print_sertifikat($id_peserta){
		
		$iddecode = $this->myencryption->decode($id_peserta);

		$datapeserta = $this->Skp_model->peserta_byid($iddecode);

		$nama_peserta  	= $datapeserta->row()->nama_peserta;
		$instansi_asal	= $datapeserta->row()->instansi_asal;
		$nama_kegiatan 	= $datapeserta->row()->nama_kegiatan;
		$no_skp 		= $datapeserta->row()->no_skp;
		$tanggal 		= $datapeserta->row()->tanggal;
		$tempat 		= $datapeserta->row()->tempat;
		$id_peserta		= $datapeserta->row()->id_peserta;
		$idencode 		= $this->myencryption->encode($id_peserta);
		$sebagai 		= $datapeserta->row()->nama;
		$nilai 			= $datapeserta->row()->nilai.''.' SKP';
		$legist_jabatan	= $datapeserta->row()->legist_jabatan;
		$legist_nama	= $datapeserta->row()->legist_nama;
		$legist_nira	= $datapeserta->row()->legist_nira;



		$ketua 			= $datapeserta->row()->ketua;
		$nira_ketua 	= $datapeserta->row()->nira_ketua;
		$url = 'http://www.grhasia.jogjaprov.go.id/skp/index.php/front_page/info_skp/'.$idencode;
		$this->load->library('Bb_qrcode');
		
		$namag = preg_replace("/[\s_]/", "-", $nama_peserta);		
		$params['data'] = $url.'/#'."\n"."\n".'Nama : '.$nama_peserta."\n".'Kegiatan : '.$nama_kegiatan."\n".'No SKP : '.$no_skp."\n".'Tanggal : ' .tgl_indo($tanggal)."\n".'Sebagai : '.$sebagai."\n".'Nilai : '.$nilai;
		$params['level'] = 'H';
		$params['size'] = 10;
		$params['savename'] = FCPATH.'assets/qrcode/img/'.$namag.$id_peserta.'.'.'png';
		$qr = $this->bb_qrcode->generate($params);

		$qrnya = $namag.$id_peserta.'.'.'png';
		$data = array(
			'title1'		=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'		=> 'Print Peserta',			
			'datapeserta'	=> $datapeserta,
			'qrnya'			=> $qrnya,
			'nama_peserta' 	=> $nama_peserta,
			'no_skp'		=> $no_skp,
			'nilai'			=> $nilai,
			'sebagai'		=> $sebagai,
			'nama_kegiatan'	=> $nama_kegiatan,
			'tanggal'		=> $tanggal,
			'tempat'		=> $tempat,
			'ketua'			=> $ketua,
			'nira_ketua' 	=> $nira_ketua,
			'legist_jabatan'=> $legist_jabatan,
			'legist_nama'	=> $legist_nama,
			'legist_nira'	=> $legist_nira
		);

		//echo "<pre>";
		//print_r($data['datapeserta']);
		//print_r($nama_peserta);
		//echo "</pre>";
				
		$this->load->view('templates/skp/print_sertifikat', $data);		
	}
	function info_skp($id_peserta){
		$datapeserta = $this->Skp_model->peserta_byid($id_peserta);

		$data = array(
			'title1'		=> 'SIM Satuan Kredit Profesi (SKP)',
			'title2'		=> 'Data Pelatihan',
			'datapeserta'	=> $datapeserta
		);

		//echo "<pre>";
		//print_r($data['datapeserta']);
		//echo "</pre>";		

		$this->general->assign_var($data);
		$this->smarty->_render_template('skp/info_skp');
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