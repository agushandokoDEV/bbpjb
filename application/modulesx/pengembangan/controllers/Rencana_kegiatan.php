<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rencana_kegiatan extends CI_Controller{
    
    function index(){
        $this->load->view('rencana_kegiatan/page_index');
    }
}