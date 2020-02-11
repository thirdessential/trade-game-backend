<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Show extends Admin_Controller {



    public function __construct() {

        parent::__construct();

        is_valid('admin');

        if(!$this->session->userdata('loginId')){

             redirect('admin/login');

        }

        $this->load->model('global_model');

    }





    public function manage_show($uid = null) {
        $data['title'] = 'Manage Show';
        $this->tbl_show('id', 'desc'); 
        $where = array();
        $data['all_show'] = $this->global_model->get_by($where); 
        $data['subview'] = $this->load->view('admin/show/manage_show', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
     public function show_by_user($uid = null) {
        $data['title'] = 'Manage Show';
        $this->tbl_show('id', 'desc'); 
        $where = array('postBy'=>$uid);
        $data['all_show'] = $this->global_model->get_by($where); 
        $data['subview'] = $this->load->view('admin/show/showByUser', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }
 
    public function show_single($uid = null){
        $data['title'] = 'Single Show'; 
        $this->tbl_show('id', 'desc'); 
        $where = array('post.id'=>$uid); 
       // $data['show'] = $this->global_model->get_by($where); 
         $select = array('post.*', 'category.title as categoryTitle','subCat.title as subCatTitle','users.firstName as username','users.image as profileImage');
       
        $join = array('category' => 'post.category = category.id','subCat'=>'subCat.id=post.subCategory','users'=>'users.id=post.postBy');
        $data['show'] = $this->global_model->get_by_join($where, false, $select, $join); 


        $this->tbl_review('id', 'desc'); 
        $where = array('reviewTo'=>$uid,'type'=>'post');
        $data['review'] = $this->global_model->get_by($where); 

        
        $data['subview'] = $this->load->view('admin/show/showSingle', $data, true);


        $this->load->view('admin/_layout_main', $data);
    }




    public function edit_show($id = null) {

 

        $data['title'] = 'Add Show'; 

       if (!empty($id)) { 

            $data['title'] = 'Edit Show'; 

            $where = array('id' => $id);

            $this->tbl_show('id', 'desc'); 

            $data['show_info'] = $this->global_model->check_by($where, 'post');

            if (empty($data['show_info'])) { 

                

                $this->message->norecord_found('admin/show/manage_show');

            }

        }

        $data['subview'] = $this->load->view('admin/show/add_edit_show', $data, true); 

        $this->load->view('admin/_layout_main', $data); // main page

    }





    public function save_show($id = null) {

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

