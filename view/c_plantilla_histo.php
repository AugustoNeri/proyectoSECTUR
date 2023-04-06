<?php
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
	?>
	<!DOCTYPE html>
    <html>
    <head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    </head>
    <body>
	

	</body>
	</html>

<?php


 	echo "<br>";
 	$sql =  "Select id_ramo,puestos.id_ur,ur,codigo_puesto,deno_puesto,f_ingr_sectur,f_ingr_apf,f_ingr_spc,f_baja,plantilla.id_baja,m_baja,
	rfc,curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
	from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
				left outer join persona on plantilla.id_empleado=persona.id_empleado 
				left outer join tcat_motivo_baja on plantilla.id_baja=tcat_motivo_baja.id_baja 
				left outer join tcat_ur on puestos.id_ur=tcat_ur.id_ur where status=2 order by puestos.id_ur asc,a_paterno asc,nombre asc";
	$resultado1= @ mysql_query ($sql);
	$num_regis=mysql_num_rows($resultado1);
	if (!$resultado1)
	{
	 exit ('error en la consulta');
	
    }
    ?>
    <HTML>
    <BODY>
	  <h2><center>PLANTILLA HISTORICA</h2>
	<form action="" method='post' class="form-horizontal" role="form">
	<div class="form-group">
	<?php
	echo "<label class='col-sm-3 control-label' for='email-03'>Unidad de Adscripcion:</label>";
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
	
		?>		
	 
		<div class="form-group">
			<label class="col-sm-3 control-label" for="email-03">Nombre de empleado:</label>
			<div class="col-sm-8">
			<input class="form-control" id="nomemp" placeholder="" type="text" name="nomemp">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="email-03">Nombre del puesto:</label>
			<div class="col-sm-8">
			<input class="form-control" id="nompto" placeholder="" type="text" name="nompto">
			</div>
		</div>
	<div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">
	 <input type='hidden' name='bus_plantilla_histo' value='".$row["id_empleado"]."'></input>
      <input class="btn btn-primary pull-right" type='submit' value='BUSCAR'> </input>

	  </dIV>
	  </div>
	</form>
	<form method='' action='excel_plantilla_histo.php' class='form-horizontal' role='form'> 
	 <input type='hidden' name='excel_histo' value='".$row["id_empleado"]."'></input>
      <input type='submit' class='btn btn-default' value='Exportar tabla a excel '> 
      </form>
	  <?php
	   echo $num_regis." registros";
	  ?>	
 <table align="center" class="table table-striped">
    <tr>
    <td>RAMO1</td>
	<td>UR</td>
	<td>UNIDAD DE ADSCRIPCION</td>
	<td>CODIGO DE PUESTO</td>
	<td>DENOMINACION DE PUESTO</td>
	<td>FECHA DE INGRESO A SECTUR</td>
	<td>FECHA DE INGRESO A APF</td>
	<td>FECHA DE INGRESO A SPC</td>
	<td>FECHA DE BAJA</td>
	<td>MOTIVO DE BAJA</td>
	<td>RFC</td>
	<td>CURP</td>
	<td>NOMBRE</td>
	<td>APELLIDO PATERNO</td>
	<td>APELLIDO MATERNO</td>
	<td>NUM_EMP</td>
	</tr>
 
 <?php
