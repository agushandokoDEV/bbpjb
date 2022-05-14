<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Pegawai extends Userauth {
    
    function __construct(){
	   parent::__construct();
       $this->load->model('M_pegawai');
    }

    public function index(){
		$this->load->view("page_index");
	}

    public function ajax_data(){
		if($this->input->is_ajax_request()){
            $list = $this->M_pegawai->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $val->nip;
                $row[] = $val->nama;
                $row[] = $val->email;
                $row[] = $val->no_tlp;
                $row[] = $val->jabatan;
                $ac="'".$val->nip."','".$val->foto."'";
                $action= '
                    <a class="btn btn-fill btn-sm btn-info" href="'.base_url("pegawai/upd/".$val->nip).'" title="Edit"><i class="fa fa-edit"></i></a>
    		         <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                     ';
                $row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_pegawai->count_all(),
    					"recordsFiltered" => $this->M_pegawai->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}
    
    public function nip_checked(){
        if($this->input->is_ajax_request()){
            $nip=$this->input->post('nip');
            $checkd=$this->M_pegawai->get_row('nip',$nip);
            if($checkd != null){
                $r=false;
            }else{
                $r=true;
            }
            echo json_encode(array('valid'=>$r));
        }else{
            show_404();
        }
    }

    public function add(){
		$this->load->view("page_add");
	}

    public function do_add(){
		if($this->input->method() == "post"){
            $nip=$this->input->post('nip');
            $nama=$this->input->post('nama_peg');
            $ttl=$this->input->post('ttl');
            $email=$this->input->post('email');
            $no_tlp=$this->input->post('no_tlp');
            $alamat=$this->input->post('alamat');
            $pangkat=$this->input->post('pangkat');
            $gol=$this->input->post('gol');
            $jabatan=$this->input->post('jabatan');
            $penata=$this->input->post('penata');
            $data=array(
                'nip'=>$nip,
                'nama'=>$nama,
                'tgl_lahir'=>$ttl,
                'email'=>$email,
                'no_tlp'=>$no_tlp,
                'alamat'=>$alamat,
                'pangkat'=>$pangkat,
                'gol'=>$gol,
                'penata'=>$penata,
                'jabatan'=>$jabatan
            );
            $foto=$_FILES['foto'];
            $dt_foto=array();
            $err=TRUE;
            if($foto['name'] != null){
                if($foto['type'] === 'image/jpeg' || $foto['type'] === 'image/png'){
                    if($foto['size'] > 1000000){
                        $errmsg='Ukuran file teralul besar';
                    }else{
                        $config['upload_path'] = 'common/album/pegawai/';
                		$config['allowed_types'] = 'jpg|png';
                		//$config['max_size']	= '1500';
                		//$config['max_width']  = '1024';
                		//$config['max_height']  = '768';
                        
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if (! $this->upload->do_upload('foto'))
                        {
                            $error = array('error' => $this->upload->display_errors());
                            $notif=$this->upload->display_errors();
                        }
                        else
                        {   
                            $err=FALSE;
                            $img_data=(object)$this->upload->data();
                            $data['foto']=$img_data->file_name;
                        }
                    }
                }else{
                    $errmsg='Format foto tidak valid';
                }
            }else{
                $err=FALSE;
                $data['foto']='default.png';
            }
            
            if($this->db->insert('t_pegawai',$data)){
                if($err){
                    $this->session->set_flashdata('notif_upl',alert('danger','Upload foto gagal, silahkan upload kembali..'));
                }
                $this->session->set_flashdata('notif',alert('success','OK !!! data Pegawai berhasil ditambahkan..'));
            }
            redirect('pegawai');
        }else{
            show_404();
        }
	}

    public function upd($id=null){
		$data['dt_row']=$this->M_pegawai->get_row('nip',$id);
        $this->load->view("page_upd",$data);
	}

    public function do_upd(){
		if($this->input->method() == "post"){
            $nip=$this->input->post('nip');
            $nama=$this->input->post('nama_peg');
            $ttl=$this->input->post('ttl');
            $email=$this->input->post('email');
            $no_tlp=$this->input->post('no_tlp');
            $alamat=$this->input->post('alamat');
            $pangkat=$this->input->post('pangkat');
            $gol=$this->input->post('gol');
            $jabatan=$this->input->post('jabatan');
            $penata=$this->input->post('penata');
            $data=array(
                'nama'=>$nama,
                'tgl_lahir'=>$ttl,
                'email'=>$email,
                'no_tlp'=>$no_tlp,
                'alamat'=>$alamat,
                'pangkat'=>$pangkat,
                'gol'=>$gol,
                'penata'=>$penata,
                'jabatan'=>$jabatan
            );
            $foto=$_FILES['foto'];
            $dt_foto=array();
            $err=TRUE;
            if($foto['name'] != null){
                if($foto['type'] === 'image/jpeg' || $foto['type'] === 'image/png'){
                    if($foto['size'] > 1000000){
                        $errmsg='Ukuran file teralul besar';
                    }else{
                        $config['upload_path'] = 'common/album/pegawai/';
                		$config['allowed_types'] = 'jpg|png';
                		//$config['max_size']	= '1500';
                		//$config['max_width']  = '1024';
                		//$config['max_height']  = '768';
                        
                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if (! $this->upload->do_upload('foto'))
                        {
                            $error = array('error' => $this->upload->display_errors());
                            $notif=$this->upload->display_errors();
                        }
                        else
                        {   
                            
                            $err=FALSE;
                            $img_data=(object)$this->upload->data();
                            $data['foto']=$img_data->file_name;
                            if($this->input->post('file_img') != 'default.png'){
                                $path='./common/album/pegawai/'.$this->input->post('file_img');
                                unlink($path);
                            }
                        }
                    }
                }else{
                    $errmsg='Format foto tidak valid';
                }
            }
            if($this->M_pegawai->get_upd($nip,$data)){
                $this->session->set_flashdata('notif',alert('info','Update data Pegawai berhasil'));
            }
            redirect('pegawai');
        }else{
            show_404();
        }
	}

    public function hapus(){
		if($this->input->is_ajax_request()){
            $key=$this->input->post('key');
            $fto=$this->input->post('fl');
            $this->M_pegawai->delete_by_id($key);
            if($fto !='default.png'){
                $path='./common/album/pegawai/'.$fto;
                unlink($path);
            }
            echo json_encode(array("status" => TRUE));
        }else{
            show_404();
        }
	}
}