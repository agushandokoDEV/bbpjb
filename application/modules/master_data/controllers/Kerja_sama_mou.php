<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kerja_sama_mou extends Userauth {

	function __construct(){
	   parent::__construct();
       $this->load->model('M_mou');
	}
    
    public function index()
	{
        $this->load->view('mou/page_index');
	}
    
    public function ajax_list(){
		if ($this->input->is_ajax_request()){
           $list = $this->M_mou->get_datatables();
            $data = array();
            $no = $_POST["start"];
            foreach ($list as $val) {
                $no++;
               	$row = array();
                $row[] = $no;
                $row[] = $val->nama_instansi;
                $row[] = $val->no_kerjasama;
                $row[] = tanggal($val->tgl_kerjasama);
                $row[] = tanggal($val->tgl_berakhir);
                $row[] = $val->perihal;
                $row[] = $val->ket;
                
                $row[] = '
                    <ol>
                        <li>'.$val->ttd_a.'</li>
                        <li>'.$val->ttd_b.'</li>
                    </ol>
                ';
                
                $row[] = '
                    <ol>
                        <li>'.$this->M_mou->get_row_instansi($val->instansi_ttd_a).'</li>
                        <li>'.$val->instansi_ttd_b.'</li>
                    </ol>
                ';
                
                $ac="'".$val->id_kerjasama."'";
                
                $row[]='
                <a class="btn btn-fill btn-sm btn-info" href="'.base_url("master_data/kerja_sama_mou/upd/".$val->id_kerjasama).'" title="Edit"><i class="fa fa-edit"></i></a>
                <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>';
                
                //$row[] = $action;
                $data[] = $row;
            }
            $output = array(
    					"draw" => $_POST['draw'],
    					"recordsTotal" => $this->M_mou->count_all(),
    					"recordsFiltered" => $this->M_mou->count_filtered(),
    					"data" => $data,
    			);
    		//output to json format
    		echo json_encode($output);
        }else{
            show_404();
        }
	}
    
    public function add()
	{
        $this->load->view('mou/page_add');
	}
    
    public function do_add()
	{
        if($this->input->method() == 'post'){
            $nama_instansi=$this->input->post('nama_instansi');
            $tgl_kerjasama=$this->input->post('tgl_kerjasama');
            $tgl_berakhir=$this->input->post('tgl_berakhir');
            $no_kerjasama=$this->input->post('no_kerjasama');
            $perihal=$this->input->post('perihal');
            $ttd_a=$this->input->post('ttd_a');
            $ttd_b=$this->input->post('ttd_b');
            $instansi_ttd_a=$this->input->post('instansi_ttd_a');
            $instansi_ttd_b=$this->input->post('instansi_ttd_b');
            $ket=$this->input->post('ket');
            $data=array(
                'nama_instansi'=>$nama_instansi,
                'tgl_kerjasama'=>$tgl_kerjasama,
                'tgl_berakhir'=>$tgl_berakhir,
                'no_kerjasama'=>$no_kerjasama,
                'perihal'=>$perihal,
                'ket'=>$ket,
                'ttd_a'=>$ttd_a,
                'ttd_b'=>$ttd_b,
                'instansi_ttd_a'=>$instansi_ttd_a,
                'instansi_ttd_b'=>$instansi_ttd_b
            );
            if($this->db->insert('t_kerjasama',$data)){
                $this->session->set_flashdata('notif',alert('success','OK !!! data berhasil ditambahkan..'));
            }
            redirect('master_data/kerja_sama_mou');
        }else{
            show_404();
        }
	}
    
    public function upd($id='')
	{
        $data['dt_row']=$this->M_mou->get_row('id_kerjasama',$id);
        $this->load->view('mou/page_upd',$data);
	}
    
    public function do_upd()
	{
        if($this->input->method() == 'post'){
            $id=$this->input->post('id_key');
            $nama_instansi=$this->input->post('nama_instansi');
            $tgl_kerjasama=$this->input->post('tgl_kerjasama');
            $tgl_berakhir=$this->input->post('tgl_berakhir');
            $no_kerjasama=$this->input->post('no_kerjasama');
            $perihal=$this->input->post('perihal');
            $ttd_a=$this->input->post('ttd_a');
            $ttd_b=$this->input->post('ttd_b');
            $instansi_ttd_a=$this->input->post('instansi_ttd_a');
            $instansi_ttd_b=$this->input->post('instansi_ttd_b');
            $ket=$this->input->post('ket');
            $data=array(
                'nama_instansi'=>$nama_instansi,
                'tgl_kerjasama'=>$tgl_kerjasama,
                'tgl_berakhir'=>$tgl_berakhir,
                'no_kerjasama'=>$no_kerjasama,
                'perihal'=>$perihal,
                'ket'=>$ket,
                'ttd_a'=>$ttd_a,
                'ttd_b'=>$ttd_b,
                'instansi_ttd_a'=>$instansi_ttd_a,
                'instansi_ttd_b'=>$instansi_ttd_b
            );
            //echo_pre($data);
            $this->M_mou->get_upd($id,$data);
            $this->session->set_flashdata('notif',alert('success','OK !!! update data berhasil..'));
            redirect('master_data/kerja_sama_mou');
        }else{
            show_404();
        }
	}
    
    public function hapus()
	{
	   if($this->input->is_ajax_request())
       {
            $key=$this->input->post('key');
            $this->M_mou->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
       }
	}
}