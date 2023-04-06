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
    <title>Listas de personas</title>
    </head>
    <body>

	</body>
	</html>

<?php


 	echo "<br>";
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
				 left outer join tcat_instituciones_ss on id_institucion=persona.id_institucion_ss where status=1 order by id_ur asc, a_paterno asc, a_materno asc";
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
    <h3><center>Lista de empleados</h3>
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
	 <input type='hidden'  value='".$row["id_empleado"]."'></input>
      <input class="btn btn-primary pull-right"name='bus_empleado' type='submit' value='BUSCAR'> </input>

	  </dIV>
	  </div>
	</form>
	<center>
	 <div class="btn-group" role="group" aria-label="...">
	 <?php
	 if($_SESSION["id"]==1 or $_SESSION["id"]==4){
	?>
		<input type="submit" value="Dar de alta nueva persona" onclick = "location='a_persona.php'" class='btn btn-default'/>
		  <input type="submit" value="Ver lista de personas integradas al sistema " onclick = "location='c_persona_sistema.php'" class='btn btn-default'/>
	<?php
	}
	?>
	  <input type='submit' class='btn btn-default' onclick="location='excel_persona.php'" value='Exportar tabla a excel '> 
		</div>	
	  </center>
		<br><br>
		<?php
	  echo $numrow." registros";
	  ?>
    <table class="table table-striped" align="center">
    <tr>
	 <?php
	 if($_SESSION["id"]==1 or $_SESSION["id"]==4){
	?>
	<td><h3></h3></td>
	<td><h3></h3></td>
	
	 <?php
	 }
	?>
	<td><h5>UR</h5></td>
	<td><h5>NO_EMPLEADO</h5></td>
    <td><h5>NOMBRE</h5></td>
	<td><h5>A_PATERNO</h5></td>
	<td><h5>A_MATERNO</h5></td>
	<td><h5>CURP</h5></td>
	<td><h5>RFC</h5></td>
	<td><h5>SEXO</h5></td>
	<td><h5>FECHA_DE_NACIMIENTO</h5></td>
	<td><h5>ENTIDAD_NAC</h5></td>
	<td><h5>PAIS-NAC</h5></td>
	<td><h5>CORREO ELECTRONICO</h5></td>
	<td><h5>NO.SEGURO_SOCIAL</h5></td>
	<td><h5>ESTADO_ECONYUGAL</h5></td>
	<td><h5>TIPO_DISCAPACIDAD</h5></td>
	<td><h5>NIVEL_ESCOLARIDAD</h5></td>
	<td><h5>ESTATUS_ESCOLARIDAD</h5></td>
	<td><h5>INSTITUCION_SS</h5></td>
	<td><h5>PLAZA</h5></td>
	</tr>


 <?php

 
