<?php

	require 'archivosexcel/excel/Classes/PHPExcel.php';
	$dbhost="localhost";  // host del MySQL (generalmente localhost)
$dbusuario="root"; // aqui debes ingresar el nombre de usuario
                      // para acceder a la base
$dbpassword=""; // password de acceso para el usuario de la
                      // linea anterior
$db="singirh";        // Seleccionamos la base con la cual trabajar
$conexion = @mysql_connect($dbhost, $dbusuario,$dbpassword);
header("Content-Type: text/html;charset=utf-8");
mysql_query("SET NAMES 'utf8'");
if (!$conexion)
   {
	exit('<p>No pudo realizarce la conexión a la base de datos.</p>');
   }
if (!@mysql_select_db($db, $conexion))
   {
	echo mysql_errno();
	exit ('<p>Problema al seleccionar la base de datos $db.</p>');
   } 
         //evalua si se enviaron los datos del formulario
			
		$sql =  "Select id_ramo,puestos.id_ur,ur,codigo_puesto,deno_puesto,f_ingr_sectur,f_ingr_apf,f_ingr_spc,f_baja,plantilla.id_baja,m_baja,
	rfc,curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
	from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
				left outer join persona on plantilla.id_empleado=persona.id_empleado 
				left outer join tcat_motivo_baja on plantilla.id_baja=tcat_motivo_baja.id_baja 
				left outer join tcat_ur on puestos.id_ur=tcat_ur.id_ur where status=2 order by puestos.id_ur asc,a_paterno asc,nombre asc";
		
		
	$resultado1= @mysql_query($sql);
	if (!$resultado1)
	{
	 exit ('error en la consulta');
	
	
    }
			$fila=2;
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("Augusto Neri")->setDescription("Reporte Personas Bajas");
			
			$objPHPExcel->setActiveSheetIndex(0);
			
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle("Bajas");
			
 //Ancho de las columnas
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(25);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
		
			
 
			//Encabezado
			$objPHPExcel->getActiveSheet()->setCellValue('A1','RAMO');
			$objPHPExcel->getActiveSheet()->setCellValue('B1','UR');
			$objPHPExcel->getActiveSheet()->setCellValue('C1','UNIDAD DE ADSCRIPCION');
			$objPHPExcel->getActiveSheet()->setCellValue('D1','CODIGO DE PUESTO');
			$objPHPExcel->getActiveSheet()->setCellValue('E1','DENOMINACION DE PUESTO');
			$objPHPExcel->getActiveSheet()->setCellValue('F1','FECHA_INGR_SECTUR');
			$objPHPExcel->getActiveSheet()->setCellValue('G1','FECHA_INGR_APF');
			$objPHPExcel->getActiveSheet()->setCellValue('H1','FECHA_INGR_SPC');
			$objPHPExcel->getActiveSheet()->setCellValue('I1','FECHA BAJA');
			$objPHPExcel->getActiveSheet()->setCellValue('J1','MOTIVO');
			$objPHPExcel->getActiveSheet()->setCellValue('K1','RFC_SP19');
			$objPHPExcel->getActiveSheet()->setCellValue('L1','CURP');
			$objPHPExcel->getActiveSheet()->setCellValue('M1','NOMBRE');
			$objPHPExcel->getActiveSheet()->setCellValue('N1','A_PATERNO');
			$objPHPExcel->getActiveSheet()->setCellValue('O1','A_MATERNO');
			$objPHPExcel->getActiveSheet()->setCellValue('P1','NO_EMP');
			
			
			while($row = mysql_fetch_array ($resultado1)){
				
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,$row['id_ramo']);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$row['id_ur']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila,$row['ur']);				
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,$row['codigo_puesto']);				
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$row['deno_puesto']);				
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila,$row['f_ingr_sectur']);				
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$fila,$row['f_ingr_apf']);				
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$fila,$row['f_ingr_spc']);				
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$fila,$row['f_baja']);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$fila,$row['m_baja']);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$fila,$row['rfc']);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$fila,$row['curp']);
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$fila,$row['nombre']);
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$fila,$row['a_paterno']);
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$fila,$row['a_materno']);
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$fila,$row['id_empleado']);
			
				$fila++;
				
				
				
			}
			/*header("Content-Type: 
			application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
			header('Content-Disposition: attachment;filename="Rusp.xls"');
			header('Cache-Control: max-age=0');*/
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="PLANTILLA_HISTORICA_BUS.xls"');
			header('Cache-Control: max-age=0');

			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');	
			$objWriter->save('php://output');
			
		
		
		
		
mysql_close($conexion);
?>	 