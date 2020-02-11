<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class General extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        is_valid('admin');
        if(!$this->session->userdata('loginId')){
             redirect('admin/login');
        }
        $this->load->model('global_model');
    }


    public function manage_bank() {
        $data['title'] = 'Manage Bank Account';
        $this->tbl_bank('id', 'desc'); 
        $where = array();
        $select = array('bank_account.*', 'users.name');
        $join = array('users' => 'users.id = bank_account.user_id');
        $data['all_bank'] = $this->global_model->get_by_join($where, false, $select, $join); 

        $data['subview'] = $this->load->view('admin/general/manage_bank', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    
    public function pinGenerate() {
        $data['title'] = 'Pin Generat';

        $this->tbl_users('id','desc'); 
        $whereUser = array('user_type' => 'User', 'status' => 'Active');
        $data['all_member'] = $this->global_model->get_by($whereUser, false);
        $this->tbl_user_pin('id', 'desc'); 
        $where = array();
        $select = array('user_pin.*', 'send_user.name as send_user_name','transfer_user.name as transfer_user_name','activate_user.name as activate_user_name');
        $join = array('users as send_user' => 'send_user.id = user_pin.user_id',
                'users as transfer_user' => 'transfer_user.id = user_pin.transfer_user_id',
                'users as activate_user' => 'activate_user.id = user_pin.user_activate_id'
                );
        $data['all_pin'] = $this->global_model->get_by_join($where, false, $select, $join); 

        $data['subview'] = $this->load->view('admin/general/pinGenerate', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

    public function save_pin($id = null) {
        $type = 'error';
        $message = 'Pin Information not insert';
    

        $loginId = $this->session->userdata('loginId');
        $quantity = $this->input->post('quantity', true);
        $data['user_id'] = $this->input->post('userId', true);
        
        if($quantity > 0){
            for($i=1; $i <= $quantity; $i++){
                $data['pin_value'] = $this->generatePin();
                $data['send_by'] = 'Admin';
                $this->tbl_user_pin('id'); 
                $pin_id = $this->global_model->save($data, $id); 
        
            }
            $type = 'success';
            $message = 'Pin Information Successfully Saved';
    
        }
        

        set_message($type, $message);
        redirect('admin/general/pinGenerate');
    }


    public function generatePin() {
        $pin_value = rand(11111111, 99999999);

        $where = array('pin_value' => $pin_value);

        $table = $this->input->post('tbl');
        $is_exist = $this->global_model->check_by($where, 'user_pin', TRUE);
        if ($is_exist) {
            $this->generatePin();
        } else {
            return $pin_value;
        }
    }


}