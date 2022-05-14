<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembinaan extends CI_Controller{
    
    public function index()
	{
        $this->load->view('pembinaan/page_index');
	}
}