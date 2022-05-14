<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Anugerah_kawisatra extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_anugrah_kawisatra','M_kw');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_kw->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = $val->nm_keg;
                $row[] = $val->tgl_pelaksanaan;
                $row[] = $val->tempat;
                $row[] = $val->kat;
                $row[] = $val->pemenang;
                $ac="'".$val->id_anugrah_kw."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("anugerah_kawisatra/upd/".$val->id_anugrah_kw).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_kw->count_all(),
    					"recordsFiltered" => $this->M_kw->count_filtered(),
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
            $nm_keg=$this->input->post('nm_keg');
            $tgl=$this->input->post('tgl');
            $tempat=$this->input->post('tempat');
            $kat=$this->input->post('kat');
            $pemenang=$this->input->post('pemenang');
            $data=array(
                'nm_keg'=>$nm_keg,
                'tgl_pelaksanaan'=>$tgl,
                'tempat'=>$tempat,
                'kat'=>$kat,
                'pemenang'=>$pemenang,
                'user_input'=>$this->session->username
            );
            if($this->db->insert('anugrah_kw',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl,
                    'jenis'=>'pembinaan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'anugrah_kw',
                    'menu'=>'Anugerah Kawisatra'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','OK !!! data Anugrah kawisatra berhasil ditambahkan..'));
            }
            redirect('anugerah_kawisatra');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_kw->get_row('id_anugrah_kw',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $nm_keg=$this->input->post('nm_keg');
            $tgl=$this->input->post('tgl');
            $tempat=$this->input->post('tempat');
            $kat=$this->input->post('kat');
            $pemenang=$this->input->post('pemenang');
            $id=$this->input->post('id_key');
            $data=array(
                'nm_keg'=>$nm_keg,
                'tgl_pelaksanaan'=>$tgl,
                'tempat'=>$tempat,
                'kat'=>$kat,
                'pemenang'=>$pemenang
            );
            $this->M_kw->get_upd($id,$data);
            $this->M_kw->upd_tgl_input($id,$tgl);
            $this->session->set_flashdata('notif',alert('success','OK !!! update data Jambore berhasil..'));
            redirect('anugerah_kawisatra');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_kw->delete_by_id($key);
            $this->M_kw->del_lap_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}