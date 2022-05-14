<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require 'gclass/Gphp.class.php';

class Gcrud extends Gphp{
    
    private $modules_name;
    private $path_modules;
    //private $controllersname;
    
    function set_modules_name($name){
        $this->modules_name=$name;
    }
    
    private function mvcFolder(){
        mkdir($this->path_modules.'/controllers/');
        mkdir($this->path_modules.'/models/');
        mkdir($this->path_modules.'/views/');
    }
    
    private function mvc_controllers($html=''){
        $dir=$this->path_modules.'/controllers/';
        mkdir($dir,0777,true);
        $this->controllersname=ucfirst($this->modules_name);
        $fp=fopen($dir.$this->controllersname.".php","w");
        fwrite($fp,$html);
    }
    
    private function mvc_models($html=''){
        $dir=$this->path_modules.'/models/';
        mkdir($dir,0777,true);
        $fp=fopen($dir.'M_'.$this->modules_name.".php","w");
        fwrite($fp,$html);
    }
    
    private function mvc_views($html=''){
        $dir=$this->path_modules.'/views/';
        mkdir($dir,0777,true);
        $fp=fopen($dir."page_index.php","w");
        fwrite($fp,$html);
        $add=fopen($dir."page_add.php","w");
        fwrite($add,$html);
        $upd=fopen($dir."page_upd.php","w");
        fwrite($upd,$html);
    }
    
    function create_modules(){
        $CI=& get_instance();
        $CI->load->config('gconfig');
        $this->path_modules=$CI->config->item('root').$this->modules_name;
        if(!file_exists($this->modules_name)){
            $this->controllersname=ucfirst($this->modules_name);
            mkdir($this->path_modules,0777,true);
            $this->mvc_controllers($this->controllers());
            $this->mvc_models();
            $this->mvc_views();
        }else{
            return false;
            exit;
        }
    }
}