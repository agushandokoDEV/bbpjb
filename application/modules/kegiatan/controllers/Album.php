<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Album extends Userauth
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_album");
    }

    public function list_album($id='')
	{
		$data['dt_alb']=$this->M_album->get_album($id);
        $data['dt_keg']=$this->M_album->get_row_keg($id);
        $this->load->view("album/page_index",$data);
	}
    
    function do_add(){
        if($this->input->is_ajax_request()){
                $this->load->library('gambar');
                $this->gambar->set_path('kegiatan');
                $foto=$_FILES['foto'];
                $dt_foto=array();
                //echo '<pre>';
                //print_r($foto);
                $id_keg=$this->input->post('id_keg');
                $jdl_keg=$this->input->post('jdl_keg');
                if($foto['type'] === 'image/jpeg' || $foto['type'] === 'image/png'){
                    if($foto['size'] > 1000000){
                        $dt_foto['error']='Ukuran file teralul besar';
                        $dt_foto['status']=0;
                    }else{
                        $config['upload_path'] = $this->gambar->get_path();
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
                            $dt_foto['path']=site_url('common/album/kegiatan/'.$img_data->file_name);
                            //$dt_foto['type']=$img_data->file_type;
                            $dt_foto['status']=1;
                            $dt_foto['id_keg']=$id_keg;
                            $this->gambar->img_thub($img_data->file_name);
                            $dt_ins=array(
                                'file_img'=>$img_data->file_name,
                                'id_kegiatan'=>$id_keg,
                                'jdl_keg'=>$jdl_keg
                            );
                            $this->db->insert('t_album_kegiatan',$dt_ins);
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
    
    function tes(){
        if($this->input->post('isfile') == '1'){
            echo json_encode($_FILES);
        }else{
            echo json_encode('aa');
        }

        
    }
    
    function do_upd(){
        if($this->input->is_ajax_request()){
                $this->load->library('gambar');
                $this->gambar->set_path('kegiatan');
                //
                $dt_foto=array();
                //echo '<pre>';
                //print_r($foto);
                $id_keg=$this->input->post('id_keg');
                $jdl_keg=$this->input->post('jdl_keg');
                $id_pk=$this->input->post('id_key');
                $fname=$this->input->post('fname');
                $dt_ins=array(
                    'id_kegiatan'=>$id_keg,
                    'jdl_keg'=>$jdl_keg
                );
                $dt_foto['status']=1;
                if($this->input->post('isfile') == '1'){
                    $foto=$_FILES['foto'];
                    if($foto['type'] === 'image/jpeg' || $foto['type'] === 'image/png'){
                        if($foto['size'] > 1000000){
                            $dt_foto['error']='Ukuran file teralul besar';
                            $dt_foto['status']=0;
                        }else{
                            $config['upload_path'] = $this->gambar->get_path();
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
                                exit;
                            }
                            else
                            {   
                                $this->del_file($fname);
                                $img_data=(object)$this->upload->data();             
                                $dt_foto['path']=site_url('common/album/kegiatan/'.$img_data->file_name);
                                $dt_foto['status']=1;
                                $dt_foto['id_keg']=$id_keg;
                                $this->gambar->img_thub($img_data->file_name);
                                $dt_ins['file_img']=$img_data->file_name;
                            }
                        }
                    }else{
                        $dt_foto['error']='Format tidak valid';
                        $dt_foto['status']=0;
                        exit;
                    }
                }
                $this->M_album->get_upd($id_pk,$dt_ins);
                echo json_encode($dt_foto);
        }else{
            show_404();
        }
    }
    
    public function load_album(){
        if($this->input->is_ajax_request()){
            $id=$this->input->post('id_keg');
            $data['dt_alb']=$this->M_album->get_album($id);
            $this->load->view("album/load_img",$data);
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
            $this->M_album->del($key);
            $path='./common/album/kegiatan/'.$fname;
            $thumb='./common/album/kegiatan/thumb/'.$fname;
            unlink($path);
            unlink($thumb);
            echo json_encode(array("status" => TRUE));
       }
	}
    
    private function del_file($fname){
        $path='./common/album/kegiatan/'.$fname;
        $thumb='./common/album/kegiatan/thumb/'.$fname;
        unlink($path);
        unlink($thumb);
    }
}