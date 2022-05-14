<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pelatihan_mutu_pegawai extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_pelatihan_mutu_pegawai','M_mutu');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_mutu->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = $val->nm_pelatihan;
                $row[] = $val->nm_lembaga;
                $row[] = $val->jum_peserta;
                $row[] = tanggal($val->tgl_latihan);
                $ac="'".$val->id_pelatihan_mutu."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("pelatihan_mutu_pegawai/upd/".$val->id_pelatihan_mutu).'" title="Edit"><i class="fa fa-edit"></i></a>
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
    					"recordsTotal" => $this->M_mutu->count_all(),
    					"recordsFiltered" => $this->M_mutu->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
    }

    public function add(){
		$this->load->view("page_add");
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $nm_pelatihan=$this->input->post('nm_pelatihan');
            $nm_lembaga=$this->input->post('nm_lembaga');
            $jum_peserta=$this->input->post('jum_peserta');
            $tgl_latihan=$this->input->post('tgl_latihan');
            $data=array(
                'nm_pelatihan'=>$nm_pelatihan,
                'nm_lembaga'=>$nm_lembaga,
                'jum_peserta'=>$jum_peserta,
                'tgl_latihan'=>$tgl_latihan
            );
            if($this->db->insert('t_pelatihan_mutu',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data pelatihan dan peningkatan mutu Pegawai berhasil ditambahkan..'));
            }
            redirect('pelatihan_mutu_pegawai');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_mutu->get_row('id_pelatihan_mutu',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $nm_pelatihan=$this->input->post('nm_pelatihan');
            $nm_lembaga=$this->input->post('nm_lembaga');
            $jum_peserta=$this->input->post('jum_peserta');
            $tgl_latihan=$this->input->post('tgl_latihan');
            $id=$this->input->post('id');
            $data=array(
                'nm_pelatihan'=>$nm_pelatihan,
                'nm_lembaga'=>$nm_lembaga,
                'jum_peserta'=>$jum_peserta,
                'tgl_latihan'=>$tgl_latihan
            );
            if($this->M_mutu->get_upd($id,$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! update data pelatihan dan peningkatan mutu Pegawai berhasil..'));
            }
            redirect('pelatihan_mutu_pegawai');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_mutu->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_mutu->get_row('id_pelatihan_mutu',$key);
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
            $this->M_mutu->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}