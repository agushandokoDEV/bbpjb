<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hasil_kegiatan extends CI_Controller{
    
    function index(){
        $this->load->view('hasil_kegiatan/page_index');
    }
}