<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}


class Login extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('global_model');
        $this->load->model('login_model');
        $this->load->helper('cookie');
    }

    public function savevideo(){
        $data=$_POST;
        if(isset($data['id'])){
           $id=$data['id'];
           unset($data['id']);
        }else{
            $id=null;
        }
        $this->tbl_video('id'); 
        $news_id = $this->global_model->save($data, $id); 
        $type = 'success';
        $message = 'Video Information Successfully Saved';
        set_message($type, $message);
        if($news_id){
            return 1;
        }else{
            return 0;
        }
    }


    public function index() {
        $data['title'] = 'Admin Login';
        $data['subview'] = $this->load->view('login', $data, true);
        $this->load->view('login', $data);

        $this->login_model->loggedin() == false || redirect('admin/dashboard');

        $rules = $this->login_model->rules;
        $this->form_validation->set_rules($rules);
        if ($this->input->post()) {
            if ($this->form_validation->run() == true) {

                //$status = $this->login_model->checkStatus();

                $login = $this->login_model->login();
                if($login == 'Inactive'){
                    set_cookie('message', 'Your account has been deactivated by admin.Please contact adminstrator', '3600');
                    redirect('admin/login');
                }

                if ($this->login_model->loggedin() == true) {
                    //print_r($_SESSION);die;
                    redirect('admin/dashboard');
                } else {
                    set_cookie('message', 'That Email & password combination does not exist', '3600');
                    //$this->session->set_flashdata('msg', 'That Email & password combination does not exist');
                    redirect('admin/login');
                }
            } else {
                //echo $this->session->userdata('loggedin');
                $this->session->set_flashdata('error', validation_errors());
                redirect('admin/login', 'refresh');
            }
        }
    }

   
    public function forgot() {

        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'email', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                set_message('error', validation_errors());
                redirect('admin/login/forgot');
            } else {
                $where = array('email' => $this->input->post('email'));
                $is_valid = $this->global_model->check_by($where, 'users');

                if (!empty($is_valid)) {
                    $code = rand(111111, 999999);

                    $updateArry = array('forgot_string' => $code, 'forgot_string_expiry' => date('Y-m-d H:i:s', strtotime('+2 days')));

                    $this->global_model->set_action(array('id' => $is_valid->id), $updateArry, 'users');

                     redirect('admin/login/resetpassword/');
                    
                } else {
                    $this->session->set_flashdata('error', 'That Email does not exist');
                    redirect('admin/login/forgot');
                }
            }
        }
        $this->content = array('title' => 'Forgot Password - New Project');
        $this->load->view('forgot', $this->content);
    }


    public function resetpassword($code = null) {

        if ($this->input->post()) {
            // $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('generateotp', 'Verification Code', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('cpassword', 'Confirm Password', 'required');
            if ($this->form_validation->run() == FALSE) {
                set_message('error', validation_errors());
                redirect('admin/login/resetpassword');
            } else {
                
                $where = array('forgot_string' => $this->input->post('generateotp'), 'forgot_string_expiry >=' => date('Y-m-d H:i:s'));
                $is_valid = $this->global_model->check_by($where, 'users');

                if (!empty($is_valid)) {
                    $updateArry = array('password' => $this->hash($this->input->post('password')),'user_password' => $this->input->post('password'));

                    $this->global_model->set_action(array('id' => $is_valid->id), $updateArry, 'users');
                    //  $this->session->set_flashdata('error', $this->lang->line('reset_password_success_message'));

                    set_cookie('message', 'Password successfully reset, you are login now.', '3600');
                    redirect('admin/login');
                } else {
                    $this->session->set_flashdata('error', 'That Email/verification code combination does not exist');
                }
            }
        }

        $data['code'] = $code;
        $data['title'] = 'Reset Password - New Project';
        //$data['subview'] = $this->load->view('resetpassword', $data, true);
        $this->load->view('resetpassword', $data);
    }

   
    public function logout() {
        $this->login_model->logout();
        redirect('admin/login');
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }

}
