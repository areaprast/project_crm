<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Produk extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_produk');
		$this->load->model('model_options');
		
        $this->data = new stdClass;
        $this->data->form_login = true;
        $this->data->cart = $this->cart->contents();
		$this->data->produk_laris = $this->model_produk->get_daftar_produk(); 	
		$this->data->sponsor = $this->model_options->get_sponsor();	
		$this->data->nama_website = $this->model_options->get_setting('nama_website');
		$this->data->slogan_website = $this->model_options->get_setting('slogan_website');
	}

	public function index($sort_by = 'title', $sort_order = 'asc', $offset = 0)
	{
		//tentukan jumlah data per halaman
        $perpage = 10;
		$results = $this->model_produk->search($perpage, $offset, $sort_by, $sort_order);
				
		$data['produks'] = $results['rows'];	
		$data['num_results'] = $results['num_rows'];
		
		$config = array();
		$config['base_url'] = site_url("produk/index/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $perpage;
		$config['uri_segment'] = 5;
		//membaca konfigurasi di atas
		$this->pagination->initialize($config);
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		
		$data['judul']  = 'Daftar Produk';
		$data['main']   = 'user/produk/daftar';
		$data['kategori'] = $this->model_produk->get_kategori();
		$this->load->view('template',$data);
	}

	public function detail($id_produk)
	{
		$data['kategori_options'] = $this->model_produk->get_kategori_list();
		$data['images'] = $this->model_produk->get_produk_edit('images');
		$data['judul'] = 'Detail Produk';
		$id_produk =
		$data['produk'] = $this->model_produk->get_produk_edit($id_produk);
		$data['main']   = 'user/produk/detail';
		$data['kategori'] = $this->model_produk->get_kategori();
		$data['produk_baru'] = $this->model_produk->get_daftar_produk();
		$this->load->view('template',$data);
	}
	
	/*public function kategori()
	{
		$data['judul']  = 'Kategori';
		$data['main']   = 'user/produk/kategori';
		$data['kategori'] = $this->model_produk->get_kategori();
		$this->load->view('template',$data);
	}
	
	public function daftar_kategori($id_kategori)
	{
		$data['judul']  = 'Daftar Kategori';
		$data['main']   = 'user/produk/kategori_daftar';
		$data['daftarkategori'] = $this->model_produk->daftar_kategori($id_kategori);
		$data['kategori'] = $this->model_produk->get_kategori();
		$this->load->view('template',$data);
	}*/
}
?>