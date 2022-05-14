<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('M_auth');
        $this->load->helper('text');
    }
    
    function index(){
         $data['dt_slide']=$this->M_auth->get_slide();
         $data['newsticker']=$this->M_auth->get_slide(10);
         $this->load->view('frontend/gallery',$data);
    }
}