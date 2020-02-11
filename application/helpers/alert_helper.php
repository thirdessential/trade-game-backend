<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('message_box')) {

    function message_box($message_type, $close_button = TRUE) {
        $CI = & get_instance();
        $message = $CI->session->flashdata($message_type);
        $retval = '';

        if ($message) {
            switch ($message_type) {
                case 'success':
                    $retval .= '<div class="alert custom alert-info">';
                    break;
                case 'error':
                    $retval .= '<div class="alert custom alert-danger">';
                    break;
                case 'info':
                    $retval .= '<div class="alert custom alert-info">';
                    break;
                case 'warning':
                    $retval .= '<div class="alert custom alert-warning">';
                    break;
            }

            if ($close_button)
                $retval .= '<a class="close" data-dismiss="alert" href="#">&times;</a>';

            $retval .= '<strong>' . $message;
            $retval .= '</strong></div>';
            return $retval;
        }
    }

}
if (!function_exists('star_rating')) {

    function star_rating($rate) {
        $star = '<div id="stars-existing">';
        for ($i = 1; $i <= $rate; $i++) {
            $star .= '<i class="fa fa-star"></i>';
        }
        for ($j = 1; $j <= (5 - $rate); $j++) {
            $star .= '<i class="fa fa-star-o"></i>';
        }
        $star .= '</div>';
        return $star;
    }

}
if (!function_exists('pagination')) {

    function table_pagination($url, $total, $limit, $page, $links = 5) {
        $ps = (strpos($url, '?') !== FALSE) ? ('&') : ('?');
        $last = ceil($total / $limit);
        $class = "paginate_button";
        $start = ( ( $page - $links ) > 0 ) ? $page - $links : 1;
        $end = ( ( $page + $links ) < $last ) ? $page + $links : $last;

        $html = '<ul class="pagination">';

        $class = ( $page == 1 ) ? "disabled" : "";
        $link = ($page == 1) ? ('') : ($url . $ps . 'limit=' . $limit . '&page=' . ( $page - 1 ));
        $html .= '<li class="paginate_button ' . $class . '"><a disabled="' . $class . '" href="' . $link . '">&laquo;</a></li>';

        if ($start > 1) {
            $html .= '<li><a href="' . $url . $ps . 'limit=' . $limit . '&page=1">1</a></li>';
            $html .= '<li class="disabled"><span>...</span></li>';
        }

        for ($i = $start; $i <= $end; $i++) {
            $class = ( $page == $i ) ? "active" : "";
            $html .= '<li class="paginate_button ' . $class . '"><a href="' . $url . $ps . 'limit=' . $limit . '&page=' . $i . '">' . $i . '</a></li>';
        }

        if ($end < $last) {
            $html .= '<li class="disabled"><span>...</span></li>';
            $html .= '<li><a href="' . $url . $ps . 'limit=' . $limit . '&page=' . $last . '">' . $last . '</a></li>';
        }

        $class = ( $page == $last ) ? "disabled" : "";
        $linkLast = ($page == $last) ? ('') : ( $url . $ps . 'limit=' . $limit . '&page=' . ( $page + 1 ) );
        $html .= '<li class="paginate_button ' . $class . '"><a disabled="' . $class . '" href="' . $linkLast . '">&raquo;</a></li>';

        $html .= '</ul>';
        return $html;
    }

}

if (!function_exists('set_url')) {

    function set_url($url) {
        return (strpos($url, '?') !== FALSE) ? ($url . '&') : ($url . '?');
    }

}

if (!function_exists('set_message')) {

    function set_message($type, $message) {
        $CI = & get_instance();
        $CI->session->set_flashdata($type, $message);
    }

}



if (!function_exists('changeImageFormat')) {

    function changeImageFormat($filename) {
        echo '<br>';
        echo $source = FCPATH . $filename;
        echo '<br>';
        echo $destination = str_replace(array('jpg', 'jpeg', 'png', 'gif', 'bmp'), "webp", $source);
        echo '<br>';
        //$output1 = exec('sudo apt-get install webp');
        echo '<pre>' . $output1 . '</pre>';
        $output = exec('cwebp -q 80 ' . $source . ' -o ' . $destination);
        echo '<pre>' . $output . '</pre>';
    }

}



