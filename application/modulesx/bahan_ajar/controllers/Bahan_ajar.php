<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bahan_ajar extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_bahan_ajar','M_bj');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_bj->get_datatables();
            $data = array();
            $no = $_POST["start"];
            
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $val->judul;
                $row[] = $val->kat;
                $row[] = $val->nama_penyusun;
                $row[] = $val->thn_penyusun;
                $row[] = $val->tingkat;
                $row[] = $val->sasaran;
                $row[] = $val->tema;
                $row[] = $val->sumber_bahan;
                $ac="'".$val->id_bahan_ajar."'";
                $action= '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("bahan_ajar/upd/".$val->id_bahan_ajar).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_bj->count_all(),
    					"recordsFiltered" => $this->M_bj->count_filtered(),
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
            $kat=$this->input->post('kat');
            $nama_penyusun=$this->input->post('nama_penyusun');
            $thn_penyusun=$this->input->post('thn_penyusun');
            $tingkat=$this->input->post('tingkat');
            $sasaran=$this->input->post('sasaran');
            $tema=$this->input->post('tema');
            $sumber_bahan=$this->input->post('sumber_bahan');
            $data=array(
                'judul'=>$judul,
                'kat'=>$kat,
                'nama_penyusun'=>$nama_penyusun,
                'thn_penyusun'=>$thn_penyusun,
                'tingkat'=>$tingkat,
                'sasaran'=>$sasaran,
                'tema'=>$tema,
                'sumber_bahan'=>$sumber_bahan
            );
            if($this->db->insert('bahan_ajar',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data bahan ajar berhasil ditambahkan..'));
            }
            redirect('bahan_ajar');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_bj->get_row('id_bahan_ajar',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $judul=$this->input->post('judul');
            $kat=$this->input->post('kat');
            $nama_penyusun=$this->input->post('nama_penyusun');
            $thn_penyusun=$this->input->post('thn_penyusun');
            $tingkat=$this->input->post('tingkat');
            $sasaran=$this->input->post('sasaran');
            $tema=$this->input->post('tema');
            $sumber_bahan=$this->input->post('sumber_bahan');
            $id=$this->input->post('id_key');
            $data=array(
                'judul'=>$judul,
                'kat'=>$kat,
                'nama_penyusun'=>$nama_penyusun,
                'thn_penyusun'=>$thn_penyusun,
                'tingkat'=>$tingkat,
                'sasaran'=>$sasaran,
                'tema'=>$tema,
                'sumber_bahan'=>$sumber_bahan
            );
            if($this->M_bj->get_upd($id,$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! Update data bahan ajar berhasil..'));
            }
            redirect('bahan_ajar');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_bj->delete_by_id($key);
            echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}