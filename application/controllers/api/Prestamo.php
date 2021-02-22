<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestamo extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model('datos');
        $this->load->model('prestamos');

        header('Content-Type: application/json');
    }

    public function add() {
        $id_prestamo = $this->input->post('id');

        $data_prestamo = array(
            'fecha'         => $this->input->post('fecha'),
            'observacion'   => $this->input->post('txt_observacion'),
            'id_usuario'    => $this->session->userdata('s_idUsuario')
        );
        $data_detalle = array(
            'codigo'        => $this->input->post('codigo'),
            'descripcion'   => $this->input->post('descripcion'),
            'cantidad'      => $this->input->post('cantidad')
        );

        echo json_encode(array(
            'id' => $id_prestamo, 'prestamo' => $data_prestamo, 'detalle' => $data_detalle,
            'res' => $this->prestamos->add($id_prestamo, $data_prestamo, $data_detalle)
        ));
    }

    public function update_prestamo($id_prestamo, $estado = 2) {
        if ($estado < 2 && $estado > 5) {
            return 0;
        }

        if ($estado == 2) { $estado = 'CONFIRMADO'; }
        if ($estado == 3) { $estado = 'ENTREGADO'; }
        if ($estado == 4) { $estado = 'ANULADO'; }

        echo $this->prestamos->update_prestamo($id_prestamo, $estado);
    }

    public function delete_detalle($id_prestamo, $id) {
        echo json_encode(array(
            'delete' => $this->prestamos->delete_detalle($id_prestamo, $id),
            'detalle' => $this->datos->list_from_where('detalles_prestamo', 'id_prestamo', $id_prestamo)
        ));
    }

    public function list($estado) {
        
        if ($estado < 0 && $estado > 6) {
            return 0;
        }

        if ($estado == 1) { $where_in = array('SOLICITADO', 'CONFIRMADO'); }
        if ($estado == 2) { $where_in = array('SOLICITADO'); }
        if ($estado == 3) { $where_in = array('CONFIRMADO'); }
        if ($estado == 4) { $where_in = array('ANULADO'); }
        if ($estado == 5) { $where_in = array('ENTREGADO'); }

        echo json_encode(array(
            'list'      => $this->prestamos->list($where_in),
            'estado'    => $estado,
            'where_in'  => $where_in,
        ));
    }

    public function detalle_prestamo($id_prestamo) {
        echo json_encode(
            $this->prestamos->detalle_prestamo($id_prestamo)
        );
    }

    public function activos_fuera_de_fecha() {
        echo json_encode(
            $this->prestamos->activos_fuera_de_fecha()
        );
    }

    public function mis_solicitudes($id_usuario) {
        echo json_encode(
            $this->prestamos->mis_solicitudes($id_usuario)
        );
    }

    public function entregar_activos() {
        $id_prestamo = $this->input->post('id_prestamo');

        echo json_encode(array(
            'id'    => $id_prestamo,
            'res'   => $this->prestamos->entregar_activos($id_prestamo),
        ));
    }
}
?>