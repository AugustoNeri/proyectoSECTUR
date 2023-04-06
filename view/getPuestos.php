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
if ($conexion ){ //evalua si se enviaron los datos del formulario
	
	
	$ur= $_POST['ur'];
	
	$queryM = "SELECT id_puesto,deno_puesto,cons_gral FROM puestos WHERE puestos.id_ur = '$ur' and puestos.id_eocupacional='2' ORDER BY deno_puesto asc";
	$resultadoM = @ mysql_query($queryM);
	
	$html= "<option value='0'>Seleccionar Denominacion de puesto</option>";
	
	while($rowM = mysql_fetch_array($resultadoM))
	{
		$html.= "<option value='".$rowM['id_puesto']."'>".$rowM['deno_puesto']." ".$rowM['cons_gral']."</option>";
	}
	
	echo $html;
	
}
?>