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
    <title>Cat&aacute;logo de tipo_ingreso_plaza</title>
    </head>
	</html>

<?php


 	echo "<br>";
 	$sql =  "Select * from tcat_tipo_puesto_estrategico";
	$resultado1= @ mysql_query ($sql);
	if (!$resultado1)
	{
	 exit ('error en la consulta');
    }
    ?>
    <HTML>
    <BODY>
	 <h2><center>Catálogo de PUESTO ESTRATÉGICO</h2>
     <table class="table table-striped" align="center">
    <tr>
    <td><h2>Id</td>
    <td><h2>Puesto estrat&eacutegico; </td>

	</tr>


 <?php
while ($row=mysql_fetch_array ($resultado1))
{
echo "<tr><td>". $row["id_pestrategico"]. "</td>";
echo "<td>". $row["p_estrategico"]. "</td>";

}
   echo '</table>';
    echo '
    </body>
    </html>';

}
 mysql_close($conexion); ?>