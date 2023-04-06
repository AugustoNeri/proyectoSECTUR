<!DOCTYPE html>
<?php/*
session_start();
if(isset ($_SESSION['id'])) {
*/?>
<html>
<head>
<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
</head>
<body>
<h2>REPORTE RUSP</h2>
<a href ="menu.php" class = "uno">Volver</a> 
<form class="form-inline" role="form" align=center>
    
    <div class="form-group">
    <label class="control-label" > Reporte</label>
  <select name="reporte">
    <option value="Envio">Envio</option>
    <option value="Bajas">Bajas</option>
  </select>
 
  <div class="form-group">
    <input id="file-01" type="file">
  </div>
  
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
<br>

<form class="form-inline" role="form" align="left">
  
   <div class="form-group">
    <label> NOPLA PLAZA</label>
	<br>
    <input type="text">
  </div>


  <div class="form-group">
    <label>FILIACION0</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>RAMO1</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>UNIDAD2</label>
	<br>
    <input  type="text">
  </div>
  
<br>
<br>

<div class="form-group">
    <label>CONS GRAL3</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>CONS JEFE4</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>NOM PTO5</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>PTO6</label>
	<br>
    <input  type="text">
  </div>
  
<br>
<br>

<div class="form-group">
    <label>NIVEL7</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>ZONA ECONOMICA8</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>SDO MENS9</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>CG MENS10</label>
	<br>
    <input  type="text">
  </div>
  
<br>
<br>

<div class="form-group">
    <label>ENT PLAZA11</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>PAIS12</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>TIPO PZA13</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>PTO ESTRAT14</label>
	<br>
    <input type="text">
  </div>
  
<br>
<br>

<div class="form-group">
    <label>TIPO FUNC15</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>TIPO PERS16</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>PTO RHNET17</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>STATUS OCUP18</label>
	<br>
    <input  type="text">
  </div>
  
<br>
<br>

<div class="form-group">
    <label>RFC SP19</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>CURP20</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>NOMBRES21</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>APE PAT22</label>
	<br>
    <input  type="text">
  </div>
  
<br>
<br>

<div class="form-group">
    <label>APE MAT23</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>FECHA NAC24</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>SEXO25</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>ENT NAC26</label>
	<br>
    <input  type="text">
  </div>
  
<br>
<br>

<div class="form-group">
    <label>PAIS NAC27</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>MAIL28</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>NUM NSS29</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>NUM SEGSOC30</label>
	<br>
    <input  type="text">
  </div>  
  

<br>
<br>

<div class="form-group">
    <label>CVE SEP31</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>DISC</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>NIV TAB PAG32</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>TIPO CONT33</label>
	<br>
    <input  type="text">
  </div>  
 
<br>
<br>

<div class="form-group">
    <label>DECLA PAT34</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>MOTIVO DP35</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>NUM EMP36</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>INGRSO APF37</label>
	<br>
    <input  type="text">
  </div>  
 
 
<br>
<br>

<div class="form-group">
    <label>INGRSO SPC38</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>ING SECTUR39</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>ULT PTO40</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>OBLIGA DP41</label>
	<br>
    <input  type="text">
  </div>  
 
<br>
<br>

<div class="form-group">
    <label>AREA43</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>CONTRAT44</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>CONC LIC AUT PER45</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>ENAJ BIENES MUEB46</label>
	<br>
    <input  type="text">
  </div>  
 
<br>
<br>

<div class="form-group">
    <label>ASIG EMIS DICT47</label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>RFI/RIUF 48</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>TIPO FUN 49</label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>NIVL 50</label>
	<br>
    <input  type="text">
  </div>  
 
<br>
<br>

<div class="form-group">
    <label>CONYUGAL 51 </label>
	<br>
    <input  type="text">
  </div>


  <div class="form-group">
    <label>LENGUAS52 </label>
	<br>
    <input  type="text">
  </div>
  
  <div class="form-group">
    <label>DESCENDENCIA53</label>
	<br>
    <input  type="text">
  </div>
  
 
</form>
<br>
<button type="button" class="btn btn-primary">Enviar</button>


<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

</body>
</html> 
<?php/*
}else{ 
    echo "Debes iniciar sesion antes de acceder a esta pagina";  
}
*/?>
