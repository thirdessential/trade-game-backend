<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UserPanel extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        is_valid('user');
        if(!$this->session->userdata('loginId')){
             redirect('user/login');
        }
        $this->load->model('global_model');
    }


    public function myDirectMember() {
        $data['title'] = 'My Direct Member';
        $loginId = $this->session->userdata('loginId');
        
        $this->tbl_users('id', 'desc'); 
        $where = array('parent_id' => $loginId);
        $data['all_member'] = $this->global_model->get_by($where); 

        $data['subview'] = $this->load->view('user/userPanel/my_direct_member', $data, true);
        $this->load->view('user/_layout_main', $data);
    }


    public function welcome_leter() {
        $data['title'] = 'Welcome Later';
        $loginId = $this->session->userdata('loginId');
        $this->tbl_users('id');
        $where = array('id' => $loginId);
        $data['user_info'] = $this->global_model->get_by($where, true); 
        
        $data['subview'] = $this->load->view('user/userPanel/welcome_leter', $data, true);
        $this->load->view('user/_layout_main', $data);
    }


    public function myTeam() {
        $data['title'] = 'My Team';
        $loginId = $this->session->userdata('loginId');
        $where = array('users.parent_id' => $loginId);
        $data['level']  = '';
        $data['status']  = '';
        if($this->input->post('submit') == 'submit'){
            $data['status'] = $status = $this->input->post('status');
            $data['level'] = $level = $this->input->post('level');
        
            $where = array('users.status' => $status , 'users.parent_id' => $loginId);

        }
        
        $this->tbl_users('id', 'desc'); 
        $data['all_member'] = $this->global_model->get_by($where); 
        $data['subview'] = $this->load->view('user/userPanel/my_downline_team', $data, true);
        $this->load->view('user/_layout_main', $data);
    }


    public function activateId() {

        $data['title'] = 'Activate ID';
        $loginId = $this->session->userdata('loginId');
        $this->tbl_user_pin('id', 'desc'); 
        $where = array('user_id' => $loginId, 'pin_type' => 'Un-used');
        $data['un_used_pin'] = $this->global_model->get_by($where);  
       
        $data['subview'] = $this->load->view('user/userPanel/activateId', $data, true); 
        $this->load->view('user/_layout_main', $data); // main page
    }

    public function unUsedPin() {
        $data['title'] = 'Un Used Pin';
        $loginId = $this->session->userdata('loginId');

        $this->tbl_user_pin('id', 'desc'); 
        $where = array('user_id' => $loginId, 'pin_type' => 'Un-used');
        
        $data['un_used_pin'] = $this->global_model->get_by($where); 

        $data['subview'] = $this->load->view('user/userPanel/unUsedPin', $data, true);
        $this->load->view('user/_layout_main', $data);
    }


    public function usedPin() {
        $data['title'] = 'Used Pin';
        $loginId = $this->session->userdata('loginId');

        $this->tbl_user_pin('id', 'desc'); 
        $where = array('user_id' => $loginId, 'pin_type' => 'Used');
        $select = array('user_pin.*','activate_user.name as activate_user_name', 'activate_user.userId as activate_userId');
        $join = array('users as activate_user' => 'activate_user.id = user_pin.user_activate_id'
                );
        $data['used_pin'] = $this->global_model->get_by_join($where, false, $select, $join); 

        $data['subview'] = $this->load->view('user/userPanel/usedPin', $data, true);
        $this->load->view('user/_layout_main', $data);
    }


    public function transferPinDetail() {
        $data['title'] = 'Transfer Pin Details';
        $loginId = $this->session->userdata('loginId');

        $this->tbl_user_pin('id', 'desc'); 
        $where = array('transfer_user_id' => $loginId);
        $select = array('user_pin.*','users.name as transfer_user_name', 'users.userId as transfer_userId');
        $join = array('users' => 'users.id = user_pin.user_id'
                );
        $data['transfer_pin_detail'] = $this->global_model->get_by_join($where, false, $select, $join); 

        $data['subview'] = $this->load->view('user/userPanel/transferPinDetail', $data, true);
        $this->load->view('user/_layout_main', $data);
    }


    public function transferPin() {
        $data['title'] = 'Transfer Pin';

        $loginId = $this->session->userdata('loginId');

        $this->tbl_user_pin('id', 'desc'); 
        $where = array('user_id' => $loginId, 'pin_type' => 'Un-used', 'transfer_user_id' => NULL);
        
        $data['un_used_transfer_pin'] = $this->global_model->get_by($where); 
        
        $data['subview'] = $this->load->view('user/userPanel/transferPin', $data, true);
        $this->load->view('user/_layout_main', $data);
    }


    public function save_transfer_pin() {
       // print_r($this->input->post()); die;
        $loginId = $this->session->userdata('loginId');
        $userId = $this->input->post('userId', true);
        $pinId = $this->input->post('pinId', true);
       
        $where = array('id !=' => $loginId,'parent_id' => $loginId, 'activateId !=' => NULL, 'userId' => $userId);
        
        $is_exist = $this->global_model->check_by($where, 'users', TRUE);
       
        if (empty($is_exist)) {
            $type = 'error';
            $message = 'User Id Already Exist';
        } else { 

            if(!empty($pinId)){

                for($i= 0; $i < count($pinId); $i++ ){
                    $dataArray = array('user_id' => $is_exist->id, 'transfer_user_id' => $loginId );

                    $this->tbl_user_pin('id'); 
                    $user_pin_id = $this->global_model->save($dataArray, $pinId[$i]); 
                }

                $type = 'success';
                $message = 'bank Information Successfully Saved';
               
            }else{
            $type = 'error';
            $message = 'Pin not transfered';
            }

        }

        set_message($type, $message);
        redirect('user/userPanel/transferPin');
    }

    public function saveActivateId() {
       // print_r($this->input->post()); die;
        $loginId = $this->session->userdata('loginId');
        $userId = $this->input->post('userId', true);
        $pin_value = $this->input->post('pin_value', true);
       
        $whereUsers = array('userId' => $userId ,'activateId' => NULL );
        $is_exist = $this->global_model->check_by($whereUsers, 'users', TRUE);


        $where = array('pin_value' => $pin_value,'user_id' => $loginId, 'pin_type' => 'Un-used');
        $is_exist_pin = $this->global_model->check_by($where, 'user_pin', TRUE);
       
        if (!empty($is_exist)  && !empty($is_exist_pin)) {

            $dataPin = array('pin_type' => 'Used', 'user_activate_id' => $is_exist->id );
            $user_pin_id = $this->global_model->set_action(array('id' => $is_exist_pin->id) , $dataPin ,'user_pin');


            $dataUser = array('activateId' => $pin_value );
            $user_id = $this->global_model->set_action(array('id' => $is_exist->id) , $dataUser ,'users');

            $dataActivate = array(
                            'user_id'   => $is_exist->id,
                            'parent_id' => $is_exist->parent_id,
                            'start_date' => date('Y-m-d'),
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s'),
                                );
             
            $this->tbl_activated_user('id'); 
            $user_active_id = $this->global_model->save($dataActivate); 
            $type = 'success';
            $message = 'User Id Successfully Activate';
            
        } else { 
              
            $type = 'error';
            $message = 'Something is went wrong'; 

        }

        set_message($type, $message);
        redirect('user/userPanel/activateId');
    }


    public function orderPaymentList() {
        $loginId = $this->session->userdata('loginId');
        $data['title'] = 'Payment List';
        $this->tbl_order_payment('id', 'desc'); 
        $where = array('user_id' => $loginId);
        $data['all_payment'] = $this->global_model->get_by($where, false); 

        $data['subview'] = $this->load->view('user/userPanel/manage_payment_list', $data, true);
        $this->load->view('user/_layout_main', $data);
    }

    public function userReEntry() {
        $loginId = $this->session->userdata('loginId');
        $data['title'] = 'Re Entry List';
        $this->tbl_re_entry('id', 'desc'); 
        $where = array('user_id' => $loginId);
        $data['all_re_entry'] = $this->global_model->get_by($where, false); 

        $data['subview'] = $this->load->view('user/userPanel/manage_re_entry', $data, true);
        $this->load->view('user/_layout_main', $data);
    }


}