<!DOCTYPE html>
<?php
session_start();
if(isset ($_SESSION['id'])) {
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">

<title>Zona Economica</title>
</head>
<body>
<h2><center>Catalogo zona económica </h2>

<table class="table table-striped" align="center">
 <tr>
 
    <th>ID Zona Económica</th>
    <th>Z_económica</th> 
    
  </tr>
  <tr>
    
    <td>1</td>
    <td>zona 1</td>
	
  </tr>
  <tr>

    <td>2</td>
    <td>zona 2</td>
	
  </tr>
  <tr>
    
    <td>3</td>
    <td>zona 3</td>
	
  </tr>
  
  
</table>



</body>
</html> 
<?php
}else{ 
    echo "Debes iniciar sesion antes de acceder a esta pagina";  
}
?>
