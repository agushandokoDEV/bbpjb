<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_auth extends CI_Model{
    
    function log_checked($u,$p){
        $this->db->where('username',$u);
        $this->db->where('password',$p);
        $dt=$this->db->get('adm_users');
        return $dt->row();
    }
    
    function upt_pass($u,$dt){
        $this->db->where('username',$u);
        return $this->db->update('adm_users',$dt);
        //$this->db->where('id_role',$val);
        //return $this->db->update($this->table,$dt);
    }
    
    function upt_sess($id,$dt){
        $this->db->where('id',$id);
        $this->db->update('users_sessions',$dt);
    }
    
    function get_slidex(){
        $this->db->order_by('id_slide', 'RANDOM');
        $dt=$this->db->get('foto_slide');
        return $dt->result();
    }
    
    function get_slide($limit=null,$num=null, $offset=null){
        if($limit!= null){
            $this->db->limit($limit);
        }
        $this->db->order_by('id_berita', 'DESC');
        $dt=$this->db->get('t_berita',$num, $offset);
        return $dt->result();
    }
    
    function get_row_berita($slug){
        $this->db->where('slug', $slug);
        $dt=$this->db->get('t_berita');
        return $dt->row();
    }
}