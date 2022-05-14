<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sosialisasi_pemartabatan_bhs_negara extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_sosial_p_bhs_negara','M_sosial');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_sosial->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = $val->nama_kota;
                //$row[] = $val->tahun;
                $row[] = $val->judul;
                $row[] = $val->waktu;
                $row[] = $val->ranah;
                $row[] = $val->tmpt_sosialisasi;
                $row[] = $val->peserta_sosialisasi;
                $row[] = $val->panitia_daerah;
                $row[] = $val->nara_sumber;
                $ac="'".$val->id_sosial_p_bhs_negara."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("sosialisasi_pemartabatan_bhs_negara/upd/".$val->id_sosial_p_bhs_negara).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
               
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_sosial->count_all(),
    					"recordsFiltered" => $this->M_sosial->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}

    public function add(){
		$data['dt_kabkot']=$this->M_sosial->get_kabkot();
        $this->load->view("page_add", $data);
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $peserta_sosialisasi=$this->input->post('peserta_sosialisasi');
            $panitia_daerah=$this->input->post('panitia_daerah');
            $tmpt_sosialisasi=$this->input->post('tmpt_sosialisasi');
            $id_kabkot=$this->input->post('id_kabkot');
            $judul=$this->input->post('judul');
            $waktu=$this->input->post('waktu');
            $ranah=$this->input->post('ranah');
            $nara_sumber=$this->input->post('nara_sumber');
            $tahun=$this->input->post('tahun');
            $data=array(
                'tmpt_sosialisasi'=>$tmpt_sosialisasi,
                'peserta_sosialisasi'=>$peserta_sosialisasi,
                'panitia_daerah'=>$panitia_daerah,
                'id_kabkot'=>$id_kabkot,
                'judul'=>$judul,
                'waktu'=>$waktu,
                'ranah'=>$ranah,
                'nara_sumber'=>$nara_sumber,
                'tahun'=>get_tahun($waktu),
                'tgl_pelaksanaan'=>$waktu,
                'user_input'=>$this->session->username
            );
            if($this->db->insert('t_sosial_p_bhs_negara',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$waktu,
                    'jenis'=>'pembinaan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'t_sosial_p_bhs_negara',
                    'menu'=>'Sosialisasi Pemartabatan Bahasa Negara'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','OK !!! data Sosialisasi berhasil ditambahkan..'));
            }
            redirect('sosialisasi_pemartabatan_bhs_negara');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
        $data['dt_kabkot']=$this->M_sosial->get_kabkot();
		$data['dt_row']=$this->M_sosial->get_row('id_sosial_p_bhs_negara',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $id=$this->input->post('id');
            $peserta_sosialisasi=$this->input->post('peserta_sosialisasi');
            $panitia_daerah=$this->input->post('panitia_daerah');
            $tmpt_sosialisasi=$this->input->post('tmpt_sosialisasi');
            $id_kabkot=$this->input->post('id_kabkot');
            $judul=$this->input->post('judul');
            $waktu=$this->input->post('waktu');
            $ranah=$this->input->post('ranah');
            $nara_sumber=$this->input->post('nara_sumber');
            $tahun=$this->input->post('tahun');
            $data=array(
                'tmpt_sosialisasi'=>$tmpt_sosialisasi,
                'peserta_sosialisasi'=>$peserta_sosialisasi,
                'panitia_daerah'=>$panitia_daerah,
                'id_kabkot'=>$id_kabkot,
                'judul'=>$judul,
                'waktu'=>$waktu,
                'ranah'=>$ranah,
                'nara_sumber'=>$nara_sumber,
                'tgl_pelaksanaan'=>$waktu,
                'tahun'=>get_tahun($waktu)
            );
            $this->M_sosial->get_upd($id,$data);
            $this->M_sosial->upd_tgl_input($id,$waktu);
            $this->session->set_flashdata('notif',alert('success','OK !!! update data Sosialisasi berhasil..'));
            redirect('sosialisasi_pemartabatan_bhs_negara');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_sosial->delete_by_id($key);
            $this->M_sosial->del_lap_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_sosial->get_row('id_sosial_p_bhs_negara',$key);
            $this->load->view("ajax_load_v",$data);
		}else{
		  show_404();
		}
	}
    
    public function do_verify(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $stts=$this->input->post('stts');
            $data=array('verify'=>$stts);
            $this->M_sosial->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}