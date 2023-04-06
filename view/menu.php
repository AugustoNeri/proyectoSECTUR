<?php
session_start();
if(isset ($_SESSION['id'])) {
?>
<HTML>
<HEAD>
<TITLE>INICIO</TITLE>
<meta charset = "UTF-8"> 
<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
</HEAD>
<body>

    
	
<nav class="navbar navbar-inverse sub-navbar navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="na  vbar-toggle collapsed" data-toggle="collapse" data-target="#subenlaces">
        <span class="sr-only">Interruptor de Navegación</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" id ="title" >Usuario:  
    <?php
    echo $_SESSION['name'] ;
    echo " " ;
    echo $_SESSION['apellido'];
    ?></a>
	
	
    </div>
    <div class="collapse navbar-collapse" id="subenlaces">
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">RUSP<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
			<li><a href="c_rusp_envio.php" target=main>Envio</a></li>
			<li><a href="c_rusp_bajas.php" target=main>Bajas</a></li>
			
           <li class="divider" ></li>
          </ul>
        </li>
		<li><a href="c_persona.php" target=main>Persona</a></li>
		<li><a href="c_puestos.php" target=main>Puestos</a></li>
		
		<li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">PLANTILLAS <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
			<li><a href="C_plantilla.php" target=main>PLANTILLA DE SPC</a></li>
			<li><a href="C_plantilla_histo.php" target=main>PLANTILLA HISTORICA</a></li>
			
           <li class="divider" ></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">CATALOGO_1 <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
			<li><a href="c_discapacidad.php" target=main>Discapacidades</a></li>
			<li><a href="c_entidad.php" target=main>Entidades federativas</a></li>
			<li><a href="c_nescolaridad.php" target=main>Escolaridad</a></li>
			<li><a href="c_econyugal.php" target=main>Estado conyugal</a></li>
			<li><a href="c_estatus_ocupacional.php" target=main>Estatus ocupacional</a></li>
			<li><a href="c_idioma.php" target=main>Idiomas</a></li>
			<li><a href="c_institucionesss.php" target=main>Instituciones_ss</a></li>
			<li><a href="c_m_baja.php" target=main>Motivos de baja</a></li>
			<li><a href="c_mdeclaracion.php" target=main>Motivos de declaracion</a></li>
			<li><a href="c_mingreso.php" target=main>Motivos de ingreso</a></li>
			<li><a href="c_municipio.php" target=main>Municipios</a></li>
			<li><a href="c_nsalarial.php" target=main>Niveles Salariales</a></li>
			<li><a href="c_paises.php" target=main>Paises</a></li>
			<li><a href="c_ramo.php" target=main>Ramo</a></li>
			<li><a href="c_rtabular.php" target=main>Referencia tabular</a></li>
			
           <li class="divider" ></li>
          </ul>
        </li>
		 <li class="dropdown">
          <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">CATALOGO_2 <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
			<li><a href="c_rfi_riuf.php" target=main>RFI_RIUF</a></li>
			<li><a href="c_sexo.php" target=main>Sexo</a></li>
			<li><a href="c_tipificacion_actual.php" target=main>Tipificacion Actual</a></li>
			<li><a href="c_t_contratacion.php" target=main>Tipo de contratación</a></li>
			<li><a href="c_tipo_funcion.php" target=main>Tipo de Funcion</a></li>
			<li><a href="c_tipo_ingreso_plaza.php" target=main>Tipo de ingreso a la plaza</a></li>
			<li><a href="c_tipo_personal.php" target=main>Tipo de personal</a></li>
			<li><a href="c_tipo_plaza.php" target=main>Tipo de plaza</a></li>
			<li><a href="c_tipo_pestrategico.php" target=main>Tipo de puesto estrat&eacute;gico</a></li>
			<li><a href="c_tipo_servidor.php" target=main>Tipo de servidor p&uacute;blico</a></li>
			<li><a href="c_ur.php" target=main>Unidad Responsable</a></li>
			<li><a href="c_z_economica.php" target=main>Zona economica</a></li>		
           <li class="divider" ></li>
			
			
             
          </ul>
        </li>
		 <li><a href="login.php" class = "dos">Cerrar Sesión</a></li>		
      </ul>
    </div>
  </div>
</nav>
<br>
<br>
<iframe name=main src ="Imagenes\2.png" width=100% frameborder="0" height="430">
</iframe>

	
<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

</body>
</HTML>
<?php
}else{echo "Debes iniciar sesion antes de acceder a esta pagina"; } ?>