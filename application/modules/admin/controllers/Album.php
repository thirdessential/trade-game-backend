<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Album extends Admin_Controller {



    public function __construct() {

        parent::__construct();

        is_valid('admin');

        if(!$this->session->userdata('loginId')){

             redirect('admin/login');

        }

        $this->load->model('global_model');

    }





    public function manage_album($uid = null) {

        $data['title'] = 'Manage Album';
        $this->tbl_album('id', 'desc'); 
        $where = array();
        $data['all_album'] = $this->global_model->get_by($where); 
        $data['subview'] = $this->load->view('admin/album/manage_album', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }





    public function edit_album($id = null) {



        $data['title'] = 'Add Album'; 
        $this->tbl_category('id', 'desc'); 
        $where = array();
        $data['all_category'] = $this->global_model->get_by($where);
        $this->tbl_subCat('id', 'desc'); 
        $where = array();
        $data['all_subCat'] = $this->global_model->get_by($where);

       if (!empty($id)) { 

            $data['title'] = 'Edit Album'; 

            $where = array('id' => $id);

            $this->tbl_album('id', 'desc'); 

            $data['news_info'] = $this->global_model->check_by($where, 'album');

            if (empty($data['news_info'])) { 

                

                $this->message->norecord_found('admin/album/manage_album');

            }

        }

        $data['subview'] = $this->load->view('admin/album/add_edit_album', $data, true); 

        $this->load->view('admin/_layout_main', $data); // main page

    }





    public function save_album($id = null) {

        $data['title'] = $this->input->post('title', true);

        $data['details'] = $this->input->post('description');
         $data['cat_id'] = $this->input->post('category');
        $data['sub_cat_id'] = $this->input->post('subCat');
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
            // process resize image before upload
                     $configer = array(
                            'image_library' => 'gd2',
                            'source_image' => $val['full_path'],
                            'create_thumb' => FALSE,//tell the CI do not create thumbnail on image
                            'maintain_ratio' => TRUE,
                            'quality' => '40%', //tell CI to reduce the image quality and affect the image size
                            'width' => 400,//new size of image
                            'height' => 250,//new size of image
                        );
                    $this->image_lib->clear();
                    $this->image_lib->initialize($configer);
                    $this->image_lib->resize();
            $data['image'] = $val['path'];
           }
        $this->tbl_album('id'); 
        $news_id = $this->global_model->save($data, $id); 
        $type = 'success';
        $message = 'News Information Successfully Saved';
         set_message($type, $message);
        redirect('admin/album/manage_album');

    }





    public function delete_album($id) {

        $this->tbl_album('id'); 

        $this->global_model->delete($id);

        $type = 'success';

        $message = 'News Information Successfully Delete ';

        set_message($type, $message);

        redirect('admin/album/manage_album');

    }



   

}

