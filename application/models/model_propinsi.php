<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_propinsi extends CI_Model {
    
    public function __construct(){
        parent::__construct();
	}
    	
	public function get_propinsi() //for_user
	{		
		$this->db->order_by('id_propinsi','ASC');
		$query = $getData = $this->db->get('tb_propinsi');
		if($getData->num_rows() > 0)
			return $query;
		else
			return null;
	}
	
}
?>