<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bengkel_bhs_sastra extends CI_Controller{
    
    function index(){
        $this->load->view('bengkel_bhs_sastra/page_index');
    }
}