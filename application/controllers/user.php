<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    private $rules = array (
        array(
            'field'   => 'username_daftar', 
            'label'   => 'Username', 
            'rules'   => 'alpha_numeric|required|max_length[20]|min_length[6]'
            ),
        array(
            'field'   => 'email_daftar', 
            'label'   => 'Email', 
            'rules'   => 'valid_email|required'
            ),
        array(
            'field'   => 'password_daftar', 
            'label'   => 'Password', 
            'rules'   => 'alpha_numeric|required|max_length[20]|min_length[6]'
            ),
        array(
            'field'   => 'conf_password', 
            'label'   => 'Konfirmasi Password', 
            'rules'   => 'alpha_numeric|required|max_length[20]|matches[password_daftar]'
            )
        );
		
	private $profile_rules = array (
        array(
            'field'   => 'nama_depan2', 
            'label'   => 'Nama', 
            'rules'   => 'text|required'),
        array(
            'field'   => 'nama_belakang2', 
            'label'   => 'Nama Belakang', 
            'rules'   => 'text'),
        array(
            'field'   => 'alamat2', 
            'label'   => 'Alamat', 
            'rules'   => 'utf8|required|max_length[200]'),
        array(
            'field'   => 'phone2', 
            'label'   => 'Telepon', 
            'rules'   => 'numeric|required'),
        array(
            'field'   => 'kota2', 
            'label'   => 'Kota', 
            'rules'   => 'text'),
        array(
            'field'   => 'propinsi2', 
            'label'   => 'Propinsi', 
            'rules'   => 'text'),
        array(
            'field'   => 'kode_pos2', 
            'label'   => 'Kode Pos', 
            'rules'   => 'numeric')
    );
	
    private $edit_pass = array (
        array(
            'field'   => 'pass_lama', 
            'label'   => 'Password Lama', 
            'rules'   => 'alpha_numeric|required|max_length[20]|min_length[6]'
            ),
        array(
            'field'   => 'pass_baru', 
            'label'   => 'Password Baru', 
            'rules'   => 'alpha_numeric|required|max_length[20]|min_length[6]'
            ),
        array(
            'field'   => 'conf_pass_baru', 
            'label'   => 'Konfirmasi Password Baru', 
            'rules'   => 'alpha_numeric|required|max_length[20]|matches[pass_baru]'
            )
        );
		    
    public function __construct() {
        parent::__construct();
                
        $this->load->model('model_produk');
        $this->load->model('model_user');
        $this->load->model('model_aut');
        $this->load->model('model_post');
        $this->load->model('model_options');
        $this->load->model('model_propinsi');
        
        $this->load->library('form_validation');
        $this->load->library('upload');
        
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
        $this->data = new stdClass;
        $this->data->form_login = true;
        $this->data->cart = $this->cart->contents();
		$this->data->produk_laris = $this->model_produk->get_daftar_produk(); 
		$this->data->produk_baru = $this->model_produk->get_daftar_produk(); 
		$this->data->kategori = $this->model_produk->get_kategori();
		$this->data->sponsor = $this->model_options->get_sponsor();
		$this->data->nama_website = $this->model_options->get_setting('nama_website');
		$this->data->slogan_website = $this->model_options->get_setting('slogan_website');
    }
    
    public function index() {
		if ($this->session->userdata('username')) 
		{
			$data['judul']='Selamat Berbelanja';	
			$data['post'] = $this->model_post->get_post('2')->result();;	
			$data['produk'] = $this->model_produk->get_daftar_produk();
			$data['main']='main';		
			$this->load->view('template',$data);
			
		} else {
			redirect('','refresh');
		}
    }
    
    public function daftar() {
        $this->form_validation->set_rules($this->rules);
		$this->form_validation->set_message('required', '<font color="red">%s tidak boleh kosong.</font>');
		$this->form_validation->set_message('valid_email', '<font color="red">Alamat %s harus lengkap.</font>');		
		$this->form_validation->set_message('min_length', '<font color="red">%s minimal 6 karakter.</font>');	
		$this->form_validation->set_message('max_length', '<font color="red">%s maksimal 20 karakter.</font>');	
		$this->form_validation->set_message('alpha_numeric', '<font color="red">%s hanya huruf dan angka.</font>');
		
        if($this->form_validation->run()) 
		{
            $username_daftar = $this->input->post('username_daftar');
            $email_daftar = $this->input->post('email_daftar');
            $password_daftar = $this->input->post('password_daftar');
            $nama_file_ = 'photo_not_available.jpg';
			
            if(!$this->model_aut->tambah($username_daftar,$email_daftar,$password_daftar,'2',$nama_file_)) 
			{
                $this->data->error = '<font color="red">Username sudah digunakan.</font>';
            } else {
                $this->data->sukses = 'Proses registrasi berhasil.';
            }
        }
        
        $this->data->username_daftar = set_value('username_daftar');
        $this->data->email_daftar = set_value('email_daftar');
        
        $data['judul']  = 'Daftar Member Baru';
		$data['main']   = 'user/user/daftar';
        
        if (!$this->session->userdata('user_id')){ 
	    $this->data->form_login = false;
	}
		$this->load->view('template',$data);
    }
    
	public function profile_user()
	{
		if ($this->session->userdata('username')) 
		{
			$id_user = $this->session->userdata('user_id');
			$data_profile2 = $this->model_profile->get_by(array('id_user' => $id_user));
			
			if($data_profile2){
				$this->data->nama_depan2 	= $data_profile2->nama_depan;
				$this->data->nama_belakang2 = $data_profile2->nama_belakang;
				$this->data->alamat2 		= $data_profile2->alamat;
				$this->data->kode_pos2 		= $data_profile2->kode_pos;
				$this->data->phone2			= $data_profile2->phone;
				$this->data->id_propinsi2		= $data_profile2->id_propinsi;
				$this->data->kota2		= $data_profile2->kota;
			} else {
				$this->data->id_user = $id_user;
				$this->data->nama_depan2 = set_value('nama_depan2');
				$this->data->nama_belakang2 = set_value('nama_belakang2');
				$this->data->alamat2 = set_value('alamat2');
				$this->data->kode_pos2 = set_value('kode_pos2');
				$this->data->phone2 = set_value('phone2');
				$this->data->id_propinsi2 = set_value('id_propinsi2');
				$this->data->kota2 = set_value('kota2');
			}     
			
			$data['judul'] = 'Profile User';
			$data['user'] = $this->model_user->get_user_edit($id_user);
			$data['userdata'] = $this->model_user->get_userdata($id_user);
			$data['propinsi'] = $this->model_propinsi->get_propinsi();
			$data['main']   = 'user/user/profile_user';
			$this->load->view('template',$data);
			
		} else {
			redirect('','refresh');
		}
	}

	public function proses_edit()
	{
		$this->form_validation->set_rules($this->profile_rules);
		$id_user = $this->input->post('id_user');
		$data_profile2 = $this->model_profile->get_by(array('id_user' => $id_user));
		
		// Konfigurasi Upload Gambar
		$nama_file = $_FILES['nama_file']['name'];
		$config['file_name'] = $nama_file;
		$config['upload_path'] = './images/user/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']    = '1024';
		$config['max_width']  = '1600';
		$config['max_height']  = '1200';
		$this->upload->initialize($config);
				
		if( !$this->upload->do_upload('nama_file')) {
			$this->model_user->edit_user();
		} else {
			$this->model_user->edit_user_file($nama_file);
		}	
		
		$insert = array(    
			'id_user'		=> $id_user,
			'nama_depan'    => $this->input->post('nama_depan2'),
            'nama_belakang' => $this->input->post('nama_belakang2'),
            'alamat'        => $this->input->post('alamat2'),
            'kode_pos'      => $this->input->post('kode_pos2'),
            'phone'         => $this->input->post('phone2'),
            'id_propinsi'   => $this->input->post('id_propinsi2'),
            'kota'          => $this->input->post('kota2')
		);
		
		if($this->form_validation->run()){
			if($data_profile2){
				$this->model_profile->update($data_profile2->id_userdata,$insert);
				$this->session->set_flashdata('sukses_edit', '<font color="green">Update data berhasil.</font>');
			} else {
				$this->model_profile->insert($insert);
				$this->session->set_flashdata('sukses_edit', '<font color="green">Update data berhasil.</font>');
			}
		} else {
			$this->session->set_flashdata('sukses_edit', '<font color="red">Maaf data Anda belum lengkap. Silahkan lengkapi data Anda terlebih dahulu sebelum Anda simpan</font>');
		}			
		
		//$this->session->set_flashdata('sukses_edit', 'Update data berhasil.');
		redirect('user/profile_user','refresh');
	}
	
	public function edit_password()
	{
		if ($this->session->userdata('username')) 
		{
			$this->form_validation->set_rules($this->edit_pass);
			$this->form_validation->set_message('required', '<font color="red">%s tidak boleh kosong.</font>');	
			$this->form_validation->set_message('min_length', '<font color="red">%s minimal 6 karakter.</font>');	
			$this->form_validation->set_message('max_length', '<font color="red">%s maksimal 20 karakter.</font>');	
			$this->form_validation->set_message('alpha_numeric', '<font color="red">%s hanya huruf dan angka.</font>');
			$this->form_validation->set_message('matches', '<font color="red">%s tidak sama.</font>');
			
			$id_user = $this->session->userdata('user_id');
			$data_profile2 = $this->model_profile->get_by(array('id_user' => $id_user));
			
			if($this->form_validation->run()){
				$nama = $this->input->post('nama_user');
				$pass_lama = $this->input->post('pass_lama');
				$pass_baru = $this->input->post('pass_baru');
				
				if($ceks = $this->model_user->get_by_username($nama)) {
					if($ceks->password_user == md5($pass_lama)) {
						$this->model_user->edit_password();
						$this->session->set_flashdata('sukses_edit', '<font color="green">Update password berhasil.</font>');
						redirect('user/profile_user','refresh');
					} else {
						$this->session->set_flashdata('edit_pass', 'Opps. Password salah.');
						redirect('user/edit_password','refresh');
					}
				}
			}
			
			$data['judul'] = 'Profile User';
			$data['user'] = $this->model_user->get_user_edit($id_user);
			$data['main']   = 'user/user/edit_password';
			//$data['kategori'] = $this->model_produk->get_kategori();
			$this->load->view('template',$data);
			
		} else {
			redirect('','refresh');
		}
	}
}