<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('global_model');
        $this->load->model('login_model');
        $this->load->helper('cookie');
    }


    public function index() {
        $data['title'] = 'User Login';
        $data['subview'] = $this->load->view('login', $data, true);
        $this->load->view('login', $data);

        $this->login_model->loggedin() == false || redirect('user/dashboard');

        $rules = $this->login_model->rules;
        $this->form_validation->set_rules($rules);
        if ($this->input->post()) {
            if ($this->form_validation->run() == true) {

                //$status = $this->login_model->checkStatus();

                $login = $this->login_model->login();
                if($login == 'Inactive'){
                    set_cookie('message', 'Your account has been deactivated by user.Please contact userstrator', '3600');
                    redirect('user/login');
                }

                if ($this->login_model->loggedin() == true) {
                    //print_r($_SESSION);die;
                    redirect('user/dashboard');
                } else {
                    set_cookie('message', 'That Email & password combination does not exist', '3600');
                    //$this->session->set_flashdata('msg', 'That Email & password combination does not exist');
                    redirect('user/login');
                }
            } else {
                //echo $this->session->userdata('loggedin');
                $this->session->set_flashdata('error', validation_errors());
                redirect('user/login', 'refresh');
            }
        }
    }


    public function thanku($userId = null, $password = null){
        $data['userId'] = $userId;
        $data['password'] = $password;
        $data['title'] = 'Thank  You';
        $this->load->view('thanku', $data);
    }


    public function registration(){
         if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'email', 'trim|required');
            $this->form_validation->set_rules('sponsored_id', 'Sponsored Id', 'trim|required');
            $this->form_validation->set_rules('contact_number', 'contact_number', 'required');
            $this->form_validation->set_rules('full_name', 'full_name', 'required');
            $this->form_validation->set_rules('password', 'password', 'required');
            if ($this->form_validation->run() == FALSE) {
                set_message('error', validation_errors());
                redirect('user/login');
            } else {
              $email =  $this->input->post('email', true);
              $full_name =  $this->input->post('full_name', true);
              $sponsored_id =  $this->input->post('sponsored_id', true);
              $contact_number =  $this->input->post('contact_number', true);
              $password =  $this->input->post('password', true);
              $tez_number =  $this->input->post('tez_number', true);
              $payphone =  $this->input->post('payphone', true);
              $parent_id = '';
              if(!empty($sponsored_id)){
                 $where = array('userId' => $sponsored_id);
        
                $is_exist = $this->global_model->check_by($where, 'users', TRUE);

                $parent_id = $is_exist->id;
              }

              $userId = $this->generate_new_key();

              $dataArray = array(
                'parent_id'  => $parent_id,
                'userId'  => $userId,
                'parent_userId'  => $sponsored_id,
                'name'  => $full_name,
                'contact_number'  => $contact_number,
                'password'  => $this->hash($password),
                'user_password'  => $password,
                'tej_no'  => $tez_number,
                'payphone'  => $payphone,
                'email'  => $email,
                'status'  => 'Active',
                'user_type'  => 'User',
              );
        

            $this->tbl_users('id'); 
            $user_id = $this->global_model->save($dataArray); 
            $type = 'success';
            $message = 'User Insert successfully Successfully';
            $this->load->library('email');

$this->email->from('gfl500000@gmail.com', 'GoldenFutureLife');
$this->email->to($email);
//$this->email->cc('rp.linuxbn@gmail.com');
//$this->email->bcc('');

$this->email->subject('Welcome in GoldenFutureLife ');
$msg='Hii.., Thank You to Register with  GoldenFutureLife  your Name :- '.$full_name.' id is :- '.$userId.' Password:- '.$password;
$this->email->message($msg);
$this->email->send();
$apiKey = urlencode('Jmbc29O0dHY-VOLlUiu8wJHvxqX5aw039MmXKi9owO');
	
	// Message details
	$numbers = array($contact_number);
	$sender = urlencode('TXTLCL'); 
	$message = rawurlencode($msg);
        $numbers = implode(',', $numbers);
       // Prepare data for POST request
	$datas = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
 
	// Send the POST request with cURL
	$ch = curl_init('https://api.textlocal.in/send/');
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($ch);
	curl_close($ch);
	
	// Process your response here
	echo $response;

            set_message($type, $message);
            redirect('user/login/thanku/'.$userId.'/'.$password.'/'.$full_name);
            }

         }

        $data['title'] = 'Ragistration';
        $this->load->view('login', $data);

    }

    public function generate_new_key() {
        $userId = rand(11111111, 99999999);
        $where = array('userId' => $userId);

        $is_exist = $this->global_model->check_by($where, 'users', TRUE);
        if ($is_exist) {
            $this->generate_new_key();
        } else {
            return $userId;
        }
    }


    public function forgot() {

        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'email', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                set_message('error', validation_errors());
                redirect('user/login/forgot');
            } else {
                $where = array('email' => $this->input->post('email'));
                $is_valid = $this->global_model->check_by($where, 'users');

                if (!empty($is_valid)) {
                    $code = rand(11111111, 99999999);

                    $updateArry = array('forgot_string' => $code, 'forgot_string_expiry' => date('Y-m-d H:i:s', strtotime('+2 days')));

                    $this->global_model->set_action(array('id' => $is_valid->id), $updateArry, 'users');

                     redirect('user/login/resetpassword/');
                    
                } else {
                    $this->session->set_flashdata('error', 'That Email does not exist');
                    redirect('user/login/forgot');
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
                redirect('user/login/resetpassword');
            } else {
                
                $where = array('forgot_string' => $this->input->post('generateotp'), 'forgot_string_expiry >=' => date('Y-m-d H:i:s'));
                $is_valid = $this->global_model->check_by($where, 'users');

                if (!empty($is_valid)) {
                    $updateArry = array('password' => $this->hash($this->input->post('password')),'user_password' => $this->input->post('password'));

                    $this->global_model->set_action(array('id' => $is_valid->id), $updateArry, 'users');
                    //  $this->session->set_flashdata('error', $this->lang->line('reset_password_success_message'));

                    set_cookie('message', 'Password successfully reset, you are login now.', '3600');
                    redirect('user/login');
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
        redirect('user/login');
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }

}
