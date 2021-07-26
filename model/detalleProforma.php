<?php 
include_once("conexion.php");
    class detalleProforma extends conexion{

        public function insertarDetalleProforma($id_producto,$cantidad, $envases,$monto,$idProforma){
            $conn=$this->conectar();
            $SQLP ="INSERT INTO detalleproforma(id_producto, cantidad, envases, monto, id_proforma) VALUES ($id_producto,$cantidad,$envases,$monto,$idProforma)";
            $result = mysqli_query($conn,$SQLP);
            $this->desconectar($conn);  
            
        }

        public function ExtraerDetalleProforma($idProforma){
            $conn=$this->conectar();
            $SQLP ="SELECT P.id,P.producto,D.cantidad,D.envases,D.monto 
                    FROM producto P,detalleproforma D 
                    WHERE P.id=D.id_producto AND D.id_proforma=$idProforma";
            $result = mysqli_query($conn,$SQLP);
            $this->desconectar($conn);
            $numero_filas = mysqli_num_rows($result); 
            for($i=0;$i < $numero_filas;$i++){
                $detalleProforma[$i] =mysqli_fetch_array($result);
            }            
            return ($detalleProforma);  
            
        }

    }
?>