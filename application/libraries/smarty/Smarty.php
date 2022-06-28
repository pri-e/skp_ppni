<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Smarty {

    var $data=array();
    var $path='templates/';
 
    function __construct(){
       $this->ci =& get_instance();
 
    }

    function assign($name, $value){
        $this->data[$name] = $value; 
    }

    function view($view){
        $this->ci->load->view($this->path.$view, $this->data);
    }

    function _render_template($view){
        $this->ci->load->view($this->path.'layouts/header', $this->data);
    	$this->ci->load->view($this->path.$view);
    	$this->ci->load->view($this->path.'layouts/footer');
    }

    function _render_crudtemplate($view){
        $this->ci->load->view($this->path.'layouts/header_non', $this->data);
        $this->ci->load->view($this->path.$view);
        $this->ci->load->view($this->path.'layouts/footer_non');
    }
}