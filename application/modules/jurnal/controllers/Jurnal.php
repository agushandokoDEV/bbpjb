<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class jurnal extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_jurnal');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_jurnal->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                if($val->info_produk == '0'){
                    $p='Produk Pusat';
                }else if($val->info_produk == '1'){
                    $p='Produk Balai/Kantor';
                }else if($val->info_produk == '2'){
                    $p='Produk Luar';
                }else{
                    $p='-';
                }
               	$row = array();
                //$row[] = $val->nama_kota;
                //$row[] = $val->tahun;
                $no++;
                $row[] = $no;
                $row[] = $val->judul;
                $row[] = bulan($val->bln_pelaksanaan).' '.$val->thn_pelaksanaan;
                $row[] = $val->tim_redaksi;
                $row[] = $val->volume;
                $row[] = $val->no_issn;
                $row[] = $val->lingkup;
                $row[] = $val->akreditasi;
                $row[] = $val->penerbit;
                $row[] = $p;
                $ac="'".$val->id_majalah."'";
                $action= '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("jurnal/upd/".$val->id_majalah).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_jurnal->count_all(),
    					"recordsFiltered" => $this->M_jurnal->count_filtered(),
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
            $kat='j';//$this->input->post('kat');
            $judul=$this->input->post('judul');
            $tim_redaksi=$this->input->post('tim_redaksi');
            $volume=$this->input->post('volume');
            $no_issn=$this->input->post('no_issn');
            $lingkup=$this->input->post('lingkup');
            $akreditasi=$this->input->post('akreditasi');
            $penerbit=$this->input->post('penerbit');
            $thn_terbit=$this->input->post('thn_terbit');
            $ket=$this->input->post('ket');
            $info_produk=$this->input->post('info_produk');
            $bln_pelaksanaan=$this->input->post('bln_pelaksanaan');
            $thn_pelaksanaan=$this->input->post('thn_pelaksanaan');
            $tgl_pelaksanaan=$thn_pelaksanaan.'-'.$bln_pelaksanaan.'-'.date('d');
            $data=array(
                'judul'=>$judul,
                'tim_redaksi'=>$tim_redaksi,
                'volume'=>$volume,
                'no_issn'=>$no_issn,
                'lingkup'=>$lingkup,
                'akreditasi'=>$akreditasi,
                'penerbit'=>$penerbit,
                'thn_terbit'=>$thn_terbit,
                'ket'=>$ket,
                'info_produk'=>$info_produk,
                'kat'=>$kat,
                'user_input'=>$this->session->username,
                'bln_pelaksanaan'=>$bln_pelaksanaan,
                'thn_pelaksanaan'=>$thn_pelaksanaan,
                //'tgl_pelaksanaan'=>$tgl_pelaksanaan
            );
            if($this->db->insert('t_majalah',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_pelaksanaan,
                    'jenis'=>'pengembangan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'t_majalah',
                    'menu'=>'Jurnal'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','OK !!! data Jurnal berhasil ditambahkan..'));
            }
            redirect('jurnal');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
        //$data['dt_kabkot']=$this->M_jurnal->get_kabkot();
        $data['dt_bln']=$this->bln;
		$data['dt_row']=$this->M_jurnal->get_row('id_majalah',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $id=$this->input->post('id');
            $kat='j';//$this->input->post('kat');
            $judul=$this->input->post('judul');
            $tim_redaksi=$this->input->post('tim_redaksi');
            $volume=$this->input->post('volume');
            $no_issn=$this->input->post('no_issn');
            $lingkup=$this->input->post('lingkup');
            $akreditasi=$this->input->post('akreditasi');
            $penerbit=$this->input->post('penerbit');
            $thn_terbit=$this->input->post('thn_terbit');
            $ket=$this->input->post('ket');
            $info_produk=$this->input->post('info_produk');
            $bln_pelaksanaan=$this->input->post('bln_pelaksanaan');
            $thn_pelaksanaan=$this->input->post('thn_pelaksanaan');
            
            $data=array(
                'judul'=>$judul,
                'tim_redaksi'=>$tim_redaksi,
                'volume'=>$volume,
                'no_issn'=>$no_issn,
                'lingkup'=>$lingkup,
                'akreditasi'=>$akreditasi,
                'penerbit'=>$penerbit,
                'thn_terbit'=>$thn_terbit,
                'ket'=>$ket,
                'info_produk'=>$info_produk,
                'kat'=>$kat,
                'bln_pelaksanaan'=>$bln_pelaksanaan,
                'thn_pelaksanaan'=>$thn_pelaksanaan
            );
            $tgl_pelaksanaan=$thn_pelaksanaan.'-'.$bln_pelaksanaan.'-'.date('d');
            $this->M_jurnal->get_upd($id,$data);
            $this->M_jurnal->upd_tgl_input($id,$tgl_pelaksanaan);
            $this->session->set_flashdata('notif',alert('success','OK !!! update data Jurnal berhasil..'));
            redirect('jurnal');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_jurnal->delete_by_id($key);
            $this->M_jurnal->del_lap_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_jurnal->get_row('id_majalah',$key);
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
            $this->M_jurnal->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}