<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Backupdb extends Userauth {
    
	function __construct(){
	   parent::__construct();
       $this->set_user_group(array('1','2','3'));
       $this->load->helper('download');
	}
    
    function index(){
        $data['dt_res']=$this->get_resent();
        $this->load->view('backupdb/page_index',$data);
    }
    
    private function get_resent(){
        $this->db->order_by('tgl','DESC');
        $dt=$this->db->get('adm_backupdb');
        return $dt->result();
    }
    private function list_tbl(){
        $tables = $this->db->list_tables();
        echo_pre($tables);
    }
    
    function export(){
        $tables = $this->db->list_tables();
        $prefs = array(
                'tables'      => $tables,  // Array of tables to backup.
                'ignore'      => array(),           // List of tables to omit from the backup
                'format'      => 'txt',             // gzip, zip, txt
                'filename'    => 'mybackup.sql',    // File name - NEEDED ONLY WITH ZIP FILES
                'add_drop'    => TRUE,              // Whether to add DROP TABLE statements to backup file
                'add_insert'  => TRUE,              // Whether to add INSERT data to backup file
                'newline'     => "\n"               // Newline character used in backup file
        );
        $this->load->dbutil();
        $backup = $this->dbutil->backup($prefs);
        $filename='backupdb_'.date('Y-m-d-h-s').'.sql';
        $dt=array(
            'user_download'=>$this->session->username,
            'filename'=>$filename
        );
        $this->db->insert('adm_backupdb',$dt);
        force_download($filename, $backup);
    }
    
    private function restoredb()
    {
      $isi_file = file_get_contents('./backup/database/mybackup.sql');
      $string_query = rtrim( $isi_file, "\n;" );
      $array_query = explode(";", $query);
      foreach($array_query as $query)
      {
        $this->db->query($query);
      }
    }
}