<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Surat_kabar extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_surat_kabar');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_surat_kabar->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = $val->jdl_tulisan;
                $row[] = $val->penulis;
                $row[] = $val->nm_surat_kbr;
                $row[] = fullday($val->tgl_terbit);
                $row[] = $val->rubrik;
                $ac="'".$val->id_surat_kbr."'";
                $action= '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("surat_kabar/upd/".$val->id_surat_kbr).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_surat_kabar->count_all(),
    					"recordsFiltered" => $this->M_surat_kabar->count_filtered(),
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
            $penulis=$this->input->post('penulis');
            $jdl_tulisan=$this->input->post('jdl_tulisan');
            $tgl_terbit=$this->input->post('tgl_terbit');
            $nm_surat_kbr=$this->input->post('nm_surat_kbr');
            $rubrik=$this->input->post('rubrik');
            $data=array(
                'penulis'=>$penulis,
                'jdl_tulisan'=>$jdl_tulisan,
                'tgl_terbit'=>$tgl_terbit,
                'nm_surat_kbr'=>$nm_surat_kbr,
                'rubrik'=>$rubrik
            );
            if($this->db->insert('surat_kabar',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data Surat kabar berhasil ditambahkan..'));
            }
            redirect('surat_kabar');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_surat_kabar->get_row('id_surat_kbr',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $penulis=$this->input->post('penulis');
            $jdl_tulisan=$this->input->post('jdl_tulisan');
            $tgl_terbit=$this->input->post('tgl_terbit');
            $nm_surat_kbr=$this->input->post('nm_surat_kbr');
            $rubrik=$this->input->post('rubrik');
            $id=$this->input->post('id_key');
            $data=array(
                'penulis'=>$penulis,
                'jdl_tulisan'=>$jdl_tulisan,
                'tgl_terbit'=>$tgl_terbit,
                'nm_surat_kbr'=>$nm_surat_kbr,
                'rubrik'=>$rubrik
            );
            if($this->M_surat_kabar->get_upd($id,$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! update data surat kabar berhasil..'));
            }
            redirect('surat_kabar');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_surat_kabar->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}