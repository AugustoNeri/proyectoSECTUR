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
			$sql =  "Select id_ur,persona.id_empleado,persona.nombre,persona.a_paterno,persona.a_materno,persona.curp,persona.rfc,
	sexo,persona.f_nac,entidad,pais,persona.correo_electronico,persona.no_ss,e_conyugal,
	t_discapacidad,nive_e,estatus_e,institucion_ss,persona.PLAZA,status 
	from persona left outer join plantilla on persona.id_empleado=plantilla.id_empleado 
				 left outer join puestos on plantilla.id_puesto=puestos.id_puesto 
				 left outer join tcat_sexo on tcat_sexo.id_sexo=persona.id_sexo 
				 left outer join tcat_entidades_federativas on tcat_entidades_federativas.id_ef=persona.id_enacimiento
				 left outer join tcat_paises on tcat_paises.id_pais=persona.id_pnacimiento
				 left outer join tcat_estado_conyugal on tcat_estado_conyugal.id_econyugal=persona.id_econyugal
				 left outer join tcat_discapacidades on tcat_discapacidades.id_discapacidad=persona.id_discapacidad
				 left outer join tcat_escolaridad on tcat_escolaridad.id_escolaridad=persona.id_escolaridad 
				 left outer join tcat_instituciones_ss on id_institucion=persona.id_institucion_ss where id_ur= '$ur' and status=1
			order by a_paterno asc, a_paterno asc, a_materno asc";
		}
		if($numcon==2){
			$nom=$_POST['nom'];
			$sql =  "Select id_ur,persona.id_empleado,persona.nombre,persona.a_paterno,persona.a_materno,persona.curp,persona.rfc,
	sexo,persona.f_nac,entidad,pais,persona.correo_electronico,persona.no_ss,e_conyugal,
	t_discapacidad,nive_e,estatus_e,institucion_ss,persona.PLAZA,status 
	from persona left outer join plantilla on persona.id_empleado=plantilla.id_empleado 
				 left outer join puestos on plantilla.id_puesto=puestos.id_puesto 
				 left outer join tcat_sexo on tcat_sexo.id_sexo=persona.id_sexo 
				 left outer join tcat_entidades_federativas on tcat_entidades_federativas.id_ef=persona.id_enacimiento
				 left outer join tcat_paises on tcat_paises.id_pais=persona.id_pnacimiento
				 left outer join tcat_estado_conyugal on tcat_estado_conyugal.id_econyugal=persona.id_econyugal
				 left outer join tcat_discapacidades on tcat_discapacidades.id_discapacidad=persona.id_discapacidad
				 left outer join tcat_escolaridad on tcat_escolaridad.id_escolaridad=persona.id_escolaridad 
				 left outer join tcat_instituciones_ss on id_institucion=persona.id_institucion_ss
						 where status=1 and nombre like '%$nom%' or a_paterno like '%$nom%' or a_materno  like '%$nom' 
						 order by a_paterno asc, a_paterno asc, a_materno asc";
					}
		if($numcon==3){
			$ur=$_POST['ur'];
			$nom=$_POST['nom'];
			$sql =  "Select id_ur,persona.id_empleado,persona.nombre,persona.a_paterno,persona.a_materno,persona.curp,persona.rfc,
	sexo,persona.f_nac,entidad,pais,persona.correo_electronico,persona.no_ss,e_conyugal,
	t_discapacidad,nive_e,estatus_e,institucion_ss,persona.PLAZA,status 
	from persona left outer join plantilla on persona.id_empleado=plantilla.id_empleado 
				 left outer join puestos on plantilla.id_puesto=puestos.id_puesto 
				 left outer join tcat_sexo on tcat_sexo.id_sexo=persona.id_sexo 
				 left outer join tcat_entidades_federativas on tcat_entidades_federativas.id_ef=persona.id_enacimiento
				 left outer join tcat_paises on tcat_paises.id_pais=persona.id_pnacimiento
				 left outer join tcat_estado_conyugal on tcat_estado_conyugal.id_econyugal=persona.id_econyugal
				 left outer join tcat_discapacidades on tcat_discapacidades.id_discapacidad=persona.id_discapacidad
				 left outer join tcat_escolaridad on tcat_escolaridad.id_escolaridad=persona.id_escolaridad 
				 left outer join tcat_instituciones_ss on id_institucion=persona.id_institucion_ss
						 where status=1 and (nombre like '%$nom%' or a_paterno like '%$nom%' or a_materno  like '%$nom%') and id_ur='$ur' order by a_paterno asc, a_paterno asc, a_materno asc";
		}
		
		
		
	$resultado1= @mysql_query($sql);
	if (!$resultado1)
	{
	 exit ('error en la consulta');
	
	
    }
			$fila=2;
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("Augusto Neri")->setDescription("Reporte Personas");
			
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle("Personas");
			
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
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15);
			//Encabezado
			$objPHPExcel->getActiveSheet()->setCellValue('A1','UR');
			$objPHPExcel->getActiveSheet()->setCellValue('B1','NO_EMPLEADO');
			$objPHPExcel->getActiveSheet()->setCellValue('C1','NOMBRE');
			$objPHPExcel->getActiveSheet()->setCellValue('D1','A_PATERNO');
			$objPHPExcel->getActiveSheet()->setCellValue('E1','A_MATERNO');
			$objPHPExcel->getActiveSheet()->setCellValue('F1','CURP');
			$objPHPExcel->getActiveSheet()->setCellValue('G1','RFC');
			$objPHPExcel->getActiveSheet()->setCellValue('H1','SEXO');
			$objPHPExcel->getActiveSheet()->setCellValue('I1','FECHA_NAC');
			$objPHPExcel->getActiveSheet()->setCellValue('J1','ENTIDAD_NAC');
			$objPHPExcel->getActiveSheet()->setCellValue('K1','PAIS_NAC');
			$objPHPExcel->getActiveSheet()->setCellValue('L1','CORREO_ELECTRONICO');
			$objPHPExcel->getActiveSheet()->setCellValue('M1','NO_SEGURO_SOCIAL');
			$objPHPExcel->getActiveSheet()->setCellValue('N1','ESTADO_CONYUGAL');
			$objPHPExcel->getActiveSheet()->setCellValue('O1','TIPO_DISCAPACIDAD');
			$objPHPExcel->getActiveSheet()->setCellValue('P1','NIVEL_ESCOLARIDAD');
			$objPHPExcel->getActiveSheet()->setCellValue('Q1','ESTATUS_ESCOLARIDAD');
			$objPHPExcel->getActiveSheet()->setCellValue('R1','INSTITUCION_SEGURO_SOCIAL');
			$objPHPExcel->getActiveSheet()->setCellValue('S1','PLAZA');

			
			while($row = mysql_fetch_array ($resultado1)){
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,$row['id_ur']);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$row['id_empleado']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila,$row['nombre']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,$row['a_paterno']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$row['a_materno']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila,$row['curp']);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$fila,$row['rfc']);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$fila,$row['sexo']);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$fila,$row['f_nac']);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$fila,$row['entidad']);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$fila,$row['pais']);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$fila,$row['correo_electronico']);
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$fila,$row['no_ss']);
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$fila,$row['e_conyugal']);
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$fila,$row['t_discapacidad']);
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$fila,$row['nive_e']);
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$fila,$row['estatus_e']);
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$fila,$row['institucion_ss']);
				$objPHPExcel->getActiveSheet()->setCellValue('S'.$fila,$row['PLAZA']);
				$fila++;
				
				
				
			}
			/*header("Content-Type: 
			application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
			header('Content-Disposition: attachment;filename="Rusp.xls"');
			header('Cache-Control: max-age=0');*/
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="LISTA_PERSONAS.xls"');
			header('Cache-Control: max-age=0');

			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');	
			$objWriter->save('php://output');
			
		
		
		
		
mysql_close($conexion);
?>	 