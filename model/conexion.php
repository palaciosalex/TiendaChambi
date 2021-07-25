<?php
    class conexion{
        protected function conectar(){
            $conn= mysqli_connect("localhost", "root", "", "tienda_chambi");
            return $conn;
        }
        protected function desconectar($conectados){
            mysqli_close($conectados);
            //echo "me desconecte :(";
        }
    } 
 ?>