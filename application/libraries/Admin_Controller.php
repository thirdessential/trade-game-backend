<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Admin_Controller extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('global_model');
    }

    //======================================================================
    // ALL TABLE DECLARATION
    //======================================================================
    //
    
   
    // table Users
    public function tbl_users($order_by, $order = null) {
        $this->global_model->_table_name = 'users';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'id';
    }
  

   

 
     public function tbl_user_meta($order_by, $order = null){
        $this->global_model->_table_name = 'userMeta';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'id';
    }

  
     public function tbl_notification($order_by, $order = null){
        $this->global_model->_table_name = 'notification';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'id';
        
    }

     public function tbl_course($order_by, $order = null){
        $this->global_model->_table_name = 'course';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'id';
    }
    public function tbl_membership($order_by, $order = null){
        $this->global_model->_table_name = 'membership';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'id';
    }
    
    public function tbl_quiz($order_by, $order = null){
        $this->global_model->_table_name = 'Quiz';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'id';
    }
    public function tbl_lession($order_by, $order = null){
        $this->global_model->_table_name = 'lession';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'id';
    }

    // Buy transaction table. This table maintain all buy transactions
    public function tbl_buy_transactions($order_by, $order = null) {
        $this->global_model->_table_name = 'buy_transactions';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'id';
    }
    
      // Sale transaction table. This table maintain all sale transactions
    public function tbl_sale_transactions($order_by, $order = null) {
        $this->global_model->_table_name = 'sale_transactions';
        $this->global_model->_order_by = $order_by;
        $this->global_model->_order = $order;
        $this->global_model->_primary_key = 'id';
    }

   

    
    
    
}
