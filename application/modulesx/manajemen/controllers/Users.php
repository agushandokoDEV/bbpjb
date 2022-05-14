<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_adm_users');
	}
    
    public function index()
	{
        $this->load->view('users/page_index');
	}
    public function ajax_list()
	{
		if ($this->input->is_ajax_request()){
           $list = $this->M_adm_users->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $val->username;
                $row[] = ucwords($val->nama_user);
                $row[] = ucwords($val->nama_role);
                $ac="'".$val->username."'";
                $row[] = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("manajemen/users/upd/".$val->username).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>';
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_adm_users->count_all(),
    					"recordsFiltered" => $this->M_adm_users->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}
    public function add()
	{
        $data['dt_role']=$this->M_adm_users->get_role();
        $this->load->view('users/page_add',$data);
	}
    
    public function do_add()
	{
        if($this->input->method() == 'post'){
            $nm_role=$this->input->post('nm_role');
            $nm_lengkap=$this->input->post('nm_lengkap');
            $email=$this->input->post('email');
            $username=$this->input->post('username');
            $password=md5('admin');
            $data=array(
                'id_role'=>$nm_role,
                'username'=>$username,
                'nama_user'=>$nm_lengkap,
                'email'=>$email,
                'id_role'=>$nm_role,
                'password'=>$password
            );
            if($this->db->insert('adm_users',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data user berhasil ditambahkan..'));
            }
            redirect('manajemen/users');
        }else{
            show_404();
        }
	}
    public function username_checked(){
        if($this->input->is_ajax_request()){
            $username=$this->input->post('username');
            $checkd=$this->M_adm_users->get_row('username',$username);
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
    
    public function upd($id=null)
	{
        if($id!=null){
            $data['dt_row']=$this->M_adm_users->get_row('username',$id);
            $data['dt_role']=$this->M_adm_users->get_role();
            $this->load->view('users/page_upd',$data);
        }else{
            show_404();
        }
	}
    
    public function do_upd()
	{
        if($this->input->method() == 'post'){
            $nm_role=$this->input->post('nm_role');
            $nm_lengkap=$this->input->post('nm_lengkap');
            $email=$this->input->post('email');
            $username=$this->input->post('username');
            $data=array(
                'id_role'=>$nm_role,
                'nama_user'=>$nm_lengkap,
                'email'=>$email,
                'id_role'=>$nm_role
            );
            if($this->M_adm_users->get_upd($username,$data)){
                $this->session->set_flashdata('notif',alert('info','OK !!! data users '.$nm_lengkap.' berhasil diupdate..'));
            }
            redirect('manajemen/users');
        }else{
            show_404();
        }
	}
    public function hapus()
	{
	   if($this->input->is_ajax_request())
       {
            $key=$this->input->post('key');
            $this->M_adm_users->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
       }
	}
}