<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kegiatan extends Userauth
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("M_kegiatan");
    }

    public function index()
	{
		$this->load->view("page_index");
	}
    
    public function add()
	{
		$data['dt_kabkot']=$this->M_kegiatan->get_kabkot();
        $this->load->view("page_add", $data);
	}
    
    public function do_add()
	{
        if($this->input->method() == 'post'){
            $nm_keg=$this->input->post('nm_keg');
            $tempat=$this->input->post('tempat');
            $kabkot=$this->input->post('kabkot');
            $tgl_keg=$this->input->post('tgl_keg');
            $jum_peserta=$this->input->post('jum_peserta');
            $jum_penyuluh=$this->input->post('jum_penyuluh');
            $nm_penyuluh=$this->input->post('nm_penyuluh');
            $jum_peserta_penyuluh=$this->input->post('jum_peserta_penyuluh');
            $sasaran=$this->input->post('sasaran');
            $ket=$this->input->post('ket');
            $tahun=$this->exp_date($tgl_keg);
            $data=array(
                'nama_keg'=>$nm_keg,
                'tgl_keg'=>$tgl_keg,
                'sasaran'=>$sasaran,
                'tempat'=>$tempat,
                'jum_peserta'=>$jum_peserta,
                'jum_penyuluh'=>$jum_penyuluh,
                'ket'=>$ket,
                'nama_penyuluh'=>$nm_penyuluh,
                'jum_peserta_penyuluh'=>$jum_peserta_penyuluh,
                'id_kabkot'=>$kabkot,
                'tahun'=>$tahun,
                'tgl_pelaksanaan'=>$tgl_keg,
                'user_input'=>$this->session->username
            );
            if($this->db->insert('t_kegiatan',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_keg,
                    'jenis'=>'pembinaan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'t_kegiatan',
                    'menu'=>'Kegiatan Lainnya'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','OK!!! data kegiatan baru berhasil ditambahkan'));
            }
            redirect('kegiatan');
        }else{
            show_404();
        }
	}
    
    public function upd($id=null)
	{
        if($id!=null){
            $data['dt_row']=$this->M_kegiatan->get_row('id_kegiatan',$id);
            $data['dt_kabkot']=$this->M_kegiatan->get_kabkot();
            $this->load->view('page_upd',$data);
        }else{
            show_404();
        }
	}
    
    public function do_upd()
	{
        if($this->input->method() == 'post'){
            $nm_keg=$this->input->post('nm_keg');
            $tempat=$this->input->post('tempat');
            $kabkot=$this->input->post('kabkot');
            $tgl_keg=$this->input->post('tgl_keg');
            $jum_peserta=$this->input->post('jum_peserta');
            $jum_penyuluh=$this->input->post('jum_penyuluh');
            $nm_penyuluh=$this->input->post('nm_penyuluh');
            $jum_peserta_penyuluh=$this->input->post('jum_peserta_penyuluh');
            $sasaran=$this->input->post('sasaran');
            $ket=$this->input->post('ket');
            $tahun=$this->exp_date($tgl_keg);
            $id=$this->input->post('id_keg');
            $data=array(
                'nama_keg'=>$nm_keg,
                'tgl_keg'=>$tgl_keg,
                'sasaran'=>$sasaran,
                'tempat'=>$tempat,
                'jum_peserta'=>$jum_peserta,
                'jum_penyuluh'=>$jum_penyuluh,
                'ket'=>$ket,
                'nama_penyuluh'=>$nm_penyuluh,
                'jum_peserta_penyuluh'=>$jum_peserta_penyuluh,
                'id_kabkot'=>$kabkot,
                'tgl_pelaksanaan'=>$tgl_keg,
                'tahun'=>$tahun
            );
            $this->M_kegiatan->get_upd($id,$data);
            $this->M_kegiatan->upd_tgl_input($id,$tgl_keg);
            $this->session->set_flashdata('notif',alert('success','OK!!! update data kegitatan '.$nm_keg.' berhasil'));
            redirect('kegiatan');
        }else{
            show_404();
        }
	}
    
    public function ajax_list()
	{
		if ($this->input->is_ajax_request()){
           $list = $this->M_kegiatan->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = ucwords($val->nama_kota);
                $row[] = $val->tgl_keg;
                $row[] = $val->nama_keg;
                $row[] = $val->tempat;
                $row[] = $val->jum_peserta;
                $row[] = $val->jum_penyuluh;
                //$row[] = $val->nama_penyuluh;
                $row[] = $val->jum_peserta_penyuluh;
                $ac="'".$val->id_kegiatan."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("kegiatan/upd/".$val->id_kegiatan).'" title="Edit"><i class="fa fa-edit"></i></a>
 		             
                      <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                      ';
                //<a class="btn btn-fill btn-sm btn-success" href="'.base_url("kegiatan/album/list_album/".$val->id_kegiatan).'" title="Album"><i class="fa fa-picture-o"></i></a>
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_kegiatan->count_all(),
    					"recordsFiltered" => $this->M_kegiatan->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}
    
    private function exp_date($date){
        $ex=explode('-',$date);
        return $ex[0];
    }
    
    public function hapus()
	{
	   if($this->input->is_ajax_request())
       {
            $key=$this->input->post('key');
            $this->M_kegiatan->delete_by_id($key);
            $this->M_kegiatan->del_lap_id($key);
		    echo json_encode(array("status" => TRUE));
       }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_kegiatan->get_row('id_kegiatan',$key);
            $this->load->view("ajax_load_v",$data);
		}else{
		  show_404();
		}
	}
    
    public function do_verify(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $stts=$this->input->post('stts');
            $data=array('verify'=>$stts);
            $this->M_kegiatan->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}