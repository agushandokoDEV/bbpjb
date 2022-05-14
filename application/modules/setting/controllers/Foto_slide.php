<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Foto_slide extends CI_Controller{
    
    function __construct(){
        parent::__construct();
         $this->load->model('M_slide');
    }
    public function index()
	{
        $this->load->view('slide/page_index');
	}
    
    function get_slide(){
        if($this->input->is_ajax_request()){
            $data['dt_slide']=$this->M_slide->get_slide();
            $this->load->view('slide/ajax_get_slide',$data);
        }else{
            show_404();
        }
    }
    function uploading(){
        if($this->input->is_ajax_request()){
                $foto=$_FILES['foto'];
                $dt_foto=array();
                //echo '<pre>';
                //print_r($foto);
                if($foto['type'] === 'image/jpeg' || $foto['type'] === 'image/png'){
                    if($foto['size'] > 1000000){
                        $dt_foto['error']='Ukuran file teralul besar';
                        $dt_foto['status']=0;
                    }else{
                        $config['upload_path'] = 'common/album/slide/';
                		$config['allowed_types'] = 'jpg|png';
                		//$config['max_size']	= '1500';
                		//$config['max_width']  = '1024';
                		//$config['max_height']  = '768';
                        
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if (! $this->upload->do_upload('foto'))
                        {
                            $error = array('error' => $this->upload->display_errors());
                            $notif=$this->upload->display_errors();
                            $dt_foto['error']=$notif;
                        }
                        else
                        {   
                            $img_data=(object)$this->upload->data();             
                            //echo '<pre>';
                            //print_r($img_data);
                            $dt_foto['path']=site_url('common/album/slide/'.$img_data->file_name);
                            //$dt_foto['type']=$img_data->file_type;
                            $dt_foto['status']=1;
                            $dt_ins=array('foto'=>$img_data->file_name);
                            $this->db->insert('foto_slide',$dt_ins);
                        }
                    }
                }else{
                    $dt_foto['error']='Format tidak valid';
                    $dt_foto['status']=0;
                }
                echo json_encode($dt_foto);
        }else{
            show_404();
        }
    }
    
    public function hapus()
	{
	   if($this->input->is_ajax_request())
       {
            $key=$this->input->post('key');
            $fname=$this->input->post('fname');
            $this->M_slide->del_slide($key);
            $path='./common/album/slide/'.$fname;
            unlink($path);
            echo json_encode(array("status" => TRUE));
       }
	}
}