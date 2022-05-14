<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Festival extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_festival');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_festival->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = $val->nama_kota;
                //$row[] = $val->tahun;
                $row[] = $val->tgl_pelaksanaan;
                $row[] = $val->nama;
                $row[] = $val->tempat;
                $row[] = $val->jum_peserta;
                $row[] = $val->pemenang;
                $row[] = $val->lokasi;
                $ac="'".$val->id_festival."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("festival/upd/".$val->id_festival).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_festival->count_all(),
    					"recordsFiltered" => $this->M_festival->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}

    public function add(){
        $data['dt_kabkot']=$this->M_festival->get_kabkot();
		$this->load->view("page_add",$data);
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $nama=$this->input->post('nama');
            $tempat=$this->input->post('tempat');
            $tgl=$this->input->post('tgl_pelaksanaan');
            $jum_peserta=$this->input->post('jum_peserta');
            $pemenang=$this->input->post('pemenang');
            $lokasi=$this->input->post('lokasi');
            $id_kabkot=$this->input->post('id_kabkot');
            $tahun=get_tahun($tgl);
            $data=array(
                'nama'=>$nama,
                'tempat'=>$tempat,
                'tgl_pelaksanaan'=>$tgl,
                'jum_peserta'=>$jum_peserta,
                'pemenang'=>$pemenang,
                'id_kabkot'=>$id_kabkot,
                'lokasi'=>$lokasi,
                'tahun'=>$tahun,
                'user_input'=>$this->session->username
            );
            if($this->db->insert('t_festival',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl,
                    'jenis'=>'pembinaan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'t_festival',
                    'menu'=>'Festival dan Lomba'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','OK !!! data berhasil ditambahkan..'));
            }
            redirect('festival');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_festival->get_row('id_festival',$id);
        $data['dt_kabkot']=$this->M_festival->get_kabkot();
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $nama=$this->input->post('nama');
            $tempat=$this->input->post('tempat');
            $tgl=$this->input->post('tgl_pelaksanaan');
            $jum_peserta=$this->input->post('jum_peserta');
            $pemenang=$this->input->post('pemenang');
            $id_kabkot=$this->input->post('id_kabkot');
            $lokasi=$this->input->post('lokasi');
            $tahun=get_tahun($tgl);
            $id_key=$this->input->post('id_key');
            $data=array(
                'nama'=>$nama,
                'tempat'=>$tempat,
                'tgl_pelaksanaan'=>$tgl,
                'jum_peserta'=>$jum_peserta,
                'pemenang'=>$pemenang,
                'id_kabkot'=>$id_kabkot,
                'lokasi'=>$lokasi,
                'tahun'=>$tahun
            );
            $this->M_festival->get_upd($id_key,$data);
            $this->M_festival->upd_tgl_input($id_key,$tgl);
            $this->session->set_flashdata('notif',alert('success','OK !!! update data berhasil..'));
            redirect('festival');
        }else{
            show_404();
        }
	}
    
    private function exp_date($date){
        $ex=explode('-',$date);
        return $ex[0];
    }
    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_festival->delete_by_id($key);
            $this->M_festival->del_lap_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}