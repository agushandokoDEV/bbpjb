<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends Userauth{
    
    function __construct(){
        parent::__construct();
        $this->load->model('M_seting');
    }
    public function index()
	{
        $data['dt_row']=$this->M_seting->get_user_row();
        $this->load->view('profil/page_index',$data);
	}
    
    public function do_save()
	{
        if($this->input->method() == "post"){
            $nama=$this->input->post('nama');
            $email=$this->input->post('email');
            $alamat=$this->input->post('alamat');
            $foto=$_FILES['foto'];
            
            $data=array(
                'nama_user'=>$nama,
                'email'=>$email,
                'alamat'=>$alamat
            );
            
            if($foto['name'] != null){
                $config['upload_path'] = 'common/album/profil/';
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
                    $this->session->set_flashdata('notif',alert('danger',$notif));
                    redirect('setting/profil');
                    exit;
                }
                else
                {   
                    $img_data=(object)$this->upload->data();
                    $this->load->library('Gambar');
                    $this->gambar->set_path('profil');
                    $this->gambar->img_thub($img_data->file_name);
                    $data['foto']=$img_data->file_name;
                }
            }
            $this->M_seting->upd_users($data);
            $this->session->set_flashdata('notif',alert('success','OK !!! update profil berhasil...'));
            redirect('setting/profil');
        }else{
            show_404();
        }
	}
}