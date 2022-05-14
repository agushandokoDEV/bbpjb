<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bulanan extends Userauth{
    
    private $kolom=array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
    private $id_mapinglap;
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_bln');
    }
    
    public function index(){
        $data['dt_bln']=$this->bln;
        $data['dt_menu']=$this->M_bln->get_data();
        $data['tanggal']=bulan($this->bln[date('m')]).' '. date('Y');
        $this->load->view('bln/page_index',$data);
	}
    
    public function filter(){
        $bln=$this->input->get('bln');
        $thn=$this->input->get('thn');
        $data['dt_bln']=$this->bln;
        $data['dt_menu']=$this->M_bln->get_data();
        $data['tanggal']=bulan($this->bln[$bln]).' '.$thn;
        $data['fbln']=$bln;
        $data['fthn']=$thn;
        $this->load->view('bln/page_filter',$data);
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
            echo $list_col_head[$i].'/'.$list_col_val[$i].'<br>';
        }
    }
    function penelitian_sastra($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->penbas_data($maping->query,'sastra',$thn,$bln);
        $terbit='Belum Terbit';
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$this->M_bln->get_row_kabkot($val->id_kabkot));
            $ws->setCellValue('C'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('D'.$mulai,$val->peneliti);
            $ws->setCellValue('E'.$mulai,$val->judul);
            $ws->setCellValue('F'.$mulai,tanggal($val->tgl_mulai));
            $ws->setCellValue('G'.$mulai,tanggal($val->tgl_selesai));
            $ws->setCellValue('H'.$mulai,$val->lama_penelitian.' '.$val->satuan_lama_penelitian);
            if($val->publikasi == 1){
                $terbit='Terbit';
            }
            $ws->setCellValue('I'.$mulai,$terbit);
            $ws->setCellValue('J'.$mulai,$val->thn_terbit);
            $ws->setCellValue('K'.$mulai,$val->abstraksi);
            $ws->setCellValue('L'.$mulai,$val->kerja_sama);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function penelitian_bahasa($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->penbas_data($maping->query,'bahasa',$thn,$bln);
        $terbit='Belum Terbit';
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$this->M_bln->get_row_kabkot($val->id_kabkot));
            $ws->setCellValue('C'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('D'.$mulai,$val->peneliti);
            $ws->setCellValue('E'.$mulai,$val->judul);
            $ws->setCellValue('F'.$mulai,tanggal($val->tgl_mulai));
            $ws->setCellValue('G'.$mulai,tanggal($val->tgl_selesai));
            $ws->setCellValue('H'.$mulai,$val->lama_penelitian.' '.$val->satuan_lama_penelitian);
            if($val->publikasi == 1){
                $terbit='Terbit';
            }
            $ws->setCellValue('I'.$mulai,$terbit);
            $ws->setCellValue('J'.$mulai,$val->thn_terbit);
            $ws->setCellValue('K'.$mulai,$val->abstraksi);
            $ws->setCellValue('L'.$mulai,$val->kerja_sama);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function penyusunan_kamus($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$this->M_bln->get_row_kabkot($val->id_kabkot));
            $ws->setCellValue('C'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('D'.$mulai,$val->judul);
            $ws->setCellValue('E'.$mulai,$val->penyusun);
            $ws->setCellValue('F'.$mulai,$val->jenis);
            $ws->setCellValue('G'.$mulai,$val->sasaran);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function penyusunan_bahan_ajar($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$this->M_bln->get_row_kabkot($val->id_kabkot));
            $ws->setCellValue('C'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('D'.$mulai,$val->judul);
            $ws->setCellValue('E'.$mulai,$val->nama_penyusun);
            $ws->setCellValue('F'.$mulai,$val->kat);
            $ws->setCellValue('G'.$mulai,$val->thn_penyusun);
            $ws->setCellValue('H'.$mulai,$val->tingkat);
            $ws->setCellValue('I'.$mulai,$val->sasaran);
            $ws->setCellValue('J'.$mulai,$val->tema);
            $ws->setCellValue('K'.$mulai,$val->sumber_bahan);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function penyusunan_literasi($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$this->M_bln->get_row_kabkot($val->id_kabkot));
            $ws->setCellValue('C'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('D'.$mulai,$val->judul);
            $ws->setCellValue('E'.$mulai,$val->penyusun);
            $ws->setCellValue('F'.$mulai,$val->tingkatan);
            $ws->setCellValue('G'.$mulai,$val->tema);
            $ws->setCellValue('H'.$mulai,$val->sumber_bahan);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function penyusunan_ensiklopedi($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$this->M_bln->get_row_kabkot($val->id_kabkot));
            $ws->setCellValue('C'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('D'.$mulai,$val->judul);
            $ws->setCellValue('E'.$mulai,$val->kat);
            $ws->setCellValue('F'.$mulai,$val->tim_redaksi);
            //$ws->setCellValue('G'.$mulai,$val->edisi);
            //$ws->setCellValue('H'.$mulai,$val->no_isbn);
            $ws->setCellValue('G'.$mulai,$val->lingkup);
            //$ws->setCellValue('J'.$mulai,$val->penerbit);
            //$ws->setCellValue('K'.$mulai,$val->thn_terbit);
            $ws->setCellValue('H'.$mulai,$this->M_bln->get_Produkname($val->info_produk));
            //$ws->setCellValue('M'.$mulai,$val->ket);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function jurnal($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->majalah_data($maping->query,'j',$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$val->judul);
            $ws->setCellValue('C'.$mulai,bulan($val->bln_pelaksanaan).' '.$val->thn_pelaksanaan);
            $ws->setCellValue('D'.$mulai,$val->tim_redaksi);
            $ws->setCellValue('E'.$mulai,$val->volume);
            $ws->setCellValue('F'.$mulai,$val->no_issn);
            $ws->setCellValue('G'.$mulai,$val->lingkup);
            $ws->setCellValue('H'.$mulai,$val->akreditasi);
            $ws->setCellValue('I'.$mulai,$val->penerbit);
            $ws->setCellValue('J'.$mulai,$this->M_bln->get_Produkname($val->info_produk));
            $ws->setCellValue('K'.$mulai,$val->thn_terbit);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function majalah($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->majalah_data($maping->query,'m',$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$val->judul);
            $ws->setCellValue('C'.$mulai,bulan($val->bln_pelaksanaan).' '.$val->thn_pelaksanaan);
            $ws->setCellValue('D'.$mulai,$val->tim_redaksi);
            $ws->setCellValue('E'.$mulai,$val->volume);
            $ws->setCellValue('F'.$mulai,$val->no_issn);
            //$ws->setCellValue('F'.$mulai,$val->lingkup);
            //$ws->setCellValue('G'.$mulai,$val->akreditasi);
            $ws->setCellValue('G'.$mulai,$val->penerbit);
            $ws->setCellValue('H'.$mulai,$this->M_bln->get_Produkname($val->info_produk));
            $ws->setCellValue('I'.$mulai,$val->thn_terbit);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function karyailmiah($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_karyailmiah($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$val->judul);
            $ws->setCellValue('C'.$mulai,bulan($val->bln_pelaksanaan).' '.$val->tahun);
            $ws->setCellValue('D'.$mulai,$val->jenis);
            $ws->setCellValue('E'.$mulai,$val->penulis);
            $ws->setCellValue('F'.$mulai,$val->prodi);
            $ws->setCellValue('G'.$mulai,$val->perguruan_t);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function terbitan($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_bln_thn($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$val->kat_terbitan);
            $ws->setCellValue('C'.$mulai,bulan($val->bln_pelaksanaan).' '.$val->thn_pelaksanaan);
            $ws->setCellValue('D'.$mulai,$val->penulis);
            $ws->setCellValue('E'.$mulai,$val->no_isbn);
            $ws->setCellValue('F'.$mulai,$val->thn_terbit);
            $ws->setCellValue('G'.$mulai,$this->M_bln->get_Produkname($val->info_produk));
            $ws->setCellValue('H'.$mulai,$val->deskripsi);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function rekam_bhs_sastra($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$this->M_bln->get_row_kabkot($val->id_kabkot));
            //$ws->setCellValue('C'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('C'.$mulai,$val->judul);
            $ws->setCellValue('D'.$mulai,$val->penyusun);
            $ws->setCellValue('E'.$mulai,tanggal($val->tgl_mulai));
            $ws->setCellValue('F'.$mulai,tanggal($val->tgl_selesai));
            $ws->setCellValue('G'.$mulai,$val->lokasi);
            $ws->setCellValue('H'.$mulai,$val->nara_sumber);
            $ws->setCellValue('I'.$mulai,$val->narasi);
            $ws->setCellValue('J'.$mulai,$val->genre);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function ukbi($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$this->M_bln->get_row_kabkot($val->id_kabkot));
            $ws->setCellValue('C'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('D'.$mulai,$val->lokasi_pengajuan);
            $ws->setCellValue('E'.$mulai,tanggal($val->tgl_pengajuan));
            $ws->setCellValue('F'.$mulai,$val->jenis_pengajuan);
            $ws->setCellValue('G'.$mulai,$val->materi_pengajuan);
            $ws->setCellValue('H'.$mulai,$val->kat_peserta);
            $ws->setCellValue('I'.$mulai,$val->jum_peserta);
            $ws->setCellValue('J'.$mulai,$val->hasil_pengajuan);
            $ws->setCellValue('K'.$mulai,$val->lampiran);
            $ws->setCellValue('L'.$mulai,$val->ket);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function bengkel_bhs_sastra($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$this->M_bln->get_row_kabkot($val->id_kabkot));
            $ws->setCellValue('C'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('D'.$mulai,$val->nama_keg);
            $ws->setCellValue('E'.$mulai,$val->kat);
            $ws->setCellValue('F'.$mulai,tanggal($val->tgl_mulai));
            $ws->setCellValue('G'.$mulai,tanggal($val->tgl_selesai));
            $ws->setCellValue('H'.$mulai,$val->pematri);
            $ws->setCellValue('I'.$mulai,$val->jum_peserta);
            $ws->setCellValue('J'.$mulai,$val->nama_lembaga);
            $ws->setCellValue('K'.$mulai,$val->peserta);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function penyuluhan($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$this->M_bln->get_row_kabkot($val->id_kabkot));
            $ws->setCellValue('C'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('D'.$mulai,$val->nama_keg);
            $ws->setCellValue('E'.$mulai,$val->kat);
            $ws->setCellValue('F'.$mulai,tanggal($val->tgl_mulai));
            $ws->setCellValue('G'.$mulai,tanggal($val->tgl_selesai));
            $ws->setCellValue('H'.$mulai,$val->narasumber);
            $ws->setCellValue('I'.$mulai,$val->sasaran);
            $ws->setCellValue('J'.$mulai,$val->jum_peserta);
            $ws->setCellValue('K'.$mulai,$val->materi);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function siaran_rri($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$val->judul_naskah);
            $ws->setCellValue('C'.$mulai,$val->penulis_naskah);
            $ws->setCellValue('D'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('E'.$mulai,tanggal($val->tgl_perekaman));
            $ws->setCellValue('F'.$mulai,tanggal($val->tgl_disiarkan));
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function bipa($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$val->nama_pembelajar);
            $ws->setCellValue('C'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('D'.$mulai,$val->negara);
            $ws->setCellValue('E'.$mulai,$val->tingkat);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function festival($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$this->M_bln->get_row_kabkot($val->id_kabkot));
            $ws->setCellValue('C'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('D'.$mulai,$val->nama);
            $ws->setCellValue('E'.$mulai,$val->tempat);
            $ws->setCellValue('F'.$mulai,$val->jum_peserta);
            $ws->setCellValue('G'.$mulai,$val->pemenang);
            $ws->setCellValue('H'.$mulai,$val->lokasi);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function jambore($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,tanggal($val->waktu));
            $ws->setCellValue('C'.$mulai,$val->tempat);
            $ws->setCellValue('D'.$mulai,$val->utusan);
            $ws->setCellValue('E'.$mulai,$val->nama_panitia);
            $ws->setCellValue('F'.$mulai,$val->jenis_tampilan);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function seminar($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$val->nama_seminar);
            $ws->setCellValue('C'.$mulai,$val->pemateri);
            $ws->setCellValue('D'.$mulai,tanggal($val->tgl_seminar));
            $ws->setCellValue('E'.$mulai,$val->tempat);
            $ws->setCellValue('F'.$mulai,$val->lokasi);
            $ws->setCellValue('G'.$mulai,$val->jum_peserta);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function pelatihan($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$this->M_bln->get_row_kabkot($val->id_kabkot));
            $ws->setCellValue('C'.$mulai,$val->nm_pelatihan);
            $ws->setCellValue('D'.$mulai,tanggal($val->tgl_latihan));
            $ws->setCellValue('E'.$mulai,$val->nm_lembaga);
            $ws->setCellValue('F'.$mulai,$val->jum_peserta);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function surat_kabar($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$val->jdl_tulisan);
            $ws->setCellValue('C'.$mulai,$val->penulis);
            $ws->setCellValue('D'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('E'.$mulai,$val->nm_surat_kbr);
            $ws->setCellValue('F'.$mulai,tanggal($val->tgl_terbit));
            $ws->setCellValue('G'.$mulai,$val->rubrik);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function anugerah_kawisatra($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$val->nm_keg);
            $ws->setCellValue('C'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('D'.$mulai,$val->tempat);
            $ws->setCellValue('E'.$mulai,$val->kat);
            $ws->setCellValue('F'.$mulai,$val->pemenang);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function kegiatan_lain($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$this->M_bln->get_row_kabkot($val->id_kabkot));
            $ws->setCellValue('C'.$mulai,$val->nama_keg);
            $ws->setCellValue('D'.$mulai,tanggal($val->tgl_keg));
            $ws->setCellValue('E'.$mulai,$val->tempat);
            $ws->setCellValue('F'.$mulai,$val->sasaran);
            $ws->setCellValue('G'.$mulai,$val->jum_peserta);
            $ws->setCellValue('H'.$mulai,$val->nama_penyuluh);
            $ws->setCellValue('I'.$mulai,$val->jum_penyuluh);
            $ws->setCellValue('J'.$mulai,$val->jum_peserta_penyuluh);   
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function duta_bahasa($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->duta_bhs_data($maping->query,'umum',$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('C'.$mulai,$val->tempat);
            $ws->setCellValue('D'.$mulai,$val->lokasi);
            $ws->setCellValue('E'.$mulai,$val->jum_peserta);
            $ws->setCellValue('F'.$mulai,$val->pemenang);
            $ws->setCellValue('G'.$mulai,$val->asal_pddkn);
            $ws->setCellValue('H'.$mulai,$val->ket_juara);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function duta_bahasa_pelajar($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName().' PELAJAR');
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->duta_bhs_data($maping->query,'pelajar',$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,tanggal($val->tgl_pelaksanaan));
            $ws->setCellValue('C'.$mulai,$val->tempat);
            $ws->setCellValue('D'.$mulai,$val->lokasi);
            $ws->setCellValue('E'.$mulai,$val->jum_peserta);
            $ws->setCellValue('F'.$mulai,$val->pemenang);
            $ws->setCellValue('G'.$mulai,$val->asal_pddkn);
            $ws->setCellValue('H'.$mulai,$val->ket_juara);
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
    
    function sosialisasi_pemartabatan_bhs_negara($id,$thn,$bln){
        $xl=new Excel_generator();
        $xl->setActiveSheetIndex(0);
        $ws=$xl->getActiveSheet();
        $this->set_idmapinglap($id);
        $maping=$this->M_bln->get_row_maping($this->id_mapinglap);
        $last_col=$this->last_col();
        $list_col_val=$this->list_col();
        $list_col_head=$this->list_col_head();
        $filename=$maping->url.'-'.date('Y-m-d');
        $kol=array();
        // Create Header
        $ws->GetStyle('A1')->getFont()->setSize(11);
        $ws->GetStyle('A2')->getFont()->setSize(11);
        $ws->GetStyle('A3')->getFont()->setSize(11);
        
        $ws->getStyle('A1')->getFont()->setBold(true);
        $ws->getStyle('A2')->getFont()->setBold(true);
        $ws->getStyle('A3')->getFont()->setBold(true);$ws->getStyle('C1')->getFont()->setBold(true);
        
        $ws->setCellValue('A1','LAPORAN '.$this->get_menuName());
        //$ws->setCellValue('A2','FAKULTAS EKONOMI');
        $ws->setCellValue('A3',strtoupper(bulan($bln)).' '.$thn);
        
        //$ws->getColumnDimension('C')->setAutoSize(true);
        $ws->mergeCells('A1:'.$last_col.'1');
        $ws->mergeCells('A2:'.$last_col.'2');
        $ws->mergeCells('A3:'.$last_col.'3');
        
        $set_align=array('horizontal'=>PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        
        $ws->getStyle('A1')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A2')->getAlignment()->applyFromArray($set_align);
        $ws->getStyle('A3')->getAlignment()->applyFromArray($set_align);
        // End Header
        
        //set tabel data
        // header table
        
        $j=count($list_col_head);
        for($i=0; $i<$j; $i++){
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->getColumnDimension($list_col_head[$i])->setAutoSize(true);
            $ws->getStyle($list_col_head[$i].'5',$list_col_val[$i])->getFont()->setBold(true);
            $ws->setCellValue($list_col_head[$i].'5',$list_col_val[$i]);
        }
        
        // VALUE DATA
        $mulai=5;
        $no=1;
        $data=$this->M_bln->get_data_lap($maping->query,$thn,$bln);
        foreach($data as $val){
            $mulai++;
            $ws->getStyle('A'.$mulai.':'.$last_col.$mulai)->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $ws->setCellValue('A'.$mulai,$no++);
            $ws->setCellValue('B'.$mulai,$this->M_bln->get_row_kabkot($val->id_kabkot));
            $ws->setCellValue('C'.$mulai,$val->judul);
            $ws->setCellValue('D'.$mulai,tanggal($val->waktu));
            $ws->setCellValue('E'.$mulai,$val->ranah);
            $ws->setCellValue('F'.$mulai,$val->tmpt_sosialisasi);
            $ws->setCellValue('G'.$mulai,$val->peserta_sosialisasi);
            $ws->setCellValue('H'.$mulai,$val->panitia_daerah);
            $ws->setCellValue('I'.$mulai,$val->nara_sumber);  
        }
        
        // Redirect output to a client’s web browser (Excel2007)
        header('<a class="zem_slink" title="Internet media type" href="http://en.wikipedia.org/wiki/Internet_media_type" target="_blank" rel="wikipedia">Content-Type</a>: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
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
    }
}