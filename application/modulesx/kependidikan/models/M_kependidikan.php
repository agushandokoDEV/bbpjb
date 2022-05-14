<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_kependidikan extends CI_Model{
    
    private $table = "t_kependidikan";
    private $column=array('no','nama_sekolah','nama_kota','kec','jum_pengajar','stts_sekolah');
    private $order = array('nama' => 'ASC');
    private $pk='id_kependidikan';
    
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
        $this->db->select('id_kabkot,nama_kota');
        $this->db->order_by('nama_kota','ASC');
        $dt=$this->db->get('t_kabkot');
        return $dt->result();
    }
    private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
        $this->db->join('t_kabkot','t_kabkot.id_kabkot=t_kependidikan.id_kabkot','LEFT');
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