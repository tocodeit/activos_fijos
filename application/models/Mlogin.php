<?php  if(! defined('BASEPATH')) exit('No direct script access allowed');

class Mlogin extends CI_Model {
	
	function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function ingresar($datos) {

		$this->db->select('U.*');
		$this->db->from('usuarios U');
		$this->db->where('nit',		$datos['usuario']);
		$this->db->where('pass_', 	$datos['password']);

		//return $this->db->get_compiled_select();
		$resultado = $this->db->get();

		if ($resultado->num_rows() == 1) {
			$usuario = $resultado->row();
			$sessionUsuario = array(
				's_idUsuario' 			=> $usuario->nit,
				's_nombre' 				=> $usuario->nombre,
				's_is_admin' 			=> $usuario->is_admin,
			);
			$this->session->set_userdata($sessionUsuario);
			
			if($usuario->is_admin == 1) {
				return 2;				
			} else {
				return 1;
			}
		} else {
			return 0;
		}
	}
}
?>