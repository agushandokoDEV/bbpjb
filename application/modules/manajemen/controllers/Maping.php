<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Maping extends Userauth {
    
	public function __construct()
	{
		parent::__construct();
        $this->set_user_group(array('1','2'));
		$this->load->model('M_maping');
	}
    
    function index(){
        $data['dt_menu']=$this->M_maping->get_data();
        $this->load->view('maping/page_index',$data);
    }
    
    function add(){
        $data['mn_par']=$this->M_maping->getMenu();
        $this->load->view('maping/page_add',$data);
    }
    
    function do_add(){
        $id_menu=$this->input->post('id_menu');
        $parent=$this->input->post('parent');
        $views=$this->input->post('views');
        $func=$this->input->post('func');
        $tbl=$this->input->post('tbl');
        $map=$this->input->post('map');
        $map_alldata=$this->input->post('map_alldata');
        $data=array(
            'id_menu'=>$id_menu,
            'views'=>$views,
            'function'=>$func,
            'table'=>$tbl,
            'map'=>$map,
            'map_alldata'=>$map_alldata,
            'parent'=>$parent
        );
        $this->db->insert('t_maping',$data);
        redirect('manajemen/maping');
    }
    
    function upd($id){
        $data['mn_par']=$this->M_maping->getMenu();
        $data['dt_row']=$this->M_maping->get_data_row($id);
        $this->load->view('maping/page_upd',$data);
    }
    
    function do_upd(){
        $id_menu=$this->input->post('id_menu');
        $parent=$this->input->post('parent');
        $views=$this->input->post('views');
        $func=$this->input->post('func');
        $tbl=$this->input->post('tbl');
        $map=$this->input->post('map');
        $map_alldata=$this->input->post('map_alldata');
        $id=$this->input->post('id_maping');
        $data=array(
            'id_menu'=>$id_menu,
            'views'=>$views,
            'function'=>$func,
            'table'=>$tbl,
            'map'=>$map,
            'map_alldata'=>$map_alldata,
            'parent'=>$parent
        );
        $this->M_maping->get_upd_row($id,$data);
        redirect('manajemen/maping');
    }
    
    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_maping->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));

        }else{
            show_404();
        }
	}
}