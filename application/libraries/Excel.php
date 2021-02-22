<?php if (!defined('BASEPATH')) exit('No direct script access allowed');  
require_once('PhpExcel/PHPExcel.php');

class Excel extends PHPExcel{

    public function __construct() {
        parent::__construct();
    }

    function to_excel($data, $filename) {
        $h = array();
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);

        foreach($data as $row){
            foreach($row as $key=>$val){
                if(!in_array($key, $h)){
                    $h[] = $key;   
                }
            }
        }

        $column = 0;
        foreach($h as $key) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, strtoupper($key));
            $column++;
        }

        $excel_col = 0;
        $excel_row = 2;
        foreach ($data as $artic) {
            $excel_col = 0;
            foreach($h as $key) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($excel_col, $excel_row, $artic[$key]);
                $excel_col++;
            }
            $excel_row++;
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$filename.'.xlsx"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel2007');
        $objWriter->save('php://output');
    }
}
?>