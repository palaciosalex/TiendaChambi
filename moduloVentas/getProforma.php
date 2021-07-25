<?php
    function validarCampos($detalleProforma,$num_filas){
        $devolver;
        for($i=0;$i<$num_filas;$i++){
            if( $detalleProforma[$i]['cantidad'] > 0 && $detalleProforma[$i]['envases'] >= 0 && $detalleProforma[$i]['monto'] > 0 ){
                $devolver = 1;
            }
            else{
                $devolver = 0;
                break;
            }
        }
        return $devolver;    
    }
    if(isset($_POST['extraerProductos'])){
        include_once("controllerEmitirProforma.php");
        $objController = new controllerEmitirProforma();
        $objController->ExtraerProductos();
    }
    else if(isset($_POST['ObtenerCodigoNuevo'])){
        include_once("controllerEmitirProforma.php");
        $objController = new controllerEmitirProforma();
        $objController->ObtenerCodigoNuevo();
    }
    else if(isset($_POST['idlngp'])){
        $id = $_POST['idlngp'];
        include_once("controllerEmitirProforma.php");
        $objController = new controllerEmitirProforma();
        $objController->BuscarProducto($id);
        
    }
    else if(isset($_POST['txtNombre'])){
        $txtNombre = trim($_POST['txtNombre']);
        include_once("controllerEmitirProforma.php");
        $objController = new controllerEmitirProforma();
        $objController->BuscarProductoNombre($txtNombre);
    }
    else if(isset($_POST['Proforma'])){
        $Proforma = $_POST['Proforma'];
        if(empty($_POST['DetalleProforma'])){
            echo "Debe agregar al menos un producto";
        }else{
            $detalleProforma = $_POST['DetalleProforma'];
            $num_filas=count($detalleProforma);
            $devolver = validarCampos($detalleProforma,$num_filas);
            if($devolver == 0){
                echo "Algunos campos estan vacios";
            }
            else if($devolver == 1){
                for($i=0;$i<$num_filas;$i++){
                    /*************Inserto proforma a la BD */
                    if($i == 0){
                        include_once("controllerEmitirProforma.php");
                        $objController = new controllerEmitirProforma();
                        $objController->insertarProforma($Proforma['codigo'],$Proforma['fecha'],$Proforma['monto_total']);   
                        $idPRoforma45 = $objController->BuscarIDProforma($Proforma['codigo']);                  
                    } 
                    /**********************Inserto detalle proforma */
                    
                    $objController->insertarDetalleProforma($detalleProforma[$i]['id_producto'],
                    $detalleProforma[$i]['cantidad'],$detalleProforma[$i]['envases'],$detalleProforma[$i]['monto'],$idPRoforma45);                  
                }
            }
        }
    }
    else{
        include_once("../shared/formMensajeSistema.php");
        $objMensaje = new formMensajeSistema;
        $objMensaje -> formMensajeSistemaShow("Se ha detectado un acceso no permitido","<a href='../index.php'>Ingrese adecuadamente</a>");
    }
       
 ?>