<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Berita extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->set_user_group(array('1','2','3'));
       $this->load->model('M_berita');
       $this->load->helper('text');
    }

    public function index(){
        $data['dt_b']=$this->M_berita->get_data();
		$this->load->view("berita/page_index",$data);
	}

    public function add(){
		$this->load->view("berita/page_add");
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $this->load->library('Slug');
            $judul=$this->input->post('judul');
            $slug=$this->slug->seoUrl($judul);
            $isi=$this->input->post('isi');
            $tgl=date('Y-m-d');
            $filename=null;
            $urlimg=$this->input->post('urlimg');
            if($urlimg != ''){
                $url=$urlimg;
            }else{
                $config['upload_path'] = 'common/album/slide/';
        		$config['allowed_types'] = 'jpg|png';
        		//$config['max_size']	= '1500';
        		//$config['max_width']  = '1024';
        		//$config['max_height']  = '768';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (! $this->upload->do_upload('uplimg'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    $notif=$this->upload->display_errors();
                    $this->session->set_flashdata('notif',alert('danger',$notif));
                    redirect('manajemen/berita');
                    exit;                
                    //$dt_foto['error']=$notif;
                }
                else
                {   
                    $img_data=(object)$this->upload->data();
                    $this->load->library('Gambar');
                    $this->gambar->set_path('slide');
                    $this->gambar->img_thub($img_data->file_name);
                    $filename=$img_data->file_name;
                    $url=site_url('common/album/slide/'.$img_data->file_name);
                }
            }
            $dt_ins=array(
                'foto'=>$filename,
                'judul'=>$judul,
                'isi'=>$isi,
                'tgl'=>$tgl,
                'slug'=>$slug,
                'url_img'=>$url
            );
            //echo_pre($dt_ins);
            $this->db->insert('t_berita',$dt_ins);
            $this->session->set_flashdata('notif',alert('success','OK !!! berita terbaru berhasil tersimpan...'));
            redirect('manajemen/berita');
        }else{
            show_404();
        }
    }

    public function upd($id=''){
		$data['dt_row']=$this->M_berita->get_row($id);
        $this->load->view("berita/page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $this->load->library('Slug');
            $judul=$this->input->post('judul');
            $slug=$this->slug->seoUrl($judul);
            $isi=$this->input->post('isi');
            $id_key=$this->input->post('id_key');
            $fotox=$_FILES['uplimg']['name'];
            $filename=null;
            
            $dt_ins=array(
                'judul'=>$judul,
                'isi'=>$isi,
                'slug'=>$slug
            );
            
            $url_img=$this->input->post('urlimg');
            if(!empty($fotox)){
                $config['upload_path'] = 'common/album/slide/';
        		$config['allowed_types'] = 'jpg|png';
        		//$config['max_size']	= '1500';
        		//$config['max_width']  = '1024';
        		//$config['max_height']  = '768';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (! $this->upload->do_upload('uplimg'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    $notif=$this->upload->display_errors();
                    $this->session->set_flashdata('notif',alert('danger',$notif));
                    redirect('manajemen/berita');
                    exit;                
                    //$dt_foto['error']=$notif;
                }
                else
                {   
                    $img_data=(object)$this->upload->data();
                    $this->load->library('Gambar');
                    $this->gambar->set_path('slide');
                    $this->gambar->img_thub($img_data->file_name);
                    $dt_ins['foto']=$img_data->file_name;
                    $dt_ins['url_img']=site_url('common/album/slide/'.$img_data->file_name);
                }
            }else if($url_img != ''){
                $dt_ins['foto']=null;
                $dt_ins['url_img']=$url_img;
            }
            
            //echo_pre($fotox);
            $this->M_berita->upd_row($id_key,$dt_ins);
            $this->session->set_flashdata('notif',alert('success','OK !!! update berita terbaru berhasil tersimpan...'));
            redirect('manajemen/berita');
            
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            //$fname=$this->M_berita->get_row($key);
            //$path='./common/album/slide/';
            //unlink($path.$fname->foto);
            //unlink($path.'thumb/'.$fname->foto);
            $this->M_berita->del_row($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}