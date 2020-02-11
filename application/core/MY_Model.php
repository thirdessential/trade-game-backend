<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/*
 * 	@author : CodesLab
 *  @support: support@codeslab.net
 * 	date	: 05 June, 2015
 * 	Easy Inventory
 * 	http://www.codeslab.net
 *  version: 1.0
 */

class MY_Model extends CI_Model {

    protected $_table_name = '';
    protected $_primary_key = 'id';
    protected $_primary_filter = 'intval';
    protected $_order_by = '';
    protected $_order = '';
    public $rules = array();
    protected $_timestamps = true;

    public function __construct() {
        parent::__construct();
    }

    // CURD FUNCTION

    public function array_from_post($fields) {
        $data = array();
        foreach ($fields as $field) {
            $data[$field] = $this->input->post($field);
        }

        return $data;
    }



    public function get($id = null, $single = false, $select = null) {
        if ($select) {
            $this->db->select($select);
        }
        if ($id != null) {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->where($this->_primary_key, $id);
            $method = 'row';
        } elseif ($single == true) {
            $method = 'row';
        } else {
            $method = 'result';
        }

        if ($this->_order_by != '') {
            if ($this->_order != '') {
                $this->db->order_by($this->_order_by, $this->_order);
            } else {
                $this->db->order_by($this->_order_by);
            }
        }

        return $this->db->get($this->_table_name)->$method();
    }

    public function get_by($where, $single = false, $or_where = NULL, $where_in = NULL, $select = null, $group_by = null, $limit = null) {
        $this->db->where($where);

        if ($or_where)
            $this->db->or_where($or_where);

        if ($where_in)
            $this->db->where_in('id', $where_in);
        if ($group_by)
            $this->db->group_by($group_by);

        if (!empty($limit)) {
            if (is_array($limit)) {
                $this->db->limit($limit['length'], $limit['start']);
            } else {
                $this->db->limit($limit);
            }
        }

        return $d = $this->get(null, $single, $select);
    }

    public function get_by_join($where = null, $single = false, $select = null, $join = null, $limit = null, $like = null, $group_by = null, $where_in = NULL, $whereInId = 'id',$likeWhere = 'both') {
        if ($select) {
            $this->db->select($select);
        }

        $this->db->from($this->_table_name);

        if ($where != null) {
            if (is_array($where)) {
                $this->db->where($where);
                if ($single) {
                    $method = 'row';
                } else {
                    $method = 'result';
                }
            } else {
                $filter = $this->_primary_filter;
                $id = $filter($id);
                $this->db->where($this->_table_name . '.' . $this->_primary_key, $id);
                $method = 'row';
            }
        } elseif ($single == true) {
            $method = 'row';
        } else {
            $method = 'result';
        }

        if ($this->_order_by != '') {
            if (strpos($this->_order_by, ".") === false) {
                if ($this->_order != '') {
                    $this->db->order_by($this->_table_name . '.' . $this->_order_by, $this->_order);
                } else {
                    $this->db->order_by($this->_table_name . '.' . $this->_order_by);
                }
            } else {
                if ($this->_order != '') {
                    $this->db->order_by($this->_order_by, $this->_order);
                } else {
                    $this->db->order_by($this->_order_by);
                }
            }
        }

        if (!empty($join)) {
            foreach ($join as $key => $value) {
                $this->db->join($key, $value, 'left');
            }
        }

        if (!empty($limit)) {
            if (is_array($limit)) {
                $this->db->limit($limit['length'], $limit['start']);
            } else {
                $this->db->limit($limit);
            }
        }

        if (!empty($like)) {
            $l = 1;
            $this->db->group_start();
            foreach ($like as $field => $search) {
                if ($l == 1) {
                    $this->db->like($field, $search, $likeWhere);
                } else {
                    $this->db->or_like($field, $search, $likeWhere);
                }
                $l++;
            }
            $this->db->group_end();
        }
        if ($where_in)
            $this->db->where_in($this->_table_name . '.' . $whereInId, $where_in);

        if ($group_by)
            $this->db->group_by($group_by);

        // print_r($this->db->get($this->_table_name)->$method());die;
        return $this->db->get()->$method();
    }