if (!function_exists('sendSMS')) {

    function sendSMS($mobile, $message) {
        $CI = & get_instance();
        // SMS credetial
        $auth_id = config_item('sms_api_auth_id');
        $auth_token = config_item('sms_api_auth_token');
        $auth_number = config_item('sms_api_auth_number');
        $p = $CI->sms->factory($auth_id, $auth_token);

        // Send a message
        $params = array(
            'src' => $auth_number, // Sender's phone number with country code
            'dst' => '91' . $mobile, // Receiver's phone number with country code
            'text' => $message // Your SMS text message
        );
        // Send message
        $response = $p->send_message($params);
        return $response;
    }

}
/*
  Parameter Example
  $data = array('post_id'=>'12345','post_title'=>'A Blog post');
  $target = 'single tocken id or topic name';
  or
  $target = array('token1','token2','...'); // up to 1000 in one request
 */
if (!function_exists('sendNotification')) {

    function sendNotification($data, $target) {
        $ci = &get_instance();
        //FCM api URL
        $url = config_item('fcm_api_send_address');
        //api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        $server_key = config_item('fcm_api_key');

        $fields = array();
        $fields['data'] = $data;
        $fields['time_to_live'] = 500;
        $fields['priority'] = 'high';

        if (is_array($target)) {
            $fields['registration_ids'] = $target;
        } else {
            $fields['to'] = $target;
        }

        //header with content_type api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $server_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            //die('FCM Send Error: ' . curl_error($ch));
            return FALSE;
        }
        curl_close($ch);
        return $result;

        //return true;
    }

}


if (!function_exists('sendNotificationIphone')) {

    function sendNotificationIphone($data, $notification, $target) {
        $ci = &get_instance();
        //FCM api URL
        $url = config_item('fcm_api_send_address');
        //api_key available in Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key
        $server_key = config_item('fcm_api_key');

        $fields = array();
        $fields['data'] = $data;
        $fields['notification'] = $notification;
        $fields['time_to_live'] = 500;
        $fields['priority'] = 'high';

        if (is_array($target)) {
            $fields['registration_ids'] = $target;
        } else {
            $fields['to'] = $target;
        }

        //header with content_type api key
        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=' . $server_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            //die('FCM Send Error: ' . curl_error($ch));
            return FALSE;
        }
        curl_close($ch);
        return $result;
    }

}

if (!function_exists('getAdvert')) {

    function getAdvert($type) {
        $ci = &get_instance();
        $ci->load->model('product_Model');
        return $ci->product_Model->getAdvertByType($type);
    }

}


if (!function_exists('changeDateFormate')) {

    function changeDateFormate($date) {
        $ci = &get_instance();
        return strtotime($date) * 1000;
    }

}


if (!function_exists('getLatLong')) {

    function getLatLong($address) {
        if (!empty($address)) {
            //Formatted address
            $formattedAddr = str_replace(' ', '+', $address);
            //Send request and receive json data by address
            $geocodeFromAddr = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $formattedAddr . '&sensor=false');
            $output = json_decode($geocodeFromAddr);
            //Get latitude and longitute from json data
            if ($output->status == 'OK') {
                $data['latitude'] = $output->results[0]->geometry->location->lat;
                $data['longitude'] = $output->results[0]->geometry->location->lng;
            } else {
                $data['latitude'] = NULL;
                $data['longitude'] = NULL;
            }
            //Return latitude and longitude of the given address
            if (!empty($data)) {
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}

if (!function_exists('getAddress')) {

    function getAddress($latitude, $longitude) {
        if (!empty($latitude) && !empty($longitude)) {
            //Send request and receive json data by address
            $geocodeFromLatLong = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?latlng=' . trim($latitude) . ',' . trim($longitude) . '&sensor=false');
            $output = json_decode($geocodeFromLatLong);
            $status = $output->status;
            //Get address from json data
            $address = ($status == "OK") ? $output->results[1]->formatted_address : '';
            //Return address of the given latitude and longitude
            if (!empty($address)) {
                return $address;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

}


