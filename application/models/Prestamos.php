<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Prestamos extends CI_Model {
	function __construct() {
		parent::__construct();
        $this->load->database();

        $this->load->model('datos');
    }

    function add($id_prestamo, $data, $detalle) {
        $errors = array();

        $this->db->trans_start();
        if ($id_prestamo == 0) {
            $this->db->insert('prestamos', $data);
            $id_prestamo = $this->db->insert_id();
        }
        
        $detalle['id_prestamo'] = $id_prestamo;

        // existe el codigo en el prestamo
        $codigo_in = $this->datos->from_where_data('one', 'detalles_prestamo', array('codigo' => $detalle['codigo'], 'id_prestamo' => $id_prestamo));
        if (isset($codigo_in)) {
            $id_detalle = $codigo_in->id;
            $this->db->update('detalles_prestamo', array('cantidad' => $detalle['cantidad']), array('id' => $id_detalle));
            
        } else {
            $this->db->insert('detalles_prestamo', $detalle);
            $id_detalle = $this->db->insert_id();
        }
        
        // verificando cantidades
        /* $activo = $this->datos->one_from_where('activos', 'codigo', $detalle['codigo']);
        if (isset($activo)) {
            if ($activo->cantidad < $detalle['cantidad']) {
                array_push($errors, "El articulo $detalle['descripcion'] no tiene suficientes cantidades, solicitadas: $detalle['cantidad'] disponible: $activo->cantidad");
            }
        } */

        if (count($errors) > 0) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_complete();
        }
        
        return array(   'id_prestamo' => $id_prestamo, 'id_detalle' => $id_detalle,
                        'existe'  => $codigo_in, 
                        'detalle' => $this->datos->list_from_where('detalles_prestamo', 'id_prestamo', $id_prestamo)
                    );
    }

    function update_prestamo($id_prestamo, $estado) {
        return $this->db->update('prestamos', array('estado' => $estado), array('id' => $id_prestamo));
    }

    function delete_detalle($id_prestamo, $id_detalle) {
        return $this->db->delete('detalles_prestamo', array('id' => $id_detalle, 'id_prestamo' => $id_prestamo));
    }

    function list($estados, $order_by = 'p.fecha DESC, p.id DESC') {
        $this->db->select('p.id, p.fecha, u.nombre, dp.tot, p.observacion, p.estado');
        $this->db->from('prestamos p');
        $this->db->join('usuarios u', 'p.id_usuario = u.nit');
        $this->db->join('(SELECT dp.id_prestamo, COUNT(dp.id) tot FROM detalles_prestamo dp GROUP BY dp.id_prestamo) dp', 'dp.id_prestamo = p.id');
        $this->db->where_in('p.estado', $estados);
        $this->db->order_by($order_by);

        //return $this->db->get_compiled_select();
        return $this->db->get()->result();
    }

    function responsables_activos($estados, $order_by = 'p.fecha DESC, p.id DESC') {
        $this->db->select('p.id, p.fecha, u.nombre, dp.tot, p.observacion, p.estado, dp_.codigo, dp_.descripcion, dp_.cantidad');
        $this->db->from('prestamos p');
        $this->db->join('usuarios u', 'p.id_usuario = u.nit');
        $this->db->join('(SELECT dp.id_prestamo, COUNT(dp.id) tot FROM detalles_prestamo dp GROUP BY dp.id_prestamo) dp', 'dp.id_prestamo = p.id');
        $this->db->join('detalles_prestamo dp_', 'dp_.id_prestamo = p.id');
        $this->db->where_in('p.estado', $estados);
        $this->db->order_by($order_by);

        //return $this->db->get_compiled_select();
        return $this->db->get()->result();
    }

    function activos_fuera_de_fecha($order_by = 'p.fecha, p.id DESC') {
        $this->db->select("p.id, p.fecha, DATEDIFF(NOW(), p.fecha) dif, u.nombre, u.telefono, dp.tot, p.observacion, p.estado, dp_.codigo, dp_.descripcion, dp_.cantidad");
        $this->db->from('prestamos p');
        $this->db->join('usuarios u', 'p.id_usuario = u.nit');
        $this->db->join('(SELECT dp.id_prestamo, COUNT(dp.id) tot FROM detalles_prestamo dp GROUP BY dp.id_prestamo) dp', 'dp.id_prestamo = p.id');
        $this->db->join('detalles_prestamo dp_', 'dp_.id_prestamo = p.id');
        $this->db->where('p.estado', 'CONFIRMADO');
        $this->db->where('p.fecha <', date('Y-m-d'));
        $this->db->order_by($order_by);

        //return $this->db->get_compiled_select();
        return $this->db->get()->result();
    }

    function mis_solicitudes($id, $order_by = 'p.fecha DESC, p.id DESC') {
        $this->db->select("p.id, p.fecha, DATEDIFF(NOW(), p.fecha) dif, u.nombre, u.telefono, dp.tot, p.observacion, p.estado, dp_.codigo, dp_.descripcion, dp_.cantidad");
        $this->db->from('prestamos p');
        $this->db->join('usuarios u', 'p.id_usuario = u.nit');
        $this->db->join('(SELECT dp.id_prestamo, COUNT(dp.id) tot FROM detalles_prestamo dp GROUP BY dp.id_prestamo) dp', 'dp.id_prestamo = p.id');
        $this->db->join('detalles_prestamo dp_', 'dp_.id_prestamo = p.id');
        $this->db->where('p.id_usuario', $id);

        $this->db->order_by($order_by);

        //return $this->db->get_compiled_select();
        return $this->db->get()->result();
    }

    function detalle_prestamo($id_prestamo) {
        $this->db->select('dp.*, a.cantidad stock');
        $this->db->from('detalles_prestamo dp');
        $this->db->join('activos a', 'a.codigo = dp.codigo');
        $this->db->where('dp.id_prestamo', $id_prestamo);

        return $this->db->get()->result();
    }

    function entregar_activos($id_prestamo) {
        $errors = array();

        $this->db->trans_start();

        $list = $this->detalle_prestamo($id_prestamo);

        foreach ($list as $item) {
            $activo = $this->datos->one_from_where('activos', 'codigo', $item->codigo);
            if (isset($activo)) {
                if ($activo->cantidad < $item->cantidad) {
                    array_push($errors, "El activo $item->descripcion no tiene suficientes cantidades, solicitadas: $item->cantidad disponible: $activo->cantidad");
                } else {
                    // descontando cantidades de activo
                    $this->db->update('activos', array('cantidad' => $activo->cantidad - $item->cantidad), array('codigo' => $activo->codigo));
                }
            } else {
                array_push($errors, "El activo $item->codigo no existe");
            }
        }

        if (count($errors) > 0) {
            $this->db->trans_rollback();
        } else {
            $this->db->update('prestamos', array('estado' => 'ENTREGADO'), array('id' => $id_prestamo));

            $this->db->trans_complete();
        }

        return array(   'id_prestamo' => $id_prestamo, 
                        'errors'  => $errors, 
                        'detalle' => $this->datos->list_from_where('detalles_prestamo', 'id_prestamo', $id_prestamo)
                    );
    }
}