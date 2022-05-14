<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends Userauth
{
    public function __construct()
    {
        parent::__construct();
        $this->set_user_group(array('1','2','3'));
        $this->load->model("M_adm_menu");
    }

    public function index()
	{
		$this->load->view("menu/page_index");
	}
    
    public function add()
	{
		$this->set_user_group(array('1','2'));
        $data['dt_menu']=$this->M_adm_menu->get_menu();
        $this->load->view("menu/page_add",$data);
	}
    
    public function do_add()
	{
		if($this->input->method() == 'post')
        {
		      $nm_menu=$this->input->post('nm_menu');
              $controllers=$this->input->post('controllers');
              $function=$this->input->post('function');
              $sub=$this->input->post('sub');
              $icon=$this->input->post('icon');
              $maping=$this->input->post('maping');
              $dt=array(
                'nama_menu'=>$nm_menu,
                'icon'=>$icon,
                'controllers'=>$controllers,
                'function'=>$function,
                'sub'=>$sub,
                'maping'=>$maping
              );
              $save=$this->db->insert('adm_menu',$dt);
              if($save)
              {
                //$this->session->set_flashdata('notif','swal("OK !", "Menu berhasil ditambahkan!", "success");');
                $this->session->set_flashdata('notif',alert('success','OK !!! Menu berhasil ditambahkan..'));
              }
              else
              {
                //$this->session->set_flashdata('notif',"swal('Oops...', 'Terjadi kesalahan!', 'error');");
                $this->session->set_flashdata('danger',alert('success','OK !!! Terjadi kesalahan!..'));
              }
              redirect('manajemen/menu');
		}
	}
    
    public function upd($key = null)
	{
	    if($key != null)
        {
            $row=$this->M_adm_menu->get_row('id_menu',$key);
            if($row->num_rows())
            {
                $data['dt_menu']=$this->M_adm_menu->get_menu();
                $data['dt_row']=$row->row();
                $this->load->view("menu/page_upd",$data);
            }
            else
            {
                show_404();
            }
        }
        else
        {
            show_404();
        }
	}
    
    public function do_upd()
	{
		if($this->input->method() == 'post')
        {
		      $nm_menu=$this->input->post('nm_menu');
              $controllers=$this->input->post('controllers');
              $function=$this->input->post('function');
              $sub=$this->input->post('sub');
              $icon=$this->input->post('icon');
              $id_menu=$this->input->post('id_key');
              $maping=$this->input->post('maping');
              $dt=array(
                'nama_menu'=>$nm_menu,
                'icon'=>$icon,
                'controllers'=>$controllers,
                'function'=>$function,
                'sub'=>$sub,
                'maping'=>$maping
              );
              $this->db->where('id_menu',$id_menu);
              $save=$this->db->update('adm_menu',$dt);
              if($save)
              {
                //$this->session->set_flashdata('notif','swal("OK !", "Menu berhasil diupdate!", "success");');
                $this->session->set_flashdata('notif',alert('success','OK !!! update menu berhasil..'));
              }
              else
              {
                //$this->session->set_flashdata('notif',"swal('Oops...', 'Terjadi kesalahan!', 'error');");
                $this->session->set_flashdata('danger',alert('success','OK !!! Terjadi kesalahan!..'));
              }
              redirect('manajemen/menu');
		}
	}
    
    // AJAX datatable
    public function ajax_list()
	{
		$list = $this->M_adm_menu->get_datatables();
        $data = array();
        $no = $_POST["start"];
        foreach ($list as $val) {
            $no++;
        	$row = array();
            $row[] = $val->id_menu;
            $row[] = $val->nama_menu;
            $row[] = $val->icon;
            $row[] = $val->controllers;
            $row[] = $val->function;
            //$row[] = $this->M_adm_menu->get_menuName($val->sub)->nama_menu;
            
            $ac="'".$val->id_menu."'";
            $action = '
                <a class="btn btn-fill btn-sm btn-info" href="'.base_url("manajemen/menu/upd/".$val->id_menu).'" title="Edit"><i class="fa fa-edit"></i></a>';
            if($this->session->userdata('id_role') == '1'){
                $action .='
                <a class="btn btn-fill btn-sm btn-danger" href="#" onclick="hapus('.$ac.')" title="Hapus"><i class="fa fa-trash-o"></i></a>
                ';
            }
            
            $row[] = $action;
            $data[] = $row;
        }
        $output = array(
					"draw" => $_POST['draw'],
					"recordsTotal" => $this->M_adm_menu->count_all(),
					"recordsFiltered" => $this->M_adm_menu->count_filtered(),
					"data" => $data,
			);
		//output to json format
		echo json_encode($output);
	}
    
    public function ajax_delete()
	{
	   if($this->input->method() == 'post')
       {
            $key=$this->input->post('key');
            $this->M_adm_menu->delete_by_id($key);
		    echo json_encode(array("status" => TRUE));
       }
	}

}