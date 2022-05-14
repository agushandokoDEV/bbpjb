<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_pen_sastra extends CI_Model{
    
    private $table = "t_penelitian_bas";
    private $column=array('id_penelitian','nama_kota','tgl_pelaksanaan','peneliti','judul','tgl_mulai','tgl_selesai','lama_penelitian','publikasi','thn_terbit');
    private $order = array('peneliti' => 'ASC');
    private $pk='id_penelitian';
    
    function get_row($field,$val)
    {
        $this->db->where($field,$val);
        $this->db->where('kat_peneliti','sastra');
        $this->db->where('user_input',$this->session->username);
        $dt=$this->db->get($this->table);
        return $dt->row();
    }
    function get_upd($val,$dt)
    {
        $this->db->where($this->pk,$val);
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
		
		$this->db->from($this->table);
        $this->db->join('t_kabkot','t_kabkot.id_kabkot=t_penelitian_bas.id_kabkot','LEFT');
        $this->db->where('t_penelitian_bas.kat_peneliti','sastra');
        $this->db->where('t_penelitian_bas.user_input',$this->session->username);
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
		$this->db->from($this->table);
        $this->db->where('user_input',$this->session->username);
		return $this->db->count_all_results();
	}
    
    public function delete_by_id($id)
	{
		$this->db->where($this->pk, $id);
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
    
    // update tgl input untuk lap grafik
    function upd_tgl_input($id_pk,$tgl){
        $dt=array('tgl_input'=>$tgl);
        $this->db->where('username', $this->session->userdata('username'));
        $this->db->where('id_pk',$id_pk);
        $this->db->where('tbl_data',$this->table);
        $this->db->update('t_laporan',$dt);
    }
}