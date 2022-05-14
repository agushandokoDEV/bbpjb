<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_majalah extends CI_Model{
    
    private $table = "t_majalah";
    private $column=array('id_majalah','judul','bln_pelaksanaan','tim_redaksi','volume','no_issn','penerbit','info_produk');
    private $order = array('judul' => 'ASC');
    private $pk='id_majalah';
    
    function get_row($field,$val)
    {
        $this->db->where('kat','m');
        $this->db->where('user_input',$this->session->username);
        $this->db->where($field,$val);
        $dt=$this->db->get($this->table);
        return $dt->row();
    }
    function get_upd($val,$dt)
    {
        $this->db->where($this->pk,$val);
        $this->db->where('kat','m');
        $this->db->where('user_input',$this->session->username);
        $this->db->update($this->table,$dt);
    }
    function get_kabkot()
    {
        $this->db->select('id_kabkot,nama_kota');
        $this->db->order_by('nama_kota','ASC');
        $dt=$this->db->get('t_kabkot');
        return $dt->result();
    }
    private function _get_datatables_query()
	{
		
		$this->db->where('t_majalah.kat','m');
        $this->db->where('user_input',$this->session->username);
        $this->db->from($this->table);
        //$this->db->join('t_kabkot','t_kabkot.id_kabkot=t_majalah.id_kabkot','LEFT');
		$i = 0;
	
		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}
		
		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatables()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->where('kat','m');
        $this->db->where('user_input',$this->session->username);
        $this->db->from($this->table);
		return $this->db->count_all_results();
	}
    
    public function delete_by_id($id)
	{
		$this->db->where($this->pk, $id);
        $this->db->where('kat','m');
        $this->db->where('user_input',$this->session->username);
		$this->db->delete($this->table);
	}
    
    public function del_lap_id($id)
	{
		$this->db->where('id_pk', $id);
        $this->db->where('username',$this->session->username);
		$this->db->where('tbl_data',$this->table);
        $this->db->delete('t_laporan');
	}
    
    // IMPORT
    function get_total($stts_import=null){
        $this->db->select('count(*) as total');
        $this->db->where('user_input',$this->session->username);
        $this->db->where('kat','m');
        if($stts_import != null){
            $this->db->where('stts_import',$stts_import);
            $this->db->where("DATE_FORMAT(tgl_input,'%Y-%m')",date('Y-m'));
        }
        $dt=$this->db->get($this->table)->row();
        return $dt->total;
    }
    
    private function get_curent_import(){
        $this->db->select('id_majalah');
        $this->db->where('kat','m');
        $this->db->where("DATE_FORMAT(tgl_input,'%Y-%m')",date('Y-m'));
        $this->db->where('user_input',$this->session->username);
        $this->db->where('stts_import','1');
        $dt=$this->db->get($this->table);
        return $dt->result();
    }
    
    private function del_import_lap(){
        $in=array();
        $id_key=$this->get_curent_import();
        foreach($id_key as $id_key){
            $in[]=$id_key->id_majalah;
        }
        $this->db->where_in('id_pk',$in);
        $this->db->where('tbl_data',$this->table);
        $this->db->delete('t_laporan');
    }
    
    function del_import(){
        $this->del_import_lap();
        $this->db->where('kat','m');
        $this->db->where("DATE_FORMAT(tgl_input,'%Y-%m')",date('Y-m'));
        $this->db->where('user_input',$this->session->username);
        $this->db->where('stts_import','1');
        $this->db->delete($this->table);
    }
    
    // update tgl input untuk lap grafik
    function upd_tgl_input($id_pk,$tgl){
        $dt=array('tgl_input'=>$tgl);
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->where('id_pk',$id_pk);
        $this->db->where('tbl_data',$this->table);
        $this->db->update('t_laporan',$dt);
    }
}