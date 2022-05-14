<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kota extends Userauth{
    
    function __construct(){
        parent::__construct();
        $this->load->model('M_kota');
        $this->load->library('pagination');
    }
    
    function index($id='',$thn=''){
        if($id !=''){
            $config['base_url'] = base_url().'kegiatan/kota/index/'.$id.'/'.$thn;
            $config['total_rows'] = count($this->M_kota->get_keg($id,$thn));
            $config['per_page'] = '10';
            $config['page_query_string']=TRUE;
            $config['full_tag_open'] = "<ul class='pagination'>";
            $config['full_tag_close'] ="</ul>";
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            
            $this->pagination->initialize($config);
            $data['halaman'] = $this->pagination->create_links();
            $data['dt_keg'] = $this->M_kota->get_keg($id,$thn,$config['per_page'], $this->input->get('per_page'));
            $data['dt_kota']=$this->M_kota->get_kota($id);
            $data['thn']=$thn;
            $this->load->view('kota/page_index',$data);
        }else{
            show_404();
        }
    }
}