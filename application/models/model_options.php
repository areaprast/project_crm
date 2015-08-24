<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_options extends CI_Model {
    
    public function __construct(){
        parent::__construct();
	}
    	
	public function get_sponsor() //for_user
	{		
		$this->db->limit('3')->order_by('id_sponsor','ASC');
		$query = $getData = $this->db->get('tb_sponsor');
		if ($getData->num_rows() > 0)
			return $query->result();
		else
			return null;
	}
	
	public function get_site($id_opt) //for_user
	{				
		if ($id_opt) {
			$this->db->where('id_opt', $id_opt);
		}
		
		$query = $getData = $this->db->get('tb_options');
		if ($getData->num_rows() > 0)
			return $query->result();
		else
			return null;
	}
	
	public function get_setting($nama_opt) //for_admin
	{				
		$this->db->where('nama_opt', $nama_opt);
		$this->db->from('tb_options');
		$query = $this->db->get();
		if ($query->num_rows() > 0)
			return $query->row_array();
		else
			return null;
	}
	
	public function update_setting($nama_opt) //for_admin
	{
		$isi_opt = $this->input->post($nama_opt);
		
		$this->db->where('nama_opt', $nama_opt);
		$data = array( 'isi_opt' => $isi_opt ); 
		
		$this->db->update('tb_options', $data);  
		
		return TRUE;
	}
}
?>