while ($row=mysql_fetch_array ($resultado1))
{
	  echo "<tr>";
	echo "<td>". $row["id_ramo"]. "</td>";
	echo "<td>". $row["id_ur"]. "</td>";
	echo "<td>". $row["ur"]. "</td>";
	echo "<td>". $row["codigo_puesto"]. "</td>";
	echo "<td>". $row["deno_puesto"]. "</td>";
	echo "<td>". $row["f_ingr_sectur"]. "</td>";
	echo "<td>". $row["f_ingr_apf"]. "</td>";
	echo "<td>". $row["f_ingr_spc"]. "</td>";
	echo "<td>". $row["f_baja"]. "</td>";
	echo "<td>". $row["m_baja"]. "</td>";
	echo "<td>". $row["rfc"]. "</td>";
	echo "<td>". $row["curp"]. "</td>";
	echo "<td>". $row["nombre"]. "</td>";
	echo "<td>". $row["a_paterno"]. "</td>";
	echo "<td>". $row["a_materno"]. "</td>";
	echo "<td>". $row["id_empleado"]. "</td><tr>";
}
   echo '</table>';
    echo '
    </body>
    </html>';

}else{
		if(isset($_POST["bus_plantilla_histo"])){
			
		$nomemp=$_POST["nomemp"];
		$nompto=$_POST["nompto"];
		$ur=$_POST["combo2"]
		?>
		<HTML>
    <BODY>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <h2><center>PLANTILLA HISTORICA</h2>
		<h3><a href="c_rusp_bajas.php" target=main>Mostrar todos los registros</a></h3>
	<form action="" method='post' class="form-horizontal" role="form">
	<div class="form-group">
	<?php
	echo "<label class='col-sm-3 control-label' for='email-03'>Unidad de Adscripcion:</label>";
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
	
		?>		
	 
		<div class="form-group">
			<label class="col-sm-3 control-label" for="email-03">Nombre de empleado:</label>
			<div class="col-sm-8">
			<input class="form-control" id="nomemp" placeholder="" type="text" name="nomemp">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="email-03">Nombre de puesto:</label>
			<div class="col-sm-8">
			<input class="form-control" id="nompto" placeholder="" type="text" name="nompto">
			</div>
		</div>
		
	<div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">
	 <input type='hidden' name='bus_plantilla_histo' value='".$row["id_empleado"]."'></input>
      <input class="btn btn-primary pull-right" type='submit' value='BUSCAR'> </input>

	  </dIV>
	  </div>
	</form>
	
	<?php
	if(empty($nomemp)){
		if($ur==0){
			if(empty($nompto)){
			}else{
				$sql =  "Select id_ramo,puestos.id_ur,ur,codigo_puesto,deno_puesto,f_ingr_sectur,f_ingr_apf,f_ingr_spc,f_baja,plantilla.id_baja,m_baja,
				rfc,curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
				from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
				left outer join persona on plantilla.id_empleado=persona.id_empleado 
				left outer join tcat_motivo_baja on plantilla.id_baja=tcat_motivo_baja.id_baja 
				left outer join tcat_ur on puestos.id_ur=tcat_ur.id_ur where status=2 and deno_puesto like '%$nompto%' order by puestos.id_ur asc,a_paterno asc,nombre asc";
				$con=1;
			}
		}else{
			if(empty($nompto)){
				$sql =  "Select id_ramo,puestos.id_ur,ur,codigo_puesto,deno_puesto,f_ingr_sectur,f_ingr_apf,f_ingr_spc,f_baja,plantilla.id_baja,m_baja,
				rfc,curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
				from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
				left outer join persona on plantilla.id_empleado=persona.id_empleado 
				left outer join tcat_motivo_baja on plantilla.id_baja=tcat_motivo_baja.id_baja 
				left outer join tcat_ur on puestos.id_ur=tcat_ur.id_ur 
				where status=2 and id_ur order by puestos.id_ur asc,a_paterno asc,nombre asc";
				$con=2;
			}else{
				$sql =  "Select id_ramo,puestos.id_ur,ur,codigo_puesto,deno_puesto,f_ingr_sectur,f_ingr_apf,f_ingr_spc,f_baja,plantilla.id_baja,m_baja,
				rfc,curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
				from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
				left outer join persona on plantilla.id_empleado=persona.id_empleado 
				left outer join tcat_motivo_baja on plantilla.id_baja=tcat_motivo_baja.id_baja 
				left outer join tcat_ur on puestos.id_ur=tcat_ur.id_ur 
				where status=2 and id_ur='$ur' and deno_puesto like '%$nompto%' order by puestos.id_ur asc,a_paterno asc,nombre asc";
				$con=3;
			}		
		}	
	}else{
		if($ur==0){
			if(empty($nompto)){
					$sql =  "Select id_ramo,puestos.id_ur,ur,codigo_puesto,deno_puesto,f_ingr_sectur,f_ingr_apf,f_ingr_spc,f_baja,plantilla.id_baja,m_baja,
				rfc,curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
				from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
				left outer join persona on plantilla.id_empleado=persona.id_empleado 
				left outer join tcat_motivo_baja on plantilla.id_baja=tcat_motivo_baja.id_baja 
				left outer join tcat_ur on puestos.id_ur=tcat_ur.id_ur 
				where status=2 and (nombre like '%$nomemp%' or a_paterno like '%$nomemp%' or a_materno like '%$nomemp%') order by puestos.id_ur asc,a_paterno asc,nombre asc";
				$con=4;
			}else{
				$sql =  "Select id_ramo,puestos.id_ur,ur,codigo_puesto,deno_puesto,f_ingr_sectur,f_ingr_apf,f_ingr_spc,f_baja,plantilla.id_baja,m_baja,
				rfc,curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
				from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
				left outer join persona on plantilla.id_empleado=persona.id_empleado 
				left outer join tcat_motivo_baja on plantilla.id_baja=tcat_motivo_baja.id_baja 
				left outer join tcat_ur on puestos.id_ur=tcat_ur.id_ur 
				where status=2 and (nombre like '%$nomemp%' or a_paterno like '%$nomemp%' or a_materno like '%$nomemp%') and deno_puesto like '%$nompto%' order by puestos.id_ur asc,a_paterno asc,nombre asc";
				$con=5;
			}
		}else{
			if(empty($nompto)){
				$sql =  "Select id_ramo,puestos.id_ur,ur,codigo_puesto,deno_puesto,f_ingr_sectur,f_ingr_apf,f_ingr_spc,f_baja,plantilla.id_baja,m_baja,
				rfc,curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
				from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
				left outer join persona on plantilla.id_empleado=persona.id_empleado 
				left outer join tcat_motivo_baja on plantilla.id_baja=tcat_motivo_baja.id_baja 
				left outer join tcat_ur on puestos.id_ur=tcat_ur.id_ur 
				where status=2 and (nombre like '%$nomemp%' or a_paterno like '%$nomemp%' or a_materno like '%$nomemp%') and id_ur order by puestos.id_ur asc,a_paterno asc,nombre asc";
				$con=6;
			}else{
				$sql =  "Select id_ramo,puestos.id_ur,ur,codigo_puesto,deno_puesto,f_ingr_sectur,f_ingr_apf,f_ingr_spc,f_baja,plantilla.id_baja,m_baja,
				rfc,curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
				from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
				left outer join persona on plantilla.id_empleado=persona.id_empleado 
				left outer join tcat_motivo_baja on plantilla.id_baja=tcat_motivo_baja.id_baja 
				left outer join tcat_ur on puestos.id_ur=tcat_ur.id_ur 
				where status=2 and (nombre like '%$nomemp%' or a_paterno like '%$nomemp%' or a_materno like '%$nomemp%') and id_ur='$ur' and deno_puesto like '%$nompto%' order by puestos.id_ur asc,a_paterno asc,nombre asc";
				$con=8;
			}
				
		}
		
	}
	echo $con;
		$resultado1= @ mysql_query ($sql);
				$con=1;
				if (!$resultado1)
				{
					exit ('error en la consulta');
					echo mysql_errno();
				}	
	
	
	$num_regis=mysql_num_rows($resultado1);
	if($num_regis==0){
		echo "NO SE ENCONTRARON CONCIDENCIAS";
	}else{
		
		$exportar=$sql;
		 echo "<td><form method='post' action='excel_plantilla_histo_bus.php '> \n
      <input type='hidden' name='nomemp' value='".$nomemp."'>
      <input type='hidden' name='nompto' value='".$nompto."'>
	   <input type='hidden' name='ur' value='".$ur."'>
	<input type='hidden' name='con' value='".$con."'>
      <input type='submit'  class='btn btn-default'  value='Exportar consulta a excel '> 
      </form></td></tr>";	  
    ?>
	<?php
	  echo $num_regis." registros";
	  ?>
	 <table align="center" class="table table-responsive  ">
    <tr>
	<td>RAMO1</td>
	<td>UR</td>
	<td>UNIDAD DE ADSCRIPCION</td>
	<td>CODIGO DE PUESTO</td>
	<td>DENOMINACION DE PUESTO</td>
	<td>FECHA DE INGRESO A SECTUR</td>
	<td>FECHA DE INGRESO A APF</td>
	<td>FECHA DE INGRESO A SPC</td>
	<td>FECHA DE BAJA</td>
	<td>MOTIVO DE BAJA</td>
	<td>RFC</td>
	<td>CURP</td>
	<td>NOMBRE</td>
	<td>APELLIDO PATERNO</td>
	<td>APELLIDO MATERNO</td>
	<td>NUM_EMP</td>
	</tr>
 
 <?php
while ($row=mysql_fetch_array ($resultado1))
{
	echo "<tr>";
	echo "<td>". $row["id_ramo"]. "</td>";
	echo "<td>". $row["id_ur"]. "</td>";
	echo "<td>". $row["ur"]. "</td>";
	echo "<td>". $row["codigo_puesto"]. "</td>";
	echo "<td>". $row["deno_puesto"]. "</td>";
	echo "<td>". $row["f_ingr_sectur"]. "</td>";
	echo "<td>". $row["f_ingr_apf"]. "</td>";
	echo "<td>". $row["f_ingr_spc"]. "</td>";
	echo "<td>". $row["f_baja"]. "</td>";
	echo "<td>". $row["m_baja"]. "</td>";
	echo "<td>". $row["rfc"]. "</td>";
	echo "<td>". $row["curp"]. "</td>";
	echo "<td>". $row["nombre"]. "</td>";
	echo "<td>". $row["a_paterno"]. "</td>";
	echo "<td>". $row["a_materno"]. "</td>";
	echo "<td>". $row["id_empleado"]. "</td><tr>";
}
   echo '</table>';
  
	
	   
	}		
	}
}
 mysql_close($conexion); ?>