    public function save($data, $id = null, $time = true) {

        // Set timestamps
        if ($this->_timestamps == true && $time == TRUE) {
            $now = date('Y-m-d H:i:s');
            $id || $data['created_at'] = $now;
            $data['updated_at'] = $now;
        }

        // Insert
        if ($id === null) {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = null;
            $this->db->set($data);
            $this->db->insert($this->_table_name);

            $id = $this->db->insert_id();
        }
        // Update
        else {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->db->set($data);
            $this->db->where($this->_primary_key, $id);
            $this->db->update($this->_table_name);
        }
        //echo $this->db->last_query();die;
        return $id;
    }

    /**
     * Delete Single rows.
     */
    public function delete($id) {

        $filter = $this->_primary_filter;
        $id = $filter($id);

        if (!$id) {
            return false;
        }
       
        $this->db->where($this->_primary_key, $id);
        $this->db->limit(1);
        $this->db->delete($this->_table_name);
    }

    /**
     * Delete Multiple rows.
     */
    public function delete_all($where, $multiple = false) {
        if ($multiple)
            $this->db->where_in('id', $where);
        else
            $this->db->where($where);
        $this->db->delete($this->_table_name);
    }

    /**
     * Truncate table.
     */
    public function truncate_tbl() {
        $this->db->truncate($this->_table_name);
    }

