<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imprimir extends CI_Controller {

	public function __construct() {
		parent::__construct();
        $this->load->model('datos');
        $this->load->model('prestamos');
    }

    public function activos() {
        if(empty($this->session->userdata('s_idUsuario'))){
            redirect(base_url().'/modulos', 'location');
        } 

        $empresa = $this->datos->from('one', 'empresa');
        
        // datos clientes
        $list = $this->datos->list_where_data('activos', array('cantidad > 0'), '*', 'descripcion');

        $data['infEmpresa'] = json_encode($empresa);
        $data['orientacion'] = 'P';
        $data['size'] = 'letter';
        $data['list'] = $list;

        $inf = array($data['orientacion'], 'mm',$data['size'], json_encode($empresa));
        
        $this->load->library('toFpdf', $inf);

        $this->load->view('fpdf/formato');
        $fpdf = new Formato(json_encode($empresa));
        $fpdf->AliasNbPages();
        $fpdf->SetMargins(5,5,5);

        $fpdf->AddPage($data['orientacion'], $data['size']);
        
        $h = 4;
        $fpdf->SetFont('Helvetica LT','B', 10);

        $fpdf->Cell(20, $h, 'CODIGO');
        $fpdf->Cell(160, $h, 'DESCRIPCION');
        $fpdf->Cell(0, $h, 'CANTIDAD', 0, 1);

        $fpdf->SetFont('Helvetica LT','',9);
        foreach ($list as $row) {
            $fpdf->Cell(20, $h, $row->codigo);
            $fpdf->Cell(160, $h, $row->descripcion);
            $fpdf->Cell(0, $h, number_format($row->cantidad), 0, 1, 'R');
        }

        $fpdf->Output('I', 'activos_actuales.pdf');
    }

    public function responsables_activos() {
        if(empty($this->session->userdata('s_idUsuario'))){
            redirect(base_url().'/modulos', 'location');
        } 

        $empresa = $this->datos->from('one', 'empresa');
        $empresa->linea3 = 'RESPONSABLES DE ACTIVOS ENTREGADOS';
        // datos clientes
        $list = $this->prestamos->responsables_activos(array('ENTREGADO'), 'u.nombre, p.fecha DESC, p.id DESC');

        $data['infEmpresa'] = json_encode($empresa);
        $data['orientacion'] = 'P';
        $data['size'] = 'letter';
        $data['list'] = $list;

        $inf = array($data['orientacion'], 'mm',$data['size'], json_encode($empresa));
        
        $this->load->library('toFpdf', $inf);

        $this->load->view('fpdf/formato');
        $fpdf = new Formato(json_encode($empresa));
        $fpdf->AliasNbPages();
        $fpdf->SetMargins(5,5,5);

        $fpdf->AddPage($data['orientacion'], $data['size']);
        
        $h = 4;
        

        $tercero = '';

        
        foreach ($list as $row) {
            if ($row->nombre != $tercero) {
                $tercero = $row->nombre;
                $fpdf->SetFont('Helvetica LT','B',11);
                $fpdf->Cell(40, $h*2, 'USUARIO:', 0, 0, 'R');
                $fpdf->SetFont('Helvetica LT','',10);
                $fpdf->Cell(0, $h*2, $tercero, 0, 1);

                $fpdf->SetFont('Helvetica LT','B', 10);
                $fpdf->Cell(18, $h, 'PRESTAMO');
                $fpdf->Cell(18, $h, 'FECHA');
                $fpdf->Cell(15, $h, 'CODIGO');
                $fpdf->Cell(130, $h, 'DESCRIPCION');
                $fpdf->Cell(0, $h, 'CANTIDAD', 0, 1);

                $fpdf->SetFont('Helvetica LT','',9);
            }

            $fpdf->Cell(18, $h, $row->id);
            $fpdf->Cell(18, $h, $row->fecha);
            $fpdf->Cell(15, $h, $row->codigo);
            $fpdf->Cell(130, $h, $row->descripcion);
            $fpdf->Cell(0, $h, number_format($row->cantidad), 0, 1, 'R');
        }

        $fpdf->Output('I', 'activos_actuales.pdf');
    }
}
?>