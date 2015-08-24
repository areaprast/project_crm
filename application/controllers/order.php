<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {
    private $judul = 'Laporan Order';
    
    public function __construct()
	{
        parent::__construct();
		
        $this->load->model('model_order');
        $this->load->model('model_produk');
        $this->load->model('model_options');
        $this->load->model('model_propinsi');
        				
        $this->load->library('upload');
		
        $this->data = new stdClass;
        $this->data->cart = $this->cart->contents();
		$this->data->produk_laris = $this->model_produk->get_daftar_produk(); 
		$this->data->sponsor = $this->model_options->get_sponsor();
		$this->data->nama_website = $this->model_options->get_setting('nama_website');
		$this->data->slogan_website = $this->model_options->get_setting('slogan_website');
    }
    
    public function index($sort_by = 'id_order', $sort_order = 'desc', $offset = 0, $ext = 'user')
	{
		if ($this->session->userdata('username')) 
		{
			//tentukan jumlah data per halaman
			$perpage = 5;
			$results = $this->model_order->get_order($perpage, $offset, $sort_by, $sort_order, $ext);
		
			$data['fields'] = array(
				'id_order' => 'ID Order',
				'tanggal_masuk' => 'Tanggal Belanja',
				'total_barang' => 'Total Barang',
				'total_biaya' => 'Total Biaya',
				'status_order' => 'Status'
			);
				
			$data['laporan'] = $results['rows'];	
			$data['num_results'] = $results['num_rows'];
			//$data['detail'] = $results['def'];
			
			$config = array();
			$config['base_url'] = site_url("order/index/$sort_by/$sort_order");
			$config['total_rows'] = $data['num_results'];
			$config['per_page'] = $perpage;
			$config['uri_segment'] = 6;
			//membaca konfigurasi di atas
			$this->pagination->initialize($config);
			
			$data['sort_by'] = $sort_by;
			$data['sort_order'] = $sort_order;
			
			$data['judul'] = 'Daftar Order';
			$data['kategori'] = $this->model_produk->get_kategori();
			$data['main'] = 'user/order/data_order';
			
			$this->load->view('template',$data);
		} else {
			redirect('','refresh');
		}
    }
    
    public function detail($id = 0) 
	{
		if ($this->session->userdata('username')) {
		
			$this->data->detail = $this->model_order->get_orderdata(array('id_order'=>$id),true);
			
			$data['judul'] = 'Detail Order';
			$data['kategori'] = $this->model_produk->get_kategori();
			$data['propinsi'] = $this->model_propinsi->get_propinsi();
			$data['main']   = 'user/order/detail';
			$this->load->view('template',$data);
		
		} else {
				redirect('','refresh');
		}
	}
	
	public function upload()
	{
		if ($this->session->userdata('username')) {
			$id_order = $this->input->post('id_order');
			$id_trans = $this->input->post('id_trans');
			
			if ($this->input->post('upload')){
				$nama_file = $_FILES['nama_file']['name'];
				$config['file_name'] = $nama_file;
				$config['upload_path'] = './images/transaksi/';
				$config['allowed_types'] = 'gif|jpg|png';
				$config['max_size']    = '1024';
				$config['max_width']  = '1600';
				$config['max_height']  = '1200';
				$this->upload->initialize($config);
				
				if($this->upload->do_upload('nama_file')) {
					$this->model_order->upload_transaksi($nama_file);
					$this->session->set_flashdata('sukses_upload_bukti', '<font color="green">Bukti Transaksi berhasil diupload. <br>Silahkan tunggu max 1x24jam untuk melihat perubahan status transaksi.</font>');
					redirect('order/detail/'.$id_order,'refresh');
				} else {
					$this->session->set_flashdata('sukses_upload_bukti', '<font color="red">Upload Bukti Transaksi gagal.</font>');
					redirect('order/detail/'.$id_order,'refresh');
				}
			}
		} else {
				redirect('','refresh');
		}
	}
	
	public function view() 
	{
		$this->load->view('user/order/view');
		
	}
}