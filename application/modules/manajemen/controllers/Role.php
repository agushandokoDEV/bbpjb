<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Role extends Userauth {

	function __construct(){
	   parent::__construct();
       $this->set_user_group(array('1','2','3'));
       $this->load->model('M_adm_role');
	}
    
    public function index()
	{
        $this->load->view('role/page_index');
	}
    public function ajax_list()
	{
		if ($this->input->is_ajax_request()){
           $list = $this->M_adm_role->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                //$row[] = $val->id_role;
                $row[] = ucwords($val->nama_role);
                $ac="'".$val->id_role."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("manajemen/role/upd/".$val->id_role).'" title="Edit"><i class="fa fa-edit"></i></a>';
                
                if($this->session->userdata('id_role') == '1'){
                    $action .='
                        <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                    ';
                }
                $row[]=$action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_adm_role->count_all(),
    					"recordsFiltered" => $this->M_adm_role->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}
    
    public function hapus()
	{
	   if($this->input->is_ajax_request())
       {
            $key=$this->input->post('key');
            $this->M_adm_role->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
       }
	}
    public function checked(){
        if($this->input->is_ajax_request()){
            $nm_role=$this->input->post('nm_role');
            $checkd=$this->M_adm_role->get_row('nama_role',$nm_role);
            if($checkd != null){
                $r=false;
            }else{
                $r=true;
            }
            echo json_encode(array('valid'=>$r));
        }else{
            show_404();
        }
    }
    public function add()
	{
        $this->load->view('role/page_add');
	}
    public function do_add()
	{
        if($this->input->method() == 'post'){
            $nm_role=$this->input->post('nm_role');
            $data=array('nama_role'=>$nm_role);
            if($this->db->insert('adm_role',$data)){
                //$this->session->set_flashdata('notif','<div class="alert alert-success"><span class="glyphicon glyphicon-info-sign"></span> OK !!! data role berhasil ditambahkan..</div>');
                $this->session->set_flashdata('notif',alert('success','OK !!! data role berhasil ditambahkan..'));
            }
            redirect('manajemen/role');
        }else{
            show_404('');
        }
	}
    public function upd($id=null)
	{
        if($id!=null){
            $data['dt_row']=$this->M_adm_role->get_row('id_role',$id);
            $this->load->view('role/page_upd',$data);
        }else{
            show_404();
        }
	}
    public function do_upd()
	{
        if($this->input->method() == 'post'){
            $id=$this->input->post('id_role');
            $nm_role=$this->input->post('nm_role');
            $data=array('nama_role'=>$nm_role);
            $this->M_adm_role->get_upd($id,$data);
            $this->session->set_flashdata('notif',alert('info','OK !!! Update role berhasil..'));
            redirect('manajemen/role');
        }else{
            show_404();
        }
	}
}