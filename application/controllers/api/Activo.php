<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activo extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model('datos');
        $this->load->model('activos');

        header('Content-Type: application/json');
    }

    public function one($id) {
        echo json_encode($this->datos->one_from_where('activos', 'codigo', $id));
    }

    public function list() {
        $filtro = $this->input->post('filtro');

        echo json_encode($this->activos->list($filtro));
    }
    
}

