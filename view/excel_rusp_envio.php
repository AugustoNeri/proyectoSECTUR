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
if (!$_POST /*and !$_Get*/)
        { //evalua si se enviaron los datos del formulario
			
				
 
 		$sql =  "Select DISTINCT noplauni,filiacion,id_ramo,puestos.id_ur,cons_gral,cons_jefe,puestos.deno_puesto,pto,n_salarial,id_ze_rusp,
	sdo_men,cg_mens,id_ent_plaza,id_pais_plaza,puestos.id_tplaza,id_pestrategico,puestos.id_funcion,id_tpersonal,
	puestos.codigo_puesto,id_eocupacional,rfc,curp,nombre,a_paterno,a_materno,f_nac,id_sexo,persona.id_enacimiento,
	persona.id_pnacimiento,correo_electronico,persona.id_institucion_ss,no_ss,id_discapacidad,id_tcontratacion,declaracion_patri,id_mdeclaracion,
	plantilla.id_empleado,f_ingr_apf,f_ingr_spc,f_ingr_sectur,f_ult_puesto,f_oblig_patri,clv_rfi_riuf,clv_tservidor,persona.id_escolaridad,persona.id_econyugal,
	descendencia
	from puestos left outer join plantilla  on plantilla.id_puesto=puestos.id_puesto
                        left outer join persona on plantilla.id_empleado=persona.id_empleado 
						left outer join rfi_riuf on puestos.id_rfi_riuf=rfi_riuf.id_rfi_riuf
						left outer join tcat_nivel_salarial on puestos.id_nsalarial=tcat_nivel_salarial.id_nsalarial
						left outer join tcat_tipo_servidor_publico on puestos.id_tservidor=tcat_tipo_servidor_publico.id_tservidor 
						where puestos.id_puesto>0 and plantilla.id_baja=0";
	$resultado1= @ mysql_query ($sql);
	if (!$resultado1)
	{
	 exit ('error en la consulta');
	
    }
			$fila=2;
			
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator("Augusto Neri")->setDescription("Reporte RUSP_ENVIO");
			
			$objPHPExcel->setActiveSheetIndex(0);
			$objPHPExcel->getActiveSheet()->setTitle("ENVIO");
			
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
			$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(15);
			
			
			
 
			//Encabezado
			$objPHPExcel->getActiveSheet()->setCellValue('A1','NOPLA_UNI||NOPLA_PUESTO||NOPLA_PLAZA');
			$objPHPExcel->getActiveSheet()->setCellValue('B1','FILIACION');
			$objPHPExcel->getActiveSheet()->setCellValue('C1','ID_RAMO');
			$objPHPExcel->getActiveSheet()->setCellValue('D1','UNIDAD');
			$objPHPExcel->getActiveSheet()->setCellValue('E1','DENO_PUESTO');
			$objPHPExcel->getActiveSheet()->setCellValue('F1','CONS_GRAL');
			$objPHPExcel->getActiveSheet()->setCellValue('G1','CONS_JEFE');
			$objPHPExcel->getActiveSheet()->setCellValue('H1','PTO');
			$objPHPExcel->getActiveSheet()->setCellValue('I1','N_SALARIAL');
			$objPHPExcel->getActiveSheet()->setCellValue('J1','Z_ECONOMICA');
			$objPHPExcel->getActiveSheet()->setCellValue('K1','SDO_MEN');
			$objPHPExcel->getActiveSheet()->setCellValue('L1','CG_MENS');
			$objPHPExcel->getActiveSheet()->setCellValue('M1','ENT_PLAZA');
			$objPHPExcel->getActiveSheet()->setCellValue('N1','PAIS_PLAZA');
			$objPHPExcel->getActiveSheet()->setCellValue('O1','P_ESTRATEGICO');
			$objPHPExcel->getActiveSheet()->setCellValue('P1','T_CONTRATACION');
			$objPHPExcel->getActiveSheet()->setCellValue('Q1','T_FUNCION');
			$objPHPExcel->getActiveSheet()->setCellValue('R1','T_PERSONAL');
			$objPHPExcel->getActiveSheet()->setCellValue('S1','NOMBRE');
			$objPHPExcel->getActiveSheet()->setCellValue('T1','A_PATERNO');
			$objPHPExcel->getActiveSheet()->setCellValue('U1','A_MATERNO');
			$objPHPExcel->getActiveSheet()->setCellValue('V1','FECHA_NAC');
			$objPHPExcel->getActiveSheet()->setCellValue('W1','SEXO');
			$objPHPExcel->getActiveSheet()->setCellValue('X1','E_NACIMIENTO');
			$objPHPExcel->getActiveSheet()->setCellValue('Y1','P_NACIMIENTO');
			$objPHPExcel->getActiveSheet()->setCellValue('Z1','CORREO_ELECTRONICO');
			$objPHPExcel->getActiveSheet()->setCellValue('AA1','NO_SS');
			$objPHPExcel->getActiveSheet()->setCellValue('AB1','NUM_EMPLEADO');
			$objPHPExcel->getActiveSheet()->setCellValue('AC1','DECLARACION_PATRI');
			$objPHPExcel->getActiveSheet()->setCellValue('AD1','M_DECLARACION');
			$objPHPExcel->getActiveSheet()->setCellValue('AE1','RFI_RIUF');
			$objPHPExcel->getActiveSheet()->setCellValue('AF1','DESCENDENCIA');
			$objPHPExcel->getActiveSheet()->setCellValue('AG1','IDIOMA');
			//iNSERCION DE DATOS
			while($row = mysql_fetch_array ($resultado1)){
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila, $row['noplauni']);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$row['filiacion']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila,$row['id_ramo']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,$row['id_ur']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$row['deno_puesto']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila,$row['cons_gral']);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$fila,$row['cons_jefe']);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$fila,$row['pto']);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$fila,$row['n_salarial']);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$fila,$row['id_ze_rusp']);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$fila,$row['sdo_men']);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$fila,$row['cg_mens']);
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$fila,$row['id_ent_plaza']);
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$fila,$row['id_pais_plaza']);
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$fila,$row['id_pestrategico']);
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$fila,$row['id_tcontratacion']);
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$fila,$row['id_funcion']);
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$fila,$row['id_tpersonal']);
				$objPHPExcel->getActiveSheet()->setCellValue('S'.$fila,$row['nombre']);
				$objPHPExcel->getActiveSheet()->setCellValue('T'.$fila,$row['a_paterno']);
				$objPHPExcel->getActiveSheet()->setCellValue('U'.$fila,$row['a_materno']);
				$objPHPExcel->getActiveSheet()->setCellValue('V'.$fila,$row['f_nac']);
				$objPHPExcel->getActiveSheet()->setCellValue('W'.$fila,$row['id_sexo']);
				$objPHPExcel->getActiveSheet()->setCellValue('X'.$fila,$row['id_enacimiento']);
				$objPHPExcel->getActiveSheet()->setCellValue('Y'.$fila,$row['id_pnacimiento']);
				$objPHPExcel->getActiveSheet()->setCellValue('Z'.$fila,$row['correo_electronico']);
				$objPHPExcel->getActiveSheet()->setCellValue('AA'.$fila,$row['no_ss']);
				$objPHPExcel->getActiveSheet()->setCellValue('AB'.$fila,$row['id_empleado']);
				$objPHPExcel->getActiveSheet()->setCellValue('AC'.$fila,$row['declaracion_patri']);
				$objPHPExcel->getActiveSheet()->setCellValue('AD'.$fila,$row['id_mdeclaracion']);
				$objPHPExcel->getActiveSheet()->setCellValue('AE'.$fila,$row['clv_rfi_riuf']);
				$objPHPExcel->getActiveSheet()->setCellValue('AF'.$fila,$row['descendencia']);
				$idioma="";
				$sql3="Select id_idioma,nivel from persona_idiomas where id_persona='".$row["id_empleado"]."'";
				$resultado3=@mysql_query ($sql3);
				$numero= mysql_num_rows($resultado3);
				$num=0;
				while ($row1= mysql_fetch_array ($resultado3))
				{
					$num++;
					if($num == $numero){
						$idioma=$idioma."".$row1["id_idioma"]."-".$row1["nivel"]."";
					}else{
					$idioma=$idioma."".$row1["id_idioma"]."-".$row1["nivel"].",";
					}
					
				}
				$objPHPExcel->getActiveSheet()->setCellValue('AG'.$fila,$idioma);
				$fila++;
				
			}
		/*header("Content-Type: 
			application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
			header('Content-Disposition: attachment;filename="Rusp.xls"');
			header('Cache-Control: max-age=0');*/
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="RUSP_ENVIO.xls"');
			header('Cache-Control: max-age=0');

			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');	
			$objWriter->save('php://output');
			
		}
mysql_close($conexion);
?>	