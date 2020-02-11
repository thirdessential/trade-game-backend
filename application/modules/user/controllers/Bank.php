<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Bank extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        is_valid('user');
        if(!$this->session->userdata('loginId')){
             redirect('user/login');
        }
        $this->load->model('global_model');
    }


    public function manage_bank() {
        $data['title'] = 'Manage Bank';
        $loginId = $this->session->userdata('loginId');
        
        $this->tbl_bank('id', 'desc'); 
        $where = array('user_id' => $loginId);
        $data['all_bank'] = $this->global_model->get_by($where); 

        $data['subview'] = $this->load->view('user/bank/manage_bank', $data, true);
        $this->load->view('user/_layout_main', $data);
    }


    public function add_edit_bank() {
        $loginId = $this->session->userdata('loginId');
        $data['title'] = 'Edit bank'; 
        $where = array('user_id' => $loginId);
        $this->tbl_bank('id', 'desc'); 
        $data['bank_info'] = $this->global_model->check_by($where, 'bank_account');
        
        if(!empty($data['bank_info'])){
        $data['subview'] = $this->load->view('user/bank/show_bank_detail', $data, true); 

        }else{
            
        $data['subview'] = $this->load->view('user/bank/add_edit_bank', $data, true); 
        }

        $this->load->view('user/_layout_main', $data); // main page
    }


    public function save_bank($id = null) {
       // print_r($this->input->post()); die;
        $loginId = $this->session->userdata('loginId');
        $data['account_holder_name'] = $this->input->post('account_holder_name', true);
        $data['account_number'] = $this->input->post('account_number', true);
        $data['bank_name'] = $this->input->post('bank_name', true);
        $data['branch_location'] = $this->input->post('branch_location', true);
        $data['ifsc_number'] = $this->input->post('ifsc_number', true);
        $data['pan_number'] = $this->input->post('pan_number', true);
        $data['user_id'] = $loginId;
       
        // update sub bank
        $where = array(
            'account_number' => $data['account_number'],
         );
        // duplicate check
        if (!empty($id)) {
            $bank_id = array('id !=' => $id);
        } else {
            $bank_id = null;
        }

        $check_bank = $this->global_model->check_update('bank_account', $where, $bank_id);
        if (!empty($check_bank)) {
            $type = 'error';
            $message = 'bank Information Already Exist';
        } else { 
            $this->tbl_bank('id'); 
            $bank_id = $this->global_model->save($data, $id); 
            $type = 'success';
            $message = 'bank Information Successfully Saved';
        }

        set_message($type, $message);
        redirect('user/bank/add_edit_bank');
    }


    public function delete_bank($id) {
        $this->tbl_bank('id'); // table Parentds
        $this->global_model->delete($id);
        $type = 'success';
        $message = 'bank Information Successfully Delete ';
        //redirect bank to view page
        set_message($type, $message);
        redirect('user/bank/manage_bank');
    }
   
}
