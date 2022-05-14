<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sastra extends Userauth{
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_pen_sastra');
    }

    public function index(){
		$this->load->view("sastra/page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_pen_sastra->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                //$row[] = $no;
                if($val->publikasi == '1'){
                    $pub='Terbit';
                }else{
                    $pub='Belum Terbit';
                }
                $row[] = $val->peneliti;
                $row[] = $val->judul;
                $row[] = $val->tgl_mulai;
                $row[] = $val->tgl_selesai;
                $row[] = $val->lama_penelitian.' '.$val->satuan_lama_penelitian;
                $row[] = $pub;
                $row[] = $val->thn_terbit;
                $ac="'".$val->id_penelitian."'";
                $action='
                    <a class="btn btn-sm btn-info" href="'.base_url("penelitian/sastra/upd/".$val->id_penelitian).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
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
    					"recordsTotal" => $this->M_pen_sastra->count_all(),
    					"recordsFiltered" => $this->M_pen_sastra->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}

    public function add(){
		$this->load->view("sastra/page_add");
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $satuan_kerja=$this->input->post('satuan_kerja');
            $peneliti=$this->input->post('peneliti');
            $judul=$this->input->post('judul');
            $kerja_sama=$this->input->post('kerja_sama');
            $tgl_mulai=$this->input->post('tgl_mulai');
            $tgl_selesai=$this->input->post('tgl_selesai');
            $jum_lama_pen=$this->input->post('jum_lama');
            $satuan='';
            if($jum_lama_pen != ''){
                $satuan=$this->input->post('satuan_lama');
            }
            $publikasi=$this->input->post('publikasi');
            $thn_terbit=$this->input->post('thn_terbit');
            $abstrak=$this->input->post('abstrak');
            $data=array(
                    'satuan_kerja'=>'balai bahasa provinsi jawa barat',
                    'peneliti'=>$peneliti,
                    'judul'=>$judul,
                    'tgl_mulai'=>$tgl_mulai,
                    'tgl_selesai'=>$tgl_selesai,
                    'lama_penelitian'=>$jum_lama_pen,
                    'satuan_lama_penelitian'=>$satuan,
                    'publikasi'=>$publikasi,
                    'thn_terbit'=>$thn_terbit,
                    'abstraksi'=>$abstrak,
                    'kat_peneliti'=>'sastra',
                    'satuan_kerja'=>$satuan_kerja,
                    'kerja_sama'=>$kerja_sama
            );
            if($this->db->insert('t_penelitian',$data)){
                $this->session->set_flashdata('notif',alert('success','Data berhasil berhasil ditambahkan'));
            }
            redirect('penelitian/sastra');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_pen_sastra->get_row('id_penelitian',$id);
        $this->load->view("sastra/page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $satuan_kerja=$this->input->post('satuan_kerja');
            $peneliti=$this->input->post('peneliti');
            $judul=$this->input->post('judul');
            $kerja_sama=$this->input->post('kerja_sama');
            $tgl_mulai=$this->input->post('tgl_mulai');
            $tgl_selesai=$this->input->post('tgl_selesai');
            $jum_lama_pen=$this->input->post('jum_lama');
            $satuan='';
            if($jum_lama_pen != ''){
                $satuan=$this->input->post('satuan_lama');
            }
            $publikasi=$this->input->post('publikasi');
            $thn_terbit=$this->input->post('thn_terbit');
            $abstrak=$this->input->post('abstrak');
            $id=$this->input->post('id');
            $data=array(
                    'peneliti'=>$peneliti,
                    'judul'=>$judul,
                    'tgl_mulai'=>$tgl_mulai,
                    'tgl_selesai'=>$tgl_selesai,
                    'lama_penelitian'=>$jum_lama_pen,
                    'satuan_lama_penelitian'=>$satuan,
                    'publikasi'=>$publikasi,
                    'thn_terbit'=>$thn_terbit,
                    'abstraksi'=>$abstrak,
                    'kat_peneliti'=>'sastra',
                    'satuan_kerja'=>$satuan_kerja,
                    'kerja_sama'=>$kerja_sama
            );
            if($this->M_pen_sastra->get_upd($id,$data)){
                $this->session->set_flashdata('notif',alert('success','Update ata berhasil berhasil'));
            }
            redirect('penelitian/sastra');
    }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_pen_sastra->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
                show_404();
            }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_pen_sastra->get_row('id_penelitian',$key);
            $this->load->view("sastra/ajax_load_v",$data);
		}else{
		  show_404();
		}
	}
    
    public function do_verify(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $stts=$this->input->post('stts');
            $data=array('verify'=>$stts);
            $this->M_pen_sastra->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}