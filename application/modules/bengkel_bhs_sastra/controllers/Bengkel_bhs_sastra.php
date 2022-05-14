<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bengkel_bhs_sastra extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_bengkel_bhs_sastra','M_bhs');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_bhs->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = ucwords($val->nama_kota);
                $row[] = $val->tgl_pelaksanaan;
                $row[] = $val->nama_keg;
                $row[] = $val->kat;
                $row[] = $val->tgl_mulai;
                $row[] = $val->tgl_selesai;
                $row[] = $val->pematri;
                $row[] = $val->jum_peserta;
                $row[] = $val->nama_lembaga;
                $row[] = $val->peserta;
                $ac="'".$val->id_bhs_sastra."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("bengkel_bhs_sastra/upd/".$val->id_bhs_sastra).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_bhs->count_all(),
    					"recordsFiltered" => $this->M_bhs->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
 	}

    public function add(){
		$data['dt_kabkot']=$this->M_bhs->get_kabkot();
        $this->load->view("page_add", $data);
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $kabkot=$this->input->post('kabkot');
            $nama_keg=$this->input->post('nama_keg');
            $kat=$this->input->post('kat');
            $tgl_mulai=$this->input->post('tgl_mulai');
            $tgl_selesai=$this->input->post('tgl_selesai');
            $pematri=$this->input->post('pematri');
            $jum_peserta=$this->input->post('jum_peserta');
            $peserta=$this->input->post('peserta');
            $nama_lembaga=$this->input->post('nama_lembaga');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $data=array(
                    'id_kabkot'=>$kabkot,
                    'kat'=>$kat,
                    'nama_keg'=>$nama_keg,
                    'tgl_mulai'=>$tgl_mulai,
                    'tgl_selesai'=>$tgl_selesai,
                    'pematri'=>$pematri,
                    'jum_peserta'=>$jum_peserta,
                    'peserta'=>$peserta,
                    'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                    'tahun'=>get_tahun($tgl_pelaksanaan),
                    'nama_lembaga'=>$nama_lembaga,
                    'user_input'=>$this->session->username
                    );
            if($this->db->insert('bengkel_bhs_sastra',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_pelaksanaan,
                    'jenis'=>'pembinaan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'bengkel_bhs_sastra',
                    'menu'=>'Bengkel Bahasa dan Sastra'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','Data berhasil berhasil ditambahkan'));
            }
            redirect('bengkel_bhs_sastra');
        }else{
            show_404();
        }
    }

    public function upd($id=null){
		$data['dt_kabkot']=$this->M_bhs->get_kabkot();
		$data['dt_bhs']=$this->M_bhs->get_row('id_bhs_sastra',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $id=$this->input->post('id_bhs');
            $kabkot=$this->input->post('kabkot');
            $nama_keg=$this->input->post('nama_keg');
            $kat=$this->input->post('kat');
            $tgl_mulai=$this->input->post('tgl_mulai');
            $tgl_selesai=$this->input->post('tgl_selesai');
            $pematri=$this->input->post('pematri');
            $jum_peserta=$this->input->post('jum_peserta');
            $peserta=$this->input->post('peserta');
            $nama_lembaga=$this->input->post('nama_lembaga');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $data=array(
                    'id_kabkot'=>$kabkot,
                    'kat'=>$kat,
                    'nama_keg'=>$nama_keg,
                    'tgl_mulai'=>$tgl_mulai,
                    'tgl_selesai'=>$tgl_selesai,
                    'pematri'=>$pematri,
                    'jum_peserta'=>$jum_peserta,
                    'peserta'=>$peserta,
                    'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                    'tahun'=>get_tahun($tgl_pelaksanaan),
                    'nama_lembaga'=>$nama_lembaga
                    );
            
            $this->M_bhs->get_upd($id,$data);
            $this->M_bhs->upd_tgl_input($id,$tgl_pelaksanaan);
            $this->session->set_flashdata('notif',alert('success','Update data berhasil'));
            redirect('bengkel_bhs_sastra');
        }else{
                show_404();
            }
    	}

    public function hapus(){
		if($this->input->is_ajax_request()){
		       $key=$this->input->post('key');
                $this->M_bhs->delete_by_id($key);
                $this->M_bhs->del_lap_id($key);
    		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_bhs->get_row('id_bhs_sastra',$key);
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
            $this->M_bhs->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}