<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_berita extends CI_Model{
    
    private $table = "t_berita";
    private $pk='id_berita';
    
    function get_data(){
        $this->db->order_by($this->pk,'DESC');
        $dt=$this->db->get($this->table);
        return $dt->result();
    }
    
    function get_row($id){
        $this->db->where($this->pk,$id);
        $dt=$this->db->get($this->table);
        return $dt->row();
    }
    
    function upd_row($id,$dt){
        $this->db->where($this->pk,$id);
        $this->db->update($this->table,$dt);
    }
    
    function del_row($id){
        $this->db->where($this->pk,$id);
        $this->db->delete($this->table);
    }
}