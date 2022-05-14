<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_grafik extends CI_Model{
    
    function get_grafik_dt($jenis,$thn,$bln){
        $this->db->select('jenis,menu,count(*) as jumlah');
        $this->db->where('jenis',$jenis);
        $this->db->where("DATE_FORMAT(tgl_input,'%Y-%m')",$thn.'-'.$bln);
        $this->db->group_by('jenis,menu');
        $this->db->order_by('jenis');
        $dt=$this->db->get('t_laporan');
        return $dt->result();
    }
    
    function get_jum_dt($jenis,$thn,$bln,$mn=''){
        $this->db->select('count(*) as jumlah');
        $this->db->where('jenis',$jenis);
        $this->db->where('menu',$mn);
        $this->db->where("DATE_FORMAT(tgl_input,'%Y-%m')",$thn.'-'.$bln);
        $dt=$this->db->get('t_laporan');
        return $dt->row();
    }
    
    function get_grafik_total($thn){
        $this->db->select('count(*) as jumlah');
        $this->db->where("DATE_FORMAT(tgl_input,'%Y')",$thn);
        $dt=$this->db->get('t_laporan');
        return $dt->row()->jumlah;
    }
    
    function get_grafik_sum($jenis,$thn,$bln){
        $this->db->select('count(*) as jumlah');
        $this->db->where('jenis',$jenis);
        $this->db->where("DATE_FORMAT(tgl_input,'%Y-%m')",$thn.'-'.$bln);
        $dt=$this->db->get('t_laporan');
        return $dt->row();
    }
}