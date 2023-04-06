<?php
session_start();
session_destroy();
?>
<html>
<head>
<meta charset="UTF-8">
<title> Inicio </title>
<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
</head>
<body>
<section id="Formulario">
<center>
	<table>
		<td ><img src="Imagenes\2.png" width="300" height="100" ></td>
		<td width="1000">
		<h3>  SISTEMA INTEGRAL DE GESTION DE INFORMACION DE RECURSOS HUMANOS <h3>
		</td>
	
	</table>	
</center>
<br>	
<div class ="login">
<form action ="../controller/login.php" method= "POST" > 
<center>    
    <fieldset>       
        
		<p>
                    <input title = "se necesita el nombre" type = "text" name = "usuario" placeholder = "Numero de Empleado" required>
                </p> 
                <p>
                    <input  title = "se necesita la contraseña" type = "password" name = "pass" placeholder = "Contraseña" required maxlength="8">
                </p> 
                <p>
                   <input  type = "submit" class="" value = "Entrar"> 
                   <input  type = "reset" value = "Limpiar"> 
                </p>               
                <p>
                    
                </p>
</fieldset>
</center>
</form>	
</div>
</section>

<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>
</body>
</html>
