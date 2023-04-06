<!DOCTYPE html>
<?php
session_start();
if(isset ($_SESSION['id'])) {
?>
<html>
<head>
<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
</head>
<body>
<h2>Persona</h2>
<a href ="menu.php" class = "uno">Volver</a> 
<form class="form-inline" role="form" align=center>
   
  
  <div class="form-group">
    <input class="form-control"  placeholder="Buscar" type="text">
  </div>
  
  
   <div class="form-group">
    <button class="btn btn-primary" type="button">
  Buscar
  <span class="glyphicon glyphicon-search"></span>
</button>
  </div>
</form>

<br>
<br>

      
<form class="form-inline" role="form" align="center">
  
   <div class="form-group">
    <label> Numero Empleado</label>
	<br>
    <input type="text">
  </div>


  <div class="form-group">
    <label>Nombre</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>Apellido Paterno</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>Apellido Materno</label>
	<br>
    <input  type="text">
  </div>
  
<br>
<br>

<div class="form-group">
    <label>Curp</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>Genero</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>Entidad Nacimiento</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>Pais Nacimiento</label>
	<br>
    <input  type="text">
  </div>
  
<br>
<br>

<div class="form-group">
    <label>Correo</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>Numero SS</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>Instituto SS</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>Estado Conyugal</label>
	<br>
    <input  type="text">
  </div>
  
<br>
<br>

<div class="form-group">
    <label>Idioma</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>Discapacidad</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>Escolaridad</label>
	<br>
    <input  type="text">
  </div>
  
  <br>
  <br>
  <br>
  
  <button type="button" class="btn btn-primary">Actualizar</button>
  <button type="button" class="btn btn-primary">Cancelar</button>
 
 
</form>

<br>


<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

</body>
</html>  
<?php
}else{ 
    echo "Debes iniciar sesion antes de acceder a esta pagina";  
}
?>
