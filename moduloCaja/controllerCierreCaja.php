<?php
    class controllerCierreCaja{
        public function extraerMontoComprobante(){
            include_once("../model/comprobante.php");
            $objCompro = new Comprobante;
            $codigoNuevo = $objCompro->extraerMontoComprobante();            
            echo $codigoNuevo;
        }
        public function extraerMontoReembolso(){
            include_once("../model/reclamo.php");
            $objReclamo = new Reclamo;
            $codigoNuevo = $objReclamo->extraerMontoReclamo();            
            echo $codigoNuevo;
        }
    }
?>