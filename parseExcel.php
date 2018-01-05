<?php
function parse_excel_file( $filename ){
	require_once dirname('__FILE__') . '/PHPExcel/Classes/PHPExcel.php';

	$result = array();
	$file_type = PHPExcel_IOFactory::identify( $filename );
	$objReader = PHPExcel_IOFactory::createReader( $file_type );
	$objPHPExcel = $objReader->load( $filename );
	$result = $objPHPExcel->getActiveSheet()->toArray();

	foreach ($result as &$value) {
    	$value = str_replace('"', '\"', $value);
    	$value = str_replace(null, '', $value);
    	$value = str_replace('≥', '', $value);
	}

	return $result;
}

