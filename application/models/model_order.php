<?php
Class Model_order extends CI_Model {
	public function __construct()
	{
		parent::__construct();
	}
	
	public function get_order($perpage, $offset, $sort_by, $sort_order, $ext) //for_admin_user
	{		
		$id_user = $this->session->userdata('user_id');
		
		$sort_order = ($sort_order == 'desc') ? 'desc' : 'asc';
		$sort_columns = array('id_order','tanggal_masuk','tanggal_keluar','status_order');
		$sort_by = (in_array($sort_by, $sort_columns)) ? $sort_by : 'id_order';	
		
		$this->db->join('tb_user','tb_user.id_user=tb_order.id_user');
        $this->db->join('tb_userdata','tb_userdata.id_user=tb_user.id_user');
		$this->db->group_by('tb_order.id_order');
		
		if($ext == 'user'){
			$q = $this->db->select('*')->from('tb_order')
			->where('tb_order.id_user', $id_user)
			->limit($perpage, $offset)
			->order_by($sort_by, $sort_order);
		} elseif ($ext == 'baru'){
			$q = $this->db->select('*')->from('tb_order')
			->where('status_order = ',0)
			->or_where('status_order = ',1)
			->limit($perpage, $offset)
			->order_by($sort_by, $sort_order);
		} else {
			$q = $this->db->select('*')->from('tb_order')
			->limit($perpage, $offset)
			->order_by($sort_by, $sort_order); 
		};
			 
		$data2 = $ret['rows'] = $q->get()->result();		 
		$q = $this->db->select('COUNT(*) as count', FALSE)->from('tb_order');		 
		$tmp = $q->get()->result();		 
		
		
		$data = $q->get('tb_order')->result();
        foreach ($ret['rows'] as $key=>$val){
            $this->db->where(array('id_order'=>$val->id_order));
            $this->db->join('tb_produk','tb_produk.id_produk = tb_orderdata.id_produk');			
            $detail = $ret['def'] = $this->db->get('tb_orderdata')->result();
            $data2[$key]->detail = $detail;
        } 		
		
		$ret['num_rows'] = $tmp[0]->count;		 
		return $ret;
	}
	
	public function insert($data = array(), $cart = array()) //for_user
	{	
		if($this->insert_order($data)){
			$id = $this->db->insert_id();
			foreach ($cart as $item){
				$detail = array(
					'id_order' => $id,
					'id_produk' => $item['id'],
					'jumlah' => $item['qty'],
					'subtotal' => $item['subtotal']
				);
				$this->db->insert('tb_orderdata', $detail);
			}
			
			$total_biaya = $this->cart->total()*10/100+$this->cart->total();
			// memasukkan kode transaksi untuk DP
			$trans1 = array(
				'tipe_trans' => 'DP',
				'kode_trans' => $id.$this->session->userdata('user_id').date("dmYHis").'01',
				'id_order' => $id,
				'jumlah_trans' => $total_biaya*25/100
			);
			// memasukkan kode transaksi untuk FP
			$trans2 = array(
				'tipe_trans' => 'FP',
				'kode_trans' => $id.$this->session->userdata('user_id').date("dmYHis").'02',
				'id_order' => $id,
				'jumlah_trans' => $total_biaya*75/100
			);
			
			$this->db->insert('tb_transaksi', $trans1);
			$this->db->insert('tb_transaksi', $trans2);
			
			return TRUE;
		}		
		return FALSE;		
	}
	
	public function insert_order($data = array()) {
        if($this->db->insert('tb_order',$data)) {
            return $this->db->insert_id();
        }
        return false;
    }
	
	public function get_orderdata($id = 0, $get_user = FALSE)
	{
		$this->db->where($id);
		if ($get_user) {
			$this->db->join('tb_userdata','tb_userdata.id_user = tb_order.id_user');
		}
		$this->db->group_by('tb_order.id_order');
		$data = $this->db->get('tb_order')->result_array();
		foreach ($data as $key=>$val){
			$this->db->where(array('id_order'=>$val['id_order']));
            $this->db->join('tb_produk','tb_produk.id_produk = tb_orderdata.id_produk');
			
			$detail = $this->db->get('tb_orderdata')->result_array();
            $data[$key]['detail'] = $detail;
            
        } 
		foreach ($data as $key=>$val){
			$this->db->where(array('id_order'=>$val['id_order']));
			
			$transaksi = $this->db->get('tb_transaksi')->result_array();
            $data[$key]['transaksi'] = $transaksi;
            
        } 

        return $data;
	}
	
	public function update_by($where = array(), $data = array()) //for_admin
	{
		$this->db->where($where);
		if ($this->db->update('tb_order',$data)){
			return true;
		}
		return false;
	}
	
	public function update_trans($where = array(), $data = array()) //for_admin
	{
		$this->db->where($where);
		if ($this->db->update('tb_transaksi',$data)){
			if ($data['status_trans'] == 1 AND $where['tipe_trans'] == 'DP') {
				$id_order = $where['id_order'];
				$this->update_by(array('id_order' => $id_order),array('status_order'=> 1));
		 	}
			if ($data['status_trans'] == 1 AND $where['tipe_trans'] == 'FP') {
				$id_order = $where['id_order'];
				$this->update_by(array('id_order' => $id_order),array('status_order'=> 3));
		 	}
			return true;
		}
		return false;
	}
	
	function get_transaksi($id = 0, $get_user = FALSE)
	{
		$this->db->where($id);
		$query = $getData = $this->db->from('tb_transaksi')->order_by('kode_trans','ASC')->get();
		if($getData->num_rows() > 0)   
			return $query;  
		else  
			return null;       
	}
	
	function upload_transaksi($nama_file){
		$id_trans = $this->input->post('id_trans');
		$now = date('Y-m-d');
		$data = array('tanggal_trans' => $now, 'bukti_trans' => $nama_file);
		
		$this->db->where('id_trans', $id_trans);
		$this->db->update('tb_transaksi',$data);
	}
	
	/*function get_produk($limit = array())
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

	public function get_produk_edit($id_produk) 
	{
		
		//$this->db->order_by('id_kategori','ASC');
		$this->db->where('id_produk',$id_produk);
		//$query = $getData = $this->db->get('tb_produk');   
		$query = $getData = $this->db->from('tb_produk')->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori')->order_by('tb_produk.id_kategori','ASC')->get();
		if($getData->num_rows() > 0)   
			return $query;  
		else  
			return null;       
	}
	
	function edit_produk() 
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
		
	}
	
	function edit_produk_file($nama_file) 
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


	function hapus_produk($id_produk)
	{
        $this->db->where('id_produk',$id_produk);
        $this->db->delete('tb_produk'); 
	}

	public function get_kategori_list() 
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
	
	public function get_kategori()
	{
		$this->db->order_by('nama_kategori','ASC');
		$query = $getData = $this->db->get('tb_kategori');
		if($getData->num_rows() > 0)
			return $query->result();
		else
			return null;
	}
	
	function search($perpage, $offset, $sort_by, $sort_order)
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
	
	function daftar_kategori($id_kategori, $perpage, $offset, $sort_by, $sort_order)
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
		->from('tb_produk')->where(array('id_kategori' => $id_kategori));
		 
		$tmp = $q->get()->result();
		 
		$ret['num_rows'] = $tmp[0]->count;
		 
		return $ret;
	} */
	
}
?>