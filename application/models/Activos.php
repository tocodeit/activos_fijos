<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activos extends CI_Model {
	function __construct() {
		parent::__construct();
        $this->load->database();
    }

    function list($filtro) {
        $this->db->select('*');
        $this->db->from('activos');
        $this->db->like('descripcion', $filtro);
        $this->db->or_like('codigo', $filtro);
        
        $this->db->limit(100);

        return $this->db->get()->result();
    }
}