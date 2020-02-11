<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Ajax extends Admin_Controller {

    //put your code here

    public function __construct() {
        parent::__construct();
        //is_valid('admin');
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

    public function check_pin_value() {
        $id = $this->input->post('id');
        if (!empty($id)) {
            $where = array('id !=' => $id, 'pin_value' => $this->input->post('pin_value'));
        } else {
            $where = array('pin_value' => $this->input->post('pin_value'));
        }

        $table = $this->input->post('tbl');
        $is_exist = $this->global_model->check_by($where, $table, TRUE);
        if ($is_exist) {
            echo(json_encode(false));
        } else {
            echo(json_encode(true));
        }
    }

    public function generate_new_key($id = null) {
        if(empty($id)){
        $id = $this->input->post('id');
        }
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

    public function generate_pin_value($id = null) {

        if(empty($id)){
        $id = $this->input->post('id');
        }
        $pin_value = rand(11111111, 99999999);
        if (!empty($id)) {
            $where = array('id !=' => $id, 'pin_value' => $pin_value);
        } else {
            $where = array('pin_value' => $pin_value);
        }

        $is_exist = $this->global_model->check_by($where, 'user_pin', TRUE);
        if ($is_exist) {
            $this->generate_pin_value($id);
        } else {
            echo $pin_value;
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
