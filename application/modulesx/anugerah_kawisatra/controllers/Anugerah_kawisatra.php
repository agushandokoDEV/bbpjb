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
                $row[] = $val->tgl;
                $row[] = $val->tempat;
                $row[] = $val->kat;
                $row[] = $val->pemenang;
                $ac="'".$val->id_anugrah_kw."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("anugerah_kawisatra/upd/".$val->id_anugrah_kw).'" title="Edit"><i class="fa fa-edit"></i></a>
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
                'tgl'=>$tgl,
                'tempat'=>$tempat,
                'kat'=>$kat,
                'pemenang'=>$pemenang
            );
            if($this->db->insert('anugrah_kw',$data)){
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
                'tgl'=>$tgl,
                'tempat'=>$tempat,
                'kat'=>$kat,
                'pemenang'=>$pemenang
            );
            if($this->M_kw->get_upd($id,$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! update data Jambore berhasil..'));
            }
            redirect('anugerah_kawisatra');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_kw->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}