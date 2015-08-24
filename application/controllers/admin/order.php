<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {
    private $judul = 'Laporan Order';
    
    public function __construct() {
        parent::__construct();		
        $this->load->model('model_order');
		$this->load->model('model_options');
        $this->load->model('model_propinsi');
        		
        $this->data = new stdClass;		
        $this->data->cart = $this->cart->contents();
		$this->data->nama_website = $this->model_options->get_setting('nama_website');
    }
    
    function index($sort_by = 'id_order', $sort_order = 'desc', $offset = 0, $ext = 'index'){
		//tentukan jumlah data per halaman
        $perpage = 10;
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
		$config['base_url'] = site_url("admin/order/index/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $perpage;
		$config['uri_segment'] = 6;
		//membaca konfigurasi di atas
		$this->pagination->initialize($config);
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		
	
	
		$data['judul'] = 'Daftar Order';
		//$data['laporan'] = $this->model_order->get_order();
		//$data['user'] = $this->model_user->get_user_edit($id_user);
		$data['main']   = 'admin/order/daftar_order';
		$this->load->view('admin/template',$data);
    }
    
    public function detail($id = 0) {
        if ($this->input->post('submit')){
            $this->model_order->update_by(array('id_order'=>$id),array('status_order'=>$this->input->post('status')));
            //$this->model_order->update_trans(array('id_trans'=>$this->input->post('id_trans')),array('status_trans'=>$this->input->post('status_trans')));
			$this->session->set_flashdata('sukses_edit_order', 'Data berhasil diperbarui.');
			redirect('admin/order','refresh');
        } elseif ($this->input->post('update')){
			$this->model_order->update_trans(array('id_trans' => $this->input->post('id_trans'), 'id_order' => $this->input->post('id_order'), 'tipe_trans' => $this->input->post('tipe_trans')),array('status_trans' => $this->input->post('status_trans')));
			$this->session->set_flashdata('sukses_update_order', 'Data Transaksi berhasil diperbarui.');	
			redirect('admin/order/detail/'.$id,'refresh');
		} else {
            $this->data->detail = $this->model_order->get_orderdata(array('id_order'=>$id),true);
        }
		
		$data['propinsi'] = $this->model_propinsi->get_propinsi();
		$data['judul'] = 'Detail Order';
		$data['main']   = 'admin/order/detail';
		$this->load->view('admin/template',$data);
    }
	
    function order_baru($sort_by = 'id_order', $sort_order = 'desc', $offset = 0, $ext = 'baru'){
		
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
		$config['base_url'] = site_url("admin/order/order_baru/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $perpage;
		$config['uri_segment'] = 6;
		//membaca konfigurasi di atas
		$this->pagination->initialize($config);
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		
	
	
		$data['judul'] = 'Order Terbaru';
		$data['main']   = 'admin/order/order_baru';
		$this->load->view('admin/template',$data);
    }
}