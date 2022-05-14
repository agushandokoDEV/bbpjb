<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mn_import extends CI_Model{
    
    function getMenu(){
        //$role=$this->session->userdata('id_role');
		//$this->db->where('adm_akses.id_role', $role);
		$this->db->where_in('id_menu', array('27','30'));
		//$this->db->where('maping', '1');
		//$this->db->join('adm_akses', 'adm_akses.id_menu = adm_menu.id_menu');
        $this->db->order_by('adm_menu.id_menu', 'ASC');
		$dt=$this->db->get('adm_menu');
        return $dt->result();
	}
    
    function get_menu($id){
        if($id != null){
            $this->db->select('nama_menu');
            $this->db->where('id_menu',$id);
            $dt=$this->db->get('adm_menu');
            return $dt->row()->nama_menu;
        }else{
           return ''; 
        }
    }
    
    function get_data(){
        //$this->db->join('adm_menu','adm_menu.id_menu=menu_data_import.id_menu','LEFT');
        $dt=$this->db->get('menu_data_import');
        return $dt->result();
    }
    function get_data_row($id){
        $this->db->where('id_import',$id);
        $dt=$this->db->get('menu_data_import');
        return $dt->row();
    }
    
    function upd_data($id,$dt){
        $this->db->where('id_import',$id);
        $this->db->update('menu_data_import',$dt);
    }
}