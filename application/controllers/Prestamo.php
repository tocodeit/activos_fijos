<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestamo extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model('mcomun');
    }

    public function index() {
        $data = array( 
            'modulo' => 'Prestamos',            
            'page' => 'index'            
        );
        
        $this->load->view('templates/headers', $data);
        $this->load->view('templates/footer');
    }

    public function solicitar() {
        $data = array( 
            'modulo' => 'Prestamos',            
            'page' => 'solicitar'            
        );
        
        $this->load->view('templates/headers', $data);
        $this->load->view('prestamo/solicitar');
        $this->load->view('templates/footer');
    }

    public function mis_solicitudes() {
        $data = array( 
            'modulo' => 'Prestamos',            
            'page' => 'mis_solicitudes'            
        );
        
        $this->load->view('templates/headers', $data);
        
        $this->load->view('prestamo/mis_solicitudes');
        $this->load->view('templates/footer');
    }


    public function solicitudes() {
        $data = array( 
            'modulo' => 'Prestamos',            
            'page' => 'solicitudes'            
        );
        
        $this->load->view('templates/headers', $data);
        $this->load->view('prestamo/admin/prestamos');
        $this->load->view('templates/footer');
    }

    public function entrega() {
        $data = array( 
            'modulo' => 'Prestamos',            
            'page' => 'entrega'            
        );
        
        $this->load->view('templates/headers', $data);
        $this->load->view('prestamo/admin/entrega');
        $this->load->view('templates/footer');
    }
    public function entregados() {
        $data = array( 
            'modulo' => 'Prestamos',            
            'page' => 'entregados'            
        );
        
        $this->load->view('templates/headers', $data);
        $this->load->view('prestamo/admin/entregados');
        $this->load->view('templates/footer');
    }

    public function sin_entregar() {
        $data = array( 
            'modulo' => 'Prestamos',            
            'page' => 'sin_entregar'            
        );
        
        $this->load->view('templates/headers', $data);
        $this->load->view('prestamo/admin/sin_entregar');
        $this->load->view('templates/footer');
    }
}
?>