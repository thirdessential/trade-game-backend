<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class News extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        is_valid('admin');
        if(!$this->session->userdata('loginId')){
             redirect('admin/login');
        }
        $this->load->model('global_model');
    }


    public function manage_news($uid = null) {
        $data['title'] = 'Manage News';
        
        $this->tbl_news('id', 'desc'); 
        $where = array();
        $data['all_news'] = $this->global_model->get_by($where); 

        $data['subview'] = $this->load->view('admin/news/manage_news', $data, true);
        $this->load->view('admin/_layout_main', $data);
    }


    public function add_edit_news($id = null) {

        $data['title'] = 'Add News'; 
       if (!empty($id)) { 
            $data['title'] = 'Edit News'; 
            $where = array('id' => $id);
            $this->tbl_news('id', 'desc'); 
            $data['news_info'] = $this->global_model->check_by($where, 'news');
            if (empty($data['news_info'])) { 
                
                $this->message->norecord_found('admin/news/manage_news');
            }
        }
        $data['subview'] = $this->load->view('admin/news/add_edit_news', $data, true); 
        $this->load->view('admin/_layout_main', $data); // main page
    }


    public function save_news($id = null) {
        $data['title'] = $this->input->post('title', true);
        $data['description'] = $this->input->post('description');
       
            $this->tbl_news('id'); 
            $news_id = $this->global_model->save($data, $id); 
            $type = 'success';
            $message = 'News Information Successfully Saved';
       
        set_message($type, $message);
        redirect('admin/news/manage_news');
    }


    public function delete_news($id) {
        $this->tbl_news('id'); 
        $this->global_model->delete($id);
        $type = 'success';
        $message = 'News Information Successfully Delete ';
        //redirect newss to view page
        set_message($type, $message);
        redirect('admin/news/manage_news');
    }

   
}
