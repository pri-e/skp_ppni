<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	function jumah_keg_instansi($id_instansi){
		$query = $this->db->query("SELECT
									  t_jenis_kegiatan.nama_kegiatan,
									  t_jenis_kegiatan.tanggal,
									  t_jenis_kegiatan.quota_peserta,
									  Count(t_peserta.id_peserta) AS jmlh_peserta
									FROM
									  t_jenis_kegiatan
									  INNER JOIN t_peserta ON t_peserta.id_jenis_kegiatan = t_jenis_kegiatan.id_jenis_kegiatan
									WHERE
									  t_jenis_kegiatan.id_instansi = $id_instansi
									GROUP BY
									  t_jenis_kegiatan.nama_kegiatan,
									  t_jenis_kegiatan.tanggal,
									  t_jenis_kegiatan.quota_peserta,
									  t_jenis_kegiatan.id_instansi
									");									
		return $query->result();	
	}
	function keg_all(){
		$query = $this->db->query("SELECT
									  t_jenis_kegiatan.nama_kegiatan,
									  t_jenis_kegiatan.tanggal,
									  t_jenis_kegiatan.quota_peserta,
									  Count(t_peserta.id_peserta) AS jmlh_peserta
									FROM
									  t_jenis_kegiatan
									  INNER JOIN t_peserta ON t_peserta.id_jenis_kegiatan = t_jenis_kegiatan.id_jenis_kegiatan
									GROUP BY
									  t_jenis_kegiatan.nama_kegiatan,
									  t_jenis_kegiatan.tanggal,
									  t_jenis_kegiatan.quota_peserta
									");									
		return $query->result();	
	}
}