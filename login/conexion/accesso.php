<?php

include 'conexion.php'; 

class wish extends conexion {
        
        private $fine; 
	private $user ; 
	private $password;
	private $consulta ;
	private $conexion;
	private $row, $pas1 , $pas2;
        private $penombre, $peapellido, $peusuario, $pepassword, $verificar ; 

	public function wish(){

	$conect = new conexion();
	$this->conexion = $conect -> conectar();
	$conect -> seleccion_db();  

	}

	public  function login($usuario, $pass){
		$this->user = $usuario;
		$this->password= $pass;
		$this->consulta= mysql_query("SELECT id_usuario,contrasena FROM usuarios where no_empleado = '".$this->user."' and  contrasena = '".$this->password."'", $this->conexion); 
                if($this->row = mysql_fetch_array($this->consulta)){
                    session_start();
                    $this->consulta = mysql_query("SELECT * FROM usuarios where no_empleado = '".$this->user."' ",  $this->conexion);  
                    $this->row = mysql_fetch_array($this->consulta);
                    //Id
                    $this->id = $this->row['id_usuario'];
                    $_SESSION['id'] = $this->id;
                    $this->ini = 1;
                    //Nombre
                    $this->id = $this->row['Nombre'];
                    $_SESSION['name'] = $this->id; 
                    //apellido
                    $this->id = $this->row['Apellido'];
                    $_SESSION['apellido'] = $this->id; 
                         header("Location: ../view/menu.php");      
                }else{
                        ?>
							<html>
									 <head> 
							<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
							<link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">
							<title>Actualizar datos del puesto</title>
							</head>
							<body>
							<div class="alert alert-danger">ERROR: Usuario o password incorrectos</div>
							<form name="buttonbar" class="clearfix" >
							<input type="button" class="btn btn-default" value="Volver" onclick="location='../view/login.php'">
							 </form>
							 <br>
							 <br>
							 <br>
							 <br>
							 <br>
							 <br>
							 <br>
							 <br>
								<script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>
							 </body>
							 </html>
						<?php

                        
                }
                return $this->consulta ;
	}

        public function registrar($nom, $ape, $use, $pass){
            
            $this->penombre = $nom;
            $this->peapellido = $ape;
            $this->peusuario = $use;
            $this->pepassword = $pass;
            $ultres="select MAX(id_usuario) as id from usuarios";
			$bus1=@mysql_query($ultres);
			$row1=mysql_fetch_array($bus1);
			$id=$row1['id']+1;
            $this->verificar = mysql_query("SELECT id_usuario FROM usuarios where no_empleado = '".$this->peusuario."' " ,  $this->conexion );

            if($this->row = mysql_fetch_array($this->verificar)){
                
                echo "<h1>EL USUARIO QUE ACABA DE INGRESAR YA EXISTE</h1>";  
                
            }else if(!$this->row = mysql_fetch_array($this->verificar)){
            
                mysql_query("INSERT INTO usuarios(id_usuario, no_empleado, Nombre, Apellido,contrasena) values('$id','$this->peusuario','$this->penombre','$this->peapellido','$this->pepassword')", $this->conexion );
                
              
                
               //header("location: ../view/login.php");
               header("location: ../view/success.html");
            
            }
            
            
            
            
            
            
        }
        
        
        public function verificar($pass1 , $pass2){
            
            $this->fine = false;
            
            $this->pas1 = $pass1;
            $this->pas2 = $pass2;
            
            
            if($this->pas1 == $this->pas2){
                
                $this->fine = true ; 
                
                
            }
            
            
            return $this->fine ; 
        }
        
        
        

       
       




}

?>
