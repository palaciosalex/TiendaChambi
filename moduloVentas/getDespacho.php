<?php
   
    function validarBoleta($boleta){
        if (strlen($boleta) == 7){
            return 1;
        }
        else{
            return 0;
        }
    }
    if(isset($_POST['boleta'])){
        $boleta = trim($_POST['boleta']);
        $resultado = validarBoleta($boleta);
        if($resultado==0){
            echo "Comprobante no valido";
        }else{
            include_once("controllerDespacho.php");
            $objController = new controllerDespacho;
            $objController->BuscarComprobanteDespacho($boleta);
        }
    }
    else if(isset($_POST['idDespacho'])){
        if($_POST['idDespacho'] == ""){
            echo "Busque su comprobante";
        }else{
            include_once("controllerDespacho.php");
            $objController = new controllerDespacho;
            $objController->cambiarEstado($_POST['idDespacho']);
        }
        
    }
    else{
        include_once("../shared/formMensajeSistema.php");
        $objMensaje = new formMensajeSistema;
        $objMensaje -> formMensajeSistemaShow("Se ha detectado un acceso no permitido","<a href='../index.php'>Ingrese adecuadamente</a>");
  
    }
       
 ?>