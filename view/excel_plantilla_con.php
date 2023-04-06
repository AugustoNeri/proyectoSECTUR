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
if ($_POST /*and !$_Get*/)
        { //evalua si se enviaron los datos del formulario
			$ns=$_POST["n_salarial"];
			$pto=$_POST["puesto"];
			$nombre=$_POST["nom"];
			$ur=$_POST["ur"];
			$anio=$_POST["f_plaza"];
			if($ur==0){
			if($ns==0){
				if(empty($pto)){
					if(empty($nombre)){
						if($anio==0){
						}else{
							$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1  and pla.f_ingr_plaza like '%$anio%' ORDER BY p.id_ur asc";
							$numcon=1;
						}
					}else{
						if($anio==0){
							$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%')ORDER BY p.id_ur asc";
							$numcon=2;
						}else{
							$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1  and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%') and pla.f_ingr_plaza like '%$anio%' ORDER BY p.id_ur asc";
							$numcon=3;
						}
					}
				}else{
					if(empty($nombre)){
						if($anio==0){
							$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.deno_puesto like '%$pto%' ORDER BY p.id_ur asc";
							$numcon=4;
						}else{
							$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.deno_puesto like '%$pto%' and pla.f_ingr_plaza like '%$anio%' ORDER BY p.id_ur asc";
							$numcon=5;
						}
					}else{
						if($anio==0){
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.deno_puesto like '%$pto%' and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%') ORDER BY p.id_ur asc";
						$numcon=6;
						}else{
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.deno_puesto like '%$pto%' and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%') and pla.f_ingr_plaza like '%$anio%' ORDER BY p.id_ur asc";
						$numcon=7;
						}
					}
				}
			}else{
				if(empty($pto)){
					if(empty($nombre)){
						if($anio==0){
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_nsalarial='$ns' ORDER BY p.id_ur asc";
							$numcon=8;
						}else{
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and pla.f_ingr_plaza like '%$anio%' and p.id_nsalarial='$ns' ORDER BY p.id_ur asc";
							$numcon=9;						
						}
					}else{
						if($anio==0){
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1  and p.id_nsalarial='$ns' and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%') ORDER BY p.id_ur asc";
							$numcon=10;
						}else{
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1  and p.id_nsalarial='$ns' and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%') and pla.f_ingr_plaza like '%$anio%' ORDER BY p.id_ur asc";		
						$numcon=11;
						}
					}
				}else{
					if(empty($nombre)){
						if($anio==0){
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_nsalarial='$ns' and p.deno_puesto like '%$pto%'";
						$numcon=12;
						}else{
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_nsalarial='$ns' and p.deno_puesto like '%$pto%' and pla.f_ingr_plaza like '%$anio%'";	
						$numcon=13;
						}
					}else{
						if($anio==0){
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_nsalarial='$ns' and p.deno_puesto like '%$pto%' and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%')";
						$numcon=14;
						}else{
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_nsalarial='$ns' and p.deno_puesto like '%$pto%' and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%') and pla.f_ingr_plaza like '%$anio%'";
						$numcon=15;
						}
					}
				}
			}
			
		}else{
			if($ns==0){
				if(empty($pto)){
					if(empty($nombre)){
						if($anio==0){
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur'";
							$numcon=16;
						}else{
							$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur' and pla.f_ingr_plaza like '%$anio%'";
							$numcon=17;
						}
					}else{
						if($anio==0){
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur' and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%')";
							$numcon=18;
						}else{
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur' and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%') and pla.f_ingr_plaza like '%$anio%'";	
							$numcon=19;
						}
					}
				}else{
					if(empty($nombre)){
						if($anio==0){
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1  and p.id_ur= '$ur' and p.deno_puesto like '%$pto%'";
						$numcon=20;
						}else{
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur' and p.deno_puesto like '%$pto%' and pla.f_ingr_plaza like '%$anio%'";
						$numcon=21;							
						}
					}else{
						if($anio==0){
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur' and p.deno_puesto like '%$pto%' and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%')";
						$numcon=22;
						}else{
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur' and p.deno_puesto like '%$pto%' and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%') and pla.f_ingr_plaza like'%$anio%'";							
							$numcon=23;
						}
					}
				}
			}else{
				if(empty($pto)){
					if(empty($nombre)){
						if($anio==0){
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur' and p.id_nsalarial='$ns'";
							$numcon=24;
						}else{
							$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur' and p.id_nsalarial='$ns' and pla.f_ingr_plaza like '%$anio%'";
							$numcon=25;
						}
					}else{
						if($anio==0){
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur' and p.id_nsalarial='$ns' and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%')";
						$numcon=26;
						}else{
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur' and p.id_nsalarial='$ns' and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%') and pla.f_ingr_plaza like '%$anio%'";	
						$numcon=27;
						}
					}
				}else{
					if(empty($nombre)){
						if($anio==0){
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur' and p.id_nsalarial='$ns' and p.deno_puesto like '%$pto%'";
						$numcon=28;
						}else{
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur' and p.id_nsalarial='$ns' and p.deno_puesto like '%$pto%' and pla.f_ingr_plaza like '%$anio%'";	
						$numcon=29;
						}
					}else{
						if($anio==0){
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur' and p.id_nsalarial='$ns' and p.deno_puesto like '%$pto%' (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%')";
						$numcon=30;
						}else{
						$con="Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
		u.ur as adscri,ns.n_salarial as n_sal,tip.tipo_contra as t_contra,tip.t_ingr_plaza as t_plaza,tf.tipo_funcion as t_funcion,p.deno_puesto as d_puesto,
		IFNULL(CONCAT(per.a_paterno,' ',per.a_materno,' ',per.nombre),'VACANTE') as OCUPANTE,per.correo_electronico as mail,per.id_empleado as id_emp,pla.rusp as RUSP,
		per.rfc as RFC,per.curp as CURP,s.sexo as sex,pla.f_ingr_plaza as f_plaza,mi.m_ingreso as mo_ing,pj.id_ramo as ramo_j,pj.id_ur as ur_j,uj.ur as ads_j,
		pj.codigo_puesto as cod_j,pj.deno_puesto as deno_j,pj.c_presupuestal as presu_j,
		IFNULL(CONCAT(perj.a_paterno,' ',perj.a_materno,' ',perj.nombre),'ROOT') as OCUPANTE_J,p.a_revelantes,p.e_relacionada,p.anio_experiencia
				from puestos p left outer join tcat_ur u on p.id_ur=u.id_ur 
								left outer join tcat_nivel_salarial ns on p.id_nsalarial=ns.id_nsalarial
								left outer join tcat_tipo_funcion tf on p.id_funcion=tf.id_funcion
								left outer join tcat_estatus_ocupacional eo on p.id_eocupacional=eo.id_eocupacional
								left outer join plantilla pla on p.id_puesto=pla.id_puesto 
								left outer join persona per on pla.id_empleado=per.id_empleado
								left outer join tcat_sexo s on s.id_sexo=per.id_sexo
								left outer join tcat_tipo_ingreso_plaza tip on p.id_ingr_plaza=tip.id_ingr_plaza
								left outer join tcat_motivo_ingreso mi on pla.id_mingreso=mi.id_mingreso
								left outer join tcat_tipificacion_actual ta on p.id_tactual=ta.id_tactual
								left outer join puestos pj on p.id_pjefe=pj.id_puesto
								left outer join  plantilla plaj on pj.id_puesto=plaj.id_puesto
								left outer join persona perj on plaj.id_empleado=perj.id_empleado
								left outer join tcat_ur uj on pj.id_ur=uj.id_ur
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 and p.id_ur= '$ur' and p.id_nsalarial='$ns' and p.deno_puesto like '%$pto%' and (per.nombre like '%$nombre%' or per.a_paterno like '%$nombre%' or per.a_materno like '%$nombre%') and pla.f_ingr_plaza like '%$anio%'";
						$numcon=31;
						}
					}
				}
			}
			
		}
	
	$resultado1= @ mysql_query ($con);
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
			$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);	
			$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(40);
			$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(30);
			$objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15);
			$objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(10);
			$objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(10);
			//Encabezado
			$objPHPExcel->getActiveSheet()->setCellValue('A1','RAMO');
			$objPHPExcel->getActiveSheet()->setCellValue('B1','OCUPACION');
			$objPHPExcel->getActiveSheet()->setCellValue('C1','TIPIFICACION ACTUAL');
			$objPHPExcel->getActiveSheet()->setCellValue('D1','CODIGO  DE PUESTO');
			$objPHPExcel->getActiveSheet()->setCellValue('E1','UR');
			$objPHPExcel->getActiveSheet()->setCellValue('F1','ADSCRIPCION');
			$objPHPExcel->getActiveSheet()->setCellValue('G1','DENOMINACION DE PUESTO');
			$objPHPExcel->getActiveSheet()->setCellValue('H1','NIVEL SALARIAL');
			$objPHPExcel->getActiveSheet()->setCellValue('I1','TIPO DE CONTRATACION');
			$objPHPExcel->getActiveSheet()->setCellValue('J1','TIPO DE INGRESO A LA PLAZA');
			$objPHPExcel->getActiveSheet()->setCellValue('K1','TIPO DE FUNCION');
			$objPHPExcel->getActiveSheet()->setCellValue('L1','OCUPANTE');
			$objPHPExcel->getActiveSheet()->setCellValue('M1','NO. EMPLEADO');
			$objPHPExcel->getActiveSheet()->setCellValue('N1','CORREO ELECTRONICO');
			$objPHPExcel->getActiveSheet()->setCellValue('O1','RUSP');
			$objPHPExcel->getActiveSheet()->setCellValue('P1','RFC');
			$objPHPExcel->getActiveSheet()->setCellValue('Q1','CURP');
			$objPHPExcel->getActiveSheet()->setCellValue('R1','GENERO');
			$objPHPExcel->getActiveSheet()->setCellValue('S1','FECHA DE INGRESO A LAPLAZA');
			$objPHPExcel->getActiveSheet()->setCellValue('T1','MOTIVO DE INGRESO ');
			$objPHPExcel->getActiveSheet()->setCellValue('U1','ASPECTOS REVELANTES ');
			$objPHPExcel->getActiveSheet()->setCellValue('V1','ENTIDAD RELACIONADA ');
			$objPHPExcel->getActiveSheet()->setCellValue('W1','AÑOS DE EXPERIENCIA ');
			$objPHPExcel->getActiveSheet()->setCellValue('X1','RAMO JEFE');
			$objPHPExcel->getActiveSheet()->setCellValue('Y1','UR JEFE');
			$objPHPExcel->getActiveSheet()->setCellValue('Z1','ADSCRIPCION JEFE');
			$objPHPExcel->getActiveSheet()->setCellValue('AA1','CODIGO DE PUESTO JEFE ');
			$objPHPExcel->getActiveSheet()->setCellValue('AB1','DENOMINACION DE JEFE ');
			$objPHPExcel->getActiveSheet()->setCellValue('AC1','CODIGO PRESUPUESTAL ');
			$objPHPExcel->getActiveSheet()->setCellValue('AD1','OCUPANTE ');
			
			
				
			while($row = mysql_fetch_array ($resultado1)){
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$fila,$row['ramo']);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$fila,$row['e_ocupacional']);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$fila,$row['t_actual']);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$fila,$row['cod_p']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$fila,$row['UR']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$fila,$row['adscri']);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$fila,$row['d_puesto']);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$fila,$row['n_sal']);
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$fila,$row['t_contra']);
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$fila,$row['t_plaza']);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$fila,$row['t_funcion']);
				$sql1="Select status from persona where id_empleado='".$row['id_emp']."'";
				$bus1= @mysql_query($sql1);
				$row1= mysql_fetch_array($bus1);
				if($row1["status"]==2){
					$objPHPExcel->getActiveSheet()->setCellValue('L'.$fila,"VACANTE");
				}else{
					$objPHPExcel->getActiveSheet()->setCellValue('L'.$fila,$row['OCUPANTE']);
				}
				
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$fila,$row['id_emp']);
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$fila,$row['mail']);
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$fila,$row['RUSP']);
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$fila,$row['RFC']);
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$fila,$row['CURP']);
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$fila,$row['sex']);
				$objPHPExcel->getActiveSheet()->setCellValue('S'.$fila,$row['f_plaza']);
				$objPHPExcel->getActiveSheet()->setCellValue('T'.$fila,$row['mo_ing']);
				$objPHPExcel->getActiveSheet()->setCellValue('U'.$fila,$row['a_revelantes']);
				$objPHPExcel->getActiveSheet()->setCellValue('V'.$fila,$row['e_relacionada']);
				$objPHPExcel->getActiveSheet()->setCellValue('W'.$fila,$row['anio_experiencia']);
				$objPHPExcel->getActiveSheet()->setCellValue('X'.$fila,$row['ramo_j']);
				$objPHPExcel->getActiveSheet()->setCellValue('Y'.$fila,$row['ur_j']);
				$objPHPExcel->getActiveSheet()->setCellValue('Z'.$fila,$row['ads_j']);
				$objPHPExcel->getActiveSheet()->setCellValue('AA'.$fila,$row['cod_j']);
				$objPHPExcel->getActiveSheet()->setCellValue('AB'.$fila,$row['deno_j']);
				$objPHPExcel->getActiveSheet()->setCellValue('AC'.$fila,$row['presu_j']);
				$objPHPExcel->getActiveSheet()->setCellValue('AD'.$fila,$row['OCUPANTE_J']);
				$fila++;
				
				
				
			}
			/*header("Content-Type: 
			application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
			header('Content-Disposition: attachment;filename="Rusp.xls"');
			header('Cache-Control: max-age=0');*/
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="PLANTILLASPC.xls"');
			header('Cache-Control: max-age=0');

			
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');	
			$objWriter->save('php://output');
			
		}
		
		
		
mysql_close($conexion);
?>	 