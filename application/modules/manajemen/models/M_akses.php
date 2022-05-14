<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_akses extends CI_Model {
    
    function get_role(){
        if($this->session->userdata('id_role') == '3'){
            $this->db->where_not_in('id_role',array('1','2'));
        }
        $dt=$this->db->get('adm_role');
        return $dt->result();
    }
    
	function getMenuHead($sub)
	{
		$this->db->where('sub', $sub);
		return $this->db->get('adm_menu')->result();
	}
	function cekAkses($ro,$id)
	{
		$this->db->where('id_menu', $id);
		$this->db->where('id_role', $ro);
		return $this->db->get('adm_akses');
	}
	function beri($num,$id,$role)
	{
		$this->db->where('id_menu', $id);
		$this->db->where('id_role', $role);
		$this->db->update('adm_akses', array('status'=>$num));
	}
    
    function getheadAkses()
	{
		$aks=array('28','29');
        $this->db->where_in('id_menu', $aks);
		return $this->db->get('adm_menu')->result();
	}
}

/* End of file m_akses.php */
/* Location: ./application/modules/akses/models/m_akses.php */