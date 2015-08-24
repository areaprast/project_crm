<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Kategori extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_kategori');
		$this->load->model('model_options');
		
        $this->data = new stdClass;
        $this->data->cart = $this->cart->contents();
		$this->data->nama_website = $this->model_options->get_setting('nama_website');
	}

	public function index()
	{	
		if(!$this->session->userdata('admin_id')) {
			$data['judul']  = 'Login Admin/CS';
			$this->load->view('admin/login'); 
		
		} else {
			$data['judul']  = 'Kategori';
			$data['main']   = 'admin/kategori/daftar';
			$data['kategori'] = $this->model_kategori->get_kategori();
			$this->load->view('admin/template',$data);
		}
	}

	public function tambah()
	{
		if(!$this->session->userdata('admin_id')) {
			$data['judul']  = 'Login Admin/CS';
			$this->load->view('admin/login'); 
		
		} else {
			$data['judul'] = 'Tambah Kategori';
			$data['main']   = 'admin/kategori/tambah';
			$this->load->view('admin/template',$data);
		}
	}

	public function proses_tambah()
	{
		$this->load->model('model_kategori','',TRUE);
		$this->model_kategori->tambah_kategori();
		redirect('admin/kategori','refresh');
	}
	
	public function edit($id_kategori)
	{
		$data['judul'] = 'Edit Kategori';
		$id_kategori =
		$data['kategori'] = $this->model_kategori->get_kategori_edit($id_kategori);
		$data['main']   = 'admin/kategori/edit';
		$this->load->view('admin/template',$data);
	}

	public function proses_edit()
	{
		$this->load->model('model_kategori','',TRUE);
		$this->model_kategori->edit_kategori();
		redirect('admin/kategori','refresh');
	}
	
	public function hapus($id_kategori)
	{
		$this->load->model('model_kategori','',TRUE);   
		$this->model_kategori->hapus_kategori($id_kategori);   
		redirect('admin/kategori','refresh');
	}
}
?>