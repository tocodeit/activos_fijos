<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class toFpdf {
 
    public function __construct($inf) {
        require_once APPPATH.'libraries\third_party\fpdf\fpdf.php';
        $pdf = new FPDF($inf[0], $inf[1], $inf[2], $inf[3], count($inf) > 4 ? $inf[4] : '' );
        
        $CI =& get_instance();
        $CI->fpdf = $pdf;
    }

}