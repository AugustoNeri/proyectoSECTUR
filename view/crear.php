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
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Crear cuenta</title>
        <meta charset= "UTF-8">
        <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
    </head>
    <body>       
    <center><h1>Alta de Usuarios </h1></center>
        <div class ="login">
           
            <fieldset>
                <legend>Crear cuenta</legend> 
            
			
               
<form action ="../controller/crear1.php" method ="POST"class="form-inline" role="form" align="center">
  
    <div class="form-group">
    <label>Numero de empleado</label>
	<br>
	<?php
	$sql="select id_empleado,a_paterno,a_materno,nombre from persona order by a_paterno asc,a_materno asc";
	$res=@mysql_query($sql);
	if(!$res){
		echo " fallo";
	}
	else{
		echo "<div class='col-sm-3 control-label'><select name='usuario' class='form-control'>";
		echo "<option value=0>SELECCIONE a la persona</option>";
		while ($fila=mysql_fetch_array($res)){
			echo "<option value=".$fila['id_empleado'].">".$fila['a_paterno']." ".$fila['a_materno']." ".$fila['nombre']." </option>";
		}
		echo "</select></div></div>";
	}
	
	?>

  </div>
  
   <div class="form-group">
    <label>Nombre</label>
	<br>
<input title="Es necesario un nombre de usuario" type="text" class ="pass" name ="nombre" placeholder="Nombre" required>
  </div>
  
  
  
  <div class="form-group">
    <label> Apellido</label>
	<br>
   <input title="Campo obligatorio" class ="pass" type="text" name ="apellido" placeholder="Apellido" required>
  </div>


<div class="form-group">
    <label>Contraseña</label>
	<br>
    <input title ="Campo obligatorio" class="pass" type ="password" name ="pass1" placeholder="Contraseña" required maxlength="8">
  </div>

  <div class="form-group">
    <label> Verificar contraseña</label>
	<br>
    <input title ="Campo obligatorio" class="pass" type ="password" name ="pass2" placeholder="Verificar Contraseña" required maxlength="8">
  </div>
			   
              
              </fieldset>
			    <input type ="submit" name="registrar" value ="Registrar"  id ="res">
            </form>	
        </div>
    </body>
</html>
<?php
?>