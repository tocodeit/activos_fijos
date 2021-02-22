<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Datos extends CI_Controller {

    public function __construct() {
		parent::__construct();		
        $this->load->model('mcomun'); 

        header('Content-Type: application/json');
    }

    public function index() {
		$this->load->view('headers');
		$idUsuario = $this->session->userdata('s_idUsuario');
        
        $data['ventana']= 'compra';
        $data['menu']= $this->mmenu->cargarMenu($idUsuario);
        $data['tipo']= $this->session->userdata('s_tipo');
        $data['nombreUsuario']= $this->session->userdata('s_nombre');

		$this->load->view('menu', $data);
        $this->load->view('footer');
    }

    public function list_all($table) {
        $idUsuario = $this->session->userdata('s_idUsuario');
        if ($idUsuario != null) {
            echo json_encode($this->mcomun->list_from($table));
        }
    }

    public function list_from_like($table, $field, $value = '') {
        $idUsuario = $this->session->userdata('s_idUsuario');
        if ($idUsuario != null) {
            echo json_encode($this->mcomun->list_from_like($table, $field, $value));
        }
    }

    public function list_where($table, $field, $value = '') {
        $idUsuario = $this->session->userdata('s_idUsuario');
        if ($idUsuario != null) {
            echo json_encode($this->mcomun->list_from_where($table, $field, $value));
        }
    }

    public function one_by_id($table, $id) {
        //$idUsuario = $this->session->userdata('s_idUsuario');
        //if ($idUsuario != null) {
            echo json_encode($this->mcomun->row_from_by_id($table, $id));
        //}
    }
}