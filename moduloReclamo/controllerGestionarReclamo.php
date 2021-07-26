<?php
class controllerGestionarReclamo{

        public function extraerComprobanteSinReclamo($boleta){
            include_once("../model/comprobante.php");
            $objComprobante = new comprobante;
            $ListaComprobante = $objComprobante->extraerComprobanteSinReclamo($boleta);
            $filas=count($ListaComprobante);
                if($filas==0){
                    echo "No existe boleta para reclamo";
                }
                else{
                    $arr=array(
                            'id' => $ListaComprobante[0]['idComprobante'],
                            'Fecha' => $ListaComprobante[0]['Fecha'], 
                            'MontoTotal' => $ListaComprobante[0]['MontoTotal'],
                            'Cliente' => $ListaComprobante[0]['Cliente']
                        );
                        echo json_encode($arr);
                } 
        }
        public function ExtraerReclamo($IDBoleta){
            include_once("../model/reclamo.php");
            $objComprobante = new reclamo;
            $ListaComprobante = $objComprobante->ExtraerReclamo($IDBoleta);
            $filas=count($ListaComprobante);
                if($filas==0){
                    echo "No existe comprobante en reclamo";
                }
                else{
                    $arr=array(
                            'id' => $ListaComprobante[0]['id'],
                            'estado' => $ListaComprobante[0]['estado'],
                            'fecha' => $ListaComprobante[0]['fecha'],
                            'motivo' => $ListaComprobante[0]['motivo'],
                            'monto' => $ListaComprobante[0]['monto']
                        );
                        echo json_encode($arr);
                } 
        }
        public function CambiarEstadoR($id){
            include_once("../model/reclamo.php");
            $objReclamo = new reclamo;
            $objReclamo->CambiarEstadoR($id);
        }
        public function BuscarIDComprobante($boleta){
            include_once("../model/comprobante.php");
            $objComprobante = new comprobante;
            $IDcomprobante = $objComprobante->ExtraerIDComprobante($boleta);
            return $IDcomprobante;               
        }
        public function insertarReclamo($IDBoleta,$motivo,$monto){
            include_once("../model/reclamo.php");
            $objReclamo = new reclamo;
            $objReclamo->insertarReclamo($IDBoleta,$motivo,$monto);
        }
        public function ValidarComprobante($IDBoleta){
            include_once("../model/reclamo.php");
            $objReclamo = new reclamo;
            $Resultado = $objComprobante->ValidarComprobante($IDBoleta);
            return $Resultado;
        }
}
?>