    public function uploadImage($field, $path = null) {
        $config['upload_path'] = ($path == null ? 'img/uploads/' : $path);
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '20240';
        // echo $path; echo '<br>';
        // print_r($config); die;
        $this->load->library('upload', $config);
        
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            $error = $this->upload->display_errors();
            $type = 'error';
            $message = $error;
            set_message($type, $message);
            return false;
            // uploading failed. $error will holds the errors.
        } else {
             
            $fdata = $this->upload->data();
            //print_r($fdata); die;
            $img_data ['path'] = $config['upload_path'] . $fdata['file_name'];
            $img_data ['fullPath'] = $fdata['full_path'];
           

           // print_r($img_data); die;


            return $img_data;
            // uploading successfull, now do your further actions
        }


    }

    public function image_resize($imagePath, $width, $height, $thumb = false, $quality = '90%') {

        $config['image_library'] = 'gd2';
        $config['source_image'] = $imagePath;
        $config['create_thumb'] = $thumb;
        $config['maintain_ratio'] = false;
        $config['width'] = $width;
        $config['height'] = $height;
        $config['quality'] = $quality;
        //$this->load->library('image_lib', $config);
        // Create thumbnail
        //$this->load->library('image_lib');
        $this->image_lib->initialize($config);
//        $this->image_lib->resize();
//        $this->image_lib->clear();

        if (!$this->image_lib->resize()) {
            return $this->image_lib->display_errors();
        } else {
            $this->image_lib->clear();
            return true;
        }
    }

    public function uploadAllfiles($field, $path = null) {
        $config['upload_path'] = ($path == null ? 'img/uploads/' : $path);
        //gif|jpg|jpeg|png|psd|xls|xlsx|xml|doc|docx|csv|mpeg|mpg|mp3|mpga|pdf|zip|tgz|rar
        $config['allowed_types'] = '*';
        $config['max_size'] = '20480000';

   ini_set('memory_limit', '9600M');
ini_set('post_max_size', '6400M');
ini_set('upload_max_filesize', '1024M');
ini_set('max_input_time', '10240');
ini_set('max_execution_time', '10000');
ini_set('max_input_vars', '10000');

        //print_r($config); die;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            echo $error = $this->upload->display_errors();
            die;
            $type = 'error';
            $message = $error;

            set_message($type, $message);
            return false;
            // uploading failed. $error will holds the errors.
        } else {
            //print_r($this->upload->data()); die;
            $fdata = $this->upload->data();
            $img_data ['path'] = $config['upload_path'] . $fdata['file_name'];
            $img_data ['fullPath'] = $fdata['full_path'];
            $img_data ['fullext'] = $fdata['file_ext'];
            $img_data ['raw_name'] = $fdata['raw_name'];
            return $img_data;
            // uploading successfull, now do your further actions
        }
    }

    //UPLOAD MULTIPLE IMAGES
    public function uploadMultipleImage($field, $index, $path = null) {
        $config['upload_path'] = ($path == null ? 'img/uploads/' : $path);
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '2024';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload_multiple($field, $index)) {
            $error = $this->upload->display_errors();
            $type = 'error';
            $message = $error;
            set_message($type, $message);
            return false;
            // uploading failed. $error will holds the errors.
        } else {
            $fdata = $this->upload->data();
            $img_data ['path'] = $config['upload_path'] . $fdata['file_name'];
            $img_data ['fullPath'] = $fdata['full_path'];

            return $img_data;
            // uploading successfull, now do your further actions
        }
    }

    //DAMAGE UPLOAD IMAGE
    public function uploadImageDamage($field, $path = null) {
        $config['upload_path'] = ($path == null ? 'img/uploads/' : $path);
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = '2024';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            $error = $this->upload->display_errors();
            $type = 'error';
            $message = $error;
            set_message($type, $message);
            return false;
            // uploading failed. $error will holds the errors.
        } else {
            $fdata = $this->upload->data();
            $img_data ['path'] = $config['upload_path'] . $fdata['file_name'];
            $img_data ['fullPath'] = $fdata['full_path'];

            return $img_data;
            // uploading successfull, now do your further actions
        }
    }

    public function uploadFile($field) {
        $config['upload_path'] = 'img/uploads/';
        $config['allowed_types'] = 'pdf|docx|doc';
        $config['max_size'] = '2048';

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload($field)) {
            $error = $this->upload->display_errors();
            $type = 'error';
            $message = $error;
            set_message($type, $message);

            return false;
            // uploading failed. $error will holds the errors.
        } else {
            $fdata = $this->upload->data();
            $file_data ['fileName'] = $fdata['file_name'];
            $file_data ['path'] = $config['upload_path'] . $fdata['file_name'];
            $file_data ['fullPath'] = $fdata['full_path'];

            return $file_data;
            // uploading successfull, now do your further actions
        }
    }

    public function check_by($where, $tbl_name, $single = TRUE) {

        $this->db->select('*');
        $this->db->from($tbl_name);
        $this->db->where($where);
        $this->db->order_by('id', 'desc');
        $query_result = $this->db->get();
        if ($single)
            $result = $query_result->row();
        else
            $result = $query_result->result();
        return $result;
    }

    public function set_action($where, $value, $tbl_name) {
        $this->db->set($value,false);
        $this->db->where($where);
        $this->db->update($tbl_name);
        return $this->db->affected_rows();
    }

    public function set_action_orderby($where, $value, $tbl_name, $limit = null) {
        $this->db->set($value);
        $this->db->where($where);

        if ($this->_order_by != '') {
            if ($this->_order != '') {
                $this->db->order_by($this->_order_by, $this->_order);
            } else {
                $this->db->order_by($this->_order_by);
            }
        }

        if (!empty($limit)) {
            if (is_array($limit)) {
                $this->db->limit($limit['length'], $limit['start']);
            } else {
                $this->db->limit($limit);
            }
        }

        $this->db->update($tbl_name);

        return $this->db->affected_rows();
    }

    public function change_status($table, $id) {
        $query = 'UPDATE `' . $table . '` SET `status` = IF(`status` = "Active", "Inactive", "Active") WHERE `id` = "' . $id . '"';
        $result = $this->db->query($query);
        return true;
    }

    public function change_payment_type($table, $id) {
        $query = 'UPDATE `' . $table . '` SET `payment_type` = IF(`payment_type` = "PAID", "UNPAID", "PAID") WHERE `id` = "' . $id . '"';
        $result = $this->db->query($query);
        return true;
    }

    public function change_verified($table, $id) {
        $query = 'UPDATE `' . $table . '` SET `verification_status` = IF(`verification_status` = "Verified", "NotVerified", "Verified") WHERE `id` = "' . $id . '"';
        $result = $this->db->query($query);
        return true;
    }

    /** duplicate value check * */
    public function check_update($table, $where, $id = null) {
        $this->db->select('*', false);
        $this->db->from($table);
        if ($id != null) {
            $this->db->where($id);
        }
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->result();

        return $result;
    }
    
    /** duplicate value check * */
    public function check_unique($table, $where, $id = null) {
        $this->db->select('*', false);
        $this->db->from($table);
        if ($id != null) {
            $this->db->where($id);
        }
        $this->db->where($where);
        $query_result = $this->db->get();
        $result = $query_result->result();
        
        if($result)
            return true;
        else
            return FALSE;
    }

    public function alter_table($table, $fields, $drop = FALSE) {
        $this->load->dbforge();
        if ($drop) {
            $this->dbforge->drop_column($table, $fields);
        } else {
            $this->dbforge->add_column($table, $fields);
        }
    }

}
