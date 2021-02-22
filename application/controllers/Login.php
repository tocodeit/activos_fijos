<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('mlogin');
    } 
    
    public function index() {
        $this->load->view('templates/login');
    }

	public function ingresar() {
		if(!empty($this->input->post('txtUsuario')) && !empty($this->input->post('txtPassword'))){
				$datos['usuario'] = $this->input->post('txtUsuario');
				$datos['password'] = sha1($this->input->post('txtPassword'));
				//$datos['password'] = $this->input->post('txtPassword');
				$usuario = $this->mlogin->ingresar($datos);


				if ($usuario == 2) {
					redirect('prestamo/solicitudes', 'location');
				}
				if ($usuario == 1) {
					redirect('/prestamo/solicitar', 'location');
				} else {
					echo "	<div class='row'><div class='col-md-4 mx-auto'> 
								<div class='alert alert-danger' role='alert'>¡Usuario o contraseña incorrectos!</div>
							</div></div>";
					$this->load->view('templates/login');
				}
		} else {
			echo "	<div class='col-md-4 mx-auto'>
						<div class='alert alert-danger' role='alert'>¡Debe completar los campos!</div>
					</div>";
			$this->load->view('templates/login');
		}		
	}

	public function registro() {

		$data = array(
            'modulo' => 'Registro',            
            'page'   => 'registro'            
        );
        
        $this->load->view('templates/headers_', $data);
        $this->load->view('sistema/usuarios');
        $this->load->view('templates/footer');
	}

	public function salir() {
		$this->session->unset_userdata('s_idUsuario');
		$this->session->unset_userdata('s_nombre');
		$this->session->unset_userdata('s_is_admin');

		$this->load->view('templates/login');
	}
}
