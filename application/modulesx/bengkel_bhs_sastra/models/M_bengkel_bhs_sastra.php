<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_bengkel_bhs_sastra extends CI_Model{
    
    private $table = "bengkel_bhs_sastra";
    private $column=array(
                    'nama_kota',
                    'kat',
                    'nama_keg',
                    'tgl_mulai',
                    'tgl_selesai',
                    'pematri',
                    'jum_peserta',
                    'peserta',
                    'nama_lembaga');
    private $order = array('nama_keg' => 'ASC');
    private $pk='id_bhs_sastra';
    
    function get_row($field,$val)
    {
        $this->db->where($field,$val);
        $dt=$this->db->get($this->table);
        return $dt->row();
    }
    function get_upd($val,$dt)
    {
        $this->db->where($this->pk,$val);
        return $this->db->update($this->table,$dt);
    }
    function get_kabkot()
    {
        $dt=$this->db->get('t_kabkot');
        return $dt->result();
    }
    function get_kabkot_row($id)
    {
        $this->db->select('id_kabkot,nama_kota');
        $this->db->where('id_kabkot',$id);
        $dt=$this->db->get('t_kabkot');
        return $dt->row();
    }
    private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
        $this->db->join('t_kabkot','t_kabkot.id_kabkot=bengkel_bhs_sastra.id_kabkot','LEFT');
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
		return $this->db->count_all_results();
	}
    
    public function delete_by_id($id)
	{
		$this->db->where($this->pk, $id);
		$this->db->delete($this->table);
	}
}