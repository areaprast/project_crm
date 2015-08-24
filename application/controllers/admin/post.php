<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Post extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_post');
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
			$data['judul']  = 'Daftar Post';
			$data['main']   = 'admin/post/daftar';
			$data['post'] = $this->model_post->get_post('');
			$this->load->view('admin/template',$data);
		}
	}

	public function tambah()
	{
		if(!$this->session->userdata('admin_id')) {
			$data['judul']  = 'Login Admin/CS';
			$this->load->view('admin/login'); 
		
		} else {
			$data['judul'] = 'Tambah Post';
			$data['main']   = 'admin/post/tambah';
			$this->load->view('admin/template',$data);
		}
	}

	public function proses_tambah()
	{
		$this->model_post->tambah_post();
		redirect('admin/post','refresh');
	}
	
	public function edit($id_post)
	{
		$data['judul'] = 'Edit Post';
		$data['post'] = $this->model_post->get_edit($id_post);
		$data['main']   = 'admin/post/edit';
		$this->load->view('admin/template',$data);
	}

	public function proses_edit()
	{
		$this->model_post->edit_post();
		redirect('admin/post','refresh');
	}
	
	public function hapus($id_post)
	{
		$this->load->model('model_post','',TRUE);   
		$this->model_post->hapus_post($id_post);   
		redirect('admin/post','refresh');
	}
}
?>