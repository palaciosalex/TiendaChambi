<?php
    include_once("conexion.php");
    class usuario extends conexion{
        public function VerificarUsuario($login,$password){ 
            $usuario=array();
            $conn=$this->conectar();
            //$conectados=mysqli_connect("localhost", "root", "123", "tacza");
            $SQL ="Select * from usuarios where login='$login' and password='$password' and estado=1";
            $result = mysqli_query($conn,$SQL);
            $this->desconectar($conn);
            $numero_filas_encontradas = mysqli_num_rows($result);       
            if($numero_filas_encontradas == 1){
                for($i=0;$i < $numero_filas_encontradas;$i++){
                    $usuario[$i] =mysqli_fetch_array($result);
                }  
                return $usuario;
            }else{
                return (0);
            }
        }
        public function AcualizarContra($login,$npassword){ 
            $conn=$this->conectar();
            $SQL ="Update usuarios SET PASSWORD = '$npassword' WHERE login='$login'";
            $result = mysqli_query($conn,$SQL);
            $this->desconectar($conn);
        }

        public function ComprobarUsuario($login){ 
            $conn=$this->conectar();
            $SQL ="Select preguntaS from usuarios where login='$login'";
            $result = mysqli_query($conn,$SQL);
            $this->desconectar($conn);
            $numero_filas_encontradas = mysqli_num_rows($result);       
            if($numero_filas_encontradas == 1){
                $row = $result->fetch_row();
                return ($row[0]);
            }else{    
                return (null);
            }
            
        }
        public function ExtraerRespuesta($respuestaS,$login){ 
            $conn=$this->conectar();
            $SQL ="Select respuestaS from usuarios where respuestaS='$respuestaS'and login='$login'";
            $result = mysqli_query($conn,$SQL);
            $this->desconectar($conn);
            $numero_filas_encontradas = mysqli_num_rows($result);       
            if($numero_filas_encontradas == 1){
                return (1);
            }else{
                return (0);
            }
        }

        public function ObtenerIDUsuario($login){ 
            $conn=$this->conectar();
            $SQL ="Select idUsuario from usuarios where login='$login'";
            $result = mysqli_query($conn,$SQL);
            $this->desconectar($conn);
            $numero_filas_encontradas = mysqli_num_rows($result);       
            if($numero_filas_encontradas == 1){
                for($i=0;$i < $numero_filas_encontradas;$i++){
                    $usuario[$i] =mysqli_fetch_array($result);
                }
                return $usuario[0]['idUsuario']; 
            }else{
                return (0);
            }
        }
    }
 ?>