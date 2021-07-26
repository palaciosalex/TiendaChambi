<?php


if(isset($_POST['ExtraerProformas'])){

    include_once("controllerEmitirComprobante.php");
    $objController = new controllerEmitirComprobante;
    $objController->ExtraerProformas();

}
else if(isset($_POST['codigoProforma'])){
    $codigoProforma=trim($_POST['codigoProforma']);
    include_once("controllerEmitirComprobante.php");
    $objController = new controllerEmitirComprobante;
    $objController->BuscarProformaCodigo($codigoProforma);

}
else if(isset($_POST['ObtenerCodigoNuevo'])){
    include_once("controllerEmitirComprobante.php");
    $objController = new controllerEmitirComprobante;
    $objController->obtenerCodigoNuevo();

}
else if(isset($_POST['fecha'])){
    $fecha=$_POST['fecha'];
    include_once("controllerEmitirComprobante.php");
    $objController = new controllerEmitirComprobante;
    $objController->BuscarProformaFecha($fecha);

}
else if(isset($_POST['Proforma'])){
    $Proforma = $_POST['Proforma'];
    $fechaProforma=$Proforma['fecha'];
    $fechaActual=date('Y-m-d');
    $fechaValidar=date("Y-m-d",strtotime($fechaProforma."+ 1 days"));

    if(strtotime($fechaValidar)>=strtotime($fechaActual))
    {
        include_once("controllerEmitirComprobante.php");
        $objController = new controllerEmitirComprobante;
        $objController->ExtraerDetalleProforma($Proforma);
    }else{
        echo "0";
    }

}
else if(isset($_POST['Comprobante'])){
    $Comprobante = $_POST['Comprobante'];
    $DetalleComprobante = $_POST['DetalleComprobante'];
    $res="";
    if($Comprobante['tipo']=="F")
    {
        $documento=trim($Comprobante['documento']);
        $nom_documento=trim($Comprobante['nom_cliente']);

        if(strlen($documento)>0 && strlen($nom_documento)>0){
            include_once("controllerEmitirComprobante.php");
            $objController = new controllerEmitirComprobante;
            $res=$objController->InsertarComprobante($Comprobante,$DetalleComprobante);
        }else{
            $res= "Debe ingresar el RUC y Razón social";
        }
    }else{
        include_once("controllerEmitirComprobante.php");
        $objController = new controllerEmitirComprobante;
        $res=$objController->InsertarComprobante($Comprobante,$DetalleComprobante);
    }
    echo $res;

}
else{
    include_once("../shared/formMensajeSistema.php");
    $objMensaje = new formMensajeSistema;
    $objMensaje -> formMensajeSistemaShow("Se ha detectado un acceso no permitido","<a href='../index.php'>Ingrese adecuadamente</a>");
}


?>