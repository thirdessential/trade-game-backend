<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class SubCat extends Admin_Controller {



    public function __construct() {

        parent::__construct();

        is_valid('admin');

        if(!$this->session->userdata('loginId')){

             redirect('admin/login');

        }

        $this->load->model('global_model');

    }





    public function manage_subCat($uid = null) {

        $data['title'] = 'Manage Sub-Category';
        $this->tbl_subCat('id', 'desc'); 
        $where = array();
        $data['all_album'] = $this->global_model->get_by($where); 


        
        $data['subview'] = $this->load->view('admin/subCat/manage_subCat', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }





    public function edit_subCat($id = null) {



        $data['title'] = 'Add Sub-Category'; 
        $this->tbl_category('id', 'desc'); 
        $where = array();
        $data['all_category'] = $this->global_model->get_by($where); 

       if (!empty($id)) { 

            $data['title'] = 'Edit Sub-Category'; 

            $where = array('id' => $id);

            $this->tbl_subCat('id', 'desc'); 

            $data['news_info'] = $this->global_model->check_by($where, 'subCat');

            if (empty($data['news_info'])) { 

                

                $this->message->norecord_found('admin/subCat/manage_subCat');

            }

        }

        $data['subview'] = $this->load->view('admin/subCat/add_edit_subCat', $data, true); 

        $this->load->view('admin/_layout_main', $data); // main page

    }





    public function save_subCat($id = null) {

        $data['title'] = $this->input->post('title', true);
        $data['details'] = $this->input->post('description');
        $data['category_id'] = $this->input->post('category_id');
        if (!$id) {
            $data['image'] = '';

        }
        
        if (!empty($_FILES['profile_picture']['name'])) {
            $old_path = $this->input->post('profile_picture');
            if ($old_path) { // if old path is no empty
                unlink(FCPATH . $old_path);
            } 
            $val = $this->global_model->uploadImage('profile_picture', 'assets/uploads/users/');
            $val == true || redirect('admin/subCat/manage_subCat');

            $data['image'] = $val['path'];
           }
        $this->tbl_subCat('id'); 
        $news_id = $this->global_model->save($data, $id); 
        $type = 'success';
        $message = 'Sub Category Information Successfully Saved';
         set_message($type, $message);
        redirect('admin/subCat/manage_subCat');

    }





    public function delete_subCat($id) {

        $this->tbl_subCat('id'); 

        $this->global_model->delete($id);

        $type = 'success';

        $message = 'subCat Information Successfully Delete ';

        set_message($type, $message);

        redirect('admin/subCat/manage_subCat');

    }



   

}

