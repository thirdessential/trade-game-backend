<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Level extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        is_valid('admin');
        if(!$this->session->userdata('loginId')){
             redirect('admin/login');
        }
        $this->load->model('global_model');
    }


    public function manage_level($uid = null) {
        $data['title'] = 'Manage Level';
        
        $this->tbl_level('id', 'desc'); 
        $where = array();
        $data['all_level'] = $this->global_model->get_by($where); 

        $data['subview'] = $this->load->view('admin/level/manage_level', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }


    public function add_edit_level($id = null) {

        $data['title'] = 'Add Level'; 
       if (!empty($id)) { 
            $data['title'] = 'Edit Level'; 
            $where = array('id' => $id);
            $this->tbl_level('id', 'desc'); 
            $data['level_info'] = $this->global_model->check_by($where, 'level');
            if (empty($data['level_info'])) { 
                
                $this->message->norecord_found('admin/level/manage_level');
            }
        }
        $data['subview'] = $this->load->view('admin/level/add_edit_level', $data, true); 
        $this->load->view('admin/_layout_main', $data); // main page
    }


    public function save_level($id = null) {
        $data['product_purchase'] = $this->input->post('product_purchase', true);
        $data['direct_required'] = $this->input->post('direct_required', true);
        $data['re_entry'] = $this->input->post('re_entry', true);
        $data['single_leg_income'] = $this->input->post('single_leg_income', true);
        $data['sponser_income'] = $this->input->post('sponser_income', true);
        
        $this->tbl_level('id'); 
        $level_id = $this->global_model->save($data, $id); 
        $type = 'success';
        $message = 'Level Information Successfully Saved';
        
        set_message($type, $message);
        redirect('admin/level/manage_level');
    }


    public function delete_level($id) {
        $this->tbl_level('id'); // table Parentds
        $this->global_model->delete($id);
        $type = 'success';
        $message = 'Levels Information Successfully Delete ';
        //redirect levels to view page
        set_message($type, $message);
        redirect('admin/level/manage_level');
    }

   
}
