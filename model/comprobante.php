<?php
    include_once("conexion.php");
    class Comprobante extends conexion{
        public function extraerMontoComprobante(){
            $conn=$this->conectar();
            $SQLP ="SELECT SUM(MontoTotal) FROM comprobante WHERE fecha= CURRENT_DATE()";
            $resultado2 = mysqli_query($conn,$SQLP);  
            $this->desconectar($conn); 
            $numero_filas = mysqli_num_rows($resultado2); 
            for($i=0;$i < $numero_filas;$i++){
                $monto[0] =mysqli_fetch_array($resultado2);
            }            
            return ($monto[0]['SUM(MontoTotal)']);               
        }
    }
?>