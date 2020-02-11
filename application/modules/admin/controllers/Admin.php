<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        is_valid('admin');
        $this->load->model('global_model');
        /*if (!$this->session->userdata('loginId')) {
            redirect('admin/login');
        }*/
    }


    public function index() {
        redirect('admin/login');
    }

   

    public function dashboard() {
        if (!$this->session->userdata('loginId')) {
            redirect('admin/login');
        }

        $data['title'] = 'Dashboard';
        $where = array('user_type' => 'User');
        $this->tbl_users('id', 'desc'); 
       
        $data['all_users'] = $this->global_model->get_by($where);
         $this->tbl_course('id', 'desc'); 
        $where = array();
        $data['all_course'] = $this->global_model->get_by($where); 
        $where = array();
        $this->tbl_membership('id', 'desc'); 
        $data['all_membership'] = $this->global_model->get_by($where);
        $data['subview'] = $this->load->view('admin/dashboard', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }



    public function edit_profile($id = null) {
        $id = $this->session->userdata('loginId');
        if (!empty($id)) {

            $where = array('id' => $id);
            $data['profile_info'] = $this->global_model->check_by($where, 'users');

            if (empty($data['profile_info'])) {

                $this->message->norecord_found('admin/dashboard');
            }
        }
        $data['title'] = 'Edit Profile';
        $data['subview'] = $this->load->view('admin/edit_profile', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

  
    public function save_profile($id) {
        $id = $this->session->userdata('loginId');
        $this->tbl_users('id'); // table User
        $data['userName'] = $this->input->post('name', true);
        $data['address'] = $this->input->post('address', true);
        $data['mobile'] = $this->input->post('contact_number', true);
        $data['email'] = $this->input->post('email', true);
        $data['user_type'] = 'Admin';
// update employee

        if (!$id) {
            $data['filename'] = '';
            $data['image_path'] = '';
        }
        // save image Process
        if (!empty($_FILES['admin_images']['name'])) {
            $old_path = $this->input->post('old_path');
            if ($old_path) { // if old path is no empty
                unlink($old_path);
            } // upload file
            $val = $this->global_model->uploadAllfiles('admin_images', 'assets/uploads/employee/');
            $val == true || redirect('admin/edit_profile/');
            $data['image'] = $val['path'];
            //$data['image_path'] = $val['fullPath'];
        }
        // update profile
        $where = array(
            'email' => $data['email']
        );
        // duplicate check
        if (!empty($id)) {
            $admin_id = array('id !=' => $id);
        } else {
            $admin_id = null;
        }
       // print_r($admin_id);
        //die;
       // $check_user = $this->global_model->check_update('users', $where, $admin_id);
        $check_user=false;
        if (!empty($check_user)) { // if exist
            $type = 'error';
            $message = 'Admin Email Id Already Exist';
        } else { // save and update query
            $admin_id = $this->global_model->save($data, $id); //save and update
            $this->tbl_users('id');
            $admin = $this->global_model->get($admin_id, TRUE);
            if (!empty($admin)) {
                $data = array('loginId' => $admin->id,
                    'user_type' => $admin->user_type,
                    'firstName' => $admin->name,
                    'mobile' => $admin->contact_number,
                    'email' => $admin->email,
                    'image' => $admin->filename,
                    'loggedin' => true);
                $this->session->set_userdata($data);
            }
            $type = 'success';
            $message = 'Admin Information Successfully Saved';
        }
        //redirect profile to view page
        set_message($type, $message);
        redirect('admin/edit_profile/');
    }

   

  
    public function change_password($id = null) {
        $id = $this->session->userdata('loginId');
        $this->tbl_users('id'); // table admin
        $old_password = $this->hash($this->input->post('old_password'));
        $where = array('password' => $old_password, 'id' => $id);
        $user_info = $this->global_model->check_by($where, 'users');

        if (!empty($user_info)) {
            $data['user_type'] = 'Admin';
            $data['password'] = $this->hash($this->input->post('new_password'));
           // $data['user_password'] = $this->input->post('new_password');
            $user_id = $this->global_model->save($data, $user_info->id); //save and update
            $type = 'success';
            $message = 'Password Successfully Change';
            //redirect users to view page
            set_message($type, $message);
            redirect('admin/edit_profile/');
        } else {
            $type = 'error';
            $message = 'Password Does Not Match';
            set_message($type, $message);
            redirect('admin/edit_profile/');
        }
        // save and update query
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }

}
