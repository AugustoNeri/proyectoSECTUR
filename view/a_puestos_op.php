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
				<form name="buttonbar" class="clearfix" >
				<input type="button" class="btn btn-default" value="Volver" onclick="location='c_puestos.php'">
			 </form>
				 <h3><center>DATOS DE PUESTO DE LOS OPERATIVOS</h3>
					  <div class="bottom-buffer">
				<form role="form"  action="" class="clearfix"  method="post"   onsubmit="return validarDatos3()">
				
				
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
							echo "<option value='0'>Selecciona un ramo</option>";
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
								echo "<option value='0'>Selecciona una unidad de adscripción</option>";
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
						<input type="text" name="deno_puesto" class="form-control" required>
					  </div>
					</div>
						 <div class="col-md-4">
					  	<div class="form-group">
						 <label for="secondName">Tipo_plaza<span class="form-text">*</span>:</label>
							<?php
							$con4="SELECT id_tplaza,tipo_plaza	FROM tcat_tipo_plaza";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbtplaza' id='cmbtplaza' class='form-control'>";
								echo "<option value='0'>Selecciona un tipo de plaza</option>";
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
						 <label for="secondName">Tipo de función:<span class="form-text">*</span>:</label>
								<?php
							$con4="SELECT id_funcion,tipo_funcion FROM tcat_tipo_funcion";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
								echo "<select name='cmbtfuncion' id='cmbtfuncion' class='form-control'>";
								echo "<option value='0'>Selecciona un tipo de funcion</option>";
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
							$con4="SELECT id_nsalarial,n_salarial,tipo	FROM tcat_nivel_salarial where id_nsalarial>=181";
							$res4=@mysql_query($con4);
							if(!$res4){
								echo " fallo";
							}
							else{
							
								echo "<select name='cmbnsalarial' id='cmbnsalarial' class='form-control'>";
								echo "<option value='0'>Selecciona un nivel salarial</option>";
								while ($fila2=mysql_fetch_array($res4)){
									echo "<option value=".$fila2['id_nsalarial'].">".$fila2['n_salarial']." ".$fila2['tipo']." </option>";
								}
								echo "</select>";
							}
							?>
					  </div>
					</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="deno_puesto">NOPLAUNI<span class="form-text">*</span>:</label>
						<input type="text" name="noplauni" class="form-control" maxlength="12" required>
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
					</div></div>
					
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
							
								echo "<select name='cmbzeco' id='cmbzeco' class='form-control'>";
								echo "<option value='0'>Selecciona una zona economica</option>";
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
						<input type="text" name="cg_mens" id="cg_mens" class="form-control" maxlength="8" required>
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
							<input type="submit" value="GUARDAR" class="btn btn-primary pull-right" name="guardarpuesto1">
					</div>
			</div> 
		</form>
		
		
		<script type="text/javascript">	
		function validarDatos3(){
			var txtconsgral = document.getElementById('cons_gral').value;
			var txtconsjefe = document.getElementById('cons_jefe').value;
			var txtsdo = document.getElementById('sdo_men').value;
			var txtcg = document.getElementById('cg_mens').value;
			var ramo = document.getElementById('cmbramo').selectedIndex;
			var tplaza = document.getElementById('cmbtplaza').selectedIndex;
			var ur = document.getElementById('cmbur').selectedIndex;
			var zrusp = document.getElementById('cmbzeco').selectedIndex;
			var entp = document.getElementById('cmbent').selectedIndex;
			var paisp = document.getElementById('cmbpais').selectedIndex;
			var pestra = document.getElementById('cmbpestra').selectedIndex;
			var tcontra = document.getElementById('cmbtcontra').selectedIndex;
			var tfuncion = document.getElementById('cmbtfuncion').selectedIndex;
			var nsalarial = document.getElementById('cmbnsalarial').selectedIndex;
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
			if(ramo == null || ramo == 0){
				alert('ERROR: Debe seleccionar una opcion en RAMO');
				return false;
			}
			if(ur == null || ur == 0){
				alert('ERROR: Debe seleccionar una opcion en UNIDAD DE ADSCRIPCIÓN');
				return false;
			}
			if(zrusp == null || zrusp == 0){
				alert('ERROR: Debe seleccionar una opcion en Zona economica de RUSP');
				return false;
			}
			if(tplaza == null || tplaza == 0){
				alert('ERROR: Debe seleccionar una opcion en TIPO DE PLAZA');
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
			if(entp == null || entp == 0){
				alert('ERROR: Debe seleccionar una opcion en ENTIDAD DE LA PLAZA');
				return false;
			}
			// if(paisp == 0){
				// alert('ERROR: Debe seleccionar una opcion en PAIS DE LA PLAZA');
				// return false;
			// }
			if(pestra == null || pestra == 0){
				alert('ERROR: Debe seleccionar una opcion en PUESTO ESTRATEGICO');
				return false;
			}
			if(tcontra == null || tcontra == 0){
				alert('ERROR: Debe seleccionar una opcion en TIPO DE CONTRATACION');
				return false;
			}
			if(tpersonal == null || tpersonal == 0){
				alert('ERROR: Debe seleccionar una opcion en TIPO DE PERSONAL');
				return false;
			}
			if(rfi == null || rfi == 0){
				alert('ERROR: Debe seleccionar una opcion en RFI_RIUF');
				return false;
			}
			if(t_servidor == null || tservidor == 0){
				alert('ERROR: Debe seleccionar una opcion eN TIPO DE SERVIDOR');
				return false;
			}
			
			return true;
		}
		</script>
		</div>
	</body>			
	<?php
	}else{
		if(isset($_POST['guardarpuesto1'])){
				?>
		<html>
		<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
		</head>
		<body>
		
		<?php
		
		$ramo=$_POST['cmbramo'];
		$deno_puesto=strtoupper($_POST['deno_puesto']);
		$ur=$_POST['cmbur'];	
		$tplaza=$_POST['cmbtplaza'];
		$tfuncion=$_POST['cmbtfuncion'];
		$nsalarial=$_POST['cmbnsalarial'];
		$status='2';
		$noplauni=strtoupper($_POST['noplauni']);
		$cons_gral=$_POST['cons_gral'];
		$cons_jefe=$_POST['cons_jefe'];
		$pto=strtoupper($_POST['pto']);
		$zerusp=$_POST['cmbzeco'];
		$pestra=$_POST['cmbpestra'];
		$tcontra=$_POST['cmbtcontra'];
		$sdo_men=$_POST['sdo_men'];
		$cg_mens=$_POST['cg_mens'];
		$tpersonal=$_POST['cmbtpersonal'];
		$rfi=$_POST['cmbrfi'];
		$tservidor=$_POST['cmbtservidor'];
		$ent_plaza=$_POST['cmbent'];
		$pais_plaza=$_POST['cmbpais'];
			$ultres="select MAX(id_puesto) as id from puestos";
		$bus1=@mysql_query($ultres);
		$row1=mysql_fetch_array($bus1);
		$id=$row1['id']+1;
	$sql="INSERT INTO puestos (id_puesto,deno_puesto,codigo_puesto,id_ramo,id_ur,id_ze,id_ze_rusp,id_rtabular,consecutivo,id_tplaza,c_ocupacional,id_literal,id_funcion,id_nsalarial,tabulador,c_presupuestal,ordinal_cp,grupo,grado,nivel,id_eocupacional,p_subordinados,a_revelantes,e_relacionada,id_escolaridad,anio_experiencia,noplauni,cons_gral,cons_jefe,pto,id_ent_plaza,id_pais_plaza,id_pestrategico,id_tactual,id_tcontratacion,id_ingr_plaza,sdo_men,cg_mens,id_tpersonal,id_rfi_riuf,id_tservidor,id_pjefe,observaciones)
							VALUES('$id','$deno_puesto','NA','$ramo','$ur','0','$zerusp','0','0','$tplaza','NA','0','$tfuncion','$nsalarial','0','NA','0','NA','NA','0','$status','0','NA','NA','1','0','$noplauni','$cons_gral','$cons_jefe','$pto','$ent_plaza','$pais_plaza','$pestra','0','$tcontra','0','$sdo_men','$cg_mens','$tpersonal','$rfi','$tservidor', '0','NA')";
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