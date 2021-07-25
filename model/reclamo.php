<?php
    include_once("conexion.php");
    class Reclamo extends conexion{
        public function extraerMontoReclamo(){
            $conn=$this->conectar();
            $SQLP ="SELECT SUM(monto) FROM reclamo WHERE fecha= CURRENT_DATE() and estado ='Reembolso'";
            $resultado2 = mysqli_query($conn,$SQLP);  
            $this->desconectar($conn); 
            $numero_filas = mysqli_num_rows($resultado2); 
            for($i=0;$i < $numero_filas;$i++){
                $monto[0] =mysqli_fetch_array($resultado2);
            }            
            return ($monto[0]['SUM(monto)']);               
        }
    }
?>