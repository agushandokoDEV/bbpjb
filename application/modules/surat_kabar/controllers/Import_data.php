<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Import_data extends Userauth {
    
    private $filenamexl='template-surat_kabar.xls';
    private $mulai_rowxl=8;
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_surat_kabar');
       include(APPPATH.'libraries/PHPExcel/IOFactory.php');
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
    
    public function index(){
        $data['total_data']=$this->M_surat_kabar->get_total();
        $data['total_import']=$this->M_surat_kabar->get_total('1');
        $data['filenamexl']=$this->filenamexl;
        $this->load->view("page_import",$data);
    }
    
    public function del_import(){
        if($this->input->method() == "post"){
            $this->M_surat_kabar->del_import();
            $this->session->set_flashdata('notif_del',alert('info','OK !!! Reset data berhasil...'));
            redirect('surat_kabar/import_data/');
        }else{
            show_404();
        }
    }
    public function import_data(){
        if($this->input->method() == "post"){
            $excel=$_FILES['excel'];
            //echo_pre($excel);
            if($excel['name'] == $this->filenamexl){
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
                    $this->session->set_flashdata('notif',alert('danger','Upps !!! Import data error...'));
                    redirect('surat_kabar/import_data/');
                }
                else
                {   
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
                    $cells=$return['Worksheet'];
                    $ar=array();
                    $total=array();
                    for($mulai=$this->mulai_rowxl; $mulai<=count($cells); $mulai++){
                        $ar[]=$cells[$mulai];
                        $tgl_pelaksanaan=$this->set_date($cells[$mulai]['G']);
                        
                        $dt=array(
                            'jdl_tulisan'=>$cells[$mulai]['B'],
                            'penulis'=>$cells[$mulai]['C'],
                            'nm_surat_kbr'=>$cells[$mulai]['D'],
                            'tgl_terbit'=>$this->set_date($cells[$mulai]['E']),
                            'rubrik'=>$cells[$mulai]['F'],
                            'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                            'stts_import'=>1,
                            'user_input'=>$this->session->username
                        );
                        if(empty($cells[$mulai]['B']) && empty($cells[$mulai]['C']) && empty($cells[$mulai]['D']) && empty($cells[$mulai]['E']) && empty($cells[$mulai]['F']) && empty($cells[$mulai]['G'])){
                            //$this->session->set_flashdata('notif',alert('danger','Upss !!! data kosong...'));
                        }else{
                            $total[]=$dt;
                            $this->db->insert('surat_kabar',$dt);
                            $dt_lap=array(
                                'username'=>$this->session->username,
                                'tgl_input'=>$tgl_pelaksanaan,
                                'jenis'=>'pembinaan',
                                'id_pk'=>$this->db->insert_id(),
                                'tbl_data'=>'surat_kabar',
                                'menu'=>'Surat Kabar'
                            );
                            $this->db->insert('t_laporan',$dt_lap);
                        }
                    }
                    $this->session->set_flashdata('notif','<hr class="hr"/>'.alert('success','OK !!! Import data berhasil'));
                    $this->session->set_flashdata('import','<h4 class="text-center"><i>Jumlah import data : '.count($total).'</i></h4>');
                    redirect('surat_kabar/import_data/');
                }
            }else{
                $this->session->set_flashdata('notif',alert('danger','Upps !!! Import data error... <p>nama file yang di import : '.$excel['name'].'</p> <p>nama file harus : '.$this->filenamexl.'</p>'));
                redirect('surat_kabar/import_data/');
            }
        }else{
            show_404();
        }
    }
}