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
		public function ValidarComprobante($IDBoleta){
            $conn=$this->conectar();
            $SQLP ="Select idComprobante FROM Reclamo Where idComprobante=$IDBoleta";
            $resultado2 = mysqli_query($conn,$SQLP);  
            $this->desconectar($conn); 
            $numero_filas = mysqli_num_rows($resultado2); 
            if($numero_filas==0){
                return 0;
            }else{
                return 1;
            }
        }
        public function insertarReclamo($IDBoleta,$motivo,$monto){
            $conn=$this->conectar();
            $SQLP ="INSERT INTO reclamo( idComprobante, motivo, estado, fecha, monto) VALUES ($IDBoleta,'$motivo','A',CURRENT_DATE(),$monto)";
            $resultado2 = mysqli_query($conn,$SQLP);  
            $this->desconectar($conn);
        }
        public function ExtraerReclamo($IDBoleta){
            $conn=$this->conectar();
            $SQLP ="SELECT * FROM reclamo WHERE idComprobante=$IDBoleta";
            $resultado2 = mysqli_query($conn,$SQLP);  
            $this->desconectar($conn); 
            $numero_filas = mysqli_num_rows($resultado2); 
            for($i=0;$i < $numero_filas;$i++){
                $reclamo[$i] =mysqli_fetch_array($resultado2);
            }            
            return ($reclamo);
        }
        public function CambiarEstadoR($id){
            $conn=$this->conectar();
            $SQLP ="Update reclamo SET estado = 'R' WHERE id=$id";
            $resultado2 = mysqli_query($conn,$SQLP);  
            $this->desconectar($conn);
        }
    }
?>