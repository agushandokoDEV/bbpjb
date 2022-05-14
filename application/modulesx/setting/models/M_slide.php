<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_slide extends CI_Model{
    
    function get_slide(){
        $this->db->order_by('id_slide','DESC');
        $dt=$this->db->get('foto_slide');
        return $dt->result();
    }
    
    function del_slide($id){
        $this->db->where('id_slide',$id);
        $this->db->delete('foto_slide');
    }
}