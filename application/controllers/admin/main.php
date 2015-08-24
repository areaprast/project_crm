<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Main extends CI_Controller {
	private $login_admin = array (
        array(
            'field'   => 'username', 
            'label'   => 'Username', 
            'rules'   => 'alpha_numeric|required|max_length[15]|min_length[3]'),
        array(
            'field'   => 'password', 
            'label'   => 'Password', 
            'rules'   => 'alpha_numeric|required|max_length[20]|min_length[3]')
    );
	private $setting = array (
        array(
            'field'   => 'nama_website', 
            'label'   => 'Nama Website', 
            'rules'   => 'text|required'
            ),
        array(
            'field'   => 'slogan_website', 
            'label'   => 'Slogan Website', 
            'rules'   => 'text|required'
            )
        );
		
	public function __construct()
	{
		parent::__construct();
		//$this->load->helper('url');
		//$this->load->helper('form');
		
		$this->load->model('model_aut');
		$this->load->model('model_user');
		$this->load->model('model_options');
        $this->load->model('model_propinsi');
		
		//$this->load->library('upload');
        //$this->load->library('pagination');
		$this->load->library('form_validation');
        $this->load->library('session');
		
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
			if($this->session->userdata('level_admin') == 2){
				$this->session->set_userdata(array('admin_id' => '', 'user_admin' => '', 'status_admin' => '', 'level_admin' => ''));
				//$this->session->sess_destroy();
				$this->session->set_flashdata('pesan_login_admin', 'Maaf, Anda tidak diperbolehkan login sebagai Admin atau CS.');
				redirect (site_url('admin'));
			}else{
				$data['judul']  = 'Main';
				$data['main']   = 'admin/main/index';
				$this->load->view('admin/template',$data); 
			}
		}
	}
	
	public function login() 
	{
		$user_admin = $this->input->post('user_admin');
        $pass_admin = $this->input->post('pass_admin');
        
		if ((strlen($user_admin) > 0) AND (strlen($pass_admin) > 0)) {
            if ($user = $this->model_user->get_by_username($user_admin)) {
                if ($user->password_user == md5($pass_admin)) {
                    $this->session->set_userdata(array(
						'admin_id'	=> $user->id_user,
						'user_admin'	=> $user->nama_user,
						'status_admin'	=> ($user->status_user == 1) ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED,
                        'level_admin'	=> $user->level_user));                    
                } else {
					$this->session->set_flashdata('pesan_login_admin', 'Password Salah.');
					redirect (site_url('admin'));
				}
            } else {
				$this->session->set_flashdata('pesan_login_admin', 'Username Salah.');
			}
        }
		redirect (site_url('admin'));
    }
	
	public function logout()
	{
		$this->session->set_userdata(array('admin_id' => '', 'user_admin' => '', 'status_admin' => '', 'level_admin' => ''));
		$this->session->sess_destroy();
        redirect(site_url('admin'));
    }
	
	public function setting()
	{	
        //$this->form_validation->set_rules($this->setting);
		//if($this->form_validation->run()) {
			if($this->input->post('setting')){
				//echo 'setting ditekan';
				$this->model_options->update_setting('nama_website');
				$this->model_options->update_setting('slogan_website');
				$this->model_options->update_setting('deskripsi_website');
				
				
				$this->session->set_flashdata('web_setting', '<div class="n_ok"><p>&nbsp;Pengaturan Website berhasil disimpan.</p></div>');
				redirect('admin/main/setting','refresh');
			}elseif($this->input->post('profile')){
				//echo 'setting ditekan';
				$this->model_options->update_setting('profile_website');
				$this->model_options->update_setting('visi_website');
				$this->model_options->update_setting('misi_website');
				
				
				$this->session->set_flashdata('web_setting', '<div class="n_ok"><p>&nbsp;Profile Website berhasil disimpan.</p></div>');
				redirect('admin/main/setting','refresh');
			}elseif($this->input->post('kontak')){
				//echo 'setting ditekan';
				$this->model_options->update_setting('kontak_website');
				
				
				$this->session->set_flashdata('web_setting', '<div class="n_ok"><p>&nbsp;Kontak Website berhasil disimpan.</p></div>');
				redirect('admin/main/setting','refresh');
			}
			//echo 'tes masuk';	
		//}
		
		
		$data['nama_website'] = $this->model_options->get_setting('nama_website');
		$data['slogan_website'] = $this->model_options->get_setting('slogan_website');
		$data['logo_website'] = $this->model_options->get_setting('logo_website');
		$data['deskripsi_website'] = $this->model_options->get_setting('deskripsi_website');	
		$data['profile_website'] = $this->model_options->get_setting('profile_website');
		$data['visi_website'] = $this->model_options->get_setting('visi_website');
		$data['misi_website'] = $this->model_options->get_setting('misi_website');
		$data['kontak_website'] = $this->model_options->get_setting('kontak_website');	
		
		$data['judul']  = 'Pengaturan Website';
		$data['main']   = 'admin/main/setting';
		$this->load->view('admin/template',$data); 
	}
}
?>