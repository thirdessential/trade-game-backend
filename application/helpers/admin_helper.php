<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

function image_compress($source_url, $destination_url, $quality) {
    $info = getimagesize($source_url);

    if ($info['mime'] == 'image/jpeg')
        $image = imagecreatefromjpeg($source_url);

    elseif ($info['mime'] == 'image/gif')
        $image = imagecreatefromgif($source_url);

    elseif ($info['mime'] == 'image/png')
        $image = imagecreatefrompng($source_url);

    imagejpeg($image, $destination_url, $quality);
    return $destination_url;
}


function string_format($str) {
    $str = strtolower($str);
    return ucwords($str);
}

function is_valid($role) {
    //print_r($role); die;
    $ci = & get_instance();
    $ci->load->model('login_model');
    if ($ci->login_model->loggedin()) {
        if ($role == 'admin') {
            if ($ci->session->userdata('user_type') == 'Admin') {
                
            } else {
                redirect('user/login');
            }
        } else {
            if ($ci->session->userdata('user_type') == 'User') {
                
            } else {
                redirect('admin/login');
            }
        }
    } else {
        redirect($role . '/login');
    }
}

function dateTimeFormat($date){
    $date_formate = date('j M Y g:i A', strtotime($date));
    return $date_formate;
}

function is_users_valid() {
    $ci = & get_instance();
    $ci->load->model('login_model');
    $ci->login_model->users_loggedin() == true || redirect();
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'min',
        's' => 'sec',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full)
        $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function read_more($string, $count = 50) {
    if (strlen($string) > $count) {
        $string = wordwrap($string, $count);
        $i = strpos($string, "\n");
        if ($i) {
            $string = substr($string, 0, $i);
        }
    }
    return $string;
}

function btn_edit($uri) {
    $ci = & get_instance();
    return anchor($uri, '<i class="fa fa-edit"></i>', array('class' => "btn bg-navy btn-xs", 'title' => $ci->lang->line('edit'), 'data-toggle' => 'tooltip', 'data-placement' => 'top'));
}

function btn_reply($uri) {
    $ci = & get_instance();
    return anchor($uri, '<i class="fa fa-reply"></i>', array('class' => "btn bg-navy btn-xs", 'title' => $ci->lang->line('reply'), 'data-toggle' => 'tooltip', 'data-placement' => 'top'));
}

function btn_list($uri) {
    $ci = & get_instance();
    return anchor($uri, '<i class="glyphicon glyphicon-list"></i>', array('class' => "btn bg-navy btn-xs", 'title' => $ci->lang->line('address_list'), 'data-toggle' => 'tooltip', 'data-placement' => 'top'));
}

function account_detail($uri) {
    $ci = & get_instance();
    return anchor($uri, '<i class="glyphicon glyphicon-list"></i>', array('class' => "btn bg-navy btn-xs", 'title' => $ci->lang->line('account_detail'), 'data-toggle' => 'tooltip', 'data-placement' => 'top'));
}

function btn_info($uri) {
    $ci = & get_instance();
    return anchor($uri, '<span class="fa fa-eye"></span>', array('class' => "btn bg-olive btn-xs", 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => $ci->lang->line('view')));
}


function btn_edit_modal($uri) {
    $ci = & get_instance();
    return anchor($uri, '<span class="glyphicon glyphicon-pencil"></span>', array('class' => "btn btn-primary btn-xs", 'title' => $ci->lang->line('edit'), 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'data-toggle' => 'modal', 'data-target' => '#myModal'));
}

function btn_view_modal($uri, $title = 'view') {
    $ci = & get_instance();
    return anchor($uri, '<span class="glyphicon glyphicon-search"></span>', array('class' => "btn bg-olive btn-xs", 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'View Details', 'data-toggle' => 'modal', 'data-target' => '#myModal'));
}

function btn_view_modal_small($uri) {
    $ci = & get_instance();
    return anchor($uri, '<i class="fa fa-list"></i>', array('class' => "btn bg-olive btn-xs", 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'View', 'data-toggle' => 'modal', 'data-target' => '#modalSmall'));
}

