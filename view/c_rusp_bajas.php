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
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    </head>
    <body>
	

	</body>
	</html>

<?php


 	echo "<br>";
 	$sql =  "Select noplauni,filiacion,id_ramo,id_ur,f_baja,id_baja,rfc,
	curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
	from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
						left outer join persona on plantilla.id_empleado=persona.id_empleado where status=2";
	$resultado1= @ mysql_query ($sql);
	$num_regis=mysql_num_rows($resultado1);
	if (!$resultado1)
	{
	 exit ('error en la consulta');
	
    }
    ?>
    <HTML>
    <BODY>
	  <h2><center>RUSP_BAJAS</h2>
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
			<label class="col-sm-3 control-label" for="email-03">Nombre:</label>
			<div class="col-sm-8">
			<input class="form-control" id="nombre" placeholder="" type="text" name="nombre">
			</div>
		</div>
	<div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">
	 <input type='hidden' name='bus_rusp_bajas' value='".$row["id_empleado"]."'></input>
      <input class="btn btn-primary pull-right" type='submit' value='BUSCAR'> </input>

	  </dIV>
	  </div>
	</form>
	<form method='' action='excel_rusp_bajas.php' class='form-horizontal' role='form'> 
	 <input type='hidden' name='rusp_bajas' value='".$row["id_empleado"]."'></input>
      <input type='submit' class='btn btn-default' value='Exportar tabla a excel '> 
      </form>
	  <?php
	   echo $num_regis." registros";
	  ?>	
 <table align="center" class="table table-striped">
    <tr>
	<td>NOPLA_UNI||NOPLA_PUESTO||NOPLA_PLAZA</td>
	<td>FILIACION</td>	
    <td>RAMO1</td>
	<td>UNIDAD2</td>
	<td>FECHA BAJA</td>
	<td>MOTIVO</td>
	<td>RFC_19</td>
	<td>CURP20</td>
	<td>NOMBRES21</td>
	<td>APE_PAT22</td>
	<td>APE_MAT23</td>
	<td>NUM_EMP37</td>
	</tr>
 
 <?php
