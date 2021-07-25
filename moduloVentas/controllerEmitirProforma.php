<?php
class controllerEmitirProforma{

        public function BuscarProducto($id){
            include_once("../model/producto.php");
            $objProductoq = new producto;
            $resultado = $objProductoq->BuscarProducto($id);
            $arr =  array(
                        'id' => $resultado[0]['id'],
                        'producto' => $resultado[0]['producto'],
                        'stock' => $resultado[0]['stock'], 
                        'precioU' => $resultado[0]['precioU']
                    );
            echo json_encode($arr);
        }
        public function ExtraerProductos(){
            include_once("../model/producto.php");
            $objProductoq = new producto;
            $ListaProductos = $objProductoq->ExtraerProductos();
            $filas=count($ListaProductos);
            $arr=array();
            for($i=0;$i<$filas;$i++){
                $arr[$i] = array(
                    'id' => $ListaProductos[$i]['id'],
                    'producto' => $ListaProductos[$i]['producto'], 
                    'stock' => $ListaProductos[$i]['stock'],
                    'precioU' => $ListaProductos[$i]['precioU'],
                    'imagen' => $ListaProductos[$i]['imagen']
                );
            }
            echo json_encode($arr);
        
        }
        public function ObtenerCodigoNuevo(){
            include_once("../model/proforma.php");
            $objProforma = new Proforma;
            $codigoNuevo = $objProforma->obtenerCodigoNuevo();
            echo $codigoNuevo;
        }
        public function InsertarProforma($codigo,$fecha,$monto){
            include_once("../model/proforma.php");
            $objProforma = new Proforma;
            $codigoNuevo = $objProforma->insertarProforma($codigo,$fecha,$monto);
            echo $codigoNuevo;
        }
        public function insertarDetalleProforma($id_producto,$cantidad, $envases,$monto,$idProforma){
            include_once("../model/detalleProforma.php");
            $objDetalleProforma = new detalleProforma;
            $objDetalleProforma->insertarDetalleProforma($id_producto,$cantidad, $envases,$monto,$idProforma);

        }
        public function BuscarIDProforma($id){
            include_once("../model/proforma.php");
            $objProforma = new Proforma;
            $codigo = $objProforma->BuscarIDProforma($id);
            return $codigo;
        }


        public function BuscarProductoNombre($txtNombre){

            include_once("../model/producto.php");
            $objProductoq = new producto;
            $ListaProductos = $objProductoq->BuscarProductoNombre($txtNombre);

            $filas=count($ListaProductos);
            $arr=array();
            for($i=0;$i<$filas;$i++){
                $arr[$i] = array(
                            'id' => $ListaProductos[$i]['id'],
                            'producto' => $ListaProductos[$i]['producto'], 
                            'stock' => $ListaProductos[$i]['stock'],
                            'precioU' => $ListaProductos[$i]['precioU'],
                            'imagen' => $ListaProductos[$i]['imagen']
                );
            }
            echo json_encode($arr);

            
        }
    }
?>