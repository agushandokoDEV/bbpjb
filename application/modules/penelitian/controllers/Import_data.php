<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Import_data extends Userauth {
    
    private $filenamexl='';
    private $mulai_rowxl=10;
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_import');
       include(APPPATH.'libraries/PHPExcel/IOFactory.php');
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
    
    public function sastra(){
        $data['total_sastra']=$this->M_import->get_total('sastra');
        $data['total_import']=$this->M_import->get_total('sastra','1');
        $data['filenamexl']='template-penelitian_sastra.xls';
        $this->load->view("sastra/page_import",$data);
    }
    
    public function bahasa(){
        $data['total_bahasa']=$this->M_import->get_total('bahasa');
        $data['total_import']=$this->M_import->get_total('bahasa','1');
        $data['filenamexl']='template-penelitian_bahasa.xls';
        $this->load->view("bahasa/page_import",$data);
    }
    
    public function del_penbas(){
        if($this->input->method() == "post"){
            $kat=$this->input->post('kat');
            $this->M_import->del_import($kat);
            $this->session->set_flashdata('notif_del',alert('info','OK !!! Reset data berhasil...'));
            redirect('penelitian/import_data/'.$kat);
        }else{
            show_404();
        }
    }
    public function penbas_import(){
        if($this->input->method() == "post"){
            $kat=$this->input->post('kat');
            $excel=$_FILES['excel'];
            if($kat == 'bahasa'){
                $this->filenamexl='template-penelitian_bahasa.xls';
            }else if($kat == 'sastra'){
                $this->filenamexl='template-penelitian_sastra.xls';
            }else{
                $this->filenamexl='error';
            }
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
                    redirect('penelitian/import_data/'.$kat);
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
                        
                        $tgl_pelaksanaan=$this->set_date($cells[$mulai]['C']);
                        $tahun=get_tahun($tgl_pelaksanaan);
                        
                        $dt=array(
                            'satuan_kerja'=>'balai bahasa provinsi jawa barat',
                            'id_kabkot'=>$cells[$mulai]['B'],
                            'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                            'peneliti'=>$cells[$mulai]['D'],
                            'judul'=>$cells[$mulai]['E'],
                            'tgl_mulai'=>$this->set_date($cells[$mulai]['F']),
                            'tgl_selesai'=>$this->set_date($cells[$mulai]['G']),
                            'lama_penelitian'=>$cells[$mulai]['H'],
                            'satuan_lama_penelitian'=>$cells[$mulai]['I'],
                            'publikasi'=>$cells[$mulai]['J'],
                            'thn_terbit'=>$cells[$mulai]['K'],
                            'abstraksi'=>$cells[$mulai]['L'],
                            'kerja_sama'=>$cells[$mulai]['M'],
                            'stts_import'=>1,
                            'user_input'=>$this->session->username,
                            'kat_peneliti'=>$kat,
                            'tahun'=>$tahun
                        );
                        if(empty($cells[$mulai]['B']) && empty($cells[$mulai]['C']) && empty($cells[$mulai]['C']) && empty($cells[$mulai]['D']) && empty($cells[$mulai]['E']) && empty($cells[$mulai]['F']) && empty($cells[$mulai]['G']) && empty($cells[$mulai]['H']) && empty($cells[$mulai]['I']) && empty($cells[$mulai]['J']) && empty($cells[$mulai]['K']) && empty($cells[$mulai]['L']) && empty($cells[$mulai]['M'])){
                            //$this->session->set_flashdata('notif',alert('danger','Upss !!! data kosong...'));
                        }else{
                            $total[]=$dt;
                            $this->db->insert('t_penelitian_bas',$dt);
                            $dt_lap=array(
                                'username'=>$this->session->username,
                                'tgl_input'=>$tgl_pelaksanaan,
                                'jenis'=>'pengembangan',
                                'id_pk'=>$this->db->insert_id(),
                                'tbl_data'=>'t_penelitian_bas',
                                'menu'=>'Penelitian '.ucfirst($kat)
                            );
                            $this->db->insert('t_laporan',$dt_lap);
                        }
                    }
                    $this->session->set_flashdata('notif','<hr class="hr"/>'.alert('success','OK !!! Import data berhasil...'));
                    $this->session->set_flashdata('import','<h4 class="text-center"><i>Jumlah import data : '.count($total).'</i></h4>');
                    redirect('penelitian/import_data/'.$kat);
                }
            }else{
                $this->session->set_flashdata('notif',alert('danger','Upps !!! Import data error... <p>nama file yang di import : '.$excel['name'].'</p> <p>nama file harus : '.$this->filenamexl.'</p>'));
                redirect('penelitian/import_data/'.$kat);
            }
        }else{
            show_404();
        }
    }
}