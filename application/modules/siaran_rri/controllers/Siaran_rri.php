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
                $row[] = $val->penulis_naskah;
                $row[] = $val->judul_naskah;
                $row[] = $val->tgl_pelaksanaan;
                $row[] = $val->tgl_perekaman;
                $row[] = $val->tgl_disiarkan;
                $ac="'".$val->id_siaran."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("siaran_rri/upd/".$val->id_siaran).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                
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
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $data=array(
                'penulis_naskah'=>$judul_naskah,
                'judul_naskah'=>$nm_penulis,
                'tgl_perekaman'=>$tgl_perekaman,
                'tgl_disiarkan'=>$tgl_disiarkan,
                'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                'user_input'=>$this->session->username
            );
            if($this->db->insert('t_siaran_rri',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_pelaksanaan,
                    'jenis'=>'pembinaan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'t_siaran_rri',
                    'menu'=>'Siaran RRI'
                );
                $this->db->insert('t_laporan',$dt_lap);
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
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $data=array(
                'penulis_naskah'=>$judul_naskah,
                'judul_naskah'=>$nm_penulis,
                'tgl_perekaman'=>$tgl_perekaman,
                'tgl_disiarkan'=>$tgl_disiarkan,
                'tgl_pelaksanaan'=>$tgl_pelaksanaan,
            );
            $this->M_rri->get_upd($id,$data);
            $this->M_rri->upd_tgl_input($id,$tgl_pelaksanaan);
            $this->session->set_flashdata('notif',alert('success','OK !!! update data siaran rri berhasil..'));
            redirect('siaran_rri');
        }else{
                show_404();
            }
    	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_rri->delete_by_id($key);
            $this->M_rri->del_lap_id($key);
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