<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Import_data extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_import');
       include(APPPATH.'libraries/PHPExcel/IOFactory.php');
    }

    public function index(){
        $data['dt_menu']=$this->M_import->getMenu();
		$this->load->view("page_index",$data);
	}
    
    public function load_form(){
        $data['func']=$this->input->post('func');
        $data['menu']=$this->input->post('nm');
        $this->load->view("load_form",$data);
	}
    
    public function sastra(){
        if($this->input->method() == "post"){
            $excel=$_FILES['excel'];
            if($excel['name'] != null){
                $config['upload_path'] = 'common/excel/upload/';
        		$config['allowed_types'] = 'xls';
        		//$config['max_size']	= '1500';
        		//$config['max_width']  = '1024';
        		//$config['max_height']  = '768';
                
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if (! $this->upload->do_upload('excel'))
                {
                    $error = array('error' => $this->upload->display_errors());
                    $notif=$this->upload->display_errors();
                    $n=array(
                        'error'=>true,
                        'msg'=>$notif
                    );
                    echo json_encode($n);
                }
                else
                {   
                    $err=FALSE;
                    $img_data=(object)$this->upload->data();
                    $fileName='./common/excel/upload/'.$img_data->file_name;
                    $ex= new PHPExcel_IOFactory();
                    $excelReader = $ex->createReaderForFile($fileName);
                    $excelReader->setReadDataOnly(true);
                    $excelReader->setLoadAllSheets();
                    $excelObj = $excelReader->load($fileName);
                    $excelObj->getActiveSheet()->toArray(null, true,true,true);
                    
                    $worksheetNames = $excelObj->getSheetNames($fileName);
                    $return = array();
                    foreach($worksheetNames as $key => $sheetName){
                        $excelObj->setActiveSheetIndexByName($sheetName);
                        $return[$sheetName] = $excelObj->getActiveSheet()->toArray(null, true,true,true);
                    }
                    $cells=$return['Sheet1'];
                    $ar=array();
                    for($mulai=8; $mulai<=count($cells); $mulai++){
                        $ar[]=$cells[$mulai];
                        
                        $dt[]=array(
                            'satuan_kerja'=>'balai bahasa provinsi jawa barat',
                            'id_kabkot'=>$cells[$mulai]['A'],
                            'tahun'=>$cells[$mulai]['B'],
                            'peneliti'=>$cells[$mulai]['D'],
                            'judul'=>$cells[$mulai]['C'],
                            'tgl_mulai'=>$this->set_date($cells[$mulai]['E']),
                            'tgl_selesai'=>$this->set_date($cells[$mulai]['F']),
                            'lama_penelitian'=>$cells[$mulai]['G'],
                            'satuan_lama_penelitian'=>$this->satuan($cells[$mulai]['G']),
                            'abstraksi'=>$cells[$mulai]['H'],
                            'publikasi'=>'1',
                            'thn_terbit'=>$cells[$mulai]['I'],
                            'kerja_sama'=>$cells[$mulai]['J']
                        );
                        //$this->db->insert('t_penelitian_bas',$dt);
                    }
                    
                    $n=array(
                        'error'=>false,
                        'msg'=>count($ar)
                    );
                    //echo json_encode($n);
                    echo_pre($dt);
                }
            }
        }
    }
    private function satuan($s=''){
        $lama=null;
        if($s !=''){
            $ex=explode(' ',$s);
            if(!empty($ex[1])){
                $lama=strtolower($ex[1]);
            }
        }
        return $lama;
    }
    private function set_date($tgl=''){
        $result=null;
        if($tgl != ''){
            $ex=explode('/',$tgl);
            if(empty($ex[1]) && empty($ex[2])){
                $result=date('Y-m-d',PHPExcel_Shared_Date::ExcelToPHP($tgl));
            }else if(!empty($ex[1]) && !empty($ex[2]) && !empty($ex[0])){
                $tgl=$ex[2].'-'.$ex[0].'-'.$ex[1];
                $result=$tgl;
            }else{
                $result=$tgl;
            }
        }
        return $result;
    }
    function read_excel(){
        // Load the spreadsheet reader library
        $this->load->library('excel_reader');
        
        // Read the spreadsheet via a relative path to the document
        // for example $this->excel_reader->read('./uploads/file.xls');
        $this->excel_reader->read('./common/excel/upload/penelitian_sastra.xls');
        
        // Get the contents of the first worksheet
        $worksheet = $this->excel_reader->sheets[0];
        
        $numRows = $worksheet['numRows']; // ex: 14
        $numCols = $worksheet['numCols']; // ex: 4
        $cells = $worksheet['cells']; // the 1st row are usually the field's name
        //$last=end($cells);
        $ar=array();
        for($mulai=8; $mulai<=count($cells); $mulai++){
            $ar[]=$cells[$mulai];
            //echo_pre($cells[$mulai][1]);
            //echo $mulai;
        }
        echo count($ar).'<br>';
        echo count($cells);
    }
    function read_excel_b(){
        $fileName='./common/excel/upload/penelitian_sastra.xls';
        $ex= new PHPExcel_IOFactory();
        $excelReader = $ex->createReaderForFile($fileName);
        $excelReader->setReadDataOnly(true);
        $excelReader->setLoadAllSheets();
        $excelObj = $excelReader->load($fileName);
        $excelObj->getActiveSheet()->toArray(null, true,true,true);
        
        $worksheetNames = $excelObj->getSheetNames($fileName);
        $return = array();
        foreach($worksheetNames as $key => $sheetName){
            $excelObj->setActiveSheetIndexByName($sheetName);
            $return[$sheetName] = $excelObj->getActiveSheet()->toArray(null, true,true,true);
        }
        $cells=$return['Sheet1'];
        $ar=array();
        for($mulai=8; $mulai<=count($cells); $mulai++){
            $ar[]=$cells[$mulai];
            $dt=array(
                'satuan_kerja'=>'balai bahasa provinsi jawa barat',
                'id_kabkot'=>$cells[$mulai]['A'],
                'tahun'=>$cells[$mulai]['B'],
                'peneliti'=>$cells[$mulai]['D'],
                'judul'=>$cells[$mulai]['C'],
                'tgl_mulai'=>$this->set_date($cells[$mulai]['E']),
                'tgl_selesai'=>$this->set_date($cells[$mulai]['F']),
                'lama_penelitian'=>$cells[$mulai]['G'],
                'satuan_lama_penelitian'=>$this->satuan($cells[$mulai]['G']),
                'abstraksi'=>$cells[$mulai]['H'],
                'publikasi'=>'1',
                'thn_terbit'=>$cells[$mulai]['I'],
                'kerja_sama'=>$cells[$mulai]['J']
            );
            echo_pre($dt);
        }
    }
}