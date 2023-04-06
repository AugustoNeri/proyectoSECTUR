<?php

	require 'excel/Classes/PHPExcel.php';
	$dbhost="localhost";  // host del MySQL (generalmente localhost)
$dbusuario="root"; // aqui debes ingresar el nombre de usuario
                      // para acceder a la base
$dbpassword=""; // password de acceso para el usuario de la
                      // linea anterior
$db="singirh";        // Seleccionamos la base con la cual trabajar
$conexion = @mysql_connect($dbhost, $dbusuario,$dbpassword);

if (!$conexion)
   {
	exit('<p>No pudo realizarce la conexión a la base de datos.</p>');
   }
if (!@mysql_select_db($db, $conexion))
   {
	echo mysql_errno();
	exit ('<p>Problema al seleccionar la base de datos $db.</p>');
   } 
if (!$_POST /*and !$_Get*/)
        { //evalua si se enviaron los datos del formulario
			
				
			$sql =  "Select id_rfi_riuf,clv_rfi_riuf,id_ur,institucion,id_ef,entidad,id_md,muni_del,colonia,vialidad,
					no_exterior,no_interior,uso_nombre,codigoPostal
					from rfi_riuf left join tcat_municipios on rfi_riuf.id_municipio=tcat_municipios.id_md
					left join tcat_entidades_federativas on tcat_municipios.id_entpais=tcat_entidades_federativas.id_ef";

	$resultado1= @ mysql_query ($sql);
	if (!$resultado1)
	{
	 exit ('error en la consulta');
	
    }
			$fila=2;
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("Augusto Neri")->setDescription("Reporte rfi_riuf");
			
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle("rfi_riuf");
			
 //Ancho de las columnas
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(10);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
		
			//Encabezado
			$objPHPExcel->getActiveSheet()->setCellValue('A1','ID');
			$objPHPExcel->getActiveSheet()->setCellValue('B1','CLV_RFI_RIUF');
			$objPHPExcel->getActiveSheet()->setCellValue('C1','UR');
			$objPHPExcel->getActiveSheet()->setCellValue('D1','INSTITUCION');
			$objPHPExcel->getActiveSheet()->setCellValue('E1','ID_EDO');
			$objPHPExcel->getActiveSheet()->setCellValue('F1','ESTADO');
			$objPHPExcel->getActiveSheet()->setCellValue('G1','ID_MUNI');
			$objPHPExcel->getActiveSheet()->setCellValue('H1','MUNICIPIO');
			$objPHPExcel->getActiveSheet()->setCellValue('I1','COLONIA');
			$objPHPExcel->getActiveSheet()->setCellValue('J1','VIALIDAD');
			$objPHPExcel->getActiveSheet()->setCellValue('K1','NO_EXTERIOR');
			$objPHPExcel->getActiveSheet()->setCellValue('L1','NO_INTERIOR');
			$objPHPExcel->getActiveSheet()->setCellValue('M1','USO_NOMBRE');
			$objPHPExcel->getActiveSheet()->setCellValue('N1','CODIGO_POSTAL');
			
			
			while($row = mysql_fetch_array ($resultado1)){
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,$row['id_rfi_riuf']);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$row['clv_rfi_riuf']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila,$row['id_ur']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,$row['institucion']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$row['id_ef']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila,$row['entidad']);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$fila,$row['id_md']);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$fila,$row['muni_del']);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$fila,$row['colonia']);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$fila,$row['vialidad']);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$fila,$row['no_exterior']);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$fila,$row['no_interior']);
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$fila,$row['uso_nombre']);
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$fila,$row['codigoPostal']);
				
				$fila++;
				
			}
			/*header("Content-Type: 
			application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
			header('Content-Disposition: attachment;filename="Rusp.xls"');
			header('Cache-Control: max-age=0');*/
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="rfi_riuf.xls"');
			header('Cache-Control: max-age=0');

			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');	
			$objWriter->save('php://output');
			
		}
mysql_close($conexion);
?>	 