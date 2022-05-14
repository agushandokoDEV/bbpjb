<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Penelitian extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_penelitian');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_penelitian->get_datatables();
            $data = array();
            $no = $_POST["start"];
            
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $val->nama_kota;
                $row[] = $val->judul;
                $row[] = $val->tahun;
                $row[] = $val->lokasi;
                $row[] = $val->peneliti;
                $row[] = $val->publikasi;
                $row[] = $val->thn_terbit;
                $ac="'".$val->id_penelitian."'";
                $action= '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("penelitian/upd/".$val->id_penelitian).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_penelitian->count_all(),
    					"recordsFiltered" => $this->M_penelitian->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}

    public function add(){
        $data['dt_kabkot']=$this->M_penelitian->get_kabkot();
		$this->load->view("page_add",$data);
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $judul=$this->input->post('judul');
            $thn_penelitian=$this->input->post('thn_penelitian');
            $lokasi=$this->input->post('lokasi');
            $peneliti=$this->input->post('peneliti');
            $publikasi=$this->input->post('publikasi');
            $thn_terbit=$this->input->post('thn_terbit');
            $kabkot=$this->input->post('kabkot');
            $data=array(
                'judul'=>$judul,
                'tahun'=>$thn_penelitian,
                'lokasi'=>$lokasi,
                'peneliti'=>$peneliti,
                'publikasi'=>$publikasi,
                'thn_terbit'=>$thn_terbit,
                'id_kabkot'=>$kabkot
            );
            if($this->db->insert('t_penelitian',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data penelitian berhasil ditambahkan..'));
            }
            redirect('penelitian');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
        $data['dt_kabkot']=$this->M_penelitian->get_kabkot();
		$data['dt_row']=$this->M_penelitian->get_row('id_penelitian',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $judul=$this->input->post('judul');
            $thn_penelitian=$this->input->post('thn_penelitian');
            $lokasi=$this->input->post('lokasi');
            $peneliti=$this->input->post('peneliti');
            $publikasi=$this->input->post('publikasi');
            $thn_terbit=$this->input->post('thn_terbit');
            $kabkot=$this->input->post('kabkot');
            $id=$this->input->post('id_key');
            $data=array(
                'judul'=>$judul,
                'tahun'=>$thn_penelitian,
                'lokasi'=>$lokasi,
                'peneliti'=>$peneliti,
                'publikasi'=>$publikasi,
                'thn_terbit'=>$thn_terbit,
                'id_kabkot'=>$kabkot
            );
            if($this->M_penelitian->get_upd($id,$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! Update data penelitian berhasil..'));
            }
            redirect('penelitian');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_penelitian->delete_by_id($key);
            echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}