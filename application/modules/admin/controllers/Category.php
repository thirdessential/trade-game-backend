<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Category extends Admin_Controller {



    public function __construct() {

        parent::__construct();

        is_valid('admin');

        if(!$this->session->userdata('loginId')){

             redirect('admin/login');

        }

        $this->load->model('global_model');

    }





    public function manage_category($uid = null) {

        $data['title'] = 'Manage Category';
        $this->tbl_category('id', 'desc'); 
        $where = array();
        $data['all_album'] = $this->global_model->get_by($where); 
        $data['subview'] = $this->load->view('admin/category/manage_category', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }





    public function edit_category($id = null) {



        $data['title'] = 'Add Category'; 

       if (!empty($id)) { 

            $data['title'] = 'Edit Category'; 

            $where = array('id' => $id);

            $this->tbl_category('id', 'desc'); 

            $data['news_info'] = $this->global_model->check_by($where, 'category');

            if (empty($data['news_info'])) { 

                

                $this->message->norecord_found('admin/category/manage_category');

            }

        }

        $data['subview'] = $this->load->view('admin/category/add_edit_category', $data, true); 

        $this->load->view('admin/_layout_main', $data); // main page

    }





    public function save_category($id = null) {

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
            $val == true || redirect('admin/album/manage_album');

            $data['image'] = $val['path'];
           }
        $this->tbl_category('id'); 
        $news_id = $this->global_model->save($data, $id); 
        $type = 'success';
        $message = 'News Information Successfully Saved';
         set_message($type, $message);
        redirect('admin/category/manage_category');

    }





    public function delete_category($id) {

        $this->tbl_category('id'); 

        $this->global_model->delete($id);

        $type = 'success';

        $message = 'Category Information Successfully Delete ';

        set_message($type, $message);

        redirect('admin/category/manage_category');

    }



   

}

