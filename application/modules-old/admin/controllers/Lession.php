<?php



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


    public function save_lession($cid = null) {

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
        //   if (!empty($_FILES['youtubeVideoLink']['name'])) {
        //   // $old_path = $this->input->post('youtubeVideoLink');
        //     if ($old_path) { // if old path is no empty
        //         unlink(FCPATH . $old_path);
        //     } 
        //     $val = $this->global_model->uploadImage('youtubeVideoLink', 'assets/uploads/users/');
        //     $val == true || redirect('admin/lession/manage_lession');

        //     $data['youtubeVideoLink'] = $val['path'];
        //   }
       if (!empty($_FILES['youtubeVideoLink']['name'])) {
           	if($_FILES['youtubeVideoLink']['name']!=base_url() || $_FILES['youtubeVideoLink']['name']!=''){
           		 $val = $this->global_model->uploadAllfiles('youtubeVideoLink', 'assets/uploads/video/');
	            $val == true || redirect('admin/lession/manage_lession');
               $data['youtubeVideoLink'] = $val['path'];
          	}
           
          }
        $this->tbl_lession('id'); 
print_r($data);
die();
        $news_id = $this->global_model->save($data, null); 
        $type = 'success';
        $message = 'lession Information Successfully Saved';
         set_message($type, $message);
        redirect('admin/lession/manage_lession/'.$cid);

    }


  

    public function delete_lession($id) {

        $this->tbl_lession('id'); 

        $this->global_model->delete($id);

        $type = 'success';

        $message = 'lession Information Successfully Delete ';

        set_message($type, $message);

        redirect('admin/lession/manage_lession/'.$id);

    }



   

}

