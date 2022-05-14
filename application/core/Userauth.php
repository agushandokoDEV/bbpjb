<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Userauth extends CI_Controller
{
       
    protected $bln=array(
        '01'=>'Januari',
        '02'=>'Februari',
        '03'=>'Maret',
        '04'=>'April',
        '05'=>'Mei',
        '06'=>'Juni',
        '07'=>'Juli',
        '08'=>'Agustus',
        '09'=>'September',
        '10'=>'Oktober',
        '11'=>'November',
        '12'=>'Desember'
        );
    
    function __construct(){
        parent::__construct();
        $login=$this->session->userdata('logged_in');
        if($login != 1){
            redirect('/');
        }else{
            if($this->session->status != '1'){
                redirect('auth/aktivasi');
            }
        }
    }
    
    function set_user_group($user){
        if(is_array($user)){
            if(in_array($this->session->id_role,$user)){
                $result=TRUE;
                //echo 'ada';
            }else{
                $result=FALSE;
                //echo 'kosong';
            }
        }else{
            if($this->session->id_role == $user){
                $result=TRUE;
                //echo 'kosong a';
            }else{
                $result=FALSE;
            }
        }
        if($result == FALSE){
            show_404();
        }
    }
}