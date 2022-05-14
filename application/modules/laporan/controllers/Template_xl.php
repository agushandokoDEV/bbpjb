<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_xl extends Userauth{
    
    private $kolom=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    private $id_mapinglap;
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_bln');
    }
    
    private function set_idmapinglap($id_maping){
        $this->id_mapinglap=$id_maping;
    }
    
    private function last_col(){
        $c=$this->M_bln->get_row_maping($this->id_mapinglap);
        $f=trim($c->field,',');
        $ex=explode(',',$f);
        $last_col=$this->kolom[count($ex)-1];
        return $last_col;
    }
    private function list_col(){
        $c=$this->M_bln->get_row_maping($this->id_mapinglap);
        $f=trim($c->field,',');
        $ex=explode(',',$f);
        return $ex;
    }
    
    private function list_col_head(){
        $c=$this->M_bln->get_row_maping($this->id_mapinglap);
        $f=trim($c->field,',');
        $ex=explode(',',$f);
        $ar=array();
        $t=count($ex)-1;
        for($i=0; $i<=$t; $i){
            $ar[]=$this->kolom[$i++];
        }
        return $ar;
    }
    
    private function get_menuName(){
        $m=$this->M_bln->get_row_maping($this->id_mapinglap);
        if($m->menu_sub == '49'){
            $mn= 'Penelitian '.$this->M_bln->get_menu($m->menu_sub);
        }else if($m->menu_sub == '50'){
            $mn= 'Penelitian '.$this->M_bln->get_menu($m->menu_sub);
        }else if($m->menu_sub == '51'){
            $mn= 'Penyusunan '.$this->M_bln->get_menu($m->menu_sub);
        }else if($m->menu_sub == '52'){
            $mn= 'Penyusunan '.$this->M_bln->get_menu($m->menu_sub);
        }else if($m->menu_sub == '53'){
            $mn= 'Penyusunan '.$this->M_bln->get_menu($m->menu_sub);
        }else if($m->menu_sub == '54'){
            $mn= 'Penyusunan '.$this->M_bln->get_menu($m->menu_sub);
        }else{
            $mn= $this->M_bln->get_menu($m->menu_sub);
        }
        return strtoupper($mn);
    }
    
    private function kabkot_col(){
        $c=$this->M_bln->get_row_maping($this->id_mapinglap);
        $f=trim($c->field,',');
        $ex=explode(',',$f);
        $last_col=count($ex)+1;
        return $last_col;
    }
    
    function tes(){
        $this->set_idmapinglap('6');
        echo $this->kolom[$this->kabkot_col()+1].'5';
    }
    
    function coba(){
        $this->set_idmapinglap('7');
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        echo_pre($last_col);
        echo_pre($list_col_val);
        echo_pre($list_col_head);
        //echo count($list_col_head);
        for($i=0; $i<count($list_col_head); $i++){
            echo $this->kolom[$i];
        }
    }
    
    function create_template($id=''){
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        if($maping){
            $xl=new Excel_generator();
            $xl->setActiveSheetIndex(0);
            $ws=$xl->getActiveSheet();
            
            $last_col=$this->last_col();
            $list_col_val=$this->list_col();
            $list_col_head=$this->list_col_head();
            $filename='template-'.$maping->url;
            $kol=array();
            // Create Header
            $ws->GetStyle('A1')->getFont()->setSize(11);
            $ws->GetStyle('A2')->getFont()->setSize(11);
            $ws->GetStyle('A3')->getFont()->setSize(11);
            
            $ws->getStyle('A1')->getFont()->setBold(true);
            //$ws->getStyle('A2')->getFont()->setBold(true);
            //$ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
            
            $ws->setCellValue('A1','TEMPLATE '.$this->get_menuName());
            //$ws->setCellValue('A2','FAKULTAS EKONOMI');
            //$ws->setCellValue('A3',bulan($bln).' '.$thn);
            
            //$ws->getColumnDimension('C')->setAutoSize(true);
            $ws->mergeCells('A1:'.$last_col.'1');
            $ws->mergeCells('A2:'.$last_col.'2');
            $ws->mergeCells('A3:'.$last_col.'3');
            $ws->mergeCells('A4:'.$last_col.'4');
            $ws->mergeCells('A5:'.$last_col.'5');
            
            $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            
            $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
            $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
            //$ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
            // End Header
            
            $ws->setCellValue('A3','Catatan :');
            $ws->setCellValue('A4','penulisan Format tanggal : 12/31/2016 (bulan/tanggal/tahun)');
            $ws->setCellValue('A5','penulisan Kab / Kota : Gunakan kode kab / kota yang sudah disediakan');
            //set tabel data
            // header table
            $ws->getColumnDimension('C')->setAutoSize(TRUE);
            $j=count($list_col_head);
            for($i=0; $i<$j; $i++){
                $ws->getColumnDimension($this->kolom[$i])->setAutoSize(true);
                $ws->getStyle($list_col_head[$i].'7',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $ws->getStyle($list_col_head[$i].'7',$list_col_val[$i])->getFont()->setBold(true);
                $ws->setCellValue($list_col_head[$i].'7',$list_col_val[$i]);
            }
            $kabkot=$this->M_bln->get_kabkot();
            $mulai=7;
            $id=$this->kolom[$this->kabkot_col()];
            $nm_kabkot=$this->kolom[$this->kabkot_col()+1];
            
            $ws->mergeCells($this->kolom[$this->kabkot_col()].'5:'.$this->kolom[$this->kabkot_col()+1].'5');
            $ws->getStyle($this->kolom[$this->kabkot_col()].'5')->getFont()->setBold(true);
            $ws->setCellValue($this->kolom[$this->kabkot_col()].'5','Daftar Kab / Kota');
            $ws->getStyle($id.'7')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getStyle($nm_kabkot.'7')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($id)->setAutoSize(true);
            $ws->getColumnDimension($nm_kabkot)->setAutoSize(true);
            $ws->getStyle($id.'7')->getFont()->setBold(true);
            $ws->getStyle($nm_kabkot.'7')->getFont()->setBold(true);
            $ws->setCellValue($id.'7','Kode');
            $ws->setCellValue($nm_kabkot.'7','Nama Kab / Kota');
            
            foreach($kabkot as $val){
                $mulai++;
                $ws->getStyle($id.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $ws->getStyle($nm_kabkot.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
                $ws->setCellValue($id.$mulai,$val->id_kabkot);
                $ws->setCellValue($nm_kabkot.$mulai,$val->nama_kota);
            }
            
            // Redirect output to a client’s web browser (Excel2007)
            header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
            header('<a class="zem_slink" title="Web cache" href="http://en.wikipedia.org/wiki/Web_cache" target="_blank" rel="wikipedia">Cache-Control</a>: max-age=0');
            // If you're serving to <a class="zem_slink" title="Internet Explorer 9" href="http://windows.microsoft.com/ie" target="_blank" rel="homepage">IE 9</a>, then the following may be needed
            header('Cache-Control: max-age=1');
             
            // If you're serving to IE over SSL, then the following may be needed
            header ('Expires: Mon, 26 Jul 1997 05:00:00 <a class="zem_slink" title="Greenwich Mean Time" href="http://en.wikipedia.org/wiki/Greenwich_Mean_Time" target="_blank" rel="wikipedia">GMT</a>'); // Date in the past
            header ('Last-Modified:  GMT'); // always modified
            header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
            header ('Pragma: public'); // HTTP/1.0
            $obj = PHPExcel_IOFactory::createWriter($xl,'Excel2007');
            $obj->save('php://output');
        }else{
            show_404();
        }
    }
}