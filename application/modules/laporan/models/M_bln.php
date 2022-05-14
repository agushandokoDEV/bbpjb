<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_bln extends CI_Model{
    
    function get_data(){
        $this->db->order_by('id_mapinglap','ASC');
        $dt=$this->db->get('t_mapinglap');
        return $dt->result();
    }
    
    function get_kabkot(){
        $this->db->select('id_kabkot,nama_kota');
        $this->db->order_by('nama_kota','ASC');
        $dt=$this->db->get('t_kabkot');
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
    function get_row_maping($id){
        $this->db->where('id_mapinglap',$id);
        $dt=$this->db->get('t_mapinglap');
        return $dt->row();
    }
    
    function get_row_kabkot($id){
        $this->db->select('nama_kota');
        $this->db->where('id_kabkot',$id);
        $dt=$this->db->get('t_kabkot');
        $h='';
        if($dt->row()){
            $h=$dt->row()->nama_kota;
        }
        return $h;
    }
    
    function penbas_data($tbl,$kat,$thn,$bln){
        $this->db->where('kat_peneliti',$kat);
        $this->db->where('user_input',$this->session->username);
        $this->db->where("DATE_FORMAT(tgl_pelaksanaan,'%Y-%m')",$thn.'-'.$bln);
        $this->db->order_by('tgl_input','ASC');
        $dt=$this->db->get($tbl);
        return $dt->result();
    }
    
    function majalah_data($tbl,$kat,$thn,$bln){
        $this->db->where('kat',$kat);
        $this->db->where('user_input',$this->session->username);
        //$this->db->where("DATE_FORMAT(tgl_input,'%Y-%m')",$thn.'-'.$bln);
        $this->db->where('bln_pelaksanaan',$bln);
        $this->db->where('thn_pelaksanaan',$thn);
        $this->db->order_by('tgl_input','DESC');
        $dt=$this->db->get($tbl);
        return $dt->result();
    }
    
    function duta_bhs_data($tbl,$kat,$thn,$bln){
        $this->db->where('kat',$kat);
        $this->db->where('user_input',$this->session->username);
        $this->db->where("DATE_FORMAT(tgl_input,'%Y-%m')",$thn.'-'.$bln);
        $this->db->order_by('tgl_input','DESC');
        $dt=$this->db->get($tbl);
        return $dt->result();
    }
    
    function get_data_lap($tbl,$thn,$bln){
        $this->db->where('user_input',$this->session->username);
        $this->db->where("DATE_FORMAT(tgl_pelaksanaan,'%Y-%m')",$thn.'-'.$bln);
        $this->db->order_by('tgl_input','ASC');
        $dt=$this->db->get($tbl);
        return $dt->result();
    }
    
    function get_karyailmiah($tbl,$thn,$bln){
        $this->db->where('user_input',$this->session->username);
        $this->db->where('bln_pelaksanaan',$bln);
        $this->db->where('tahun',$thn);
        $this->db->order_by('tgl_input','ASC');
        $dt=$this->db->get($tbl);
        return $dt->result();
    }
    
    function get_bln_thn($tbl,$thn,$bln){
        $this->db->where('user_input',$this->session->username);
        $this->db->where('bln_pelaksanaan',$bln);
        $this->db->where('thn_pelaksanaan',$thn);
        $this->db->order_by('tgl_input','ASC');
        $dt=$this->db->get($tbl);
        return $dt->result();
    }
    
    function get_Produkname($id){
        if($id == '0'){
            $p='Produk Pusat';
        }else if($id == '1'){
            $p='Produk Balai/Kantor';
        }else if($id == '2'){
            $p='Produk Luar';
        }else{
            $p='-';
        }
        return $p;
    }
    function run_query($tbl,$thn,$bln){
        $dt=$this->db->query("select * from $tbl where DATE_FORMAT(tgl_input,'%Y-%m')='$thn-$bln' ORDER BY tgl_input DESC");
        //$dt=$this->db->get();
        return $dt->result();
    }
}