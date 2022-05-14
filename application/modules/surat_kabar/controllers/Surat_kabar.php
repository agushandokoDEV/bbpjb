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
                $row[] = $val->penulis;
                $row[] = $val->jdl_tulisan;
                $row[] = $val->tgl_pelaksanaan;
                $row[] = $val->nm_surat_kbr;
                $row[] = $val->tgl_terbit;
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
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $data=array(
                'penulis'=>$penulis,
                'jdl_tulisan'=>$jdl_tulisan,
                'tgl_terbit'=>$tgl_terbit,
                'nm_surat_kbr'=>$nm_surat_kbr,
                'rubrik'=>$rubrik,
                'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                'user_input'=>$this->session->username
            );
            if($this->db->insert('surat_kabar',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_pelaksanaan,
                    'jenis'=>'pembinaan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'surat_kabar',
                    'menu'=>'Surat Kabar'
                );
                $this->db->insert('t_laporan',$dt_lap);
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
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $id=$this->input->post('id_key');
            $data=array(
                'penulis'=>$penulis,
                'jdl_tulisan'=>$jdl_tulisan,
                'tgl_terbit'=>$tgl_terbit,
                'nm_surat_kbr'=>$nm_surat_kbr,
                'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                'rubrik'=>$rubrik
            );
            $this->M_surat_kabar->get_upd($id,$data);
            $this->M_surat_kabar->upd_tgl_input($id,$tgl_pelaksanaan);
            $this->session->set_flashdata('notif',alert('success','OK !!! update data surat kabar berhasil..'));
            redirect('surat_kabar');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_surat_kabar->delete_by_id($key);
            $this->M_surat_kabar->del_lap_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}