<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends Admin_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        //is_valid('user');
        $this->load->model('global_model');
        if (!$this->input->is_ajax_request()) {
            die('0');
        }
    }

    public function check_email() {
        $id = $this->input->post('id');
        if (!empty($id)) {
            $where = array('id !=' => $id, 'email' => $this->input->post('email'));
        } else {
            $where = array('email' => $this->input->post('email'));
        }

        $table = $this->input->post('tbl');
        $is_exist = $this->global_model->check_by($where, $table, TRUE);
        if ($is_exist) {
            echo(json_encode(false));
        } else {
            echo(json_encode(true));
        }
    }
    public function check_sponsered() {
        $id = $this->input->post('id');
        if (!empty($id)) {
            $where = array('id !=' => $id, 'userId' => $this->input->post('userId'));
        } else {
            $where = array('userId' => $this->input->post('userId'));
        }

        $table = $this->input->post('tbl');
        $is_exist = $this->global_model->check_by($where, $table, TRUE);
        if ($is_exist) {
            echo(json_encode(false));
        } else {
            echo(json_encode(true));
        }
    }

    public function check_transfer_user_Id() {
        $loginId = $this->session->userdata('loginId');
        $where = array('id !=' => $loginId,'activateId !=' => NULL, 'userId' => $this->input->post('userId'));
        
        $table = $this->input->post('tbl');
        $is_exist = $this->global_model->check_by($where, $table, TRUE);
        if ($is_exist) {
            echo(json_encode(true));
        } else {
            echo(json_encode(false));
        }
    }

    public function get_user_id_name() {
        $loginId = $this->session->userdata('loginId');
        $where = array('id !=' => $loginId, 'activateId !=' => NULL, 'userId' => $this->input->post('userId'));
        
        $table = $this->input->post('tbl');
        $is_exist = $this->global_model->check_by($where, $table, TRUE);
        if ($is_exist) {
            echo $is_exist->name;
        } else {
            echo 0 ;
        }
    }

    /*public function get_user_activated_id() {
        $loginId = $this->session->userdata('loginId');
        $where = array('activateId' => NULL, 'userId' => $this->input->post('userId'));
       
        $table = $this->input->post('tbl');
        $is_exist = $this->global_model->check_by($where, $table, TRUE);
        if ($is_exist) {
            if(!empty($is_exist->parent_id)){
                if($is_exist->parent_id == $loginId){
                    echo $is_exist->name;
                }else if($is_exist->id == $loginId){
                    echo $is_exist->name;
                }else{
                    echo 0;
                }

            }else{
                if($is_exist->id == $loginId){
                    echo $is_exist->name;
                }else{
                    echo 0;
                }
            }

        }else{
            echo 0;
        }

    }*/


    public function get_user_activated_id() {
        $loginId = $this->session->userdata('loginId');
        $where = array('activateId' => NULL, 'userId' => $this->input->post('userId'));
       
        $table = $this->input->post('tbl');
        $is_exist = $this->global_model->check_by($where, $table, TRUE);
        if ($is_exist) {
            echo $is_exist->name;
        }else{
            echo 0;
        }

    }



    public function get_sponsor_name() {
        $where = array('activateId !=' => NULL, 'userId' => $this->input->post('userId'));
        
        $table = $this->input->post('tbl');
        $is_exist = $this->global_model->check_by($where, $table, TRUE);
        if ($is_exist) {
            echo $is_exist->name;
        } else {
            echo 0 ;
        }
    }

    public function check_sponsoredId() {
        $where = array('activateId !=' => NULL, 'userId' => $this->input->post('sponsored_id'));
        
        $table = $this->input->post('tbl');
        $is_exist = $this->global_model->check_by($where, $table, TRUE);
        if ($is_exist) {
            echo(json_encode(true));
        } else {
            echo(json_encode(false));
        }
    }


    public function check_member_id() {
        $loginId = $this->session->userdata('loginId');
        $where = array('userId' => $this->input->post('userId') ,'activateId' => null);
       
        $table = $this->input->post('tbl');
        $is_exist = $this->global_model->check_by($where, $table, TRUE);
        
        if ($is_exist) {
            echo(json_encode(true));

        }else{
            echo(json_encode(false));
        }

    }


    /*public function check_member_id() {
        $loginId = $this->session->userdata('loginId');
        $where = array('userId' => $this->input->post('userId') ,'activateId' => null);
       
        $table = $this->input->post('tbl');
        $is_exist = $this->global_model->check_by($where, $table, TRUE);
        
        if ($is_exist) {
            if(!empty($is_exist->parent_id)){
                if($is_exist->parent_id == $loginId && empty($is_exist->activateId)){
                    echo(json_encode(true));
                }else if($is_exist->id == $loginId && empty($is_exist->activateId)){
                    echo(json_encode(true));
                }else{
                    echo(json_encode(false));
                }

            }else{
                if($is_exist->id == $loginId && empty($is_exist->activateId)){
                    echo(json_encode(true));
                }
                else{
                 echo(json_encode(false));

                }
            }

        }else{
            echo(json_encode(true));
        }

    }
*/
    public function check_activate_id() {
        $loginId = $this->session->userdata('loginId');
        $where = array('pin_value' => $this->input->post('pin_value'),'user_id' => $loginId, 'pin_type' => 'Un-used');
       
        $table = $this->input->post('tbl');
        $is_exist = $this->global_model->check_by($where, $table, TRUE);
        if ($is_exist) {
            echo(json_encode(true));
            
        }else{
            echo(json_encode(false));
        }

    }


    public function check_account_number() {
        $id = $this->input->post('id');
        if (!empty($id)) {
            $where = array('id !=' => $id, 'account_number' => $this->input->post('account_number'));
        } else {
            $where = array('account_number' => $this->input->post('account_number'));
        }

        $table = $this->input->post('tbl');
        $is_exist = $this->global_model->check_by($where, $table, TRUE);
        if ($is_exist) {
            echo(json_encode(false));
        } else {
            echo(json_encode(true));
        }
    }

    public function generate_new_key() {
        $id = $this->input->post('id');
        $userId = rand(11111111, 99999999);
        if (!empty($id)) {
            $where = array('id !=' => $id, 'userId' => $userId);
        } else {
            $where = array('userId' => $userId);
        }

        $is_exist = $this->global_model->check_by($where, 'users', TRUE);
        if ($is_exist) {
            $this->generate_new_key($id);
        } else {
            echo $userId;
        }
    }

    public function check_mobile() {
        $id = $this->input->post('id');
        $table = $this->input->post('tbl');
        if (!empty($id)) {
            $where = array('id !=' => $id, 'contact_number' => $this->input->post('contact_number'));
        } else {
            $where = array('contact_number' => $this->input->post('contact_number'));
        }

        $is_exist = $this->global_model->check_by($where, $table, TRUE);
        if ($is_exist) {
            echo(json_encode(false));
        } else {
            echo(json_encode(true));
        }
    }

    public function change_status() {
        $table = $this->input->post('table');
        $id = $this->input->post('id');
        $result = $this->global_model->change_status($table, $id);
        //echo $this->db->last_query(); die;
        if ($result) {
            die('1');
        } else {
            die('0');
        }
    }

   

}
