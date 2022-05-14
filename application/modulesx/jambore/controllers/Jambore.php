<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Jambore extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_jambore');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_jambore->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = $val->waktu;
                $row[] = $val->tempat;
                $row[] = $val->utusan;
                $row[] = $val->nama_panitia;
                $row[] = $val->jenis_tampilan;
                $ac="'".$val->id_jambore."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("jambore/upd/".$val->id_jambore).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
               /*
                if($this->session->userdata('id_role') == '4'){
                    if($val->verify == '1'){
                        $action .='<a class="btn btn-sm btn-primary" href="#" onclick="verify('.$ac.')" title="Belum terverifikasi"><span class="glyphicon glyphicon-question-sign"></span></a>';
                    }else if($val->verify == '2'){
                        $action .='<a class="btn btn-sm btn-success" href="#" onclick="verify('.$ac.')" title="Sudah terverifikasi"><span class="glyphicon glyphicon-ok-sign"></span></a>';
                    }else{
                        $action .='<a class="btn btn-sm btn-warning" href="#" onclick="verify('.$ac.')" title="Tidak terverifikasi"><span class="glyphicon glyphicon-remove-sign"></span></a>';
                    }
                    
                }
                */
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_jambore->count_all(),
    					"recordsFiltered" => $this->M_jambore->count_filtered(),
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
            $waktu=$this->input->post('waktu');
            $tempat=$this->input->post('tempat');
            $utusan=$this->input->post('utusan');
            $nama_panitia=$this->input->post('nama_panitia');
            $jenis_tampilan=$this->input->post('jenis_tampilan');
            $data=array(
                'waktu'=>$waktu,
                'utusan'=>$utusan,
                'tempat'=>$tempat,
                'nama_panitia'=>$nama_panitia,
                'jenis_tampilan'=>$jenis_tampilan
            );
            if($this->db->insert('t_jambore',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data Jambore berhasil ditambahkan..'));
            }
            redirect('jambore');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_jambore->get_row('id_jambore',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $waktu=$this->input->post('waktu');
            $tempat=$this->input->post('tempat');
            $utusan=$this->input->post('utusan');
            $nama_panitia=$this->input->post('nama_panitia');
            $jenis_tampilan=$this->input->post('jenis_tampilan');
            $id=$this->input->post('id');
            $data=array(
                'waktu'=>$waktu,
                'utusan'=>$utusan,
                'tempat'=>$tempat,
                'nama_panitia'=>$nama_panitia,
                'jenis_tampilan'=>$jenis_tampilan
            );
            if($this->M_jambore->get_upd($id,$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! update data Jambore berhasil..'));
            }
            redirect('jambore');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_jambore->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_jambore->get_row('id_jambore',$key);
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
            $this->M_jambore->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}