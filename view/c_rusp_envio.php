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

	$resultado1= @mysql_query ($sql);
	$num_regis=mysql_num_rows($resultado1);
	if (!$resultado1)
	{
	 exit ('error en la consulta');
	 echo $resultado1;
	
    }
    ?>
    <HTML>
    <BODY>
	 <h3><center>RUSP_ENVIO</h3>
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
			<label class="col-sm-3 control-label" for="email-03">Nombre del empleado:</label>
			<div class="col-sm-8">
			<input class="form-control" id="nombre" placeholder="" type="text" name="nombre">
			</div>
		</div>
	<div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">
	 <input type='hidden' name='bus_rusp_envio' value='".$row["id_empleado"]."'></input>
      <input class="btn btn-primary pull-right" type='submit' value='BUSCAR'> </input>

	  </dIV>
	  </div>
	</form>
	<form method='' action='excel_rusp_envio.php' class='form-horizontal' role='form'> 
	 <input type='hidden' name='bus_empleado' value='".$row["id_empleado"]."'></input>
      <input type='submit' class='btn btn-default' value='Exportar tabla a excel '> 
      </form>
	  <?php
	  echo $num_regis." registros";
	  ?>
    <table align="center" class="table table-responsive  ">
    <tr>
    <td>NOPLA_UNI||NOPLA_PUESTO||NOPLA_PLAZA</td>
	<td>FILIACION0</td>	
    <td>RAMO1</td>
	<td>UNIDAD2</td>
	<td>CONS_GRAL3</td>
	<td>CONS_JEFE4</td>
	<td>NOM_PTO5</td>
	<td>PTO6</td>
	<td>NIVEL7</td>
	<td>ZONA_ECONOMICA8</td>
	<td>SDO_MENS9</td>
	<td>CG_MENS</td>
	<td>ENT_PLAZA</td>
	<td>PAIS12</td>
	<td>TIPO_PZA13</td>
	<td>PTO_ESTRAT14</td>
	<td>TIPO_FUNC15</td>
	<td>TIPO_PERS16</td>
	<td>PTO_RHNET17</td>
	<td>STATUS_OCUP18</td>
	<td>RFC_SP19</td>
	<td>CURP20</td>
	<td>NOMBRES21</td>
	<td>APE_PAT22</td>
	<td>APE_MAT23</td>
	<td>FECHA_NAC24</td>
	<td>SEXO25</td>	
	<td>ENT_NAC26</td>
	<td>PAIS_NAC27</td>
	<td>MAIL28</td>
	<td>NUM_NSS29</td>
	<td>NUM_SEGSOC30</td>
	<td>TIPO_DISCA32</td>
	<td>TIPO_CONT33</td>
	<td>DECLA_PAT34</td>
	<td>MOTIVO_DP35</td>
	<td>NUM_EMP36</td>
	<td>INGRSOAPF37</td>
	<td>INGRSOSPC38</td>
	<td>ING_SECTUR39</td>
	<td>ULT_PTO40</td>
	<td>OBLIGA_DP41</td>
	<td>RFI/RIUF 48</td>
	<td>TIPO FUN 49</td>
	<td>NIVL 50</td>
	<td>CONYUGAL 51</td>
	<td>LENGUAS </td>
	<td>DESCENDENCIA</td>
	</tr>
 
 <?php
