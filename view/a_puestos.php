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
		<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
		<title>Datos del puesto a insertar</title>
		</head>
				<body>
				<form name="buttonbar" class="clearfix" >
				<input type="button" class="btn btn-default" value="Volver" onclick="location='c_puestos.php'">
			 </form>
				 <h3><center>DATOS DE PUESTO DEL SPC</h3>
					  <div class="bottom-buffer">
				<form role="form"  action="" class="clearfix"  method="post"   onsubmit="return validarDatos1()">
				  
					
					<div class="col-md-4">
					  <div class="form-group">
						<label for="ramo">Ramo<span class="form-text">*</span>:</label>
						<?php				
						$con2="SELECT id_ramo,ramo FROM tcat_ramo";
						$res2=@mysql_query($con2);
						if(!$res2){
							echo " fallo";
						}
						else{				
							echo "<select name='cmbramo' id='cmbramo' class='form-control'>";
							echo "<option value='0'>Selecciona el ramo</option>";
							while ($fila2=mysql_fetch_array($res2)){
								echo "<option value=".$fila2['id_ramo'].">".$fila2['ramo']." </option>";
							}
							echo "</select>";
						}
						?>

					  </div>
					</div>
					 <div class="col-md-4">
					  <div class="form-group">
						 <label for="secondName">Unidad de Adscripcion:<span class="form-text">*</span>:</label>
						<?php
							$con3="SELECT id_ur,ur FROM tcat_ur order by ur asc";
							$res3=@mysql_query($con3);
							if(!$res3){
								echo " fallo";
							}
							else{
							
								echo "<select name='cmbur' id='cmbur' class='form-control'>";
								echo "<option value='0'>Selecciona la unidad de adscripción</option>";
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
						<label for="deno_puesto">Denominacion de  puesto<span class="form-text">*</span>:</label>
						<input type="text" name="deno_puesto" class="form-control"  placeholder="Ingresa la denominacion del puesto" required>
					  </div>
					</div>
					 <div class="col-md-4">
					  <div class="form-group">
						<label for="secondName">Referencia tabular<span class="form-text">*</span>:</label>
										<?php
							$con2="SELECT id_rtabular,r_tabular FROM tcat_rtabular where id_rtabular>0";
							$res2=@mysql_query($con2);
							if(!$res2){
								echo " fallo";
							}
							else{
							
								echo "<select name='cmbrtabular' id='cmbrtabular' class='form-control'>";
								echo "<option value='0'>Selecciona la referencia tabular</option>";
								while ($fila2=mysql_fetch_array($res2)){
									echo "<option value=".$fila2['id_rtabular'].">".$fila2['r_tabular']." </option>";
								}
								echo "</select>";
							}
							?>

					  </div>
					</div>
					 <div class="col-md-4">
					  <div class="form-group">
						 <label for="secondName">Consecutivo<span class="form-text">*</span>:</label>
							<input type="text" name="consecutivo" id="consecutivo" class="form-control" placeholder="Ingresa el onsecutivo del puesto" maxlength="3" required>
					  </div>
					</div>
				  

					<div class="col-md-4">
						<div class="form-group clearfix">
							<div class="form-control-lada">
						 <label for="secondName">Tipo_plaza<span class="form-text">*</span>:</label>
							<?php
							$con4="SELECT id_tplaza,tipo_plaza	FROM tcat_tipo_plaza";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbtplaza' id='cmbtplaza' class='form-control'>";
								echo "<option value='0'>Selecciona el tipo de plaza</option>";
								while ($fila2=mysql_fetch_array($res4)){
									echo "<option value=".$fila2['id_tplaza'].">".$fila2['tipo_plaza']." </option>";
								}
								echo "</select>";
							}
							?>
							</div>
							<div class="form-control-lada">
								   <label for="secondName">Caracter<span class="form-text">*</span>:</label>
						<input type="text" name="c_ocupacional" class="form-control" maxlength="1" placeholder="Ingresa el caracter del puesto"required>
							</div>
							<div class="form-control-lada">
							<label for="secondName">Literal de función<span class="form-text">*</span>:</label>
									<?php
							$con4="SELECT id_literal,literal_funcion,clasif_funcion,desc_funcion FROM tcat_literales where id_literal>0";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbliteral' id='cmbliteral' class='form-control'>";
								echo "<option value='0'>Selecciona la literal de funcion</option>";
								while ($fila2=mysql_fetch_array($res4)){
									echo "<option value=".$fila2['id_literal'].">".$fila2['literal_funcion']." ".$fila2['clasif_funcion']." ".$fila2['desc_funcion']." </option>";
								}
								echo "</select>";
							}
							?>
							</div>
						</div>
					</div>				
					 <div class="col-md-4">
					  <div class="form-group">
						 <label for="secondName">Tipo de función:<span class="form-text">*</span>:</label>
								<?php
							$con4="SELECT id_funcion,tipo_funcion FROM tcat_tipo_funcion";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbtfuncion' id='cmbtfuncion' class='form-control'>";
								echo "<option value='0'>Selecciona el tipo de funcion</option>";
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
							$con4="SELECT id_nsalarial,n_salarial,tipo	FROM tcat_nivel_salarial where id_nsalarial<181";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
							
								echo "<select name='cmbnsalarial' id='cmbnsalarial' class='form-control'>";
								echo "<option value='0'>Selecciona el nivel salarial</option>";
								while ($fila2=mysql_fetch_array($res4)){
									echo "<option value=".$fila2['id_nsalarial'].">".$fila2['n_salarial']." ".$fila2['tipo']." </option>";
								}
								echo "</select>";
							}
							?>
					  </div>
					</div>
				   
					
				  <br>
				
				  <div class="col-md-4">
					  <div class="form-group">
						<label for="secondName">Tabulador:<span class="form-text">*</span>:</label>
						<input type="text" name="tabulador" id="tabulador" class="form-control" placeholder="Ingresa el tabulador del puesto" maxlength="3" required>
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						 <label for="secondName">Codigo presupuestal:<span class="form-text">*</span>:</label>
							<input type="text" name="c_presupuestal"  class="form-control" placeholder="Ingresa el codigo presupuestal del puesto" maxlength="10"	 required>
					  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						  <label for="secondName">Ordinal CP:<span class="form-text">*</span>:</label>
						<input type="text" name="ordinal_cp" id="ordinal_cp" class="form-control" placeholder="Ingresa el ordinal_cp del puesto" maxlength="1" required>
					  </div>
					 </div>
					 
					<div class="col-md-4">
						  <div class="form-group">
							  <label for="secondName">Plaza de subordinados:<span class="form-text">*</span>:</label>
								<input type="text" name="p_subordinados" id="p_subordinados" placeholder="Ingresa el número de plazas subordinadas del puesto" class="form-control" required>
						  </div>
					</div>
					
				
					<div class="col-md-4">
						  <div class="form-group">
							<label for="secondName">Aspectos revelantes:<span class="form-text">*</span>:</label>
							<input type="text" name="a_revelantes" class="form-control"placeholder="Ingresa los aspectos revelantes del puesto"  required>
						  </div>
					</div>
					<div class="col-md-4">
						  <div class="form-group">
							 <label for="secondName">Entidad relacionada:<span class="form-text">*</span>:</label>
									<input type="text" name="e_relacionada" class="form-control" placeholder="Ingresa la entidad relacionada del puesto" required>
						  </div>
					</div>
					<div class="col-md-4">
					  <div class="form-group">
						  <label for="secondName">Nivel de escolaridad:<span class="form-text">*</span>:</label>
									<?php
							$con4="SELECT id_escolaridad,nive_e,estatus_e FROM tcat_escolaridad";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbescolaridad' id='cmbescolaridad' class='form-control'>";
								echo "<option value='0'>Selecciona un nivel de escolaridad</option>";
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
						<input type="text" name="a_experiencia" id="a_experiencia" class="form-control" placeholder="Ingresa los años de experiencia  del puesto"maxlength="2" required>
					  </div>
					</div> 
					<div class="col-md-4">
					  <div class="form-group">
						<label for="secondName">Tipificacion actual:<span class="form-text">*</span>:</label>
							<?php
							$con4="SELECT id_tactual,tipificacion_actual FROM tcat_tipificacion_actual where id_tactual>0";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbtactual' id='cmbtactual' class='form-control'>";
								echo "<option value='0'>Selecciona una tipificacion actual</option>";
								while ($fila2=mysql_fetch_array($res4)){
									echo "<option value=".$fila2['id_tactual'].">".$fila2['tipificacion_actual']."</option>";
								}
								echo "</select>";
							}
							?>
					  </div>
					</div> 
					<div class="col-md-4">
					  <div class="form-group">
						<label for="secondName">Tipo de ingreso a la plaza:<span class="form-text">*</span>:</label>
						<?php
							$con4="SELECT id_ingr_plaza,t_ingr_plaza FROM tcat_tipo_ingreso_plaza where id_ingr_plaza>0";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbtingr' id='cmbtingr' class='form-control'>";
								echo "<option value='0'>Selecciona un tipo de ingreso a la plaza</option>";
								while ($fila2=mysql_fetch_array($res4)){
									echo "<option value=".$fila2['id_ingr_plaza'].">".$fila2['t_ingr_plaza']."</option>";
								}
								echo "</select>";
							}
							?>
					  </div>
					</div> 
					<div class="col-md-4">
					<div class="form-group">
						<label for="deno_puesto"´>Puesto Jefe<span class="form-text">*</span>:</label>
						<?php
							$con4="SELECT id_puesto,deno_puesto,consecutivo FROM puestos where codigo_puesto<>'' order by deno_puesto";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbpjefe' id='cmbpjefe' class='form-control'>";
								echo "<option value='0'>Selecciona un puesto jefe</option>";
								while ($fila2=mysql_fetch_array($res4)){
									echo "<option value=".$fila2['id_puesto'].">".$fila2['deno_puesto']." ".$fila2['consecutivo']."</option>";
								}
								echo "</select>";
							}
							?>
					</div>                 
			</div>
					<div class="clearfix">
					<div class="pull-left text-muted text-vertical-align-button">
					  * Campos obligatorios
					</div>

					<div class="pull-right">
							
							<input type="submit" value="SIGUIENTE" class="btn btn-primary pull-right" name="guardarpuesto">
					</div>
				  </div>
						
						
				</form>
		<script type="text/javascript">	
		function validarDatos1(){
			var txtcons = document.getElementById('consecutivo').value;
			var txttabu = document.getElementById('tabulador').value;
			var txtaexp = document.getElementById('a_experiencia').value;
			var txtocp = document.getElementById('ordinal_cp').value;
			var txtpsub = document.getElementById('p_subordinados').value;
			var ramo = document.getElementById('cmbramo').selectedIndex;
			var ur = document.getElementById('cmbur').selectedIndex;
			var rtabular = document.getElementById('cmbrtabular').selectedIndex;
			var tplaza = document.getElementById('cmbtplaza').selectedIndex;
			var literal = document.getElementById('cmbliteral').selectedIndex;
			var tfuncion = document.getElementById('cmbtfuncion').selectedIndex;
			var nsalarial = document.getElementById('cmbnsalarial').selectedIndex;
			var esco = document.getElementById('cmbescolaridad').selectedIndex;
			var tactual = document.getElementById('cmbtactual').selectedIndex;
			var tingr = document.getElementById('cmbtingr').selectedIndex;
			var pjefe = document.getElementById('cmbpjefe').selectedIndex;
		
			if(ramo == null || ramo == 0){
				alert('ERROR: Debe seleccionar una opcion en RAMO');
				return false;
			}
			
			if(ur == null || ur == 0){
				
				alert('ERROR: Debe seleccionar una opcion en UNIDAD DE ADSCRIPCIÓN');
				return false;
			}
			if(rtabular == null || rtabular == 0){
				alert('ERROR: Debe seleccionar una opcion en REFERENCIA TABULAR');
				return false;
			}
			
			if(isNaN(txtcons)){
				alert('ERROR: Dato no válido en el CONSECUTIVO');
				return false;
			}
			if(tplaza == null || tplaza == 0){
				alert('ERROR: Debe seleccionar una opcion en TIPO DE PLAZA');
				return false;
			}
			if(literal == null || literal == 0){
				alert('ERROR: Debe seleccionar una opcion en LITERAL');
				return false;
			}
			
			if(tfuncion == null || tfuncion == 0){
				alert('ERROR: Debe seleccionar una opcion en TIPO DE FUNCION');
				return false;
			}
			if(nsalarial == null || nsalarial == 0){
				alert('ERROR: Debe seleccionar una opcion en NIVEL SALARIAL');
				return false;
			}
			
			if(isNaN(txttabu)){
				alert('ERROR: Dato no válido en el TABULADOR');
				return false;
			}
			
			if(isNaN(txtocp)){
				alert('ERROR: Dato no válido en el ORDINAL CP');
				return false;
			}
			if(isNaN(txtaexp)){
				alert('ERROR: Dato no válido en el AÑOS DE EXPERIENCIA');
				return false;
			}
		
			if(isNaN(txtpsub)){
				alert('ERROR: Dato no válido en el PLAZA SUBORDINADOS');
				return false;
			}
			if(esco == null || esco == 0){
				alert('ERROR: Debe seleccionar una opcion en NIVEL ESCOLARIDAD');
				return false;
			}
			if(tactual == null || tactual == 0){
				alert('ERROR: Debe seleccionar una opcion en TIPIFICACION ACTUAL');
				return false;
			}
			if(tingr == null || tingr == 0){
				alert('ERROR: Debe seleccionar una opcion en TIPO DE INGRESO LA PLAZA');
				return false;
			}
			if(pjefe == null || pjefe == 0){
				alert('ERROR: Debe seleccionar una opcion en PUESTO JEFE');
				return false;
			}
			
			return true;
		};
		</script>
			  </div>

				</body>
				</html>
				
	<?php
	}else{
		if(isset($_POST["guardarpuesto"])){
		echo "ventana nueva";
		$ramo=$_POST['cmbramo'];
		$deno_puesto=$_POST['deno_puesto'];
		$ur=$_POST['cmbur'];
		$rtabular=$_POST['cmbrtabular'];
		$consecutivo=$_POST['consecutivo'];
		$tplaza=$_POST['cmbtplaza'];
		$c_ocupacional=$_POST['c_ocupacional'];
		$literal=$_POST['cmbliteral'];
		$tfuncion=$_POST['cmbtfuncion'];
		$nsalarial=$_POST['cmbnsalarial'];
		$tabulador=$_POST['tabulador'];
		$c_presupuestal=$_POST['c_presupuestal'];
		$ordinal_cp=$_POST['ordinal_cp'];
		$status='2';
		$p_subordinados=$_POST['p_subordinados'];
		$a_revelantes=$_POST['a_revelantes'];
		$e_relacionada=$_POST['e_relacionada'];
		$escolaridad=$_POST['cmbescolaridad'];
		$a_experiencia=$_POST['a_experiencia'];
		$tactual=$_POST['cmbtactual'];
		$tingr=$_POST['cmbtingr'];
		$pjefe=$_POST['cmbpjefe'];
		?>
		 <html>
				 <head> 
					<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
					<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
					<title>Datos del puesto de RUSP</title>
					<script language="javascript" src="js/jquery-3.3.1.min.js"></script>
		<script language="javascript">
			$(document).ready(function(){
				$("#cmbent").change(function () {					
					$("#cmbent option:selected").each(function () {
						ent = $(this).val();
						$.post("getPaises1.php", { ent: ent }, function(data){
							$("#cmbpais").html(data);
						});            
					});
				})
			});
			
		
		</script>
		</head>
				<body>
				 <h3><center>DATOS DE PUESTO DE RUSP</h3>
					  <div class="bottom-buffer">
				<form role="form"  action="" class="clearfix"  method="post"  onsubmit="return validarDatos2()" >
					
				<div class="col-md-4">
					<div class="form-group">
						<label for="deno_puesto">NOPLAUNI<span class="form-text">*</span>:</label>
						<input type="text" name="noplauni" class="form-control" required>
					</div>
				 </div>
				 <div class="col-md-4">
					<div class="form-group">
						<label for="deno_puesto">Consecutivo general<span class="form-text">*</span>:</label>
						<input type="text" name="cons_gral" id="cons_gral" class="form-control" maxlength="3" required>
					</div>                 
				 </div>
				 <div class="col-md-4">
					<div class="form-group">
						<label for="deno_puesto">Consecutivo de jefe<span class="form-text">*</span>:</label>
						<input type="text" name="cons_jefe" id="cons_jefe" class="form-control" maxlength="3" required>
					</div>                 
				 </div>  
					<div class="col-md-4">
					<div class="form-group">
						<label for="deno_puesto"´>PTO<span class="form-text">*</span>:</label>
						<input type="text" name="pto" class="form-control" maxlength="10" required>
					</div>                 
				 </div> 
				   <div class="col-md-4">
					  <div class="form-group">
						  <label for="secondName">Zona economica de RUSP:<span class="form-text">*</span>:</label>
						<?php
							$con4="SELECT id_ze,z_economica FROM tcat_zona_economica where id_ze>0";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
							
								echo "<select name='cmbzerusp' id='cmbzerusp' class='form-control'>";
								echo "<option value='0'>Seleccione una zona economica</option>";
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
						<label for="deno_puesto"´>Entidad de la plaza<span class="form-text">*</span>:</label>
						<?php
							$con4="SELECT id_ef,entidad FROM tcat_entidades_federativas";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbent' id='cmbent' class='form-control'>";
								echo "<option value='0'>Seleccione una entidad</option>";
								while ($fila2=mysql_fetch_array($res4)){
									echo "<option value=".$fila2['id_ef'].">".$fila2['entidad']."</option>";
								}
								echo "</select>";
							}
							?>
					</div>                 
				 </div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="deno_puesto"´>Pais de la plaza<span class="form-text">*</span>:</label>
							<select name="cmbpais" id="cmbpais"  class='form-control'></select>
					</div>                 
				 </div>
				 <div class="col-md-4">
					<div class="form-group">
						<label for="deno_puesto"´>Puesto estratégico<span class="form-text">*</span>:</label>
						<?php
							$con4="SELECT id_pestrategico,p_estrategico FROM tcat_tipo_puesto_estrategico";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbpestra' id='cmbpestra' class='form-control'>";
								echo "<option value='0'>Seleccione un puesto estrategico</option>";
								while ($fila2=mysql_fetch_array($res4)){
									echo "<option value=".$fila2['id_pestrategico'].">".$fila2['p_estrategico']."</option>";
								}
								echo "</select>";
							}
							?>
					</div>
					
				 </div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="deno_puesto"´>Tipo de contratación<span class="form-text">*</span>:</label>
						<?php
							$con4="SELECT id_tcontratacion,t_contratacion FROM tcat_tipo_contratacion";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbtcontra' id='cmbtcontra' class='form-control'>";
								echo "<option value='0'>Seleccione un tipo de contratacion</option>";
								while ($fila2=mysql_fetch_array($res4)){
									echo "<option value=".$fila2['id_tcontratacion'].">".$fila2['t_contratacion']."</option>";
								}
								echo "</select>";
							}
							?>
					</div>                 
				 </div>
					<div class="col-md-4">
					<div class="form-group">
						<label for="deno_puesto">Sueldo mensual<span class="form-text">*</span>:</label>
						<input type="text" name="sdo_men"  id="sdo_men" class="form-control"  maxlength="8" required>
					</div>                 
				 </div> 
				<div class="col-md-4">
					<div class="form-group">
						<label for="deno_puesto">CG_MENS<span class="form-text">*</span>:</label>
						<input type="text" name="cg_mens" id="cg_mens" class="form-control" maxlength="8" >
					</div>                 
				 </div> 
				<div class="col-md-4">
					<div class="form-group">
						<label for="deno_puesto"´>Tipo de personal<span class="form-text">*</span>:</label>
						<?php
							$con4="SELECT id_tpersonal,tipo_personal FROM tcat_tipo_personal";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbtpersonal' id='cmbtpersonal' class='form-control'>";
								echo "<option value='0'>Seleccione un tipo de personal</option>";
								while ($fila2=mysql_fetch_array($res4)){
									echo "<option value=".$fila2['id_tpersonal'].">".$fila2['tipo_personal']."</option>";
								}
								echo "</select>";
							}
							?>
					</div>                 
				 </div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="deno_puesto"´>RFI_RIUF<span class="form-text">*</span>:</label>
						<?php
							$con4="SELECT id_rfi_riuf,clv_rfi_riuf,institucion,colonia FROM rfi_riuf";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbrfi' id='cmbrfi' class='form-control'>";
								echo "<option value='0'>Seleccione un rfi</option>";
								while ($fila2=mysql_fetch_array($res4)){
									echo "<option value=".$fila2['id_rfi_riuf'].">".$fila2['clv_rfi_riuf']." ".$fila2['institucion']." ".$fila2['colonia']."</option>";
								}
								echo "</select>";
							}
							?>
					</div>                 
				 </div>
			<div class="col-md-4">
					<div class="form-group">
						<label for="deno_puesto"´>Tipo de servidor<span class="form-text">*</span>:</label>
						<?php
							$con4="SELECT id_tservidor,clv_tservidor,t_servidor FROM tcat_tipo_servidor_publico";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbtservidor' id='cmbtservidor' class='form-control'>";
								echo "<option value='0'>Seleccione un tipo de servidor</option>";
								while ($fila2=mysql_fetch_array($res4)){
									echo "<option value=".$fila2['id_tservidor'].">".$fila2['clv_tservidor']."</option>";
								}
								echo "</select>";
							}
							?>
					</div>                 
			</div>
			
			<div class="clearfix">
					<div class="pull-left text-muted text-vertical-align-button">
					  * Campos obligatorios
					</div>

					<div class="pull-right">
							 <input type='hidden' name='id' value="1">
							 <input type='hidden' name='ramo' value="<?php echo $ramo;?>">
							 <input type='hidden' name='deno_puesto' value="<?php echo $deno_puesto;?>">
							 <input type='hidden' name='ur' value="<?php echo $ur;?>">
							 <input type='hidden' name='rtabular' value="<?php echo $rtabular;?>">
							 <input type='hidden' name='consecutivo' value="<?php echo $consecutivo;?>">
							 <input type='hidden' name='tplaza' value="<?php echo $tplaza;?>">
							 <input type='hidden' name='c_ocupacional' value="<?php echo $c_ocupacional;?>">
							 <input type='hidden' name='literal' value="<?php echo $literal;?>">
							 <input type='hidden' name='tfuncion' value="<?php echo $tfuncion;?>">						 
							 <input type='hidden' name='nsalarial' value="<?php echo $nsalarial;?>">						 
							 <input type='hidden' name='tabulador' value="<?php echo $nsalarial;?>">						 
							 <input type='hidden' name='c_presupuestal' value="<?php echo $c_presupuestal;?>">						 
							 <input type='hidden' name='ordinal_cp' value="<?php echo $ordinal_cp;?>">						 					 
							 <input type='hidden' name='status' value="<?php echo $status;?>">						 
							 <input type='hidden' name='p_subordinados' value="<?php echo $p_subordinados;?>">						 
							 <input type='hidden' name='a_revelantes' value="<?php echo $a_revelantes;?>">						 
							 <input type='hidden' name='e_relacionada' value="<?php echo $e_relacionada;?>">						 
							 <input type='hidden' name='escolaridad' value="<?php echo $escolaridad;?>">						 
							 <input type='hidden' name='a_experiencia' value="<?php echo $a_experiencia;?>">						 
							 <input type='hidden' name='tactual' value="<?php echo $tactual;?>">						 
							 <input type='hidden' name='tingr' value="<?php echo $tingr;?>">						 
							 <input type='hidden' name='pjefe' value="<?php echo $pjefe;?>">						 
							<input type="submit" value="SIGUIENTE" class="btn btn-primary pull-right">
					</div>
			</div>  			 
				</form>
				<script type="text/javascript">	
		function validarDatos2(){
			var txtconsgral = document.getElementById('cons_gral').value;
			var txtconsjefe = document.getElementById('cons_jefe').value;
			var txtsdo = document.getElementById('sdo_men').value;
			var txtcg = document.getElementById('cg_mens').value;
			var zrusp = document.getElementById('cmbzerusp').selectedIndex;
			var entp = document.getElementById('cmbent').selectedIndex;
			var paisp = document.getElementById('cmbpais').selectedIndex;
			var pestra = document.getElementById('cmbpestra').selectedIndex;
			var tcontra = document.getElementById('cmbtcontra').selectedIndex;
			var tpersonal = document.getElementById('cmbtpersonal').selectedIndex;
			var rfi = document.getElementById('cmbrfi').selectedIndex;
			var tservidor = document.getElementById('cmbtservidor').selectedIndex;
					
			
			if(isNaN(txtconsgral)){
				alert('ERROR: Dato no válido en el CONSECUTIVO GENERAL');
				return false;
			}
			if(isNaN(txtconsjefe)){
				alert('ERROR: Dato no válido en el CONSECUTIVO JEFE');
				return false;
			}
			if(isNaN(txtsdo)){
				alert('ERROR: Dato no válido en el SUELDO');
				return false;
			}
			if(isNaN(txtcg)){
				alert('ERROR: Dato no válido en el CG MENS');
				return false;
			}
			if(zrusp == null || zrusp == 0){
				alert('ERROR: Debe seleccionar una opcion en ZONA ECONOMICA RUSP');
				return false;
			}if(entp == null || entp == 0){
				alert('ERROR: Debe seleccionar una opcion en ENTIPAD DE LA PLAZA');
				return false;
			}if(paisp == null || paisp == 0){
				alert('ERROR: Debe seleccionar una opcion en PAIS DE LA PLAZA');
				return false;
			}if(pestra == null || pestra == 0){
				alert('ERROR: Debe seleccionar una opcion en PUESTO ESTRATEGICO');
				return false;
			}if(tcontra == null || tcontra == 0){
				alert('ERROR: Debe seleccionar una opcion en TIPO DE CONTRATACION');
				return false;
			}if(tpersonal == null || tpersonal == 0){
				alert('ERROR: Debe seleccionar una opcion en TIPO DE PERSONAL');
				return false;
			}if(rfi == null || rfi == 0){
				alert('ERROR: Debe seleccionar una opcion en RFI_RIUF');
				return false;
			}if(t_servidor == null || tservidor == 0){
				alert('ERROR: Debe seleccionar una opcion en TIPO DE SERVIDOR');
				return false;
			}
			
			return true;
		}
		</script>
				
				</div>
		
				</body>
		<?php
	}
	if(isset($_POST['id'])){
			?>
		<html>
		<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
		</head>
		<body>
		
		<?php
		$ramo=$_POST['ramo'];
		$deno_puesto=strtoupper($_POST['deno_puesto']);
		$ur=$_POST['ur'];
		$rtabular=$_POST['rtabular'];
		$ze=1;
		$consecutivo=$_POST['consecutivo'];
		$tplaza=$_POST['tplaza'];
		$c_ocupacional=strtoupper($_POST['c_ocupacional']);
		$literal=$_POST['literal'];
		$tfuncion=$_POST['tfuncion'];
		$nsalarial=$_POST['nsalarial'];
		$tabulador=$_POST['tabulador'];
		$c_presupuestal=strtoupper($_POST['c_presupuestal']);
		$ordinal_cp=$_POST['ordinal_cp'];
		$status='2';
		$p_subordinados=$_POST['p_subordinados'];
		$a_revelantes=strtoupper($_POST['a_revelantes']);
		$e_relacionada=strtoupper($_POST['e_relacionada']);
		$escolaridad=$_POST['escolaridad'];
		$a_experiencia=$_POST['a_experiencia'];
		$tactual=$_POST['tactual'];
		$tingr=$_POST['tingr'];
		$noplauni=strtoupper($_POST['noplauni']);
		$cons_gral=$_POST['cons_gral'];
		$cons_jefe=$_POST['cons_jefe'];
		$pto=strtoupper($_POST['pto']);
		$zerusp=$_POST['cmbzerusp'];
		$pestra=$_POST['cmbpestra'];
		$tcontra=$_POST['cmbtcontra'];
		$sdo_men=$_POST['sdo_men'];
		$cg_mens=$_POST['cg_mens'];
		$tpersonal=$_POST['cmbtpersonal'];
		$rfi=$_POST['cmbrfi'];
		$tservidor=$_POST['cmbtservidor'];
		$ent_plaza=$_POST['cmbent'];
		$pais_plaza=$_POST['cmbpais'];
		$pjefe=$_POST['pjefe'];
		$sql="select r_tabular from tcat_rtabular where id_rtabular=$rtabular";
		$sql2="select tipo_plaza from tcat_tipo_plaza where id_tplaza=$tplaza";
		$sql3="select literal_funcion from tcat_literales where id_literal=$literal";
		$sql4="select n_salarial from tcat_nivel_salarial where id_nsalarial=$nsalarial";
		$bus1=@mysql_query($sql);
		$bus2=@mysql_query($sql2);
		$bus3=@mysql_query($sql3);
		$bus4=@mysql_query($sql4);
		$row1=mysql_fetch_array($bus1);
		$row2=mysql_fetch_array($bus2);
		$row3=mysql_fetch_array($bus3);
		$row4=mysql_fetch_array($bus4);
		if($consecutivo<10){
			$codigo_puesto=$ramo."-".$ur."-".$ze."-".$row1['r_tabular']."-00000".$consecutivo."-".$row2['tipo_plaza']."-".$c_ocupacional."-".$row3['literal_funcion'];
		}
		if($consecutivo<100 and $consecutivo>=10){
			$codigo_puesto=$ramo."-".$ur."-".$ze."-".$row1['r_tabular']."-0000".$consecutivo."-".$row2['tipo_plaza']."-".$c_ocupacional."-".$row3['literal_funcion'];
		}
		if($consecutivo<1000 and $consecutivo>=100){
			$codigo_puesto=$ramo."-".$ur."-".$ze."-".$row1['r_tabular']."-000".$consecutivo."-".$row2['tipo_plaza']."-".$c_ocupacional."-".$row3['literal_funcion'];
		}
		$grupo=substr($row4['n_salarial'], 0,1);
		$grado=substr($row4['n_salarial'], 1,1);
		$nivel=substr($row4['n_salarial'], 2,1);
		$ultres="select MAX(id_puesto) as id from puestos";
		$bus1=@mysql_query($ultres);
		$row1=mysql_fetch_array($bus1);
		$id=$row1['id']+1;
	$sql="INSERT INTO puestos (id_puesto,deno_puesto,codigo_puesto,id_ramo,id_ur,id_ze,id_ze_rusp,id_rtabular,consecutivo,id_tplaza,c_ocupacional,id_literal,id_funcion,id_nsalarial,tabulador,c_presupuestal,ordinal_cp,grupo,grado,nivel,id_eocupacional,p_subordinados,a_revelantes,e_relacionada,id_escolaridad,anio_experiencia,noplauni,cons_gral,cons_jefe,pto,id_ent_plaza,id_pais_plaza,id_pestrategico,id_tactual,id_tcontratacion,id_ingr_plaza,sdo_men,cg_mens,id_tpersonal,id_rfi_riuf,id_tservidor,id_pjefe,observaciones)
		VALUES('$id','$deno_puesto','$codigo_puesto','$ramo','$ur','$ze','$zerusp','$rtabular','$consecutivo','$tplaza','$c_ocupacional','$literal','$tfuncion','$nsalarial','$tabulador','$c_presupuestal','$ordinal_cp','$grupo','$grado','$nivel','$status','$p_subordinados','$a_revelantes','$e_relacionada','$escolaridad','$a_experiencia','$noplauni','$cons_gral','$cons_jefe','$pto','$ent_plaza','$pais_plaza','$pestra','$tactual','$tcontra','$tingr','$sdo_men','$cg_mens','$tpersonal','$rfi','$tservidor', '$pjefe','NA')";
		$ins=@mysql_query($sql);
		if(!$ins){
			echo "Los datos no se insertaron";
		}else{
						?>
				<div class="alert alert-success">Datos insertados correctamente</div>
				<form method='post' action='' class='form-horizontal' role='form'> 
			  <input type='hidden' name='puesto1' value="<?php echo $id;?>">
			  <input type='submit' class='btn btn-default' value='siguiente'> 
			  </form>
			  </body>
			  </html>
			<?php
		}
		
		
	}

	}

	?>