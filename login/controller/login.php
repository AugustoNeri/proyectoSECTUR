<?php

include ("../conexion/accesso.php");

$user = $_POST['usuario'];
$pass = $_POST['pass'];  


$wish = new wish(); 
$wish -> login($user,$pass); 
 


?>