<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class ensiklopedi extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_ensiklopedi');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_ensiklopedi->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
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
                $row[] = $no;
                $row[] = $val->nama_kota;
                $row[] = $val->tgl_pelaksanaan;
                $row[] = $val->kat;
                $row[] = $val->judul;
                $row[] = $val->tim_redaksi;
                //$row[] = $val->edisi;
                //$row[] = $val->no_isbn;
                $row[] = $val->lingkup;
                //$row[] = $val->penerbit.' '.$val->thn_terbit;
                $row[] = $p;
                $ac="'".$val->id_ensiklopedi."'";
                $action='
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("ensiklopedi/upd/".$val->id_ensiklopedi).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_ensiklopedi->count_all(),
    					"recordsFiltered" => $this->M_ensiklopedi->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}

    public function add(){
        $data['dt_kabkot']=$this->M_ensiklopedi->get_kabkot();
		$this->load->view("page_add",$data);
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $judul=$this->input->post('judul');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $kabkot=$this->input->post('kabkot');
            $kat=$this->input->post('kat');
            $tim_redaksi=$this->input->post('tim_redaksi');
            //$edisi=$this->input->post('edisi');
            //$no_isbn=$this->input->post('no_isbn');
            $lingkup=$this->input->post('lingkup');
            //$penerbit=$this->input->post('penerbit');
            //$thn_terbit=$this->input->post('thn_terbit');
            $info_produk=$this->input->post('info_produk');
            
            $data=array(
                    'judul'=>$judul,
                    'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                    'tahun'=>get_tahun($tgl_pelaksanaan),
                    'id_kabkot'=>$kabkot,
                    'kat'=>$kat,
                    'tim_redaksi'=>$tim_redaksi,
                    //'edisi'=>$edisi,
                    //'no_isbn'=>$no_isbn,
                    'lingkup'=>$lingkup,
                    //'penerbit'=>$penerbit,
                    //'thn_terbit'=>$thn_terbit,
                    'info_produk'=>$info_produk,
                    'user_input'=>$this->session->username
            );
            if($this->db->insert('t_ensiklopedi',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_pelaksanaan,
                    'jenis'=>'pengembangan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'t_ensiklopedi',
                    'menu'=>'Penyusunan ensiklopedi'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','Data ensiklopedi berhasil ditambahkan'));
            }
            redirect('ensiklopedi');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
        $data['dt_kabkot']=$this->M_ensiklopedi->get_kabkot();
		$data['dt_row']=$this->M_ensiklopedi->get_row('id_ensiklopedi',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $judul=$this->input->post('judul');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $id=$this->input->post('id_key');
            $kabkot=$this->input->post('kabkot');
            $kat=$this->input->post('kat');
            $tim_redaksi=$this->input->post('tim_redaksi');
            //$edisi=$this->input->post('edisi');
            //$no_isbn=$this->input->post('no_isbn');
            $lingkup=$this->input->post('lingkup');
            //$penerbit=$this->input->post('penerbit');
            //$thn_terbit=$this->input->post('thn_terbit');
            $info_produk=$this->input->post('info_produk');
            $data=array(
                    'judul'=>$judul,
                    'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                    'tahun'=>get_tahun($tgl_pelaksanaan),
                    'id_kabkot'=>$kabkot,
                    'kat'=>$kat,
                    'tim_redaksi'=>$tim_redaksi,
                    //'edisi'=>$edisi,
                    //'no_isbn'=>$no_isbn,
                    'lingkup'=>$lingkup,
                    //'penerbit'=>$penerbit,
                    //'thn_terbit'=>$thn_terbit,
                    'info_produk'=>$info_produk
            );
            $this->M_ensiklopedi->get_upd($id,$data);
            $this->M_ensiklopedi->upd_tgl_input($id,$tgl_pelaksanaan);
            $this->session->set_flashdata('notif',alert('success','Update data ensiklopedi berhasil'));
            redirect('ensiklopedi');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_ensiklopedi->delete_by_id($key);
            $this->M_ensiklopedi->del_lap_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}