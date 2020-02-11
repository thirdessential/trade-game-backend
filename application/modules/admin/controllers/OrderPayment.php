<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class OrderPayment extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        is_valid('admin');
        if(!$this->session->userdata('loginId')){
             redirect('admin/login');
        }
        $this->load->model('global_model');
    }


    public function orderPaymentList() {
        $data['title'] = 'Payment List';
        $this->tbl_order_payment('id', 'desc'); 
        $where = array();
        $select = array('order_payment.*', 'users.name', 'users.userId','users.paytm_no','users.tej_no');
        $join = array('users' => 'users.id = order_payment.user_id');
        $data['all_payment'] = $this->global_model->get_by_join($where, false, $select, $join); 

        $data['subview'] = $this->load->view('admin/orderPayment/manage_payment_list', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }


     public function userReEntry() {
        $data['title'] = 'Re Entry List';
        $this->tbl_re_entry('id', 'desc'); 
        $where = array();
        $select = array('re_entry.*', 'users.name');
        $join = array('users' => 'users.id = re_entry.user_id');
        $data['all_re_entry'] = $this->global_model->get_by_join($where, false, $select, $join); 

        $data['subview'] = $this->load->view('admin/orderPayment/manage_re_entry', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }

     public function set_payment_status($id) {
        $where = array('order_payment.id' => $id);
        $this->tbl_order_payment('id', 'desc'); 
        $select = array('order_payment.*', 'users.name', 'users.userId', 'users.tej_no', 'users.paytm_no', 'users.contact_number');
        $join = array('users' => 'users.id = order_payment.user_id');
        $data['payment_info'] = $this->global_model->get_by_join($where, true, $select, $join); 

        $data['title'] = 'Payment Details'; // title
        $this->load->view('admin/orderPayment/modal_set_payment', $data, FALSE);
    }


    public function save_payment_status($id){

        $this->form_validation->set_rules('transaction_id', 'Transaction Id', 'required');
        $this->form_validation->set_rules('payment_type', 'Payment Type', 'required');
        if ($this->form_validation->run() == FALSE) {
           // set_message('error', validation_errors());
           // redirect('admin/orderPayment/orderPaymentList');
            echo json_encode(array('success' => '0', 'message' => validation_errors()));
        } else {
            $payment_type =  $this->input->post('payment_type', true);
            $transaction_id =  $this->input->post('transaction_id', true);

            $dataArray = array('payment_type' => $payment_type, 'transaction_id' => $transaction_id, 'payment_status' => 'Done' );
            $user_pin_id = $this->global_model->set_action(array('id' => $id) , $dataArray ,'order_payment');

            echo json_encode(array('success' => '1', 'message' => 'Transaction Successfully.'));

        }
    }

}