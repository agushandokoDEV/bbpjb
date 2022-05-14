<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_dashboard extends CI_Model{
    
    function get_map(){
        $dt=$this->db->get('t_kabkot');
        return $dt->result();
    }
    
    function get_kota($id){
        $this->db->select('id_kabkot,nama_kota');
        $this->db->where('id_kabkot',$id);
        $dt=$this->db->get('t_kabkot');
        return $dt->row();
    }
    
    function get_keg($id,$thn){
        $this->db->where('verify','2');
        $this->db->where("DATE_FORMAT(tgl_keg,'%Y')",$thn);
        $this->db->where('id_kabkot',$id);
        $this->db->limit(10);
        $this->db->order_by('id_kegiatan','DESC');
        $dt=$this->db->get('t_kegiatan');
        return $dt->result();
    }
    
    function get_jum_keg($id,$thn){
        $this->db->select('count(id_kegiatan) as jumlah');
        $this->db->where("DATE_FORMAT(tgl_keg,'%Y')",$thn);
        $this->db->where('verify','2');
        $this->db->where('id_kabkot',$id);
        $dt=$this->db->get('t_kegiatan');
        return $dt->row();
    }
}