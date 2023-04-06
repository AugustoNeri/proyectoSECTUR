<?php
$dbhost="localhost";  // host del MySQL (generalmente localhost)
$dbusuario="root"; // aqui debes ingresar el nombre de usuario
                      // para acceder a la base
$dbpassword=""; // password de acceso para el usuario de la
                      // linea anterior
$db="singiRH";        // Seleccionamos la base con la cual trabajar
$conexion = @mysql_connect($dbhost, $dbusuario, $dbpassword);
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
session_start();

if(isset ($_SESSION['id'])) {  
if (!$_POST /*and !$_Get*/)
        { //evalua si se enviaron los datos del formulario
	?>
    <html>
    <head> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <title>Listas de puestos</title>
    </head>
    <body>

	</body>
	</html>

<?php


 	echo "<br>";
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
				   left outer join tcat_tipo_servidor_publico tts on p.id_tservidor=tts.id_tservidor 
				   where p.codigo_puesto<>'' and p.id_nsalarial<181 order by p.id_ur asc, p.deno_puesto asc";
	
	$resultado1= @ mysql_query ($sql);
	$numrow= @mysql_num_rows($resultado1);
	if (!$resultado1)
	{
	 exit ('error en la consulta');
	 echo mysql_errno();
    }
    ?>
    <HTML>
    <BODY>
    <h3><center>MAESTRO DE PUESTOS DE SPC</h3>
	<form action="" method='post'  class="form-horizontal" role="form">
	<div class="form-group">
	<?php
	echo "<label class='col-sm-3 control-label'>Unidad de Adscripcion:</label>";
	$con3="SELECT * FROM tcat_ur order by ur asc";
	$res3=@mysql_query($con3);
	if(!$res3){
		echo " fallo";
	}
	else{
		echo "<div class='col-sm-8'><select name='combo2' class='form-control'>";
		echo "<option value=0>SELECCIONE EL AREA DE ADSCRIPCION</option>";
		while ($fila3=mysql_fetch_array($res3)){
			echo "<option value=".$fila3['id_ur'].">".$fila3['ur']." </option>";
		}
		echo "</select></div></div>";
	}
	echo "<label class='col-sm-3 control-label'>Nivel salarial:</label>";
	$con3="SELECT * FROM tcat_nivel_salarial where id_nsalarial<181 order by n_salarial asc";
	$res3=@mysql_query($con3);
	if(!$res3){
		echo " fallo";
	}
	else{
		echo "<div class='form-group'><div class='col-sm-8'><select name='combo3' class='form-control'>";
		echo "<option value=0>SELECCIONE NIVEL SALARIAL</option>";
		while ($fila3=mysql_fetch_array($res3)){
			echo "<option value=".$fila3['id_nsalarial'].">".$fila3['n_salarial']." </option>";
		}
		echo "</select></div></div>";
	}
	
		?>		
	 
		<div class="form-group">
			<label class="col-sm-3 control-label">Puesto:</label>
			<div class="col-sm-8">
			<input class="form-control" id="nombre" placeholder="" type="text" name="puesto">
			</div>
		</div>
		<div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">
	 <input type='hidden' name='bus_puesto' value='".$row["id_puesto"]."'>
      <input type='submit' class="btn btn-primary pull-right" value='BUSCAR'></div></div>
	</form>
      <center>
	 <div class="btn-group" role="group" aria-label="...">
		<?php
			if($_SESSION["id"]==2 or $_SESSION["id"]==4){
			?>
		  <input type="submit" value="CREAR ´PUESTO NUEVO" onclick = "location='a_puestos.php'" class='btn btn-default'/>
		<?php
			}
			?>
	   <input type="submit" value="Ver todos los puestos" onclick = "location='c_puestos.php'" class='btn btn-default'/>
		  <input type='submit' class='btn btn-default' onclick="location='excel_puesto_spc.php'" value='Exportar tabla a excel '> 
		</div>	
	  </center>
	    <?php
	  echo $numrow." registros";
	  ?>
    <table class="table table-striped" align="center">
    <tr>
		 <?php
	 if($_SESSION["id"]==2 or $_SESSION["id"]==4){
	?>
	<td><h3></h3></td>
	<td><h3></h3></td>
	
	 <?php
	 }
	?>
	<td><h5>RAMO</h3>
	<td><h5>UR</h3></td>
    <td><h5>PUESTO</h3></td>
	<td><h5>DENOMINACION DE PUESTO</h3></td>
	<td><h5>Z ECONOMICA</h3></td>
	<td><h5>REFERENCIA TABULAR</h3></td>
	<td><h5>CONSECUTIVO</h3></td>
	<td><h5>TIPO PLAZA</h3></td>
	<td><h5>CARAC OCUPACIONAL</h3></td>
	<td><h5>TIPO_FUNCION</h3></td>
	<td><h5>NIVEL_SALARIAL</h3></td>
	<td><h5>TABULADOR</h3></td>
	<td><h5>CODIGO PRESUPUESTAL</h3></td>
	<td><h5>ORDINAL_CP</h3></td>
	<td><h5>GRUPO</h3></td>
	<td><h5>GRADO</h3></td>
	<td><h5>NIVEL</h3></td>
	<td><h5>ESTATUS OCUPACIONAL</h3></td>
	<td><h5>NOPLAUNI</h3></td>
	<td><h5>CONS_GRAL</h3></td>
	<td><h5>CONS_JEFE</h3></td>
	<td><h5>PTO</h3></td>
	<td><h5>Z ECONOMICA_RUSP</h3></td>
	<td><h5>ENT_PLAZA</h3></td>
	<td><h5>ENT_PAIS</h3></td>
	<td><h5>PUESTO_ESTRATEGICO</h3></td>
	<td><h5>TIPIFICACION ACTUAL</h3></td>
	<td><h5>TIPO DE CONTRATACION</h3></td>
	<td><h5>SDO_MEN</h3></td>
	<td><h5>CG_MENS</h3></td>
	<td><h5>TIPO_PERSONAL</h3></td>
	<td><h5>CLV_RFI_RIUF</h3></td>
	<td><h5>TIPO_SERVIDOR</h3></td>
	<td><h5>PUESTO JEFE</h3></td>
	<td><h5>DENO_PUESTO_J</h3></td>
	<td><h5>Z_ECONOMICA_J </h3></td>
	<td><h5>REF_TABULAR_J </h3></td>
	<td><h5>TIPO_PLAZA_J </h3></td>
	<td><h5>CARAC_OCUPA_J </h3></td>
	<td><h5>TIPO_FUNCION_J </h3></td>
	<td><h5>TABULADOR_J </h3></td>
	<td><h5>C_PRESUPUESTAL_J </h3></td>
	<td><h5>ORDINAL_CP_J </h3></td>
	</tr>


 <?php
while ($row= mysql_fetch_array ($resultado1))
{
	echo "<tr>";
	if($_SESSION["id"]==2 or $_SESSION==4){
		echo "<td><form method='post' action=''> \n
      <input type='hidden' name='bus_puesto' value='".$row["id_puesto"]."'>
      <input class='btn btn-danger' type='submit' value='Borrar'>
      </form></td>";
	  echo "<td><form method='post' action=''> \n
      <input type='hidden' name='mo_puesto' value='".$row["id_puesto"]."'>
      <input class='btn btn-primary' type='submit' value='Modificar'> 
      </form></td>";	
	}
	
echo "<td>". $row["id_ramo"]. "</td>";
echo "<td>". $row["id_ur"]. "</td>";
echo "<td>". $row["codigo_puesto"]. "</td>";
echo "<td>". $row["deno_puesto"]. "</td>";
echo "<td>". $row["id_ze"]. "</td>";
echo "<td>". $row["r_tabular"]. "</td>";
echo "<td>". $row["consecutivo"]. "</td>";
echo "<td>". $row["tipo_plaza"]. "</td>";
echo "<td>". $row["c_ocupacional"]. "</td>";
echo "<td>". $row["tipo_funcion"]. "</td>";
echo "<td>". $row["n_salarial"]. "</td>";
echo "<td>". $row["tabulador"]. "</td>";
echo "<td>". $row["c_presupuestal"]. "</td>";
echo "<td>". $row["ordinal_cp"]. "</td>";
echo "<td>". $row["grupo"]. "</td>";
echo "<td>". $row["grado"]. "</td>";
echo "<td>". $row["nivel"]. "</td>";
echo "<td>". $row["estatus_ocupacional"]. "</td>";
echo "<td>". $row["noplauni"]. "</td>";
echo "<td>". $row["cons_gral"]. "</td>";
echo "<td>". $row["cons_jefe"]. "</td>";
echo "<td>". $row["pto"]. "</td>";	
echo "<td>". $row["id_ze_rusp"]. "</td>";
echo "<td>". $row["id_ent_plaza"]. "</td>";
echo "<td>". $row["id_pais_plaza"]. "</td>";
echo "<td>". $row["p_estrategico"]. "</td>";
echo "<td>". $row["tipificacion_actual"]. "</td>";
echo "<td>". $row["t_contratacion"]. "</td>";
echo "<td>". $row["sdo_men"]. "</td>";
echo "<td>". $row["cg_mens"]. "</td>";
echo "<td>". $row["tipo_personal"]. "</td>";
echo "<td>". $row["clv_rfi_riuf"]. "</td>";
echo "<td>". $row["clv_tservidor"]. "</td>";
echo "<td>". $row["codigo_puesto_jefe"]. "</td>";
echo "<td>". $row["deno_jefe"]. "</td>";
echo "<td>". $row["id_zj"]. "</td>";
echo "<td>". $row["rtabularj"]. "</td>";
echo "<td>". $row["plaza_j"]. "</td>";
echo "<td>". $row["c_ocu_j"]. "</td>";
echo "<td>". $row["funcion_j"]. "</td>";
echo "<td>". $row["tabula_j"]. "</td>";
echo "<td>". $row["cp_j"]. "</td>";
echo "<td>". $row["ordinal_cp_j"]. "</td>";

}
   echo '</table>';
    echo '
    </body>
    </html>';

}else{
	
	if(isset($_POST["bus_puesto"])){
		$nom=$_POST["puesto"];
		$ur=$_POST["combo2"];
		$ns=$_POST["combo3"];
		
		?>
	    <HTML>
		<head>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
	</head>
    <BODY>
    <h2><center>MAESTRO DE PUESTOS DE SPC</h2>
	<form action="" method='post'  class="form-horizontal" role="form">
	<div class="form-group">
	<?php
	echo "<label class='col-sm-3 control-label'>Unidad de Adscripcion:</label>";
	$con3="SELECT * FROM tcat_ur order by ur asc";
	$res3=@mysql_query($con3);
	if(!$res3){
		echo " fallo";
	}
	else{
		echo "<div class='col-sm-8'><select name='combo2' class='form-control'>";
		echo "<option value=0>SELECCIONE EL AREA DE ADSCRIPCION</option>";
		while ($fila3=mysql_fetch_array($res3)){
			echo "<option value=".$fila3['id_ur'].">".$fila3['ur']." </option>";
		}
		echo "</select></div></div>";
	}
	echo "<label class='col-sm-3 control-label'>Nivel salarial:</label>";
	$con3="SELECT * FROM tcat_nivel_salarial where id_nsalarial<181 order by n_salarial asc";
	$res3=@mysql_query($con3);
	if(!$res3){
		echo " fallo";
	}
	else{
		echo "<div class='form-group'><div class='col-sm-8'><select name='combo3' class='form-control'>";
		echo "<option value=0>SELECCIONE NIVEL SALARIAL</option>";
		while ($fila3=mysql_fetch_array($res3)){
			echo "<option value=".$fila3['id_nsalarial'].">".$fila3['n_salarial']." </option>";
		}
		echo "</select></div></div>";
	}
	
		?>		
	 
		<div class="form-group">
			<label class="col-sm-3 control-label">Puesto:</label>
			<div class="col-sm-8">
			<input class="form-control" id="nombre" placeholder="" type="text" name="puesto">
			</div>
		</div>
		<div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">
	 <input type='hidden' name='bus_puesto' value='".$row["id_puesto"]."'>
      <input type='submit' class="btn btn-primary pull-right" value='BUSCAR'></div></div>
	</form>
	
	<?php
	if(empty($nom) and $ur==0){
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
				   left outer join tcat_tipo_servidor_publico tts on p.id_tservidor=tts.id_tservidor 
				   where p.codigo_puesto<>'' and  p.id_nsalarial='".$ns."'order by id_ur asc";
	$numcon=1;
			$resultado1= @ mysql_query ($sql);
			if (!$resultado1)
			{
				exit ('error en la consulta');
				echo mysql_errno();
			}
	}else{
		if($ur==0 and $ns==0){
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
				   left outer join tcat_tipo_servidor_publico tts on p.id_tservidor=tts.id_tservidor where p.codigo_puesto<>''and p.id_nsalarial<181 and p.deno_puesto like '%".$nom."%' order by id_ur asc";
	$numcon=2;
			$resultado1= @ mysql_query ($sql);
			if (!$resultado1)
			{
				exit ('error en la consulta');
				echo mysql_errno();
			}
		}else{
				if(empty($nom) and $ns==0){
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
				   left outer join tcat_tipo_servidor_publico tts on p.id_tservidor=tts.id_tservidor where p.codigo_puesto<>'' and p.id_nsalarial<181 and  p.id_ur='".$ur."'  order by id_ur asc";
		$numcon=3;
			$resultado1= @ mysql_query ($sql);
				if (!$resultado1)
				{
				exit ('error en la consulta');
				echo mysql_errno();
				}
			}else{
					if(empty($nom)){
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
				   left outer join tcat_tipo_servidor_publico tts on p.id_tservidor=tts.id_tservidor where p.codigo_puesto<>'' and p.id_nsalarial<181 and p.id_ur='".$ur."' and p.id_nsalarial='".$ns."' order by id_ur asc";
				$numcon=4;
				$resultado1= @ mysql_query ($sql);
				if (!$resultado1)
				{
					exit ('error en la consulta');
					echo mysql_errno();
				}
			}else{
				if($ur==0){
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
				   left outer join tcat_tipo_servidor_publico tts on p.id_tservidor=tts.id_tservidor where p.codigo_puesto<>'' and p.deno_puesto like '%".$nom."%' and p.id_nsalarial='".$ns."'order by id_ur asc";
					$numcon=5;
					$resultado1= @ mysql_query ($sql);
					if (!$resultado1)
					{
						exit ('error en la consulta');
						echo mysql_errno();
					}
				}else{
					if($ns==0){
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
				   left outer join tcat_tipo_servidor_publico tts on p.id_tservidor=tts.id_tservidor where p.codigo_puesto<>'' and p.id_nsalarial<181 and p.deno_puesto like '%".$nom."%' and p.id_ur='".$ur."'order by id_ur asc";
						$numcon=6;
						$resultado1= @ mysql_query ($sql);
						if (!$resultado1)
						{
							exit ('error en la consulta');
							echo mysql_errno();
						}
					}else{
						if(!($ur==0) and !empty($nom) and !($ns==0)){
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
				   left outer join tcat_tipo_servidor_publico tts on p.id_tservidor=tts.id_tservidor where p.codigo_puesto<>'' and p.id_nsalarial<181 and p.id_ur='".$ur."' and (p.deno_puesto like '%".$nom."%') and p.id_nsalarial='".$ns."' order by id_ur asc";
							$numcon=7;
							$resultado1= @ mysql_query ($sql);
							if (!$resultado1)
							{
								exit ('error en la consulta');
								echo mysql_errno();
							}
						}
					}
				}
			}
			}
		
		}
	}
	

		
		
	$num_regis=mysql_num_rows($resultado1);
	if($num_regis==0){
		echo "NO SE ENCONTRARON CONCIDENCIAS";
	}else{
		
		
		
			 echo "<center><form method='post' action='excel_puesto_spc_con.php' class='form-horizontal' role='form'> \n
		  <input type='hidden' name='nom' value='".$nom."'>
		   <input type='hidden' name='ur' value='".$ur."'>
		   <input type='hidden' name='ns' value='".$ns."'>
		<input type='hidden' name='con' value='".$numcon."'> 
	<div class='btn-group' role='group' aria-label='...'>
		   <input type='submit' value='Ver todos los puestos' onclick = 'location='c_puestos.php' class='btn btn-default'/>
			</div>	
		  <input type='submit' class='btn btn-default' onclick='location='excel_puesto_spc_con.php' value='Exportar consulta a excel '> 
		  </form></center>";	  
			?>
	
			 <?php
	 if($_SESSION["id"]==2){
	?>
	<center><div class='btn-group' role='group' aria-label='...'>
	<input type='submit' value='CREAR ´PUESTO NUEVO' onclick = "location='a_puestos.php'" class='btn btn-default'/>
	</div></center>
	 <?php
	 }
	?>
	     
		 <br><br>
		<?php
	  echo $num_regis." registros";
	  ?>
	  <table class="table table-striped" align="center">
    <tr>
			 <?php
	 if($_SESSION["id"]==2){
	?>
	<td><h3></h3></td>
	<td><h3></h3></td>
	
	 <?php
	 }
	?>
	<td><h3>RAMO</h3>
	<td><h3>UR</h3></td>
    <td><h3>PUESTO</h3></td>
	<td><h3>DENOMINACION DE PUESTO</h3></td>
	<td><h3>Z ECONOMICA</h3></td>
	<td><h3>REFERENCIA TABULAR</h3></td>
	<td><h3>CONSECUTIVO</h3></td>
	<td><h3>TIPO PLAZA</h3></td>
	<td><h3>CARAC OCUPACIONAL</h3></td>
	<td><h3>TIPO_FUNCION</h3></td>
	<td><h3>NIVEL_SALARIAL</h3></td>
	<td><h3>TABULADOR</h3></td>
	<td><h3>CODIGO PRESUPUESTAL</h3></td>
	<td><h3>ORIDINAL_CP</h3></td>
	<td><h3>GRUPO</h3></td>
	<td><h3>GRADO</h3></td>
	<td><h3>NIVEL</h3></td>
	<td><h3>ESTATUS OCUPACIONAL</h3></td>
	<td><h3>NOPLAUNI</h3></td>
	<td><h3>CONS_GRAL</h3></td>
	<td><h3>CONS_JEFE</h3></td>
	<td><h3>PTO</h3></td>
	<td><h3>Z ECONOMICA_RUSP</h3></td>
	<td><h3>ENT_PLAZA</h3></td>
	<td><h3>ENT_PAIS</h3></td>
	<td><h3>PUESTO_ESTRATEGICO</h3></td>
	<td><h3>TIPIFICACION ACTUAL</h3></td>
	<td><h3>TIPO DE CONTRATACION</h3></td>
	<td><h3>SDO_MEN</h3></td>
	<td><h3>CG_MENS</h3></td>
	<td><h3>TIPO_PERSONAL</h3></td>
	<td><h3>CLV_RFI_RIUF</h3></td>
	<td><h3>TIPO_SERVIDOR</h3></td>
	<td><h3>PUESTO JEFE</h3></td>
	<td><h3>DENO_PUESTO_J</h3></td>
	<td><h3>Z_ECONOMICA_J </h3></td>
	<td><h3>REF_TABULAR_J </h3></td>
	<td><h3>TIPO_PLAZA_J </h3></td>
	<td><h3>CARAC_OCUPA_J </h3></td>
	<td><h3>TIPO_FUNCION_J </h3></td>
	<td><h3>TABULADOR_J </h3></td>
	<td><h3>C_PRESUPUESTAL_J </h3></td>
	<td><h3>ORDINAL_CP_J </h3></td>
	</tr>

		<?php
	
		   while ($row=mysql_fetch_array ($resultado1))
		{
		echo "<tr>";
	if($_SESSION["id"]==2){
		echo "<td><form method='post' action=''> \n
      <input type='hidden' name='bus_puesto' value='".$row["id_puesto"]."'>
      <input class='btn btn-danger' type='submit' value='Borrar'>
      </form></td>";
	  echo "<td><form method='post' action=''> \n
      <input type='hidden' name='mo_puesto' value='".$row["id_puesto"]."'>
      <input class='btn btn-primary' type='submit' value='Modificar'> 
      </form></td>";	
	}
		echo "<td>". $row["id_ramo"]. "</td>";
		echo "<td>". $row["id_ur"]. "</td>";
		echo "<td>". $row["codigo_puesto"]. "</td>";
		echo "<td>". $row["deno_puesto"]. "</td>";
		echo "<td>". $row["id_ze"]. "</td>";
		echo "<td>". $row["r_tabular"]. "</td>";
		echo "<td>". $row["consecutivo"]. "</td>";
		echo "<td>". $row["tipo_plaza"]. "</td>";
		echo "<td>". $row["c_ocupacional"]. "</td>";
		echo "<td>". $row["tipo_funcion"]. "</td>";
		echo "<td>". $row["n_salarial"]. "</td>";
		echo "<td>". $row["tabulador"]. "</td>";
		echo "<td>". $row["c_presupuestal"]. "</td>";
		echo "<td>". $row["ordinal_cp"]. "</td>";
		echo "<td>". $row["grupo"]. "</td>";
		echo "<td>". $row["grado"]. "</td>";
		echo "<td>". $row["nivel"]. "</td>";
		echo "<td>". $row["estatus_ocupacional"]. "</td>";
		echo "<td>". $row["noplauni"]. "</td>";
		echo "<td>". $row["cons_gral"]. "</td>";
		echo "<td>". $row["cons_jefe"]. "</td>";
		echo "<td>". $row["pto"]. "</td>";	
		echo "<td>". $row["id_ze_rusp"]. "</td>";
		echo "<td>". $row["id_ent_plaza"]. "</td>";
		echo "<td>". $row["id_pais_plaza"]. "</td>";
		echo "<td>". $row["p_estrategico"]. "</td>";
		echo "<td>". $row["tipificacion_actual"]. "</td>";
		echo "<td>". $row["t_contratacion"]. "</td>";
		echo "<td>". $row["sdo_men"]. "</td>";
		echo "<td>". $row["cg_mens"]. "</td>";
		echo "<td>". $row["tipo_personal"]. "</td>";
		echo "<td>". $row["clv_rfi_riuf"]. "</td>";
		echo "<td>". $row["clv_tservidor"]. "</td>";
		echo "<td>". $row["codigo_puesto_jefe"]. "</td>";
		echo "<td>". $row["deno_jefe"]. "</td>";
		echo "<td>". $row["id_zj"]. "</td>";
		echo "<td>". $row["rtabularj"]. "</td>";
		echo "<td>". $row["plaza_j"]. "</td>";
		echo "<td>". $row["c_ocu_j"]. "</td>";
		echo "<td>". $row["funcion_j"]. "</td>";
		echo "<td>". $row["tabula_j"]. "</td>";
		echo "<td>". $row["cp_j"]. "</td>";
		echo "<td>". $row["ordinal_cp_j"]. "</td>";

		}
   echo '</table>';
	
	   
	}		
	}
	
	if (isset($_POST["eli_puesto"])){
		$id_puesto= $_POST["eli_puesto"];
	?>
		<html>
		<head> 
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
			<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
			<title>Actualizar datos del puesto</title>
		</head>
		<body>
			<center><h3>Proceso para dar de baja un puesto</h3></center>
			<br><br>
			<div class="bottom-buffer">
				<form role="form" class="clearfix"  method="post"  >
				<div class="row">
					<div class="col-md-4">
					</div>
					<div class="col-md-4">
						<div class="form-group">
						<label class="control-label">Escriba las observaciones por las que se va de dar de baja el puesto:</label>
						<textarea  class="form-control" name="observacion" cols=70 rows=5></textarea>
						</div>
					</div>
				</div>
				<div class="clearfix">
					<div class="pull-right">
							<input type="hidden" align="LEFT" name="g_obsspc" value="<?php echo $id_puesto;?>" /><p></td>
							<input type="submit" value="guardar" class="btn btn-primary pull-right" name="guardar">
					</div>
				  </div>
				</form>
			</div>
		</body>
		</html
		<?php
	
	}
	if(isset($_POST["g_obsspc"])){
		?>
		<html>
			 <head> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <title>Actualizar datos del puesto</title>
    </head>
	<?php
		$id_puesto=$_POST["g_obsspc"];
		$sql="UPDATE puestos SET
		observaciones='".$_POST['observacion']."'
		where id_puesto=".$id_puesto."";
		$resultado= @mysql_query($sql);
		if(!$resultado){
			?>
			<div class="alert alert-danger">No se pudieron actualizar correctamente los datos</div>
			<?php
		}else{
			
			?>
			<div class="alert alert-success">Datos insertados correctamente</div>
			<form name="buttonbar" class="clearfix" >
				<input type="button" class="btn btn-default" value="Ir a la tabla puestos_spc" onclick="location='c_puestos_spc.php'">
			</form>
			<?php
		}
	}
	
	if (isset($_POST["mo_puesto"])){
			$id_pto= $_POST["mo_puesto"];
		$sql = "SELECT * FROM puestos WHERE id_puesto='".$id_pto."'";

		$registro = @mysql_query($sql);
		if(!$registro){
			echo "Error ".mysql_errno();
			exit('<p>No se pudo obtener los detalles del registro.</p>');
		}
		$registro = mysql_fetch_array($registro);
		//echo "titulo=".$registro['Titulo'];
?>
		<html>
			 <head> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <title>Actualizar datos del puesto</title>
    </head>
			<body>
		          <div class="bottom-buffer">
            <form role="form" class="clearfix"  method="post"  >
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="deno_puesto">Denominacion de  puesto<span class="form-text">*</span>:</label>
                    <input type="text" name="deno_puesto" class="form-control" value="<?php echo $registro['deno_puesto'];?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="cod_puesot">Codigo de puesto<span class="form-text">*</span>:</label>
                    <input type="text" name="codigo_puesto" class="form-control"  value="<?php echo $registro['codigo_puesto'];?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="ramo">Ramo<span class="form-text">*</span>:</label>
                   	<?php
					$resactual="SELECT id_ramo,ramo FROM tcat_ramo where id_ramo=".$registro["id_ramo"]."";
					$conactual=@mysql_query($resactual);
					$con2="SELECT id_ramo,ramo FROM tcat_ramo";
					$res2=@mysql_query($con2);
					if(!$res2){
						echo " fallo";
					}
					else{
					
						echo "<select name='combo1' class='form-control'>";
						while ($actual=mysql_fetch_array($conactual)){
							echo "<option value=".$actual['id_ramo'].">	".$actual["ramo"]." (Registro actual)<option>";
						}
						while ($fila2=mysql_fetch_array($res2)){
							echo "<option value=".$fila2['id_ramo'].">".$fila2['ramo']." </option>";
						}
						echo "</select>";
					}
		?>

                  </div>
                </div>
              </div>
			  <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                     <label for="secondName">Unidad de Adscripcion:<span class="form-text">*</span>:</label>
                   	<?php
						$resactual2="SELECT id_ur,ur FROM tcat_ur where id_ur=".$registro["id_ur"]."";
						$conactual2=@mysql_query($resactual2);
						$con3="SELECT id_ur,ur FROM tcat_ur order by ur asc";
						$res3=@mysql_query($con3);
						if(!$res3){
							echo " fallo";
						}
						else{
						
							echo "<select name='combo2' class='form-control'>";
							while ($actual1=mysql_fetch_array($conactual2)){
								echo "<option value=".$actual1['id_ur'].">	".$actual1["ur"]." (Registro actual)<option>";
							}
							while ($fila2=mysql_fetch_array($res3)){
								echo "<option value=".$fila2['id_ur'].">".$fila2['ur']." </option>";
							}
							echo "</select>";
						}
						?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="secondName">Zona economica:<span class="form-text">*</span>:</label>
                   	<?php
						$resactual3="SELECT id_ze,z_economica FROM tcat_zona_economica where id_ze=".$registro["id_ze"]."";
						$conactual3=@mysql_query($resactual3);
						$con4="SELECT id_ze,z_economica FROM tcat_zona_economica";
						$res4=@mysql_query($con4);
						if(!$res4){
							echo " fallo";
						}
						else{
						
							echo "<select name='combo3' class='form-control'>";
							while ($actual2=mysql_fetch_array($conactual3)){
								echo "<option value=".$actual2['id_ze'].">	".$actual2["z_economica"]." (Registro actual)<option>";
							}
							while ($fila2=mysql_fetch_array($res4)){
								echo "<option value=".$fila2['id_ze'].">".$fila2['z_economica']." </option>";
							}
							echo "</select>";
						}
						?>
                  </div>
                  </div>
				    <div class="col-md-4">
                  <div class="form-group">
                    <label for="secondName">Referencia tabular<span class="form-text">*</span>:</label>
									<?php
						$resactual="SELECT id_rtabular,r_tabular FROM tcat_rtabular where id_rtabular=".$registro["id_rtabular"]."";
						$conactual=@mysql_query($resactual);
						$con2="SELECT id_rtabular,r_tabular FROM tcat_rtabular";
						$res2=@mysql_query($con2);
						if(!$res2){
							echo " fallo";
						}
						else{
						
							echo "<select name='combo4' class='form-control'>";
							while ($actual=mysql_fetch_array($conactual)){
								echo "<option value=".$actual['id_rtabular'].">	".$actual["r_tabular"]." (Registro actual)<option>";
							}
							while ($fila2=mysql_fetch_array($res2)){
								echo "<option value=".$fila2['id_rtabular'].">".$fila2['r_tabular']." </option>";
							}
							echo "</select>";
						}
						?>

                  </div>
                </div>
				  
                </div>
                <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                     <label for="secondName">Consecutivo :<span class="form-text">*</span>:</label>
						<input type="text" name="consecutivo" class="form-control"value="<?php echo $registro['consecutivo'];?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="secondName">Tipo de plaza:<span class="form-text">*</span>:</label>
                   	<?php
						$resactual3="SELECT id_tplaza,tipo_plaza FROM tcat_tipo_plaza where id_tplaza=".$registro["id_tplaza"]."";
						$conactual3=@mysql_query($resactual3);
						$con4="SELECT id_tplaza,tipo_plaza	FROM tcat_tipo_plaza";
						$res4=@mysql_query($con4);
						if(!$res4){
							echo " fallo";
						}
						else{
						
							echo "<select name='combo5' class='form-control'>";
							while ($actual2=mysql_fetch_array($conactual3)){
								echo "<option value=".$actual2['id_tplaza'].">	".$actual2["tipo_plaza"]." (Registro actual)<option>";
							}
							while ($fila2=mysql_fetch_array($res4)){
								echo "<option value=".$fila2['id_tplaza'].">".$fila2['tipo_plaza']." </option>";
							}
							echo "</select>";
						}
						?>
                  </div>
                  </div>
				    <div class="col-md-4">
                  <div class="form-group">
                    <label for="secondName">Caracter ocupacional<span class="form-text">*</span>:</label>
					<input type="text" name="c_occupacional" class="form-control" value="<?php echo $registro['c_ocupacional'];?>">
					
                  </div>
                </div>  
                </div>
				
				    
				<div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                     <label for="secondName">Tipo de función:<span class="form-text">*</span>:</label>
							<?php
						$resactual3="SELECT id_funcion,tipo_funcion FROM tcat_tipo_funcion where id_funcion=".$registro["id_funcion"]."";
						$conactual3=@mysql_query($resactual3);
						$con4="SELECT id_funcion,tipo_funcion FROM tcat_tipo_funcion";
						$res4=@mysql_query($con4);
						if(!$res4){
							echo " fallo";
						}
						else{
						
							echo "<select name='combo6' class='form-control'>";
							while ($actual2=mysql_fetch_array($conactual3)){
								echo "<option value=".$actual2['id_funcion'].">	".$actual2["tipo_funcion"]." (Registro actual)<option>";
							}
							while ($fila2=mysql_fetch_array($res4)){
								echo "<option value=".$fila2['id_funcion'].">".$fila2['tipo_funcion']." </option>";
							}
							echo "</select>";
						}
						?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="secondName">Nivel salarial:<span class="form-text">*</span>:</label>
                   	<?php
						$resactual3="SELECT id_nsalarial,n_salarial FROM tcat_nivel_salarial where id_nsalarial=".$registro["id_nsalarial"]."";
						$conactual3=@mysql_query($resactual3);
						$con4="SELECT id_nsalarial,n_salarial	FROM tcat_nivel_salarial";
						$res4=@mysql_query($con4);
						if(!$res4){
							echo " fallo";
						}
						else{
						
							echo "<select name='combo7' class='form-control'>";
							while ($actual2=mysql_fetch_array($conactual3)){
								echo "<option value=".$actual2['id_nsalarial'].">	".$actual2["n_salarial"]." (Registro actual)<option>";
							}
							while ($fila2=mysql_fetch_array($res4)){
								echo "<option value=".$fila2['id_nsalarial'].">".$fila2['n_salarial']." </option>";
							}
							echo "</select>";
						}
						?>
                  </div>
                  </div>
				    <div class="col-md-4">
                  <div class="form-group">
                    <label for="secondName">Tabulador:<span class="form-text">*</span>:</label>
					<input type="text" name="tabulador" class="form-control" value="<?php echo $registro['tabulador'];?>">
                  </div>
                </div>
				  
                </div>
				
			<div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                     <label for="secondName">Codigo presupuestal:<span class="form-text">*</span>:</label>
						<input type="text" name="c_presupuestal" class="form-control" value="<?php echo $registro['c_presupuestal'];?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="secondName">Ordinal CP:<span class="form-text">*</span>:</label>
                   	<input type="text" name="ordinal_cp" class="form-control" value="<?php echo $registro['ordinal_cp'];?>">
                  </div>
                  </div>
				 <div class="col-md-4">
                    <div class="form-group clearfix">
                    <div class="form-control-lada">
                      <label for="lada">Grupo<span class="form-text">*</span>:</label>
                      <input type="text" name="grupo" class="form-control" value="<?php echo $registro['grupo'];?>">
                    </div>
                    <div class="form-control-lada">
                      <label for="phone">Grado<span class="form-text">*</span>:</label>
                      <input type="text" name="grado" class="form-control" value="<?php echo $registro['grado'];?>">
                    </div>
					 <div class="form-control-lada">
                      <label for="phone">Nivel<span class="form-text">*</span>:</label>
                      <input type="text" name="nivel" class="form-control"value="<?php echo $registro['nivel'];?>">
                    </div>
                  </div>
                </div>			
                </div>
					    
				<div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                     <label for="secondName">Estatus ocupacional:<span class="form-text">*</span>:</label>
							<?php
						$resactual3="SELECT id_eocupacional,estatus_ocupacional FROM tcat_estatus_ocupacional where id_eocupacional=".$registro["id_eocupacional"]."";
						$conactual3=@mysql_query($resactual3);
						$con4="SELECT id_eocupacional,estatus_ocupacional FROM tcat_estatus_ocupacional";
						$res4=@mysql_query($con4);
						if(!$res4){
							echo " fallo";
						}
						else{
						
							echo "<select name='combo8' class='form-control'>";
							while ($actual2=mysql_fetch_array($conactual3)){
								echo "<option value=".$actual2['id_eocupacional'].">	".$actual2["estatus_ocupacional"]." (Registro actual)<option>";
							}
							while ($fila2=mysql_fetch_array($res4)){
								echo "<option value=".$fila2['id_eocupacional'].">".$fila2['estatus_ocupacional']." </option>";
							}
							echo "</select>";
						}
						?>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="secondName">Plaza de subordinados:<span class="form-text">*</span>:</label>
						<input type="text" name="p_subordinados" class="form-control" value="<?php echo $registro['p_subordinados'];?>">
                  </div>
                  </div>
				    <div class="col-md-4">
                  <div class="form-group">
                    <label for="secondName">Aspectos revelantes:<span class="form-text">*</span>:</label>
					<input type="text" name="a_revelantes" class="form-control" value="<?php echo $registro['a_revelantes'];?>">
                  </div>
                </div>
				  
                </div>
				
				
					<div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                     <label for="secondName">Entidad relacionada:<span class="form-text">*</span>:</label>
							<input type="text" name="e_relacionada" class="form-control" value="<?php echo $registro['e_relacionada'];?>">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                      <label for="secondName">Nivel de escolaridad:<span class="form-text">*</span>:</label>
						
								<?php
						$resactual3="SELECT id_escolaridad,nive_e,estatus_e FROM tcat_escolaridad where id_escolaridad=".$registro["id_escolaridad"]."";
						$conactual3=@mysql_query($resactual3);
						$con4="SELECT id_escolaridad,nive_e,estatus_e FROM tcat_escolaridad";
						$res4=@mysql_query($con4);
						if(!$res4){
							echo " fallo";
						}
						else{
						
							echo "<select name='combo9' class='form-control'>";
							while ($actual2=mysql_fetch_array($conactual3)){
								echo "<option value=".$actual2['id_escolaridad'].">	".$actual2["nive_e"]." ".$actual2["estatus_e"]."(Registro actual)<option>";
							}
							while ($fila2=mysql_fetch_array($res4)){
								echo "<option value=".$fila2['id_escolaridad'].">".$fila2['nive_e']." ".$fila2['estatus_e']." </option>";
							}
							echo "</select>";
						}
						?>
                  </div>
                  </div>
				    <div class="col-md-4">
                  <div class="form-group">
                    <label for="secondName">Años de experiencia:<span class="form-text">*</span>:</label>
					<input type="text" name="a_experiencia" class="form-control" value="<?php echo $registro['anio_experiencia'];?>">
                  </div>
                </div>
				  
                </div>
				
				<div class="clearfix">
                <div class="pull-left text-muted text-vertical-align-button">
                  * Campos obligatorios
                </div>

                <div class="pull-right">
						<input type="hidden" align="LEFT" name="id_pto" value="<?php echo $registro['id_puesto'];?>" /><p></td>
						<input type="submit" value="ACTUALIZAR" class="btn btn-primary pull-right" name="actualizar">
                </div>
              </div>
					
					
            </form>
          </div>
			</body>
	
			</html>
	<?php
	}
	
	if(isset($_POST['id_pto'])){
		?>
		<html>
    	<head><title>Resultado de UPDATE</title></head>
    	<body>

		<?php
		$sql="UPDATE puestos SET
		deno_puesto='".$_POST['deno_puesto']."',
		codigo_puesto='".$_POST['codigo_puesto']."',
		id_ramo='".$_POST['combo1']."',
		id_ur='".$_POST['combo2']."',
		id_ze='".$_POST['combo3']."',
		id_rtabular='".$_POST['combo4']."',
		consecutivo='".$_POST['consecutivo']."',
		id_tplaza='".$_POST['combo5']."',
		c_ocupacional='".$_POST['c_occupacional']."',
		id_funcion='".$_POST['combo6']."',
		id_nsalarial='".$_POST['combo7']."',
		tabulador='".$_POST['combo5']."',
		c_presupuestal='".$_POST['combo6']."',
		ordinal_cp='".$_POST['ordinal_cp']."',
		grupo='".$_POST['grupo']."',
		grado='".$_POST['grado']."',
		nivel='".$_POST['nivel']."',
		id_eocupacional='".$_POST['combo8']."',
		p_subordinados='".$_POST['p_subordinados']."',
		a_revelantes='".$_POST['a_revelantes']."',
		e_relacionada='".$_POST['e_relacionada']."',
		id_escolaridad='".$_POST['combo9']."',
		anio_experiencia='".$_POST['a_experiencia']."'
		
		WHERE id_puesto='".$_POST['id_pto']."'";

		if(@mysql_query($sql)){
				?>
			<html>
			<head>
				<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
				<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
			</head>
			
			<div class="alert alert-success">Registro actualizado</div>
			
			<?php
		}
		else{
			echo "<p>Error al actualizar el registro.</p>";
			echo mysql_errno();
			if (mysql_errno()==1452){
				echo "existe una restricción y tendrá que actualizar datos en editorial.";
			}
		}
		/*echo '<div align="center"><p><a href="cambios.html">Regresar a Cambios</a></p></div>';*/
		echo '</body></html>';

	}	

	
}	
}
 mysql_close($conexion); ?>