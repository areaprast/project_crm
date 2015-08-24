<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_profile extends CI_Model {
    
    public function __construct(){
        parent::__construct();
	}
    	
	public function get_by($param) //for_user
	{
		if (is_array($param)) {
			$this->db->where($param);
			return $this->db->get('tb_userdata')->row();
		}
		return FALSE;
	}
	
	/*protected function _get()
	{
		return $this->db->get('tb_userdata');
	}*/
	
	public function insert($data = array()) //for_user
	{
        if($this->db->insert('tb_userdata',$data)) {
            return $this->db->insert_id();
        }
        return false;
    }
    
    public function update($id_userdata,$data = array()) //for_user
	{
        $this->db->where('id_userdata',$id_userdata);
        if ($this->db->update('tb_userdata',$data)){
            return true;
        }
        return false;
    }
    
    /*public function delete($id = 0) //for_user
	{
        if ($this->db->delete('tb_user',array($this->pk => $id))) {
            return true;
        }
        return false;
    }*/
}
?>