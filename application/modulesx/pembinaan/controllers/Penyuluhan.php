<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penyuluhan extends CI_Controller{
    
    function index(){
        $this->load->view('penyuluhan/page_index');
    }
}