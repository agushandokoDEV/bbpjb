<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_import extends Userauth {

	function __construct(){
	   parent::__construct();
       $this->load->model('M_mn_import','M_mn');
	}
    
    public function index(){
        $data['dt_menu']=$this->M_mn->get_data();
        $this->load->view('import/page_index',$data);
	}
    
    function add(){
        $data['mn_par']=$this->M_mn->getMenu();
        $this->load->view('import/page_add',$data);
    }
    
    function do_add(){
        $id_menu=$this->input->post('id_menu');
        $parent=$this->input->post('parent');
        $function=$this->input->post('function');
        $dt_menu=array(
            'id_menu_par'=>$parent,
            'id_menu'=>$id_menu,
            'function'=>$function
        );
        $this->db->insert('menu_data_import',$dt_menu);
        redirect('manajemen/menu_import');
    }
    
    function upd($id=''){
        $data['mn_par']=$this->M_mn->getMenu();
        $data['dt_row']=$this->M_mn->get_data_row($id);
        $this->load->view('import/page_upd',$data);
    }
    
    function do_upd(){
        $id_menu=$this->input->post('id_menu');
        $parent=$this->input->post('parent');
        $function=$this->input->post('function');
        $id=$this->input->post('id');
        $dt_menu=array(
            'id_menu_par'=>$parent,
            'id_menu'=>$id_menu,
            'function'=>$function
        );
        $this->M_mn->upd_data($id,$dt_menu);
        redirect('manajemen/menu_import');
    }
}