<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kependidikan extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_kependidikan','M_pddkn');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_pddkn->get_datatables();
            $data = array();
            $no = $_POST["start"];
            
            
            foreach ($list as $val) {
                if($val->stts_sekolah == '0'){
                    $stts='Tidak Aktif';
                }else{
                    $stts='Aktif';
                }
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = $val->nama_sekolah;
                $row[] = $val->nama_kota;
                $row[] = $val->kec;
                $row[] = $val->alamat_sklh;
                $row[] = $stts;
                $ac="'".$val->id_kependidikan."'";
                $action= '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("kependidikan/upd/".$val->id_kependidikan).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_pddkn->count_all(),
    					"recordsFiltered" => $this->M_pddkn->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}

    public function add(){
        $data['dt_kabkot']=$this->M_pddkn->get_kabkot();
		$this->load->view("page_add",$data);
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $no=$this->input->post('no');
            $nama_sekolah=$this->input->post('nama_sekolah');
            $kabkot=$this->input->post('kabkot');
            $kec=$this->input->post('kec');
            $alamat=$this->input->post('alamat');
            $alamat_sklh=$this->input->post('alamat_sklh');
            $jum_pengajar=null;//$this->input->post('jum_pengajar');
            
            $data=array(
                'no'=>$no,
                'nama_sekolah'=>$nama_sekolah,
                'id_kabkot'=>$kabkot,
                'kec'=>$kec,
                'alamat'=>$alamat,
                'alamat_sklh'=>$alamat_sklh,
                'jum_pengajar'=>$jum_pengajar,
                'stts_sekolah'=>'1'
            );
            if($this->db->insert('t_kependidikan',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data kependidikan berhasil ditambahkan..'));
            }
            redirect('kependidikan');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_pddkn->get_row('id_kependidikan',$id);
        $data['dt_kabkot']=$this->M_pddkn->get_kabkot();
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $no=$this->input->post('no');
            $nama_sekolah=$this->input->post('nama_sekolah');
            $kabkot=$this->input->post('kabkot');
            $kec=$this->input->post('kec');
            $alamat=$this->input->post('alamat');
            //$jum_pengajar=$this->input->post('jum_pengajar');
            $alamat_sklh=$this->input->post('alamat_sklh');
            $stts=$this->input->post('stts');
            $id=$this->input->post('id_key');
            
            $data=array(
                'no'=>$no,
                'nama_sekolah'=>$nama_sekolah,
                'id_kabkot'=>$kabkot,
                'kec'=>$kec,
                'alamat'=>$alamat,
                'alamat_sklh'=>$alamat_sklh,
                'stts_sekolah'=>$stts
            );
            $this->M_pddkn->get_upd($id,$data);
            $this->session->set_flashdata('notif',alert('success','OK !!! Update data kependidikan berhasil..'));
            redirect('kependidikan');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_pddkn->delete_by_id($key);
            echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}