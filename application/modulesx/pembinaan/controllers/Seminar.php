<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Seminar extends CI_Controller{
    
    function index(){
        $this->load->view('seminar/page_index');
    }
}