<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Literasi extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_literasi');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_literasi->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = $val->judul;
                $row[] = $val->penyusun;
                $row[] = $val->tahun;
                $row[] = $val->tingkatan;
                $row[] = $val->tema;
                $ac="'".$val->id_literasi."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("literasi/upd/".$val->id_literasi).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_literasi->count_all(),
    					"recordsFiltered" => $this->M_literasi->count_filtered(),
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
            $penyusun=$this->input->post('penyusun');
            $tahun=$this->input->post('tahun');
            $tingkatan=$this->input->post('tingkatan');
            $tema=$this->input->post('tema');
            $data=array(
                'judul'=>$judul,
                'penyusun'=>$penyusun,
                'tahun'=>$tahun,
                'tingkatan'=>$tingkatan,
                'tema'=>$tema
            );
            if($this->db->insert('t_literasi',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data literasi berhasil ditambahkan..'));
            }
            redirect('literasi');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_literasi->get_row('id_literasi',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $judul=$this->input->post('judul');
            $penyusun=$this->input->post('penyusun');
            $tahun=$this->input->post('tahun');
            $tingkatan=$this->input->post('tingkatan');
            $tema=$this->input->post('tema');
            $id_key=$this->input->post('id_key');
            $data=array(
                'judul'=>$judul,
                'penyusun'=>$penyusun,
                'tahun'=>$tahun,
                'tingkatan'=>$tingkatan,
                'tema'=>$tema
            );
            if($this->M_literasi->get_upd($id_key,$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! update data literasi berhasil..'));
            }
            redirect('literasi');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_literasi->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}