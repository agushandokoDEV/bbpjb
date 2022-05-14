<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
	   parent::__construct();
	}
    public function index()
	{
		$html='<form method="post" action="'.site_url("welcome/buat").'">';
        $html .='<input type="text" name="folder" class="form-control"/><br/>';
        $html .='<button type="submit" class="btn btn-danger btn-sm">Submit</button>';
        echo $html;
	}
    
    public function buat(){
        $this->load->library('Gcrud');
        $this->gcrud->set_modules_name($this->input->post('folder'));
        $this->gcrud->create_modules();
    }
    
    public function home(){
        $this->load->view('frontend/home');
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */