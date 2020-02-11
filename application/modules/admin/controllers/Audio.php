<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Audio extends Admin_Controller {



    public function __construct() {

        parent::__construct();

        is_valid('admin');

        if(!$this->session->userdata('loginId')){

             redirect('admin/login');

        }

        $this->load->model('global_model');

    }





    public function manage_audio($uid = null) {

        $data['title'] = 'Manage Audio';
        $this->tbl_audio('id', 'desc'); 
        $where = array();
        $data['all_video'] = $this->global_model->get_by($where); 
        $data['subview'] = $this->load->view('admin/audio/manage_audio', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }





    public function edit_audio($id = null) {



        $data['title'] = 'Add Audio'; 
        $this->tbl_category('id', 'desc'); 
        $where = array();
        $data['all_category'] = $this->global_model->get_by($where);
        $this->tbl_type('id', 'desc'); 
        $where = array();
        $data['all_type'] = $this->global_model->get_by($where);
        $this->tbl_subCat('id', 'desc'); 
        $where = array();
        $data['all_subCat'] = $this->global_model->get_by($where);
        $this->tbl_album('id', 'desc'); 
        $where = array();
        $data['all_album'] = $this->global_model->get_by($where);

       if (!empty($id)) { 

            $data['title'] = 'Edit Audio'; 

            $where = array('id' => $id);

            $this->tbl_audio('id', 'desc'); 

            $data['audio_info'] = $this->global_model->check_by($where, 'audio');

            if (empty($data['audio_info'])) { 

                $this->message->norecord_found('admin/audio/manage_audio');

            }

        }

        $data['subview'] = $this->load->view('admin/audio/add_edit_audio', $data, true); 

        $this->load->view('admin/_layout_main', $data); // main page

    }





    public function save_audio($id = null) {

        $data['title'] = $this->input->post('title', true);
        $data['details'] = $this->input->post('description');
        $data['type_id'] = $this->input->post('type_id');
        $data['cat_id'] = $this->input->post('cat_id');
        $data['sub_cat_id'] = $this->input->post('sub_cat_id');
        $data['album_id'] = $this->input->post('album_id');
        $data['details'] = $this->input->post('description');
        $data['about_video'] = $this->input->post('about');
       if (!$id) {
            $data['profile_image'] = '';

        }
        
        if (!empty($_FILES['profile_picture']['name'])) {
            $old_path = $this->input->post('profile_picture');
            if ($old_path) { // if old path is no empty
                unlink(FCPATH . $old_path);
            } 
            $val = $this->global_model->uploadImage('profile_picture', 'assets/uploads/users/');
            $val == true || redirect('admin/type/manage_type');

            $data['profile_image'] = $val['path'];
           }
        if (!empty($_FILES['audio']['name'])) {
           
            $val = $this->global_model->uploadAllfiles('audio', 'assets/uploads/audio/');
            $val == true || redirect('admin/video/manage_video');

            $data['audio_link'] = $val['path'];
           }
        $this->tbl_audio('id'); 
        $news_id = $this->global_model->save($data, $id); 
        $type = 'success';
        $message = 'Audio Information Successfully Saved';
         set_message($type, $message);
        redirect('admin/audio/manage_audio');

    }

    public function delete_audio($id) {

        $this->tbl_audio('id'); 

        $this->global_model->delete($id);

        $type = 'success';

        $message = 'Audio Information Successfully Delete ';

        set_message($type, $message);

        redirect('admin/audio/manage_audio');

    }



   

}

