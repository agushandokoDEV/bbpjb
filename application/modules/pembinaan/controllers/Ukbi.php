<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ukbi extends CI_Controller{
    
    function index(){
        $this->load->view('ukbi/page_index');
    }
}