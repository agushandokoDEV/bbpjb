<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Karyailmiah extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_karyailmiah');
    }

    public function index(){
		$this->load->view("page_index");
	}
    
    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_karyailmiah->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = $val->jenis;
                $row[] = $val->judul;
                $row[] = bulan($val->bln_pelaksanaan).' '.$val->tahun;
                $row[] = $val->penulis;
                $row[] = $val->prodi;
                $row[] = $val->perguruan_t;
                $ac="'".$val->id_karyailmiah."'";
                $action='
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("karyailmiah/upd/".$val->id_karyailmiah).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_karyailmiah->count_all(),
    					"recordsFiltered" => $this->M_karyailmiah->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}

    public function add(){
        $data['dt_bln']=$this->bln;
		$this->load->view("page_add",$data);
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $jenis=$this->input->post('jenis');
            $judul=$this->input->post('judul');
            $penulis=$this->input->post('penulis');
            $tahun=$this->input->post('tahun');
            $prodi=$this->input->post('prodi');
            $perguruan_t=$this->input->post('perguruan_t');
            $abstrak=$this->input->post('abstraksi');
            //$kabkot=$this->input->post('kabkot');
            $bln_pelaksanaan=$this->input->post('bln_pelaksanaan');
            $tgl_pelaksanaan=$tahun.'-'.$bln_pelaksanaan.'-'.date('d');
            $data=array(
                    'satuan_kerja'=>'balai bahasa provinsi jawa barat',
                    'jenis'=>$jenis,
                    'judul'=>$judul,
                    'penulis'=>$penulis,
                    'tahun'=>$tahun,
                    'prodi'=>$prodi,
                    'perguruan_t'=>$perguruan_t,
                    'abstraksi'=>$abstrak,
                    'user_input'=>$this->session->username,
                    'bln_pelaksanaan'=>$bln_pelaksanaan
                    //'id_kabkot'=>$kabkot
            );
            if($this->db->insert('t_karyailmiah',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_pelaksanaan,
                    'jenis'=>'pengembangan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'t_karyailmiah',
                    'menu'=>'Karya Ilmiah'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','Data karyailmiah berhasil ditambahkan'));
            }
            redirect('karyailmiah');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
        //$data['dt_kabkot']=$this->M_karyailmiah->get_kabkot();
        $data['dt_bln']=$this->bln;
		$data['dt_row']=$this->M_karyailmiah->get_row('id_karyailmiah',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $jenis=$this->input->post('jenis');
            $judul=$this->input->post('judul');
            $penulis=$this->input->post('penulis');
            $tahun=$this->input->post('tahun');
            $prodi=$this->input->post('prodi');
            $perguruan_t=$this->input->post('perguruan_t');
            $abstrak=$this->input->post('abstraksi');
            //$kabkot=$this->input->post('kabkot');
            $bln_pelaksanaan=$this->input->post('bln_pelaksanaan');
            $id=$this->input->post('id');
            $data=array(
                    'jenis'=>$jenis,
                    'judul'=>$judul,
                    'penulis'=>$penulis,
                    'tahun'=>$tahun,
                    'prodi'=>$prodi,
                    'perguruan_t'=>$perguruan_t,
                    'abstraksi'=>$abstrak,
                    'bln_pelaksanaan'=>$bln_pelaksanaan
                    //'id_kabkot'=>$kabkot
            );
            $tgl_pelaksanaan=$tahun.'-'.$bln_pelaksanaan.'-'.date('d');
            $this->M_karyailmiah->get_upd($id,$data);
            $this->M_karyailmiah->upd_tgl_input($id,$tgl_pelaksanaan);
            $this->session->set_flashdata('notif',alert('success','Update data karyailmiah berhasil'));
            redirect('karyailmiah');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_karyailmiah->delete_by_id($key);
            $this->M_karyailmiah->del_lap_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_karyailmiah->get_row('id_karyailmiah',$key);
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
            $this->M_karyailmiah->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}