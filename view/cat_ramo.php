<!DOCTYPE html>
<?php
session_start();
if(isset ($_SESSION['id'])) {
?>
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
</head>
<body>
<h2><center>Catalogo RAMO </h2>

<table class="table table-striped" align="center">
 <tr>
 
    <th>ID Ramo</th>
    <th>Ramo</th> 
    
  </tr>
  
  <tr>
    
    <td>2</td>
    <td>PRESIDENCIA DE LA REPUBLICA</td>
	
  </tr>
  
  <tr>

    <td>4</td>
    <td>GOBERNACION</td>
	
  </tr>
  
   <tr>
    
    <td>5</td>
    <td>RELACIONES EXTERIORES</td>
	
  </tr>
  
   <tr>
    
    <td>6</td>
    <td>HACIENDA Y CREDITO PUBLICO</td>
	
  </tr>
  
   <tr>
    
    <td>7</td>
    <td>DEFENSA NACIONAL</td>
	
  </tr>
  
   <tr>
    
    <td>8</td>
    <td>AGRICULTURA, GANADERIA, DESARROLLO RURAL, PESCA Y ALIMENTACION</td>
	
  </tr>
  
   <tr>
    
    <td>9</td>
    <td>COMUNICACIONES Y TRANSPORTES</td>
	
  </tr>
  
   <tr>
    
    <td>10</td>
    <td>ECONOMIA</td>
	
  </tr>
  
   <tr>
    
    <td>11</td>
    <td>EDUCACION PUBLICA</td>
	
  </tr>
  
   <tr>
    
    <td>12</td>
    <td>SALUD</td>
	
  </tr>
  
   <tr>
    
    <td>13</td>
    <td>MARINA</td>
	
  </tr>
  
   <tr>
    
    <td>14</td>
    <td>TRABAJO Y PREVISIÓN SOCIAL</td>
	
  </tr>
  
   <tr>
    
    <td>15</td>
    <td>DESARROLLO AGRARIO, TERRITORIAL Y URBANO</td>
	
  </tr>
  
   <tr>
    
    <td>5</td>
    <td>RELACIONES EXTERIORES</td>
	
  </tr>
  
   <tr>
    
    <td>16</td>
    <td>MEDIO AMBIENTE Y RECURSOS NATURALES</td>
	
  </tr>
  
   <tr>
    
    <td>17</td>
    <td>PROCURADURIA GENERAL DE LA REPUBLICA</td>
	
  </tr>
  
  
  <tr>
    
    <td>18</td>
    <td>ENERGIA</td>
	
  </tr>
  
   <tr>
    
    <td>19</td>
    <td>APORTACIONES A SEGURIDAD SOCIAL</td>
	
  </tr>
  
   <tr>
    
    <td>20</td>
    <td>DESARROLLO SOCIAL</td>
	
  </tr>
  
  
   <tr>
    
    <td>21</td>
    <td>TURISMO</td>
	
  </tr>
  
   <tr>
    
    <td>25</td>
    <td>PREVISIONES Y APORTACIONES PARA LOS SISTEMAS DE EDUCACION BASICA, NORMAL, TECNOLOGICA Y DE ADULTOS</td>
	
  </tr>
  
   <tr>
    
    <td>27</td>
    <td>FUNCION PUBLICA</td>
	
  </tr>
  
   <tr>
    
    <td>30</td>
    <td>ADEUDOS DE EJERCICIOS FISCALES ANTERIORES</td>
	
  </tr>
  
   <tr>
    
    <td>31</td>
    <td>TRIBUNALES AGRARIOS</td>
	
  </tr>
  
   <tr>
    
    <td>32</td>
    <td>TRIBUNAL FEDERAL DE JUSTICIA FISCAL Y ADMINISTRATIVA</td>
	
  </tr>
  
   <tr>
    
    <td>37</td>
    <td>CONSEJERIA JURIDICA DEL EJECUTIVO FEDERAL</td>
	
  </tr>
  
   <tr>
    
    <td>38</td>
    <td>CONSEJO NACIONAL DE CIENCIA Y TECNOLOGIA</td>
	
  </tr>
  
   <tr>
    
    <td>40</td>
    <td>INFORMACION NACIONAL ESTADISTICA Y GEOGRAFICA</td>
	
  </tr>
  
   <tr>
    
    <td>45</td>
    <td>COMISION REGULADORA DE ENERGIA</td>
	
  </tr>
  
   <tr>
    
    <td>46</td>
    <td>COMISION NACIONAL DE HIDROCARBUROS</td>
	
  </tr>
  
   <tr>
    
    <td>48</td>
    <td>CULTURA</td>
	
  </tr>
  
   <tr>
    
    <td>50</td>
    <td>INSTITUTO MEXICANO DEL SEGURO SOCIAL</td>
	
  </tr>
   <tr>
    
    <td>51</td>
    <td>INSTITUTO DE SEGURIDAD Y SERVICIOS SOCIALES DE LOS TRABAJADORES DEL ESTADO</td>
	
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
