<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Ukbi extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_ukbi');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		$list = $this->M_ukbi->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                //$row[] = $no;
                $row[] = ucwords($val->nama_kota);
                $row[] = $val->lokasi_pengajuan;
                $row[] = tanggal($val->tgl_pengajuan);
                $row[] = $val->jenis_pengajuan;
                $row[] = $val->materi_pengajuan;
                $row[] = $val->kat_peserta;
                $row[] = $val->jum_peserta;
                $row[] = $val->hasil_pengajuan;
                $row[] = $val->lampiran;
                $row[] = $val->ket;
                $ac="'".$val->id_ukbi."'";
                $action = '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("ukbi/upd/".$val->id_ukbi).'" title="Edit"><i class="fa fa-edit"></i></a>
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
    					"recordsTotal" => $this->M_ukbi->count_all(),
    					"recordsFiltered" => $this->M_ukbi->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
    }

    public function add(){
		$data['dt_kabkot']=$this->M_ukbi->get_kabkot();
        $this->load->view("page_add", $data);
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $kabkot=$this->input->post('kabkot');
            $lokasi_pengajuan=$this->input->post('lokasi_pengajuan');
            $tgl_pengajuan=$this->input->post('tgl_pengajuan');
            $jenis_pengajuan=$this->input->post('jenis_pengajuan');
            $materi_pengajuan=$this->input->post('materi_pengajuan');
            $kat_peserta=$this->input->post('kat_peserta');
            $jum_peserta=$this->input->post('jum_peserta');
            $hasil_pengajuan=$this->input->post('hasil_pengajuan');
            $lampiran=$this->input->post('lampiran');
            $ket=$this->input->post('ket');
            $data=array(
                        'id_kabkot'=>$kabkot,
                        'lokasi_pengajuan'=>$lokasi_pengajuan,
                        'tgl_pengajuan'=>$tgl_pengajuan,
                        'jenis_pengajuan'=>$jenis_pengajuan,
                        'materi_pengajuan'=>$materi_pengajuan,
                        'kat_peserta'=>$kat_peserta,
                        'jum_peserta'=>$jum_peserta,
                        'hasil_pengajuan'=>$hasil_pengajuan,
                        'lampiran'=>$lampiran,
                        'ket'=>$ket);
            if($this->db->insert('t_ukbi',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data Ukbi berhasil ditambahkan..'));
            }
            redirect('ukbi');
        }else{
                show_404();
            }
    	}

    public function upd($id=null){
        $data['dt_kabkot']=$this->M_ukbi->get_kabkot();
		$data['dt_ukbi']=$this->M_ukbi->get_row('id_ukbi',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $kabkot=$this->input->post('kabkot');
            $lokasi_pengajuan=$this->input->post('lokasi_pengajuan');
            $tgl_pengajuan=$this->input->post('tgl_pengajuan');
            $jenis_pengajuan=$this->input->post('jenis_pengajuan');
            $materi_pengajuan=$this->input->post('materi_pengajuan');
            $kat_peserta=$this->input->post('kat_peserta');
            $jum_peserta=$this->input->post('jum_peserta');
            $hasil_pengajuan=$this->input->post('hasil_pengajuan');
            $lampiran=$this->input->post('lampiran');
            $ket=$this->input->post('ket');
            $id=$this->input->post('id_ukbi');
            $data=array(
                        'id_kabkot'=>$kabkot,
                        'lokasi_pengajuan'=>$lokasi_pengajuan,
                        'tgl_pengajuan'=>$tgl_pengajuan,
                        'jenis_pengajuan'=>$jenis_pengajuan,
                        'materi_pengajuan'=>$materi_pengajuan,
                        'kat_peserta'=>$kat_peserta,
                        'jum_peserta'=>$jum_peserta,
                        'hasil_pengajuan'=>$hasil_pengajuan,
                        'lampiran'=>$lampiran,
                        'ket'=>$ket);
            if($this->M_ukbi->get_upd($id,$data)){
                $this->session->set_flashdata('notif',alert('info','Update data UKBI berhasil'));
            }
            redirect('ukbi');
        }else{
                show_404();
            }
    	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $this->M_ukbi->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));

        }else{
            show_404();
        }
	}
    
    public function ajax_load_v(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $data['dt_row']=$this->M_ukbi->get_row('id_ukbi',$key);
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
            $this->M_ukbi->get_upd($key,$data);
            echo json_encode(array("status" => TRUE));
		}else{
		  show_404();
		}
	}
}