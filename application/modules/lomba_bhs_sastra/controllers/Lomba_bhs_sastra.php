<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Lomba_bhs_sastra extends CI_Controller {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_lomba_bhs_sastra','M_lomba');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_lomba->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = $val->nm_lomba;
                $row[] = $val->tmpt_lomba;
                $row[] = $val->peserta_lomba;
                $row[] = $val->ket_lomba;
                $ac="'".$val->id_lomba_bhs_sastra."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("lomba_bhs_sastra/upd/".$val->id_lomba_bhs_sastra).'" title="Edit"><i class="fa fa-edit"></i></a>
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
    					"recordsTotal" => $this->M_lomba->count_all(),
    					"recordsFiltered" => $this->M_lomba->count_filtered(),
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
            $nm_lomba=$this->input->post('nm_lomba');
            $tmpt_lomba=$this->input->post('tmpt_lomba');
            $peserta_lomba=$this->input->post('peserta_lomba');
            $ket_lomba=$this->input->post('ket_lomba');
            $data=array(
                'nm_lomba'=>$nm_lomba,
                'tmpt_lomba'=>$tmpt_lomba,
                'peserta_lomba'=>$peserta_lomba,
                'ket_lomba'=>$ket_lomba
            );
            if($this->db->insert('t_lomba_bhs_sastra',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data Lomba kebahasaan dan kesastraan berhasil ditambahkan..'));
            }
            redirect('lomba_bhs_sastra');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_lomba->get_row('id_lomba_bhs_sastra',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $nm_lomba=$this->input->post('nm_lomba');
            $tmpt_lomba=$this->input->post('tmpt_lomba');
            $peserta_lomba=$this->input->post('peserta_lomba');
            $ket_lomba=$this->input->post('ket_lomba');
            $id=$this->input->post('id');
            $data=array(
                'nm_lomba'=>$nm_lomba,
                'tmpt_lomba'=>$tmpt_lomba,
                'peserta_lomba'=>$peserta_lomba,
                'ket_lomba'=>$ket_lomba
            );
            $this->M_lomba->get_upd($id,$data;
            $this->session->set_flashdata('notif',alert('info','OK !!! update data Lomba kebahasaan dan kesastraan berhasil..'));
            redirect('lomba_bhs_sastra');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_lomba->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_lomba->get_row('id_lomba_bhs_sastra',$key);
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
            $this->M_lomba->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}