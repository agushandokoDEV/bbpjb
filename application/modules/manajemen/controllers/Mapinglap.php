<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapinglap extends Userauth {
    
	public function __construct()
	{
		parent::__construct();
        $this->set_user_group(array('1','2'));
		$this->load->model('M_mapinglap');
	}
    
    function index(){
        $data['dt_menu']=$this->M_mapinglap->get_data();
        $this->load->view('mapinglap/page_index',$data);
    }
    
    function add(){
        $data['mn_par']=$this->M_mapinglap->getMenu();
        $this->load->view('mapinglap/page_add',$data);
    }
    
    function do_add(){
        $menu_sub=$this->input->post('menu_sub');
        $parent=$this->input->post('parent');
        $query=$this->input->post('query');
        $field=$this->input->post('field');
        $url=$this->input->post('url');
        $data=array(
            'menu_par'=>$parent,
            'menu_sub'=>$menu_sub,
            'query'=>$query,
            'field'=>$field,
            'url'=>$url
        );
        $this->db->insert('t_mapinglap',$data);
        redirect('manajemen/mapinglap');
    }
    
    function upd($id=''){
        $data['mn_par']=$this->M_mapinglap->getMenu();
        $data['dt_row']=$this->M_mapinglap->get_data_row($id);
        $this->load->view('mapinglap/page_upd',$data);
    }
    
    function do_upd(){
        $menu_sub=$this->input->post('menu_sub');
        $parent=$this->input->post('parent');
        $id=$this->input->post('id_key');
        $query=$this->input->post('query');
        $field=$this->input->post('field');
        $url=$this->input->post('url');
        $data=array(
            'menu_par'=>$parent,
            'menu_sub'=>$menu_sub,
            'query'=>$query,
            'field'=>$field,
            'url'=>$url
        );
        $this->M_mapinglap->get_upd_row($id,$data);
        redirect('manajemen/mapinglap');
    }
    
    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_mapinglap->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));

        }else{
            show_404();
        }
	}
}