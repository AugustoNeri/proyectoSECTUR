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
			
		

		$numcon=$_POST['con'];
		if($numcon==1){
			$ur=$_POST['ur'];
				$sql1 =  "Select noplauni,filiacion,id_ramo,id_ur,f_baja,id_baja,rfc,
	curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
	from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
						left outer join persona on plantilla.id_empleado=persona.id_empleado where id_baja> 0 and status=2 and id_ur='$ur'";
		}
		if($numcon==2){
			$nom=$_POST['nom'];
			$sql1 =  "Select noplauni,filiacion,id_ramo,id_ur,f_baja,id_baja,rfc,
	curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
	from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
						left outer join persona on plantilla.id_empleado=persona.id_empleado
						where id_baja> 0 and status=2 and (nombre like '%$nom%' 
						or a_paterno like '%$nom%' or a_materno  like '%$nom') order by a_paterno asc";
					}
		if($numcon==3){
			$ur=$_POST['ur'];
			$nom=$_POST['nom'];
			$sql1 =  "Select noplauni,filiacion,id_ramo,id_ur,f_baja,id_baja,rfc,curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
					from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
						left outer join persona on plantilla.id_empleado=persona.id_empleado 
						where id_baja> 0 and status=2 and (nombre like '%$nom%' or a_paterno like '%$nom%' or a_materno  like '%$nom%') 
					and id_ur='$ur' order by a_paterno asc";
		}
		
		
		
	$resultado1= @mysql_query($sql1);
	if (!$resultado1)
	{
	 exit ('error en la consulta');
	
	
    }
			$fila=2;
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("Augusto Neri")->setDescription("BAJAS");
			
			$objPHPExcel->setActiveSheetIndex(0);
			
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle("Bajas");
			
 //Ancho de las columnas
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);	
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
			
 
			//Encabezado
			$objPHPExcel->getActiveSheet()->setCellValue('A1','NOPLA_UNI||NOPLA_PUESTO||NOPLA_PLAZA');
			$objPHPExcel->getActiveSheet()->setCellValue('B1','RAMO1');
			$objPHPExcel->getActiveSheet()->setCellValue('C1','UNIDAD2');
			$objPHPExcel->getActiveSheet()->setCellValue('D1','FECHA BAJA');
			$objPHPExcel->getActiveSheet()->setCellValue('E1','MOTIVO');
			$objPHPExcel->getActiveSheet()->setCellValue('F1','RFC_SP19');
			$objPHPExcel->getActiveSheet()->setCellValue('G1','CURP');
			$objPHPExcel->getActiveSheet()->setCellValue('H1','NOMBRE');
			$objPHPExcel->getActiveSheet()->setCellValue('I1','A_PATERNO');
			$objPHPExcel->getActiveSheet()->setCellValue('J1','A_MATERNO');
			$objPHPExcel->getActiveSheet()->setCellValue('K1','NUM_EMPLEADO');
			
			while($row = mysql_fetch_array ($resultado1)){
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $row['noplauni']);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$row['id_ramo']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila,$row['id_ur']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,$row['f_baja']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$row['id_baja']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila,$row['rfc']);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$fila,$row['curp']);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$fila,$row['nombre']);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$fila,$row['a_paterno']);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$fila,$row['a_materno']);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$fila,$row['id_empleado']);
			
				$fila++;
				
				
				
			}
			/*header("Content-Type: 
			application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
			header('Content-Disposition: attachment;filename="Rusp.xls"');
			header('Cache-Control: max-age=0');*/
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="RUSP_BAJAS.xls"');
			header('Cache-Control: max-age=0');

			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');	
			$objWriter->save('php://output');
			
		
		
		
		
mysql_close($conexion);
?>	 