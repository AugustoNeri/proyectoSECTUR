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
		$sql =  "Select id_usuario,puestos.id_ur,no_empleado,persona.nombre,a_paterno,a_materno,CONCAT(usuarios.Nombre,' ',usuarios.Apellido) as usuario,contrasena
		from usuarios left outer join persona on persona.id_empleado=usuarios.no_empleado 
		left outer join plantilla on persona.id_empleado=plantilla.id_empleado 
		left outer join puestos on plantilla.id_puesto=puestos.id_puesto";
	$resultado1= @ mysql_query ($sql);
	if (!$resultado1)
	{
	 exit ('error en la consulta');
	 echo mysql_errno();
    }
    ?>
    <HTML>
    <BODY>
    <h3><center>Lista de empleados registrados al sistema</h3>
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
	 <input type='hidden' name='bus_empleado_sis' value='".$row["no_empleado"]."'></input>
      <input class="btn btn-primary pull-right" type='submit' value='BUSCAR'> </input>

	  </dIV>
	  </div>
	</form>
	  <input type="submit" value="REGISTRAR PERSONA AL SISTEMA" onclick = "location='crear.php'" class='btn btn-default'/>
    <table class="table table-striped" align="center">
    <tr>
		<td><h3></h3></td>
	<td><h3>ID</h3></td>
	<td><h3>UR</h3></td>
	<td><h3>NO EMPLEADO</h3></td>
    <td><h3>NOMBRE</h3></td>
	<td><h3>A_PATERNO</h3></td>
	<td><h3>A_MATERNO</h3></td>
	<td><h3>USUARIO</h3></td>
	<td><h3>PASSWORD</h3></td>
	</tr>


 <?php
