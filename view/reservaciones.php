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
					<meta charset="utf-8">
					<meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
					<title>Museos</title>
					<meta name="description" content="Página para la renta de inmobiliario a estudiantes">
					<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
			<title>Reservaciones</title>
			</head>
			</html>
		<?php
				$sql =  "select mail,name,address,colonia,cp,nom_museo,num_people,fecha,statusPago
							from reservaciones left outer join museos on reservaciones.id_tm=museos.id_museo";
			$resultado1= @ mysql_query ($sql);
			$numrow= @mysql_num_rows($resultado1);
			if (!$resultado1)
			{
			 exit ('error en la consulta');
			}
			?>	
			
			 <table class="table table-dark" align="center">
			<tr>
			<td><h5>CORREO						</h5></td>
			<td><h5>NOMBRE					</h5></td>
			<td><h5>DIRECCION			</h5></td>
			<td><h5>COLONIA			</h5></td>
			<td><h5>CODIGO POSTAL							</h5></td>
			<td><h5>MUSEO				</h5></td>
			<td><h5># DE PERSONAS		</h5></td>
			<td><h5>FECHA				</h5></td>
			<td><h5>STATUS_PAGO		</h5></td>
			
			</tr>
			<?php
				while ($row=mysql_fetch_array ($resultado1))
				{
					echo "<tr><td>". $row["mail"]. "</td>";
					echo "<td>". $row["name"]. "</td>";
					echo "<td>". $row["address"]. "</td>";
					echo "<td>". $row["colonia"]. "</td>";
					echo "<td>". $row["cp"]. "</td>";
					echo "<td>". $row["nom_museo"]. "</td>";
					echo "<td>". $row["num_people"]. "</td>";
					echo "<td>". $row["fecha"]. "</td>";
					echo "<td>". $row["statsPago"]. "</td>";
				}
				 echo '</table>';
				echo '
				</body>
				</html>';
		}
	?>
	