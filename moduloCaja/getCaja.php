<?php
    include_once("controllerCierreCaja.php");
    $objController = new controllerCierreCaja;
    if(isset($_POST['RecuentoAJAX'])){
        $Recuento = $_POST['RecuentoAJAX'];
        $monto = $_POST['monto_TotalAJAX'];
        if($Recuento>0 and $monto>0){
            echo "";
        }else if($Recuento==""){
            echo "Debe rellenar algunos campos";
        }
        else{
            echo "Hay valores NO Válidos";
        }        
    }
    else if (isset($_POST['extraerMontoComprobante'])){        
        $objController->extraerMontoComprobante();
    }
    else if (isset($_POST['extraerMontoReembolso'])){
        $objController->extraerMontoReembolso();
    }
    else{
        include_once("../shared/formMensajeSistema.php");
        $objMensaje = new formMensajeSistema;
        $objMensaje -> formMensajeSistemaShow("Se ha detectado un acceso no permitido","<a href='../index.php'>Ingrese adecuadamente</a>");
  
    }
 /*********************** 
  * 
    */
?>