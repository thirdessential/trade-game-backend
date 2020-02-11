<?php
defined('BASEPATH') or exit('No direct script access allowed');
header('Access-Control-Allow-Origin: *'); 
header('Content-Type: application/json');
class Api extends Admin_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('global_model');
    }
      	public function hash($string) {
        return hash('sha512', $string . config_item('encryption_key'));
    }
    function login()
    {
        $response=[];
        $this->tbl_users('id', 'desc');
        $response['baseurl']=base_url();
        $pass=$this->hash($this->input->post('password'));
        $where = array('email'=>$_POST['email'],'password'=>$pass);
        $userdetails = $this->global_model->get_by($where); 
        if ($userdetails) {
            $response['status']=true;
            $id=$userdetails[0]->id;
            $response['message']="success";
            $response['userdetals']=$userdetails;
           

        }else{
            $response['status']=false;
            $response['message']="Invalid username or password";
        }

        echo json_encode($response);

    }
     function forgotPasswordSendEmail(){
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_users('id', 'desc');
        $where = array('email'=>$this->input->post('email'));

        $userdetails = $this->global_model->get_by($where); 
       // forgotPasswordKey
        if ($userdetails) {
            
            $id=$userdetails[0]->id;
            $email=$userdetails[0]->email;
           // $data['forgotPasswordKey']=rand();
            //$insertid = $this->global_model->save($data, $id);
            $this->load->library('email');

            $this->email->from('kartik3rde@gmail.com', 'Your Name test');
            $this->email->to($email);
            $this->email->cc('shubham3rdee@gmail.com');
            $this->email->bcc('amanbhadrecha875@gmail.com');
            
            $this->email->subject('Email Test');
            $this->email->message('Testing the email class.');
            $this->email->send();
            $otp=rand(1000, 9999);
            $response['status']="true";
            $response['otp']=$otp;
            $response['userId']=$id;
            
            $response['message']="Otp is send to your Email-ID: ". $email . "";
           
        }else{
            $response['status']="false";
            $response['message']="Email id don't match";
        }
        echo json_encode($response);
    }
   
    function loginWithMobile()
    {
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_users('id', 'desc');
        $pass=$this->hash($this->input->post('password'));
        $where = array('mobile'=>$_POST['mobile'],'password'=>$pass);

        $userdetails = $this->global_model->get_by($where); 
        if ($userdetails) {
            $response['message']="success";
            $response['userdetals']=$userdetails;
             $this->tbl_user_meta('id', 'desc');
            $id=$userdetails[0]->id;
            $where = array('userId'=>$id);
            $userdetails = $this->global_model->get_by($where); 
            $response['userMeta']=$userdetails;
        }else{
            $response['message']="User details don't match";
        }

        echo json_encode($response);

    }
    function Registration($id = null)
    {
        $data['firstName']=$name=$_POST['name'];
        $data['email']=$email=$_POST['email'];
        $data['password']=$password=$this->hash($_POST['password']);
        $data['status']=$status="Active";
        $data['user_type']="User";
        $data['mobile']=$contact_number=$_POST['mobile'];
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_users('id', 'desc');
        $where_email = array( 'email'=>$_POST['email'] );
        $where_mobile = array( 'mobile'=>$_POST['mobile'] );
        // $where = array('email'=>$_POST['email'],'mobile'=>$_POST['mobile']);
        $userdetails_email = $this->global_model->get_by( $where_email ); 
        $userdetails_mobile = $this->global_model->get_by( $where_mobile ); 
        if(!empty( $userdetails_email )){
             $response['status']=false;
             $response['message']="Email Id already use.";
        } else if(!empty( $userdetails_mobile )){
             $response['status']=false;
             $response['message']="Mobile Number already use.";
        } else{
           $insertid = $this->global_model->save($data, $id); 
            if ($insertid>=1) { 
                $response['status']=true;
                $response['message']="Registration successfully";
                $where = array('id'=>$insertid);
    
                $userdetails = $this->global_model->get_by($where); 
                $response['userdetals']=$userdetails;
                $id=$userdetails[0]->id;
              }else{
                $response['status']=false;
                $response['message']="Registration Fail please try again.";
            } 
        }
        
       echo json_encode($response);

    }
    
    function SocailRegistration($id = null)
    {
        $data['firstName']=$name=$_POST['name'];
        $data['email']=$email=$_POST['email'];
        $data['status']=$status="Active";
        $data['user_type']=$user_level=$_POST['type'];
        $data['userName']=$_POST['userName'];
        $response=[];
        $response['baseurl']=base_url();

        $this->tbl_users('id', 'desc');
        $where = array('email'=>$_POST['email'],'userName'=>$_POST['userName']);
        $userdetails = $this->global_model->get_by($where); 
        if(!empty($userdetails)){
                $response['userdetals']=$userdetails;
                $id=$userdetails[0]->id;
                $this->tbl_user_meta('id', 'desc');
                $where = array('userId'=>$id);
                $userdetails = $this->global_model->get_by($where); 
                $response['userMeta']=$userdetails;
        }else{
             $insertid = $this->global_model->save($data, $id); 
            if ($insertid>=1) { 
                $response['message']="success";
                $where = array('id'=>$insertid);

                $userdetails = $this->global_model->get_by($where); 
                $response['userdetals']=$userdetails;
                $id=$userdetails[0]->id;
                $this->tbl_user_meta('id', 'desc');
                $where = array('userId'=>$id);
                $userdetails = $this->global_model->get_by($where); 
                $response['userMeta']=$userdetails;
            }else{
                $response['message']="insert fail please try agian";
            }
        }
       
       echo json_encode($response);

    }
    function checkOldPassword(){
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_users('id', 'desc');
        $pass=$this->hash($this->input->post('password'));
        $where = array('password'=>$pass , 'id'=>$this->input->post('id'));
        $userdetails = $this->global_model->get_by($where); 
        if ($userdetails) {
            $response['message']="success";
            $response['userdetals']=$userdetails;
        }else{
            $response['message']="Invalid Password";
        }
        echo json_encode($response);
    }
    function updatePassword(){

        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_users('id', 'desc');
        $pass=$this->hash($this->input->post('password'));
        $data['password']=$pass;
        $id=$this->input->post('id');
      //  $data['user_password']=$_POST['password'];
        $insertid = $this->global_model->save($data, $id);
        if ($insertid) {
            $response['message']="success";
             $response['status']="true";
       }else{
            $response['status']="false";
             $response['message']="Password save fail.";
        }
        echo json_encode($response);
    }

    function getSingleUser()
    {
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_users('id', 'desc');
        $where = array('id'=>$_POST['id']);

        $userdetails = $this->global_model->get_by($where); 
        if ($userdetails) {
            $response['message']="success";
            $response['userdetals']=$userdetails;
            $id=$userdetails[0]->id;
            $this->tbl_user_meta('id', 'desc');
            $where = array('userId'=>$id);
            $userdetails = $this->global_model->get_by($where); 
            $response['userMeta']=$userdetails;
        }else{
            $response['message']="User id not found";
        }

        echo json_encode($response);

    }
    
     function addUserMeta(){
        $id=null;
        $data['metaKey']=$name=$_POST['metaKey'];
        $data['metaValue']=$email=$_POST['metaValue'];
        $data['userId']=$_POST['userId'];
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_user_meta('id', 'desc');
        $insertid = $this->global_model->save($data, $id); 
        if ($insertid>=1) { 
            $response['message']="success";
            $where = array('userId'=>$_POST['userId']);
            $userdetails = $this->global_model->get_by($where); 
            $response['userdetals']=$userdetails;
        }else{
            $response['message']="insert fail please try agian"; 
        }
       echo json_encode($response);
     }
     function getUserMeta(){
        $id=null;
        $data['userId']=$_POST['userId'];
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_user_meta('id', 'desc');
        $response['message']="success";
        $where = array('userId'=>$_POST['userId']);
        $userdetails = $this->global_model->get_by($where); 
        $response['userdetals']=$userdetails;
       
       echo json_encode($response);
     }
    function updateProfile(){
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_users('id', 'desc');
        $data['firstName']=$name=$_POST['name'];
        $data['email']=$email=$_POST['email'];
        $data['mobile']=$contact_number=$_POST['mobile'];
        $id=$this->input->post('id');
        $insertid = $this->global_model->save($data, $id);
        if ($insertid) {
            $response['message']="success";
       }else{
            $response['message']="Update Fail";
        }
        echo json_encode($response);
    }
    function updateBanner(){
         $response=[];
        $response['baseurl']=base_url();
        $this->tbl_users('id', 'desc');
        $id=$this->input->post('id');
         if (!empty($_FILES['banner']['name'])) {
            $old_path = $this->input->post('banner');
            if ($old_path) { // if old path is no empty
                unlink(FCPATH . $old_path);
            } // upload file
            $val = $this->global_model->uploadImage('banner', 'assets/uploads/users/');
           // $val == true || redirect('admin/users/manage_users/Activated');

            $data['banner'] = $val['path'];
           }
        $insertid = $this->global_model->save($data, $id); 
        if ($insertid) {
            $response['message']="success";
            $response['banner']=$data['banner'];
       }else{
            $response['message']="Update Fail";
        }
        echo json_encode($response);
    }
     function updateProfileimage(){
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_users('id', 'desc');
        $id=$this->input->post('id');
         if (!empty($_FILES['profile_picture']['name'])) {
            $old_path = $this->input->post('profile_picture');
            if ($old_path) { // if old path is no empty
                unlink(FCPATH . $old_path);
            } // upload file
            $val = $this->global_model->uploadImage('profile_picture', 'assets/uploads/users/');
           // $val == true || redirect('admin/users/manage_users/Activated');

            $data['image'] = $val['path'];
           }
        $insertid = $this->global_model->save($data, $id);
        if ($insertid) {
            $response['message']="success";
            $response['image']=$data['image'];
       }else{
            $response['message']="Update Fail";
        }
        echo json_encode($response);
    }
    function getExpertByCategory()
    {
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_users('id', 'desc');
        $where = array('category'=>$_POST['category'],'user_type'=>'Expert');
        $select = array('users.*', 'category.title as categoryTitle');
        $join = array('category' => 'users.category = category.id');
        $response['all_expart'] = $this->global_model->get_by_join($where, false, $select, $join); 
        $response['message']="success";

        echo json_encode($response); 

    }
    function getCourse(){
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_course('id', 'desc');
        $where = array();
        $select = array('course.*', 'membership.title as membershipTitle');
        $join = array('membership' => 'course.membershipLeval = membership.id');
        $response['all_expart'] = $this->global_model->get_by_join($where, false, $select, $join); 
        $response['message']="success";
        echo json_encode($response); 
    }
    function getCourseWithMembership(){
        $response=[];
        $this->tbl_membership('id', 'asc'); 
        $where = array();
        $response['action']='success';
        $response['baseurl']=base_url();
        $response['all_Membership'] = $this->global_model->get_by($where); 
        $courses =array();
        foreach($response['all_Membership'] as $membeshipLevel){
            $this->tbl_course('id', 'asc'); 
            $where = array('membershipLeval'=>$membeshipLevel->id);
            $course = $this->global_model->get_by($where);  
            array_push($courses ,$course);
        }
        $response['courses']=$courses;
        echo json_encode($response);
        
    }
    
    function getSingleCourse($id){
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_course('id', 'desc');
        $where = array('id'=>$id);
        $response['action']='success';
        $response['baseurl']=base_url();
        $response['singleCourse'] = $this->global_model->get_by($where); 
        echo json_encode($response);
    }
    
    function getSingleCourseLession($id){
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_lession('id', 'asc');
        $where = array('courseId'=>$id);
        $response['action']='success';
        $response['baseurl']=base_url();
        $response['singleCourseLession'] = $this->global_model->get_by($where); 
        echo json_encode($response);
    }
    
    
    
     function getQuizByCourse($id){
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_quiz('id', 'desc');
        $where = array('courseId'=>$id);
        $response['all_quiz'] =$this->global_model->get_by($where); 
        $response['message']="success";
        echo json_encode($response); 
    }
    
    
   function getCategory()
    {
        $response=[];
         $this->tbl_category('id', 'desc'); 
        $where = array();
        $response['action']='success';
        $response['baseurl']=base_url();
        $response['all_category'] = $this->global_model->get_by($where); 
        echo json_encode($response);
    }
    function getSubCategory()
    {
        $response=[];
        $this->tbl_subCat('id', 'desc'); 
        $where = array('category_id'=>$_POST['cat_id']);
        $response['action']='success';
        $response['baseurl']=base_url();
        $response['all_Subcategory'] = $this->global_model->get_by($where); 
        echo json_encode($response);
    }

    function addShow(){
        $data['title']=$name=$_POST['title'];
        $data['details']=$email=$_POST['details'];
        $data['category']=$_POST['category'];
        $data['fileLink']='';
        $data['postBy']=$_POST['postBy'];
        $data['subCategory']=$_POST['subCategory'];
        $data['totalView']=0;
        $data['totalLike']=0;
        $data['totalComment']=0;
        $data['totalDownlaod']=0;
        $data['review']=0;
        $data['total_share']=0;
        $id=null;

        if (!empty($_FILES['banner']['name'])) {
            $old_path = $this->input->post('banner');
            if ($old_path) { // if old path is no empty
                unlink(FCPATH . $old_path);
            } 
            $val = $this->global_model->uploadImage('banner', 'assets/uploads/users/');
            //$val == true || redirect('admin/video/manage_video');
             $data['bannerImage'] = $val['path'];
           }
          if (!empty($_FILES['media']['name'])) {
            if($_FILES['media']['name']!=base_url() || $_FILES['media']['name']!=''){
                 $val = $this->global_model->uploadAllfiles('media', 'assets/uploads/video/');
                 $data['fileLink'] = $val['path'];
            }
          }
          $this->tbl_show('id', 'desc');
          $insertid = $this->global_model->save($data, $id); 
        if ($insertid>=1) { 
            $this->tbl_users('id', 'desc');
            $where = array('id' => $data['postBy'] );
            $userData=$this->global_model->get_by($where);
            $mediaTotal= $userData[0]->totalMedia + 1 ;
            $update['totalMedia']=$mediaTotal;
            $this->global_model->save($update, $data['postBy']); 
            $response['message']="success";
        }else{
            $response['message']="insert fail please try agian"; 
        }
       echo json_encode($response);

    }

    function getShow()
    {
        $response=[];
         $this->tbl_show('id', 'desc'); 
        $where = array();
        $response['action']='success';
        $response['baseurl']=base_url();
       
         $select = array('post.*', 'category.title as categoryTitle','subCat.title as subCatTitle' , 'users.firstName as postByName' , 'users.totalMedia as totalMedia' );
        $join = array('category' => 'post.category = category.id','subCat'=>'subCat.id=post.subCategory','users'=>'users.id=post.postBy');

        $response['all_show'] = $this->global_model->get_by_join($where, false, $select, $join);

        $response['all_show'] = $this->global_model->get_by_join($where, false, $select, $join); 


        echo json_encode($response);
    }
    function getShowByCat()
    {
        $response=[];
         $this->tbl_show('id', 'desc'); 
        $where = array('post.category'=>$_POST['cat_id']);
        $response['action']='success';
        $response['baseurl']=base_url();
        $select = array('post.*', 'category.title as categoryTitle','subCat.title as subCatTitle' , 'users.firstName as postByName' , 'users.totalMedia as totalMedia');
        $join = array('category' => 'post.category = category.id','subCat'=>'subCat.id=post.subCategory','users'=>'users.id=post.postBy');

        $response['all_show'] = $this->global_model->get_by_join($where, false, $select, $join);
        echo json_encode($response);
    }
    function getShowBySubCat()
    {
        $response=[];
        $this->tbl_show('id', 'desc'); 
        $where = array('post.subCategory'=>$_POST['subcat_id']);
        $response['action']='success';
        $response['baseurl']=base_url();
        $select = array('post.*', 'category.title as categoryTitle','subCat.title as subCatTitle' , 'users.firstName as postByName' , 'users.totalMedia as totalMedia' );
        $join = array('category' => 'post.category = category.id','subCat'=>'subCat.id=post.subCategory','users'=>'users.id=post.postBy');

        $response['all_show'] = $this->global_model->get_by_join($where, false, $select, $join);
        echo json_encode($response);
    }
    function getShowByUser()
    {
        $response=[];
         $this->tbl_show('id', 'desc'); 
        $where = array('postBy'=>$_POST['user_id']);
        $response['action']='success';
        $response['baseurl']=base_url();
        $response['all_show'] = $this->global_model->get_by($where); 
        echo json_encode($response);
    }
    function getSingleShow()
    {
        $response=[];
         $this->tbl_show('id', 'desc'); 
        $where = array('id'=>$_POST['id']);
        $response['action']='success';
        $response['baseurl']=base_url();
        $response['all_show'] = $this->global_model->get_by($where); 
        echo json_encode($response);
    }
    function like($id = null){
        $data['type']=$_POST['type'];
        $data['like_by']=$_POST['like_by'];
        $data['like_to']=$_POST['like_to'];
        $response=[];
        $this->tbl_like('id', 'desc'); 
        $where = array('type'=>$_POST['type'],'like_by'=>$_POST['like_by'],'like_to'=>$_POST['like_to']);
        if($this->global_model->get_by($where)){
             $response['action']='success';
             $response['Message']='You have been already like this';
        }else{

            $insertid = $this->global_model->save($data, $id); 
            if( $insertid){
                if($_POST['type']=='Post'){
                  $this->tbl_show('id', 'desc');
                  $where = array('id'=>$_POST['like_to']);
                  $userdetails = $this->global_model->get_by($where);
                  $totalLike=$userdetails[0]->totalLike+1;
                  $like['totalLike']=$totalLike;
                  $this->global_model->save($like, $_POST['like_to']);
                }
                if($_POST['type']=='User'){
                  $this->tbl_users('id', 'desc');
                  $where = array('id'=>$_POST['like_to']);
                  $userdetails = $this->global_model->get_by($where);
                  $totalLike=$userdetails[0]->totalLike+1;
                  $like['totalLike']=$totalLike;
                  $this->global_model->save($like, $data['like_to']);
                }
                $response['action']='success';
                $response['Message']='Like success';
            }
        }
        echo json_encode($response);
    }
    //total_share
    function addView($id = null){
        $data['view_by']=$_POST['view_by'];
        $data['view_to']=$_POST['view_to'];
        $response=[];
        
                  $this->tbl_show('id', 'desc');
                  $where = array('id'=>$_POST['view_to']);
                  $userdetails = $this->global_model->get_by($where);
                  $view_to=$userdetails[0]->totalView +1;
                  $like['totalView']=$view_to;
                  $this->global_model->save($like, $_POST['view_to']);
                
                $response['action']='success';
                $response['Message']='View success';
            
        
        echo json_encode($response);
    }
    function addShare($id = null){
        $response=[];
        
                  $this->tbl_show('id', 'desc');
                  $where = array('id'=>$_POST['share_to']);
                  $userdetails = $this->global_model->get_by($where);
                  $view_to=$userdetails[0]->total_share +1;
                  $like['total_share']=$view_to;
                  $this->global_model->save($like, $_POST['share_to']);
                
                $response['action']='success';
                $response['Message']='View success';
            
        
        echo json_encode($response);
    }
     function addDownlaod($id = null){
        $response=[];
        
                  $this->tbl_show('id', 'desc');
                  $where = array('id'=>$_POST['download_to']);
                  $userdetails = $this->global_model->get_by($where);
                  $view_to=$userdetails[0]->totalDownlaod +1;
                  $like['totalDownlaod']=$view_to;
                  $this->global_model->save($like, $_POST['download_to']);
                
                $response['action']='success';
                $response['Message']='View success';
            
        
        echo json_encode($response);
    }
    function follow($id = null){
        $data['f_by']=$_POST['f_by'];
        $data['f_to']=$_POST['f_to'];
        $response=[];
        $this->tbl_follow('id', 'desc'); 
        $where = array('f_by'=>$_POST['f_by'],'f_to'=>$_POST['f_to']);
        if($this->global_model->get_by($where)){
             $response['action']='success';
             $response['Message']='You have been already Follow this';
        }else{
            $insertid = $this->global_model->save($data, $id); 
            if( $insertid){
                
                  $this->tbl_users('id', 'desc');
                  $where = array('id'=>$_POST['f_to']);
                  $userdetails = $this->global_model->get_by($where);
                  $followers=$userdetails[0]->followers+1;
                  $f_to['followers']=$followers; 
                  $this->global_model->save($f_to, $data['f_to']);

                  $where = array('id'=>$_POST['f_by']);
                  $userdetails = $this->global_model->get_by($where);
                  $folloing=$userdetails[0]->folloing+1;
                  $fby['folloing']=$folloing;
                  $this->global_model->save($fby, $data['f_by']);
                  $response['action']='success';
                  $response['Message']='Follow success';
            }
        }
        echo json_encode($response);
    }
    function unfollow($id = null){
        $data['f_by']=$_POST['f_by'];
        $data['f_to']=$_POST['f_to'];
        $response=[];
        $this->tbl_follow('id', 'desc'); 
        $where = array('f_by'=>$_POST['f_by'],'f_to'=>$_POST['f_to']);
        if($follo=$this->global_model->get_by($where)){

             $this->global_model->delete($follo[0]->id);
               
                      $this->tbl_users('id', 'desc');
                      $where = array('id'=>$_POST['f_to']);
                      $userdetails = $this->global_model->get_by($where);
                      $followers=$userdetails[0]->followers-1;
                      $f_to['followers']=$followers; 
                      $this->global_model->save($f_to, $data['f_to']);

                      $where = array('id'=>$_POST['f_by']);
                      $userdetails = $this->global_model->get_by($where);
                      $folloing=$userdetails[0]->folloing-1;
                      $fby['folloing']=$folloing;
                      $this->global_model->save($fby, $data['f_by']);
                      $response['action']='success';
                      $response['Message']='UnFollow success';
                
        }else{
             $response['action']='success';
             $response['Message']='User did not follow this parson';
           
        }
        echo json_encode($response);
    }


    function comment($id = null){
        $data['commentType']=$_POST['type'];
        $data['c_to']=$_POST['c_to'];
        $data['c_by']=$_POST['c_by'];
        $data['rating']=$_POST['rating'];
        $data['comment']=$_POST['comment'];
        $response=[];
        $this->tbl_comment('id', 'desc'); 
        $a=$this->global_model->directQuery("SELECT AVG(rating) AS AveragePrice from `comment` WHERE `c_to`= ".$data['c_to']." AND `commentType`='".$data['commentType']."'");
        
        $insertid = $this->global_model->save($data, $id); 
            if( $insertid){
                if($_POST['type']=='Post'){
                  $this->tbl_show('id', 'desc');
                  $where = array('id'=>$_POST['c_to']);
                  $userdetails = $this->global_model->get_by($where);
                  $totalComment=$userdetails[0]->totalComment+1;
                  $like['totalComment']=$totalComment;
                  $like['review']=$a[0]->AveragePrice;
                  $this->global_model->save($like, $_POST['c_to']);
                }
                if($_POST['type']=='User'){

                  $this->tbl_users('id', 'desc');
                  $where = array('id'=>$_POST['c_to']);
                  $userdetails = $this->global_model->get_by($where);
                  $totalComment=$userdetails[0]->totalComment+1;
                  $like['totalComment']=$totalComment;
                  $like['totalRating']=$a[0]->AveragePrice;
                  $this->global_model->save($like, $data['c_to']);
                }
                $response['action']='success';
                $response['Message']='Like success';
            }

        
        echo json_encode($response);
    }
    function commentList($id = null){
        $data['commentType']=$name=$_POST['type'];
        $data['c_to']=$name=$_POST['id'];
        $response=[];
        $this->tbl_comment('id', 'desc'); 
        if($_POST['type']=='Post'){
                  // $this->tbl_show('id', 'desc');
                   $where = array('c_to'=>$_POST['id'],'commentType'=>'Post');
                   $select = array('comment.*', 'users.firstName as userFullName','users.image as userImage','users.id as userId');
                   $join = array('users' => 'comment.c_by = users.id');
                   $response['all_comment'] = $this->global_model->get_by_join($where, false, $select, $join); 
                     
                }
                if($_POST['type']=='User'){

                  //$this->tbl_users('id', 'desc');
                  $where = array('comment.c_to'=>$_POST['id'],'comment.commentType'=>'User');
                  $select = array('comment.*', 'users.firstName as userFullName','users.image as userImage','users.id as userId');
                  $join = array('users' => 'comment.c_by = users.id');
                  $response['all_comment'] = $this->global_model->get_by_join($where, false, $select, $join); 
                }
                $response['action']='success';
               
          
        

        echo json_encode($response); 

    }
     
    function subscribe($id = null){
        $data['email']=$_POST['email'];
        $data['subscribeTo']=$_POST['subscribeTo'];
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_subscribe('id', 'desc');
        $insertid = $this->global_model->save($data, $id); 
        if ($insertid>=1) { 
            $response['action']="success";
            $response['message']="subscribe success"; 
        }else{
            $response['action']="Fail"; 
            $response['message']="insert fail please try agian"; 
        }
       echo json_encode($response);
     }
     function Unsubscribe($id = null){
        $data['email']=$_POST['email'];
        $data['subscribeTo']=$_POST['subscribeTo'];
        $response=[];
        $response['baseurl']=base_url();
        $this->tbl_subscribe('id', 'desc');
        $where = array('email'=>$_POST['email'],'subscribeTo'=>$_POST['subscribeTo']);
        
         if($follo=$this->global_model->get_by($where)){
            $this->global_model->delete($follo[0]->id);
            $response['action']="success";
            $response['message']="Unsubscribe success"; 
        }else{
            $response['action']="Fail"; 
            $response['message']="insert fail please try agian"; 
        }
       echo json_encode($response);
     }
 
    function addNotification($id = null){
         $data['addBy']=$_POST['addBy'];
         $data['heading']=$_POST['heading'];
         $data['details']=$_POST['details'];
         $this->tbl_notification('id', 'desc');
          $insertid = $this->global_model->save($data, $id); 
            if ($insertid>=1) { 
                $response['action']="success";
                $response['message']="Notification add success"; 
            }else{
                $response['action']="Fail"; 
                $response['message']="insert fail please try agian"; 
            }
           echo json_encode($response);

     }

     function notificationByUser($id=null){
        $data['addBy']=$_POST['userId'];
        $this->tbl_notification('id', 'desc');
        $where = array('addBy'=>$_POST['userId']);
        $notiList=$this->global_model->get_by($where);
        $response=[];
        if(!empty($notiList)){
            $response['action']="success";
            $response['list']=$notiList; 
        }else{
            $response['action']="success";
            $response['message']="No data in user list"; 
        }
        echo json_encode($response);
     }
    function get_yahoo_finance_curl_request(  $url, $params ){

        $curl = curl_init();
       
        $send_url = $url."?".http_build_query( $params );
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => $send_url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "x-rapidapi-host: apidojo-yahoo-finance-v1.p.rapidapi.com",
            "x-rapidapi-key: 192881900fmsh83b21139b9eda59p108ca9jsnefb28bb236fa"
          ),
        ));

        $response = curl_exec($curl);
        
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {

          // echo "cURL Error #:" . $err;
        return array('error' => $err);
        } else {
          return json_decode($response);
        }
    }
     function get_yahoo_goute( ){
        // $notiList = array("1"=>'test', '2' => 'dummy');
        $symbol = trim( $_REQUEST['symbol'] ); 
        $range =  trim( $_REQUEST['range'] );
        if(isset( $_REQUEST['interval']) && ( trim(  $_REQUEST['interval'] ) != '' ) ){
            $interval =  trim(  $_REQUEST['interval']) ;
        }else{
            $interval = "1d" ;
        }
        
        $params = array("region" => "US",
            "lang" => "en",
            "symbol" => $symbol,
            "interval" => $interval,
            "range" => $range
        );
        // print_r($params);
        // $output_data1 = $params;
        $html = 'https://relentless.doitsindia.com/tradeGame/test/';


        $url = 'https://apidojo-yahoo-finance-v1.p.rapidapi.com/stock/v2/get-chart';

     // Create a new file
        $APPPATH = str_replace('/application', '', APPPATH).'tradeGame/test/';
       
        // $html_url = 'https://relentless.doitsindia.com/tradeGame/test/'.$chartFile;
        
        // Create CSV file  //
         $chartCSVFile = $APPPATH.'chartCSV_'.trim( $symbol ).'_'.trim( $range ).'.csv';
         $chart_csv_file_url = base_url().'tradeGame/test/chartCSV_'.trim( $symbol ).'_'.trim( $range ).'.csv';
         $myCsvFile = fopen($chartCSVFile, "w");
         // save the column headers
        fputcsv( $myCsvFile, array('Date', 'Open', 'High', 'Low', 'Close', 'Adj Close', 'Volume'));
         $output_data_tt = $this->get_yahoo_finance_curl_request( $url, $params  );
       $csv_data_array = array();
      
        
        $output_status = 'error';
       if( isset($output_data_tt->chart->result[0]->timestamp)){
            $timZone = $output_data_tt->chart->result[0]->meta->exchangeTimezoneName;
       	    date_default_timezone_set($timZone);
       		foreach ( $output_data_tt->chart->result[0]->timestamp as $key => $val_data ) {
                $output_status = 'success';
       			$temp = array();
       			array_push( $temp,  date("Y-m-d",$val_data) ); // timestap
               
                
       			array_push( $temp, $output_data_tt->chart->result[0]->indicators->quote[0]->open[$key] ); // open
       			array_push( $temp, $output_data_tt->chart->result[0]->indicators->quote[0]->high[$key] ); // high
       			array_push( $temp, $output_data_tt->chart->result[0]->indicators->quote[0]->low[$key] ); // low
       			array_push( $temp, $output_data_tt->chart->result[0]->indicators->quote[0]->close[$key] ); // close
       			if( isset( $output_data_tt->chart->result[0]->indicators->adjclose[0]->adjclose ) ){
                    array_push( $temp, $output_data_tt->chart->result[0]->indicators->adjclose[0]->adjclose[$key] ); //Adj Close
                }else{
                    array_push( $temp, $output_data_tt->chart->result[0]->indicators->quote[0]->close[$key] ); //Adj Close

                }
       			
       			array_push( $temp, $output_data_tt->chart->result[0]->indicators->quote[0]->volume[$key] ); // volume
       			array_push( $csv_data_array , $temp);
       		  
       		}

       		// save each row of the data
	        foreach ($csv_data_array as $row)
	        {
	        fputcsv($myCsvFile, $row);
	        }
	        // Close the file
	        fclose($myCsvFile);
       
       }
        

        $html = '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1 minimum-scale=1 user-scalable=no">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <title>Candlestick</title>
            </head>
            <link rel="stylesheet" href="stylesheet.css">
            <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
            <style>
            body{
                margin: 0 !important;
            }
            </style>
            <body>
                <script src="https://d3js.org/d3.v5.min.js"></script>
                <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>
                <script type="text/javascript">var chart_file_path = "'. $chart_csv_file_url.'"</script>
                <script src="https://relentless.doitsindia.com/tradeGame/test/chart_script.js"></script>

                <svg id="container"></svg>
                
            </body>
            </html>';

             $chartFile = $APPPATH.'chartname_'.trim( $symbol ).'_'.trim( $range ).'.html';
             $html_url = base_url().'tradeGame/test/'.$chartFile;
            $myfile = fopen($chartFile, "w");
            fwrite($myfile, $html);
            fclose($myfile);
        $response=[];
        $response['action'] = $output_status;
        
        $response['response_data'] = $html_url;
         echo json_encode($response);

    }

    /** User can Buy a company Share
     * Means User can trade
     * API URL https://relentless.doitsindia.com/api/TG_user_buy_company_share/?user_id=104&symbol=HYDR.ME&share_unit=10
     **/
    function TG_user_buy_company_share( ){
        if(isset($_REQUEST['user_id'], $_REQUEST['symbol'], $_REQUEST['share_unit'] ) ){

            $user_id = trim( $_REQUEST['user_id'] ); 
            $symbol = trim ( $_REQUEST['symbol'] );
            $share_unit = trim( $_REQUEST['share_unit'] );
            
            $response=[];
            $response['baseurl']=base_url();
            $this->tbl_users('id', 'desc');
            $where = array('id'=> $user_id);

            $userdetails = $this->global_model->get_by($where); 
            if ($userdetails) {
                $current_balance = $userdetails[0]->total_balance;
                $params = array('region' => 'US',
                    'lang' => 'en',
                    'symbol' => $symbol,
                    'interval' => '1d',
                    'range' => '1d'
                );
                 $url = 'https://apidojo-yahoo-finance-v1.p.rapidapi.com/stock/v2/get-chart';

                $yahoo_response =  $this->get_yahoo_finance_curl_request( $url, $params  );
                if( isset($yahoo_response->chart->result[0]->meta->chartPreviousClose)){
                    $chart_previous_close = $yahoo_response->chart->result[0]->meta->chartPreviousClose;
                    $total_purchase = $chart_previous_close * $share_unit;

                    $data['user_id'] = $user_id;
                    $data['currency_symbol'] = $symbol;
                    $data['purchased_unit'] = $share_unit;
                    $data['remaining_unit'] = $share_unit;
                    $data['total_purchase_price'] = $total_purchase;
                    $data['chart_previous_close_price'] = $chart_previous_close;
                     
                    $this->tbl_buy_transactions('id', 'desc');
                    $insertid = $this->global_model->save($data, $id = null ); 
                    if ($insertid>=1) { 
                        $remaining_balance = $current_balance - $total_purchase;
                        $this->tbl_users('id', 'desc');
                        $this->global_model->save( array( 'total_balance' => $remaining_balance), $user_id );

                    $response['action'] = "success";
                    $response['insertid'] = $insertid;
                    $response['message'] = "Buy successfully"; 
                    }else{
                        $response['action'] = "Fail"; 
                        $response['message'] = "insert fail please try agian"; 
                    }

                    echo json_encode($response);
                    exit();
                }
                $response['action'] = "Fail"; 
                $response['message'] = "Yahoo finance API not giving close price"; 
               
                echo json_encode($response);
                exit();
            }
        }else {

                echo json_encode(array('action' => 'error', 'message' => 'Invalid Request.'));
                exit();
             
            }
    }

    function calculate_single_sale_unit( $sale_unit, $remaining_unit ) {

        if( $sale_unit == $remaining_unit  && $sale_unit > 0 ) {
            $output_array['remaining'] = 0;
            $output_array['single_sale'] = $sale_unit;
        }else if( ($sale_unit > $remaining_unit) && $sale_unit > 0 ){
            $output_array['remaining'] = $sale_unit - $remaining_unit;
            $output_array['single_sale'] = $remaining_unit;
        }else if( ($sale_unit < $remaining_unit)  && $sale_unit > 0 ){
            $output_array['remaining'] = 0;
            $output_array['single_sale'] = $sale_unit;
        }else{
             $output_array['remaining'] = 0;
            $output_array['single_sale'] = 0;
        }
        return $output_array;
    }

    /**
     *  User can sale share units
     *
     *
     */

    function TG_user_sale_company_share( ){

        if( isset( $_REQUEST['user_id'], $_REQUEST['symbol'], $_REQUEST['sale_unit'] ) ) {
             
            $user_id = trim( $_REQUEST['user_id'] );
            $symbol = trim( $_REQUEST['symbol'] );
            $sale_unit = trim( $_REQUEST['sale_unit'] );
            $response=[];
            $response['baseurl']=base_url();
            $this->tbl_users('id', 'desc');
            $where = array('id'=> $user_id);

            $userdetails = $this->global_model->get_by($where);
            if( $userdetails ){
                $current_balance = $userdetails[0]->total_balance;
                $params = array('region' => 'US',
                    'lang' => 'en',
                    'symbol' => $symbol,
                    'interval' => '1d',
                    'range' => '1d'
                );
                $url = 'https://apidojo-yahoo-finance-v1.p.rapidapi.com/stock/v2/get-chart';
                $new_balance = 0;
                $yahoo_response =  $this->get_yahoo_finance_curl_request( $url, $params  );
                if( isset( $yahoo_response->chart->result[0]->meta->chartPreviousClose ) ) {
                    $chart_previous_close = $yahoo_response->chart->result[0]->meta->chartPreviousClose;
                    $this->tbl_buy_transactions('id', 'desc');
                    $get_buy_transactions = $this->tbl_buy_transactions('id', 'ASC');
                    $where = array( 'user_id '=> $user_id,
                        'currency_symbol' => $symbol,

                    );
                    $get_buy_transactions = $this->global_model->get_by($where);
                    foreach ( $get_buy_transactions  as $key => $single_data ) {

                        // check remaing unit greater
                        $total_sale_price = 0;
                        if ( $single_data->remaining_unit > 0 && $sale_unit > 0 ) {
                            $cal_data = $this->calculate_single_sale_unit( $sale_unit, $single_data->remaining_unit);
                           
                            $sale_unit = $cal_data['remaining'];
                            $total_sale_price = $cal_data['single_sale'] * $chart_previous_close;
                            $data['buy_id'] = $single_data->id;
                            $data['user_id'] = $user_id;
                            $data['currency_symbol'] = $symbol;
                            $data['sale_unit'] = $cal_data['single_sale'];
                            $data['buy_close_price'] = $single_data->chart_previous_close_price;
                            $data['sale_close_price'] = $chart_previous_close;
                            $data['total_sale_price'] = $total_sale_price;
                            $this->tbl_sale_transactions('id', 'desc');
                            $new_balance = $new_balance + ($total_sale_price );
                            $insertid = $this->global_model->save($data, $id = null );
                            if( $insertid ){
                                $new_balance = $current_balance + $total_sale_price;
                                $current_balance = $new_balance;
                                $remaining_qnty = $single_data->remaining_unit - $cal_data['single_sale'];
                                $this->tbl_buy_transactions('id', 'desc');
                                $this->global_model->save( array( 'remaining_unit' => $remaining_qnty), $single_data->id );

                                $this->tbl_users('id', 'desc');
                                $this->global_model->save( array( 'total_balance' => $new_balance), $user_id );

                            }

                        }

                       
                    } //endforeach;

                }
            }

        }
        echo json_encode( array('action' => 'error', 'message' => 'Invalid Request.') );
        exit();

    }
   
}