while ($row=mysql_fetch_array ($resultado1))
{
echo "<tr>";
	  echo "<td><form method='post' action=''> \n
      <input type='hidden' name='mo_empleado' value='".$row["id_usuario"]."'>
      <input class='btn btn-primary' type='submit' value='Modificar'> 
      </form></td>";	  
echo "<td>". $row["id_usuario"]. "</td>";
echo "<td>". $row["id_ur"]. "</td>";
echo "<td>". $row["no_empleado"]. "</td>";
echo "<td>". $row["nombre"]. "</td>";
echo "<td>". $row["a_paterno"]. "</td>";
echo "<td>". $row["a_materno"]. "</td>";
echo "<td>". $row["usuario"]. "</td>";
echo "<td>". $row["contrasena"]. "</td>";
}
   echo '</table>';
    echo '
    </body>
    </html>';

}else{
	
	if(isset($_POST["bus_empleado_sis"])){
		$nom=$_POST["nombre"];
		$ur=$_POST["combo2"]
		?>
		
  <HTML>
    <BODY>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <h2><center>Lista de empleados</h2>
	<h3><a href="c_persona.php" target=main>Mostrar todos los registros</h3></A>
	
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
	 <input type='hidden' name='bus_empleado' value='".$row["id_empleado"]."'>
      <input class="btn btn-primary pull-right" type='submit' value='BUSCAR'>
	  </dIV>
	  </div>
	</form>
	
	<?php
	if(empty($nom)){
			$sql =  "Select id_usuario,puestos.id_ur,no_empleado,persona.nombre,a_paterno,a_materno,CONCAT(usuarios.Nombre,' ',usuarios.Apellido) as usuario,contrasena
		from usuarios left outer join persona on persona.id_empleado=usuarios.no_empleado 
		left outer join plantilla on persona.id_empleado=plantilla.id_empleado 
		left outer join puestos on plantilla.id_puesto=puestos.id_puesto
			where id_ur= '$ur' order by a_paterno asc, a_paterno asc, a_materno asc";
			$resultado1= @ mysql_query ($sql);
			$con=1;
			if (!$resultado1)
			{
				exit ('error en la consulta');
				echo mysql_errno();
			}
	}else{
		if($ur==0){
			$sql =  "Select id_usuario,puestos.id_ur,no_empleado,persona.nombre,a_paterno,a_materno,CONCAT(usuarios.Nombre,' ',usuarios.Apellido) as usuario,contrasena
		from usuarios left outer join persona on persona.id_empleado=usuarios.no_empleado 
		left outer join plantilla on persona.id_empleado=plantilla.id_empleado 
		left outer join puestos on plantilla.id_puesto=puestos.id_puesto
			where nombre like '%$nom%' or a_paterno like '%$nom%' or a_materno  like '%$nom' order by a_paterno asc, a_paterno asc, a_materno asc";
			$resultado1= @ mysql_query ($sql);
			$con=2;
			if (!$resultado1)
			{
				exit ('error en la consulta');
				echo mysql_errno();
			}
		}else{
			$sql =  " Select id_usuario,puestos.id_ur,no_empleado,persona.nombre,a_paterno,a_materno,CONCAT(usuarios.Nombre,' ',usuarios.Apellido) as usuario,contrasena
		from usuarios left outer join persona on persona.id_empleado=usuarios.no_empleado 
		left outer join plantilla on persona.id_empleado=plantilla.id_empleado 
		left outer join puestos on plantilla.id_puesto=puestos.id_puesto
			where (nombre like '%$nom%' or a_paterno like '%$nom%' or a_materno  like '%$nom%') and id_ur='$ur' order by a_paterno asc, a_paterno asc, a_materno asc";
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
		
		$exportar=$sql;
		 echo "<form method='post' action='excel_persona_con.php' class='form-horizontal' role='form'> \n
      <input type='hidden' name='nom' value='".$nom."'>
	   <input type='hidden' name='ur' value='".$ur."'>
	<input type='hidden' name='con' value='".$con."'>
      <input type='submit' class='btn btn-default' value='Exportar consulta a excel '> 
      </form>";	  
    ?>
	<table class="table table-striped" align="center">
	<tr>
   	<td><h3></h3></td>
	<td><h3>ID</h3></td>
	<td><h3>UR</h3></td>
	<td><h3>NO EMPLEADO</h3></td>
    <td><h3>NOMBRE</h3></td>
	<td><h3>A_PATERNO</h3></td>
	<td><h3>A_MATERNO</h3></td>
	<td><h3>USUARIO</h3></td>
	<td><h3>PASSWORD</h3></td>
	</tr>
		<?php
	while ($row=mysql_fetch_array ($resultado1))
{
echo "<tr>";
	  echo "<td><form method='post' action=''> \n
      <input type='hidden' name='mo_empleado' value='".$row["id_usuario"]."'>
      <input class='btn btn-primary' type='submit' value='Cambiar o modificar usuario'> 
      </form></td>";	  
echo "<td>". $row["id_usuario"]. "</td>";
echo "<td>". $row["id_ur"]. "</td>";
echo "<td>". $row["id_empleado"]. "</td>";
echo "<td>". $row["nombre"]. "</td>";
echo "<td>". $row["a_paterno"]. "</td>";
echo "<td>". $row["a_materno"]. "</td>";

echo "<td>". $row["usuario"]. "</td>";
echo "<td>". $row["contrasena"]. "</td>";

}
   echo '</table>';
	
	   
	}		
	}	
	if (isset($_POST["mo_empleado"])){
		$id_u= $_POST["mo_empleado"];
		$sql = "SELECT id_usuario,no_empleado,Nombre,Apellido,contrasena FROM usuarios WHERE id_usuario='".$id_u."'";

		$registro1 = @mysql_query($sql);
		if(!$registro1){
			echo "Error ".mysql_errno();
			exit('<p>No se pudo obtener los detalles del registro.</p>');
		}
		$registro = mysql_fetch_array($registro1);
		//echo "titulo=".$registro['Titulo'];
		?>

		<html>
    <head> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <title>Actualizar datos del empleado</title>
    </head>
    	<body>
		<center>
		<h3>Actualizar datos del usuario </h3>
			<div class="bottom-buffer">
				<form role="form" class="clearfix"  method="post" onsubmit="return confirmarContrasena()" >
					 <div class="row">
					 <div class="col-md-4">
						  <div class="form-group">
							<label for="deno_puesto">Numero de empleado<span class="form-text">*</span>:</label>
							<input type="text" name="id_empleado" id="id_empleado" class="form-control" value="<?php echo $registro['no_empleado'];?>" required>
						  </div>
						</div>
							<div class="col-md-4">
						  <div class="form-group">
							<label for="deno_puesto">Nombre<span class="form-text">*</span>:</label>
							<input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $registro['Nombre'];?>" required>
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="cod_puesot">Apellido<span class="form-text">*</span>:</label>
							<input type="text" name="apellido" id="apellido" class="form-control"  value="<?php echo $registro['Apellido'];?>" required>
						  </div>
						</div>						
					 </div>
					 <div class="row">
						<div class="col-md-4">
						  <div class="form-group">
							<label for="deno_puesto">CONTRASENA<span class="form-text">*</span>:</label>
							<input type="password" name="contrasena" id="contrasena" class="form-control" value="<?php echo $registro['contrasena'];?>" maxlength="8" required>
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="cod_puesot">CONFIRMAR CONTRASENA<span class="form-text">*</span>:</label>
							<input type="password" name="confirmcontra" id="confirmcontra" class="form-control" maxdlength="8" required>
						  </div>
						</div>
						
					</div>
					
					
				  
							
				<div class="clearfix">
                <div class="pull-left text-muted text-vertical-align-button">
                  
                </div>

                <div class="pull-right">
						<input type="hidden" align="LEFT" name="mod_emp" value="<?php echo $registro['id_usuario'];?>" /><p></td>
						<input type="submit" value="ACTUALIZAR" class="btn btn-primary pull-right" name="actualizar">
                </div>
              </div>
					
					
					
				</form>
				<script type="text/javascript">
				function confirmarContrasena(){
					var txtcon = document.getElementById('contrasena').value;
					var txtconfir = document.getElementById('confirmcontra').value;
					
					if(txtcon != txtconfir){
						alert('ERROR: Las contraseñas no coinciden');
						return false;
					}
					return true;
				}
				</script>
			</div>
		
		</center>
		</body>
		</html>
		<?PHP
	
	}
	if(isset($_POST['mod_emp'])){
		?>
		<html>
    	<head> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <title>Listas de personas</title>
    </head>
    	<body>

		<?php
		$sql="UPDATE usuarios SET
		no_empleado='".$_POST['id_empleado']."',
		Nombre='".$_POST['nombre']."',
		Apellido='".$_POST['apellido']."',
		contrasena='".$_POST['contrasena']."'
		WHERE id_usuario='".$_POST['mod_emp']."'";

		if(@mysql_query($sql)){   
			
			?>
			<div class="alert alert-success">Datos actualizados correctamente</div>
			<?php
		}
		else{
			
			?>
			<div class="alert alert-danger">No se pudieron actualizar correctamente los datos</div>
			<div class="btn-group" role="group" aria-label="...">
	   <input type="submit" value="SIGUIENTE" onclick = "location='c_persona_sistema.php'" class='btn btn-default'/>
			<?php
			
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