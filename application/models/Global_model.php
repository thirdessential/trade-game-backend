<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Global_Model extends MY_Model {

    public $_table_name;
    public $_order_by;
    public $_primary_key;
    public $_order = '';

    public function get_last_id($table, $key, $id) {
        $this->db->select_max($key);
        $Q = $this->db->get($table);
        $row = $Q->row_array();
        $last_id = $row[$id];

        return $last_id;
    }

    public function directQuery($qry, $dif = true) {
        $query = $this->db->query($qry);
        if ($dif) {
            $result = $query->result();
            return $result;
        } else {
            return $this->db->affected_rows();
        }
    }

    public function get_all_language() {
        $this->db->select('language.*');
        $this->db->from('language');
        $query = $this->db->get();
        $result = $query->result();
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }
    
    public function get_all_notification() {
        $this->db->select('users_notifications.*');
        $this->db->from('users_notifications');
        $this->db->where(array('user_type' => 'Admin','seen' => 'No'));
        $this->db->order_by('updated_at','desc');
        $query = $this->db->get();
        $result = $query->result();
        if ($result) {
            return $result;
        } else {
            return FALSE;
        }
    }
//    
//     public function get_all_store_notification() {
//          $store_id = $this->session->userdata('loginId');
//        $this->db->select('users_notifications.*');
//        $this->db->from('users_notifications');
//        $this->db->where(array('user_type' => 'Store','seen' => 'Yes','users_id' => $store_id));
//        $query = $this->db->get();
//        $result = $query->result();
//        if ($result) {
//            return $result;
//        } else {
//            return FALSE;
//        }
//    }

    public function get_category_name($id) {
        if ($id) {
            $this->db->select('category.*');
            $this->db->from('category');
            $this->db->where('id', $id);
            $query = $this->db->get();
            $result = $query->row();
            if ($result) {
                return $result;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function GetRecords($table, $arr, $like, $order_by = NULL, $group_by = NULL, $start_limit = NULL, $end_limit = NULL, $single, $select) {
        $this->db->select($select);
        if ($arr != "") {
            $this->db->where($arr);
        }
        if ($like != "") {
            $this->db->or_like($like);
        }
        if ($order_by != NULL) {
            $this->db->order_by($order_by);
        }
        if ($group_by != NULL) {
            $this->db->group_by($group_by);
        }
        if ($start_limit != NULL && $end_limit != NULL) {
            $this->db->limit($start_limit, $end_limit);
        }
        $rec = $this->db->get($table);

        if ($rec->num_rows() > 0) {
            return ($single == "all") ? $rec->result() : $rec->row();
        } else {
            return FALSE;
        }
    }

    public function GetJoinRecords($select, $table1, $table2, $table3, $where, $on, $on1, $order_by = 'asc', $all = false, $join = 'left', $groupby = '', $start = '', $end = '') {
        $this->db->select($select);
        if ($order_by != '') {
            $this->db->order_by($order_by);
        }
        if ($where != '') {
            $this->db->where($where);
        }
        $this->db->group_by($groupby);
        if ($start != '' && $end != '') {
            $this->db->limit($end, $start);
        }
        $this->db->from($table1);
        $this->db->join($table2, $on, $join);
        if ($table3 != '') {
            $this->db->join($table3, $on1, $join);
        }
        $record = $this->db->get();
        if ($record->num_rows() > 0) {
            if ($all) {
                return $record->row();
            } else {
                return $record->result();
            }
        } else {
            return false;
        }
    }

    function update_item($rowid, $qty) {
        // Create an array with the products rowid's and quantities. 
        $data = array(
            'rowid' => $rowid,
            'qty' => $qty
        );
        // Update the cart with the new information
        $this->cart->update($data);
    }

    // Add an item to the cart
    function add_cart_item() {
        $id = $this->input->post('product_id'); // Assign posted product_id to $id
        $qty = $this->input->post('quantity_detail'); // Assign posted quantity to $qty
        $name = $this->input->post('name'); // Assign posted name 
        $price = $this->input->post('price_detail'); // Assign posted price
        $options = json_encode($this->input->post('option'));
        $data = array(
            'id' => $id,
            'product_id' => $id,
            'qty' => $qty,
            'price' => $price,
            'name' => 'test',
            'option' => $options
        );
        
        $this->cart->insert($data);
        return TRUE;
    }

    function getmenu() {
        $this->db->select('menu.*');
        $this->db->from('menu');


        $query = $this->db->get();

        $parents = $query->result();

        return $this->getChilds($parents, 0);
    }

    function getChilds($elements, $parent_id) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element->parent_id == $parent_id) {
                $sub_menu = $this->getChilds($elements, $element->id);
                if ($sub_menu) {
                    $element->sub_menu = $sub_menu;
                }

                $branch[] = $element;
            }
        }
        return $branch;
    }


    public function GetJoinSearchRecords($table,$con,$search_key) {
       $this->db->like($con, $search_key);
       $res = $this->db->get($table);
       return $res->result();
    }
     

}
