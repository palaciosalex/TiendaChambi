<?php

class controllerEmitirComprobante{
    public function ExtraerProformas(){
        include_once("../model/proforma.php");
        $objProforma = new proforma;
        $ListaProformas = $objProforma->ExtraerProformas();
        $filas=count($ListaProformas);
        $arr=array();
        $resultado="";
        if($filas>0){
            for($i=0;$i<$filas;$i++){

                $resultado.="<tr>
                                <td>".$ListaProformas[$i]['codigo']."</td>
                                <td><input type='date' id='fecha".$ListaProformas[$i]['idproforma']."' value='".$ListaProformas[$i]['fecha']."' disabled /></td>
                                <td>S/. ".$ListaProformas[$i]['monto_total']."</td>
                                <td><button type='button' class='btn btn-primary' onclick='SeleccionarProforma(".$i.")'>Seleccionar</button></td>
                            </tr>";

            }
        }else{
            $resultado="<p>No se encontro ningun resultado</p>";
        }
        $arr=array(
            'resultado' => $resultado,
            'ListaProformas' => $ListaProformas
        );
        echo json_encode($arr);
    }

    public function obtenerCodigoNuevo(){
        include_once("../model/comprobante.php");
        $objComprobante = new comprobante;
        $codigoNuevo= $objComprobante->obtenerCodigoNuevo();

        echo $codigoNuevo;
    }
    public function BuscarProformaCodigo($codigoProforma){
        include_once("../model/proforma.php");
        $objProforma = new proforma;
        $ListaProformas = $objProforma->BuscarProformaCodigo($codigoProforma);
        $filas=count($ListaProformas);
        $arr=array();
        $resultado="";
        if($filas>0){
            for($i=0;$i<$filas;$i++){

                $resultado.="<tr>
                                <td>".$ListaProformas[$i]['codigo']."</td>
                                <td><input type='date' id='fecha".$ListaProformas[$i]['idproforma']."' value='".$ListaProformas[$i]['fecha']."' disabled /></td>
                                <td>S/. ".$ListaProformas[$i]['monto_total']."</td>
                                <td><button type='button' class='btn btn-primary' onclick='SeleccionarProforma(".$i.")'>Seleccionar</button></td>
                            </tr>";

            }
        }else{
            $resultado="<p>No se encontro ningun resultado</p>";
        }
        $arr=array(
            'resultado' => $resultado,
            'ListaProformas' => $ListaProformas
        );
        echo json_encode($arr);
    }

    public function BuscarProformaFecha($fecha){
        include_once("../model/proforma.php");
        $objProforma = new proforma;
        $ListaProformas = $objProforma->BuscarProformaFecha($fecha);
        $filas=count($ListaProformas);
        $arr=array();
        $resultado="";
        if($filas>0){
            for($i=0;$i<$filas;$i++){

                $resultado.="<tr>
                                <td>".$ListaProformas[$i]['codigo']."</td>
                                <td><input type='date' id='fecha".$ListaProformas[$i]['idproforma']."' value='".$ListaProformas[$i]['fecha']."' disabled /></td>
                                <td>S/. ".$ListaProformas[$i]['monto_total']."</td>
                                <td><button type='button' class='btn btn-primary' onclick='SeleccionarProforma(".$i.")'>Seleccionar</button></td>
                            </tr>";

            }
        }else{
            $resultado="<p>No se encontro ningun resultado</p>";
        }
        $arr=array(
            'resultado' => $resultado,
            'ListaProformas' => $ListaProformas
        );
        echo json_encode($arr);
    }


    public function ExtraerDetalleProforma($proforma){
        include_once("../model/detalleProforma.php");
        $objdetalleProforma = new detalleProforma;
        $DetalleProforma = $objdetalleProforma->ExtraerDetalleProforma($proforma['idproforma']);
        $filas=count($DetalleProforma);
        $arr=array();
        $resultado="";
        if($filas>0){
            for($i=0;$i<$filas;$i++){

                $cantidad=$DetalleProforma[$i]['cantidad'];
                $monto=$DetalleProforma[$i]['monto'];
                $envases=$DetalleProforma[$i]['envases'];
                $precioUnitario=($monto-$envases)/$cantidad;
 
                $resultado.="<tr>
                                <td>".$DetalleProforma[$i]['producto']."</td>
                                <td>".$cantidad."</td>
                                <td>".$precioUnitario."</td>
                                <td>".$envases."</td>
                                <td>".$monto."</td>
                            </tr>";

            }
        }else{
            $resultado="<p>No se encontro ningun resultado</p>";
        }
        $arr=array(
            'resultado' => $resultado,
            'DetalleProforma' => $DetalleProforma
        );
        echo json_encode($arr);
    }

    public function InsertarComprobante($Comprobante,$DetalleComprobante){
        include_once("../model/comprobante.php");
        $objComprobante = new comprobante;
        $res=$objComprobante->InsertarComprobante($Comprobante);
        if($res="1"){
            $codigo=$Comprobante['codigo'];
            $idComprobante=$objComprobante->obtenerIDComprobante($codigo);
            include_once("../model/detalleComprobante.php");
            $objDetalleComprobante = new detalleComprobante;
            $res=$objDetalleComprobante->InsertarDetalleComprobante($DetalleComprobante,$idComprobante);
            if($res="1"){
                include_once("../model/producto.php");
                $objProducto = new producto;
                $res=$objProducto->ActualizarStock($DetalleComprobante);
            }
            return $res;
        }else{
            return $res;
        }
    }
}



?>