while ($row=mysql_fetch_array ($resultado1))
{
	echo "<tr>";
	if($_SESSION["id"]==1 or $_SESSION["id"]==4){
		if($row["status"] == 2){
				echo "<td><button class='btn btn-danger disabled' type='button'>Dar de baja</button>
		</td>";
		}else{
			
			echo "<td><form method='post' action=''> \n
			  <input type='hidden' name='eli_empleado' value='".$row["id_empleado"]."'>
			  <input class='btn btn-danger' type='submit' value='Dar de baja'>
			  </form></td>";
			
		}
	
	  echo "<td><form method='post' action=''>
      <input type='hidden' name='mo_empleado' value='".$row["id_empleado"]."'>
      <input class='btn btn-primary' type='submit' value='Modificar'> 
      </form></td>";	  
}
echo "<td>". $row["id_ur"]. "</td>";
echo "<td>". $row["id_empleado"]. "</td>";
echo "<td>". $row["nombre"]. "</td>";
echo "<td>". $row["a_paterno"]. "</td>";
echo "<td>". $row["a_materno"]. "</td>";
echo "<td>". $row["curp"]. "</td>";
echo "<td>". $row["rfc"]. "</td>";
echo "<td>". $row["sexo"]. "</td>";
echo "<td>". $row["f_nac"]. "</td>";
echo "<td>". $row["entidad"]. "</td>";
echo "<td>". $row["pais"]. "</td>";
echo "<td>". $row["correo_electronico"]. "</td>";
echo "<td>". $row["no_ss"]. "</td>";
echo "<td>". $row["e_conyugal"]. "</td>";
echo "<td>". $row["t_discapacidad"]. "</td>";
echo "<td>". $row["nive_e"]. "</td>";
echo "<td>". $row["estatus_e"]. "</td>";
echo "<td>". $row["institucion_ss"]. "</td>";
echo "<td>". $row["PLAZA"]. "</td></tr>";



}
   echo '</table>';
    echo '
    </body>
    </html>';

}else{
	
	if(isset($_POST["bus_empleado"])){
		$nom=$_POST["nombre"];
		$ur=$_POST["combo2"]
		?>
		
  <HTML>
    <BODY>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    <h2><center>Lista de empleados</h2>

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
			$resultado1= @ mysql_query ($sql);
			$con=1;
			if (!$resultado1)
			{
				exit ('error en la consulta');
				echo mysql_errno();
			}
	}else{
		if($ur==0){
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
			$resultado1= @ mysql_query ($sql);
			$con=2;
			if (!$resultado1)
			{
				exit ('error en la consulta');
				echo mysql_errno();
			}
		}else{
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
	 <center>
	  <div class="btn-group" role="group" aria-label="...">
		  <?php
	 if($_SESSION["id"]==1 or $_SESSION["id"]==4){
	?>
	   <input type="submit" value="Dar de alta nueva persona" onclick = "location='a_persona.php'" class='btn btn-default'/>
	   <?php
	}
	?>
	  <?php
	 if($_SESSION["id"]==1 or $_SESSION["id"]==4){
	?>
	   <input type="submit" value="Ver lista de personas integradas al sistema " onclick = "location='c_persona_sistema.php'" class='btn btn-default'/>
	    <?php
	}
	?>
	   <input type="submit" value="Ver todos los registros" onclick = "location='c_persona.php'" class='btn btn-default'/>
		  </div>
	  </center>
	  <br><br>
	<?php
	  echo $num_regis." registros";
	  ?>
	  
	<table class="table table-striped" align="center">
	<tr>
    <?php
	 if($_SESSION["id"]==1 or $_SESSION["id"]==4){
	?>
	<td><h3></h3></td>
	<td><h3></h3></td>
	
	 <?php
	 }
	?>
	<td><h5>UR</h5></td>
	<td><h5>NO_EMPLEADO</h5></td>
    <td><h5>NOMBRE</h5></td>
	<td><h5>A_PATERNO</h5></td>
	<td><h5>A_MATERNO</h5></td>
	<td><h5>CURP</h5></td>
	<td><h5>RFC</h5></td>
	<td><h5>ID_SEXO</h5></td>
	<td><h5>FECHA_DE_NACIMIENTO</h5></td>
	<td><h5>ENTIDAD_NAC</h5></td>
	<td><h5>PAIS-NAC</h5></td>
	<td><h5>CORREO ELECTRONICO</h5></td>
	<td><h5>NO.SEGURO_SOCIAL</h5></td>
	<td><h5>ESTADO_ECONYUGAL</h5></td>
	<td><h5>TIPO_DISCAPACIDAD</h5></td>
	<td><h5>NIVEL_ESCOLARIDAD</h5></td>
	<td><h5>ESTATUS_ESCOLARIDAD</h5></td>
	<td><h5>INSTITUCION_SS</h5></td>
	<td><h5>PLAZA</h5></td>
	</tr>
		<?php
	while ($row=mysql_fetch_array ($resultado1))
{
	echo "<tr>";
	if($_SESSION["id"]==1 or $_SESSION["id"]==4){
		if($row["status"] == 2){
				echo "<td><button class='btn btn-danger disabled' type='button'>Dar de baja</button>
		</td>";
		}else{
			
			echo "<td><form method='post' action=''> \n
			  <input type='hidden' name='eli_empleado' value='".$row["id_empleado"]."'>
			  <input class='btn btn-danger' type='submit' value='Dar de baja'>
			  </form></td>";
			
		}
	
	  echo "<td><form method='post' action=''>
      <input type='hidden' name='mo_empleado' value='".$row["id_empleado"]."'>
      <input class='btn btn-primary' type='submit' value='Modificar'> 
      </form></td>";	  
}

echo "<td>". $row["id_ur"]. "</td>";
echo "<td>". $row["id_empleado"]. "</td>";
echo "<td>". $row["nombre"]. "</td>";
echo "<td>". $row["a_paterno"]. "</td>";
echo "<td>". $row["a_materno"]. "</td>";
echo "<td>". $row["curp"]. "</td>";
echo "<td>". $row["rfc"]. "</td>";
echo "<td>". $row["sexo"]. "</td>";
echo "<td>". $row["f_nac"]. "</td>";
echo "<td>". $row["entidad"]. "</td>";
echo "<td>". $row["pais"]. "</td>";
echo "<td>". $row["correo_electronico"]. "</td>";
echo "<td>". $row["no_ss"]. "</td>";
echo "<td>". $row["e_conyugal"]. "</td>";
echo "<td>". $row["t_discapacidad"]. "</td>";
echo "<td>". $row["nive_e"]. "</td>";
echo "<td>". $row["estatus_e"]. "</td>";
echo "<td>". $row["institucion_ss"]. "</td>";
echo "<td>". $row["PLAZA"]. "</td></tr>";


}
   echo '</table>';
	
	   
	}		
	}
	
	if (isset($_POST["eli_empleado"])){
		
		$id_emp= $_POST["eli_empleado"];
		$sql="Select status from persona where persona.id_empleado='".$id_emp."'";
		$consulta= @mysql_query($sql);

		if(!$consulta){
			echo "Error ".mysql_errno();
			exit('<p>No se pudo obtener los detalles del registro.</p>');
		}
		$con=mysql_fetch_array($consulta);
		
			echo "La persona ya esta dada de baja";
			
		
			$sql="Select persona.nombre,a_paterno,a_materno from persona where id_empleado=$id_emp";
			$registro= @mysql_query($sql);
			if(!$registro){
				echo "Error ".mysql_errno();
				exit('<p>No se pudo obtener los detalles del registro.</p>');
			}
			$row = mysql_fetch_array($registro);
			//echo "titulo=".$registro['Titulo'];
			?>
			<html>
			<head><title>PROCESO DE BAJA</title>
				<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
				</head>
			<body>
			<FORM NAME="buttonbar">
				<INPUT TYPE="button" VALUE="Volver" onClick="history.back()">
			 </FORM>
			<h4><div align="center">Esta dando de baja a <?php echo $row['a_paterno']." ".$row['a_materno']." ".$row['nombre'];?></div></h4>
			>
			<form  align=center method="post"  role="form" class="form-horizontal"  onsubmit="return confirmation()">>
				<div class="row">
					<div class="col-md-4">
					</div>
					<div class="col-md-4">
									<div class="form-group clearfix">
										<div class="form-control-lada">
										  <label for="lada">Dia<span class="form-text">*</span>:</label>
										 <select name="dia"class='form-control'>
										<?php
										
										for($i=1;$i<=31;$i++){
											echo '<option value="'.$i.'">'.$i."</option>";
											
										}?>	 
										</select>
										</div>
									<div class="form-control-lada">
									  <label for="phone">Mes<span class="form-text">*</span>:</label>
										<select name="mes"class='form-control'>
										<option value="01"   >Enero</option>
										<option value="02"   >Febrero</option>
										<option value="03"   >Marzo</option>
										<option value="04"   >Abril</option>
										<option value="05"   >Mayo</option>
										<option value="06"   >Junio</option>
										<option value="07"   >Julio</option>
										<option value="08"   >Agosto</option>
										<option value="09"   >Septiembre</option>
										<option value="10"   >Octubre</option>
										<option value="11"   >Noviembre</option>
										<option value="12"   >Diciembre</option>
									</select>
									</div>
									<div class="form-control-lada">
										<label for="phone">Año<span class="form-text">*</span>:</label>
										<select name="anio"class='form-control'>
										<?php
										$year=date("Y");
										for($i=1960;$i<=$year;$i++){
											echo '<option value="'.$i.'">'.$i."</option>";
											
										}?>	 
										</select>
									</div>
									</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
					</div>
					<div class="col-md-4">
						<div class="form_group">
							<?php
							echo "<label for='baja'>Motivo de baja<span class='form-text'>*</span>:</label>";
							$con2="SELECT  m_baja,id_baja FROM tcat_motivo_baja";
							$res2=@mysql_query($con2);
							if(!$res2){
								echo " fallo";
							}
							else{
								echo "<select name='combo1' class='form-control'>";
								while ($fila2=mysql_fetch_array($res2)){
									echo "<option value=".$fila2['id_baja'].">".$fila2['m_baja']." </option>";
								}
								echo "</select>";
							}				
							?>
						</div>				
					</div>
				</div>
						<div class="form-group">
							<div class="col-sm-offset-3 col-sm-8">
								<input type="hidden" align="LEFT" name="id_empf123" value="<?php echo $id_emp;?>" />
								<input type="submit" class="btn btn-primary pull-right" value="Terminar proceso" name="terminar">
						</div>
							</div>
			</form>
			<script type="text/javascript">

				function confirmation() {
					if(confirm("Realmente desea eliminar?"))
					{
						return true;
					}
					return false;
				}
			</script>

			<?php
		
	
		
		
	}
	if(isset($_POST['id_empf123'])){
		?>
		<html>
    	<head><title>Resultado de UPDATE</title></head>
    	<body>
		
		<?php
		$idemp=$_POST['id_empf123'];
		$sql2="Select id_puesto from plantilla where id_empleado='".$idemp."'";
		$registro= @mysql_query($sql2);
		$fbaja=$_POST['dia']."/".$_POST['mes']."/".$_POST['anio'];
		
		if(!$registro){
			echo "Error ".mysql_errno();
			exit('<p>No se pudo obtener los detalles del registro.</p>');
		}
		$row = mysql_fetch_array($registro);
		
		$sql="UPDATE plantilla SET
		f_baja='".$fbaja."',
		id_baja='".$_POST['combo1']."'
		WHERE id_empleado='".$idemp."'";
		
		$sql3="UPDATE puestos SET
		id_eocupacional=2
		WHERE id_puesto='".$row["id_puesto"]."'";
		$sql4="UPDATE persona SET
		status='2'
		where id_empleado='".$idemp."'";
	

		if(@mysql_query($sql)){
				if(@mysql_query($sql3)){
					if(@mysql_query($sql4)){
						echo '<script>alert("Proceso de baja finalizado Comprueba que la persona este registrada en la hoja RUSP BAJAS.");</script>';
							
					}
							
				}

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
	
	
	
	if (isset($_POST["mo_empleado"])){
		$id_emp= $_POST["mo_empleado"];
		$sql = "SELECT * FROM persona WHERE id_empleado='".$id_emp."'";

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
    <title>Actualizar datos del empleado</title>
	<script language="javascript" src="js/jquery-3.3.1.min.js"></script>
		<script language="javascript">
			$(document).ready(function(){
				$("#combo2").change(function () {					
					$("#combo2 option:selected").each(function () {
						ent = $(this).val();
						$.post("getPaises.php", { ent: ent }, function(data){
							$("#combo3").html(data);
						});            
					});
				})
			});
			
		
		</script>
	
    </head>
    	<body>
		
			<div class="bottom-buffer">
				<form role="form" class="clearfix"  method="post"  >
					 <div class="row">
					 <div class="col-md-4">
						  <div class="form-group">
							<label for="deno_puesto">Numero de empleado<span class="form-text">*</span>:</label>
							<input type="text" name="id_empleado" class="form-control" value="<?php echo $registro['id_empleado'];?>">
						  </div>
						</div>
							<div class="col-md-4">
						  <div class="form-group">
							<label for="deno_puesto">Nombre<span class="form-text">*</span>:</label>
							<input type="text" name="nombre" class="form-control" value="<?php echo $registro['nombre'];?>">
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="cod_puesot">Apellido paterno<span class="form-text">*</span>:</label>
							<input type="text" name="a_paterno" class="form-control"  value="<?php echo $registro['a_paterno'];?>">
						  </div>
						</div>						
					 </div>
					 <div class="row">
						<div class="col-md-4">
						  <div class="form-group">
							<label for="ramo">Apellido materno<span class="form-text">*</span>:</label>
							<input type="text" name="a_materno" class="form-control"  value="<?php echo $registro['a_materno'];?>">
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="deno_puesto">CURP<span class="form-text">*</span>:</label>
							<input type="text" name="curp" class="form-control" value="<?php echo $registro['curp'];?>">
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="cod_puesot">RFC<span class="form-text">*</span>:</label>
							<input type="text" name="rfc" class="form-control"  value="<?php echo $registro['rfc'];?>">
						  </div>
						</div>
						
					</div>
					 <div class="row">
						<div class="col-md-4">
						  <div class="form-group">
							<label for="ramo">Sexo<span class="form-text">*</span>:</label>
							<?php
								$resactual="SELECT id_sexo,sexo FROM tcat_sexo where id_sexo=".$registro["id_sexo"]."";
								$conactual=@mysql_query($resactual);
								$con2="SELECT id_sexo,sexo FROM tcat_sexo";
								$res2=@mysql_query($con2);
								if(!$res2){
									echo " fallo";
								}
								else{
								
									echo "<select name='combo1' class='form-control' >";
									while ($actual=mysql_fetch_array($conactual)){
										echo "<option value=".$actual['id_sexo'].">	".$actual["sexo"]." (Registro actual)<option>";
									}
									while ($fila2=mysql_fetch_array($res2)){
										echo "<option value=".$fila2['id_sexo'].">".$fila2['sexo']." </option>";
									}
									echo "</select>";
								}
							
								?>

						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="deno_puesto">Fecha de nacimiento<span class="form-text">*</span>:</label>
							<input type="text" name="f_nac" class="form-control" value="<?php echo $registro['f_nac'];?>">
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="cod_puesot">Entidad de nacimiento<span class="form-text">*</span>:</label>
							<?php
								$resactual2="SELECT id_ef,entidad FROM tcat_entidades_federativas where id_ef=".$registro["id_enacimiento"]."";
								$conactual2=@mysql_query($resactual2);
								$con3="SELECT id_ef,entidad FROM tcat_entidades_federativas";
								$res3=@mysql_query($con3);
								if(!$res3){
									echo " fallo";
								}
								else{
								
									echo "<select name='combo2' id='combo2' class='form-control' >";
									while ($actual2=mysql_fetch_array($conactual2)){
										echo "<option value=".$actual2['id_ef'].">	".$actual2["entidad"]." (Registro actual)<option>";
									}
									while ($fila3=mysql_fetch_array($res3)){
										echo "<option value=".$fila3["id_ef"].">".$fila3["entidad"]." </option>";
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
							<label for="ramo">Pais de nacimiento<span class="form-text">*</span>:</label>
							<select id='combo3' name='combo3' class='form-control' >
							<?php
							$resactual2="SELECT id_pais,pais FROM tcat_paises where id_pais=".$registro["id_pnacimiento"]."";
								$conactual2=@mysql_query($resactual2);
								if(!$res3){
									echo " fallo";
								}
								else{
									while ($actual2=mysql_fetch_array($conactual2)){
										echo "<option value=".$actual2['id_pais'].">	".$actual2["pais"]." (Registro actual)<option>";
									}
								}
							?>
							</select>
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="deno_puesto">Correo electronico<span class="form-text">*</span>:</label>
							<input type="text" name="correo_electronico" class="form-control" value="<?php echo $registro['correo_electronico'];?>">
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="cod_puesot">Numero de seguro social<span class="form-text">*</span>:</label>	
							<input type="text" name="no_ss" class="form-control"  value="<?php echo $registro['no_ss'];?>">
						  </div>
						</div>
					</div>
					 <div class="row">
						
						<div class="col-md-4">
						  <div class="form-group">
							<label for="ramo">Estado conyugal<span class="form-text">*</span>:</label>
							<?php
								$resactual4="SELECT id_econyugal,e_conyugal FROM tcat_estado_conyugal where id_econyugal=".$registro["id_econyugal"]."";
								$conactual4=@mysql_query($resactual4);	
								$con5="SELECT id_econyugal,e_conyugal FROM tcat_estado_conyugal";
								$res5=@mysql_query($con5);
								if(!$res5){
									echo " fallo";
								}
								else{							
									echo "<select name='combo4' class='form-control' >";
										while ($actual=mysql_fetch_array($conactual4)){
											echo "<option value=".$actual['id_econyugal'].">".$actual["e_conyugal"]." (Registro actual)<option>";
										}
										while ($fila2=mysql_fetch_array($res5)){
											echo "<option value=".$fila2["id_econyugal"].">".$fila2["e_conyugal"]." </option>";
										}
									echo "</select>";
								}
							
								?>

						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="deno_puesto">Tipo de discapacidad<span class="form-text">*</span>:</label>
									<?php
								$resactual5="SELECT id_discapacidad,t_discapacidad FROM tcat_discapacidades where id_discapacidad=".$registro["id_discapacidad"]."";
								$conactual5=@mysql_query($resactual5);
								$con6="SELECT id_discapacidad,t_discapacidad FROM tcat_discapacidades";
								$res6=@mysql_query($con6);
								if(!$res6){
									echo " fallo";
								}
								else{							
									echo "<select name='combo5' class='form-control' >";
										while ($actual=mysql_fetch_array($conactual5)){
											echo "<option value=".$actual['id_discapacidad'].">	".$actual["t_discapacidad"]." (Registro actual)<option>";
										}
										while ($fila2=mysql_fetch_array($res6)){
											echo "<option value=".$fila2["id_discapacidad"].">".$fila2["t_discapacidad"]." </option>";
										}
									echo "</select>";
								}
							
								?>
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="cod_puesot">Escolaridad<span class="form-text">*</span>:</label>	
							<?php
									
								$resactual6="SELECT id_escolaridad,nive_e,estatus_e FROM tcat_escolaridad where id_escolaridad=".$registro["id_escolaridad"]."";
								$conactual6=@mysql_query($resactual6);
		
								$con7="SELECT id_escolaridad,nive_e,estatus_e FROM tcat_escolaridad";
								$res7=@mysql_query($con7);
								if(!$res6){
									echo " fallo";
								}
								else{							
									echo "<select name='combo6' class='form-control' >";
										while ($actual=mysql_fetch_array($conactual6)){
											echo "<option value=".$actual['id_escolaridad'].">	".$actual["nive_e"].",".$actual["estatus_e"]." (Registro actual)<option>";
										}
										while ($fila2=mysql_fetch_array($res7)){
											echo "<option value=".$fila2["id_escolaridad"].">".$fila2["nive_e"].",".$fila2["estatus_e"]." </option>";
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
							<label for="ramo">Institucion de seguro social<span class="form-text">*</span>:</label>
							<?php
								$resactual7="SELECT id_institucion,institucion_ss FROM tcat_instituciones_ss where id_institucion=".$registro["id_institucion_ss"]."";
								$conactual7=@mysql_query($resactual7);
								$con8="SELECT id_institucion,institucion_ss FROM tcat_instituciones_ss";
								$res8=@mysql_query($con8);
								if(!$res8){
									echo " fallo";
								}
								else{							
									echo "<select name='combo7' class='form-control' >";
										while ($actual=mysql_fetch_array($conactual7)){
											echo "<option value=".$actual['id_institucion'].">	".$actual["institucion_ss"]." (Registro actual)<option>";
										}
										while ($fila2=mysql_fetch_array($res8)){
											echo "<option value=".$fila2["id_institucion"].">".$fila2["institucion_ss"]." </option>";
										}
									echo "</select>";
								}
							
								?>

						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="cod_puesot">Plaza<span class="form-text">*</span>:</label>	
							<input type="text" name="plaza" class="form-control"  value="<?php echo $registro['PLAZA'];?>">
						  </div>
						</div>
						
					</div>
							
				<div class="clearfix">
                <div class="pull-left text-muted text-vertical-align-button">
                  
                </div>

                <div class="pull-right">
						<input type="hidden" align="LEFT" name="id_emp" value="<?php echo $registro['id_empleado'];?>" /><p></td>
						<input type="submit" value="ACTUALIZAR" class="btn btn-primary pull-right" name="actualizar">
                </div>
              </div>
					
					
					
				</form>
			</div>
		
		
		</body>
		</html>
		<?PHP
	
	}
	if(isset($_POST['id_emp'])){
		?>
		<html>
    	<head><title>Resultado de UPDATE</title></head>
    	<body>

		<?php
		$sql="UPDATE persona SET
		nombre='".$_POST['nombre']."',
		a_paterno='".$_POST['a_paterno']."',
		a_materno='".$_POST['a_materno']."',
		curp='".$_POST['curp']."',
		rfc='".$_POST['rfc']."',
		id_sexo='".$_POST['combo1']."',
		f_nac='".$_POST['f_nac']."',
		id_enacimiento='".$_POST['combo2']."',
		id_pnacimiento='".$_POST['combo3']."',
		correo_electronico='".$_POST['correo_electronico']."',
		no_ss='".$_POST['no_ss']."',
		id_econyugal='".$_POST['combo4']."',
		id_discapacidad='".$_POST['combo5']."',
		id_escolaridad='".$_POST['combo6']."',
		id_institucion_ss='".$_POST['combo7']."',
		PLAZA='".$_POST['plaza']."'
		WHERE id_empleado='".$_POST['id_emp']."'";

		if(@mysql_query($sql)){   
			  header("location: ../view/success_persona.html");
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