<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        is_valid('admin');
        if(!$this->session->userdata('loginId')){
             redirect('admin/login');
        }
        $this->load->model('global_model');
    }


    public function manage_users($user_type = null,$uid = null ) {
        $data['title'] = 'Manage Users';
        if(!empty($uid)){
            $where = array('user_type' => 'User', 'parent_id' => $uid);
            $whereUser = array('user_type' => 'User', 'id' => $uid);
            $this->tbl_users('id', 'desc'); 
            $data['users_info'] = $this->global_model->get_by($whereUser, true); 
              $user_name = $data['users_info']->name;
              $data['title'] = 'Manage Users ('.$user_name.')';
         }else if($user_type == 'Activated'){
             $where = array('user_type' => 'User');
         }else{
            $where = array('user_type' => 'User');
         }
        $this->tbl_users('id', 'desc'); 
       
        $data['all_users'] = $this->global_model->get_by($where); 

        //*********title , subview and main model ***************//
        
        $data['subview'] = $this->load->view('admin/users/manage_users', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

     public function manage_expert($user_type = null,$uid = null ) {
        $data['title'] = 'Manage Expert';
        if(!empty($uid)){
            $where = array('user_type' => 'Expert');
            $whereUser = array('user_type' => 'Expert', 'id' => $uid);
            $this->tbl_users('id', 'desc'); 
            $data['users_info'] = $this->global_model->get_by($whereUser, true); 
              $user_name = $data['users_info']->name;
              $data['title'] = 'Manage Users ('.$user_name.')';
         }else if($user_type == 'Activated'){
             $where = array('user_type' => 'Expert');
         }else{
            $where = array('user_type' => 'Expert');
         }
        $this->tbl_users('id', 'desc'); 
       // print_r($where);
        $data['all_users'] = $this->global_model->get_by($where); 

        //*********title , subview and main model ***************//
        
        $data['subview'] = $this->load->view('admin/users/manage_expert', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

     public function manage_corporat($user_type = null,$uid = null ) {
        $data['title'] = 'Manage Corporate';
        if(!empty($uid)){
            $where = array('user_type' => 'Corporate', 'parent_id' => $uid);
            $whereUser = array('user_type' => 'Corporate', 'id' => $uid);
            $this->tbl_users('id', 'desc'); 
            $data['users_info'] = $this->global_model->get_by($whereUser, true); 
              $user_name = $data['users_info']->name;
              $data['title'] = 'Manage Users ('.$user_name.')';
         }else if($user_type == 'Activated'){
             $where = array('user_type' => 'Corporate');
         }else{
            $where = array('user_type' => 'Corporate');
         }
        $this->tbl_users('id', 'desc'); 
       
        $data['all_users'] = $this->global_model->get_by($where); 

        //*********title , subview and main model ***************//
        
        $data['subview'] = $this->load->view('admin/users/manage_corporat', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }


    public function edit_users($id = null) {

        $data['title'] = 'Add Users'; 
       if (!empty($id)) { 
            $data['title'] = 'Edit Users'; 
            $where = array('id' => $id);
            $this->tbl_users('id', 'desc'); 
            $data['user_info'] = $this->global_model->check_by($where, 'users');
            if (empty($data['user_info'])) { 
                
                $this->message->norecord_found('admin/users/manage_users/Activated');
            }
        }
        $data['subview'] = $this->load->view('admin/users/edit_users', $data, true); 
        $this->load->view('admin/_layout_main', $data); // main page
    }

    public function edit_expert($id = null) {

        $data['title'] = 'Add Expert'; 
       if (!empty($id)) { 
            $data['title'] = 'Edit Expert'; 
            $where = array('id' => $id);
            $this->tbl_users('id', 'desc'); 
            $data['user_info'] = $this->global_model->check_by($where, 'users');
            if (empty($data['user_info'])) { 
                
                $this->message->norecord_found('admin/users/manage_expert/Activated');
            }
        }
        $data['subview'] = $this->load->view('admin/users/edit_expert', $data, true); 
        $this->load->view('admin/_layout_main', $data); // main page
    }

    public function edit_corporat($id = null) {

        $data['title'] = 'Add Corporate'; 
       if (!empty($id)) { 
            $data['title'] = 'Edit Corporate'; 
            $where = array('id' => $id);
            $this->tbl_users('id', 'desc'); 
            $data['user_info'] = $this->global_model->check_by($where, 'users');
            if (empty($data['user_info'])) { 
                
                $this->message->norecord_found('admin/users/manage_users/Activated');
            }
        }
        $data['subview'] = $this->load->view('admin/users/edit_corporate', $data, true); 
        $this->load->view('admin/_layout_main', $data); // main page
    }


    // public function save_users($id = null) {
    //    // print_r($this->input->post()); die;
       
    //     $data['name'] = $this->input->post('name', true);
    //     $data['contact_number'] = $this->input->post('contact_number', true);
    //     $data['email'] = $this->input->post('email', true);
    //     $data['user_type'] = 'User';
    //     if(empty($id)){
    //         $data['password'] = $this->hash($this->input->post('password'));
    //         $data['user_password'] = $this->input->post('password');
    //         $data['userId'] = $this->input->post('userId', true);

    //     }
    //     if (!$id) {
    //         $data['filename'] = '';

    //         }
        
    //     if (!empty($_FILES['profile_picture']['name'])) {
    //         $old_path = $this->input->post('profile_picture');
    //         if ($old_path) { // if old path is no empty
    //             unlink(FCPATH . $old_path);
    //         } // upload file
    //         $val = $this->global_model->uploadImage('profile_picture', 'assets/uploads/users/');
    //         $val == true || redirect('admin/users/manage_users/Activated');

    //         $data['filename'] = $val['path'];
    //        }
       
    //         $this->tbl_users('id'); 
    //         $users_id = $this->global_model->save($data, $id); 
    //         $type = 'success';
    //         $message = 'users Information Successfully Saved';
      
    //     set_message($type, $message);
    //     redirect('admin/users/manage_users/Activated');
    // }


    public function save_users($id = null) {
       // print_r($this->input->post()); die;
       
        $data['firstName'] = $this->input->post('name', true);
        $data['mobile'] = $this->input->post('contact_number', true);
        $data['email'] = $this->input->post('email', true);
        $data['user_type'] = 'User';
        $this->tbl_users('id', 'desc');
        $where_email = array( 'email'=> $_POST['email'] );
        $where_mobile = array( 'mobile'=> $_POST['mobile'] );
        // $where = array('email'=>$_POST['email'],'mobile'=>$_POST['mobile']);
        $userdetails_email = $this->global_model->get_by( $where_email ); 
        $userdetails_mobile = $this->global_model->get_by( $where_mobile ); 

        if( !empty( $userdetails_email ) ){
           
            $type = 'error';
            $message = 'Email Id already use.';
            set_message($type, $message);
            set_message($type, $message);
            redirect('admin/users/edit_users');
        }else if( !empty( $userdetails_mobile ) ){
           
            $type = 'error';
            $message = 'Mobile Number already use.';
            set_message($type, $message);
            set_message($type, $message);
            redirect('admin/users/edit_users');
        }  

        if(empty($id)){
            $data['password'] = $this->hash($this->input->post('password'));
          
        }
        if (!$id) {
            $data['image'] = '';

            }
        
        if (!empty($_FILES['profile_picture']['name'])) {
            $old_path = $this->input->post('profile_picture');
            if ($old_path) { // if old path is no empty
                unlink(FCPATH . $old_path);
            } // upload file
            $val = $this->global_model->uploadImage('profile_picture', 'assets/uploads/users/');
            $val == true || redirect('admin/users/manage_users/Activated');

            $data['image'] = $val['path'];
           }
       
            $this->tbl_users('id'); 
            $users_id = $this->global_model->save($data, $id); 
            $type = 'success';
            $message = 'users Information Successfully Saved';
      
        set_message($type, $message);
        redirect('admin/users/manage_users/Activated');
    }


    public function save_expert($id = null) {
       // print_r($this->input->post()); die;
       
         $data['firstName'] = $this->input->post('name', true);
        $data['mobile'] = $this->input->post('contact_number', true);
        $data['email'] = $this->input->post('email', true);
        $data['user_type'] = 'Expert';
        if(empty($id)){
            $data['password'] = $this->hash($this->input->post('password'));
           // $data['user_password'] = $this->input->post('password');
           // $data['userId'] = $this->input->post('userId', true);

        }
        if (!$id) {
            $data['image'] = '';

            }
        
        if (!empty($_FILES['profile_picture']['name'])) {
            $old_path = $this->input->post('profile_picture');
            if ($old_path) { // if old path is no empty
                unlink(FCPATH . $old_path);
            } // upload file
            $val = $this->global_model->uploadImage('profile_picture', 'assets/uploads/users/');
            $val == true || redirect('admin/users/manage_expert/Activated');

            $data['image'] = $val['path'];
           }
       
            $this->tbl_users('id'); 
            $users_id = $this->global_model->save($data, $id); 
            $type = 'success';
            $message = 'Expert Information Successfully Saved';
      
        set_message($type, $message);
        redirect('admin/users/manage_expert/Activated');
    }

    public function save_corporate($id = null) {
       // print_r($this->input->post()); die;
       
        $data['firstName'] = $this->input->post('name', true);
        $data['mobile'] = $this->input->post('contact_number', true);
        $data['email'] = $this->input->post('email', true);
        $data['user_type'] = 'Corporate';
        if(empty($id)){
            $data['password'] = $this->hash($this->input->post('password'));
           // $data['user_password'] = $this->input->post('password');
           // $data['userId'] = $this->input->post('userId', true);

        }
        if (!$id) {
            $data['image'] = '';

            }
        
        if (!empty($_FILES['profile_picture']['name'])) {
            $old_path = $this->input->post('profile_picture');
            if ($old_path) { // if old path is no empty
                unlink(FCPATH . $old_path);
            } // upload file
            $val = $this->global_model->uploadImage('profile_picture', 'assets/uploads/users/');
            $val == true || redirect('admin/users/manage_corporat/Activated');

            $data['image'] = $val['path'];
           }
       
            $this->tbl_users('id'); 
            $users_id = $this->global_model->save($data, $id); 
            $type = 'success';
            $message = 'Corporate Information Successfully Saved';
      
        set_message($type, $message);
        redirect('admin/users/manage_corporat/Activated');
    }

    public function delete_users($id) {
        $this->tbl_users('id'); // table Parentds
        $this->global_model->delete($id);
        $type = 'success';
        $message = 'users Information Successfully Delete ';
        //redirect users to view page
        set_message($type, $message);
        redirect('admin/users/manage_users/Activated');
    }

  

    public function delete_expert($id) {
        $this->tbl_users('id'); // table Parentds
        $this->global_model->delete($id);
        $type = 'success';
        $message = 'Expert Information Successfully Delete ';
        //redirect users to view page
        set_message($type, $message);
        redirect('admin/users/manage_expert/Activated');
    }

    public function delete_corporate($id) {
        $this->tbl_users('id'); // table Parentds
        $this->global_model->delete($id);
        $type = 'success';
        $message = 'Corporate Information Successfully Delete ';
        //redirect users to view page
        set_message($type, $message);
        redirect('admin/users/manage_corporat/Activated');
    }

    public function changepassword($id) {
        $this->tbl_users('id'); // table user
        $data['password'] = $this->hash($this->input->post('password'));
        //$data['user_password'] = $this->input->post('password');

        $user_id = $this->global_model->save($data, $id); //save and update
        // success massage for user
        $type = 'success';
        $message = 'Password Successfully Change';

        //redirect users to view page
        set_message($type, $message);
        redirect('admin/users/edit_users/' . $id);
    }

      public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }
  
   
}
