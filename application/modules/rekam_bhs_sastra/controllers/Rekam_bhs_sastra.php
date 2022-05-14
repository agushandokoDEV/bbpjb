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
                $row[] = $no;
                $row[] = $val->nama_kota;
                //$row[] = $val->tahun;
                $row[] = $val->judul;
                $row[] = $val->penyusun;
                $row[] = $val->tgl_mulai;
                $row[] = $val->tgl_selesai;
                $row[] = $val->lokasi;
                $row[] = $val->nara_sumber;
                $row[] = $val->genre;
                $row[] = $val->narasi;
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
        $data['dt_kabkot']=$this->M_rekam->get_kabkot();
		$this->load->view("page_add",$data);
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $judul=$this->input->post('judul');
            //$tgl=$this->input->post('tgl_pelaksanaan');
            $lokasi=$this->input->post('lokasi');
            $nara_sumber=$this->input->post('nara_sumber');
            $genre=$this->input->post('genre');
            $kabkot=$this->input->post('kabkot');
            $penyusun=$this->input->post('penyusun');
            $tgl_mulai=$this->input->post('tgl_mulai');
            $tgl_selesai=$this->input->post('tgl_selesai');
            $narasi=$this->input->post('narasi');
            $data=array(
                'judul'=>$judul,
                'penyusun'=>$penyusun,
                'lokasi'=>$lokasi,
                'nara_sumber'=>$nara_sumber,
                'genre'=>$genre,
                'id_kabkot'=>$kabkot,
                'tahun'=>get_tahun($tgl_selesai),
                'user_input'=>$this->session->username,
                'tgl_mulai'=>$tgl_mulai,
                'tgl_selesai'=>$tgl_selesai,
                'tgl_pelaksanaan'=>$tgl_selesai,
                'narasi'=>$narasi
            );
            if($this->db->insert('rekam_bhs_sastra',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_selesai,
                    'jenis'=>'pengembangan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'rekam_bhs_sastra',
                    'menu'=>'Perekaman Bahasa dan Ekspresi Sastra'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','OK !!! data rekam bahasa sastra berhasil ditambahkan..'));
            }
            redirect('rekam_bhs_sastra');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
        $data['dt_kabkot']=$this->M_rekam->get_kabkot();
		$data['dt_row']=$this->M_rekam->get_row('id_rekam_bhs',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $judul=$this->input->post('judul');
            //$tgl=$this->input->post('tgl_pelaksanaan');
            $lokasi=$this->input->post('lokasi');
            $nara_sumber=$this->input->post('nara_sumber');
            $genre=$this->input->post('genre');
            $kabkot=$this->input->post('kabkot');
            $penyusun=$this->input->post('penyusun');
            $id=$this->input->post('id_key');
            $tgl_mulai=$this->input->post('tgl_mulai');
            $tgl_selesai=$this->input->post('tgl_selesai');
            $narasi=$this->input->post('narasi');
            $data=array(
                'judul'=>$judul,
                'penyusun'=>$penyusun,
                'lokasi'=>$lokasi,
                'nara_sumber'=>$nara_sumber,
                'genre'=>$genre,
                'id_kabkot'=>$kabkot,
                'tahun'=>get_tahun($tgl_selesai),
                'tgl_mulai'=>$tgl_mulai,
                'tgl_selesai'=>$tgl_selesai,
                'tgl_pelaksanaan'=>$tgl_selesai,
                'narasi'=>$narasi
            );
            $this->M_rekam->get_upd($id,$data);
            $this->M_rekam->upd_tgl_input($id,$tgl_selesai);
            $this->session->set_flashdata('notif',alert('success','OK !!! update data rekam bahasa sastra berhasil..'));
            redirect('rekam_bhs_sastra');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_rekam->delete_by_id($key);
            $this->M_rekam->del_lap_id($key);
            echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}