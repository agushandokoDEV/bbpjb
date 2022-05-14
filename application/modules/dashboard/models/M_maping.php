<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_maping extends CI_Model{
    
    function get_map(){
        $dt=$this->db->get('t_kabkot');
        return $dt->result();
    }
    function menu_name($id){
        $this->db->where('id_menu',$id);
        $dt=$this->db->get('adm_menu');
        return $dt->row();
    }
    function kota_name($id){
        $this->db->select('nama_kota');
        $this->db->where('id_kabkot',$id);
        $dt=$this->db->get('t_kabkot');
        return $dt->row();
    }
    
    function get_map_view($id_menu){
        $this->db->where('id_menu',$id_menu);
        $dt=$this->db->get('t_maping');
        return $dt->row();
    }
    
    function get_map_count($tbl,$kabkot,$thn){
        $this->db->select('count(*) as jumlah');
        $this->db->where('id_kabkot',$kabkot);
        $this->db->where('tahun',$thn);
        $dt=$this->db->get($tbl);
        return $dt->row();
    }
    
    function get_map_alldata($tbl,$thn){
        $this->db->where('tahun',$thn);
        $dt=$this->db->get($tbl);
        return $dt->result();
    }
    
    function get_map_data($tbl,$kabkot,$thn){
        $this->db->where('id_kabkot',$kabkot);
        $this->db->where('tahun',$thn);
        $dt=$this->db->get($tbl);
        return $dt->result();
    }
    
    function get_name_alldata($id_menu){
        $this->db->where('id_menu',$id_menu);
        $dt=$this->db->get('t_maping');
        return $dt->row();
    }
    
    function get_map_jurnal($kabkot,$thn,$kat){
        $this->db->select('count(*) as jumlah');
        $this->db->where('id_kabkot',$kabkot);
        $this->db->where('kat',$kat);
        $this->db->where('tahun',$thn);
        $dt=$this->db->get('t_majalah');
        return $dt->row();
    }
    
    function get_data_alljurnal($thn,$kat){
        $this->db->where('kat',$kat);
        $this->db->where('tahun',$thn);
        $dt=$this->db->get('t_majalah');
        return $dt->result();
    }
    
    function get_data_jurnal($kabkot,$thn,$kat){
        $this->db->join('t_kabkot','t_kabkot.id_kabkot=t_majalah.id_kabkot','LEFT');
        $this->db->where('t_majalah.id_kabkot',$kabkot);
        $this->db->where('t_majalah.kat',$kat);
        $this->db->where('t_majalah.tahun',$thn);
        $dt=$this->db->get('t_majalah');
        return $dt->result();
    }
    
    function get_all_dtbhs($thn,$kat,$kabkot=null){
        if($kabkot != null){
            $this->db->where('id_kabkot',$kabkot);
        }
        $this->db->where('kat',$kat);
        $this->db->where('tahun',$thn);
        $dt=$this->db->get('duta_bahasa');
        return $dt->result();
    }
    
    function get_map_count_dtbhs($kat,$kabkot,$thn){
        $this->db->select('count(*) as jumlah');
        $this->db->where('id_kabkot',$kabkot);
        $this->db->where('tahun',$thn);
        $this->db->where('kat',$kat);
        $dt=$this->db->get('duta_bahasa');
        return $dt->row();
    }
    
    function get_map_penbas($kat,$thn,$kabkot=null){
        if($kabkot != null){
            $this->db->where('id_kabkot',$kabkot);
        }
        $this->db->where('tahun',$thn);
        $this->db->where('kat_peneliti',$kat);
        $dt=$this->db->get('t_penelitian_bas');
        return $dt->result();
    }
    
    function get_map_penbas_count($kat,$kabkot,$thn){
        $this->db->select('count(*) as jumlah');
        $this->db->where('id_kabkot',$kabkot);
        $this->db->where('tahun',$thn);
        $this->db->where('kat_peneliti',$kat);
        $dt=$this->db->get('t_penelitian_bas');
        return $dt->row();
    }
}