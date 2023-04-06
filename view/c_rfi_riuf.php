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
   
if (!$_POST && !isset($borrar1))
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
 	$sql =  "Select id_rfi_riuf,clv_rfi_riuf,id_ur,institucion,id_ef,entidad,id_md,muni_del,colonia,vialidad,
	no_exterior,no_interior,uso_nombre,codigoPostal
	from rfi_riuf left join tcat_municipios on rfi_riuf.id_municipio=tcat_municipios.id_md
				  left join tcat_entidades_federativas on tcat_municipios.id_entpais=tcat_entidades_federativas.id_ef";
				  /* 	$sql =  "Select * from rfi_riuf"; */
	$resultado1= @ mysql_query ($sql);
	if (!$resultado1)
	{
	 exit ('error en la consulta');
    }
    ?>
    <HTML>
    <BODY>
    <h2><center>Catálogo de RFI_RIUF</h2>
    <table class="table table-striped" align="center">
    <tr>
	<td><h3>ID</h3></td>
	<td><h3>CLAVE_RFI_RIUF</h3></td>
    <td><h3>ID_UR</h3></td>
	<td><h3>INSTITUCION</h3></td>
	<td><h3>ID EDO</h3></td>
	<td><h3>ESTADO</h3></td>
	<td><h3>ID MUNI</h3></td>
	<td><h3>MUNICIPIO</h3></td>
	<td><h3>COLONIA</h3></td>
	<td><h3>VIALIDAD</h3></td>
	<td><h3>NO.EXTERIOR</h3></td>
	<td><h3>NO.INTERIOR</h3></td>
	<td><h3>USO_NOMBRE</h3></td>
	<td><h3>CODIGO POSTAL</h3></td>
	</tr>


 <?php
