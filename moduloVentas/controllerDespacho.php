<?php
class controllerDespacho{

       public function BuscarComprobanteDespacho($boleta){
            include_once("../model/comprobante.php");
            $objComprobante = new comprobante;
            $ListaComprobante = $objComprobante->BuscarComprobanteDespacho($boleta);
            $filas=count($ListaComprobante);
                if($filas==0){
                    echo "No existe comprobante para despacho";
                }
                else{
                    $arr=array(
                        'idComprobante' => $ListaComprobante[0]['idComprobante'],
                        'Fecha' => $ListaComprobante[0]['Fecha'], 
                        'MontoTotal' => $ListaComprobante[0]['MontoTotal'],
                        'Cliente' => $ListaComprobante[0]['Cliente']
                    );
                    echo json_encode($arr);
                }                  
        }
        public function cambiarEstado($ID){
            include_once("../model/comprobante.php");
            $objComprobante2 = new comprobante;
            $objComprobante2->cambiarEstado($ID);
        }
        public function BuscarIDComprobante($boleta){
            include_once("../model/comprobante.php");
            $objComprobante = new comprobante;
            $IDcomprobante = $objComprobante->obtenerIDComprobante($boleta);
            echo $IDcomprobante;               
        }
        
       
      
    }
?>