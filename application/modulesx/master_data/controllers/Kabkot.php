<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabkot extends CI_Controller {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_kabkot');
	}
    
    public function index()
	{
        $this->load->view('kabkot/page_index');
	}
    
    public function add()
	{
        $this->load->view('kabkot/page_add');
	}
    public function checked(){
        if($this->input->is_ajax_request()){
            $val=$this->input->post('nm_kota');
            $checkd=$this->M_kabkot->get_row('nama_kota',$val);
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
    
    public function do_add()
	{
        if($this->input->method() == 'post'){
            $nm_kota=$this->input->post('nm_kota');
            $kordinat=$this->input->post('kordinat');
            $data=array('nama_kota'=>$nm_kota,'coord'=>$kordinat);
            if($this->db->insert('t_kabkot',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data Kabupaten/Kota berhasil ditambahkan..'));
            }
            redirect('master_data/kabkot');
        }else{
            show_404();
        }
	}
    
    public function upd($id=null)
	{
        if($id!=null){
            $data['dt_row']=$this->M_kabkot->get_row('id_kabkot',$id);
            $this->load->view('kabkot/page_upd',$data);
        }else{
            show_404();
        }
	}
    public function do_upd()
	{
        if($this->input->method() == 'post'){
            $id=$this->input->post('id_kabkot');
            $kabkot=$this->input->post('nm_kota');
            $kordinat=$this->input->post('kordinat');
            $data=array('nama_kota'=>$kabkot,'coord'=>$kordinat);
            if($this->M_kabkot->get_upd($id,$data)){
                $this->session->set_flashdata('notif',alert('success','Update Kabupaten/Kota '.$kabkot.' berhasil'));
            }
            redirect('master_data/kabkot');
        }else{
            show_404();
        }
	}
    
    public function ajax_list()
	{
		if ($this->input->is_ajax_request()){
           $list = $this->M_kabkot->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = ucwords($val->nama_kota);
                $ac="'".$val->id_kabkot."'";
                $row[] = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("master_data/kabkot/upd/".$val->id_kabkot).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>';
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_kabkot->count_all(),
    					"recordsFiltered" => $this->M_kabkot->count_filtered(),
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
            $this->M_kabkot->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
       }
	}
}