<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bipa extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_bipa');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_bipa->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = $val->nama_pembelajar;
                $row[] = $val->tgl_pelaksanaan;
                $row[] = $val->negara;
                $row[] = $val->tingkat;
                $ac="'".$val->id_bipa."'";
                $action= '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("bipa/upd/".$val->id_bipa).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_bipa->count_all(),
    					"recordsFiltered" => $this->M_bipa->count_filtered(),
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
            $nama_pembelajar=$this->input->post('nama_pembelajar');
            $negara=$this->input->post('negara');
            $tingkat=$this->input->post('tingkat');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $data=array(
                'nama_pembelajar'=>$nama_pembelajar,
                'negara'=>$negara,
                'tingkat'=>$tingkat,
                'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                'user_input'=>$this->session->username
            );
            if($this->db->insert('t_bipa',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_pelaksanaan,
                    'jenis'=>'pembinaan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'t_bipa',
                    'menu'=>'BIPA'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','OK !!! data BIPA berhasil ditambahkan..'));
            }
            redirect('bipa');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_bipa->get_row('id_bipa',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $nama_pembelajar=$this->input->post('nama_pembelajar');
            $negara=$this->input->post('negara');
            $tingkat=$this->input->post('tingkat');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $id=$this->input->post('id');
            $data=array(
                'nama_pembelajar'=>$nama_pembelajar,
                'negara'=>$negara,
                'tingkat'=>$tingkat,
                'tgl_pelaksanaan'=>$tgl_pelaksanaan
            );
            $this->M_bipa->get_upd($id,$data);
            $this->M_bipa->upd_tgl_input($id,$tgl_pelaksanaan);
            $this->session->set_flashdata('notif',alert('success','OK !!! update data BIPA berhasil...'));
            redirect('bipa');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_bipa->delete_by_id($key);
            $this->M_bipa->del_lap_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_bipa->get_row('id_bipa',$key);
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
            $this->M_bipa->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}