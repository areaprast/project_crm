<?php
Class Model_user extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		//membaca database (mysql_select_db) pada file config/database.php
		$this->load->database();
        $this->load->model('model_profile');
	}
	
	function search($perpage, $offset, $sort_by, $sort_order)
	{
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('id_user','nama_user','email_user','status_user','level_user');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'nama_user';
		 
		$q = $this->db->select('id_user,nama_user,email_user,status_user,level_user')->from('tb_user')
		->limit($perpage, $offset)
		->order_by($sort_by, $sort_order);
			 
		$ret['rows'] = $q->get()->result();		 
		$q = $this->db->select('COUNT(*) as count', FALSE)->from('tb_user');		 
		$tmp = $q->get()->result();		 
		
		$ret['num_rows'] = $tmp[0]->count;		 
		return $ret;
	}
	
	public function insert($data = array()) {
        if($this->db->insert('tb_user',$data)) {
            return $this->db->insert_id();
        }
        return false;
    }
	
	
	/*function tambah_user($nama_file) 
	{	
		//membaca data dari input post
		
		$data = array(
			'nama_user' => $this->input->post('nama_user'),
			'email_user' => $this->input->post('email_user'),
			'password_user' => $this->input->post('password_user'),
			'level_user' => $this->input->post('level_user'),
			'image_user' => $nama_file
		);
		//memasukkan data ke dalam tabel (INSERT INTO)
		return $this->db->insert('tb_user', $data);
		
	}
	
	function get_user($limit = array())
	{
		//Join Tabel tb_produk dan tb_kategori, Order BY
		$query = $getData = $this->db->from('tb_user')
		//->join('tb_userdata', 'tb_user.id_user = tb_userdata.id_user')
		->order_by('tb_user.id_user','ASC')->get()->result();
		
		if($limit == NULL)
		//if($getData->num_rows() > 0)
			return $query;
		//	return $this->db->get('tb_produk')->result();
		//	echo 'test';
		else
			return $this->db->limit($limit['perpage'], $limit['offset'])->from('tb_user')
			//->join('tb_userdata', 'tb_user.id_user = tb_userdata.id_user')
			->order_by('tb_user.id_user','ASC')->get()->result();
		//	return $this->db->limit($limit['perpage'], $limit['offset'])->get('tb_produk')->result();
			//return null;
		
	}*/

	function get_user_edit($id_user) 
	{
		$this->db->where('tb_user.id_user',$id_user);
		$query = $getData = $this->db->from('tb_user')->order_by('tb_user.id_user','ASC')->get();
		
		if($getData->num_rows() > 0)   
			return $query->result();  
		else  
			return null;       
	}
	
	function get_userdata($id_user) 
	{
		$this->db->where('tb_userdata.id_user',$id_user);
		$query = $getData = $this->db->from('tb_userdata')->get();
		
		if($getData->num_rows() > 0)   
			return $query;  
		else  
			return null;  			
	}
	
	
	function edit_user() 
	{
		//membaca data
		$id_user = $this->input->post('id_user');
		
		$data = array(
			'nama_user' => $this->input->post('nama_user'),
			'email_user' => $this->input->post('email_user'),
			'status_user' => $this->input->post('status_user'),
			'level_user' => $this->input->post('level_user') 
		); 
		//mencocokkan data
		$this->db->where('id_user',$this->input->post('id_user',$id_user));
		//mengupdate data tabel
		$this->db->update('tb_user', $data);  
	}	
	
	function edit_user_file($nama_file) 
	{
		//membaca data
		$id_user = $this->input->post('id_user');
		
		$data = array(
			'nama_user' => $this->input->post('nama_user'),
			'email_user' => $this->input->post('email_user'),
			'status_user' => $this->input->post('status_user'),
			'level_user' => $this->input->post('level_user'), 
			'image_user' => $nama_file     
		); 
		//mencocokkan data
		$this->db->where('id_user',$this->input->post('id_user',$id_user));
		//mengupdate data tabel
		$this->db->update('tb_user', $data);  
		
	}
	
	function edit_user_detail() 
	{
		//membaca data
		$id_user = $this->input->post('id_user');
		
		$data = array(
			'nama_depan' => $this->input->post('nama_depan'),
			'nama_belakang' => $this->input->post('nama_belakang'),
			'alamat' => $this->input->post('alamat'),
			'kode_pos' => $this->input->post('kode_pos'),
			'kota' => $this->input->post('kota'),
			'id_propinsi' => $this->input->post('id_propinsi'),
			'phone' => $this->input->post('phone')
		); 
		//mencocokkan data
		$this->db->where('id_user',$this->input->post('id_user',$id_user));
		//mengupdate data tabel
		$this->db->update('tb_userdata', $data);  
	}

	function edit_password() 
	{
		//membaca data
		$id_user = $this->input->post('id_user');
		$pass = $this->input->post('pass_baru');
		$data = array(
			'password_user' => md5($pass)
		); 
		//mencocokkan data
		$this->db->where('id_user',$this->input->post('id_user',$id_user));
		//mengupdate data tabel
		$this->db->update('tb_user', $data);  
		
		return TRUE;
	}	
	
	function hapus_user($id_user)
	{
        $this->db->where('id_user',$id_user);
        $this->db->delete('tb_user'); 
	}

	public function get_by_username($username){
		if ($query = $this->model_user->get_by(array('nama_user'=>$username))) {
			if ($query->id_user != NULL) return $query;
		}
		return FALSE;
	}
	
	public function cek_username($username,$self = FALSE){
		if ($query = $this->model_user->get_by(array('nama_user'=>$username))) {
			if ($self){
				return $query->id_user;
			} else {
				return FALSE;
			}
		}
		return TRUE;
	}
	
	public function get_by($param)
	{
		if (is_array($param)) {
			$this->db->where($param);
			return $this->db->get('tb_user')->row();
		}
		return FALSE;
	}

}
?>