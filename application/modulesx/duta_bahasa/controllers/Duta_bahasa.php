<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Duta_bahasa extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_duta_bahasa','M_duta');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_duta->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $val->tahun;
                $row[] = $val->tempat;
                $row[] = $val->lokasi;
                $row[] = $val->jum_peserta;
                $row[] = $val->pemenang;
                $row[] = $val->asal_pddkn;
                $row[] = $val->ket_juara;
                $ac="'".$val->id_duta_bhs."'";
                $action= '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("duta_bahasa/upd/".$val->id_duta_bhs).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_duta->count_all(),
    					"recordsFiltered" => $this->M_duta->count_filtered(),
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
            $tahun=$this->input->post('tahun');
            $tempat=$this->input->post('tempat');
            $lokasi=$this->input->post('lokasi');
            $jum_peserta=$this->input->post('jum_peserta');
            $pemenang=$this->input->post('pemenang');
            $asal_pddkn=$this->input->post('asal_pddkn');
            $ket_juara=$this->input->post('ket_juara');
            $data=array(
                'tahun'=>$tahun,
                'tempat'=>$tempat,
                'lokasi'=>$lokasi,
                'jum_peserta'=>$jum_peserta,
                'pemenang'=>$pemenang,
                'asal_pddkn'=>$asal_pddkn,
                'ket_juara'=>$ket_juara
            );
            if($this->db->insert('duta_bahasa',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data berhasil ditambahkan..'));
            }
            redirect('duta_bahasa');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_duta->get_row('id_duta_bhs',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $tahun=$this->input->post('tahun');
            $tempat=$this->input->post('tempat');
            $lokasi=$this->input->post('lokasi');
            $jum_peserta=$this->input->post('jum_peserta');
            $pemenang=$this->input->post('pemenang');
            $asal_pddkn=$this->input->post('asal_pddkn');
            $ket_juara=$this->input->post('ket_juara');
            $id=$this->input->post('id_key');
            $data=array(
                'tahun'=>$tahun,
                'tempat'=>$tempat,
                'lokasi'=>$lokasi,
                'jum_peserta'=>$jum_peserta,
                'pemenang'=>$pemenang,
                'asal_pddkn'=>$asal_pddkn,
                'ket_juara'=>$ket_juara
            );
            if($this->M_duta->get_upd($id,$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! update data berhasil..'));
            }
            redirect('duta_bahasa');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_duta->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}