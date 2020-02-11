<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Membership extends Admin_Controller {



    public function __construct() {

        parent::__construct();

        is_valid('admin');

        if(!$this->session->userdata('loginId')){

             redirect('admin/login');

        }

        $this->load->model('global_model');

    }





    public function manage_membership($uid = null) {

        $data['title'] = 'Manage membership';
        $this->tbl_membership('id', 'desc'); 
        $where = array();
        $data['all_membership'] = $this->global_model->get_by($where); 
        $data['subview'] = $this->load->view('admin/membership/manage_membership', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }





    public function edit_membership($id = null) {



        $data['title'] = 'Add membership'; 

       if (!empty($id)) { 

            $data['title'] = 'Edit membership'; 

            $where = array('id' => $id);

            $this->tbl_membership('id', 'desc'); 

            $data['membership_info'] = $this->global_model->check_by($where, 'membership');

            if (empty($data['membership_info'])) { 

                

                $this->message->norecord_found('admin/membership/manage_membership');

            }

        }

        $data['subview'] = $this->load->view('admin/membership/add_edit_membership', $data, true); 

        $this->load->view('admin/_layout_main', $data); // main page

    }





    public function save_membership($id = null) {

        $data['title'] = $this->input->post('title', true);
        $data['details'] = $this->input->post('description');
        $data['price'] = $this->input->post('price');
        $data['limitDays'] = $this->input->post('limitDays');
        if (!$id) {
            $data['image'] = '';

        }
        
        if (!empty($_FILES['profile_picture']['name'])) {
            $old_path = $this->input->post('profile_picture');
            if ($old_path) { // if old path is no empty
                unlink(FCPATH . $old_path);
            } 
            $val = $this->global_model->uploadImage('profile_picture', 'assets/uploads/users/');
            $val == true || redirect('admin/membership/manage_membership');

            $data['image'] = $val['path'];
           }
        $this->tbl_membership('id'); 
        $news_id = $this->global_model->save($data, $id); 
        $type = 'success';
        $message = 'membership Information Successfully Saved';
         set_message($type, $message);
        redirect('admin/membership/manage_membership');

    }





    public function delete_membership($id) {

        $this->tbl_membership('id'); 

        $this->global_model->delete($id);

        $type = 'success';

        $message = 'Membership Information Successfully Delete ';

        set_message($type, $message);

       redirect('admin/membership/manage_membership');

    }



   

}

