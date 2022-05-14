<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_import extends CI_Model{
    
    private $tabel='t_penelitian_bas';
    private $pk='id_penelitian';
    
    function get_total($kat,$stts_import=null){
        $this->db->select('count(*) as total');
        $this->db->where('user_input',$this->session->username);
        $this->db->where('kat_peneliti',$kat);
        if($stts_import != null){
            $this->db->where('stts_import',$stts_import);
            $this->db->where("DATE_FORMAT(tgl_input,'%Y-%m')",date('Y-m'));
        }
        $dt=$this->db->get($this->tabel)->row();
        return $dt->total;
    }
    
    private function get_curent_import($kat){
        $this->db->select('id_penelitian');
        $this->db->where("DATE_FORMAT(tgl_input,'%Y-%m')",date('Y-m'));
        $this->db->where('user_input',$this->session->username);
        $this->db->where('kat_peneliti',$kat);
        $this->db->where('stts_import','1');
        $dt=$this->db->get($this->tabel);
        return $dt->result();
    }
    
    private function del_import_lap($kat){
        $in=array();
        $id_key=$this->get_curent_import($kat);
        foreach($id_key as $id_key){
            $in[]=$id_key->id_penelitian;
        }
        $this->db->where_in('id_pk',$in);
        $this->db->where('tbl_data',$this->tabel);
        $this->db->delete('t_laporan');
    }
    
    function del_import($kat){
        $this->del_import_lap($kat);
        $this->db->where("DATE_FORMAT(tgl_input,'%Y-%m')",date('Y-m'));
        $this->db->where('user_input',$this->session->username);
        $this->db->where('kat_peneliti',$kat);
        $this->db->where('stts_import','1');
        $this->db->delete($this->tabel);
    }
}