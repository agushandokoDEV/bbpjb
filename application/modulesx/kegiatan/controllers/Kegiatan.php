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
                'id_kabkot'=>$kabkot
            );
            if($this->db->insert('t_kegiatan',$data)){
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
                'id_kabkot'=>$kabkot
            );
            if($this->M_kegiatan->get_upd($id,$data)){
                $this->session->set_flashdata('notif',alert('info','OK!!! update data kegitatan '.$nm_keg.' berhasil'));
            }
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
                $row[] = $val->nama_keg;
                $row[] = tanggal($val->tgl_keg);
                $row[] = $val->tempat;
                $row[] = $val->jum_peserta;
                $row[] = $val->jum_penyuluh;
                //$row[] = $val->nama_penyuluh;
                $row[] = $val->jum_peserta_penyuluh;
                $row[] = ucwords($val->nama_kota);
                $ac="'".$val->id_kegiatan."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("kegiatan/upd/".$val->id_kegiatan).'" title="Edit"><i class="fa fa-edit"></i></a>
 		             <a class="btn btn-fill btn-sm btn-success" href="'.base_url("kegiatan/album/list_album/".$val->id_kegiatan).'" title="Album"><i class="fa fa-picture-o"></i></a>
                      <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                      ';
                if($this->session->userdata('id_role') == '4'){
                    if($val->verify == '1'){
                        $action .='<a class="btn btn-sm btn-primary" href="#" onclick="verify('.$ac.')" title="Belum terverifikasi"><span class="glyphicon glyphicon-question-sign"></span></a>';
                    }else if($val->verify == '2'){
                        $action .='<a class="btn btn-sm btn-success" href="#" onclick="verify('.$ac.')" title="Sudah terverifikasi"><span class="glyphicon glyphicon-ok-sign"></span></a>';
                    }else{
                        $action .='<a class="btn btn-sm btn-warning" href="#" onclick="verify('.$ac.')" title="Tidak terverifikasi"><span class="glyphicon glyphicon-remove-sign"></span></a>';
                    }
                    
                }
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
    
    public function hapus()
	{
	   if($this->input->is_ajax_request())
       {
            $key=$this->input->post('key');
            $this->M_kegiatan->delete_by_id($key);
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