<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Slug{
    
    private function generate($string){
        //Unwanted:  {UPPERCASE} ; / ? : @ & = + $ , . ! ~ * ' ( )
        $string = strtolower($string);
        //Strip any unwanted characters
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        //Clean multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);
        return $string;
    }
    
    public function seoUrl($string) {
        //Convert whitespaces and underscore to dash
        $genrate=$this->generate($string);
        $string = preg_replace("/[\s_]/", "-", $genrate);
        return $string;
    }
}