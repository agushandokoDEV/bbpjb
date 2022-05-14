<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
if ( ! function_exists('echo_pre')){
    
    function echo_pre($var = ''){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }
}
if ( ! function_exists('loading')){
    
    function loading($var = ''){
        if($var != ''){
            $img='loading_tf.gif';
        }else{
            $img='loading_.gif';
        }
        $path=get_instance()->config->base_url('assets/app/img/'.$img);
        $html='<img src="'.$path.'"/>';
        return $html;
    }
}
if ( ! function_exists('alert')){
    
    function alert($class,$message){
        $html='<div class="alert alert-'.$class.' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><span class="glyphicon glyphicon-info-sign"></span> '.$message.'</div>';
        return $html;
    }
}
if ( ! function_exists('progresbar')){
    
    function progresbar($color=''){
        $html='<div class="progress"><div class="progress-bar progress-bar-'.$color.' progress-bar-striped active" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div></div>';
        return $html;
    }
}
if ( ! function_exists('tanggal')){
    
    function tanggal($data=''){
        if($data == null){
            $date='';
        }else if($data == ''){
            $date='';
        }else if($data == '0000-00-00'){
            $date='';
        }else{
            if(str_word_count($data) == 2){
                $data=explode(' ',$data);
                $data=$data[0];
            }
            $pecah=explode('-', $data);
            $date=array('thn'=>$pecah[0],'bln'=>$pecah[1],'tgl'=>$pecah[2]);
        
            switch($date['bln']){
                case '01':
                $date=$date['tgl'].' Januari '.$date['thn'];
                break;
                
                case '02':
                $date=$date['tgl'].' Februari '.$date['thn'];
                break;
                
                case '03':
                $date=$date['tgl'].' Maret '.$date['thn'];
                break;
                
                case '04':
                $date=$date['tgl'].' April '.$date['thn'];
                break;
                
                case '05':
                $date=$date['tgl'].' Mei '.$date['thn'];
                break;
                
                case '06':
                $date=$date['tgl'].' Juni '.$date['thn'];
                break;
                
                case '07':
                $date=$date['tgl'].' Juli '.$date['thn'];
                break;
                
                case '08':
                $date=$date['tgl'].' Agustus '.$date['thn'];
                break;
                
                case '09':
                $date=$date['tgl'].' September '.$date['thn'];
                break;
                
                case '10':
                $date=$date['tgl'].' Oktober '.$date['thn'];
                break;
                
                case '11':
                $date=$date['tgl'].' November '.$date['thn'];
                break;
                
                case '12':
                $date=$date['tgl'].' Desember '.$date['thn'];
                break;
            }
        }
        return $date;
    }
}

if ( ! function_exists('hari')){
    
    function hari($date=''){
        $hari=date('l',strtotime($date));
        switch($hari){
            
            case 'Sunday':
            $hari='Minggu';
            break;
            
            case 'Monday':
            $hari='Senin';
            break;
            
            case 'Tuesday':
            $hari='Selasa';
            break;
            
            case 'Wednesday':
            $hari='Rabu';
            break;
            
            case 'Thursday':
            $hari='Kamis';
            break;
            
            case 'Friday':
            $hari='Jum\'at';
            break;
            
            case 'Saturday':
            $hari='Sabtu';
            break;
        }
        return $hari;
    }
}

if ( ! function_exists('fullday')){
    
    function fullday($date=''){
        $hari=hari($date);
        $tgl=tanggal($date);
        $fullday=$hari.', '.$tgl;
        return $fullday;
    }
}

if ( ! function_exists('bulan')){
    
    function bulan($hari = ''){
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

if ( ! function_exists('get_tahun')){
    
    function get_tahun($date=''){
        if($date != ''){
            $ex=explode('-',$date);
            $thn=$ex[0];
        }else{
            $thn='';
        }
        return $thn;
    }
}

if ( ! function_exists('get_bln_xl')){
    
    function get_bln_xl($val = ''){
        $thn='';
        if($val != ''){
            $ex=explode('-',$val);
            if(!empty($ex[1])){
                $thn=$ex[1].'-';
            }
            $bln=strtolower($ex[0]);
            switch($bln){
                
                case 'januari':
                $bln='01';
                break;
                
                case 'februari':
                $bln='02';
                break;
                
                case 'maret':
                $bln='03';
                break;
                
                case 'april':
                $bln='04';
                break;
                
                case 'mei':
                $bln='05';
                break;
                
                case 'juni':
                $bln='06';
                break;
                
                case 'juli':
                $bln='07';
                break;
                
                case 'agustus':
                $bln='08';
                break;
                
                case 'september':
                $bln='09';
                break;
                
                case 'oktober':
                $bln='10';
                break;
                
                case 'november':
                $bln='11';
                break;
                
                case 'desember':
                $bln='12';
                break;
            }
            $result =$thn.$bln.'-'.date('d');
        }else{
            $result='';
        }
        
        return $result;
    }
}

if ( ! function_exists('get_thn_xl')){
    
    function get_thn_xl($val = ''){
        $thn='';
        if($val != ''){
            $ex=explode('-',$val);
            if(!empty($ex[1])){
                $thn=$ex[1];
            }
        }
        
        return $thn;
    }
}

if ( ! function_exists('get_bln')){
    
    function get_bln($val = ''){
        if($val != ''){
            $ex=explode('-',$val);
            $bln=strtolower($ex[0]);
            switch($bln){
                
                case 'januari':
                $bln='01';
                break;
                
                case 'februari':
                $bln='02';
                break;
                
                case 'maret':
                $bln='03';
                break;
                
                case 'april':
                $bln='04';
                break;
                
                case 'mei':
                $bln='05';
                break;
                
                case 'juni':
                $bln='06';
                break;
                
                case 'juli':
                $bln='07';
                break;
                
                case 'agustus':
                $bln='08';
                break;
                
                case 'september':
                $bln='09';
                break;
                
                case 'oktober':
                $bln='10';
                break;
                
                case 'november':
                $bln='11';
                break;
                
                case 'desember':
                $bln='12';
                break;
            }
            $result =$bln;
        }else{
            $result='';
        }
        
        return $result;
    }
}