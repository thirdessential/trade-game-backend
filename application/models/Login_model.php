<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login_Model extends MY_Model {

    protected $_table_name;
    protected $_order_by;
    public $rules = array(
        'email' => array(
            'field' => 'email',
            'label' => 'Email',
           
        ),
        'password' => array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required',
        )
    );
    
      public function login() {
        $this->_table_name = 'users';
        $this->_order_by = 'id';


        if ($this->input->post('email') != '') {

            if($this->input->post('user_type') == 'Admin'){
                $user = $this->get_by(array(
                'email' => $this->input->post('email'),
                'user_type' => $this->input->post('user_type'),
                'password' => $this->hash($this->input->post('password')),
                'status' => 'Active',
                    ), true);

            }else{

                $user = $this->get_by(array(
                'userId' => $this->input->post('email'),
                'user_type' => $this->input->post('user_type'),
                'password' => $this->hash($this->input->post('password')),
                'status' => 'Active',
                    ), true);


            }
            
        }  

        if (count($user)) {
          $data = array('loginId' => $user->id,
                'name' => $user->name,
                'userId' => $user->id,
                'parent_userId' => 1,
                'user_type' => $user->user_type,
                'contact_number' => $user->mobile,
                'email' => $user->email,
                'filename' => $user->image,
                
                // 'site_lang' => (!empty($lang)) ? ($lang->language_abr) : ('en'),
                'loggedin' => true);

            $this->session->set_userdata($data);
        }
    }


    public function logout() {
        $this->session->sess_destroy();
        set_cookie('remember', FALSE, $expire);
        @session_destroy();
    }

    public function loggedin() {
        return (bool) $this->session->userdata('loggedin');
    }
    
    public function users_loggedin() {
        return (bool) $this->session->userdata('user_loggedin');
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }
    
    

}