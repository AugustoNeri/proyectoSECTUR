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
if (!$conexion){
	exit('<p>No pudo realizarce la conexión a la base de datos.</p>');
}
if (!@mysql_select_db($db, $conexion)){
	echo mysql_errno();
	exit ('<p>Problema al seleccionar la base de datos $db.</p>');
}
	
	if(!$_POST){
	
	?> 
   
    <html>
    <head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		 <meta name="viewport" content="width=device-width, initial-scale=1">
	 <link href="/favicon.ico" rel="shortcut icon">
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
	 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
    <title>Actualizar datos del empleado</title>
	<script language="javascript" src="js/jquery-3.3.1.min.js"></script>
		<script language="javascript">
			$(document).ready(function(){
				$("#combo2").change(function () {					
					$("#combo2 option:selected").each(function () {
						ent = $(this).val();
						$.post("getPaises1.php", { ent: ent }, function(data){
							$("#combo3").html(data);
						});            
					});
				})
			});
			
		
		</script>
	</head>

    <body>
	
	<center><h3>Datos personales del empleado</h3></center>
		<div class="bottom-buffer">
				<form  action="" role="form" class="clearfix"  method="post"  onsubmit="return validarDatos()">
					 <div class="row">
					 <div class="col-md-4">
						  <div class="form-group">
							<label for="deno_puesto">Numero de empleado<span class="form-text">*</span>:</label>
							<input type="text" id="id_empleado" name="id_empleado" class="form-control" maxlength="8" placeholder="Ingresa número del empleado" required>
						  </div>
						</div>
							<div class="col-md-4">
						  <div class="form-group">
							<label for="deno_puesto">Nombre<span class="form-text">*</span>:</label>
							<input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingresa nombre(s) del empleado" required>
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="cod_puesot">Apellido paterno<span class="form-text">*</span>:</label>
							<input type="text" id="a_paterno" name="a_paterno" class="form-control" placeholder="Ingresa  el apellido paterno del empleado" required>
						  </div>
						</div>						
					 </div>
					 <div class="row">
						<div class="col-md-4">
						  <div class="form-group">
							<label for="ramo">Apellido materno<span class="form-text">*</span>:</label>
							<input type="text" id="a_materno" name="a_materno" class="form-control"  placeholder="Ingresa el apellido materno del empleado" required>
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="deno_puesto">CURP<span class="form-text">*</span>:</label>
							<input type="text" id="curp" name="curp" class="form-control" required maxlength="18" placeholder="Ingresa el CURP del empleado">
						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="cod_puesot">RFC<span class="form-text">*</span>:</label>
							<input type="text" id="rfc" name="rfc" class="form-control"  required maxlength="13" placeholder="Ingresa el RFC del empleado">
						  </div>
						</div>
					</div>
					 <div class="row">
						<div class="col-md-4">
						  <div class="form-group">
							<label for="ramo">Sexo<span class="form-text">*</span>:</label>
							<?php
								$con2="SELECT id_sexo,sexo FROM tcat_sexo";
								$res2=@mysql_query($con2);
								if(!$res2){
									echo " fallo";
								}
								else{
								
									echo "<select name='combo1' id='combo1' class='form-control' >";
									echo "<option value=''>Seleccione el sexo</option>";
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
							<label for="deno_puesto">Correo electronico institucional<span class="form-text">*</span>:</label>
							<input type="text" id="correo_electronico" name="correo_electronico" class="form-control" placeholder="Ingresa correo electronico institucional del empleado">
						  </div> 
						
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="cod_puesot">Entidad de nacimiento<span class="form-text">*</span>:</label>
							<?php
								$con3="SELECT id_ef,entidad FROM tcat_entidades_federativas";
								$res3=@mysql_query($con3);
								if(!$res3){
									echo " fallo";
								}
								else{
									echo "<select id='combo2' name='combo2' class='form-control' >";
									echo "<option value=''>Selecciona la entidad de nacimiento</option>";
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
							<select id='combo3' name='combo3' class='form-control' ></select>
							
						  </div>
						</div>
						<div class="col-md-4">
							<div class="form-group clearfix">
								<div class="form-control-lada">
								  <label for="lada">Dia de nacimiento<span class="form-text">*</span>:</label>
								  <select id="dia" name="dia" class='form-control'>
								 <option value="">Selecciona el dia</option>
										 <?php									
											for($i=1;$i<=31;$i++){
												echo '<option value="'.$i.'">'.$i."</option>";
												
											}
									?>	 
									</select>
								</div>
							<div class="form-control-lada">
							  <label for="phone">Mes de nacimiento<span class="form-text">*</span>:</label>
								<select name="combo4" id="combo4" class='form-control'>
								<option value=""   >Selecciona el mes</option>
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
								<label for="phone">Año de nacimiento<span class="form-text">*</span>:</label>
								<select name="combo5" id="combo5" class='form-control'>
								<option value=""   >Selecciona el año</option>
								<?php
								$year=date("Y");
								for($i=1960;$i<$year;$i++){
									echo '<option value="'.$i.'">'.$i."</option>";
									
								}?>	 
								</select>
							</div>
							</div>
						</div>		
						<div class="col-md-4">
						  <div class="form-group">
							<label for="cod_puesot">Numero de seguro social<span class="form-text">*</span>:</label>	
							<input type="text" id="no_ss" name="no_ss" class="form-control" required maxlength="12" placeholder="Ingresa un numero de seguro social del empleado" required>
						  </div>
						</div>
					</div>
					 <div class="row">
						
						<div class="col-md-4">
						  <div class="form-group">
							<label for="ramo">Estado conyugal<span class="form-text">*</span>:</label>
							<?php
								$con5="SELECT id_econyugal,e_conyugal FROM tcat_estado_conyugal";
								$res5=@mysql_query($con5);
								if(!$res5){
									echo " fallo";
								}
								else{							
									echo "<select name='combo6' id='combo6' class='form-control' >";
									echo "<option value=''>Selecciona estado conyugal</option>";
										while ($fila2=mysql_fetch_array($res5)){
											echo "<option value='".$fila2["id_econyugal"]."'>".$fila2["e_conyugal"]." </option>";
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
								
								$con6="SELECT id_discapacidad,t_discapacidad FROM tcat_discapacidades";
								$res6=@mysql_query($con6);
								if(!$res6){
									echo " fallo";
								}
								else{							
									echo "<select name='combo7' id='combo7' class='form-control' >";
									echo "<option value=''>Selecciona el tipo de discapacidad</option>";
										while ($fila2=mysql_fetch_array($res6)){
											echo "<option value='".$fila2["id_discapacidad"]."'>".$fila2["t_discapacidad"]." </option>";
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
								$con7="SELECT id_escolaridad,nive_e,estatus_e FROM tcat_escolaridad";
								$res7=@mysql_query($con7);
								if(!$res6){
									echo " fallo";
								}
								else{							
									echo "<select id='combo8' name='combo8' class='form-control' >";
									echo "<option value=''>Selecciona nivel de escolaridad</option>";
										while ($fila2=mysql_fetch_array($res7)){
											echo "<option value='".$fila2["id_escolaridad"]."'>".$fila2["nive_e"].",".$fila2["estatus_e"]." </option>";
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
								$con8="SELECT id_institucion,institucion_ss FROM tcat_instituciones_ss";
								$res8=@mysql_query($con8);
								if(!$res8){
									echo " fallo";
								}
								else{							
									echo "<select id='combo9' name='combo9' class='form-control' >";
									echo "<option value=''>Selecciona la institucion de seguro social</option>";
										while ($fila2=mysql_fetch_array($res8)){
											echo "<option value='".$fila2["id_institucion"]."'>".$fila2["institucion_ss"]." </option>";
										}
									echo "</select>";
								}
							
								?>

						  </div>
						</div>
						<div class="col-md-4">
						  <div class="form-group">
							<label for="cod_puesot">Numero de plaza<span class="form-text">*</span>:</label>	
							<input type="text" id="plaza" name="plaza" class="form-control" placeholder="Ingresa el numero de plaza del empleado" maxlength="4">
						  </div>
						</div>
						
					</div>
							
				<div class="clearfix">
                <div class="pull-left text-muted text-vertical-align-button">
                  
                </div>

                <div class="pull-right">
						
						<input type="submit" value="guardar" class="btn btn-primary pull-right" name="guardar">
                </div>
              </div>
					
					
					
				</form>
	<script type="text/javascript">	
	function validarDatos(){
		var txtidemp = document.getElementById('id_empleado').value;
		var txtnss = document.getElementById('no_ss').value;
		var txtpla = document.getElementById('plaza').value;	
		var cmbsex = document.getElementById('combo1').selectedIndex;
		var cmbenac = document.getElementById('combo2').selectedIndex;
		var cmbpnac = document.getElementById('combo3').selectedIndex;
		var cmbdia = document.getElementById('dia').selectedIndex;
		var cmbmes = document.getElementById('combo4').selectedIndex;
		var cmbyear = document.getElementById('combo5').selectedIndex;
		var cmbeconyu = document.getElementById('combo6').selectedIndex;
		var cmbtdisc = document.getElementById('combo7').selectedIndex;
		var cmbesco = document.getElementById('combo8').selectedIndex;
		var cmbiss = document.getElementById('combo9').selectedIndex;
 
		//Test idempleado
		if(isNaN(txtidemp)){
			alert('ERROR: Dato no válido en el numero de empleado');
			return false;
		}
		
		//Test plaza
		if(isNaN(txtpla)){
			alert('ERROR: Dato no valido en numero de plaza');
			return false;
		}
 
		//Test comboBoxsexo
		if(cmbsex == null || cmbsex == 0){
			alert('ERROR: Debe seleccionar una opcion en el menu de sexo');
			return false;
		}
		//Test comboBoxenac
		if(cmbenac == null || cmbenac == 0){
			alert('ERROR: Debe seleccionar una Entidad de nacimiento');
			return false;
		}
		//Test comboBoxpnac
		if(cmbpnac == null || cmbpnac == 0){
			alert('ERROR: Debe seleccionar un Pais de nacimiento');
			return false;
		}
		//Test comboBoxpnac
		if(cmbdia == ''){
			alert('ERROR: Debe seleccionar un Dia de nacimiento');
			return false;
		}
		//Test comboBoxpnac
		if(cmbmes == ''){
			alert('ERROR: Debe seleccionar un mes de nacimiento');
			return false;
		}
		//Test comboBoxpnac
		if(cmbyear == ''){
			alert('ERROR: Debe seleccionar un año de nacimiento');
			return false;
		}
		//Test comboBoxpnac
		if(cmbeconyu == ''){
			alert('ERROR: Debe seleccionar una opcion en estado conyugal');
			return false;
		}//Test comboBoxpnac
		if(cmbtdisc == ''){
			alert('ERROR: Debe seleccionar una opcion en tipo de discapacidad');
			return false;
		}
		if(cmbesco == ''){
			alert('ERROR: Debe seleccionar una opcion en nivel de escolaridad');
			return false;
		}
		if(cmbiss == ''){
			alert('ERROR: Debe seleccionar una opcion en institucion de ss');
			return false;
		}
		
		
		return true;
	}
	</script>
			</div>
	
   	
	</body>
	</html>
	
<?php
}else{
	if(isset($_POST["guardar"])){
		
			?>
			<html>
			<head>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
			</head>
			<body>
			
			<?php
		$idemp=$_POST["id_empleado"];
		$nombre=strtoupper($_POST["nombre"]);
		$apaterno=strtoupper($_POST["a_paterno"]);
		$amaterno=strtoupper($_POST["a_materno"]);
		$curp=strtoupper($_POST["curp"]);
		$rfc=strtoupper($_POST["rfc"]);
		$sex=$_POST["combo1"];
		$mail=$_POST["correo_electronico"];
		$enac=$_POST["combo2"];
		$pnac=$_POST["combo3"];
		if($_POST['dia']<10){
			$fnac="0".$_POST["dia"]."/".$_POST["combo4"]."/".$_POST["combo5"];
		}else{
			$fnac=$_POST["dia"]."/".$_POST["combo4"]."/".$_POST["combo5"];
		}
		$nss=$_POST["no_ss"];
		$econyu=$_POST["combo6"];
		$tdisc=$_POST["combo7"];
		$escolar=$_POST["combo8"];
		$iss=$_POST["combo9"];
		$plaza=$_POST["plaza"];
		If($iss == ''){
			$iss=0;
		}

		
			$sql="insert into persona (id_empleado,nombre,a_paterno,a_materno,rfc,curp,id_sexo,f_nac,id_enacimiento,id_pnacimiento,correo_electronico,no_ss,id_econyugal,id_discapacidad,id_escolaridad,id_institucion_ss,PLAZA,status)
		values('$idemp','$nombre','$apaterno','$amaterno','$rfc','$curp','$sex','$fnac','$enac','$pnac','$mail','$nss','$econyu','$tdisc','$escolar','$iss','$plaza','1')";
		if(!(@mysql_query($sql)) ){
			
		?>
		<div class="alert alert-danger">No se pudieron insertar correctamente los datos</div>
		<?php
		}else{
				?>
		<div class="alert alert-success">Datos insertados correctamente</div>
			<form method='post' action='' class='form-horizontal' role='form'>
		  <input type='hidden' name='idemp' value="<?php echo $idemp;?>">
		  <input type='submit' class='btn btn-default' value='siguiente'> 
		  </form>
		  </body>
		  </html>
		<?php
			}	

	
	}
		if(isset($_POST['idemp'])){
		$sql="select id_ur,ur from tcat_ur ORDER BY ur";	
				$resultado= @mysql_query($sql);
				$idemp=$_POST['idemp'];
				
		?>
		<html>
		<head>
			<script language="javascript" src="js/jquery-3.3.1.min.js"></script>
		
		<script language="javascript">
			$(document).ready(function(){
				$("#cbx_ur").change(function () {					
					$("#cbx_ur option:selected").each(function () {
						ur = $(this).val();
						$.post("getPuestos.php", { ur: ur }, function(data){
							$("#cbx_puesto").html(data);
						});            
					});
				})
			});
			
		
		</script>	
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
		</head>
		<body>
		<div class="bottom-buffer">
		<form method='post' action='' class='clearfix' role='form'>
			 <div class="row">
					 <div class="col-md-4">
					 <div class="form-group">
						<label for="ramo">Unidad de Adscripción<span class="form-text">*</span>:</label>
						<select name="cbx_ur" id="cbx_ur"  class='form-control'>
								<option value="0">Seleccionar UR</option>
								<?php while($row =  mysql_fetch_array($resultado)) { ?>
									<option value="<?php echo $row['id_ur']; ?>"><?php echo $row['ur']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						 <div class="form-group">
						<label for="ramo">Puesto<span class="form-text">*</span>:</label>
						<select name="cbx_puesto" id="cbx_puesto"  class='form-control'></select>
						</div>
					</div>
					<div class="col-md-4">
						 <div class="form-group">
							<label for="cod_puesot">Filiación<span class="form-text">*</span>:</label>	
							<input type="text" id="filiacion" name="filiacion" class="form-control"  maxlength="12" required>
						  </div>
					</div>						
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="cod_puesot">RUSP<span class="form-text"></span>:</label>	
						<input type="text" id="rusp" name="rusp" class="form-control" maxlength="15">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="cod_puesot">Motivo de ingreso<span class="form-text">*</span>:</label>	
							<?php
								$con9="SELECT id_mingreso,m_ingreso FROM tcat_motivo_ingreso";
								$res9=@mysql_query($con9);
								if(!$res9){
									echo " fallo";
								}
								else{							
									echo "<select id='combo10' name='combo10' class='form-control' >";
									echo "<option value='5'>Seleccione un motivo de ingreso</option>";
										while ($fila2=mysql_fetch_array($res9)){
											echo "<option value='".$fila2["id_mingreso"]."'>".$fila2["m_ingreso"]." </option>";
										}
									echo "</select>";
								}
							
								?>

					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="cod_puesot">Declaración patrimonial<span class="form-text">*</span>:</label>	
						<select name="depat" id="depat" class='form-control'>
								<option value="0"   >Seleccione una declaración patrimonial</option>
								<option value="N"   >N</option>
								<option value="S"   >S</option>
							</select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="cod_puesot">Motivo de la declaración<span class="form-text">*</span>:</label>	
							<?php
								$con9="SELECT id_mdeclaracion,motivo FROM tcat_motivo_declaracion";
								$res9=@mysql_query($con9);
								if(!$res9){
									echo " fallo";
								}
								else{							
									echo "<select id='combo11' name='combo11' class='form-control' >";
									echo "<option value='0'>Seleccione un motivo de la declaración de ss</option>";
										while ($fila2=mysql_fetch_array($res9)){
											echo "<option value='".$fila2["id_mdeclaracion"]."'>".$fila2["motivo"]." </option>";
										}
									echo "</select>";
								}
							
								?>

					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="cod_puesot">Descendencia<span class="form-text"></span>:</label>	
						<input type="text" id="descendencia" name="descendencia" class="form-control"  placeholder="Ej:HENG19041996HDF09,HONOA20031997...(Si escribe mas de un CURP)">
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group clearfix">
						<div class="form-control-lada">
								  <label for="lada">Dia de ingreso a APF<span class="form-text">*</span>:</label>
								  <select id="combo12" name="combo12" class='form-control'>
								 <option value="0">Seleccione Dia</option>
										 <?php									
											for($i=1;$i<=31;$i++){
												echo '<option value="'.$i.'">'.$i."</option>";
												
											}
									?>	 
									</select>
						</div>
						<div class="form-control-lada">
							  <label for="phone">Mes de ingreso a APF<span class="form-text">*</span>:</label>
								<select name="combo13" id="combo13" class='form-control'>
								<option value="0"   >Seleccione el mes</option>
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
								<label for="phone">Año de ingreso a APF<span class="form-text">*</span>:</label>
								<select name="combo14" id="combo14" class='form-control'>
								<option value="0"   >Seleccione el Año</option>
								<?php
								$year=date("Y");
								for($i=1960;$i<=$year;$i++){
									echo "<option value='".$i."'>".$i."</option>";
									
								}?>	 
								</select>
						</div>
					</div>
				</div>		
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group clearfix">
						<div class="form-control-lada">
								  <label for="lada">Dia de ingreso a SPC<span class="form-text"></span>:</label>
								  <select id="cmbdiaspc" name="cmbdiaspc" class='form-control'>
								 <option value="0">Seleccione Dia</option>
										 <?php									
											for($i=1;$i<=31;$i++){
												echo "<option value='".$i."'>".$i."</option>";
												
											}
									?>	 
									</select>
						</div>
						<div class="form-control-lada	">
							  <label for="phone">Mes de ingreso a SPC<span class="form-text"></span>:</label>
								<select name="combo16" id="combo16" class='form-control'>
								<option value="0"   >Seleccione el mes</option>
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
								<label for="phone">Año de ingreso a SPC<span class="form-text"></span>:</label>
								<select name="combo17" id="combo17" class='form-control'>
								<option value="0"   >Seleccione el Año</option>
								<?php
								$year=date("Y");
								for($i=1960;$i<=$year;$i++){
									echo "<option value='".$i."'>".$i."</option>";
									
								}?>	 
								</select>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group clearfix">
						<div class="form-control-lada">
								  <label for="lada">Dia de ingreso a SECTUR<span class="form-text">*</span>:</label>
								  <select id="combo18" name="combo18" class='form-control'>
								 <option value="0">Seleccione Dia</option>
										 <?php									
											for($i=1;$i<=31;$i++){
												echo "<option value='".$i."'>".$i."</option>";
												
											}
									?>	 
									</select>
						</div>
						<div class="form-control-lada">
							  <label for="phone">Mes de ingreso a SECTUR<span class="form-text">*</span>:</label>
								<select name="combo19" id="combo19" class='form-control'>
								<option value="0"   >Seleccione el mes</option>
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
								<label for="phone">Año de ingreso a SECTUR<span class="form-text"></span>:</label>
								<select name="combo20" id="combo20" class='form-control'>
								<option value="0"   >Seleccione el Año</option>
								<?php
								$year=date("Y");
								for($i=1960;$i<=$year;$i++){
									echo "<option value='".$i."'>".$i."</option>";
								}?>	 
								</select>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group clearfix">
						<div class="form-control-lada">
								  <label for="lada">Dia de motivo de declaración patrimonial<span class="form-text"></span>:</label>
								  <select id="combo21" name="combo21" class='form-control'>
								 <option value="0">Seleccione Dia</option>
										 <?php									
											for($i=1;$i<=31;$i++){
											echo "<option value='".$i."'>".$i."</option>";
												
											}
									?>	 
									</select>
						</div>
						<div class="form-control-lada">
							  <label for="phone">Mes de motivo de declaración patrimonial<span class="form-text"></span>:</label>
								<select name="combo22" id="combo22" class='form-control'>
								<option value="0"   >Seleccione el mes</option>
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
								<label for="phone">Año de motivo de declaracion patrimonial<span class="form-text"></span>:</label>
								<select name="combo23" id="combo23" class='form-control'>
								<option value="0"   >Seleccione el Año</option>
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
					<div class="form-group clearfix">
						<div class="form-control-lada">
								  <label for="lada">Dia de ingreso a la plaza<span class="form-text"></span>:</label>
								  <select id="combo24" name="combo24" class='form-control'>
								 <option value="0">Seleccione Dia</option>
										 <?php									
											for($i=1;$i<=31;$i++){
												echo '<option value="'.$i.'">'.$i."</option>";
												
											}
									?>	 
									</select>
						</div>
						<div class="form-control-lada">
							  <label for="phone">Mes de ingreso a la plaza<span class="form-text"></span>:</label>
								<select name="combo25" id="combo25" class='form-control'>
								<option value="0"   >Seleccione el mes</option>
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
								<label for="phone">Año de ingreso a la plaza<span class="form-text"></span>:</label>
								<select name="combo26" id="combo26" class='form-control'>
								<option value="0"   >Seleccione el Año</option>
								<?php
								$year=date("Y");
								for($i=1960;$i<=$year;$i++){
									echo '<option value="'.$i.'">'.$i."</option>";
									
								}?>	 
								</select>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group clearfix">
						<div class="form-control-lada">
								  <label for="lada">Dia de último puesto<span class="form-text">*</span>:</label>
								  <select id="combo27" name="combo27" class='form-control'>
								 <option value="0">Seleccione Dia</option>
										 <?php									
											for($i=1;$i<=31;$i++){
												echo '<option value="'.$i.'">'.$i."</option>";
												
											}
									?>	 
									</select>
						</div>
						<div class="form-control-lada">
							  <label for="phone">Mes de último puesto<span class="form-text">*</span>:</label>
								<select name="combo28" id="combo28" class='form-control'>
								<option value="0"   >Seleccione el mes</option>
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
								<label for="phone">Año de último puesto<span class="form-text">*</span>:</label>
								<select name="combo29" id="combo29" class='form-control'>
								<option value="0"   >Seleccione el Año</option>
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
				<div class="clearfix">
                <div class="pull-left text-muted text-vertical-align-button">
                  
                </div>

                <div class="pull-right">
						<input type="hidden" align="LEFT" name="id_empf" value="<?php echo $idemp;?>" />
						<input type="submit" value="guardar"  class="btn btn-primary pull-right" >
                </div>
              </div>
		</form>
		<script type="text/javascript">	
				function validarPlantilla(){
					
					var cmbmingr = document.getElementById('combo10').selectedIndex;
					var cmbdecpat = document.getElementById('depat').selectedIndex;
					var cmbmdec = document.getElementById('combo11').selectedIndex;
					var cmbdapf = document.getElementById('combo12').selectedIndex;
					var cmbmapf = document.getElementById('combo13').selectedIndex;
					var cmbyapf = document.getElementById('combo14').selectedIndex;
					var cmbdspc = document.getElementById('cmbdiaspc').selectedIndex;
					var cmbmspc = document.getElementById('combo16').selectedIndex;
					var cmbyspc = document.getElementById('combo17').selectedIndex;
					var cmbdsectur = document.getElementById('combo18').selectedIndex;
					var cmbmsectur = document.getElementById('combo19').selectedIndex;
					var cmbysectur = document.getElementById('combo20').selectedIndex;
					var cmbddepat = document.getElementById('combo21').selectedIndex;
					var cmbmdepat = document.getElementById('combo22').selectedIndex;
					var cmbydepat = document.getElementById('combo23').selectedIndex;
					var cmbdplaza = document.getElementById('combo24').selectedIndex;
					var cmbmplaza = document.getElementById('combo25').selectedIndex;
					var cmbyplaza = document.getElementById('combo26').selectedIndex;					
					var cmbdultpto = document.getElementById('combo27').selectedIndex;
					var cmbmultpto = document.getElementById('combo28').selectedIndex;
					var cmbyultpto = document.getElementById('combo29').selectedIndex;
					
					if(cmbmingr == 5){
						alert('ERROR: Debe de seleccionar una opciÓn en MOTIVO DE INGRESO');
						return false;
					}
					if(cmbdecpat == 0){
						alert('ERROR: Debe de seleccionar una opciÓn en DECLARACIÓN PATRIMONIAL');
						return false;
					}
					if(cmbmdec == 0){
						alert('ERROR: Debe de seleccionar una opciÓn en MOTIVO DE DECLARACION');
						return false;
					}
					if(cmbdapf == 0){
						alert('ERROR: Debe de seleccionar una opción en DIA DE INGRESO A APF');
						return false;
					}
					if(cmbmapf == 0){
						alert('ERROR: Debe de seleccionar una opcion en MES DE INGRESO A APF');
						return false;
					}
					
					if(cmbyapf == 0){
						alert('ERROR: Debe seleccionar una opcion en AÑO DE INGRESO A APF');
						return false;
					}
					if(cmbdspc == 0){
						alert('ERROR: Debe seleccionar una opcion en DIA DE INGRESO A SPC');
						return false;
					}
					if(cmbmspc == 0){
						alert('ERROR: Debe seleccionar una opcion en MES DE INGRESO A SPC');
						return false;
					}
					if(cmbyspc == 0){
						alert('ERROR: Debe seleccionar una opcion en AÑO DE INGRESO A SPC');
						return false;
					}
					if(cmbdsectur == 0){
						alert('ERROR: Debe seleccionar una opcion en DIA DE INGRESO A SECTUR');
						return false;
					}
					if(cmbmsectur == 0){
						alert('ERROR: Debe seleccionar una opcion en MES DE INGRESO A SECTUR');
						return false;
					}
					
					if(cmbysectur == 0){
						alert('ERROR: Debe seleccionar una opcion en AÑO DE INGRESO A SECTUR');
						return false;
					}
					if(cmbysectur == 0){
						alert('ERROR: Debe seleccionar una opcion en AÑO DE INGRESO A SECTUR');
						return false;
					}
					if(cmbysectur == 0){
						alert('ERROR: Debe seleccionar una opcion en AÑO DE INGRESO A SECTUR');
						return false;
					}
					if(cmbysectur == 0){
						alert('ERROR: Debe seleccionar una opcion en AÑO DE INGRESO A SECTUR');
						return false;
					}
					if(cmbysectur == 0){
						alert('ERROR: Debe seleccionar una opcion en AÑO DE INGRESO A SECTUR');
						return false;
					}
					if(cmbysectur == 0){
						alert('ERROR: Debe seleccionar una opcion en AÑO DE INGRESO A SECTUR');
						return false;
					}
					if(cmbysectur == 0){
						alert('ERROR: Debe seleccionar una opcion en AÑO DE INGRESO A SECTUR');
						return false;
					}
					if(cmbysectur == 0){
						alert('ERROR: Debe seleccionar una opcion en AÑO DE INGRESO A SECTUR');
						return false;
					}
					if(cmbysectur == 0){
						alert('ERROR: Debe seleccionar una opcion en AÑO DE INGRESO A SECTUR');
						return false;
					}
					if(cmbysectur == 0){
						alert('ERROR: Debe seleccionar una opcion en AÑO DE INGRESO A SECTUR');
						return false;
					}
					
				
					
					
					
					return true;
				}
			</script>
		
		
		
		</div>
		</body>
		</html>
		<?php
	}
	
	if(isset($_POST['id_empf'])){
			?>
		<html>
		<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
		</head>
		<body>
		
		<?php
		$idemp=$_POST['id_empf'];
		$pto=$_POST['cbx_puesto'];
		$filiacion=$_POST['filiacion'];
		$rusp=$_POST['rusp'];
		$mingreso=$_POST['combo10'];
		$depat=$_POST['depat'];
		$mdecla=$_POST['combo11'];
		$desc=$_POST['descendencia'];
		if($_POST['combo12']<10){
			$fiapf="0".$_POST['combo12']."/".$_POST['combo13']."/".$_POST['combo14'];
		}else{
			$fiapf=$_POST['combo12']."/".$_POST['combo13']."/".$_POST['combo14'];
		}
		if($_POST['cmbdiaspc']<10){
			$fispc="0".$_POST['cmbdiaspc']."/".$_POST['combo16']."/".$_POST['combo17'];
		}else{
			$fispc=$_POST['cmbdiaspc']."/".$_POST['combo16']."/".$_POST['combo17'];
		}
		if($_POST['combo18']<10){
			$fisectur="0".$_POST['combo18']."/".$_POST['combo19']."/".$_POST['combo20'];
		}else{
			$fisectur=$_POST['combo18']."/".$_POST['combo19']."/".$_POST['combo20'];
		}
		if($_POST['combo21']<10){
			$fdetpat="0".$_POST['combo21']."/".$_POST['combo22']."/".$_POST['combo23'];
		}else{
			$fdetpat=$_POST['combo21']."/".$_POST['combo22']."/".$_POST['combo23'];
		}
		if($_POST['combo24']<10){
			$fiplaza="0".$_POST['combo24']."/".$_POST['combo25']."/".$_POST['combo26'];
		}else{
			$fiplaza=$_POST['combo24']."/".$_POST['combo25']."/".$_POST['combo26'];
		}
		if($_POST['combo27']<10){
			$fupto="0".$_POST['combo27']."/".$_POST['combo28']."/".$_POST['combo29'];
		}else{
			$fupto=$_POST['combo27']."/".$_POST['combo28']."/".$_POST['combo29'];
		}
		
		
		$sql="insert into plantilla (id_empleado,filiacion,rusp,id_mingreso,declaracion_patri,id_mdeclaracion,descendencia,f_ingr_apf,f_ingr_spc,f_ingr_sectur,f_oblig_patri,id_puesto,f_ingr_plaza,f_ult_puesto,f_baja,id_baja)
		VALUES ('$idemp', '$filiacion', '$rusp', '$mingreso', '$depat', '$mdecla', '$desc', '$fiapf', '$fispc', '$fisectur', '$fdetpat', '$pto', '$fiplaza', '$fupto', '0', '0')";
		
		echo $pto;
		
		if(!@mysql_query($sql)){
		

			?>
				<div class="alert alert-danger">No se pudieron insertar correctamente los datos</div>
				<?php
			echo"no se actualizo el estatus del puesto";
		}else{
				$sql2="UPDATE puestos set
					id_eocupacional='1'
					where id_puesto='".$pto."'";
					if((@mysql_query($sql2))){
						?>
						
							
						<div class="alert alert-success">Datos insertados correctamente</div>
							<form method='post' action='' class='form-horizontal' role='form'> \n
						  <input type='hidden' name='idemp1' value="<?php echo $idemp;?>">
						  <input type='submit' class='btn btn-default' value='siguiente'> 
						  </form>
						  </body>
						  </html>
						<?php
					}else{
									?>
								<div class="alert alert-danger">No se actualizo el estatus del puesto seleccionado</div>
								<?php
					}
					
		}	
		
	}
	if(isset($_POST['idemp1'])){
		$idemp1=$_POST['idemp1'];
		?>
		<html>
		<head>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
			<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
		</head>
		<body>
		<div class="bottom-buffer">
			<form method='post' action='' class='clearfix' role='form' onsubmit="return validarIdioma()">
				<div class="row">
					<div class="col-md-4">
					</div>
					<div class="col-md-4">
						<div class="form-control-lada">
							<label for="phone">Idioma<span class="form-text">*</span>:</label>
							<select name="combo30" id="combo30" class='form-control'>
								<option value="0"   >Seleccione un idioma</option>
									<?php
									$sql="Select id_idioma,idioma from tcat_idiomas order by idioma asc";
									$resultado=@mysql_query($sql);
									if($resultado){
										
										
										while($row= mysql_fetch_array($resultado)){
										echo '<option value="'.$row['id_idioma'].'">'.$row['idioma']."</option>";
										}		
									}else{
										echo "fallo";
									}
									 ?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
					</div>
					<div class="col-md-4">
						<div class="form-control-lada">
							<label for="phone">Nivel<span class="form-text">*</span>:</label>
							<select name="combo31" id="combo31" class='form-control'>
								<option value="0"   >Seleccione el idioma que habla la persona</option>
								<option value="A"   >Aprendido</option>
								<option value="M"   >Materno</option>
							</select>
						</div>
					</div>
				</div>
				  <div class="pull-right">
						<input type="hidden" align="LEFT" name="id_empf1" value="<?php echo $idemp1;?>" />
						<input type="submit" value="guardar"  class="btn btn-primary pull-right">
                </div>
			</form>
			<script type="text/javascript">	
				function validarIdioma(){
					var cmbidioma = document.getElementById('combo30').selectedIndex;
					var cmbnivel = document.getElementById('combo31').selectedIndex;
			 
				
			 
					//Test comboBoxsexo
					if(cmbidioma == null || cmbidioma == 0){
						alert('ERROR: Debe seleccionar un idioma');
						return false;
					}
					//Test comboBoxenac
					if(cmbnivel == null || cmbnivel == 0){
						alert('ERROR: Debe seleccionar un nivel');
						return false;
					}
					
					
					return true;
				}
			</script>
	
		</div>
		</body>
		</html>
		
		<?php
	}
	if(isset($_POST['id_empf1'])){
	?>
		<html>
		<head>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
			<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
		</head>
		<body>
			<?php
							$idioma=$_POST['combo30'];
							$nivel=$_POST['combo31'];
							$idemp=$_POST['id_empf1'];
							$sql="insert into persona_idiomas(id_persona,id_idioma,nivel) values('$idemp','$idioma','$nivel')";
							$resultado= @mysql_query($sql);
							if(!$resultado){
								?>
									<div class="alert alert-danger">No se pudieron insertar correctamente los datos</div>
									<?php
							}else{
								?>
								
								
					<div class="alert alert-success">Datos insertados correctamente</div>
						<form method='post' action='' class='form-horizontal' role='form'> \n
					  <input type='hidden' name='idemp1' value="<?php echo $idemp;?>">
					  <input type='submit' class='btn btn-default' value='Añadir otro idioma'> 
					  </form>
					  <form method='post' action='' class='form-horizontal' role='form'> \n
					  <input type='hidden' name='idemp2' value="<?php echo $idemp;?>">
					  <input type='submit' class='btn btn-default' value='Terminar el proceso'> 
					  </form>
					  </body>
					  </html>
					  <?php
			
							}	


			}
	if(isset($_POST['idemp2'])){
		
		?>
		<html>
		<head>
			<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
			<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
		</head>
		<body>
		<div class="alert alert-success">Proceso de alta finalizado</div>
			<?php
	}
}
	

	
		
	
		
mysql_close($conexion); 
?>