<?php

// ini_set('max_execution_time', 0); 
// ini_set('memory_limit','2048M');
// ini_set('upload_max_filesize','2048M');


defined('BASEPATH') OR exit('No direct script access allowed');



class Lession extends Admin_Controller {



    public function __construct() {

        parent::__construct();

        is_valid('admin');

        if(!$this->session->userdata('loginId')){

             redirect('admin/login');

        }

        $this->load->model('global_model');

    }





    public function manage_lession($cid = null) {

        $data['title'] = 'Manage lession';
        $this->tbl_lession('id', 'desc'); 
        $where = array('courseId'=>$cid);
        $data['all_lession'] = $this->global_model->get_by($where); 
        $data['cid'] = $cid; 
        $data['subview'] = $this->load->view('admin/lession/manage_lession', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }
    

    public function edit_lession($cid = null) {
       $data['title'] = 'Add lession'; 
       $data['cid'] = $cid; 

       $data['subview'] = $this->load->view('admin/lession/add_edit_lession', $data, true); 
       $this->load->view('admin/_layout_main', $data); // main page

    }
    public function edit_lession_single($cid = null) {
       $data['title'] = 'Add lession'; 
       $data['cid'] = $cid; 
       if (!empty($cid)) { 

            $data['title'] = 'Edit lession'; 

            $where = array('id' => $cid);

            $this->tbl_lession('id', 'desc'); 

            $data['lession_info'] = $this->global_model->check_by($where, 'lession');

            if (empty($data['lession_info'])) { 
              $this->message->norecord_found('admin/lession/manage_lession');

            }

        }
       
       $data['subview'] = $this->load->view('admin/lession/add_edit_lession', $data, true); 
       $this->load->view('admin/_layout_main', $data); // main page

    }


    public function save_lession($cid = null) {


          if (!empty($_FILES['youtubeVideoLink']['name'])) {
            if($_FILES['youtubeVideoLink']['name']!=base_url() || $_FILES['youtubeVideoLink']['name']!=''){
               $val = $this->global_model->uploadAllfiles('youtubeVideoLink', 'assets/uploads/video/');
              // $val == true || redirect('admin/video/manage_video');
                 $data['youtubeVideoLink'] = $val['path'];
            }
           }
           if (!empty($_FILES['downloadFile']['name'])) {
            if($_FILES['downloadFile']['name']!=base_url() || $_FILES['downloadFile']['name']!=''){
               $val = $this->global_model->uploadAllfiles('downloadFile', 'assets/uploads/video/');
              // $val == true || redirect('admin/video/manage_video');
                 $data['downloadFile'] = $val['path'];
            }
           }
           

        $data['title'] = $this->input->post('title', true);
        $data['details'] = $this->input->post('description');
       // $data['youtubeVideoLink'] =  $this->input->post('youtubeVideoLink');
        $data['courseId'] = $cid; 
        if (!empty($_FILES['profile_picture']['name'])) {
            $old_path = $this->input->post('profile_picture');
            if ($old_path) { // if old path is no empty
                unlink(FCPATH . $old_path);
            } 
            $val = $this->global_model->uploadImage('profile_picture', 'assets/uploads/users/');
            $val == true || redirect('admin/lession/manage_lession');

            $data['image'] = $val['path'];
           }
        $this->tbl_lession('id'); 

        $news_id = $this->global_model->save($data, null); 
        $type = 'success';
        $message = 'lession Information Successfully Saved';
         set_message($type, $message);
        redirect('admin/lession/manage_lession/'.$cid);

    }
     
       public function update_lession($cid = null) {
          $courserID=$_POST['courserID'];

          if (!empty($_FILES['youtubeVideoLink']['name'])) {
            if($_FILES['youtubeVideoLink']['name']!=base_url() || $_FILES['youtubeVideoLink']['name']!=''){
               $val = $this->global_model->uploadAllfiles('youtubeVideoLink', 'assets/uploads/video/');
              // $val == true || redirect('admin/video/manage_video');
                 $data['youtubeVideoLink'] = $val['path'];
            }
           }
           if (!empty($_FILES['downloadFile']['name'])) {
            if($_FILES['downloadFile']['name']!=base_url() || $_FILES['downloadFile']['name']!=''){
               $val = $this->global_model->uploadAllfiles('downloadFile', 'assets/uploads/video/');
              // $val == true || redirect('admin/video/manage_video');
                 $data['downloadFile'] = $val['path'];
            }
           }
           

        $data['title'] = $this->input->post('title', true);
        $data['details'] = $this->input->post('description');
       // $data['youtubeVideoLink'] =  $this->input->post('youtubeVideoLink');
        //$data['courseId'] = $cid; 
        if (!empty($_FILES['profile_picture']['name'])) {
            $old_path = $this->input->post('profile_picture');
            if ($old_path) { // if old path is no empty
                unlink(FCPATH . $old_path);
            } 
            $val = $this->global_model->uploadImage('profile_picture', 'assets/uploads/users/');
            $val == true || redirect('admin/lession/manage_lession');

            $data['image'] = $val['path'];
           }
        $this->tbl_lession('id'); 

        $news_id = $this->global_model->save($data, $cid); 
        $type = 'success';
        $message = 'lession Information Successfully Update';
        set_message($type, $message);
        redirect('admin/lession/manage_lession/'.$courserID);

    }

  

    public function delete_lession($id) {

        $this->tbl_lession('id'); 

        $this->global_model->delete($id);

        $type = 'success';

        $message = 'lession Information Successfully Delete ';

        set_message($type, $message);

        redirect('admin/course/manage_course');

    }



   

}

