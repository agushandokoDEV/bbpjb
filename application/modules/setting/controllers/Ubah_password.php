<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ubah_password extends Userauth{
    
    function __construct(){
        parent::__construct();
        $this->load->model('M_seting');
    }
    public function index()
	{
        $data['dt_row']=$this->M_seting->get_user_row();
        $this->load->view('pswd/page_index',$data);
	}
    
    public function do_save(){
        if($this->input->method() == "post"){
            $old=md5($this->input->post('old_password'));
            $new=md5($this->input->post('new_password'));
            $re=md5($this->input->post('re_password'));
            $cek=$this->M_seting->get_user_row();
            if($cek->password == $old){
                if($new == $re){
                    $data=array(
                        'password'=>$new
                    );
                    $this->M_seting->upd_users($data);
                    $this->session->set_flashdata('notif',alert('success','OK !!! ubah password berhasil...'));
                }else{
                    $this->session->set_flashdata('notif',alert('danger','Upss !!! password tidak sama...'));
                }
            }else{
                $this->session->set_flashdata('notif',alert('danger','Upss !!! password anda salah...'));
            }
            redirect('setting/ubah_password');
        }else{
            show_404();
        }
    }
}