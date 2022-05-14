<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Grafik_data extends Userauth{
    
    private $blnkey=array('01','02','03','04','05','06','07','08','09','10','11','12');
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_grafik');
    }
    
    public function index(){
        $this->load->view('grafik/page_index');
	}
    
    public function load_grafik(){
        if($this->input->is_ajax_request()){
            $thn=$this->input->post('thn');
            $data['thn']=$thn;
            $data['bulan']=$this->blnkey;
            $data['total']=$this->M_grafik->get_grafik_total($thn);
            $this->load->view('grafik/load_grafik',$data);
        }else{
            show_404();
        }
    }
    
    public function load_grafik_dt(){
        if($this->input->is_ajax_request()){
            $thn=$this->input->post('thn');
            $bln=$this->input->post('bln');
            $s=strtolower($this->input->post('s'));
            $data['thn']=$thn;
            $data['jenis']=$s;
            $data['bln']=$this->blnkey[$bln];
            $data['tanggal']=$this->bulan($this->blnkey[$bln]).' '. $thn;
            $data['dt_grafik']=$this->M_grafik->get_grafik_dt($s,$thn,$this->blnkey[$bln]);
            $this->load->view('grafik/grafik_data',$data);
        }else{
            show_404();
        }
    }
    
    private function bulan($hari=''){
        switch($hari){
            
            case '01':
            $hari='Januari';
            break;
            
            case '02':
            $hari='Februari';
            break;
            
            case '03':
            $hari='Maret';
            break;
            
            case '04':
            $hari='April';
            break;
            
            case '05':
            $hari='Mei';
            break;
            
            case '06':
            $hari='Juni';
            break;
            
            case '07':
            $hari='Juli';
            break;
            
            case '08':
            $hari='Agustus';
            break;
            
            case '09':
            $hari='September';
            break;
            
            case '10':
            $hari='Oktober';
            break;
            
            case '11':
            $hari='November';
            break;
            
            case '12':
            $hari='Desember';
            break;
        }
        return $hari;
    }
}