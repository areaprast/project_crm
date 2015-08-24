<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller {
    private $login_rules = array (
        array(
            'field'   => 'username', 
            'label'   => 'Username', 
            'rules'   => 'alpha_numeric|required|max_length[15]|min_length[3]'),
        array(
            'field'   => 'password', 
            'label'   => 'Password', 
            'rules'   => 'alpha_numeric|required|max_length[20]|min_length[3]')
    );
    
    private $profile_rules = array (
        array(
            'field'   => 'nama_depan', 
            'label'   => 'Nama', 
            'rules'   => 'text|required'),
        array(
            'field'   => 'nama_belakang', 
            'label'   => 'Nama Belakang', 
            'rules'   => 'text'),
        array(
            'field'   => 'alamat', 
            'label'   => 'Alamat', 
            'rules'   => 'utf8|required|max_length[200]'),
        array(
            'field'   => 'phone', 
            'label'   => 'Telepon', 
            'rules'   => 'numeric|required'),
        array(
            'field'   => 'propinsi', 
            'label'   => 'Propinsi', 
            'rules'   => 'text'),
        array(
            'field'   => 'kode_pos', 
            'label'   => 'Kode Pos', 
            'rules'   => 'numeric')
    );
    
    private $kontak = array (
        array(
            'field'   => 'nama_kontak', 
            'label'   => 'Nama', 
            'rules'   => 'text|required'),
        array(
            'field'   => 'email_kontak', 
            'label'   => 'Email', 
            'rules'   => 'valid_email|required'),
        array(
            'field'   => 'komentar_kontak', 
            'label'   => 'Komentar', 
            'rules'   => 'text|required')
    );
                         
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('model_produk');
        $this->load->model('model_aut');
        $this->load->model('model_user');
        $this->load->model('model_profile');
        $this->load->model('model_order');
        $this->load->model('model_post');
        $this->load->model('model_options');
        $this->load->model('model_propinsi');
        
        $this->load->helper('captcha');
        
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('cart');
                
        $this->data = new stdClass;
        $this->data->form_login = true;
        $this->data->cart = $this->cart->contents();
        $this->data->produk_laris = $this->model_produk->get_daftar_produk(); 
        $this->data->kategori = $this->model_produk->get_kategori();
        $this->data->produk_baru = $this->model_produk->get_daftar_produk();
        $this->data->sponsor = $this->model_options->get_sponsor();
        $this->data->nama_website = $this->model_options->get_setting('nama_website');
        $this->data->slogan_website = $this->model_options->get_setting('slogan_website');
        
    }
    
    public function index() //for_user home_page
    {
        $data['post'] = $this->model_post->get_post('1')->result();
        $data['judul'] = 'Selamat Datang';    
        $data['main']='main';
        
        $this->load->view('template',$data);
    }
    
    public function kategori($id_kategori, $sort_by = 'title', $sort_order = 'asc', $offset = 0) //for_user side_menu kategori_page
    {    
        $perpage = 10;
        $results = $this->model_produk->daftar_kategori($id_kategori, $perpage, $offset, $sort_by, $sort_order);
            
        $data['daftar'] = $results['rows'];    
        $data['num_results'] = $results['num_rows'];
        
        $config = array();
        $config['base_url'] = site_url("kategori/index/$sort_by/$sort_order");
        $config['total_rows'] = $data['num_results'];
        $config['per_page'] = $perpage;
        $config['uri_segment'] = 5;
        //membaca konfigurasi di atas
        $this->pagination->initialize($config);
        
        $data['sort_by'] = $sort_by;
        $data['sort_order'] = $sort_order;
        
        $data['judul']  = 'Kategori';
        $data['main']   = 'user/kategori/daftar_produk';
        $this->load->view('template',$data);
    }
    
    public function semua_kategori() //for_user header_menu kategori_page
    {
        $data['judul']  = 'Daftar Kategori';
        $data['main']   = 'user/kategori/kategori';
        
        $this->load->view('template',$data);
    }
    
    public function keranjang() //for_user side_menu keranjang_belanja
    {
        $query = array ( 
            'id'=>$this->input->post('id_produk'),
            'kode'=>$this->input->post('kode_produk'),
            'name'=>$this->input->post('nama_produk'),
            'qty'=>$this->input->post('jumlah'),
            'price'=>$this->input->post('harga_jual')
                        );
        $this->cart->insert($query);
        redirect (site_url('produk'));
    }
    
    public function hapus_keranjang() //for_user side_menu keranjang_belanja
    {
        $this->cart->destroy();
        redirect (site_url());
    }
    
    public function cek_keranjang() //for_user keranjang_page
    {
        if($_POST) {
            $this->cart->update($_POST);   
        }        
        $data['judul']  = 'Cek Keranjang Belanja';
        $data['main']   = 'user/order/cek_keranjang';
        
        $this->load->view('template',$data);
    }
    
    public function order_now() //for_user order_page
    {        
        $this->form_validation->set_rules($this->profile_rules);
        $this->form_validation->set_message('required', '<font color="red">%s tidak boleh kosong.</font>');
        
        $data_profile = $this->model_profile->get_by(array('id_user'=>$this->session->userdata('user_id')));
    
        if($this->session->userdata('level') == 2){
        
            if($this->form_validation->run()){
                $insert = array(    
                    'nama_depan'    =>     $this->input->post('nama_depan'),
                    'nama_belakang' =>  $this->input->post('nama_belakang'),
                    'alamat'        =>  $this->input->post('alamat'),
                    'kode_pos'      =>  $this->input->post('kode_pos'),
                    'phone'         =>  $this->input->post('phone'),
                    'kota'   	    =>  $this->input->post('kota'),
                    'id_propinsi'   =>  $this->input->post('id_propinsi'));
                                    
                $order = array(
                    'id_user'       =>  $this->session->userdata('user_id'),
                    'biaya_kirim'    => $this->cart->total()*10/100,
                    'total_biaya'   =>  $this->cart->total()*10/100+$this->cart->total(),
                    'total_barang'    =>  $this->input->post('total_barang')
                );

                if(($this->session->userdata('status')) == 1) {
                    if($data_profile){
                        if($this->model_profile->update($data_profile->id_userdata,$insert)){
                            $this->model_order->insert($order,$this->cart->contents());
                            $this->cart->destroy();
                        
                            $this->session->set_flashdata('pesan_order', 'Terima Kasih. Data pesanan telah kami terima.');
                            redirect (site_url('order'));                    
                        }                
                    } else {
                        $insert['id_user'] = $this->session->userdata('user_id');
                        if($this->model_profile->insert($insert)){
                            $this->model_order->insert($order,$this->cart->contents());
                            $this->cart->destroy();
                        
                            $this->session->set_flashdata('pesan_order', 'Terima Kasih. Data pesanan telah kami terima.');
                            redirect(site_url('order'));
                        }
                    }
                } else {
                    $this->session->set_flashdata('pesan_order', '<font color="red">Maaf, status anda belum aktif. Silahkan tunggu maksimal 1x24 jam untuk proses aktifasi akun. Atau re-login akun Anda.</font>');
                    redirect (site_url('home/order_now'));
                }
            }            
            $total_bayar = $this->cart->total(); 
            $DP1 = $total_bayar*25/100;
            $FP = $this->cart->total()*50/100;
                    
            if($data_profile){
                $this->data->nama_depan = $data_profile->nama_depan;
                $this->data->nama_belakang = $data_profile->nama_belakang;
                $this->data->alamat = $data_profile->alamat;
                $this->data->kode_pos = $data_profile->kode_pos;
                $this->data->phone = $data_profile->phone;
                $this->data->id_propinsi = $data_profile->id_propinsi;
                $this->data->kota = $data_profile->kota;
            } else {
                $this->data->nama_depan = set_value('nama_depan');
                $this->data->nama_belakang = set_value('nama_belakang');
                $this->data->alamat = set_value('alamat');
                $this->data->kode_pos = set_value('kode_pos');
                $this->data->phone = set_value('phone');
                $this->data->id_propinsi = set_value('id_propinsi');
                $this->data->kota = set_value('kota');
            }     
        
        } else {
            $this->session->set_flashdata('pesan_level', 'Maaf, anda tidak login sebagai member.');
            // $this->cart->destroy();
            // redirect (site_url('home'));
        }
    
        $data['judul'] = 'Detil Order Anda';
        $data['main']   = 'user/order/order';
        $data['user'] = $this->model_user->get_user_edit($this->session->userdata('user_id'));
        $data['propinsi'] = $this->model_propinsi->get_propinsi();
        
        if (!$this->session->userdata('user_id')){ 
	    $this->data->form_login = false;
	}
	
        
        $this->load->view('template',$data);        
    }
        
    
    public function login() //for_user side_menu login_user
    {
        $this->form_validation->set_rules($this->login_rules);

        if($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            
            if(!$this->model_aut->login($username,$password)) {
                if (($this->session->userdata('level')) == 0) {
                    $this->session->set_flashdata('pesan_user', 'Selamat datang Super Admin.<br>');
                } elseif (($this->session->userdata('level')) == 1) {
                    $this->session->set_flashdata('pesan_user', 'Selamat datang Admin.<br>');
                } elseif (($this->session->userdata('level')) == 2) {        
                    $this->session->set_flashdata('pesan_user', 'Anda telah berhasil login, selamat berbelanja.<br>');
                }
                $this->model_aut->last_visit();
                redirect(site_url('user'));
            }
            redirect(site_url('home'));            
        }
        
        $this->session->set_flashdata('pesan_login', 'Maaf login gagal. Username atau Password salah.');
        redirect(site_url('home'));
    }
    
    public function logout() //for_user side_menu logout_user
    {
        $this->model_aut->logout();
        redirect(site_url('home'));
    }
    
    public function berita() //for_user header_menu berita_page
    {
        $data['post'] = $this->model_post->get_post('')->result();
        $data['judul'] = 'Berita';        
        $data['main'] = 'main';
        
        $this->load->view('template',$data);
    }
    
    public function view_post($id_post) //for_user header_menu berita_page
    {
        $data['post'] = $this->model_post->get_post($id_post)->result();
        $data['judul'] = 'Baca Berita';        
        $data['main'] = 'user/post/view';
        
        $this->load->view('template',$data);
    }
    
    public function profile() //for_user header_menu profile_page
    {
        $data['judul'] = 'Profile';        
        $data['main'] = 'user/post/profile';
        $data['profile_website'] = $this->model_options->get_setting('profile_website');
        
        $this->load->view('template',$data);
    }
    
    /*public function captcha()
    {
        header('Content-Type: image/jpeg');
        //fungsi untuk membuat gambar
        $image=imagecreate(60, 30);
        //menentukan warna background
        imagefill($image, 0, 0, imagecolorallocate($image, 255, 255, 255)); //hitam
        //menentukan warna text
        $warnatext=imagecolorallocate($image, 0, 0, 0); //putih
        //mengenerate angka
        $angka1=rand(0, 9);
        $angka2=rand(0, 9);
        $angka3=rand(0, 9);
        $angka4=rand(0, 9);
        $code=$angka1.$angka2.$angka3.$angka4;
        //menyimpan kode dalam session
        $this->session->set_userdata('captcha', $code);         
        //menulis kode pada gambar
        imagestring($image, 5, 18, 12, $code, $warnatext);
        //output gambar
        imagejpeg($image, "", 90);
        //membebaskan memori
        imagedestroy($image);
    }*/
    
    public function kontak() //for_user header_menu kontak_page
    {
        $this->form_validation->set_rules($this->kontak);
        $this->form_validation->set_message('required', '<font color="red">%s tidak boleh kosong.</font>');
        $this->form_validation->set_message('valid_email', '<font color="red">Alamat %s harus lengkap.</font>');    
        
        if($this->form_validation->run()){
            $nama_kontak = $this->input->post('nama_kontak');
            $email_kontak = $this->input->post('email_kontak');
            $komentar_kontak = $this->input->post('komentar_kontak');
            $captcha = $this->session->userdata('captcha');
            $kode = $this->input->post('kode');
            
            if ($kode == $captcha) {            
                $insert = array(    
                    'nama_kontak' =>     $nama_kontak,
                    'email_kontak' =>  $email_kontak,
                    'komentar_kontak' =>  $komentar_kontak
                );
                $this->model_post->insert_kontak($insert);
                $this->session->set_flashdata('pesan_kontak', '<font color="green">Komentar berhasil dikirim. Terima Kasih atas Kritik dan Saran yang Anda berikan.</font>');
                redirect('home/kontak','refresh');                
                
            } else {
                $this->session->set_flashdata('pesan_kontak', '<font color="red">Maaf Kode yang Anda masukkan salah.</font>');
                redirect('home/kontak','refresh');                
            }
        }        
        
        $vals = array(
            'img_path'    => './captcha/',
            'img_url'    => base_url().'captcha/',
            'img_width'    => 100,
            'img_height' => 30,
            'border'    => 0,
            'expiration' => 7200
        );
        
        $cap = create_captcha($vals);
        $data['image'] = $cap['image'];
        
        $this->session->set_userdata('captcha', $cap['word']);         
        
        $data['kontak_website'] = $this->model_options->get_setting('kontak_website');    
        
        $data['judul'] = 'Kontak Kami';        
        $data['main'] = 'user/post/kontak_kami';
        
        $this->load->view('template',$data);        
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */