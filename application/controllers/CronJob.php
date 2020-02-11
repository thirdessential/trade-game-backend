<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class CronJob extends admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('global_model');
        
    }

    public function userLevelManage(){
    	
        $this->tbl_activated_user('id', 'asc');
        $w_activateUser = array('deleted_at' => Null); 
        $s_activateUser = array('id','user_id', 'parent_id');
        $activateUser = $this->global_model->get_by($w_activateUser, false, Null, Null, $s_activateUser);
        if(!empty($activateUser)){
            foreach ($activateUser as $value) {

                $this->tbl_users('id'); 
                $w_user = array('id' => $value->user_id);
                $s_user = array('id','user_level', 'userId','parent_id');
                $user_info = $this->global_model->get_by($w_user, true, Null, Null, $s_user);
                
                if(!empty($user_info)){

                    if($user_info->user_level == 0){
                        // total user above particual user id
                        $total_user = $this->totalUser($value->id);
                        
                        if($total_user >= 100){
                            // total direct user to self user
                            $total_direct = $this->totalDirect($value->id ,$value->user_id);

                            if($total_direct > 0){

                                $check = $this->levelUpdateForUser($user_info->id, '1');

                                $total_amount = 150;
                                $direct_user = 1;
                                $level = 1;

                                $payemt_id = $this->orderPayments($user_info->id, $user_info->parent_id, $total_amount, $level, $direct_user);
                                
                            }

                        }

                    }
                    else if($user_info->user_level == 1){
                        // total user above particual user id
                        $total_user = $this->totalUser($value->id);
                        
                        if($total_user >= 300){
                            // total direct user to self user
                            $total_direct = $this->totalDirect($value->id, $value->user_id);

                            if($total_direct >= 2){

                                $check = $this->levelUpdateForUser($user_info->id, '2');

                                $total_amount = 750;
                                $direct_user = 2;
                                $re_entry = 1;
                                $level = 2;

                                $payemt_id = $this->orderPayments($user_info->id, $user_info->parent_id, $total_amount, $level, $direct_user, $re_entry);

                                $re_entry_id = $this->userReEntry($user_info->id, $user_info->parent_id, $level, $re_entry);
                                
                            }

                        }

                    }
                    else if($user_info->user_level == 2){
                        // total user above particual user id
                        $total_user = $this->totalUser($value->id);
                        
                        if($total_user >= 800){
                            // total direct user to self user
                            $total_direct = $this->totalDirect($value->id, $value->user_id);
                            $total_reEntry = $this->totalReEntry($value->user_id);

                            if($total_direct >= 3 && $total_reEntry >= 1){

                                $check = $this->levelUpdateForUser($user_info->id, '3');

                                $total_amount = 1500;
                                $direct_user = 3;
                                $re_entry = 1;
                                $level = 3;

                                $payemt_id = $this->orderPayments($user_info->id, $user_info->parent_id, $total_amount, $level, $direct_user, $re_entry);

                                $re_entry_id = $this->userReEntry($user_info->id, $user_info->parent_id, $level, $re_entry);
                                
                            }

                        }

                    }
                    else if($user_info->user_level == 3){
                        // total user above particual user id
                        $total_user = $this->totalUser($value->id);
                        
                        if($total_user >= 1800){
                            // total direct user to self user
                            $total_direct = $this->totalDirect($value->id, $value->user_id);
                            $total_reEntry = $this->totalReEntry($value->user_id);

                            if($total_direct >= 5 && $total_reEntry >= 2){

                                $check = $this->levelUpdateForUser($user_info->id, '4');

                                $total_amount = 3000;
                                $direct_user = 5;
                                $re_entry = 2;
                                $level = 4;

                                $payemt_id = $this->orderPayments($user_info->id, $user_info->parent_id, $total_amount, $level, $direct_user, $re_entry);

                                $re_entry_id = $this->userReEntry($user_info->id, $user_info->parent_id, $level, $re_entry);
                                
                            }

                        }

                    }
                    else if($user_info->user_level == 4){
                        // total user above particual user id
                        $total_user = $this->totalUser($value->id);
                        
                        if($total_user >= 3300){
                            // total direct user to self user
                            $total_direct = $this->totalDirect($value->id, $value->user_id);
                            $total_reEntry = $this->totalReEntry($value->user_id);

                            if($total_direct >= 7 && $total_reEntry >= 4){

                                $check = $this->levelUpdateForUser($user_info->id, '5');

                                $total_amount = 3750;
                                $direct_user = 7;
                                $re_entry = 2;
                                $level = 5;

                                $payemt_id = $this->orderPayments($user_info->id, $user_info->parent_id, $total_amount, $level, $direct_user, $re_entry);

                                $re_entry_id = $this->userReEntry($user_info->id, $user_info->parent_id, $level, $re_entry);
                                
                            }

                        }

                    }
                    else if($user_info->user_level == 5){
                        // total user above particual user id
                        $total_user = $this->totalUser($value->id);
                        
                        if($total_user >= 5800){
                            // total direct user to self user
                            $total_direct = $this->totalDirect($value->id, $value->user_id);
                            $total_reEntry = $this->totalReEntry($value->user_id);

                            if($total_direct >= 9 && $total_reEntry >= 7){

                                $check = $this->levelUpdateForUser($user_info->id, '6');

                                $total_amount = 4500;
                                $direct_user = 9;
                                $re_entry = 3;
                                $level = 6;

                                $payemt_id = $this->orderPayments($user_info->id, $user_info->parent_id, $total_amount, $level, $direct_user, $re_entry);

                                $re_entry_id = $this->userReEntry($user_info->id, $user_info->parent_id, $level, $re_entry);
                                
                            }

                        }

                    }
                    else if($user_info->user_level == 6){
                        // total user above particual user id
                        $total_user = $this->totalUser($value->id);
                        
                        if($total_user >= 10800){
                            // total direct user to self user
                            $total_direct = $this->totalDirect($value->id, $value->user_id);
                            $total_reEntry = $this->totalReEntry($value->user_id);

                            if($total_direct >= 12 && $total_reEntry >= 11){

                                $check = $this->levelUpdateForUser($user_info->id, '7');

                                $total_amount = 6750;
                                $direct_user = 12;
                                $re_entry = 4;
                                $level = 7;

                                $payemt_id = $this->orderPayments($user_info->id, $user_info->parent_id, $total_amount, $level, $direct_user, $re_entry);

                                $re_entry_id = $this->userReEntry($user_info->id, $user_info->parent_id, $level, $re_entry);
                                
                            }

                        }

                    }
                   // die;
                }
       
            }
        }

    }

    public function orderPayments($user_id, $parent_id, $total_amount, $level, $direct_user, $re_entry = NULL, $sponsored_amount = NULL){

        $reEntry = 0;
        $re_entry_amount = 0.00;
        if(!empty($re_entry)){
            $reEntry = $re_entry;
            $re_entry_amount = $re_entry * 600;
        }

        $admin_commission = ($total_amount * 15 ) / 100;
        $tds = ($total_amount * 5 ) / 100;
        $remaining_amt = $total_amount - $admin_commission - $tds;

        $remaining_amount = $remaining_amt - $re_entry_amount;

        $dataPayment = array(
            'user_id'   => $user_id,
            'parent_id' => $parent_id,
            'total_amount' => $total_amount,
            'direct_user' => $direct_user,
            're_entry' => $reEntry,
            're_entry_amount' => $re_entry_amount,
            'admin_commission' => $admin_commission,
            'tds' => $tds,
            'remaining_amount' => $remaining_amount,
            'sponsored_amount' => $sponsored_amount,
            'level' => $level,
            'payment_status' => 'Pending',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
                );

        $this->tbl_order_payment('id'); 
        $payment_id = $this->global_model->save($dataPayment);

        return $payment_id;

    }

    public function userReEntry($user_id, $parent_id, $level, $re_entry){
        
        $re_entry_amount = $re_entry * 600;
        
        $dataArray = array(
            'user_id'   => $user_id,
            'parent_id' => $parent_id,
            're_entry' => $re_entry,
            're_entry_amount' => $re_entry_amount,
            'level' => $level,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
                );

        $this->tbl_re_entry('id'); 
        $re_entery_id = $this->global_model->save($dataArray);

        return $re_entery_id;

    }


    public function totalUser($id){

        $this->tbl_activated_user('id', 'desc'); 
        $whereTU = array('id >' => $id);
        $selectTU = array('id');
        $total_user = count($this->global_model->get_by($whereTU, false,  Null, Null, $selectTU));

        return $total_user;
    }

    public function totalDirect($id, $user_id){

        $this->tbl_activated_user('id', 'desc'); 
        $w_direct = array('id >' => $id, 'parent_id' => $user_id);
        $s_direct = array('id');
        $total_direct = count($this->global_model->get_by($w_direct, false,  Null, Null, $s_direct));

        return $total_direct;
    }

    public function totalReEntry($user_id){
        $w_entry = array('user_id' => $user_id);
        $this->db->select_sum('re_entry');
        $this->db->from('re_entry');
        $this->db->where($w_entry);
        $query=$this->db->get();
        $total_reEntry = $query->row()->user_id;

        return $total_reEntry;
    }
    
    public function levelUpdateForUser($user_id , $level){

        $dataLevel = array('user_level' => $level );
        $check = $this->global_model->set_action(array('id' => $user_id) , $dataLevel ,'users');

        return $check;
    }

}
