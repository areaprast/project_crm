<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller {
	private $rules_tambah = array (
        array(
            'field'   => 'nama_user', 
            'label'   => 'Username', 
            'rules'   => 'alpha_numeric|required|max_length[20]|min_length[6]'
            ),
        array(
            'field'   => 'email_user', 
            'label'   => 'Email', 
            'rules'   => 'valid_email|required'
            ),
        array(
            'field'   => 'level_user', 
            'label'   => 'Level'
            ),
        array(
            'field'   => 'password_user', 
            'label'   => 'Password', 
            'rules'   => 'alpha_numeric|required|max_length[20]|min_length[6]'
            ),
        array(
            'field'   => 'password_conf', 
            'label'   => 'Konfirmasi Password', 
            'rules'   => 'alpha_numeric|required|max_length[20]|matches[password_user]'
            )
        );
	
    private $edit_pass = array (
        array(
            'field'   => 'pass_lama', 
            'label'   => 'Password Lama', 
            'rules'   => 'alpha_numeric|required|max_length[20]'
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
		
	public function __construct()
	{
		parent::__construct();
		
		//$this->load->helper(array('url', 'form'));
		$this->load->model('model_user');
		$this->load->model('model_profile');
		$this->load->model('model_aut');
		$this->load->model('model_options');
		
        $this->load->library('upload');
        $this->load->library('pagination');
		$this->load->library('form_validation');
        $this->load->library('session');				
		
        $this->data = new stdClass;
        $this->data->cart = $this->cart->contents();
		$this->data->nama_website = $this->model_options->get_setting('nama_website');
	}

	public function index($sort_by = 'title', $sort_order = 'asc', $offset = 0)
	{	
		if(!$this->session->userdata('admin_id')) {
			$data['judul']  = 'Login Admin/CS';
			redirect (site_url('admin'));
		}
		
		//tentukan jumlah data per halaman
        $perpage = 20;
		$results = $this->model_user->search($perpage, $offset, $sort_by, $sort_order);
	
		$data['fields'] = array(
			//'id_user' => 'ID',
			'nama_user' => 'Nama User',
			'email_user' => 'Email',
			'status_user' => 'Status',
			'level_user' => 'Level'
		);
			
		$data['users'] = $results['rows'];	
		$data['num_results'] = $results['num_rows'];
		
		$config = array();
		$config['base_url'] = site_url("admin/user/index/$sort_by/$sort_order");
		$config['total_rows'] = $data['num_results'];
		$config['per_page'] = $perpage;
		$config['uri_segment'] = 6;
		//membaca konfigurasi di atas
		$this->pagination->initialize($config);
		
		$data['sort_by'] = $sort_by;
		$data['sort_order'] = $sort_order;
		
		$data['judul']  = 'Daftar User';
		$data['main']   = 'admin/user/daftar';
		$this->load->view('admin/template',$data);	
		$this->session->set_userdata('user_edit', '');
	}
	
	public function proses_tambah()
	{		
		if(!$this->session->userdata('admin_id')) {
			$data['judul']  = 'Login Admin/CS';
			redirect (site_url('admin'));
		}
		
        $this->form_validation->set_rules($this->rules_tambah);
		$this->form_validation->set_message('required', '<font color="red">%s tidak boleh kosong.</font>');
		$this->form_validation->set_message('valid_email', '<font color="red">Alamat %s harus lengkap.</font>');		
		$this->form_validation->set_message('min_length', '<font color="red">%s minimal 6 karakter.</font>');	
		$this->form_validation->set_message('max_length', '<font color="red">%s maksimal 20 karakter.</font>');	
		$this->form_validation->set_message('alpha_numeric', '<font color="red">%s hanya huruf dan angka.</font>');
								
		if ($this->form_validation->run()){		
			$nama_user = $this->input->post('nama_user');
			$email_user = $this->input->post('email_user');
			$password_user = $this->input->post('password_user');
			$level_user = $this->input->post('level_user');
		
			$nama_file = $_FILES['nama_file']['name'];
			// Konfigurasi Upload Gambar
			$config['file_name'] = $nama_file;
			$config['upload_path'] = './images/produk/';
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']    = '1024';
			$config['max_width']  = '1600';
			$config['max_height']  = '1200';
			$this->upload->initialize($config);		
				
			if(!$this->upload->do_upload('nama_file')) {
				$nama_file_ = 'photo_not_available.jpg';
				if(!$this->model_aut->tambah($nama_user,$email_user,$password_user,$level_user,$nama_file_)){ 
					$this->session->set_flashdata('error_tambah', '<font color="red">Username sudah digunakan.</font>');
				} else {
					$this->session->set_flashdata('sukses_user', '<font color="red">Tambah user berhasil.</font>');
					redirect('admin/user','refresh');
				}
			} else {
				if(!$this->model_aut->tambah($nama_user,$email_user,$password_user,$level_user,$nama_file)){
					$this->session->set_flashdata('error_tambah', '<font color="red">Username sudah digunakan.</font>');
				} else {
					$this->session->set_flashdata('sukses_user', '<font color="red">Tambah user berhasil.</font>');
					redirect('admin/user','refresh');
				}
			}
		}		
		$data['judul'] = 'Tambah User';
		$data['main']   = 'admin/user/tambah';
		$this->load->view('admin/template',$data);		
	}
	
	public function detail($id_user)
	{		
		if(!$this->session->userdata('admin_id')) {
			$data['judul']  = 'Login Admin/CS';
			redirect (site_url('admin'));
		}
		
		$data_profile2 = $this->model_profile->get_by(array('id_user' => $id_user));
		$this->session->set_userdata('user_edit', $id_user);
					
		if($data_profile2){
            $this->data->nama_depan2 	= $data_profile2->nama_depan;
            $this->data->nama_belakang2 = $data_profile2->nama_belakang;
            $this->data->alamat2 		= $data_profile2->alamat;
            $this->data->kode_pos2 		= $data_profile2->kode_pos;
            $this->data->phone2			= $data_profile2->phone;
            $this->data->propinsi2		= $data_profile2->propinsi;
        } else {
			$this->data->id_user = $id_user;
            $this->data->nama_depan2 = set_value('nama_depan2');
            $this->data->nama_belakang2 = set_value('nama_belakang2');
            $this->data->alamat2 = set_value('alamat2');
            $this->data->kode_pos2 = set_value('kode_pos2');
            $this->data->phone2 = set_value('phone2');
			$this->data->propinsi2 = set_value('propinsi2');
        }     
		
		$data['judul'] = 'Ubah Detail User';
		$data['user'] = $this->model_user->get_user_edit($id_user);
		$data['userdata'] = $this->model_user->get_userdata($id_user);
		$data['main']   = 'admin/user/detail';
		$this->load->view('admin/template',$data);
	}

	public function proses_edit()
	{		
		if(!$this->session->userdata('admin_id')) {
			$data['judul']  = 'Login Admin/CS';
			redirect (site_url('admin'));
		}
		//$this->form_validation->set_rules($this->profile_rules2);
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
			//redirect('admin/user','refresh');
		} else {
			$this->model_user->edit_user_file($nama_file);
			//redirect('admin/user','refresh');
		}	
		
		$insert = array(    
			'id_user'		=> $id_user,
			'nama_depan'    => $this->input->post('nama_depan2'),
            'nama_belakang' => $this->input->post('nama_belakang2'),
            'alamat'        => $this->input->post('alamat2'),
            'kode_pos'      => $this->input->post('kode_pos2'),
            'phone'         => $this->input->post('phone2'),
            'propinsi'      => $this->input->post('propinsi2')
		);
		//echo 'tengah';
		if(!$this->input->post('nama_depan2') == ''){
			if($data_profile2){
				$this->model_profile->update($data_profile2->id_userdata,$insert);
				//echo 'tesss';
				$this->session->set_flashdata('sukses_user', 'Update user berhasil.');
			} else {	
				//echo 'isi';
				$this->session->set_flashdata('error_user', 'Update user gagal.');
			}
		} else {
			//if($this->input->post('nama_depan2') == ''){
				//echo 'tes';
				$this->model_profile->insert($insert);
				$this->session->set_flashdata('sukses_user', 'Update user berhasil.');
			//}
		}			
		//echo 'akhir';
		redirect('admin/user','refresh');
	}
	
	public function hapus($id_user)
	{		
		if(!$this->session->userdata('admin_id')) {
			$data['judul']  = 'Login Admin/CS';
			redirect (site_url('admin'));
		}
		//$this->load->model('model_user','',TRUE);  
		if($this->session->userdata('admin_id') != $id_user){ 
			$this->model_user->hapus_user($id_user);  
			$this->session->set_flashdata('sukses_user', 'Hapus user berhasil.');
		} else {
			$this->session->set_flashdata('error_user', '<font color="red">Anda tidak dapat menghapus akun anda sendiri.</font>');
		}
		redirect('admin/user','refresh');
	}
	
	public function edit_password()
	{		
		if(!$this->session->userdata('admin_id')) {
			$data['judul']  = 'Login Admin/CS';
			redirect (site_url('admin'));
		}
		
        $this->form_validation->set_rules($this->edit_pass);
		$this->form_validation->set_message('required', '<font color="red">%s tidak boleh kosong.</font>');	
		$this->form_validation->set_message('min_length', '<font color="red">%s minimal 6 karakter.</font>');	
		$this->form_validation->set_message('max_length', '<font color="red">%s maksimal 20 karakter.</font>');	
		$this->form_validation->set_message('alpha_numeric', '<font color="red">%s hanya huruf dan angka.</font>');
		$this->form_validation->set_message('matches', '<font color="red">%s tidak sama.</font>');
		
		$id_user = $this->session->userdata('user_edit');
		$data_profile2 = $this->model_profile->get_by(array('id_user' => $id_user));
		
		if($this->form_validation->run()){
			$nama = $this->input->post('nama_user');
			$pass_lama = $this->input->post('pass_lama');
			$pass_baru = $this->input->post('pass_baru');
			
			if($ceks = $this->model_user->get_by_username($nama)) {
				if($ceks->password_user == md5($pass_lama)) {
					$this->model_user->edit_password();
					$this->session->set_flashdata('sukses_user', 'Update password berhasil.');
					redirect('admin/user/detail/'.$id_user,'refresh');
				} else {
					$this->session->set_flashdata('edit_pass', 'Opps. Password salah.');
					redirect('admin/user/edit_password','refresh');
				}
			}
		}
		
		$data['judul'] = 'Edit Password';
		$data['user'] = $this->model_user->get_user_edit($id_user);
		$data['main']   = 'admin/user/edit_password';
		$this->load->view('admin/template',$data);
	}
	
	/*public function proses_edit_detail()
	{
		$this->model_user->edit_user_detail();
		redirect('admin/user','refresh');
	}*/
	
	/*public function edit_user_detail($id_user)
	{
		//$data['kategori_options'] = $this->model_user->get_kategori_list();
		//$data['images'] = $this->model_user->get_user_edit('images');
		$data['judul'] = 'Edit User Detail';
		$data['user'] = $this->model_user->get_user_edit($id_user);
		$data['userdata'] = $this->model_user->get_userdata($id_user);
		$data['main']   = 'admin/user/edit_user_detail';
		$this->load->view('admin/template',$data);
	}
	
	public function edit_user($id_user)
	{
		//$data['kategori_options'] = $this->model_user->get_kategori_list();
		$data['images'] = $this->model_user->get_user_edit('images');
		$data['judul'] = 'Edit User';
		$id_user =
		$data['user'] = $this->model_user->get_user_edit($id_user);
		$data['main']   = 'admin/user/edit_user';
		$this->load->view('admin/template',$data);
	}*/
}
?>