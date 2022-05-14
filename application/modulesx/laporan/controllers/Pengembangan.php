<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengembangan extends CI_Controller{
    
    public function index()
	{
        $this->load->view('pengembangan/page_index');
	}
}