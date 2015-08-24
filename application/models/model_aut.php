<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('STATUS_ACTIVATED', '1');
define('STATUS_NOT_ACTIVATED', '0');
define('ALLOW', '1');
define('NOT_ALLOW', '0');

Class Model_aut extends CI_Model {
    private $ci;
    public $error =  array();
    
    public function __construct() {
        $this->ci = & get_instance();
        //$this->ci->load->model('model_user');
        $this->load->model('model_user');
    }
    
    public function login($username,$password) {
        if ((strlen($username) > 0) AND (strlen($password) > 0)) {
            if ($user = $this->model_user->get_by_username($username)) {
                if ($user->password_user == md5($password)) {
                    $this->session->set_userdata(array(
						'user_id'	=> $user->id_user,
						'username'	=> $user->nama_user,
						'status'	=> ($user->status_user == 1) ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED,
                        'level'	=> $user->level_user));                    
                } else {
					$this->session->set_flashdata('pesan_login', 'Password Salah.');
					redirect (site_url(''));
				}
            } else {
				$this->session->set_flashdata('pesan_login', 'Username Salah.');
			}
        }
        return FALSE;
    }
		
	function last_visit() 
	{
		//membaca data
		$id_user = $this->session->userdata('user_id');
		$data = array('last_visit' => date("Y-m-d H:i:s")); 
		//mencocokkan data
		$this->db->where('id_user',$id_user);
		//mengupdate data tabel
		$this->db->update('tb_user', $data);  
		
	}
    
    public function logout() {
        $this->session->set_userdata(array('user_id' => '', 'username' => '', 'status' => '', 'level' => ''));
		$this->session->sess_destroy();
    }
    
    public function tambah($username_daftar,$email_daftar,$password_daftar,$level,$image) {
        $data = array( 
			'nama_user'=>$username_daftar,
            'email_user'=>$email_daftar,
            'password_user'=>md5($password_daftar),
            'level_user'=>$level,
            'image_user'=>$image
        );
		
        if($this->model_user->cek_username($username_daftar)){
            if($this->model_user->insert($data)){
                return true;
            }
        }
        return false;
    }
    
    public function ubah($id,$username,$email,$password,$level){
        $data = array( 'username'=>$username,
                        'email'=>$email,
                        'password'=>md5($password),
                        'level'=>$level,
                        );
        if($this->ci->model_user->cek_username($username,TRUE) == $id){
            if($this->ci->model_user->update($id,$data)){
                return true;
            }
        }
        return false;
    }
    
    public function sudah_login($activated = TRUE) {
        return $this->ci->session->userdata('status') === ($activated ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED);
    }
    
    public function role($level = array()) {
        foreach ($level as $key=>$val){
            $status = $this->ci->session->userdata('level') == $val ? ALLOW : NOT_ALLOW;
            if ($status == 1){break;}
        }
        return $status;
    }
    
    
}

?>