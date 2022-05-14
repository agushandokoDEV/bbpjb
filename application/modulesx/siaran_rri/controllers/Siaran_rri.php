<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Siaran_rri extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_siaran_rri','M_rri');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_rri->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = ucwords($val->penulis_naskah);
                $row[] = $val->judul_naskah;
                $row[] = tanggal($val->tgl_perekaman);
                $row[] = tanggal($val->tgl_disiarkan);
                $ac="'".$val->id_siaran."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("siaran_rri/upd/".$val->id_siaran).'" title="Edit"><i class="fa fa-edit"></i></a>
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
    					"recordsTotal" => $this->M_rri->count_all(),
    					"recordsFiltered" => $this->M_rri->count_filtered(),
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
            $judul_naskah=$this->input->post('judul_naskah');
            $nm_penulis=$this->input->post('nm_penulis');
            $tgl_perekaman=$this->input->post('tgl_perekaman');
            $tgl_disiarkan=$this->input->post('tgl_disiarkan');
            $data=array(
                'penulis_naskah'=>$judul_naskah,
                'judul_naskah'=>$nm_penulis,
                'tgl_perekaman'=>$tgl_perekaman,
                'tgl_disiarkan'=>$tgl_disiarkan,
            );
            if($this->db->insert('t_siaran_rri',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data siaran rri berhasil ditambahkan..'));
            }
            redirect('siaran_rri');
        }else{
                show_404();
            }
    	}

    public function upd($id=null){
		$data['dt_rri']=$this->M_rri->get_row('id_siaran',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $id=$this->input->post('id_pk');
            $judul_naskah=$this->input->post('judul_naskah');
            $nm_penulis=$this->input->post('nm_penulis');
            $tgl_perekaman=$this->input->post('tgl_perekaman');
            $tgl_disiarkan=$this->input->post('tgl_disiarkan');
            $data=array(
                'penulis_naskah'=>$judul_naskah,
                'judul_naskah'=>$nm_penulis,
                'tgl_perekaman'=>$tgl_perekaman,
                'tgl_disiarkan'=>$tgl_disiarkan,
            );
            if($this->M_rri->get_upd($id,$data)){
                $this->session->set_flashdata('notif',alert('info','OK !!! update data siaran rri berhasil..'));
            }
            redirect('siaran_rri');
        }else{
                show_404();
            }
    	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_rri->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_rri->get_row('id_siaran',$key);
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
            $this->M_rri->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}