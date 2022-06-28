<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Skp_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}
	function jenis_keg_instansi($id_instansi){
		$query = $this->db->query("SELECT
									  t_jenis_kegiatan.*,
									  m_pengguna_instansi.instansi,
									  m_pengguna_instansi.alamat
									FROM
									  t_jenis_kegiatan
									  JOIN m_pengguna_instansi ON m_pengguna_instansi.id_instansi = t_jenis_kegiatan.id_instansi
									WHERE
									t_jenis_kegiatan.id_instansi = $id_instansi
									ORDER BY
										t_jenis_kegiatan.id_jenis_kegiatan DESC
									");									
		return $query->result();	
	}
	function jenis_kegall(){
		$query = $this->db->query("SELECT
									  t_jenis_kegiatan.*,
									  m_pengguna_instansi.instansi,
									  m_pengguna_instansi.alamat
									FROM
									  t_jenis_kegiatan
									  JOIN m_pengguna_instansi ON m_pengguna_instansi.id_instansi = t_jenis_kegiatan.id_instansi
									ORDER BY
										t_jenis_kegiatan.id_jenis_kegiatan DESC
									");									
		return $query->result();	
	}
	function save_jkegiatan($ops='add', $data, $where=null){
		if($ops=='add'){
			$rs = $this->db->insert('t_jenis_kegiatan', $data);
		}else{
			$rs = $this->db->update('t_jenis_kegiatan', $data, $where);
		}

		if($rs){
			return true;
		}else{
			return false;
		}
	}
	function getedit_jkegiatan($id_jenis_kegiatan){
		$this->db->select('*');
		$this->db->from('t_jenis_kegiatan');
		$this->db->join('m_pengguna_instansi', 'm_pengguna_instansi.id_instansi = t_jenis_kegiatan.id_instansi');
		$this->db->where(array('t_jenis_kegiatan.id_jenis_kegiatan' => $id_jenis_kegiatan));
		$query = $this->db->get();
		return $query->result();
	}
	function get_jenis_peserta(){
		$this->db->select('*');
		$this->db->from('m_jenis_peserta');
		$query = $this->db->get();
		return $query->result();
	}
	function get_jkeg_aktif_all(){
		$this->db->select('*');
		$this->db->from('t_jenis_kegiatan');
		$this->db->where(array('t_jenis_kegiatan.status' => 'Aktif'));
		$query = $this->db->get();
		return $query->result();
	}
	function get_jkeg_aktif_instansi($id_instansi){
		$this->db->select('*');
		$this->db->from('t_jenis_kegiatan');
		$this->db->where(array('t_jenis_kegiatan.status' => 'Aktif', 't_jenis_kegiatan.id_instansi' => $id_instansi));
		$query = $this->db->get();
		return $query->result();
	}
	function get_propinsi(){
		$this->db->select('*');
		$this->db->from('wilayah_provinsi');
		$query = $this->db->get();
		return $query->result();
	}
	function save_peserta($ops='add', $data, $where=null){
		if($ops=='add'){
			$rs = $this->db->insert('t_peserta', $data);
		}else{
			$rs = $this->db->update('t_peserta', $data, $where);
		}

		if($rs){
			return true;
		}else{
			return false;
		}
	}
	function peserta(){
		$query = $this->db->query("SELECT
									  t_peserta.id_peserta,
									  t_peserta.nama_peserta,
									  t_peserta.instansi_asal,
									  t_peserta.no_hp,
									  t_peserta.alamat,
									  t_peserta.email,
									  t_jenis_kegiatan.nama_kegiatan,
									  t_jenis_kegiatan.tanggal,
									  t_jenis_kegiatan.no_skp,									  
									  t_jenis_kegiatan.tempat,
									  t_jenis_kegiatan.penyelenggara,
									  t_jenis_kegiatan.keterangan,
									  t_peserta.id_jenis_kegiatan
									FROM
									  t_peserta
									  INNER JOIN t_jenis_kegiatan ON t_peserta.id_jenis_kegiatan = t_jenis_kegiatan.id_jenis_kegiatan");									
		return $query->result();				
	}
	function peserta_all(){
		$this->db->select('*');
		$this->db->from('t_peserta');
		$this->db->join('t_jenis_kegiatan', 't_jenis_kegiatan.id_jenis_kegiatan = t_peserta.id_jenis_kegiatan');
		$this->db->order_by('t_peserta.id_peserta', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}
	function peserta_perinstansi($id_instansi){
		$this->db->select('*');
		$this->db->from('t_peserta');
		$this->db->join('t_jenis_kegiatan', 't_jenis_kegiatan.id_jenis_kegiatan = t_peserta.id_jenis_kegiatan');
		$this->db->where(array('t_peserta.id_instansi' => $id_instansi));
		$this->db->order_by('t_peserta.id_peserta', 'DESC');		 
		$query = $this->db->get();
		return $query->result();
	}
	function peserta_byid($id_peserta){
		$query = $this->db->query("SELECT
									  t_peserta.id_peserta,
									  t_peserta.nama_peserta,
									  t_peserta.instansi_asal,
									  t_peserta.no_hp,
									  t_peserta.alamat,
									  t_peserta.email,
									  t_jenis_kegiatan.nama_kegiatan,
									  t_jenis_kegiatan.tanggal,
									  t_jenis_kegiatan.no_skp,									  
									  t_jenis_kegiatan.tempat,
									  t_jenis_kegiatan.penyelenggara,
									  t_jenis_kegiatan.keterangan,
									  t_jenis_kegiatan.legist_jabatan,
									  t_jenis_kegiatan.legist_nama,
									  t_jenis_kegiatan.legist_nira,
									  t_jenis_kegiatan.ketua,
									  t_jenis_kegiatan.nira_ketua,
									  t_peserta.id_jenis_kegiatan,									  
									  m_jenis_peserta.nama,
									  m_jenis_peserta.nilai
									FROM
									  t_peserta
									  INNER JOIN t_jenis_kegiatan ON t_peserta.id_jenis_kegiatan = t_jenis_kegiatan.id_jenis_kegiatan
									  INNER JOIN m_jenis_peserta ON t_peserta.sebagai = m_jenis_peserta.id
									Where
									  t_peserta.id_peserta = $id_peserta
									  ");									
		return $query;				
	}
	function get_peseta_by_id($id_peserta){
		$query = $this->db->query("SELECT
									  t_peserta.*,
									  t_jenis_kegiatan.nama_kegiatan,
									  t_jenis_kegiatan.quota_peserta,
									  t_jenis_kegiatan.tanggal,
									  t_jenis_kegiatan.no_skp,
									  t_jenis_kegiatan.tempat,
									  t_jenis_kegiatan.id_instansi AS id_instansi1,
									  t_jenis_kegiatan.status,
									  t_jenis_kegiatan.reg_online,
									  t_jenis_kegiatan.ketua,
									  t_jenis_kegiatan.nira_ketua,
									  t_jenis_kegiatan.keterangan,
									  t_jenis_kegiatan.legist_nama,
									  t_jenis_kegiatan.legist_jabatan,
									  t_jenis_kegiatan.legist_daerah,
									  t_jenis_kegiatan.legist_nira,
									  t_jenis_kegiatan.input_by AS input_by1,
									  t_jenis_kegiatan.input_date AS input_date1,
									  t_jenis_kegiatan.edit_by AS edit_by1,
									  t_jenis_kegiatan.edit_date AS edit_date1,
									  t_jenis_kegiatan.verif_admin,
									  t_jenis_kegiatan.verif_date,
									  t_jenis_kegiatan.verif_by,
									  m_jenis_peserta.nama,
									  m_jenis_peserta.nilai,
									  m_jenis_peserta.nilai_text,
									  m_jenis_peserta.keterangan AS keterangan1,
									  wilayah_provinsi.nama AS propinsi,
									  wilayah_kabupaten.nama AS kabupaten,
									  wilayah_kecamatan.nama AS kecamatan,
									  wilayah_desa.nama AS desa
									FROM
									  t_peserta
									  INNER JOIN t_jenis_kegiatan ON t_peserta.id_jenis_kegiatan = t_jenis_kegiatan.id_jenis_kegiatan
									  INNER JOIN m_jenis_peserta ON t_peserta.sebagai = m_jenis_peserta.id
									  INNER JOIN wilayah_provinsi ON wilayah_provinsi.id = t_peserta.id_provinsi
									  INNER JOIN wilayah_kabupaten ON wilayah_kabupaten.id = t_peserta.id_kabupaten
									  INNER JOIN wilayah_kecamatan ON wilayah_kecamatan.id = t_peserta.id_kecamatan
									  INNER JOIN wilayah_desa ON wilayah_desa.id = t_peserta.id_desa
									WHERE
									  t_peserta.id_peserta = $id_peserta
									  ");									
		return $query->result();				
	}
	function get_peserta_by_id($id_peserta){
		$query = $this->db->query("SELECT
									  t_peserta.*,
									  t_jenis_kegiatan.nama_kegiatan,
									  m_jenis_peserta.nama,
									  m_jenis_peserta.keterangan,
									  wilayah_desa.nama AS nama_desa,
									  wilayah_kecamatan.nama AS nama_kec,
									  wilayah_kabupaten.nama AS nama_kab,
									  wilayah_provinsi.nama AS nama_prop
									FROM
									  t_peserta
									  INNER JOIN t_jenis_kegiatan ON t_jenis_kegiatan.id_jenis_kegiatan = t_peserta.id_jenis_kegiatan
									  INNER JOIN m_jenis_peserta ON m_jenis_peserta.id = t_peserta.sebagai
									  LEFT JOIN wilayah_provinsi ON wilayah_provinsi.id = t_peserta.id_provinsi
									  LEFT JOIN wilayah_kabupaten ON wilayah_kabupaten.id = t_peserta.id_kabupaten
									  LEFT JOIN wilayah_kecamatan ON wilayah_kecamatan.id = t_peserta.id_kecamatan
									  LEFT JOIN wilayah_desa ON wilayah_desa.id = t_peserta.id_desa
									WHERE
									  t_peserta.id_peserta = $id_peserta
									  ");									
		return $query->result();				
	}
}