while ($row=mysql_fetch_array ($resultado1))
{
echo "<tr><td>". $row["id_rfi_riuf"]. "</td>";
echo "<td>". $row["clv_rfi_riuf"]. "</td>";
echo "<td>". $row["id_ur"]. "</td>";
echo "<td>". $row["institucion"]. "</td>";
echo "<td>". $row["id_ef"]. "</td>";
echo "<td>". $row["entidad"]. "</td>";
echo "<td>". $row["id_md"]. "</td>";
echo "<td>". $row["muni_del"]. "</td>";
echo "<td>". $row["colonia"]. "</td>";
echo "<td>". $row["vialidad"]. "</td>";
echo "<td>". $row["no_exterior"]. "</td>";
echo "<td>". $row["no_interior"]. "</td>";
echo "<td>". $row["uso_nombre"]. "</td>";
echo "<td>". $row["codigoPostal"]. "</td>";
if($_SESSION['id']==5){
	echo "<td><form method='post' action=''> \n
      <input type='hidden' name='id_rfi_riuf' value='".$row["id_rfi_riuf"]."'>
      <input type='submit' value='Eliminar'>
      </form></td>";
	
}

echo "<td><form method='post' action=''> \n
      <input type='hidden' name='mo_rfi_riuf' value='".$row["id_rfi_riuf"]."'>
      <input type='submit' value='modificar'> 
      </form></td></tr>";	  
}

 echo '</table>';
    echo '
    </body>
    </html>';
}
else{
	if (isset($_POST["id_rfi_riuf"])){
		$id_rfi= $_POST["id_rfi_riuf"];

		//echo "borrar".$borrar;
		$sql="DELETE FROM rfi_riuf WHERE id_rfi_riuf =$id_rfi";
		//echo "sql=".$sql;
		$registro = @mysql_query($sql);
		if(!$registro){
			echo mysql_errno();
			?>
			<html>
			 <head> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <title>Listas de personas</title>
    </head>
			<body>
			<div class="alert alert-success">Error al eliminar registro</div>

			</body>
			</html>
			<?php
		}
		else{
		 	?>
			<html>
			 <head> 
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <title>Listas de personas</title>
    </head>
			<body>
			<div class="alert alert-danger">Los datos se eliminaron con exito</div>
			</body>
			</html>
			<?php
		}
	}
	if (isset($_POST["mo_rfi_riuf"])){
		$id_rfi= $_POST["mo_rfi_riuf"];
	$sql = "SELECT * FROM RFI_RIUF WHERE id_rfi_riuf=".$id_rfi;

	$registro = @mysql_query($sql);
	if(!$registro){
		echo "Error ".mysql_errno();
		exit('<p>No se pudo obtener los detalles del registro.</p>');
	}
	$registro = mysql_fetch_array($registro);
	//echo "titulo=".$registro['Titulo'];
	?>

	<html>
    	<head><title>Actualizar Datos</title></head>
    	<body>
	<h1><div align="center">Editando Datos</div></h1>

	<div align="center">
	<form  method="post" >
	<p><font size=5>ID_RFI_RIUF:
	<input type="hidden" align="LEFT" name="id_rfi" value="<?php echo $registro['id_rfi_riuf'];?>" /><p>
	<p><font  size=5>CLV_RFI_RIUF:
	<input type="text" align="LEFT" name="cl_rfi" value="<?php echo $registro['clv_rfi_riuf'];?>"/><p>
	<p><font  size=5>institucion:
	<input type="text" align="LEFT" name="insti" value="<?php echo $registro['institucion'];?>"/><p>	
	<?php
	echo "<font>ID DE UR";
	$con2="SELECT id_ur FROM tcat_ur";
	$res2=@mysql_query($con2);
	if(!$res2){
		echo " fallo";
	}
	else{
		
		echo "<td><select name='combo1' >";
		
		while ($fila2=mysql_fetch_array($res2)){
			echo "<option value=".$fila2['id_ur'].">".$fila2['id_ur']." </option>";
		}
		echo "</select>";
	}
	
	?>	
	<?php
	echo "<font>ID DE MUNICIPIO";
	$con3="SELECT id_md,entidad,muni_del FROM tcat_municipios left join tcat_entidades_federativas on tcat_municipios.id_entpais=tcat_entidades_federativas.id_ef";
	$res3=@mysql_query($con3);
	if(!$res3){
		echo " fallo";
	}
	else{
		echo "<td><select name='combo2' >";
		
		while ($fila3=mysql_fetch_array($res3)){
			echo "<option value=".$fila3['id_md'].">", $fila3['id_md']." ".$fila3['entidad']." ".$fila3['muni_del']," </option>";
		}
		echo "</select>";
	}
	
		?>		
	<p><font  size=5>Colonia:
	<input type="text" align="LEFT" name="col" value="<?php echo $registro['colonia'];?>"/><p>	
	<p><font  size=5>Vialidad:
	<input type="text" align="LEFT" name="via" value="<?php echo $registro['vialidad'];?>"/><p>	
	<p><font  size=5>No. Exterior:
	<input type="text" align="LEFT" name="noext" value="<?php echo $registro['no_exterior'];?>"/><p>	
	<p><font  size=5>No. interior:
	<input type="text" align="LEFT" name="noint" value="<?php echo $registro['no_interior'];?>"/><p>
	<p><font  size=5>Uso_nombre:
	<input type="text" align="LEFT" name="uso_nom" value="<?php echo $registro['uso_nombre'];?>"/><p>
	<p><font  size=5>Codigo Postal:
	<input type="text" align="LEFT" name="cp" value="<?php echo $registro['codigoPostal'];?>"/><p>
	
	<input type="submit" value="ACTUALIZAR" name="actualizar">
	</form></div>
	

	</body>
	</html>
<?PHP
	
	}
	if(isset($_POST['id_rfi'])){
	?>
	<html>
    	<head><title>Resultado de UPDATE</title></head>
    	<body>

 	<?php


		$sql="UPDATE rfi_riuf SET
		clv_rfi_riuf='".$_POST['cl_rfi']."',
		institucion='$".$_POST['insti']."',
		id_ur='".$_POST['combo1']."',
		id_municipio='".$_POST['combo2']."',
		colonia='".$_POST['col']."',
		vialidad='".$_POST['via']."',
		no_exterior='".$_POST['noext']."',
		no_interior='".$_POST['noint']."',
		uso_nombre='".$_POST['uso_nom']."',
		codigoPostal='".$_POST['cp']."'
		WHERE id_rfi_riuf='".$_POST['id_rfi']."'";

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
}
 mysql_close($conexion); ?>