<?php
Class Model_produk extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	
	public function search($perpage, $offset, $sort_by, $sort_order) //for_admin
	{
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('nama_produk','kode_produk','nama_kategori','harga_jual','harga_baru','stok_produk');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'nama_produk';
		 
		$q = $this->db->select('id_produk,nama_produk,kode_produk,nama_kategori,harga_jual,harga_baru,deskripsi_produk,stok_produk,image_produk')
		->from('tb_produk')->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori')
		->limit($perpage, $offset)
		->order_by($sort_by, $sort_order);
		 
		$ret['rows'] = $q->get()->result();
		 
		$q = $this->db->select('COUNT(*) as count', FALSE)
		->from('tb_produk')->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori');
		 
		$tmp = $q->get()->result();
		 
		$ret['num_rows'] = $tmp[0]->count;
		 
		return $ret;
	}

	public function get_kategori_list() //for_admin
	{
		$this->db->order_by('id_kategori','ASC');
		$result = $this->db->get('tb_kategori');	
		$options = array();
		foreach($result->result_array() as $row) 
		{
			$options[$row['id_kategori']] = $row['nama_kategori']; 
		}
		return $options;
	}
	
	public function tambah_produk($nama_file) //for_admin 
	{	
		//membaca data dari input post		
		$data = array(
			'nama_produk' => $this->input->post('nama_produk'),
			'kode_produk' => $this->input->post('kode_produk'),
			'harga_jual' => $this->input->post('harga_jual'),
			'harga_baru' => $this->input->post('harga_baru'),
			'deskripsi_produk' => $this->input->post('deskripsi_produk'),
			'stok_produk' => $this->input->post('stok_produk'),
			'image_produk' => $nama_file
		);
		//memasukkan data ke dalam tabel (INSERT INTO)
		$this->db->insert('tb_produk', $data);
		$this->session->set_flashdata('pesan_produk_admin', 'Produk berhasil ditambah.');       
	}

	public function get_produk_edit($id_produk) //for_admin
	{
		$this->db->where('id_produk',$id_produk);
		$query = $getData = $this->db->from('tb_produk')->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori')->order_by('tb_produk.id_kategori','ASC')->get();
		if($getData->num_rows() > 0)   
			return $query;  
		else  
			return null;       
	}
	
	public function edit_produk() //for_admin
	{
		//membaca data
		$id_produk = $this->input->post('id_produk');		
		$data = array(
			'id_kategori' => $this->input->post('kategori_id'),
			'nama_produk' => $this->input->post('nama_produk'),
			'kode_produk' => $this->input->post('kode_produk'),
			'harga_jual' => $this->input->post('harga_jual'),
			'harga_baru' => $this->input->post('harga_baru'),
			'deskripsi_produk' => $this->input->post('deskripsi_produk'),
			'stok_produk' => $this->input->post('stok_produk')    
		); 
		//mencocokkan data
		$this->db->where('id_produk',$this->input->post('id_produk',$id_produk));
		//mengupdate data tabel
		$this->db->update('tb_produk', $data); 
		$this->session->set_flashdata('pesan_produk_admin', 'Produk berhasil diubah.');       		
	}
	
	public function edit_produk_file($nama_file)//for_admin 
	{
		//membaca data
		$id_produk = $this->input->post('id_produk');		
		$data = array(
			'id_kategori' => $this->input->post('kategori_id'),
			'nama_produk' => $this->input->post('nama_produk'),
			'kode_produk' => $this->input->post('kode_produk'),
			'harga_jual' => $this->input->post('harga_jual'),
			'harga_baru' => $this->input->post('harga_baru'),
			'deskripsi_produk' => $this->input->post('deskripsi_produk'),
			'stok_produk' => $this->input->post('stok_produk'),
			'image_produk' => $nama_file     
		); 
		//mencocokkan data
		$this->db->where('id_produk',$this->input->post('id_produk',$id_produk));
		//mengupdate data tabel
		$this->db->update('tb_produk', $data);  		
	}

	public function hapus_produk($id_produk) //for_admin
	{
        $this->db->where('id_produk',$id_produk);
        $this->db->delete('tb_produk'); 
		$this->session->set_flashdata('pesan_produk_admin', 'Produk berhasil dihapus.');       		
	}
	
	
	public function get_kategori() //for_user
	{
		$this->db->order_by('nama_kategori','ASC');
		$query = $getData = $this->db->get('tb_kategori');
		if($getData->num_rows() > 0)
			return $query->result();
		else
			return null;
	}
	
	public function daftar_kategori($id_kategori, $perpage, $offset, $sort_by, $sort_order) //for_user
	{
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('nama_produk','kode_produk','harga_jual','harga_baru','stok_produk');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'nama_produk';
		 
		$q = $this->db->select('id_produk,nama_produk,kode_produk,harga_jual,harga_baru,deskripsi_produk,stok_produk,image_produk')
		->from('tb_produk')->where(array('id_kategori' => $id_kategori))
		->limit($perpage, $offset)
		->order_by($sort_by, $sort_order);
		 
		$ret['rows'] = $q->get()->result();
		 
		$q = $this->db->select('COUNT(*) as count', FALSE)
		->from('tb_produk')->where(array('id_kategori' => $id_kategori));//->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori');
		 
		$tmp = $q->get()->result();
		 
		$ret['num_rows'] = $tmp[0]->count;
		 
		return $ret;
	}
	
	public function get_daftar_produk() //for_user home_page
	{
		$this->db->limit('3')->order_by('id_produk','DESC');
		$query = $getData = $this->db->get('tb_produk');
		if($getData->num_rows() > 0)
			return $query->result();
		else
			return '';
	}

	/*public function get_produk($limit = array())
	{
		//Join Tabel tb_produk dan tb_kategori, Order BY
		$query = $getData = $this->db->from('tb_produk')->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori')->order_by('tb_produk.id_kategori','ASC')->get()->result();
		
		if($limit == NULL)
		//if($getData->num_rows() > 0)
			return $query;
		//	return $this->db->get('tb_produk')->result();
		//	echo 'test';
		else
			return $this->db->limit($limit['perpage'], $limit['offset'])->from('tb_produk')->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori')->order_by('tb_produk.id_kategori','ASC')->get()->result();
		//	return $this->db->limit($limit['perpage'], $limit['offset'])->get('tb_produk')->result();
			//return null;
		
	}

	
	
	
	public function daftar_kategori_($id_kategori)
	{		 
		$query = $getData = $this->db->get_where('tb_produk', array('id_kategori'=>$id_kategori));
		
		if($getData->num_rows() > 0)
			return $query;
		else
			return null;
		
	}*/
	
}
?>