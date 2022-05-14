<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Seminar extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_seminar');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_seminar->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = $val->nama_seminar;
                $row[] = $val->pemateri;
                $row[] = tanggal($val->tgl_seminar);
                $row[] = $val->tempat;
                $row[] = $val->lokasi;
                $row[] = $val->jum_peserta;
                $ac="'".$val->id_seminar."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("seminar/upd/".$val->id_seminar).'" title="Edit"><i class="fa fa-edit"></i></a>
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
    					"recordsTotal" => $this->M_seminar->count_all(),
    					"recordsFiltered" => $this->M_seminar->count_filtered(),
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
            $nama_seminar=$this->input->post('nama_seminar');
            $pemateri=$this->input->post('pemateri');
            $tgl_seminar=$this->input->post('tgl_seminar');
            $lokasi=$this->input->post('lokasi');
            $tempat=$this->input->post('tempat');
            $jum_peserta=$this->input->post('jum_peserta');
            $data=array(
                'nama_seminar'=>$nama_seminar,
                'pemateri'=>$pemateri,
                'tgl_seminar'=>$tgl_seminar,
                'tgl_pelaksanaan'=>$tgl_seminar,
                'lokasi'=>$lokasi,
                'jum_peserta'=>$jum_peserta,
                'tempat'=>$tempat,
                'user_input'=>$this->session->username
            );
            if($this->db->insert('t_seminar',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_seminar,
                    'jenis'=>'pembinaan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'t_seminar',
                    'menu'=>'Seminar'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','OK !!! data seminar berhasil ditambahkan..'));
            }
            redirect('seminar');
        }else{
                show_404();
            }
    	}

    public function upd($id=null){
		$data['dt_row']=$this->M_seminar->get_row('id_seminar',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $id=$this->input->post('id_pk');
            $nama_seminar=$this->input->post('nama_seminar');
            $pemateri=$this->input->post('pemateri');
            $tgl_seminar=$this->input->post('tgl_seminar');
            $lokasi=$this->input->post('lokasi');
            $jum_peserta=$this->input->post('jum_peserta');
            $tempat=$this->input->post('tempat');
            $data=array(
                'nama_seminar'=>$nama_seminar,
                'pemateri'=>$pemateri,
                'tgl_seminar'=>$tgl_seminar,
                'tgl_pelaksanaan'=>$tgl_seminar,
                'lokasi'=>$lokasi,
                'jum_peserta'=>$jum_peserta,
                'tempat'=>$tempat
            );
            $this->M_seminar->get_upd($id,$data);
            $this->M_seminar->upd_tgl_input($id,$tgl_seminar);
            $this->session->set_flashdata('notif',alert('success','OK !!! Update data seminar berhasil..'));
            redirect('seminar');
        }else{
            show_404();
        }
    }

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_seminar->delete_by_id($key);
            $this->M_seminar->del_lap_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_seminar->get_row('id_seminar',$key);
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
            $this->M_seminar->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}