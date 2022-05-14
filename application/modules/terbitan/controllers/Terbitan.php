<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Terbitan extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_terbitan');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_terbitan->get_datatables();
            $data = array();
            $no = $_POST["start"];
            
            foreach ($list as $val) {
                $no++;
               	$row = array();
                //$row[] = $val->nama_kota;
                $row[] = $no;
                $row[] = $val->kat_terbitan;
                $row[] = $val->penulis;
                $row[] = bulan($val->bln_pelaksanaan).' '.$val->thn_pelaksanaan;
                $row[] = $val->no_isbn;
                $row[] = $val->thn_terbit;
                $row[] = $val->deskripsi;
                if($val->info_produk == '0'){
                    $p='Produk Pusat';
                }else if($val->info_produk == '1'){
                    $p='Produk Balai/Kantor';
                }else if($val->info_produk == '2'){
                    $p='Produk Luar';
                }else{
                    $p='-';
                }
                $row[] = $p;
                $ac="'".$val->id_terbitan."'";
                $action= '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("terbitan/upd/".$val->id_terbitan).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_terbitan->count_all(),
    					"recordsFiltered" => $this->M_terbitan->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}

    public function add(){
        //$data['dt_kabkot']=$this->M_terbitan->get_kabkot();
        $data['dt_bln']=$this->bln;
		$this->load->view("page_add",$data);
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $kat_terbitan=$this->input->post('kat_terbitan');
            $penulis=$this->input->post('penulis');
            $no_isbn=$this->input->post('no_isbn');
            $thn_terbit=$this->input->post('thn_terbit');
            $deskripsi=$this->input->post('deskripsi');
            $info_produk=$this->input->post('info_produk');
            $bln_pelaksanaan=$this->input->post('bln_pelaksanaan');
            $thn_pelaksanaan=$this->input->post('thn_pelaksanaan');
            //$kabkot=$this->input->post('kabkot');
            //$tahun=$this->input->post('tahun');
            $data=array(
                'kat_terbitan'=>$kat_terbitan,
                'penulis'=>$penulis,
                'no_isbn'=>$no_isbn,
                'thn_terbit'=>$thn_terbit,
                'deskripsi'=>$deskripsi,
                'info_produk'=>$info_produk,
                'user_input'=>$this->session->username,
                'bln_pelaksanaan'=>$bln_pelaksanaan,
                'thn_pelaksanaan'=>$thn_pelaksanaan
                //'id_kabkot'=>$kabkot,
                //'tahun'=>$tahun
            );
            if($this->db->insert('t_terbitan',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$thn_pelaksanaan.'-'.$bln_pelaksanaan.'-'.date('d'),
                    'jenis'=>'pengembangan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'t_terbitan',
                    'menu'=>'Terbitan'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','OK !!! data terbitan berhasil ditambahkan..'));
            }
            redirect('terbitan');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
        //$data['dt_kabkot']=$this->M_terbitan->get_kabkot();
        $data['dt_bln']=$this->bln;
		$data['dt_row']=$this->M_terbitan->get_row('id_terbitan',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $kat_terbitan=$this->input->post('kat_terbitan');
            $penulis=$this->input->post('penulis');
            $no_isbn=$this->input->post('no_isbn');
            $thn_terbit=$this->input->post('thn_terbit');
            $deskripsi=$this->input->post('deskripsi');
            $info_produk=$this->input->post('info_produk');
            $bln_pelaksanaan=$this->input->post('bln_pelaksanaan');
            $thn_pelaksanaan=$this->input->post('thn_pelaksanaan');
            //$kabkot=$this->input->post('kabkot');
            //$tahun=$this->input->post('tahun');
            $id=$this->input->post('id_key');
            $data=array(
                'kat_terbitan'=>$kat_terbitan,
                'penulis'=>$penulis,
                'no_isbn'=>$no_isbn,
                'thn_terbit'=>$thn_terbit,
                'deskripsi'=>$deskripsi,
                'info_produk'=>$info_produk,
                'bln_pelaksanaan'=>$bln_pelaksanaan,
                'thn_pelaksanaan'=>$thn_pelaksanaan
                //'id_kabkot'=>$kabkot,
                //'tahun'=>$tahun
            );
            $tgl_pelaksanaan=$thn_pelaksanaan.'-'.$bln_pelaksanaan.'-'.date('d');
            $this->M_terbitan->get_upd($id,$data);
            $this->M_terbitan->upd_tgl_input($id,$tgl_pelaksanaan);
            $this->session->set_flashdata('notif',alert('success','OK !!! update data terbitan berhasil..'));
            redirect('terbitan');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_terbitan->delete_by_id($key);
            $this->M_terbitan->del_lap_id($key);
            echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}