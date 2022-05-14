<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_seting extends CI_Model{
   
   private $tbl='adm_users';
   private $pk='username';
   private $username='';
   
   function __construct(){
        $this->username=$this->session->username;
    }
   
   function get_user_row(){
        $this->db->where($this->pk,$this->username);
        $dt=$this->db->get($this->tbl);
        return $dt->row();
   }
   
   function upd_users($data){
        $this->db->where($this->pk,$this->username);
        $this->db->update($this->tbl,$data);
   }
}