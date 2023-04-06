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

if (!$_POST /*and !$_Get*/)
        { //evalua si se enviaron los datos del formulario
	?>
    <html>
    <head> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <title>Listas de personas</title>
    </head>
    <body>

	</body>
	</html>

<?php


 	echo "<br>";
		$sql =  "Select DISTINCT p.id_ramo as ramo,eo.estatus_ocupacional as e_ocupacional,ta.tipificacion_actual as t_actual,p.codigo_puesto as cod_p,p.id_ur as UR,
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
								where (p.codigo_puesto<>'' or p.codigo_puesto<>'NA') and p.id_nsalarial<181 and per.status=1 ORDER BY p.id_ur asc";
	$resultado1= @ mysql_query ($sql);
	$numrow= @mysql_num_rows($resultado1);
	if (!$resultado1)
	{
	 exit ('error en la consulta');
    }
    ?>	
    <HTML>
    <BODY>
	<head> 
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    </head>
    <h2><center>PLANTILLA DEL SPC</h2>
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
		echo "<div class='col-sm-8'><select name='ur' class='form-control'>";
		echo "<option value=0>SELECCIONE EL AREA DE ADSCRIPCION</option>";
		while ($fila3=mysql_fetch_array($res3)){
			echo "<option value=".$fila3['id_ur'].">".$fila3['ur']." </option>";
		}
		echo "</select></div></div>";
	}
	echo "<label class='col-sm-3 control-label'>Nivel salarial</label>";
	$con3="SELECT * FROM tcat_nivel_salarial where id_nsalarial<181 order by n_salarial asc";
	$res3=@mysql_query($con3);
	if(!$res3){
		echo " fallo";
	}
	else{
		echo "<div class='form-group'><div class='col-sm-8'><select name='ns' class='form-control'>";
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
			<label class="col-sm-3 control-label">Nombre:</label>
			<div class="col-sm-8">
			<input class="form-control" id="nombre" placeholder="" type="text" name="nombre">
			</div>
		</div>
		<div class="form_group">
			<label class="col-sm-3 control-label">Año de ingreso a la plaza</label>
			<div class='col-sm-8'>
			<select name="anio_i"class='form-control'>
			<option value="0"   >Año</option>
			<?php
			$year=date("Y");
			for($i=1970;$i<$year;$i++){
				echo '<option value="'.$i.'">'.$i."</option>";
				
			}
		
?>	 
	</select></div></div>
		<div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">
	 <input type='hidden' name='bus_plantilla' value='".$row["id_empleado"]."'>
      <input type='submit' class="btn btn-primary pull-right" value='BUSCAR'></div></div>
	  
	</form>
	<form method='' action='excel_plantilla.php' class='form-horizontal' role='form'> 
	 <input type='hidden' name='exportar' value='".$row["id_empleado"]."'></input>
      <input type='submit' class='btn btn-default' value='Exportar tabla a excel '> 
      </form>
	  <?php
	  echo $numrow." registros";
	  ?>
    <table class="table table-striped" align="center">
    <tr>
	<td><h5>RAMO						</h5></td>
    <td><h5>OCUPACION					</h5></td>
	<td><h5>TIPIFICACION ACTUAL			</h5></td>
	<td><h5>CODIGO DE PUESTO			</h5></td>
	<td><h5>UR							</h5></td>
	<td><h5>ADSCRIPCION					</h5></td>
	<td><h5>DENOMINACION_DEL_PUESTO		</h5></td>
	<td><h5>NIVEL SALARIAL				</h5></td>
	<td><h5>TIPO DE CONTRATACIÓN		</h5></td>
	<td><h5>TIPO DE INGRESO A LA PLAZA	</h5></td>
	<td><h5>FUNCIONES					</h5></td>
	<td><h5>OCUPANTE					</h5></td>
	<td><h5>NO.EMPLEADO					</h5></td>
	<td><h5>CORREO_ELECTRONICO			</h5></td>
	<td><h5>RUSP						</h5></td>
	<td><h5>RFC							</h5></td>
	<td><h5>CURP						</h5></td>
	<td><h5>GENERO						</h5></td>
	<td><h5>FECHA DE INGRESO A LA PLAZA	</h5></td>
	<td><h5>MOTIVO_DE_INGRESO			</h5></td>
	<td><h5>ASPECTOS_REVELANTES			</h5></td>
	<td><h5>ENTIDAD_RELACIONADA			</h5></td>
	<td><h5>AÑOS_DE_EXPERIENCIA		</h5></td>
	<td><h5>RAMO_JEFE			</h5></td>
	<td><h5>UR_JEFE			</h5></td>
	<td><h5>ADSCRIPCION_JEFE			</h5></td>
	<td><h5>CODIGO PUESTO JEFE			</h5></td> 
	<td><h5>DENIMANCION PUESTO JEFE			</h5></td> 
	<td><h5>CODIGO PRESUPUESTAL			</h5></td> 
	<td><h5>OCUPANTE			</h5></td> 

	
	</tr>


 <?php
while ($row=mysql_fetch_array ($resultado1))
{
echo "<tr><td>". $row["ramo"]. "</td>";
echo "<td>". $row["e_ocupacional"]. "</td>";
echo "<td>". $row["t_actual"]. "</td>";
echo "<td>". $row["cod_p"]. "</td>";
echo "<td>". $row["UR"]. "</td>";
echo "<td>". $row["adscri"]. "</td>";
echo "<td>". $row["d_puesto"]. "</td>";
echo "<td>". $row["n_sal"]. "</td>";
echo "<td>". $row["t_contra"]. "</td>";
echo "<td>". $row["t_plaza"]. "</td>";
echo "<td>". $row["t_funcion"]. "</td>";
$sql1="Select status from persona where id_empleado='".$row['id_emp']."'";
$bus1= @mysql_query($sql1);
$row1= mysql_fetch_array($bus1);
if($row1["status"]==2){
	echo "<td>VACANTE</td>";
}else{
	echo "<td>". $row["OCUPANTE"]. "</td>";
}

echo "<td>". $row["id_emp"]. "</td>";
echo "<td>". $row["mail"]. "</td>";
echo "<td>". $row["RUSP"]. "</td>";
echo "<td>". $row["RFC"]. "</td>";
echo "<td>". $row["CURP"]. "</td>";
echo "<td>". $row["sex"]. "</td>";
echo "<td>". $row["f_plaza"]. "</td>";
echo "<td>". $row["mo_ing"]. "</td>";
echo "<td>". $row["a_revelantes"]. "</td>";
echo "<td>". $row["e_relacionada"]. "</td>";
echo "<td>". $row["anio_experiencia"]. "</td>";
echo "<td>". $row["ramo_j"]. "</td>";
echo "<td>". $row["ur_j"]. "</td>";
echo "<td>". $row["ads_j"]. "</td>";
echo "<td>". $row["cod_j"]. "</td>";
echo "<td>". $row["deno_j"]. "</td>";
echo "<td>". $row["presu_j"]. "</td>";
echo "<td>". $row["OCUPANTE_J"]. "</td>";
}
   echo '</table>';
    echo '
    </body>
    </html>';

}else{
	if(isset($_POST["bus_plantilla"])){
		$ur=$_POST["ur"];
		$nombre=$_POST["nombre"];
		$pto=$_POST["puesto"];
		$ns=$_POST["ns"];
		$anio=$_POST["anio_i"];
		
		?>
		<HTML>
    <BODY>
	<head> 
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    </head>
    <h2><center>PLANTILLA DEL SPC</h2>
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
		echo "<div class='col-sm-8'><select name='ur' class='form-control'>";
		echo "<option value=0>SELECCIONE EL AREA DE ADSCRIPCION</option>";
		while ($fila3=mysql_fetch_array($res3)){
			echo "<option value=".$fila3['id_ur'].">".$fila3['ur']." </option>";
		}
		echo "</select></div></div>";
	}
	echo "<label class='col-sm-3 control-label'>Nivel salarial</label>";
	$con3="SELECT * FROM tcat_nivel_salarial where id_nsalarial<181 order by n_salarial asc";
	$res3=@mysql_query($con3);
	if(!$res3){
		echo " fallo";
	}
	else{
		echo "<div class='form-group'><div class='col-sm-8'><select name='ns' class='form-control'>";
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
			<label class="col-sm-3 control-label">Nombre:</label>
			<div class="col-sm-8">
			<input class="form-control" id="nombre" placeholder="" type="text" name="nombre">
			</div>
		</div>
		<div class="form_group">
			<label class="col-sm-3 control-label">Año de ingreso a la plaza</label>
			<div class='col-sm-8'>
			<select name="anio_i"class='form-control'>
				<option value="0"   >Año</option>
				<?php
				$year=date("Y");
				for($i=1970;$i<$year;$i++){
					echo '<option value="'.$i.'">'.$i."</option>";	
				}?>	 
			</select></div></div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-8">
			  <input type='hidden' name='bus_plantilla' value='".$row["id_empleado"]."'>
			  <input type='submit' class="btn btn-primary pull-right" value='BUSCAR'>
			</div>
	    </div>
	  
	</form>	
		<?php
		
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
								echo mysql_errno();
							}
		$num_regis=mysql_num_rows($resultado1);
		if($num_regis==0){
		echo "NO SE ENCONTRARON CONCIDENCIAS";
	}else{
		
		
		
	 echo "<form method='post' action='excel_plantilla_con.php' class='form-horizontal' role='form'> \n
          <input type='hidden' name='n_salarial' value='".$ns."'>
		  <input type='hidden' name='puesto' value='".$pto."'>
		<input type='hidden' name='nom' value='".$nombre."'>
        <input type='hidden' name='ur' value='".$ur."'>
	    <input type='hidden' name='f_plaza' value='".$anio."'>
      <input type='submit' class='btn btn-default' value='Exportar consulta a excel '> 
      </form>";	
	echo $num_regis." registros ";	  
    ?>
    <table class="table table-striped" align="center">
    <tr>
	<tr>
	<td><h5>RAMO						</h5></td>
    <td><h5>OCUPACION					</h5></td>
	<td><h5>TIPIFICACION ACTUAL			</h5></td>
	<td><h5>CODIGO DE PUESTO			</h5></td>
	<td><h5>UR							</h5></td>
	<td><h5>ADSCRIPCION					</h5></td>
	<td><h5>DENOMINACION DEL PUESTO		</h5></td>
	<td><h5>NIVEL SALARIAL				</h5></td>
	<td><h5>TIPO DE CONTRATACIÓN		</h5></td>
	<td><h5>TIPO DE INGRESO A LA PLAZA	</h5></td>
	<td><h5>FUNCIONES					</h5></td>
	<td><h5>OCUPANTE					</h5></td>
	<td><h5>NO.EMPLEADO					</h5></td>
	<td><h5>CORREO ELECTRONICO			</h5></td>
	<td><h5>RUSP						</h5></td>
	<td><h5>RFC							</h5></td>
	<td><h5>CURP						</h5></td>
	<td><h5>GENERO						</h5></td>
	<td><h5>FECHA DE INGRESO A LA PLAZA	</h5></td>
	<td><h5>MOTIVO DE INGRESO			</h5></td>
	<td><h5>ASPECTOS_REVELANTES			</h5></td>
	<td><h5>ENTIDAD_RELACIONADA			</h5></td>
	<td><h5>AÑOS_DE_EXPERIENCIA		</h5></td>
	<td><h5>RAMO_JEFE			</h5></td>
	<td><h5>UR_JEFE			</h5></td>
	<td><h5>ADSCRIPCION_JEFE			</h5></td>
	<td><h5>CODIGO PUESTO JEFE			</h5></td> 
	<td><h5>DENIMANCION PUESTO JEFE			</h5></td> 
	<td><h5>CODIGO PRESUPUESTAL			</h5></td> 
	<td><h5>OCUPANTE			</h5></td> 
	</tr>
	<?php
	while ($row=mysql_fetch_array ($resultado1))
	{
		echo "<tr><td>". $row["ramo"]. "</td>";
echo "<td>". $row["e_ocupacional"]. "</td>";
echo "<td>". $row["t_actual"]. "</td>";
echo "<td>". $row["cod_p"]. "</td>";
echo "<td>". $row["UR"]. "</td>";
echo "<td>". $row["adscri"]. "</td>";
echo "<td>". $row["d_puesto"]. "</td>";
echo "<td>". $row["n_sal"]. "</td>";
echo "<td>". $row["t_contra"]. "</td>";
echo "<td>". $row["t_plaza"]. "</td>";
echo "<td>". $row["t_funcion"]. "</td>";
$sql1="Select status from persona where id_empleado='".$row['id_emp']."'";
$bus1= @mysql_query($sql1);
$row1= mysql_fetch_array($bus1);
if($row1["status"]==2){
	echo "<td>VACANTE</td>";
}else{
	echo "<td>". $row["OCUPANTE"]. "</td>";
}

echo "<td>". $row["id_emp"]. "</td>";
echo "<td>". $row["mail"]. "</td>";
echo "<td>". $row["RUSP"]. "</td>";
echo "<td>". $row["RFC"]. "</td>";
echo "<td>". $row["CURP"]. "</td>";
echo "<td>". $row["sex"]. "</td>";
echo "<td>". $row["f_plaza"]. "</td>";
echo "<td>". $row["mo_ing"]. "</td>";
echo "<td>". $row["a_revelantes"]. "</td>";
echo "<td>". $row["e_relacionada"]. "</td>";
echo "<td>". $row["anio_experiencia"]. "</td>";
echo "<td>". $row["ramo_j"]. "</td>";
echo "<td>". $row["ur_j"]. "</td>";
echo "<td>". $row["ads_j"]. "</td>";
echo "<td>". $row["cod_j"]. "</td>";
echo "<td>". $row["deno_j"]. "</td>";
echo "<td>". $row["presu_j"]. "</td>";
echo "<td>". $row["OCUPANTE_J"]. "</td>";
	}
   echo '</table>';
    echo '
    </body>
    </html>';
	}
	}
	
	
	
}
 mysql_close($conexion); ?>