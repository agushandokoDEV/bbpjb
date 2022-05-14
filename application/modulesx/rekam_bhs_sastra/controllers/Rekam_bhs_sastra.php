<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rekam_bhs_sastra extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_rekam_bhs_sastra','M_rekam');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_rekam->get_datatables();
            $data = array();
            $no = $_POST["start"];
            
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $val->judul;
                $row[] = $val->tgl;
                $row[] = $val->lokasi;
                $row[] = $val->nara_sumber;
                $row[] = $val->genre;
                $ac="'".$val->id_rekam_bhs."'";
                $action= '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("rekam_bhs_sastra/upd/".$val->id_rekam_bhs).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_rekam->count_all(),
    					"recordsFiltered" => $this->M_rekam->count_filtered(),
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
            $judul=$this->input->post('judul');
            $tgl=$this->input->post('tgl');
            $lokasi=$this->input->post('lokasi');
            $nara_sumber=$this->input->post('nara_sumber');
            $genre=$this->input->post('genre');
            $data=array(
                'judul'=>$judul,
                'tgl'=>$tgl,
                'lokasi'=>$lokasi,
                'nara_sumber'=>$nara_sumber,
                'genre'=>$genre
            );
            if($this->db->insert('rekam_bhs_sastra',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data rekam bahasa sastra berhasil ditambahkan..'));
            }
            redirect('rekam_bhs_sastra');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_rekam->get_row('id_rekam_bhs',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $judul=$this->input->post('judul');
            $tgl=$this->input->post('tgl');
            $lokasi=$this->input->post('lokasi');
            $nara_sumber=$this->input->post('nara_sumber');
            $genre=$this->input->post('genre');
            $id=$this->input->post('id_key');
            $data=array(
                'judul'=>$judul,
                'tgl'=>$tgl,
                'lokasi'=>$lokasi,
                'nara_sumber'=>$nara_sumber,
                'genre'=>$genre
            );
            if($this->M_rekam->get_upd($id,$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! update data rekam bahasa sastra berhasil..'));
            }
            redirect('rekam_bhs_sastra');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_rekam->delete_by_id($key);
            echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}