<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datos extends CI_Model {
	function __construct() {
		parent::__construct();
        $this->load->database();
    }

    function to_save($id, $tabla, $data) {
        if ($id == 0) {
            $res = $this->db->insert($tabla, $data);
            return $this->db->insert_id();
        } else {
            $this->db->update($tabla, $data, array($id_ => $id));
            return $this->db->affected_rows();
        }
    }

    function to_delete($tabla, $id) {
        return $this->db->delete($tabla, array('id' => $id));
    }

    function delete_where($tabla, $field, $value) {
        return $this->db->delete($tabla, array($field => $value));
    }

    function from($type, $tabla, $orderBy = 'id') {
        $this->db->select('*');
        $this->db->from($tabla);
        $this->db->order_by($orderBy);

        if ($type == 'list') {
            return $this->db->get()->result();
        } if ($type == 'one')  {
            return $this->db->get()->row();
        } 
        return $this->db->get()->row();
    }

    function from_where($type, $from, $field, $value, $select = '*') {
        $this->db->select($select);
        $this->db->from($from);
        // type of filter
        /* if ($like_where == 'like') {
            $this->db->like($field, $value, 'both');
        } else { */
            $this->db->where($field, $value);
        /* } */
        // result to return
        if ($type == 'get') {
            return $this->db->get();
        } if ($type == 'one')  {
            return $this->db->get()->row();
        } if ($type == 'list') {
            return $this->db->get()->result();
        } if ($type == 'count') {
            return $this->db->count_all_results();
        } if ($type == 'query') {
            return $this->db->get_compiled_select();
        }

        return array();
    }

    function list_from_where($from, $field, $value) {
        return $this->from_where('list', $from, $field, $value);
    }

    function one_from_where($from, $field, $value, $select = '*') {
        return $this->from_where('one', $from, $field, $value, $select);
    }

    function row_from_by_id($tabla, $id) {
        $this->db->select('*');
        $this->db->from($tabla);
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    function row_from($tabla) {
        $this->db->select('*');
        $this->db->from($tabla);
        $query = $this->db->get();

        return $query->row();
    }

    function list_from_like($tabla, $likeField, $likeValue, $limit = 150, $select = '*') {
        $this->db->select($select);
        $this->db->from($tabla);
        $this->db->like($likeField, $likeValue, 'both');
        if ($limit > 0) {
            $this->db->limit($limit);
        }
        //return $this->db->get_compiled_select();
        $query = $this->db->get();

        return $query->result();
    }

    /*  @params
            $tabla  // tabla que se desea consular
            $data   // array con los valores o cadena de string con los where
                    // -- array
                        $array = array('name' => $name, 'title' => $title, 'status' => $status);
                        $this->db->where($array);
                        // Produces: WHERE name = 'Joe' AND title = 'boss' AND status = 'active'

                    // -- cadena
                        $where = "name='Joe' AND status='boss' OR status='active'";
                        $this->db->where($where);

    */

    function from_where_data($type, $tabla, $data, $select = '*', $orderBy = 'id') {
        $this->db->select($select);
        $this->db->from($tabla);
        $this->db->where($data);
        $this->db->order_by($orderBy);
        //return $this->db->get_compiled_select();
        if ($type == 'get') {
            return $this->db->get();
        } if ($type == 'one')  {
            return $this->db->get()->row();
        } if ($type == 'list') {
            return $this->db->get()->result();
        } if ($type == 'count') {
            return $this->db->count_all_results();
        }
        return $this->db->get()->result();
    }
    
    function list_where_data($tabla, $data, $select = '*', $orderBy = 'id') {
        return $this->from_where_data('list', $tabla, $data, $select, $orderBy);
    }
}