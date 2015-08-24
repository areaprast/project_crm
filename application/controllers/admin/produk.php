<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Produk extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url', 'form'));
		
		$this->load->model('model_produk');
		$this->load->model('model_options');
		
		$this->load->library(array('upload', 'form_validation','pagination'));
		
        $this->data = new stdClass;
        $this->data->cart = $this->cart->contents();
		$this->data->nama_website = $this->model_options->get_setting('nama_website');
	}

	public function index($sort_by = 'title', $sort_order = 'asc', $offset = 0)
	{	
		if(!$this->session->userdata('admin_id')) {
			$data['judul']  = 'Login Admin/CS';
			$this->load->view('admin/login'); 
		} else {
			//tentukan jumlah data per halaman
			$perpage = 10;
			$results = $this->model_produk->search($perpage, $offset, $sort_by, $sort_order);
		
			$data['fields'] = array(
				'nama_produk' => 'Nama Produk',
				'kode_produk' => 'Kode',
				'nama_kategori' => 'Kategori',
				'harga_jual' => 'Harga Jual',
				'harga_baru' => 'Harga Baru',
				'stok_produk' => 'Stok' 
			);
				
			$data['produks'] = $results['rows'];	
			$data['num_results'] = $results['num_rows'];
			
			$config = array();
			$config['base_url'] = site_url("admin/produk/index/$sort_by/$sort_order");
			$config['total_rows'] = $data['num_results'];
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 6;
			//membaca konfigurasi di atas
			$this->pagination->initialize($config);
			
			$data['sort_by'] = $sort_by;
			$data['sort_order'] = $sort_order;
			
			$data['judul']  = 'Produk';
			$data['main']   = 'admin/produk/daftar';
			$this->load->view('admin/template',$data);
		}
	}
	
	public function proses_tambah()
	{		
		if(!$this->session->userdata('admin_id')) {
			$data['judul']  = 'Login Admin/CS';
			$this->load->view('admin/login'); 
		
		} else {
			$this->form_validation->set_rules('nama_produk', 'Nama Produk', 'trim|required|min_length[5]|xss_clean');
			$this->form_validation->set_rules('kode_produk', 'Kode Produk', 'trim|required|min_length[5]|xss_clean');
			$this->form_validation->set_rules('harga_jual', 'Harga Jual', 'trim|required');
			$this->form_validation->set_rules('harga_baru', 'Harga Baru', 'trim|required');
			$this->form_validation->set_message('required', '%s <font color="red">harus diisi</font>.');
			$this->form_validation->set_message('min_length', '%s <font color="red">minimal 5 karakter</font>.');
							
			if ($this->form_validation->run() == FALSE) {
				$data['kategori_options'] = $this->model_produk->get_kategori_list();
				$data['judul'] = 'Tambah Produk';
				$data['main']   = 'admin/produk/tambah';
				$this->load->view('admin/template',$data);
			} else {
				$nama_file = $_FILES['nama_file']['name'];
				// Konfigurasi Upload Gambar
				$config['file_name'] = $nama_file;
				$config['upload_path'] = './images/produk/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']    = '1024';
				$config['max_width']  = '1600';
				$config['max_height']  = '1200';
				$this->upload->initialize($config);
				
				if( !$this->upload->do_upload('nama_file')) {
					$nama_file = 'photo_not_available.jpg';
					$this->model_produk->tambah_produk($nama_file);
					//echo $nama_file;
					redirect('admin/produk','refresh');
				} else {
					$this->model_produk->tambah_produk($nama_file);
					//echo $nama_file;
					redirect('admin/produk','refresh');
				}
			}
		}
	}
	
	public function edit($id_produk)
	{
		if(!$this->session->userdata('admin_id')) {
			$data['judul']  = 'Login Admin/CS';
			$this->load->view('admin/login'); 
		
		} else {
			$data['kategori_options'] = $this->model_produk->get_kategori_list();
			$data['images'] = $this->model_produk->get_produk_edit('images');
			$data['judul'] = 'Edit Produk';
			$data['produk'] = $this->model_produk->get_produk_edit($id_produk);
			$data['main']   = 'admin/produk/edit';
			$this->load->view('admin/template',$data);
		}
	}

	public function proses_edit()
	{
		$nama_file = $_FILES['nama_file']['name'];
		// Konfigurasi Upload Gambar
		$config['file_name'] = $nama_file;
		$config['upload_path'] = './images/produk/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']    = '1024';
		$config['max_width']  = '1600';
		$config['max_height']  = '1200';
		$this->upload->initialize($config);

		echo $nama_file;
		
		if( !$this->upload->do_upload('nama_file')) {
			$this->model_produk->edit_produk();
			redirect('admin/produk','refresh');
		} else {
			//$post['image_produk']='photo_not_available.jpg';
			$this->model_produk->edit_produk_file($nama_file);
			redirect('admin/produk','refresh');
		}	
	}
	
	public function hapus($id_produk)
	{
		$this->load->model('model_produk','',TRUE);   
		$this->model_produk->hapus_produk($id_produk);   
		redirect('admin/produk','refresh');
	}
	
	/*public function detail($id_produk)
	{
		$data['kategori_options'] = $this->model_produk->get_kategori_list();
		$data['images'] = $this->model_produk->get_produk_edit('images');
		$data['judul'] = 'Detail Produk';
		$id_produk =
		$data['produk'] = $this->model_produk->get_produk_edit($id_produk);
		$data['main']   = 'admin/produk/detail';
		$this->load->view('admin/template',$data);
	}*/
}
?>