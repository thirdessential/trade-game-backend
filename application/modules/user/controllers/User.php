<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class User extends admin_Controller {

    public function __construct() {
        parent::__construct();
        is_valid('user');
        $this->load->model('global_model');
        /*if (!$this->session->userdata('loginId')) {
            redirect('user/login');
        }*/
    }

    public function index() {
        redirect('user/login');
    }

    public function userLevelManage(){

        $this->tbl_activated_user('id', 'asc');
        $w_activateUser = array('deleted_at' => Null); 
        $s_activateUser = array('id','user_id', 'parent_id');
        $activateUser = $this->global_model->get_by($w_activateUser, false, Null, Null, $s_activateUser);

        if(!empty($activateUser)){
            foreach ($activateUser as $value) {

                $this->tbl_users('id'); 
                $w_user = array('id' => $value->user_id);
                $s_user = array('id','user_level', 'userId','parent_id');
                $user_info = $this->global_model->get_by($w_user, true, Null, Null, $s_user);
                
                if(!empty($user_info)){

                    if($user_info->user_level == 0){
                        // total user above particual user id
                        $total_user = $this->totalUser($value->id);
                        
                        if($total_user >= 100){
                            // total direct user to self user
                            $total_direct = $this->totalDirect($value->id ,$value->user_id);

                            if($total_direct > 0){

                                $check = $this->levelUpdateForUser($user_info->id, '1');

                                $total_amount = 150;
                                $direct_user = 1;
                                $level = 1;

                                $payemt_id = $this->orderPayments($user_info->id, $user_info->parent_id, $total_amount, $level, $direct_user);
                                
                            }

                        }

                    }
                    else if($user_info->user_level == 1){
                        // total user above particual user id
                        $total_user = $this->totalUser($value->id);
                        
                        if($total_user >= 300){
                            // total direct user to self user
                            $total_direct = $this->totalDirect($value->id, $value->user_id);

                            if($total_direct >= 2){

                                $check = $this->levelUpdateForUser($user_info->id, '2');

                                $total_amount = 750;
                                $direct_user = 2;
                                $re_entry = 1;
                                $level = 2;

                                $payemt_id = $this->orderPayments($user_info->id, $user_info->parent_id, $total_amount, $level, $direct_user, $re_entry);

                                $re_entry_id = $this->userReEntry($user_info->id, $user_info->parent_id, $level, $re_entry);
                                
                            }

                        }

                    }
                    else if($user_info->user_level == 2){
                        // total user above particual user id
                        $total_user = $this->totalUser($value->id);
                        
                        if($total_user >= 800){
                            // total direct user to self user
                            $total_direct = $this->totalDirect($value->id, $value->user_id);
                            $total_reEntry = $this->totalReEntry($value->user_id);

                            if($total_direct >= 3 && $total_reEntry >= 1){

                                $check = $this->levelUpdateForUser($user_info->id, '3');

                                $total_amount = 1500;
                                $direct_user = 3;
                                $re_entry = 1;
                                $level = 3;

                                $payemt_id = $this->orderPayments($user_info->id, $user_info->parent_id, $total_amount, $level, $direct_user, $re_entry);

                                $re_entry_id = $this->userReEntry($user_info->id, $user_info->parent_id, $level, $re_entry);
                                
                            }

                        }

                    }
                    else if($user_info->user_level == 3){
                        // total user above particual user id
                        $total_user = $this->totalUser($value->id);
                        
                        if($total_user >= 1800){
                            // total direct user to self user
                            $total_direct = $this->totalDirect($value->id, $value->user_id);
                            $total_reEntry = $this->totalReEntry($value->user_id);

                            if($total_direct >= 5 && $total_reEntry >= 2){

                                $check = $this->levelUpdateForUser($user_info->id, '4');

                                $total_amount = 3000;
                                $direct_user = 5;
                                $re_entry = 2;
                                $level = 4;

                                $payemt_id = $this->orderPayments($user_info->id, $user_info->parent_id, $total_amount, $level, $direct_user, $re_entry);

                                $re_entry_id = $this->userReEntry($user_info->id, $user_info->parent_id, $level, $re_entry);
                                
                            }

                        }

                    }
                   // die;
                }
       
            }
        }

    }

    public function orderPayments($user_id, $parent_id, $total_amount, $level, $direct_user, $re_entry = NULL, $sponsored_amount = NULL){

        $reEntry = 0;
        $re_entry_amount = 0.00;
        if(!empty($re_entry)){
            $reEntry = $re_entry;
            $re_entry_amount = $re_entry * 600;
        }

        $admin_commission = ($total_amount * 15 ) / 100;
        $tds = ($total_amount * 5 ) / 100;
        $remaining_amt = $total_amount - $admin_commission - $tds;

        $remaining_amount = $remaining_amt - $re_entry_amount;

        $dataPayment = array(
            'user_id'   => $user_id,
            'parent_id' => $parent_id,
            'total_amount' => $total_amount,
            'direct_user' => $direct_user,
            're_entry' => $reEntry,
            're_entry_amount' => $re_entry_amount,
            'admin_commission' => $admin_commission,
            'tds' => $tds,
            'remaining_amount' => $remaining_amount,
            'sponsored_amount' => $sponsored_amount,
            'level' => $level,
            'payment_status' => 'Pending',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
                );

        $this->tbl_order_payment('id'); 
        $payment_id = $this->global_model->save($dataPayment);

        return $payment_id;

    }

    public function userReEntry($user_id, $parent_id, $level, $re_entry){
        
        $re_entry_amount = $re_entry * 600;
        
        $dataArray = array(
            'user_id'   => $user_id,
            'parent_id' => $parent_id,
            're_entry' => $re_entry,
            're_entry_amount' => $re_entry_amount,
            'level' => $level,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
                );

        $this->tbl_re_entry('id'); 
        $re_entery_id = $this->global_model->save($dataArray);

        return $re_entery_id;

    }


    public function totalUser($id){

        $this->tbl_activated_user('id', 'desc'); 
        $whereTU = array('id >' => $id);
        $selectTU = array('id');
        $total_user = count($this->global_model->get_by($whereTU, false,  Null, Null, $selectTU));

        return $total_user;
    }

    public function totalDirect($id, $user_id){

        $this->tbl_activated_user('id', 'desc'); 
        $w_direct = array('id >' => $id, 'parent_id' => $user_id);
        $s_direct = array('id');
        $total_direct = count($this->global_model->get_by($w_direct, false,  Null, Null, $s_direct));

        return $total_direct;
    }

    public function totalReEntry($user_id){
        $w_entry = array('user_id' => $user_id);
        $this->db->select_sum('re_entry');
        $this->db->from('re_entry');
        $this->db->where($w_entry);
        $query=$this->db->get();
        $total_reEntry = $query->row()->user_id;

        return $total_reEntry;
    }
    
    public function levelUpdateForUser($user_id , $level){

        $dataLevel = array('user_level' => $level );
        $check = $this->global_model->set_action(array('id' => $user_id) , $dataLevel ,'users');

        return $check;
    }


    public function dashboard() {
        if (!$this->session->userdata('loginId')) {
            redirect('user/login');
        }
        $loginId = $this->session->userdata('loginId');
        $this->tbl_users('id'); // table User
        $whereSelf = array('id' => $loginId);
        $data['self_info'] = $this->global_model->get_by($whereSelf, true);

        $this->tbl_users('id'); // table User
        $whereActiveMember = array('activateId !=' => NULL, 'user_type' => 'User', 'parent_id' => $loginId);
        $data['direct_active_member'] = count($this->global_model->get_by($whereActiveMember));

        $this->tbl_users('id'); // table User
        $whereInactiveMember = array('activateId' => NULL, 'user_type' => 'User', 'parent_id' => $loginId);
        $data['direct_inactive_member'] = count($this->global_model->get_by($whereInactiveMember));

        $this->tbl_users('id','desc'); 
        $whereUser = array('user_type' => 'User', 'parent_id' => $loginId);
        $data['all_memeber'] = $this->global_model->get_by($whereUser, false, NULL, NULL, NULL, NULL, 3);

        $this->tbl_level('id','asc'); 
        $whereLevel = array('status' => 'Active');
        $data['all_level'] = $this->global_model->get_by($whereLevel);

        $this->tbl_news('id','asc'); 
        $whereNews = array('status' => 'Active');
        $data['all_news'] = $this->global_model->get_by($whereNews, false, NULL, NULL, NULL, NULL, 5);


        $this->tbl_user_pin('id', 'desc'); 
        $whereUUd = array('user_id' => $loginId, 'pin_type' => 'Un-used');
        $data['total_un_used_pin'] = count($this->global_model->get_by($whereUUd));

        $this->tbl_user_pin('id', 'desc'); 
        $whereUd = array('user_id' => $loginId, 'pin_type' => 'Used');
        $data['total_used_pin'] = count($this->global_model->get_by($whereUd)); 

        $this->tbl_user_pin('id', 'desc'); 
        $whereTR = array('transfer_user_id' => $loginId);
        $data['total_transfer_pin'] = count($this->global_model->get_by($whereTR));

        $this->tbl_activated_user('id', 'desc'); 
        $whereUserGet = array('user_id' => $loginId );
        $activate_user = $this->global_model->get_by($whereUserGet , true); 

        $data['total_user']  = 0;
        if(!empty($activate_user)){
            $this->tbl_activated_user('id', 'desc'); 
        $whereTU = array('id >' => $activate_user->id);
        $data['total_user'] = count($this->global_model->get_by($whereTU));

        }
        

        $data['title'] = 'Dashboard';
        $data['subview'] = $this->load->view('user/dashboard', $data, true);
        $this->load->view('user/_layout_main', $data);
    }



    public function edit_profile($id = null) {
        $id = $this->session->userdata('loginId');
        if (!empty($id)) {

            $where = array('id' => $id);
            $data['profile_info'] = $this->global_model->check_by($where, 'users');

            if (empty($data['profile_info'])) {

                $this->message->norecord_found('user/dashboard');
            }
        }
        $data['title'] = 'Edit Profile';
        $data['subview'] = $this->load->view('user/edit_profile', $data, true);
        $this->load->view('user/_layout_main', $data);
    }

   

    public function save_profile($id) {
        $id = $this->session->userdata('loginId');
        $this->tbl_users('id'); // table User
        $data['address'] = $this->input->post('address', true);
        $data['place_of_living'] = $this->input->post('place_of_living', true);
        $data['nominee_name'] = $this->input->post('nominee_name', true);
        $data['nominee_relation'] = $this->input->post('nominee_relation', true);
        $data['paytm_no'] = $this->input->post('paytm_no', true);
        $data['tej_no'] = $this->input->post('tej_no', true);
        $data['payphone'] = $this->input->post('payphone', true);
        $data['name'] = $this->input->post('name', true);
        $data['contact_number'] = $this->input->post('contact_number', true);
        $data['email'] = $this->input->post('email', true);
        $data['user_type'] = 'User';

       /* if (!$id) {
            $data['filename'] = '';
            $data['image_path'] = '';
        }*/
        // if (!empty($_FILES['user_images']['name'])) {
        //     $old_path = $this->input->post('old_path');
        //     if ($old_path) { // if old path is no empty
        //         unlink($old_path);
        //     } // upload file
        //     $val = $this->global_model->uploadAllfiles('user_images', 'assets/uploads/users/');
        //     $val == true || redirect('user/edit_profile/');
        //     $data['filename'] = $val['path'];
        //     $data['image_path'] = $val['fullPath'];
        // }
        // update profile
        
            $user_id = $this->global_model->save($data, $id); //save and update
            $this->tbl_users('id');
            $user = $this->global_model->get($user_id, TRUE);
            if (!empty($user)) {
                $data = array('loginId' => $user->id,
                    'userId' => $user->userId,
                    'parent_userId' => $user->parent_userId,
                    'user_type' => $user->user_type,
                    'name' => $user->name,
                    'contact_number' => $user->contact_number,
                    'email' => $user->email,
                    'filename' => $user->filename,
                    'loggedin' => true);
                $this->session->set_userdata($data);
          
            $type = 'success';
            $message = 'user Information Successfully Saved';
        }
        //redirect profile to view page
        set_message($type, $message);
        redirect('user/edit_profile/');
    }

 

  
    public function change_password($id = null) {
        $id = $this->session->userdata('loginId');
        $this->tbl_users('id'); // table user
        $old_password = $this->hash($this->input->post('old_password'));
        $where = array('password' => $old_password, 'id' => $id);
        $user_info = $this->global_model->check_by($where, 'user');

        if (!empty($user_info)) {
            $data['user_type'] = 'user';
            $data['password'] = $this->hash($this->input->post('new_password'));
            $user_id = $this->global_model->save($data, $user_info->id); //save and update
            $type = 'success';
            $message = 'Password Successfully Change';
            //redirect users to view page
            set_message($type, $message);
            redirect('user/edit_profile/');
        } else {
            $type = 'error';
            $message = 'Password Does Not Match';
            set_message($type, $message);
            redirect('user/edit_profile/');
        }
        // save and update query
    }

    public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }

}
