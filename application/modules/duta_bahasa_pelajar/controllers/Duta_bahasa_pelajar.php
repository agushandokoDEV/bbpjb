<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Duta_bahasa_pelajar extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_duta_bahasa_pelajar','M_duta');
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
                $row[] = $no;
                $row[] = $val->tgl_pelaksanaan;
                $row[] = $val->tempat;
                $row[] = $val->lokasi;
                $row[] = $val->jum_peserta;
                $row[] = $val->pemenang;
                $row[] = $val->asal_pddkn;
                $row[] = $val->ket_juara;
                $ac="'".$val->id_duta_bhs."'";
                $action= '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("duta_bahasa_pelajar/upd/".$val->id_duta_bhs).'" title="Edit"><i class="fa fa-edit"></i></a>
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
        //$data['dt_kabkot']=$this->M_duta->get_kabkot();
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
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            //$id_kabkot=$this->input->post('id_kabkot');
            $data=array(
                'tahun'=>get_tahun($tgl_pelaksanaan),
                'tempat'=>$tempat,
                'lokasi'=>$lokasi,
                'jum_peserta'=>$jum_peserta,
                'pemenang'=>$pemenang,
                'asal_pddkn'=>$asal_pddkn,
                'ket_juara'=>$ket_juara,
                'kat'=>'pelajar',
                'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                'user_input'=>$this->session->username
                //'id_kabkot'=>$id_kabkot
            );
            if($this->db->insert('duta_bahasa',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_pelaksanaan,
                    'jenis'=>'pembinaan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'duta_bahasa',
                    'menu'=>'Duta Bahasa Pelajar'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','OK !!! data berhasil ditambahkan..'));
            }
            redirect('duta_bahasa_pelajar');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_duta->get_row('id_duta_bhs',$id);
        //$data['dt_kabkot']=$this->M_duta->get_kabkot();
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
            //$id_kabkot=$this->input->post('id_kabkot');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $id=$this->input->post('id_key');
            $data=array(
                'tahun'=>get_tahun($tgl_pelaksanaan),
                'tempat'=>$tempat,
                'lokasi'=>$lokasi,
                'jum_peserta'=>$jum_peserta,
                'pemenang'=>$pemenang,
                'asal_pddkn'=>$asal_pddkn,
                'ket_juara'=>$ket_juara,
                'tgl_pelaksanaan'=>$tgl_pelaksanaan
                //'id_kabkot'=>$id_kabkot
            );
            $this->M_duta->get_upd($id,$data);
            $this->M_duta->upd_tgl_input($id,$tgl_pelaksanaan);
            $this->session->set_flashdata('notif',alert('success','OK !!! update data berhasil..'));
            redirect('duta_bahasa_pelajar');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_duta->delete_by_id($key);
            $this->M_duta->del_lap_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}