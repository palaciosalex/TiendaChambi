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

        public function ExtraerUsuarios(){
            $conn=$this->conectar();
            $SQLP ="SELECT * FROM usuarios limit 10";
            $result = mysqli_query($conn,$SQLP);
            $this->desconectar($conn);
            $producto=array();
            $numero_filas = mysqli_num_rows($result); 
            for($i=0;$i < $numero_filas;$i++){
                $usuario[$i] =mysqli_fetch_array($result);
            }            
            return ($usuario);
        }

        public function insertarUsuarios($user,$contra,$nombre,$dni,$pes,$res,$rol){
            $conn=$this->conectar();
            $SQL ="INSERT INTO usuarios(login, password, nombre, dni, preguntaS, respuestaS, rol, estado) VALUES ('$user','$contra','$nombre',$dni,'$pes','$res','$rol','1')";
            $result = mysqli_query($conn,$SQL);
            $this->desconectar($conn);
        }

        public function BuscarUsuarioEdit($idEditar){
            $conn=$this->conectar();
            $SQLP ="SELECT * FROM USUARIOS WHERE idUsuario = $idEditar";
            $resulti = mysqli_query($conn,$SQLP);
            $this->desconectar($conn);
            $numero_filas = mysqli_num_rows($resulti); 
            for($i=0;$i < $numero_filas;$i++){
                $usuarioE[$i] =mysqli_fetch_array($resulti);
            }            
            return ($usuarioE);
        }

        public function UpdateUsuarios($idGuardarUsuarioM,$user,$contra,$nombre,$dni,$pes,$res,$rol){
            $conn=$this->conectar();
            $SQL ="UPDATE usuarios SET login='$user',password='$contra',nombre='$nombre',dni=$dni,preguntaS='$pes',respuestaS='$res',rol='$rol' WHERE idUsuario=$idGuardarUsuarioM";
            $result = mysqli_query($conn,$SQL);
            $this->desconectar($conn);
        }
        public function EliminarUsuario($idEliminar){
            $conn=$this->conectar();
            $SQL ="DELETE FROM USUARIOS WHERE idUsuario=$idEliminar";
            $result = mysqli_query($conn,$SQL);
            $this->desconectar($conn);
        }

        public function BuscarUsuarioLogin($buscar){
            $conn=$this->conectar();
            $SQLP ="SELECT * FROM usuarios WHERE login LIKE '%$buscar%'";
            $resulti = mysqli_query($conn,$SQLP);
            $this->desconectar($conn);
            $ListaProductos=array();
            $numero_filas = mysqli_num_rows($resulti);
            for($i=0;$i < $numero_filas;$i++){
                $ListaUsuariosB[$i] =mysqli_fetch_array($resulti);
            }   
            return ($ListaUsuariosB);  
        }
    }
 ?>