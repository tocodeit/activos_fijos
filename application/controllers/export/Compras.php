<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compras extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model('mcomun');
        $this->load->model('mpedidos');

        $this->load->library('excel');
    }    

    public function set_data() {
        header('Content-Type: application/json');
        $report = $this->session->userdata('report');

        $txt_filtro = $this->input->post('txt_filtro');
        $tipo_fecha = $this->input->post('cmb_fecha');
        $desde      = $this->input->post('date_desde');
        $hasta      = $this->input->post('date_hasta');

        $uuid = uniqid();
        $report[$uuid] = array(
            'txt_filtro' => $this->input->post('txt_filtro'),
            'cmb_fecha' => $this->input->post('cmb_fecha'),
            'desde' => $this->input->post('date_desde'),
            'hasta' => $this->input->post('date_hasta'),
        );

        $this->session->set_userdata('report', $report);
        echo json_encode(array(
            'uuid_'     => $uuid,
            'report'    => $report
        ));
    }

    public function excel($uuid) {
        $report = $this->session->userdata('report');

        $data = array(
            array('key' => 'fac.FAC_CEDULA', 'value' => $report[$uuid]['txt_filtro']),
            array('key' => 'pro.CLI_NOMBRE', 'value' => $report[$uuid]['txt_filtro'])
        );
        $report[$uuid]['desde'];
        $report[$uuid]['hasta'];

        $list = $this->mpedidos->list_compras_pendientes($data, $report[$uuid]['cmb_fecha'], $report[$uuid]['desde'],  $report[$uuid]['hasta'], 'array');

        $uuid = uniqid();
        $this->excel->to_excel($list, $uuid);
    }
}
?>