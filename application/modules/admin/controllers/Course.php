<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Course extends Admin_Controller {



    public function __construct() {

        parent::__construct();

        is_valid('admin');

        if(!$this->session->userdata('loginId')){

             redirect('admin/login');

        }

        $this->load->model('global_model');

    }





    public function manage_course($uid = null) {

        $data['title'] = 'Manage Course';
        $this->tbl_course('id', 'desc'); 
        $where = array();
        $data['all_course'] = $this->global_model->get_by($where); 
        $data['subview'] = $this->load->view('admin/course/manage_course', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }
    public function manage_quiz($uid = null) {

        $data['title'] = 'Manage Quiz';
        $data['course_id'] = $uid;
        $this->tbl_quiz('id', 'desc'); 
        $where = array('courseId'=>$uid);
        $data['all_course'] = $this->global_model->get_by($where); 
        $data['subview'] = $this->load->view('admin/course/quizList', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }

   
      public function edit_quiz($id = null) {
          $data['title'] = 'Add Quiz'; 
          $data['course_id'] = $id;
          $data['subview'] = $this->load->view('admin/course/add_quiz', $data, true); 
          $this->load->view('admin/_layout_main', $data); // main page

    }


    public function edit_course($id = null) {
        $this->tbl_membership('id', 'desc'); 
        $where = array();
        $data['all_membership'] = $this->global_model->get_by($where);


        $data['title'] = 'Add Course'; 

       if (!empty($id)) { 

            $data['title'] = 'Edit Course'; 

            $where = array('id' => $id);

            $this->tbl_course('id', 'desc'); 

            $data['course_info'] = $this->global_model->check_by($where, 'course');

            if (empty($data['course_info'])) { 

                 $this->message->norecord_found('admin/course/manage_course');

            }

        }

        $data['subview'] = $this->load->view('admin/course/add_edit_course', $data, true); 

        $this->load->view('admin/_layout_main', $data); // main page

    }




       public function save_quiz($id = null) {

        $data['title'] = $this->input->post('title', true);
        $data['details'] = $this->input->post('description');
        $data['ans1'] = $this->input->post('ans1');
        $data['ans2'] = $this->input->post('ans2');
        $data['ans3'] = $this->input->post('ans3');
        $data['ans4'] = $this->input->post('ans4');
        $data['courseId'] = $id;
        $data['currectAns'] = $this->input->post('currectAns');
        $this->tbl_quiz('id'); 
        $news_id = $this->global_model->save($data, null); 
        $type = 'success';
        $message = 'Quiz Information Successfully Saved';
         set_message($type, $message);
        redirect('admin/course/manage_quiz/'.$id);

    }
    
    
    
    


    public function save_course($id = null) {

        $data['title'] = $this->input->post('title', true);
        $data['shortDetails'] = $this->input->post('shortDetails');
        $data['details'] = $this->input->post('description');
        $data['membershipLeval'] = $this->input->post('membershipLeval');
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
        $this->tbl_course('id'); 
        $news_id = $this->global_model->save($data, $id); 
        $type = 'success';
        $message = 'Course Information Successfully Saved';
         set_message($type, $message);
        redirect('admin/course/manage_course');

    }


    
    public function delete_quiz($id) {

        $this->tbl_quiz('id'); 

        $this->global_model->delete($id);

        $type = 'success';

        $message = 'Quiz Information Successfully Delete ';

        set_message($type, $message);

        redirect('admin/course/manage_course');

    }

    public function delete_course($id) {

        $this->tbl_course('id'); 

        $this->global_model->delete($id);

        $type = 'success';

        $message = 'Course Information Successfully Delete ';

        set_message($type, $message);

        redirect('admin/course/manage_course');

    }



   

}

