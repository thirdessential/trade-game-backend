<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Type extends Admin_Controller {



    public function __construct() {

        parent::__construct();

        is_valid('admin');

        if(!$this->session->userdata('loginId')){

             redirect('admin/login');

        }

        $this->load->model('global_model');

    }





    public function manage_type($uid = null) {

        $data['title'] = 'Manage Type';
        $this->tbl_type('id', 'desc'); 
        $where = array();
        $data['all_album'] = $this->global_model->get_by($where); 
        $data['subview'] = $this->load->view('admin/type/manage_type', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }





    public function edit_type($id = null) {



        $data['title'] = 'Add Type'; 

       if (!empty($id)) { 

            $data['title'] = 'Edit Type'; 

            $where = array('id' => $id);

            $this->tbl_type('id', 'desc'); 

            $data['news_info'] = $this->global_model->check_by($where, 'type');

            if (empty($data['news_info'])) { 

                

                $this->message->norecord_found('admin/type/manage_type');

            }

        }

        $data['subview'] = $this->load->view('admin/type/add_edit_type', $data, true); 

        $this->load->view('admin/_layout_main', $data); // main page

    }





    public function save_type($id = null) {

        $data['title'] = $this->input->post('title', true);

        $data['details'] = $this->input->post('description');
        if (!$id) {
            $data['image'] = '';

        }
        
        if (!empty($_FILES['profile_picture']['name'])) {
            $old_path = $this->input->post('profile_picture');
            if ($old_path) { // if old path is no empty
                unlink(FCPATH . $old_path);
            } 
            $val = $this->global_model->uploadImage('profile_picture', 'assets/uploads/users/');
            $val == true || redirect('admin/type/manage_type');

            $data['image'] = $val['path'];
           }
        $this->tbl_type('id'); 
        $news_id = $this->global_model->save($data, $id); 
        $type = 'success';
        $message = 'News Information Successfully Saved';
         set_message($type, $message);
        redirect('admin/type/manage_type');

    }





    public function delete_type($id) {

        $this->tbl_type('id'); 

        $this->global_model->delete($id);

        $type = 'success';

        $message = 'Type Information Successfully Delete ';

        set_message($type, $message);

       redirect('admin/type/manage_type');

    }



   

}

