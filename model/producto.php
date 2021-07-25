<?php 
include_once("conexion.php");
    class producto extends conexion{
        public function ExtraerProductos(){  
            $conn=$this->conectar();
            $SQLP ="SELECT * FROM producto LIMIT 12";
            $result = mysqli_query($conn,$SQLP);
            $this->desconectar($conn);
            $producto=array();
            $numero_filas = mysqli_num_rows($result); 
            for($i=0;$i < $numero_filas;$i++){
                $producto[$i] =mysqli_fetch_array($result);
            }            
            return ($producto);
        }
        public function BuscarProducto($id){  
            $conn=$this->conectar();
            $SQLP ="SELECT * FROM producto WHERE id = $id";
            $resulti = mysqli_query($conn,$SQLP);
            $this->desconectar($conn);
            $numero_filas = mysqli_num_rows($resulti); 
            for($i=0;$i < $numero_filas;$i++){
                $productob[$i] =mysqli_fetch_array($resulti);
            }            
            return ($productob);
        }
        public function BuscarProductoNombre($nombre){  
            $conn=$this->conectar();
            $SQLP ="SELECT * FROM producto WHERE producto LIKE '%$nombre%'";
            $resulti = mysqli_query($conn,$SQLP);
            $this->desconectar($conn);
            $ListaProductos=array();
            $numero_filas = mysqli_num_rows($resulti);
            for($i=0;$i < $numero_filas;$i++){
                $ListaProductos[$i] =mysqli_fetch_array($resulti);
            }   
            return ($ListaProductos);  
        }
    }
?>