function btn_delete($uri) {
    $ci = & get_instance();
    return anchor('#', '<i class="fa fa-trash-o"></i>', array(
        'class' => "btn btn-danger btn-xs", 'title' => 'Delete', 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'onclick' => "return deleteData('" . $uri . "');"
    ));
}

function btn_print() {
    $ci = & get_instance();
    return anchor('', '<span class="glyphicon glyphicon-print"></i></span>', array('class' => "btn btn-primary btn-xs", 'title' => $ci->lang->line('print'), 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'onclick' => 'printDiv("printableArea")'));
}


function btn_view($uri) {
    $ci = & get_instance();
    return anchor($uri, '<span class="glyphicon glyphicon-search"></span>', array('class' => "btn bg-olive btn-xs", 'data-toggle' => 'tooltip', 'data-placement' => 'top', 'title' => 'View'));
}


function btn_save($uri) {
    $ci = & get_instance();
    return anchor($uri, '<span <i class="fa fa-plus-circle"></i></span>', array('class' => "btn btn-success btn-xs", 'title' => $ci->lang->line('save'), 'data-toggle' => 'tooltip', 'data-placement' => 'top'));
}

function btn_add($uri) {
    $ci = & get_instance();
    return anchor($uri, '<span <i class="fa fa-plus-square"></i></span>', array('class' => "btn btn-success btn-xs", 'title' => $ci->lang->line('view'), 'data-toggle' => 'tooltip', 'data-placement' => 'top'));
}

// function btn_addAdmin($uri){
//     $ci = & get_instance();
//     return anchor($uri, '<span <i class="fa fa-plus-square"></i></span>', array('class' => "btn btn-success btn-xs", 'title' => 'Add Admin', 'data-toggle' => 'tooltip', 'data-placement' => 'top'));
// }

function btn_viewAdmin($uri){
    $ci = & get_instance();
    return anchor($uri, '<span <i class="fa fa-eye"></i></span>', array('class' => "btn btn-info btn-xs", 'title' => 'View Admin', 'data-toggle' => 'tooltip', 'data-placement' => 'top'));
}
function btn_viewVehicle($uri){
    $ci = & get_instance();
    return anchor($uri, '<span <i class="fa fa-eye"></i></span>', array('class' => "btn btn-info btn-xs", 'title' => 'View Vehicle', 'data-toggle' => 'tooltip', 'data-placement' => 'top'));
}
function btn_addRemark($uri){
    $ci = & get_instance();
    return anchor($uri, '<span <i class="fa fa-eye"></i></span>', array('class' => "btn btn-info btn-xs", 'title' => 'Remark', 'data-toggle' => 'tooltip', 'data-placement' => 'top'));
}

function btn_addTask($uri) {
    $ci = & get_instance();
    return anchor($uri, '<span <i class="fa fa-plus-square"></i></span>', array('class' => "btn btn-success btn-xs", 'title' => 'Add Task', 'data-toggle' => 'tooltip', 'data-placement' => 'top'));
}

function btn_mail($uri, $title = null) {
    $ci = & get_instance();
    return anchor($uri, '<i class="fa fa-envelope-o"></i>', array('class' => "btn bg-yellow btn-xs", 'title' => $title, 'data-toggle' => 'tooltip', 'data-placement' => 'top'));
}

function create_slug($slug, $table) {

    $ci = & get_instance();
    $slugAll = strtolower(preg_replace("/[^a-zA-Z0-9]+/", "-", trim($slug)));

    if ($slugAll) {
        $whereSlug = array('slug' => $slugAll);

        $check_slug = $ci->global_model->check_by($whereSlug, $table);
        if ($check_slug) {
            $slugInsert = $check_slug->slug . rand('1', '99');
            return $slugInsert;
        } else {
            return $slugAll;
        }
    } else {
        return FALSE;
    }
}

