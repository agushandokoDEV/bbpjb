<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_mapinglap extends CI_Model{
    
    private $tbl='t_mapinglap';
    private $pk='id_mapinglap';
    
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
    
    function get_data(){
        $this->db->order_by($this->pk,'ASC');
        $dt=$this->db->get($this->tbl);
        return $dt->result();
    }
    
    function get_menu($id){
        $h='';
        if($id != null){
            $this->db->select('nama_menu');
            $this->db->where('id_menu',$id);
            $dt=$this->db->get('adm_menu');
            if($dt->row()){
                $h=$dt->row()->nama_menu;
            }
        }
        return $h;
    }
    
    function get_data_row($id){
        $this->db->where($this->pk,$id);
        $dt=$this->db->get($this->tbl);
        return $dt->row();
    }
    
    function get_upd_row($id,$dt){
        $this->db->where($this->pk,$id);
        $this->db->update($this->tbl,$dt);
    }
    
    public function delete_by_id($id)
	{
		$this->db->where($this->pk,$id);
		$this->db->delete($this->tbl);
	}
}