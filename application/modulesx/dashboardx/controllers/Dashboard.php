<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Userauth{
    
    function __construct(){
        parent::__construct();
        $this->load->model('M_dashboard');
    }
    
    function index(){
        $data['dt_map']=$this->M_dashboard->get_map();
        $this->load->view('page_index',$data);
        //$this->output->cache(1);
    }
    
    function ajax_load_map(){
        if ($this->input->is_ajax_request()){
            $thn=$this->input->post('thn');
            $data['dt_map']=$this->M_dashboard->get_map();
            $data['thn']=$thn;
            $this->load->view('ajax_load_map',$data);
        }else{
            show_404();
        }
    }
    
    function ajax_load_kota(){
        if ($this->input->is_ajax_request()){
            $id=$this->input->post('kota');
            $thn=$this->input->post('thn');
            $data['dt_kota']=$this->M_dashboard->get_kota($id);
            $data['dt_keg']=$this->M_dashboard->get_keg($id,$thn);
            $data['thn']=$thn;
            $data['jum_keg']=$this->M_dashboard->get_jum_keg($id,$thn);
            $this->load->view('ajax_load_kota',$data);
        }else{
            show_404();
        }
    }
}