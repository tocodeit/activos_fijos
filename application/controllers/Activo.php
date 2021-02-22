<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activo extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model('datos');
        $this->load->model('activos');
    }

    public function index() {
        $data = array( 
            'modulo' => 'Prestamos',            
            'page' => 'activo'            
        );
        
        $this->load->view('templates/headers', $data);
        $this->load->view('prestamo/admin/activo');
        $this->load->view('templates/footer');
    }
    
}

