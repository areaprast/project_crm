<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

define('STATUS_ACTIVATED', '1');
define('STATUS_NOT_ACTIVATED', '0');
define('ALLOW', '1');
define('NOT_ALLOW', '0');

Class Autentifikasi {
    private $ci;
    private $error =  array();
    
    public function __construct() {
        $this->ci = & get_instance();
        $this->ci->load->model('model_user');
    }
    
    public function login($username,$password) {
        if ((strlen($username) > 0) AND (strlen($password) > 0)) {
            if ($user = $this->ci->model_user->get_by_username($username)) {
                if ($user->password_user == md5($password)) {
                    $this->ci->session->set_userdata(array(
								'user_id'	=> $user->id_user,
								'username'	=> $user->nama_user,
								'status'	=> ($user->status_user == 1) ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED,
                                'level'	=> $user->level_user,                                
					));
                    
                    if($user->status_user == 0){
                        $this->error = (array('status'=>'Status belum aktif'));
                    } else {
                        return true;
                    }
                    
                }
                //$this->ci->session->set_flashdata('pesan', 'Password Keliru');
                $this->ci->error = array('password'=>'Password Keliru');
            }
            $this->error = array('login'=>'Login Tidak Benar');
        }
        return FALSE;
    }
    
    public function logout() {
        $this->ci->session->set_userdata(array('user_id' => '', 'username' => '', 'status' => '', 'level' => ''));
		$this->ci->session->sess_destroy();
    }
    
    public function tambah($username,$email,$password,$level) {
        $data = array( 'username'=>$username,
                        'email'=>$email,
                        'password'=>md5($password),
                        'level'=>$level
                        );
        if($this->ci->model_user->cek_username($username)){
            if($this->ci->model_user->insert($data)){
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