<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Galery extends Userauth {
    
    function __construct(){
	   parent::__construct();
    }

    public function index(){
		$this->load->view("page_index");
	}
}