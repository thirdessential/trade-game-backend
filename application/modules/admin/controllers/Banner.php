<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Banner extends Admin_Controller {



    public function __construct() {

        parent::__construct();

        is_valid('admin');

        if(!$this->session->userdata('loginId')){

             redirect('admin/login');

        }

        $this->load->model('global_model');

    }





    public function manage_banner($uid = null) {

        $data['title'] = 'Manage Banner';
        $this->tbl_banner('id', 'desc'); 
        $where = array();
        $data['all_album'] = $this->global_model->get_by($where); 
        $data['subview'] = $this->load->view('admin/banner/manage_banner', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }





    public function edit_banner($id = null) {



        $data['title'] = 'Add Banner'; 
        $this->tbl_album('id', 'desc'); 
        $where = array();
        $data['all_album'] = $this->global_model->get_by($where); 

       if (!empty($id)) { 

            $data['title'] = 'Edit Banner'; 

            $where = array('id' => $id);

            $this->tbl_banner('id', 'desc'); 

            $data['news_info'] = $this->global_model->check_by($where, 'banner');
           if (empty($data['news_info'])) { 
                $this->message->norecord_found('admin/banner/manage_banner');

            }
        }
        $this->tbl_category('id', 'desc'); 
        $where = array();
        $data['all_category'] = $this->global_model->get_by($where);

        $data['subview'] = $this->load->view('admin/banner/add_edit_banner', $data, true); 

        $this->load->view('admin/_layout_main', $data); // main page

    }





    public function save_banner($id = null) {

        $data['title'] = $this->input->post('title', true);

        $data['details'] = $this->input->post('description');
        $data['category_id'] = $this->input->post('category_id');
        $data['album_id'] = $this->input->post('album_id');
        
        if (!$id) {
            $data['image'] = '';

        }
        
        if (!empty($_FILES['profile_picture']['name'])) {
            $old_path = $this->input->post('profile_picture');
            if ($old_path) { // if old path is no empty
                unlink(FCPATH . $old_path);
            } 
            $val = $this->global_model->uploadImage('profile_picture', 'assets/uploads/users/');
            $val == true || redirect('admin/banner/manage_banner');

            $data['image'] = $val['path'];
           }
        $this->tbl_banner('id'); 
        $news_id = $this->global_model->save($data, $id); 
        $type = 'success';
        $message = 'News Information Successfully Saved';
         set_message($type, $message);
        redirect('admin/banner/manage_banner');

    }





    public function delete_banner($id) {

        $this->tbl_banner('id'); 

        $this->global_model->delete($id);

        $type = 'success';

        $message = 'News Information Successfully Delete ';

        set_message($type, $message);

        redirect('admin/banner/manage_banner');

    }



   

}

