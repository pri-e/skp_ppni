<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Skpppni {

	private $ci;

	function __construct(){
		$this->ci =& get_instance();
		if($this->ci->session->userdata('is_admin')){
			$this->ci->smarty->assign("menu",$this->Menu_Administrator());
		}else{
			$this->ci->smarty->assign("menu",$this->Menu_Pengguna());
		}

		$this->ci->smarty->assign("datalogin",$this->data_login());		
	}


	function Menu_Administrator(){
		$parent = $this->ci->db->order_by('urutan','asc')->get_where('m_menu', array('parent_id'=>null,'aktif'=>'Ya'));
		$menu="";
		if($parent->num_rows() > 0){
			$menu.="<ul id='main-menu' class='nav side-menu'>";
				foreach($parent->result() as $parentMenu){
					$subMenu = $this->ci->db->order_by('urutan1','asc')->get_where('m_menu', array('parent_id'=>$parentMenu->id_menu,'aktif'=>'Ya'));
					if($subMenu->num_rows() > 0){
						$menu.="<li><a>"."<i class='".$parentMenu->icon."'></i>".$parentMenu->nama_modul."<span class='fa fa-chevron-down'></span></a>";
							$menu.="<ul class='nav child_menu'>";
							foreach($subMenu->result() as $mainMenu){
								$ssmenu = $this->ci->db->order_by('urutan','asc')->get_where('m_menu', array('parent_id'=>$mainMenu->id_menu,'aktif'=>'Ya'));
								if($ssmenu->num_rows() > 0){
									$menu.="<li><a href='#'>".$mainMenu->nama_modul."</a>";
										$menu.="<ul >";
									foreach($ssmenu->result() as $item){
										$menu.="<li><a href='".base_url()."index.php/".$item->link_modul."'>".$item->nama_modul."</a></li>";
									}
										$menu.="</ul>";
									$menu.="</li>";
								}else{
									$menu.="<li><a href='".base_url()."index.php/".$mainMenu->link_modul."'>".$mainMenu->nama_modul."</a></li>";
								}
								
							}
							$menu.="</ul>";
						$menu.="</li>";
					}else{
						$menu.="<li><a>"."<i class='".$parentMenu->icon."'></i>".$parentMenu->nama_modul."<span class='fa fa-chevron-down'></span></a></li>";
					}
				}				
			$menu.="</ul>";			
		}
		return $menu;
	}

	function Menu_Pengguna(){
		$user = $this->ci->session->userdata('id_user');
		$parent = $this->ci->db->order_by('urutan','asc')->get_where('menu_user', array('parent_id'=>null,'aktif'=>'Ya','id_user'=>$user));
		$menu="";
		if($parent->num_rows() > 0){
			$menu.="<ul id='main-menu' class='nav side-menu'>";
				foreach($parent->result() as $parentMenu){
					$subMenu = $this->ci->db->order_by('urutan1','asc')->get_where('menu_user', array('parent_id'=>$parentMenu->id_menu,'aktif'=>'Ya','id_user'=>$user));
					if($subMenu->num_rows() > 0){
						$menu.="<li><a>"."<i class='".$parentMenu->icon."'></i>".$parentMenu->nama_modul."<span class='fa fa-chevron-down'></span></a>";
							$menu.="<ul class='nav child_menu'>";
							foreach($subMenu->result() as $mainMenu){
								$ssmenu = $this->ci->db->order_by('urutan','asc')->get_where('menu_user', array('parent_id'=>$mainMenu->id_menu,'aktif'=>'Ya','id_user'=>$user));
								if($ssmenu->num_rows() > 0){
									$menu.="<li><a href='".base_url()."index.php/".$mainMenu->link_modul."'>".$mainMenu->nama_modul."</a>";
										$menu.="<ul>";
									foreach($ssmenu->result() as $item){
										$menu.="<li><a href='".base_url()."index.php/".$item->link_modul."'>".$item->nama_modul."</a></li>";
									}
										$menu.="</ul>";
									$menu.="</li>";
								}else{
									$menu.="<li><a href='".base_url()."index.php/".$mainMenu->link_modul."'>".$mainMenu->nama_modul."</a></li>";
								}
								
							}
							$menu.="</ul>";
						$menu.="</li>";
					}else{
						$menu.="<li><a>"."<i class='".$parentMenu->icon."'></i>".$parentMenu->nama_modul."<span class='fa fa-chevron-down'></span></a></li>";
					}
				}				
			$menu.="</ul>";			
		}
		return $menu;
	}	
	function data_login(){
		$user = $this->ci->session->userdata('id_user');
		$data = $this->ci->db
				->join('m_pengguna_level','m_pengguna_level.id_level=m_pengguna.id_level')
				->join('m_pengguna_instansi','m_pengguna_instansi.id_instansi=m_pengguna.id_instansi')
				->get_where('m_pengguna', array('id_user'=>$user));		
		return $data;				
	}	
}