<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kamus extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_kamus');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_kamus->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = $val->nama_kota;
                $row[] = $val->tgl_pelaksanaan;
                $row[] = $val->judul;
                $row[] = $val->penyusun;
                $row[] = $val->jenis;
                $row[] = $val->sasaran;
                $ac="'".$val->id_kamus."'";
                $action='
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("kamus/upd/".$val->id_kamus).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_kamus->count_all(),
    					"recordsFiltered" => $this->M_kamus->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}

    public function add(){
        $data['dt_kabkot']=$this->M_kamus->get_kabkot();
		$this->load->view("page_add",$data);
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $judul=$this->input->post('judul');
            //$tahun=$this->input->post('tahun');
            $penyusun=$this->input->post('penyusun');
            $jenis=$this->input->post('jenis');
            $sasaran=$this->input->post('sasaran');
            $kabkot=$this->input->post('kabkot');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $data=array(
                    'judul'=>$judul,
                    'tahun'=>get_tahun($tgl_pelaksanaan),
                    'penyusun'=>$penyusun,
                    'jenis'=>$jenis,
                    'sasaran'=>$sasaran,
                    'id_kabkot'=>$kabkot,
                    'user_input'=>$this->session->username,
                    'tgl_pelaksanaan'=>$tgl_pelaksanaan
            );
            if($this->db->insert('t_kamus',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_pelaksanaan,
                    'jenis'=>'pengembangan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'t_kamus',
                    'menu'=>'Penyusunan Kamus'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','Data kamus berhasil ditambahkan'));
            }
            redirect('kamus');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
        $data['dt_kabkot']=$this->M_kamus->get_kabkot();
		$data['dt_row']=$this->M_kamus->get_row('id_kamus',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $judul=$this->input->post('judul');
            //$tahun=$this->input->post('tahun');
            $penyusun=$this->input->post('penyusun');
            $jenis=$this->input->post('jenis');
            $sasaran=$this->input->post('sasaran');
            $id=$this->input->post('id_key');
            $kabkot=$this->input->post('kabkot');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $data=array(
                    'judul'=>$judul,
                    'tahun'=>get_tahun($tgl_pelaksanaan),
                    'penyusun'=>$penyusun,
                    'jenis'=>$jenis,
                    'sasaran'=>$sasaran,
                    'id_kabkot'=>$kabkot,
                    'tgl_pelaksanaan'=>$tgl_pelaksanaan
            );
            $this->M_kamus->get_upd($id,$data);
            $this->M_kamus->upd_tgl_input($id,$tgl_pelaksanaan);
            $this->session->set_flashdata('notif',alert('success','Update data kamus berhasil'));
            redirect('kamus');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_kamus->delete_by_id($key);
            $this->M_kamus->del_lap_id($key);
            $this->M_kamus->del_user_input($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}