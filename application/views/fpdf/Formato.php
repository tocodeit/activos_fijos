<?php
class Formato extends FPDF {

    public $empresa;
        
    public function __construct($infEmpresa){
        parent::__construct();		       
        $this->empresa = json_decode($infEmpresa);        
    }

    // Cabecera de página
    function Header() {   
        $this->metropolisFonts();
        
        /* $this->Image(base_url().'img/logo.jpg',1.5,3,33); */
        
        $this->SetFont('Highland','',12); 
        $this->Cell(0, 5, $this->empresa->nombre,0,2,'C');
        $this->SetFont('Helvetica LT','',10);
        $this->Cell(0, 3, $this->empresa->linea1,0,2,'C');
        $this->Cell(0, 3, $this->empresa->linea2,0,2,'C');
        $this->Cell(0, 3, $this->empresa->linea3,0,2,'C');  

        $this->ln(4);
    }

    // Pie de página
    function Footer() {
        $this->SetY(-10);
        $this->SetFont('Helvetica LT','',9);
        $this->Cell(0,4,'Page '.$this->PageNo().'/{nb}',0,0,'C');        
        
        $this->Cell(0,4,'http://www.humboldt.org.co/es/',0,0,'R');
    }

    function metropolisFonts() {
        $this->AddFont('Highland','','HighlandGothicFLF.php');
        $this->AddFont('Highland','B','HighlandGothicFLF-Bold.php');
        $this->AddFont('Helvetica LT','','Helvetica LT 57 Condensed.php');
        $this->AddFont('Helvetica LT','B','Helvetica LT 77 Bold Condensed.php');
    }
}

?>