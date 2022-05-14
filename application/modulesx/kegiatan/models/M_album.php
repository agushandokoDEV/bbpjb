<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_album extends CI_Model{
    
    private $table = "t_album_kegiatan";
    private $pk='id_album_keg';
    
    function get_album($id_keg){
        $this->db->where('id_kegiatan',$id_keg);
        $this->db->order_by($this->pk,'DESC');
        $dt=$this->db->get($this->table);
        return $dt->result();
    }
    
    function get_row_keg($id_keg){
        $this->db->select('id_kegiatan,nama_keg');
        $this->db->where('id_kegiatan',$id_keg);
        $dt=$this->db->get('t_kegiatan');
        return $dt->row();
    }
    
    function get_upd($id_keg,$dt){
        $this->db->where($this->pk,$id_keg);
        $this->db->update($this->table,$dt);
    }
    
    function del($id_keg){
        $this->db->where($this->pk,$id_keg);
        $this->db->delete($this->table);
    }
}