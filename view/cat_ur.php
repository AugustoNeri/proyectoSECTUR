<!DOCTYPE html>
<?php
session_start();
if(isset ($_SESSION['id'])) {
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
<title>UR</title>
</head>
<body>
<h2><center>Catalogo UR </h2>


<table class="table table-striped" align="center">
 <tr>
 
    <th>ID UR</th>
    <th>UR</th> 
    
  </tr>
  <tr>
    
    <td>100</td>
    <td>SECRETARÍA DE TURISMO</td>
	
  </tr>
  <tr>

    <td>110</td>
    <td>CONTRALORÍA INTERNA</td>
	
  </tr>
  <tr>
    
    <td>111</td>
    <td>DIRECCIÓN GENERAL DE COMUNICACIÓN SOCIAL</td>
	
  </tr>
  <tr>
    
    <td>112</td>
    <td>DIRECCIÓN GENERAL DE ASUNTOS JURÍDICOS</td>
  
  </tr>
   <tr>
    
    <td>113</td>
    <td>UNIDAD DE ASUNTOS Y COOPERACIÓN INTERNACIONALES</td>
  
  </tr>
  <tr>
    
    <td>120</td>
    <td>UNIDAD DE COORDINACIÓN SECTORIAL Y REGIONAL</td>
  
  </tr>
    <tr>
    
    <td>121</td>
    <td>DELEGACIÓN REGIONAL NORESTE</td>
  
  </tr>
  <tr>
    
    <td>122</td>
    <td>DELEGACIÓN REGIONAL NOROESTE</td>
  
  </tr>
  <tr>
    
    <td>123</td>
    <td>DELEGACIÓN REGIONAL CENTRO</td>
  
  </tr>
  <tr>
    
    <td>124</td>
    <td>DELEGACIÓN REGIONAL SURESTE</td>
  
  </tr>
  <tr>
    
    <td>125</td>
    <td>DELEGACIÓN REGIONAL SUROESTE</td>
  
  </tr>
  <tr>
    
    <td>200</td>
    <td>SUBSECRETARIA DE INNOVACIÓN Y DESARROLLO TURÍSTICO</td>
  
  </tr>
  <tr>
    
    <td>210</td>
    <td>DIRECCIÓN GENERAL DE DESARROLLO REGIONAL Y FOMENTO TURÍSTICO</td>
  
  </tr>
  <tr>
    
    <td>211</td>
    <td>DIRECCIÓN GENERAL DE INNOVACIÓN DEL PRODUCTO TURÍSTICO</td>
  
  </tr>
  <tr>
    
    <td>212</td>
    <td>DIRECCIÓN GENERAL DE DESARROLLO DE LA CULTURA TURÍSTICA</td>
  
  </tr>
  <tr>
    
    <td>213</td>
    <td>DIRECCIÓN GENERAL DE MEJORA REGULATORIA</td>
  
  </tr>
  <tr>
    
    <td>214</td>
    <td>DIRECCIÓN GENERAL DE GESTIÓN DE DESTINOS</td>
  
  </tr>
  <tr>
    
    <td>215</td>
    <td>DIRECCIÓN GENERAL DE IMPULSO AL FINANCIAMIENTO E INVERSIONES TURÍSTICAS</td>
  
  </tr>
  <tr>
    
    <td>300</td>
    <td>SUBSECRETARÍA DE CALIDAD Y REGULACIÓN</td>
  
  </tr>
  <tr>
    
    <td>310</td>
    <td>DIRECCIÓN GENERAL DE NORMALIZACIÓN Y CALIDAD REGULATORIA TURÍSTICA</td>
  
  </tr>
  <tr>
    
    <td>311</td>
    <td>DIRECCIÓN GENERAL DE CERTIFICACIÓN TURÍSTICA</td>
  
  </tr>
  <tr>
    
    <td>312</td>
    <td>DIRECCIÓN GENERAL DE VERIFICACIÓN Y SANCIÓN</td>
  
  </tr>
  <tr>
    
    <td>500</td>
    <td>OFICIALÍA MAYOR</td>
  
  </tr>
  <tr>
    
    <td>510</td>
    <td>DIRECCIÓN GENERAL DE ADMINISTRACIÓN</td>
  
  </tr>
  <tr>
    
    <td>511</td>
    <td>DIRECCIÓN GENERAL DE DESARROLLO INSTITUCIONAL Y COORDINACIÓN SECTORIAL</td>
  
  </tr>
  <tr>
    
    <td>512</td>
    <td>DIRECCIÓN GENERAL DE PROGRAMACIÓN Y PRESUPUESTO</td>
  
  </tr>
  <tr>
    
    <td>513</td>
    <td>DIRECCIÓN GENERAL DE TECNOLOGÍAS DE LA INFORMACIÓN Y COMUNICACIÓN</td>
  
  </tr>
  <tr>
    
    <td>600</td>
    <td>SUBSECRETARIA DE PLANEACIÓN Y POLÍTICA TURÍSTICA</td>
  
  </tr>
  <tr>
    
    <td>610</td>
    <td>DIRECCIÓN GENERAL DE INTEGRACIÓN DE INFORMACIÓN SECTORIAL</td>
  
  </tr>
  <tr>
    
    <td>611</td>
    <td>DIRECCIÓN GENERAL DE PLANEACIÓN</td>
  
  </tr>
    <tr>
    
    <td>612</td>
    <td>DIRECCIÓN GENERAL DE ORDENAMIENTO TURÍSTICO SUSTENTABLE</td>
  
  </tr>
    <tr>
    
    <td>613</td>
    <td>DIRECCIÓN GENERAL DE SEGUIMIENTO Y EVALUACIÓN</td>
  
  </tr>
    <tr>
    
    <td>A00</td>
    <td>INSTITUTO DE COMPETITIVIDAD TURÍSTICA</td>
  
  </tr>
    <tr>
    
    <td>B00</td>
    <td>CORPORACIÓN DE SERVICIOS AL TURISTA ÁNGELES VERDES</td>
  
  </tr>
    <tr>
    
    <td>W3H</td>
    <td>FONATUR CONSTRUCTORA, S.A. DE C.V.</td>
  
  </tr>
    <tr>
    
    <td>W3J</td>
    <td>CONSEJO DE PROMOCIÓN TURÍSTICA DE MÉXICO, S.A. DE C.V.</td>
  
  </tr>
    <tr>
    
    <td>W3N</td>
    <td>FONDO NACIONAL DE FOMENTO AL TURISMO</td>
  
  </tr>
    <tr>
    
    <td>W3S</td>
    <td>FONATUR MANTENIMIENTO TURÍSTICO, S.A. DE C.V.</td>
  
  </tr>
     <tr>
    
    <td>W3X</td>
    <td>FONATUR OPERADORA PORTUARIA, S.A. DE C.V.
</td>
  
  </tr>
  
  
</table>


<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

</body>
</html> 
<?php
}else{ 
    echo "Debes iniciar sesion antes de acceder a esta pagina";  
}
?>
