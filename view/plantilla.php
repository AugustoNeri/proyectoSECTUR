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
<h2>Plantilla</h2>
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
    <label>RFC</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>ID Puesto</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>Puesto Jefe</label>
	<br>
    <input  type="text">
  </div>
  
<br>
<br>

<div class="form-group">
    <label>P Estrategico</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>Tipi Actual</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>Contratacion</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>Igreso Plaza</label>
	<br>
    <input  type="text">
  </div>
  
<br>
<br>

<div class="form-group">
    <label>Funcion</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>Ingreso</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>Servidor</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>Ocupante Anterior</label>
	<br>
    <input  type="text">
  </div>
  
<br>
<br>

<div class="form-group">
    <label>SDO Mensual</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>CG Mensual</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>T Personal</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>Declaracion P</label>
	<br>
    <input  type="text">
  </div>
  
 <br>
<br> 
  
  <div class="form-group">
    <label>M Declaracion</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>RFI/RIUF</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>Descendencia</label>
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
