<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tag extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('M_auth');
        $this->load->helper('text');
    }
    
    function gallery(){
         $data['newsticker']=$this->M_auth->get_slide(10);
         $data['dt_slide']=$this->M_auth->get_slide();
         $this->load->view('frontend/gallery',$data);
    }
    
    public function profil()
	{
		$this->load->view('frontend/profil');
	}
    public function sejarah()
	{
		$this->load->view('frontend/sejarah');
	}
    
    public function visimisi()
	{
		$this->load->view('frontend/visimisi');
	}
    
    public function kontak()
	{
		$this->load->view('frontend/kontak');
	}
}
