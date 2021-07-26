<?php
    include_once("conexion.php");
    class detalleComprobante extends conexion{
 
        public function InsertarDetalleComprobante($detalleComprobante,$idComprobante){

            $filas=count($detalleComprobante);
            $conn=$this->conectar();
            $res="0";
            for($i=0;$i<$filas;$i++){
                $id_producto=$detalleComprobante[$i]['id_producto'];
                $cantidad=$detalleComprobante[$i]['cantidad'];
                $precioU=floatval($detalleComprobante[$i]['precioU']);
                $envases=$detalleComprobante[$i]['envases'];
                $monto=$detalleComprobante[$i]['monto'];
                $SQLP ="INSERT INTO detallecomprobante (id_producto,id_comprobante,cantidad,precioU,envases,monto)
                        VALUES($id_producto,$idComprobante,$cantidad,$precioU,$envases,$monto)";
                
                if ($conn->query($SQLP) === TRUE) {
                    $res ="1";
                } else {
                    $res= "Error: " . $SQLP  . "<br>" . $conn->error;
                    $i=$filas;
                } 
            }
            $this->desconectar($conn);
            return $res; 
        }


    }
?>