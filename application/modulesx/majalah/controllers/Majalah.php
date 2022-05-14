<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Majalah extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_majalah');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_majalah->get_datatables();
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
                //$row[] = $val->kat;
                $row[] = $val->judul;
                $row[] = $val->tim_redaksi;
                $row[] = $val->volume;
                $row[] = $val->no_issn;
                $row[] = $val->lingkup;
                $row[] = $val->akreditasi;
                $row[] = $val->penerbit;
                $row[] = $p;
                $ac="'".$val->id_majalah."'";
                $action= '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("majalah/upd/".$val->id_majalah).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                if($this->session->userdata('id_role') == '4'){
                    if($val->verify == '1'){
                        $action .='<a class="btn btn-sm btn-primary" href="#" onclick="verify('.$ac.')" title="Belum terverifikasi"><span class="glyphicon glyphicon-question-sign"></span></a>';
                    }else if($val->verify == '2'){
                        $action .='<a class="btn btn-sm btn-success" href="#" onclick="verify('.$ac.')" title="Sudah terverifikasi"><span class="glyphicon glyphicon-ok-sign"></span></a>';
                    }else{
                        $action .='<a class="btn btn-sm btn-warning" href="#" onclick="verify('.$ac.')" title="Tidak terverifikasi"><span class="glyphicon glyphicon-remove-sign"></span></a>';
                    }
                    
                }
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_majalah->count_all(),
    					"recordsFiltered" => $this->M_majalah->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}

    public function add(){
		$this->load->view("page_add");
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $kat=$this->input->post('kat');
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
                'kat'=>$kat
            );
            if($this->db->insert('t_majalah',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data Majalah berhasil ditambahkan..'));
            }
            redirect('majalah');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_majalah->get_row('id_majalah',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $id=$this->input->post('id');
            $kat=$this->input->post('kat');
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
                'kat'=>$kat
            );
            if($this->M_majalah->get_upd($id,$data)){
                $this->session->set_flashdata('notif',alert('info','OK !!! update data Majalah berhasil..'));
            }
            redirect('majalah');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_majalah->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_majalah->get_row('id_majalah',$key);
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
            $this->M_majalah->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}