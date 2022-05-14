<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Question extends CI_Controller {
    
    function __construct(){
	   parent::__construct();
       $this->load->helper('text');
       $this->load->model('M_ques');
    }

    public function index(){
        $data['dt_post']=$this->M_ques->get_post();
        if($this->session->userdata('logged_in') == 1){
            $this->load->view("page_index",$data);
        }else{
            $this->load->view("frontend/page_index",$data);
        }
	}
    
    function add_posting(){
        if($this->input->is_ajax_request()){
            $nama=$this->input->post('nama');
            $isi=$this->input->post('isi');
            $tgl=date('Y-m-d');
            
            $dt_post=array(
                'nama'=>$nama,
                'isi'=>$isi,
                'tgl'=>$tgl
            );
            if($this->db->insert('dev_ques',$dt_post)){
                $id=$this->db->insert_id();
                $data['dt_post']=$this->M_ques->get_last_post($id);
                $this->load->view('load_post',$data);
            }else{
                echo '0';
            }
            
        }
    }
    
    public function detail($id=''){
        $data['p']=$this->M_ques->get_last_post($id);
        $data['dt_kom']=$this->M_ques->get_komentar($id);
        $data['dt_jumkom']=$this->M_ques->get_jum_komentar($id);
        if($this->session->userdata('logged_in') == 1){
            $this->load->view("page_dtl",$data);
        }else{
            $this->load->view("frontend/page_dtl",$data);
        }
	}
    
    function add_komentar(){
        if($this->input->is_ajax_request()){
            $nama=$this->input->post('nama');
            $isi=$this->input->post('isi');
            $id_post=$this->input->post('id_post');
            $tgl=date('Y-m-d');
            
            $dt_post=array(
                'nama'=>$nama,
                'komentar'=>$isi,
                'tgl_komentar'=>$tgl,
                'id_posting'=>$id_post
            );
            if($this->db->insert('dev_komentar',$dt_post)){
                $id=$this->db->insert_id();
                $data['dt_kom']=$this->M_ques->get_last_komentar($id,$id_post);
                $data['dt_jumkom']=$this->M_ques->get_jum_komentar($id_post);
                $this->load->view('load_komen',$data);
            }else{
                echo '0';
            }
            
        }
    }
    
    function get_jumkom(){
        if($this->input->is_ajax_request()){
            $id_post=$this->input->post('id_post');
            $jum=$this->M_ques->get_jum_komentar($id_post);
            echo $jum->jumlah;
        }
    }
}