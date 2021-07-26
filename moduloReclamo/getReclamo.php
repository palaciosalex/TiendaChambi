<?php
function validarBoleta($boleta){
    if (strlen($boleta) == 7){
        return 1;
    }
    else{
        return 0;
    }
}
function validarCampos($motivo,$monto,$fecha){
    if($motivo!="" and $monto>0 and $fecha!=""){
        return 1;
    }
    else {
        return 0;
    }
}
    if(isset($_POST['boleta'])){
        $boleta = trim($_POST['boleta']);
        $devolver = validarBoleta($boleta);
        if($devolver == 0){
            echo "Numero de boleta Invalido";
        }else{
            include_once("controllerGestionarReclamo.php");
            $objController = new controllerGestionarReclamo();
            $objController->extraerComprobanteSinReclamo($boleta);
        }
    }
    else if(isset($_POST['codigoBoleta'])){
        $boleta2 = trim($_POST['codigoBoleta']);
        $motivo = trim($_POST['motivo']);
        $monto = trim($_POST['monto']);
        $fecha = trim($_POST['fecha']);
        $devolver2 = validarBoleta($boleta2);
        if($devolver2 == 0){
            echo "Rellene los campos con valores válidos";
        }else{
            $devolver3 = validarCampos($motivo,$monto,$fecha);
            if($devolver3==0){
                echo "Rellene los campos con valores válidos";
            }else{
                include_once("controllerGestionarReclamo.php");
                $objController = new controllerGestionarReclamo();
                $IDBoleta = $objController->BuscarIDComprobante($boleta2);
                $objController->insertarReclamo($IDBoleta,$motivo,$monto);
            }
            
        }
    }
    else if(isset($_POST['boletaSolu'])){
        $boleta3 = trim($_POST['boletaSolu']);
        $devolver2 = validarBoleta($boleta3);
        if($devolver2 == 0){
            echo "Comprobante no existe";
        }else{
            include_once("controllerGestionarReclamo.php");
            $objController = new controllerGestionarReclamo();
            $IDBoleta = $objController->BuscarIDComprobante($boleta3);
            if(is_null($IDBoleta)){
                echo "Comprobante no existe";
            }else{
                include_once("controllerGestionarReclamo.php");
                $objController = new controllerGestionarReclamo();
                $objController->ExtraerReclamo($IDBoleta);
            }           
                     
        }
    }
    else if (isset($_POST['hid'])){
        $hid = $_POST['hid'];
        $id = $_POST['id'];
        if($hid==""){
            echo "No hay nada que solucionar";
        }else if($hid=="R"){
            echo "Reclamo ya se soluciono antes";
        }else {
            include_once("controllerGestionarReclamo.php");
            $objController = new controllerGestionarReclamo();
            $objController->CambiarEstadoR($id);
        }
    }
    else{
        include_once("../shared/formMensajeSistema.php");
        $objMensaje = new formMensajeSistema;
        $objMensaje -> formMensajeSistemaShow("Se ha detectado un acceso no permitido","<a href='../index.php'>
        Ingrese adecuadamente</a>");
  
    }
 /*********************** 
  * 
    */
?>