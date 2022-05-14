<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Penyuluhan extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_penyuluhan');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_penyuluhan->get_datatables();
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
                $row[] = $val->narasumber;
                $row[] = $val->sasaran;
                $row[] = $val->jum_peserta;
                $row[] = $val->materi;
                $ac="'".$val->id_penyuluhan."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("penyuluhan/upd/".$val->id_penyuluhan).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_penyuluhan->count_all(),
    					"recordsFiltered" => $this->M_penyuluhan->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}

    public function add(){
		$data['dt_kabkot']=$this->M_penyuluhan->get_kabkot();
        $this->load->view("page_add", $data);
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $kabkot=$this->input->post('kabkot');
            $nama_keg=$this->input->post('nama_keg');
            $kat=$this->input->post('kat');
            $tgl_mulai=$this->input->post('tgl_mulai');
            $tgl_selesai=$this->input->post('tgl_selesai');
            $narasumber=$this->input->post('narasumber');
            $sasaran=$this->input->post('sasaran');
            $jum_peserta=$this->input->post('jum_peserta');
            $materi=$this->input->post('materi');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $data=array(
                    'nama_keg'=>$nama_keg,
                    'kat'=>$kat,
                    'id_kabkot'=>$kabkot,
                    'tgl_mulai'=>$tgl_mulai,
                    'tgl_selesai'=>$tgl_selesai,
                    'narasumber'=>$narasumber,
                    'sasaran'=>$sasaran,
                    'jum_peserta'=>$jum_peserta,
                    'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                    'tahun'=>get_tahun($tgl_pelaksanaan),
                    'materi'=>$materi,
                    'user_input'=>$this->session->username
                    );
            if($this->db->insert('t_penyuluhan',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_pelaksanaan,
                    'jenis'=>'pembinaan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'t_penyuluhan',
                    'menu'=>'Penyuluhan'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','Data berhasil berhasil ditambahkan'));
            }
            redirect('penyuluhan');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_penyuluhan->get_row('id_penyuluhan',$id);
        $data['dt_kabkot']=$this->M_penyuluhan->get_kabkot();
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $id=$this->input->post('id_pk');
            $kabkot=$this->input->post('kabkot');
            $nama_keg=$this->input->post('nama_keg');
            $kat=$this->input->post('kat');
            $tgl_mulai=$this->input->post('tgl_mulai');
            $tgl_selesai=$this->input->post('tgl_selesai');
            $narasumber=$this->input->post('narasumber');
            $sasaran=$this->input->post('sasaran');
            $jum_peserta=$this->input->post('jum_peserta');
            $materi=$this->input->post('materi');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $data=array(
                    'nama_keg'=>$nama_keg,
                    'kat'=>$kat,
                    'id_kabkot'=>$kabkot,
                    'tgl_mulai'=>$tgl_mulai,
                    'tgl_selesai'=>$tgl_selesai,
                    'narasumber'=>$narasumber,
                    'sasaran'=>$sasaran,
                    'jum_peserta'=>$jum_peserta,
                    'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                    'tahun'=>get_tahun($tgl_pelaksanaan),
                    'materi'=>$materi
                    );
            $this->M_penyuluhan->get_upd($id,$data);
            $this->M_penyuluhan->upd_tgl_input($id,$tgl_pelaksanaan);
            $this->session->set_flashdata('notif',alert('success','Update data berhasil'));
            redirect('penyuluhan');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_penyuluhan->delete_by_id($key);
            $this->M_penyuluhan->del_lap_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_penyuluhan->get_row('id_penyuluhan',$key);
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
            $this->M_penyuluhan->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}