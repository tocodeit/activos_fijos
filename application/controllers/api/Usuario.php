<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model('datos');
        $this->load->model('usuarios');

        header('Content-Type: application/json');
    }

    public function new() {
        $nit = $this->input->post('nit');

        $data = array(
            'nit'       => $nit,
            'nombre'    => $this->input->post('nombre'),
            'pass_'     => sha1($this->input->post('pass')),
            'direccion' => $this->input->post('direccion'),
            'telefono'  => $this->input->post('telefono'),
            'is_admin'  => $this->input->post('administrador'),
        );

        echo json_encode(
            $this->usuarios->to_save($nit, $data),
        );
    }

    public function check_actual_password() {
        $pass = $this->input->post('value');

        $data = $this->datos->from_where_data('count', 'usuarios', array(
            'nit'    => $this->session->userdata('s_idUsuario'),
            'pass_' => sha1($pass)
        ));

        echo json_encode($data == 1);
    }

    public function new_pass() {
        $pass = $this->input->post('value');

        $data = $this->usuarios->update($this->session->userdata('s_idUsuario'), array('pass_' => sha1($pass)));

        echo json_encode($data == 1);
    }
}

