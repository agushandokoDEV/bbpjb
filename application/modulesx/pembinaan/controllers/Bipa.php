<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bipa extends CI_Controller{
    
    function index(){
        $this->load->view('bipa/page_index');
    }
}