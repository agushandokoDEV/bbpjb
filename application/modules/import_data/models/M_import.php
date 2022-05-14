<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_import extends CI_Model{
    
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
    
    function getSubMenu($sub){
		$this->db->where('id_menu_par', $sub);
		$dt=$this->db->get('menu_data_import');
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
}