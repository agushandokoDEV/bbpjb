<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_adm_users extends CI_Model{
    
    private $table = "adm_users";
    private $column = array('username','nama_user','nama_role');
    private $order = array('username' => 'ASC');
    
    
    function get_row($field,$val)
    {
        $this->db->where($field,$val);
        $dt=$this->db->get($this->table);
        return $dt->row();
    }
    function get_role(){
        if($this->session->userdata('id_role') == '3'){
            $this->db->where_not_in('id_role',array('1','2'));
        }
        $dt=$this->db->get('adm_role');
        return $dt->result();
    }
    function get_upd($val,$dt)
    {
        $this->db->where('username',$val);
        $this->db->update($this->table,$dt);
    }
    private function _get_datatables_query()
	{
		
		$this->db->from($this->table);
        $this->db->join('adm_role','adm_role.id_role=adm_users.id_role');
        if($this->session->userdata('id_role') == '3'){
            $this->db->where_not_in('adm_users.id_role',array('1','2'));
        }
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
		$this->db->where('username', $id);
		$this->db->delete($this->table);
	}
}