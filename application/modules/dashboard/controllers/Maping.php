<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Maping extends Userauth{
    
    function __construct(){
        parent::__construct();
        $this->load->model('M_maping');
    }
    
    function get_nm_alldata(){
        if ($this->input->is_ajax_request()){
            $menu=$this->input->post('menu');
            $nm=$this->M_maping->get_name_alldata($menu);
            echo $nm->map_alldata;
        }else{
            show_404();
        }
    }
    
    function load_map(){
        if ($this->input->is_ajax_request()){
            $thn=$this->input->post('thn');
            $data['dt_map']=$this->M_maping->get_map();
            $data['thn']=$thn;
            $menu=$this->input->post('menu');
            $data['id_menu']=$menu;
            $maping=$this->M_maping->get_map_view($menu);
            $data['maping']=$maping;
            $this->load->view('ajax/map_'.$maping->map,$data);
        }else{
            show_404();
        }
    }
    
    function load_map_data(){
        if ($this->input->is_ajax_request()){
            $thn=$this->input->post('thn');
            $kota=$this->input->post('kota');
            $menu=$this->input->post('menu');
            $maping=$this->M_maping->get_map_view($menu);
            $data['dt_map']=$this->M_maping->get_map_data($maping->table,$kota,$thn);
            $data['thn']=$thn;
            $data['mn_menu']=$this->M_maping->menu_name($menu);
            $data['kota_nm']=$this->M_maping->kota_name($kota);
            $this->load->view('ajax/'.$maping->views.'_data',$data);
        }else{
            show_404();
        }
    }
    
    function load_map_alldata(){
        if ($this->input->is_ajax_request()){
            $thn=$this->input->post('thn');
            $menu=$this->input->post('menu');
            $maping=$this->M_maping->get_map_view($menu);
            $data['dt_map']=$this->M_maping->get_map_alldata($maping->table,$thn);
            $data['mn_menu']=$this->M_maping->menu_name($menu);
            $data['thn']=$thn;
            $this->load->view('ajax/'.$maping->views.'_data',$data);
        }else{
            show_404();
        }
    }
    
    function load_map_alldataXXX(){
        if ($this->input->is_ajax_request()){
            $kota=$this->input->post('kota');
            $menu=$this->input->post('menu');
            $maping=$this->M_maping->get_map_view($menu);
            $data['dt_map']=$this->M_maping->get_map_alldata($maping->table,$kota);
            $data['mn_menu']=$this->M_maping->menu_name($menu);
            $data['kota_nm']=$this->M_maping->kota_name($kota);
            $this->load->view('ajax/'.$maping->views.'_alldata',$data);
        }else{
            show_404();
        }
    }
    
    function load_jurnal(){
        if ($this->input->is_ajax_request()){
            $thn=$this->input->post('thn');
            $kota=$this->input->post('kota');
            $menu=$this->input->post('menu');
            $data['dt_map']=$this->M_maping->get_data_jurnal($kota,$thn,'j');
            $data['thn']=$thn;
            $data['mn_menu']=$this->M_maping->menu_name($menu);
            $data['kota_nm']=$this->M_maping->kota_name($kota);
            $this->load->view('ajax/jurnal_data',$data);
        }else{
            show_404();
        }
    }
    
    function load_alljurnal(){
        if ($this->input->is_ajax_request()){
            $thn=$this->input->post('thn');
            $menu=$this->input->post('menu');
            $data['dt_map']=$this->M_maping->get_data_alljurnal($thn,'j');
            $data['thn']=$thn;
            $data['mn_menu']=$this->M_maping->menu_name($menu);
            $this->load->view('ajax/jurnal_data',$data);
        }else{
            show_404();
        }
    }
    
    function load_majalah(){
        if ($this->input->is_ajax_request()){
            $thn=$this->input->post('thn');
            $kota=$this->input->post('kota');
            $menu=$this->input->post('menu');
            $data['dt_map']=$this->M_maping->get_data_jurnal($kota,$thn,'m');
            $data['thn']=$thn;
            $data['mn_menu']=$this->M_maping->menu_name($menu);
            $data['kota_nm']=$this->M_maping->kota_name($kota);
            $this->load->view('ajax/jurnal_data',$data);
        }else{
            show_404();
        }
    }
    function load_allmajalah(){
        if ($this->input->is_ajax_request()){
            $thn=$this->input->post('thn');
            $menu=$this->input->post('menu');
            $data['dt_map']=$this->M_maping->get_data_alljurnal($thn,'m');
            $data['thn']=$thn;
            $data['mn_menu']=$this->M_maping->menu_name($menu);
            $this->load->view('ajax/jurnal_data',$data);
        }else{
            show_404();
        }
    }
    
    function load_alldtbhs(){
        if ($this->input->is_ajax_request()){
            $thn=$this->input->post('thn');
            $menu=$this->input->post('menu');
            $kota=$this->input->post('kota');
            $data['dt_map']=$this->M_maping->get_all_dtbhs($thn,'umum',$kota);
            $data['thn']=$thn;
            $data['mn_menu']=$this->M_maping->menu_name($menu);
            $data['kota_nm']=$this->M_maping->kota_name($kota);
            $this->load->view('ajax/dtbhs_data',$data);
        }else{
            show_404();
        }
    }
    
    function load_alldtbhsp(){
        if ($this->input->is_ajax_request()){
            $thn=$this->input->post('thn');
            $menu=$this->input->post('menu');
            $kota=$this->input->post('kota');
            $data['dt_map']=$this->M_maping->get_all_dtbhs($thn,'pelajar',$kota);
            $data['thn']=$thn;
            $data['mn_menu']=$this->M_maping->menu_name($menu);
            $data['kota_nm']=$this->M_maping->kota_name($kota);
            $this->load->view('ajax/dtbhs_data',$data);
        }else{
            show_404();
        }
    }
    
    function load_map_pensas(){
        if ($this->input->is_ajax_request()){
            $thn=$this->input->post('thn');
            $menu=$this->input->post('menu');
            $kota=$this->input->post('kota');
            $data['dt_map']=$this->M_maping->get_map_penbas('sastra',$thn,$kota);
            $data['thn']=$thn;
            $data['mn_menu']=$this->M_maping->menu_name($menu);
            $data['kota_nm']=$this->M_maping->kota_name($kota);
            $this->load->view('ajax/pensas_data',$data);
        }else{
            show_404();
        }
    }
    
    function load_map_penbhs(){
        if ($this->input->is_ajax_request()){
            $thn=$this->input->post('thn');
            $menu=$this->input->post('menu');
            $kota=$this->input->post('kota');
            $data['dt_map']=$this->M_maping->get_map_penbas('bahasa',$thn,$kota);
            $data['thn']=$thn;
            $data['mn_menu']=$this->M_maping->menu_name($menu);
            $data['kota_nm']=$this->M_maping->kota_name($kota);
            $this->load->view('ajax/pensas_data',$data);
        }else{
            show_404();
        }
    }
}