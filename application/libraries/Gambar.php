<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gambar{
    
    private $common='common/album/';
    private $path='';
    private $width=null;
    private $height=null;
    
    function set_path($path){
        $this->path=$path;
    }
    
    function get_path(){
        return $this->common.$this->path.'/';
    }
    
    function set_width($s){
        $this->width=$s;
    }
    
    function set_heght($s){
        $this->height=$s;
    }
    
    function img_thub($file){
        $CI=& get_instance();
        $CI->load->library('image_lib');
        $thub['image_library'] = 'gd2';
        $thub['source_image']	= $this->get_path().$file;
        $thub['create_thumb'] = TRUE;
        $thub['maintain_ratio'] = TRUE;
        
        if($this->width != null)
        {
            $thub['width'] = $this->width;
        }
        else
        {
            $thub['width'] = 300;
        }
        
        if($this->height != null)
        {
            $thub['height'] = $this->height;
        }
        else
        {
            $thub['height']	= 300;
        }
        
        
        $thub['thumb_marker']= '';
        $thub['new_image'] = $this->get_path().'thumb/'.$file;
        
        
        // Set your config up
        $CI->image_lib->initialize($thub);
        $CI->image_lib->resize();
    }
}