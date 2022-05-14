<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_app extends CI_Model{
    
    function getMenu(){
        $role=$this->session->userdata('id_role');
		$this->db->where('adm_akses.id_role', $role);
		$this->db->where('adm_menu.sub', '0');
		$this->db->where('adm_akses.status', '1');
        
		$this->db->join('adm_akses', 'adm_akses.id_menu = adm_menu.id_menu');
        $this->db->order_by('adm_menu.id_menu', 'ASC');
		$dt=$this->db->get('adm_menu');
        return $dt->result();
	}
    
    function getSubMenu($sub){
		//$this->db->where('adm_akses.id_menu', $sub);
        $role=$this->session->userdata('id_role');
		$this->db->where('adm_akses.id_role', $role);
		$this->db->where('adm_menu.sub', $sub);
		$this->db->where('adm_akses.status', '1');
		$this->db->join('adm_akses', 'adm_akses.id_menu = adm_menu.id_menu');
		$dt=$this->db->get('adm_menu');
        return $dt->result();
	}
    
    function my_profil(){
		$this->db->select('username,nama_user');
        $this->db->where('username', $this->session->userdata('username'));
        $dt=$this->db->get('adm_users');
        return $dt->row();
    }
}