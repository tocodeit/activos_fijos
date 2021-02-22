<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Model {
	function __construct() {
		parent::__construct();
        $this->load->database();
    }

    function to_save($nit, $data) {
        $list = $this->list('nit', $nit);

        $res = 0;
        if (count($list) == 0) {
            $res = $this->db->insert('usuarios', $data);
        } 

        return array(
            'id'    => $nit,
            'data'  => $data,
            'res'  => $res
        );
    }

    function update($nit, $data) {
        $this->db->update('usuarios', $data, array('nit' => $nit));
        return $this->db->affected_rows();
    }

    function list($field, $value) {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where($field, $value);
        
        return $this->db->get()->result();
    }

    
}