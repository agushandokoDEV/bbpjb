<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Siaran_rri extends CI_Controller{
    
    function index(){
        $this->load->view('siaran_rri/page_index');
    }
}