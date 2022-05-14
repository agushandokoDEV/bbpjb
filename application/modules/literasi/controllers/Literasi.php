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
                $row[] = $val->nama_kota;
                $row[] = $val->tgl_pelaksanaan;
                $row[] = $val->judul;
                $row[] = $val->penyusun;
                $row[] = $val->tingkatan;
                $row[] = $val->tema;
                $row[] = $val->sumber_bahan;
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
        $data['dt_kabkot']=$this->M_literasi->get_kabkot();
		$this->load->view("page_add",$data);
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $judul=$this->input->post('judul');
            $penyusun=$this->input->post('penyusun');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $tingkatan=$this->input->post('tingkatan');
            $tema=$this->input->post('tema');
            $sumber_bahan=$this->input->post('sumber_bahan');
            $kabkot=$this->input->post('kabkot');
            $data=array(
                'judul'=>$judul,
                'penyusun'=>$penyusun,
                'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                'tingkatan'=>$tingkatan,
                'tema'=>$tema,
                'sumber_bahan'=>$sumber_bahan,
                'id_kabkot'=>$kabkot,
                'tahun'=>get_tahun($tgl_pelaksanaan),
                'user_input'=>$this->session->username
            );
            if($this->db->insert('t_literasi',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_pelaksanaan,
                    'jenis'=>'pengembangan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'t_literasi',
                    'menu'=>'Penyusunan Literasi'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','OK !!! data literasi berhasil ditambahkan..'));
            }
            redirect('literasi');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
        $data['dt_kabkot']=$this->M_literasi->get_kabkot();
		$data['dt_row']=$this->M_literasi->get_row('id_literasi',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $judul=$this->input->post('judul');
            $penyusun=$this->input->post('penyusun');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $tingkatan=$this->input->post('tingkatan');
            $tema=$this->input->post('tema');
            $sumber_bahan=$this->input->post('sumber_bahan');
            $kabkot=$this->input->post('kabkot');
            $id_key=$this->input->post('id_key');
            $data=array(
                'judul'=>$judul,
                'penyusun'=>$penyusun,
                'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                'tahun'=>get_tahun($tgl_pelaksanaan),
                'tingkatan'=>$tingkatan,
                'tema'=>$tema,
                'sumber_bahan'=>$sumber_bahan,
                'id_kabkot'=>$kabkot
            );
            $this->M_literasi->get_upd($id_key,$data);
            $this->M_literasi->upd_tgl_input($id_key,$tgl_pelaksanaan);
            $this->session->set_flashdata('notif',alert('success','OK !!! update data literasi berhasil..'));
            redirect('literasi');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_literasi->delete_by_id($key);
            $this->M_literasi->del_lap_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}