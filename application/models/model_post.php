<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_post extends CI_Model {
    
    public function __construct(){
        parent::__construct();
	}
    	
	public function get_post($id_post) //for_user_admin
	{
		if ($id_post) {
			$this->db->where('id_post', $id_post);
		}
		
		$this->db->order_by('tanggal_post','DESC');
		$query = $getData = $this->db->get('tb_post');
		if ($getData->num_rows() > 0)
			return $query;
		else
			return null;
	}
	
	function get_edit($id_post) //for_admin
	{
		$this->db->where('id_post',$id_post);
		$query = $getData = $this->db->get('tb_post');   
		if($getData->num_rows() > 0)   
			return $query;  
		else  
			return null;       
	}
	
	function edit_post() //for_admin
	{
		$id_post = $this->input->post('id_post');
		$data = array(
			'judul_post' => $this->input->post('judul_post'),
			'detail_post' => $this->input->post('detail_post')  
		);  
		$this->db->where('id_post',$this->input->post('id_post',$id_post));
		$this->db->update('tb_post', $data);
		$this->session->set_flashdata('pesan_post_admin', 'Posting berhasil diubah.');       
	}
	
	public function tambah_post() //for_admin
	{
		$data = array(
			'judul_post' => $this->input->post('judul_post'),
			'detail_post' => $this->input->post('detail_post')
		);
		$this->db->insert('tb_post', $data);
		$this->session->set_flashdata('pesan_post_admin', 'Posting berhasil ditambah.');  
    }
	
	function hapus_post($id_post) //for_admin
	{
        $this->db->where('id_post',$id_post);
        $this->db->delete('tb_post'); 
		$this->session->set_flashdata('pesan_post_admin', 'Post berhasil dihapus.');
	}
	
	/*public function insert($data = array()) //for_user
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
    
    public function delete($id = 0) //for_user
	{
        if ($this->db->delete('tb_user',array($this->pk => $id))) {
            return true;
        }
        return false;
    }*/
	
	public function insert_kontak($data = array()) //for_user
	{
        if($this->db->insert('tb_kontak',$data)) {
            return $this->db->insert_id();
        }
        return false;
    }
	
	public function get_option($kode_opt) //for_user
	{
		if ($kode_opt) {
			$this->db->where('kode_opt', $kode_opt);
		}
		$query = $getData = $this->db->get('tb_options');
		if ($getData->num_rows() > 0)
			return $query->result();
		else
			return null;
	}
	
}
?>