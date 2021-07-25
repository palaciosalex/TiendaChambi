<?php 
include_once("conexion.php");
    class detalleProforma extends conexion{

        public function insertarDetalleProforma($id_producto,$cantidad, $envases,$monto,$idProforma){
            $conn=$this->conectar();
            $SQLP ="INSERT INTO detalleproforma(id_producto, cantidad, envases, monto, id_proforma) VALUES ($id_producto,$cantidad,$envases,$monto,$idProforma)";
            $result = mysqli_query($conn,$SQLP);
            $this->desconectar($conn);  
            
        }

    }
?>