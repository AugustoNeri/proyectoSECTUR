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
			
				
		$sql =  "Select p.id_puesto ,p.id_ramo,p.id_ur,p.codigo_puesto,p.deno_puesto,p.id_ze,p.id_ze_rusp,rt.r_tabular,p.consecutivo,tp.tipo_plaza,
	p.c_ocupacional,tl.literal_funcion,tf.tipo_funcion,ns.n_salarial,p.tabulador,p.c_presupuestal,p.ordinal_cp,p.grupo,p.grado,p.nivel,eo.estatus_ocupacional,
	p.noplauni,p.cons_gral,p.cons_jefe,p.pto,p.id_ent_plaza,p.id_pais_plaza,tpe.p_estrategico,tta.tipificacion_actual,ttc.t_contratacion,
	p.sdo_men,p.cg_mens,ttp.tipo_personal,rfi.clv_rfi_riuf,tts.clv_tservidor,
	pj.codigo_puesto as codigo_puesto_jefe,pj.deno_puesto as deno_jefe,pj.id_ze as id_zj,rj.r_tabular as rtabularj,pj.consecutivo as con_j,
	tj.tipo_plaza as plaza_j,pj.c_ocupacional as c_ocu_j,tfj.tipo_funcion as funcion_j,pj.tabulador as tabula_j,pj.c_presupuestal as cp_j,
	pj.ordinal_cp as ordinal_cp_j
	from puestos p left outer join tcat_rtabular rt on p.id_rtabular = rt.id_rtabular 
				   left outer join tcat_tipo_plaza tp on p.id_tplaza=tp.id_tplaza 
				   left outer join tcat_tipo_funcion tf on tf.id_funcion=p.id_funcion 
				   left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial 
				   left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional 
				   left outer join puestos pj on p.id_pjefe=pj.id_puesto 
				   left outer join tcat_rtabular rj on pj.id_rtabular=rj.id_rtabular 
				   left outer join tcat_tipo_plaza tj on pj.id_tplaza=tj.id_tplaza 
				   left outer join tcat_tipo_funcion tfj on pj.id_funcion=tfj.id_funcion 
				   left outer join tcat_tipo_puesto_estrategico tpe on p.id_pestrategico=tpe.id_pestrategico 
				   left outer join tcat_tipificacion_actual tta on p.id_tactual=tta.id_tactual 
				   left outer join tcat_tipo_contratacion ttc on p.id_tcontratacion=ttc.id_tcontratacion
				   left outer join tcat_tipo_personal ttp on p.id_tpersonal=ttp.id_tpersonal
				   left outer join rfi_riuf rfi on p.id_rfi_riuf=rfi.id_rfi_riuf
				   left outer join tcat_literales tl on p.id_literal=tl.id_literal
				   left outer join tcat_tipo_servidor_publico tts on p.id_tservidor=tts.id_tservidor where p.id_puesto>0 and (p.observaciones<>'NA' and p.observaciones<>'') order by id_puesto asc,id_ur asc ";

	$resultado1= @ mysql_query ($sql);
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
			$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(15);
			//Encabezado
			$objPHPExcel->getActiveSheet()->setCellValue('A1','RAMO');
			$objPHPExcel->getActiveSheet()->setCellValue('B1','UR');
			$objPHPExcel->getActiveSheet()->setCellValue('C1','PUESTO');
			$objPHPExcel->getActiveSheet()->setCellValue('D1','DENOMINACION DE PUESTO');
			$objPHPExcel->getActiveSheet()->setCellValue('E1','ZONA ECONOMICA');
			$objPHPExcel->getActiveSheet()->setCellValue('F1','REFERENCIA TABULAR');
			$objPHPExcel->getActiveSheet()->setCellValue('G1','CONSECUTIVO');
			$objPHPExcel->getActiveSheet()->setCellValue('H1','TIPO_PLAZA');
			$objPHPExcel->getActiveSheet()->setCellValue('I1','CARACTER OCUPACIONAL');
			$objPHPExcel->getActiveSheet()->setCellValue('J1','TIPO DE FUNCION');
			$objPHPExcel->getActiveSheet()->setCellValue('K1','NIVEL SALARIAL');
			$objPHPExcel->getActiveSheet()->setCellValue('L1','TABULADOR');
			$objPHPExcel->getActiveSheet()->setCellValue('M1','CODIGO PRESUPUESTAL');
			$objPHPExcel->getActiveSheet()->setCellValue('N1','ORDINAL CP');
			$objPHPExcel->getActiveSheet()->setCellValue('O1','GRUPO');
			$objPHPExcel->getActiveSheet()->setCellValue('P1','GRADO');
			$objPHPExcel->getActiveSheet()->setCellValue('Q1','NIVEL');
			$objPHPExcel->getActiveSheet()->setCellValue('R1','ESTATUS OCUPACIONAL');
			$objPHPExcel->getActiveSheet()->setCellValue('S1','NOPLAUNI');
			$objPHPExcel->getActiveSheet()->setCellValue('T1','CONS_GRAL');
			$objPHPExcel->getActiveSheet()->setCellValue('U1','CONS_JEFE');
			$objPHPExcel->getActiveSheet()->setCellValue('V1','PTO');
			$objPHPExcel->getActiveSheet()->setCellValue('W1','Z_ECONOMICA_RUSP');
			$objPHPExcel->getActiveSheet()->setCellValue('X1','ENT_PLAZA');
			$objPHPExcel->getActiveSheet()->setCellValue('Y1','PAIS_PLAZA');
			$objPHPExcel->getActiveSheet()->setCellValue('Z1','PUESTO_ESTRATEGICO');
			$objPHPExcel->getActiveSheet()->setCellValue('AA1','TIPIFICACION_ACTUAL');
			$objPHPExcel->getActiveSheet()->setCellValue('AB1','TIPO DE CONTRATACION');
			$objPHPExcel->getActiveSheet()->setCellValue('AC1','SDO_MEN');
			$objPHPExcel->getActiveSheet()->setCellValue('AD1','CG_MEN');
			$objPHPExcel->getActiveSheet()->setCellValue('AE1','TIPO_PERSONAL');
			$objPHPExcel->getActiveSheet()->setCellValue('AF1','CLV_RFI_RIUF');
			$objPHPExcel->getActiveSheet()->setCellValue('AG1','TIPO_SERVIDOR');
			$objPHPExcel->getActiveSheet()->setCellValue('AH1','CODIGO_PUESTO_JEFE');
			$objPHPExcel->getActiveSheet()->setCellValue('AI1','DENOMINACION DEL PUESTO JEFE');
			$objPHPExcel->getActiveSheet()->setCellValue('AJ1','ZONA ECONOMICA JEFE');
			$objPHPExcel->getActiveSheet()->setCellValue('AK1','REFERENCIA TABULAR JEFE ');
			$objPHPExcel->getActiveSheet()->setCellValue('AL1','TIPO PLAZA JEFE');
			$objPHPExcel->getActiveSheet()->setCellValue('AM1','CARACTER OCUPACIONAL JEFE');
			$objPHPExcel->getActiveSheet()->setCellValue('AN1','TIPO FUNCION JEFE');
			$objPHPExcel->getActiveSheet()->setCellValue('AO1','TABULADOR JEFE');
			$objPHPExcel->getActiveSheet()->setCellValue('AP1','C_PRESUPUESTAL JEFE');
			$objPHPExcel->getActiveSheet()->setCellValue('AQ1','ORDINAL_CP JEFE');
				
			while($row = mysql_fetch_array ($resultado1)){
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,$row['id_ramo']);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$row['id_ur']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila,$row['codigo_puesto']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,$row['deno_puesto']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$row['id_ze']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila,$row['r_tabular']);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$fila,$row['consecutivo']);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$fila,$row['tipo_plaza']);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$fila,$row['c_ocupacional']);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$fila,$row['tipo_funcion']);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$fila,$row['n_salarial']);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$fila,$row['tabulador']);
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$fila,$row['c_presupuestal']);
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$fila,$row['ordinal_cp']);
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$fila,$row['grupo']);
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$fila,$row['grado']);
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$fila,$row['nivel']);
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$fila,$row['estatus_ocupacional']);
				$objPHPExcel->getActiveSheet()->setCellValue('S'.$fila,$row['noplauni']);
				$objPHPExcel->getActiveSheet()->setCellValue('T'.$fila,$row['cons_gral']);
				$objPHPExcel->getActiveSheet()->setCellValue('U'.$fila,$row['cons_jefe']);
				$objPHPExcel->getActiveSheet()->setCellValue('V'.$fila,$row['pto']);
				$objPHPExcel->getActiveSheet()->setCellValue('W'.$fila,$row['id_ze_rusp']);
				$objPHPExcel->getActiveSheet()->setCellValue('X'.$fila,$row['id_ent_plaza']);
				$objPHPExcel->getActiveSheet()->setCellValue('Y'.$fila,$row['id_pais_plaza']);
				$objPHPExcel->getActiveSheet()->setCellValue('Z'.$fila,$row['p_estrategico']);
				$objPHPExcel->getActiveSheet()->setCellValue('AA'.$fila,$row['tipificacion_actual']);
				$objPHPExcel->getActiveSheet()->setCellValue('AB'.$fila,$row['t_contratacion']);
				$objPHPExcel->getActiveSheet()->setCellValue('AC'.$fila,$row['sdo_men']);
				$objPHPExcel->getActiveSheet()->setCellValue('AD'.$fila,$row['cg_mens']);
				$objPHPExcel->getActiveSheet()->setCellValue('AE'.$fila,$row['tipo_personal']);
				$objPHPExcel->getActiveSheet()->setCellValue('AF'.$fila,$row['clv_rfi_riuf']);
				$objPHPExcel->getActiveSheet()->setCellValue('AG'.$fila,$row['clv_tservidor']);
				$objPHPExcel->getActiveSheet()->setCellValue('AH'.$fila,$row['codigo_puesto_jefe']);
				$objPHPExcel->getActiveSheet()->setCellValue('AI'.$fila,$row['deno_jefe']);
				$objPHPExcel->getActiveSheet()->setCellValue('AJ'.$fila,$row['id_zj']);
				$objPHPExcel->getActiveSheet()->setCellValue('AK'.$fila,$row['rtabularj']);
				$objPHPExcel->getActiveSheet()->setCellValue('AL'.$fila,$row['plaza_j']);
				$objPHPExcel->getActiveSheet()->setCellValue('AM'.$fila,$row['c_ocu_j']);
				$objPHPExcel->getActiveSheet()->setCellValue('AN'.$fila,$row['funcion_j']);
				$objPHPExcel->getActiveSheet()->setCellValue('AO'.$fila,$row['tabula_j']);
				$objPHPExcel->getActiveSheet()->setCellValue('AP'.$fila,$row['cp_j']);
				$objPHPExcel->getActiveSheet()->setCellValue('AQ'.$fila,$row['ordinal_cp_j']);
				$fila++;
				
				
				
			}
			/*header("Content-Type: 
			application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
			header('Content-Disposition: attachment;filename="Rusp.xls"');
			header('Cache-Control: max-age=0');*/
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="MAESTROS_PUESTOS.xls"');
			header('Cache-Control: max-age=0');

			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');	
			$objWriter->save('php://output');
			
		}
		
		
		
mysql_close($conexion);
?>	 