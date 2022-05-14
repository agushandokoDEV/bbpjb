<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_ques extends CI_Model{
    
    function get_post(){
        $this->db->order_by('id_ques','DESC');
        $dt=$this->db->get('dev_ques');
        return $dt->result();
    }
    
    function get_last_post($id){
        $this->db->where('id_ques',$id);
        $dt=$this->db->get('dev_ques');
        return $dt->row();
    }
    
    function get_komentar($id){
        $this->db->where('id_posting',$id);
        $this->db->order_by('id_komentar','ASC');
        $dt=$this->db->get('dev_komentar');
        return $dt->result();
    }
    
    function get_last_komentar($id,$id_posting){
        $this->db->where('id_posting',$id_posting);
        $this->db->where('id_komentar',$id);
        $dt=$this->db->get('dev_komentar');
        return $dt->row();
    }
    
    function get_jum_komentar($id_posting){
        $this->db->select('count(id_komentar) as jumlah');
        $this->db->where('id_posting',$id_posting);
        $dt=$this->db->get('dev_komentar');
        return $dt->row();
    }
}