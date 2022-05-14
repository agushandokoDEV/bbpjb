<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('M_auth');
        $this->load->helper('text');
        $this->load->library('pagination');
    }
    
    function index(){
        //$data['dt_slide']=$this->M_auth->get_slide();
        $data['newsticker']=$this->M_auth->get_slide(10);
        $config['base_url'] = base_url('berita/index');
        $config['total_rows'] = count($this->M_auth->get_slide());
        $config['per_page'] = '10';
        $config['page_query_string']=TRUE;
        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";
        
        $this->pagination->initialize($config);
        $data['halaman'] = $this->pagination->create_links();
        $data['dt_slide'] = $this->M_auth->get_slide(null,$config['per_page'], $this->input->get('per_page'));
        $this->load->view('frontend/berita',$data);
    }
    
    function tag($slug=''){
        $data['berita']=$this->M_auth->get_row_berita($slug);
        $data['dt_slide']=$this->M_auth->get_slide();
        $data['newsticker']=$this->M_auth->get_slide(10);
        $this->load->view('frontend/berita_dtl',$data);
    }
}