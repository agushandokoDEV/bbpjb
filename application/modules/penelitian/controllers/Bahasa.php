<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bahasa extends Userauth{
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_pen_bhs');
    }

    public function index(){
		$this->load->view("bahasa/page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_pen_bhs->get_datatables();
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
                $row[] = $no;
                $row[] = $val->nama_kota;
                $row[] = $val->tgl_pelaksanaan;
                $row[] = $val->peneliti;
                $row[] = $val->judul;
                $row[] = $val->tgl_mulai;
                $row[] = $val->tgl_selesai;
                $row[] = $val->lama_penelitian.' '.$val->satuan_lama_penelitian;
                $row[] = $pub;
                $row[] = $val->thn_terbit;
                $ac="'".$val->id_penelitian."'";
                $action='
                    <a class="btn btn-sm btn-info" href="'.base_url("penelitian/bahasa/upd/".$val->id_penelitian).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_pen_bhs->count_all(),
    					"recordsFiltered" => $this->M_pen_bhs->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}

    public function add(){
		$data['dt_kabkot']=$this->M_pen_bhs->get_kabkot();
        $this->load->view("bahasa/page_add",$data);
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
            $kabkot=$this->input->post('kabkot');
            $satuan='';
            if($jum_lama_pen != ''){
                $satuan=$this->input->post('satuan_lama');
            }
            $publikasi=$this->input->post('publikasi');
            $thn_terbit=$this->input->post('thn_terbit');
            $abstrak=$this->input->post('abstrak');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
            $data=array(
                    //'satuan_kerja'=>'balai bahasa provinsi jawa barat',
                    'peneliti'=>$peneliti,
                    'judul'=>$judul,
                    'tgl_mulai'=>$tgl_mulai,
                    'tgl_selesai'=>$tgl_selesai,
                    'lama_penelitian'=>$jum_lama_pen,
                    'satuan_lama_penelitian'=>$satuan,
                    'publikasi'=>$publikasi,
                    'thn_terbit'=>$thn_terbit,
                    'abstraksi'=>$abstrak,
                    'kat_peneliti'=>'bahasa',
                    'satuan_kerja'=>$satuan_kerja,
                    'kerja_sama'=>$kerja_sama,
                    'id_kabkot'=>$kabkot,
                    'tgl_pelaksanaan'=>$tgl_pelaksanaan,
                    'tahun'=>get_tahun($tgl_pelaksanaan),
                    'user_input'=>$this->session->username
            );
            if($this->db->insert('t_penelitian_bas',$data)){
                $dt_lap=array(
                    'username'=>$this->session->username,
                    'tgl_input'=>$tgl_pelaksanaan,
                    'jenis'=>'pengembangan',
                    'id_pk'=>$this->db->insert_id(),
                    'tbl_data'=>'t_penelitian_bas',
                    'menu'=>'Penelitian Bahasa'
                );
                $this->db->insert('t_laporan',$dt_lap);
                $this->session->set_flashdata('notif',alert('success','Data berhasil berhasil ditambahkan'));
            }
            redirect('penelitian/bahasa');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
        $data['dt_kabkot']=$this->M_pen_bhs->get_kabkot();
		$data['dt_row']=$this->M_pen_bhs->get_row('id_penelitian',$id);
        $this->load->view("bahasa/page_upd",$data);
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
            $kabkot=$this->input->post('kabkot');
            $tahun=$this->input->post('tahun');
            $satuan='';
            if($jum_lama_pen != ''){
                $satuan=$this->input->post('satuan_lama');
            }
            $publikasi=$this->input->post('publikasi');
            $thn_terbit=$this->input->post('thn_terbit');
            $abstrak=$this->input->post('abstrak');
            $id=$this->input->post('id');
            $tgl_pelaksanaan=$this->input->post('tgl_pelaksanaan');
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
                    //'kat_peneliti'=>'bahasa',
                    'satuan_kerja'=>$satuan_kerja,
                    'kerja_sama'=>$kerja_sama,
                    'id_kabkot'=>$kabkot,
                    'tahun'=>get_tahun($tgl_pelaksanaan),
                    'tgl_pelaksanaan'=>$tgl_pelaksanaan
            );
            $this->M_pen_bhs->get_upd($id,$data);
            $this->M_pen_bhs->upd_tgl_input($id,$tgl_pelaksanaan);
            $this->session->set_flashdata('notif',alert('success','Update ata berhasil berhasil'));
            redirect('penelitian/bahasa');
    }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_pen_bhs->delete_by_id($key);
            $this->M_pen_bhs->del_lap_id($key);
		    echo json_encode(array("status" => TRUE));
        }else{
                show_404();
            }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_pen_bhs->get_row('id_penelitian',$key);
            $this->load->view("bahasa/ajax_load_v",$data);
		}else{
		  show_404();
		}
	}
    
    public function do_verify(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $stts=$this->input->post('stts');
            $data=array('verify'=>$stts);
            $this->M_pen_bhs->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}