while ($row=mysql_fetch_array ($resultado1))
{
	  echo "<tr>";
	echo "<td>". $row["noplauni"]. "</td>";
	echo "<td>". $row["filiacion"]. "</td>";
	echo "<td>". $row["id_ramo"]. "</td>";
	echo "<td>". $row["id_ur"]. "</td>";
	echo "<td>". $row["f_baja"]. "</td>";
	echo "<td>". $row["id_baja"]. "</td>";
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
		if(isset($_POST["bus_rusp_bajas"])){
			
		$nom=$_POST["nombre"];
		$ur=$_POST["combo2"]
		?>
		<HTML>
    <BODY>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <h2><center>Lista de empleados</h2>
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
			<label class="col-sm-3 control-label" for="email-03">Nombre:</label>
			<div class="col-sm-8">
			<input class="form-control" id="nombre" placeholder="" type="text" name="nombre">
			</div>
		</div>
	<div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">
	 <input type='hidden' name='bus_rusp_bajas' value='".$row["id_empleado"]."'></input>
      <input class="btn btn-primary pull-right" type='submit' value='BUSCAR'> </input>

	  </dIV>
	  </div>
	</form>
	
	<?php
	if(empty($nom)){
	
				$sql =  "Select noplauni,filiacion,id_ramo,id_ur,f_baja,id_baja,rfc,
	curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
	from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
						left outer join persona on plantilla.id_empleado=persona.id_empleado where id_baja> 0 and status=2 and id_ur='$ur'";
				$resultado1= @ mysql_query ($sql);
			$con=1;
			if (!$resultado1)
			{
				exit ('error en la consulta');
				echo mysql_errno();
			}
	}else{
		if($ur==0){
						$sql =  "Select noplauni,filiacion,id_ramo,id_ur,f_baja,id_baja,rfc,
	curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
	from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
						left outer join persona on plantilla.id_empleado=persona.id_empleado
						where id_baja> 0 and status=2 and (nombre like '%$nom%' or a_paterno like '%$nom%' or a_materno  like '%$nom') order by a_paterno asc";
			$resultado1= @ mysql_query ($sql);
			$con=2;
			if (!$resultado1)
			{
				exit ('error en la consulta');
				echo mysql_errno();
			}
		}else{
				$sql =  "Select noplauni,filiacion,id_ramo,id_ur,f_baja,id_baja,rfc,curp, nombre,a_paterno, a_materno, plantilla.id_empleado 
					from puestos left outer join plantilla on plantilla.id_puesto=puestos.id_puesto 
						left outer join persona on plantilla.id_empleado=persona.id_empleado 
						where id_baja> 0 and status=2 and (nombre like '%$nom%' or a_paterno like '%$nom%' or a_materno  like '%$nom%') and id_ur='$ur' order by a_paterno asc";
			$resultado1= @ mysql_query ($sql);
			$con=3;
			if (!$resultado1)
			{
				exit ('error en la consulta');
				echo mysql_errno();
			}
		}
	}
	
	$num_regis=mysql_num_rows($resultado1);
	if($num_regis==0){
		echo "NO SE ENCONTRARON CONCIDENCIAS";
	}else{
		
		
		 echo "<td><form method='post' action='excel_rusp_bajas_bus.php '> \n
      <input type='hidden' name='nom' value='".$nom."'>
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
	<td>NOPLA_UNI||NOPLA_PUESTO||NOPLA_PLAZA</td>
	<td>FILIACION</td>	
    <td>RAMO1</td>
	<td>UNIDAD2</td>
	<td>FECHA BAJA</td>
	<td>MOTIVO</td>
	<td>RFC_19</td>
	<td>CURP20</td>
	<td>NOMBRES21</td>
	<td>APE_PAT22</td>
	<td>APE_MAT23</td>
	<td>NUM_EMP37</td>
	

	</tr>
 
 <?php
while ($row=mysql_fetch_array ($resultado1))
{

	  echo "<tr>";
echo "<td>". $row["noplauni"]. "</td>";
echo "<td>". $row["filiacion"]. "</td>";
echo "<td>". $row["id_ramo"]. "</td>";
echo "<td>". $row["id_ur"]. "</td>";
echo "<td>". $row["f_baja"]. "</td>";
echo "<td>". $row["id_baja"]. "</td>";
echo "<td>". $row["rfc"]. "</td>";
echo "<td>". $row["curp"]. "</td>";
echo "<td>". $row["nombre"]. "</td>";
echo "<td>". $row["a_paterno"]. "</td>";
echo "<td>". $row["a_materno"]. "</td>";
echo "<td>". $row["id_empleado"]. "</td><tr>";
}
   echo '</table>';
   echo '</table>';
	
	   
	}		
	}
	
	
	if (isset($_POST["mo_rusp_bajas"])){
		$id_emp= $_POST["mo_rusp_bajas"];
		$sql = "SELECT fecha_personal.id_empleado,nombre,a_paterno,a_materno,f_baja,id_baja		
					from plantilla left join puestos on plantilla.id_puesto=puestos.id_puesto 
					left join persona on plantilla.id_empleado=persona.id_empleado WHERE plantilla.id_empleado='".$id_emp."'";

		$registro = @mysql_query($sql);
		if(!$registro){
			echo "Error ".mysql_errno();
			exit('<p>No se pudo obtener los detalles del registro.</p>');
		}
		$registro = mysql_fetch_array($registro);
		//echo "titulo=".$registro['Titulo'];
		?>
		
		<?php
	}
	
		if(isset($_POST['id_empf'])){
		?>
		<html>
    	<head><title>Resultado de UPDATE</title></head>
    	<body>

		<?php
		$sql="UPDATE plantilla SET
		f_baja='".$_POST['fecha_baja']."',
		id_baja='".$_POST['combo1']."'
		WHERE id_empleado='".$_POST['id_emp']."'";

		if(@mysql_query($sql)){   
			echo '<script>alert("Registro Actualizado.");</script>';
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
 mysql_close($conexion); ?>