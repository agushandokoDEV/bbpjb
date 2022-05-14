<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('M_auth');
        $this->load->helper('text');
    }
    
    function index(){
        if($this->session->userdata('logged_in') == 1){
            if($this->session->status != '1'){
                redirect('auth/aktivasi');
            }else{
                redirect('dashboard');
            }
        }else{
            $data['dt_slide']=$this->M_auth->get_slide();
            $data['newsticker']=$this->M_auth->get_slide(10);
            $this->load->view('frontend/home',$data);
        }
        //$this->output->cache(1);
    }
    function login(){
        if($this->session->userdata('logged_in') == 1){
            if($this->session->status != '1'){
                redirect('auth/aktivasi');
            }else{
                redirect('dashboard');
            }
        }else{
            $data['dt_slide']=$this->M_auth->get_slide();
            $this->load->view('frontend/home');
        }
        //$this->output->cache(1);
    }
    function do_login(){
        if($this->input->method() == 'post'){
            $username=$this->input->post('username');
            $passwod=md5($this->input->post('password'));
            $checked=$this->M_auth->log_checked($username,$passwod);
            
            if($checked != null){
                
                $user_log=array(
                    'status'=>$checked->status,
                );
                $this->session->set_userdata($user_log);
                if($checked->status == '2'){
                    redirect('auth/nonaktif');
                }else{
                    $user_log=array(
                        'username'=>$checked->username,
                        'id_role'=>$checked->id_role,
                        'status'=>$checked->status,
                        'logged_in'=>TRUE
                    );
                    $this->session->set_userdata($user_log);
                    if($checked->status == '1'){
                        redirect('dashboard');
                    }else{
                        redirect('auth/aktivasi');
                    }
                }
            }else{
                $this->session->set_flashdata('notif','<div class="alert alert-danger" style="border-radius: 0;"><span class="glyphicon glyphicon-info-sign"></span> Ups !!! Username dan password anda salah..</div>');
                $this->session->set_flashdata('notif-mdl','$("#mdl-log").modal("show");');
                redirect($this->input->post('current_url'));
            }
        }else{
            show_404();
        }
    }
    function ajax_login(){
        if($this->input->is_ajax_request()){
            $username=$this->input->post('u');
            $passwod=md5($this->input->post('p'));
            $checked=$this->M_auth->log_checked($username,$passwod);
            $data_log=array();
            if($checked->status == '2'){
                $data_log['redirect']=site_url('auth/nonaktif');
            }else{
                if($checked != null){
                    $data_log['logged']=TRUE;
                    $user_log=array(
                        'username'=>$checked->username,
                        'id_role'=>$checked->id_role,
                        'status'=>$checked->status,
                        'logged_in'=>TRUE
                    );
                    $this->session->set_userdata($user_log);
                    if($checked->status == '0'){
                        $data_log['redirect']=site_url('auth/aktivasi');
                    }else{
                        $data_log['redirect']=site_url('dashboard');
                    }
                }else{
                    $data_log['logged']=FALSE;
                    $data_log['notif']='Ups !!! Username dan password anda salah..';
                    //$this->session->set_flashdata('notif','<div class="alert alert-danger" style="border-radius: 0;"><span class="glyphicon glyphicon-info-sign"></span> Ups !!! Username dan password anda salah..</div>');
                    //$this->session->set_flashdata('notif-mdl','$("#mdl-log").modal("show");');
                    //redirect('/');
                }
            }
            echo json_encode($data_log);
        }
    }
    function aktivasi(){
        if($this->session->userdata('logged_in') == 1){
            if($this->session->status == '0'){
                $this->load->view('frontend/aktivasi');
            }else{
                show_404();
            }
        }else{
            show_404();
        }
        
    }
    function nonaktif(){
        if($this->session->status == '2'){
            $this->load->view('frontend/nonaktif');
        }else{
            show_404();
        }
    }
    public function pass_checked(){
        if($this->input->is_ajax_request()){
            $pass=$this->input->post('new_password');
            if($pass == 'admin'){
                $r=false;
            }else{
                $r=true;
            }
            echo json_encode(array('valid'=>$r));
        }else{
            show_404();
        }
    }
    function do_aktvasi(){
        if($this->input->method() == 'post'){
            $username=$this->input->post('username');
            $new_pass=md5($this->input->post('new_password'));
            $dt=array(
                'password'=>$new_pass,
                'status'=>1
            );
            if($this->M_auth->upt_pass($this->session->username,$dt)){
                //$this->session->unset_userdata('status');
                //$this->M_auth->upt_sess($this->session->session_id);
                $user_log=array(
                    'status'=>1,
                );
                $this->session->set_userdata($user_log);
                redirect('dashboard');
            }
        }else{
            show_404();
        }
    }
    function logout(){
        $this->session->sess_destroy();
        redirect('/');
    }
}