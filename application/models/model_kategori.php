<?php
Class Model_kategori extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}
	
	function get_kategori() //for_admin
	{
		$this->db->order_by('id_kategori','ASC');
		$query = $getData = $this->db->get('tb_kategori');
		if($getData->num_rows() > 0)
			return $query;
		else
			return null;
		
    }	

	function tambah_kategori() //for_admin
	{
		$data = array(
			'nama_kategori' => $this->input->post('nama_kategori'),
			'deskripsi' => $this->input->post('deskripsi')
		);
		$this->db->insert('tb_kategori', $data);
		$this->session->set_flashdata('pesan_kategori_admin', 'Kategori berhasil ditambah.');       
	}
	
	function get_kategori_edit($id_kategori) //for_admin
	{
		$this->db->order_by('id_kategori','ASC');
		$this->db->where('id_kategori',$id_kategori);
		$query = $getData = $this->db->get('tb_kategori');   
		if($getData->num_rows() > 0)   
			return $query;  
		else  
			return null;       
	}
	
	function edit_kategori() //for_admin
	{
		$id_kategori = $this->input->post('id_kategori');
		$data = array(
			'nama_kategori' => $this->input->post('nama_kategori'),
			'deskripsi' => $this->input->post('deskripsi')  
		);  
		$this->db->where('id_kategori',$this->input->post('id_kategori',$id_kategori));
		$this->db->update('tb_kategori', $data);
		$this->session->set_flashdata('pesan_kategori_admin', 'Kategori berhasil diubah.');       
	}
	
	function hapus_kategori($id_kategori) //forn_admin
	{
        $this->db->where('id_kategori',$id_kategori);
        $this->db->delete('tb_kategori'); 
		$this->session->set_flashdata('pesan_kategori_admin', 'Kategori berhasil dihapus.');
	}
	
	/*function daftar_kategori($id_kategori)
	{		 
		//$query = $getData = $this->db->get()->select('id_produk,nama_produk,kode_produk,nama_kategori,harga_jual,harga_baru,deskripsi_produk,stok_produk,image_produk')
		//->from('tb_produk')->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori')
		//->where('tb_kategori.id_kategori', $id_kategori)
		//->order_by('nama_kategori','ASC');
		 
		$query = $getData = $this->db->get('tb_produk');//->where('id_kategori', $id_kategori);//->order_by('nama_produk');
		
		if($getData->num_rows() > 0)
			return $query;
		else
			return null;
			
		//$q = $this->db->select('COUNT(*) as count', FALSE)
		//->from('tb_produk')->join('tb_kategori', 'tb_produk.id_kategori = tb_kategori.id_kategori');
		 
		//$tmp = $q->get()->result();
		 
		//$ret['num_rows'] = $tmp[0]->count;
		 
		//return $ret;
	}*/
}
?>