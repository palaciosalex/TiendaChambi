<?php 
include_once("conexion.php");
    class usuarioPrivilegio extends conexion{
        public function obtenerPrivilegiosUsuario($idUsuario){  
            $conn=$this->conectar();
            $SQLP ="Select P.label, P.path, P.image from usuarios U, privilegios P, usuarioprivilegio UP WHERE U.idUsuario=UP.idusuario AND U.idUsuario= '$idUsuario' AND P.id = UP.idPrivilegio";
            $result = mysqli_query($conn,$SQLP);
            $this->desconectar($conn);
            $numero_filas = mysqli_num_rows($result); 
            for($i=0;$i < $numero_filas;$i++){
                $privilegio[$i] =mysqli_fetch_array($result);
            }            
            return ($privilegio);
        }
    }
?>