while ($row=mysql_fetch_array ($resultado1))
{
	
	  echo "<tr>";	  
		echo "<td>". $row["noplauni"]. "</td>";
		echo "<td>". $row["filiacion"]. "</td>";
		echo "<td>". $row["id_ramo"]. "</td>";
		echo "<td>". $row["id_ur"]. "</td>";
		echo "<td>". $row["cons_gral"]. "</td>";
		echo "<td>". $row["cons_jefe"]. "</td>";
		echo "<td>". $row["deno_puesto"]. "</td>";
		echo "<td>". $row["pto"]. "</td>";
		echo "<td>". $row["n_salarial"]. "</td>";
		echo "<td>". $row["id_ze_rusp"]. "</td>";
		echo "<td>". $row["sdo_men"]. "</td>";
		echo "<td>". $row["cg_mens"]. "</td>";
		echo "<td>". $row["id_ent_plaza"]. "</td>";
		echo "<td>". $row["id_pais_plaza"]. "</td>";
		echo "<td>". $row["id_tplaza"]. "</td>";
		echo "<td>". $row["id_pestrategico"]. "</td>";
		echo "<td>". $row["id_funcion"]. "</td>";
		echo "<td>". $row["id_tpersonal"]. "</td>";
		echo "<td>". $row["codigo_puesto"]. "</td>";
		echo "<td>". $row["id_eocupacional"]. "</td>";
		echo "<td>". $row["rfc"]. "</td>";
		echo "<td>". $row["curp"]. "</td>";
		echo "<td>". $row["nombre"]. "</td>";
		echo "<td>". $row["a_paterno"]. "</td>";
		echo "<td>". $row["a_materno"]. "</td>";
		echo "<td>". $row["f_nac"]. "</td>";
		echo "<td>". $row["id_sexo"]. "</td>";
		echo "<td>". $row["id_enacimiento"]. "</td>";
		echo "<td>". $row["id_pnacimiento"]. "</td>";
		echo "<td>". $row["correo_electronico"]. "</td>";
		echo "<td>". $row["id_institucion_ss"]. "</td>";		
		echo "<td>". $row["no_ss"]. "</td>";
		echo "<td>". $row["id_discapacidad"]. "</td>";
		echo "<td>". $row["id_tcontratacion"]. "</td>";	
		echo "<td>". $row["declaracion_patri"]. "</td>";
		echo "<td>". $row["id_mdeclaracion"]. "</td>";
		echo "<td>". $row["id_empleado"]. "</td>";
		echo "<td>". $row["f_ingr_apf"]. "</td>";
		echo "<td>". $row["f_ingr_spc"]. "</td>";
		echo "<td>". $row["f_ingr_sectur"]. "</td>";
		echo "<td>". $row["f_ult_puesto"]. "</td>";
		echo "<td>". $row["f_oblig_patri"]. "</td>";
		echo "<td>". $row["clv_rfi_riuf"]. "</td>";
		echo "<td>". $row["clv_tservidor"]. "</td>";
		echo "<td>". $row["id_escolaridad"]. "</td>";
		echo "<td>". $row["id_econyugal"]. "</td>";
		
		echo "<td>";
		$sql2="Select id_idioma,nivel from persona_idiomas where id_persona=".$row["id_empleado"];
		$resultado2=@mysql_query ($sql2);
		$numero= mysql_num_rows($resultado2);
		$num=0;
		while ($row1=mysql_fetch_array ($resultado2))
			{
			$num++;
			if($num == $numero){
				echo $row1["id_idioma"]."-".$row1["nivel"]."";
			}else{
			echo $row1["id_idioma"]."-".$row1["nivel"].", ";
			}
			
			
			}
		echo"</td>";
		echo "<td>". $row["descendencia"]. "</td></tr>";
}
   echo '</table>';
    echo '
    </body>
    </html>';
		}else{
		if(isset($_POST["bus_rusp_envio"])){
				$nom=$_POST["nombre"];
				$ur=$_POST["combo2"]
			?> 
	<HTML>
    <BODY>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
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
			<label class="col-sm-3 control-label" for="email-03">Nombre del empleado:</label>
			<div class="col-sm-8">
			<input class="form-control" id="nombre" placeholder="" type="text" name="nombre">
			</div>
		</div>
	<div class="form-group">
    <div class="col-sm-offset-3 col-sm-8">
	 <input type='hidden' name='bus_rusp_envio' value='".$row["id_empleado"]."'></input>
      <input class="btn btn-primary pull-right" type='submit' value='BUSCAR'> </input>

	  </dIV>
	  </div>
	</form>
	  <?php
		if(empty($nom)){
			$sql =  "Select noplauni,filiacion,id_ramo,puestos.id_ur,cons_gral,cons_jefe,puestos.deno_puesto,pto,n_salarial,id_ze_rusp,
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
						where puestos.id_puesto>0 and persona.status=1 and  puestos.id_ur= '".$ur."' order by a_paterno asc";
	$numcon=1;
	}else{
		if($ur==0){
			$sql =  "Select noplauni,filiacion,id_ramo,puestos.id_ur,cons_gral,cons_jefe,puestos.deno_puesto,pto,n_salarial,id_ze_rusp,
	sdo_men,cg_mens,id_ent_plaza,id_pais_plaza,puestos.id_tplaza,id_pestrategico,puestos.id_funcion,id_tpersonal,
	puestos.codigo_puesto,id_eocupacional,rfc,curp,nombre,a_paterno,a_materno,f_nac,id_sexo,persona.id_enacimiento,
	persona.id_pnacimiento,correo_electronico,persona.id_institucion_ss,no_ss,id_discapacidad,id_tcontratacion,declaracion_patri,id_mdeclaracion,
	plantilla.id_empleado,f_ingr_apf,f_ingr_spc,f_ingr_sectur,f_ult_puesto,f_oblig_patri,clv_rfi_riuf,clv_tservidor,persona.id_escolaridad,persona.id_econyugal,
	descendencia
	from plantilla left outer join puestos on plantilla.id_puesto=puestos.id_puesto
                        left outer join persona on plantilla.id_empleado=persona.id_empleado 
						left outer join rfi_riuf on puestos.id_rfi_riuf=rfi_riuf.id_rfi_riuf
						left outer join tcat_nivel_salarial on puestos.id_nsalarial=tcat_nivel_salarial.id_nsalarial
						left outer join tcat_tipo_servidor_publico on puestos.id_tservidor=tcat_tipo_servidor_publico.id_tservidor 
						where puestos.id_puesto>0 and persona.status=1 and (nombre like '%$nom%' or a_paterno like '%$nom%' or a_materno  like '%$nom') order by a_paterno asc";
			$numcon=2;
		}else{
			$sql =  "Select noplauni,filiacion,id_ramo,puestos.id_ur,cons_gral,cons_jefe,puestos.deno_puesto,pto,n_salarial,id_ze_rusp,
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
						where puestos.id_puesto>0 and persona.status=1 and (nombre like '%$nom%' or a_paterno like '%$nom%' or a_materno  like '%$nom%') and puestos.id_ur='$ur' order by a_paterno asc";
				$numcon=3;
		}
	}
	$resultado1= @ mysql_query ($sql);
	$num_regis=mysql_num_rows($resultado1);
		
			if (!$resultado1)
			{
				exit ('error en la consulta');
				echo mysql_errno();
			}
	
	
		$num_regis=mysql_num_rows($resultado1);
	if($num_regis==0){
		echo "NO SE ENCONTRARON CONCIDENCIAS";
	}else{
		

		 echo "<td><form method='post' action='excel_rusp_envio_con.php '> \n
      <input type='hidden' name='nom' value='".$nom."'>
	   <input type='hidden' name='ur' value='".$ur."'>
	<input type='hidden' name='con' value='".$numcon."'>
      <input type='submit'  class='btn btn-default'  value='Exportar consulta a excel '> 
      </form></td></tr>";	 
    ?>
	<?php
	  echo $num_regis." registros";
	  ?>
	<table class="table table-striped" align="center">
	  <tr>
  <td>NOPLA_UNI||NOPLA_PUESTO||NOPLA_PLAZA</td>
	<td>FILIACION0</td>	
    <td>RAMO1</td>
	<td>UNIDAD2</td>
	<td>CONS_GRAL3</td>
	<td>CONS_JEFE4</td>
	<td>NOM_PTO5</td>
	<td>PTO6</td>
	<td>NIVEL7</td>
	<td>ZONA_ECONOMICA8</td>
	<td>SDO_MENS9</td>
	<td>CG_MENS</td>
	<td>ENT_PLAZA</td>
	<td>PAIS12</td>
	<td>TIPO_PZA13</td>
	<td>PTO_ESTRAT14</td>
	<td>TIPO_FUNC15</td>
	<td>TIPO_PERS16</td>
	<td>PTO_RHNET17</td>
	<td>STATUS_OCUP18</td>
	<td>RFC_SP19</td>
	<td>CURP20</td>
	<td>NOMBRES21</td>
	<td>APE_PAT22</td>
	<td>APE_MAT23</td>
	<td>FECHA_NAC24</td>
	<td>SEXO25</td>	
	<td>ENT_NAC26</td>
	<td>PAIS_NAC27</td>
	<td>MAIL28</td>
	<td>NUM_NSS29</td>
	<td>NUM_SEGSOC30</td>
	<td>TIPO_DISCA32</td>
	<td>TIPO_CONT33</td>
	<td>DECLA_PAT34</td>
	<td>MOTIVO_DP35</td>
	<td>NUM_EMP36</td>
	<td>INGRSOAPF37</td>
	<td>INGRSOSPC38</td>
	<td>ING_SECTUR39</td>
	<td>ULT_PTO40</td>
	<td>OBLIGA_DP41</td>
	<td>RFI/RIUF 48</td>
	<td>TIPO FUN 49</td>
	<td>NIVL 50</td>
	<td>CONYUGAL 51</td>
	<td>LENGUAS </td>
	<td>DESCENDENCIA</td>
	</tr>
		<?php
	while ($row=mysql_fetch_array ($resultado1))
	{
		  echo "<tr>";	  
	echo "<td>". $row["noplauni"]. "</td>";
		echo "<td>". $row["filiacion"]. "</td>";
		echo "<td>". $row["id_ramo"]. "</td>";
		echo "<td>". $row["id_ur"]. "</td>";
		echo "<td>". $row["cons_gral"]. "</td>";
		echo "<td>". $row["cons_jefe"]. "</td>";
		echo "<td>". $row["deno_puesto"]. "</td>";
		echo "<td>". $row["pto"]. "</td>";
		echo "<td>". $row["n_salarial"]. "</td>";
		echo "<td>". $row["id_ze_rusp"]. "</td>";
		echo "<td>". $row["sdo_men"]. "</td>";
		echo "<td>". $row["cg_mens"]. "</td>";
		echo "<td>". $row["id_ent_plaza"]. "</td>";
		echo "<td>". $row["id_pais_plaza"]. "</td>";
		echo "<td>". $row["id_tplaza"]. "</td>";
		echo "<td>". $row["id_pestrategico"]. "</td>";
		echo "<td>". $row["id_funcion"]. "</td>";
		echo "<td>". $row["id_tpersonal"]. "</td>";
		echo "<td>". $row["codigo_puesto"]. "</td>";
		echo "<td>". $row["id_eocupacional"]. "</td>";
		echo "<td>". $row["rfc"]. "</td>";
		echo "<td>". $row["curp"]. "</td>";
		echo "<td>". $row["nombre"]. "</td>";
		echo "<td>". $row["a_paterno"]. "</td>";
		echo "<td>". $row["a_materno"]. "</td>";
		echo "<td>". $row["f_nac"]. "</td>";
		echo "<td>". $row["id_sexo"]. "</td>";
		echo "<td>". $row["id_enacimiento"]. "</td>";
		echo "<td>". $row["id_pnacimiento"]. "</td>";
		echo "<td>". $row["correo_electronico"]. "</td>";
		echo "<td>". $row["id_institucion_ss"]. "</td>";		
		echo "<td>". $row["no_ss"]. "</td>";
		echo "<td>". $row["id_discapacidad"]. "</td>";
		echo "<td>". $row["id_tcontratacion"]. "</td>";	
		echo "<td>". $row["declaracion_patri"]. "</td>";
		echo "<td>". $row["id_mdeclaracion"]. "</td>";
		echo "<td>". $row["id_empleado"]. "</td>";
		echo "<td>". $row["f_ingr_apf"]. "</td>";
		echo "<td>". $row["f_ingr_spc"]. "</td>";
		echo "<td>". $row["f_ingr_sectur"]. "</td>";
		echo "<td>". $row["f_ult_puesto"]. "</td>";
		echo "<td>". $row["f_oblig_patri"]. "</td>";
		echo "<td>". $row["clv_rfi_riuf"]. "</td>";
		echo "<td>". $row["clv_tservidor"]. "</td>";
		echo "<td>". $row["id_escolaridad"]. "</td>";
		echo "<td>". $row["id_econyugal"]. "</td>";
		
			echo "<td>";
		$sql2="Select id_idioma,nivel from persona_idiomas where id_persona=".$row["id_empleado"];
		$resultado2=@mysql_query ($sql2);
		$numero= mysql_num_rows($resultado2);
		$num=0;
		while ($row1=mysql_fetch_array ($resultado2))
			{
			$num++;
			if($num == $numero){
				echo $row1["id_idioma"]."-".$row1["nivel"]."";
			}else{
			echo $row1["id_idioma"]."-".$row1["nivel"].", ";
			}
			
			
			}
		echo "</td>";
		echo "<td>". $row["descendencia"]. "</td></tr>";
	}
   echo '</table>';
	
	   
	}		
		}
}
 mysql_close($conexion); ?>