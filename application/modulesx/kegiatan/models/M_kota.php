<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kota extends CI_Model{
    
    function get_kota($id){
        $this->db->select('id_kabkot,nama_kota');
        $this->db->where('id_kabkot',$id);
        $dt=$this->db->get('t_kabkot');
        return $dt->row();
    }
    
    function get_keg($id,$thn,$num=null,$offset=null){
        $this->db->where('verify','2');
        $this->db->where('id_kabkot',$id);
        $this->db->where("DATE_FORMAT(tgl_keg,'%Y')",$thn);
        $this->db->order_by('tgl_keg','DESC');
        $dt=$this->db->get('t_kegiatan',$num, $offset);
        return $dt->result();
    }
}