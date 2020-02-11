<?php



defined('BASEPATH') OR exit('No direct script access allowed');



class Video extends Admin_Controller {



    public function __construct() {

        parent::__construct();

        is_valid('admin');

        if(!$this->session->userdata('loginId')){

             redirect('admin/login');

        }

        $this->load->model('global_model');

    }





    public function manage_video($uid = null) {

        $data['title'] = 'Manage Video';
        $this->tbl_video('id', 'desc'); 
        $where = array();
        $data['all_video'] = $this->global_model->get_by($where); 
        $data['subview'] = $this->load->view('admin/video/manage_video', $data, true);
        $this->load->view('admin/_layout_main', $data);

    }





    public function edit_video($id = null) {



        $data['title'] = 'Add Video'; 
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

            $data['title'] = 'Edit Video'; 

            $where = array('id' => $id);

            $this->tbl_video('id', 'desc'); 

            $data['video_info'] = $this->global_model->check_by($where, 'video');

            if (empty($data['video_info'])) { 

                

                $this->message->norecord_found('admin/video/manage_video');

            }

        }

        $data['subview'] = $this->load->view('admin/video/add_edit_video', $data, true); 

        $this->load->view('admin/_layout_main', $data); // main page

    }





    public function save_video($id = null) {

        $data['title'] = $this->input->post('title', true);

        $data['details'] = $this->input->post('description');
        $data['type_id'] = $this->input->post('type');
        $data['cat_id'] = $this->input->post('category');
        $data['sub_cat_id'] = $this->input->post('subCat');
        $data['album_id'] = $this->input->post('album');
        $data['about_video'] = $this->input->post('about');
       if (!$id) {
            $data['profile_image'] = '';

        }else{
        	$data['id'] = $id;
        }
         

    
        if (!empty($_FILES['profile_picture']['name'])) {
            $old_path = $this->input->post('profile_picture');
            if ($old_path) { // if old path is no empty
                unlink(FCPATH . $old_path);
            } 
            $val = $this->global_model->uploadImage('profile_picture', 'assets/uploads/users/');
            $val == true || redirect('admin/video/manage_video');

            $data['profile_image'] = $val['path'];
           }
         

           if (!empty($_FILES['video']['name'])) {
           	if($_FILES['video']['name']!=base_url() || $_FILES['video']['name']!=''){
           		 $val = $this->global_model->uploadAllfiles('video', 'assets/uploads/video/');
	             $val == true || redirect('admin/video/manage_video');
                 $data['video_link'] = $val['path'];
           	}
           
           }

      
        $this->tbl_video('id'); 
foreach ( $data as $key => $value) {
    $post_items[] = $key . '=' . $value;
}
//create the final string to be posted using implode()
$post_string = implode ('&', $post_items);

//create cURL connection
$curl_connection = 
  curl_init(base_url()."admin/login/savevideo");

//set options
curl_setopt($curl_connection, CURLOPT_CONNECTTIMEOUT, 30);
curl_setopt($curl_connection, CURLOPT_USERAGENT, 
  "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)");
curl_setopt($curl_connection, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl_connection, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl_connection, CURLOPT_FOLLOWLOCATION, 1);

//set data to be posted
curl_setopt($curl_connection, CURLOPT_POSTFIELDS, $post_string);

//perform our request
$result = curl_exec($curl_connection);
echo $result;
//show information regarding the request
//print_r(curl_getinfo($curl_connection));
//echo curl_errno($curl_connection) . '-' . 
curl_error($curl_connection);

//close the connection
curl_close($curl_connection);
      //  header("location:".base_url()."admin/video/?data=".$data);
        // $news_id = $this->global_model->save($data, $id); 
        $type = 'success';
        $message = 'Video Information Successfully Saved';
         set_message($type, $message);
        redirect('admin/video/manage_video');

    }
    




    public function delete_video($id) {

        $this->tbl_video('id'); 

        $this->global_model->delete($id);

        $type = 'success';

        $message = 'News Information Successfully Delete ';

        set_message($type, $message);

         redirect('admin/video/manage_video');
    }



   

}

