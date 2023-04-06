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
	
	
	$ent= $_POST['ent'];
	if($ent<33){	
	$queryM = "SELECT id_pais,pais FROM tcat_paises WHERE tcat_paises.id_pais = '700'";
	$resultadoM = @ mysql_query($queryM);
	$html= "<option value='0'>Selecciona un pais</option>";
	while($rowM = mysql_fetch_array($resultadoM))
	{
		$html.= "<option value='".$rowM['id_pais']."'>".$rowM['pais']."</option>";
	}
	
	
	}else{
	$queryM = "SELECT id_pais,pais FROM tcat_paises WHERE tcat_paises.id_pais <> '700' order by pais asc";
	$resultadoM = @ mysql_query($queryM);
		$html= "<option value='0'>Seleccionr un pais/option>";
	while($rowM = mysql_fetch_array($resultadoM))
	{
		$html.= "<option value='".$rowM['id_pais']."'>".$rowM['pais']."></option>";
	}
	
	
	}
	echo $html;
}
?>