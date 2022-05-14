<?php

class Gphp{
    
    protected $controllersname;
    private $tag;
    private $content;
    
    private function ci_open_tag($extends=''){
        if($extends == ''){
            $extends='Userauth';
        }
        $html="
        <?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
        class ".$this->controllersname." extends $extends {
            
            function __construct(){
        	   parent::__construct();
            }
        ";
        return $html;
    }
    
    private function controller_index(){
        $html='
            public function index(){
        		$this->load->view("page_index");
        	}
        ';
        return $html;
    }
    
    private function controller_list_data(){
        $html='
            public function ajax_data(){
        		if($this->input->is_ajax_request()){
        		       
        ';
        $html .='
                }else{
                        show_404();
                    }
            	}
        ';
        return $html;
    }
    
    private function controller_add(){
        $html='
            public function add(){
        		$this->load->view("page_add");
        	}
        ';
        return $html;
    }
    
    private function controller_do_add(){
        $html='
            public function do_add(){
        		if($this->input->method() == "'."post".'"){
        		       
        ';
        $html .='
                }else{
                        show_404();
                    }
            	}
        ';
        return $html;
    }
    
    private function controller_upd(){
        $html='
            public function upd($id=null){
        		
                $this->load->view("page_upd");
        	}
        ';
        return $html;
    }
    
    private function controller_do_upd(){
        $html='
            public function do_upd(){
        		if($this->input->method() == "'."post".'"){
        		       
        ';
        $html .='
            }else{
                    show_404();
                }
        	}
        ';
        return $html;
    }
    
    private function controller_del(){
        $html='
            public function hapus(){
        		if($this->input->is_ajax_request()){
        		       
        ';
        $html .='
            }else{
                    show_404();
                }
        	}
        ';
        return $html;
    }
    
    private function ci_content_tag(){
        $html=$this->controller_index();
        $html .=$this->controller_list_data();
        $html .=$this->controller_add();
        $html .=$this->controller_do_add();
        $html .=$this->controller_upd();
        $html .=$this->controller_do_upd();
        $html .=$this->controller_del();
        return $html;
    }
    
    private function ci_close_tag(){
        $html=
        "}";
        return $html;
    }
    
    public function controllers(){
        $html=$this->ci_open_tag();
        $html .=$this->ci_content_tag();
        $html .=$this->ci_close_tag();
        return $html;
    }
    
    public function models(){
        $html=$this->ci_open_tag();
    }
}