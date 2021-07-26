<?php 
include_once("conexion.php");
    class proforma extends conexion{
        public function obtenerCodigoNuevo(){  
            $conn=$this->conectar();
            $SQLP ="SELECT codigo from proforma ORDER BY idproforma DESC LIMIT 1";
            $result = mysqli_query($conn,$SQLP);
            $this->desconectar($conn);  
            $numero_filas = mysqli_num_rows($result); 
            $ultimoCodigo="";

            if($numero_filas==1){
                while ($proforma = $result->fetch_assoc()) {
                    $ultimoCodigo = $proforma['codigo'];
                }
                $cod = explode("-", $ultimoCodigo);
                $numCod = intval($cod[1])+1;
                $nDigitos = 4-strlen($numCod);
                $nuevoCodigo = "PF-";
                while($nDigitos>0){
                    $nuevoCodigo.= "0";
                    $nDigitos--;
                }
                $nuevoCodigo.= strval($numCod);
  
            }else{
                $nuevoCodigo="PF-0001";
            }
            
            return ($nuevoCodigo);
            
        }
        public function insertarProforma($codigo,$fecha,$monto){  
            $conn=$this->conectar();
            $SQLP ="INSERT INTO proforma (codigo, fecha, monto_total) VALUES ('$codigo','$fecha',$monto)";
            $result = mysqli_query($conn,$SQLP);
            $this->desconectar($conn);      
            
        }
        public function BuscarIDProforma($id4){
                $conn=$this->conectar();
                $SQLP ="SELECT idproforma FROM proforma WHERE codigo ='$id4' ";
                $resultado2 = mysqli_query($conn,$SQLP);  
                $this->desconectar($conn); 
                while ($fila = mysqli_fetch_assoc($resultado2)) {
                    return ($fila['idproforma']);
                }                 
        }

        public function ExtraerProformas(){
            $conn=$this->conectar();
            $SQLP ="SELECT * FROM proforma ORDER BY idproforma DESC LIMIT 20";
            $resultado = mysqli_query($conn,$SQLP);  
            $this->desconectar($conn); 
            $ListaProformas=array();
            $numero_filas = mysqli_num_rows($resultado); 
            for($i=0;$i < $numero_filas;$i++){
                $ListaProformas[$i] =mysqli_fetch_array($resultado);
            }            
            return ($ListaProformas);           
        }

        public function BuscarProformaCodigo($codigoProforma){
            $conn=$this->conectar();
            $SQLP ="SELECT * FROM proforma WHERE codigo='$codigoProforma'";
            $resultado = mysqli_query($conn,$SQLP);  
            $this->desconectar($conn); 
            $ListaProformas=array();
            $numero_filas = mysqli_num_rows($resultado); 
            for($i=0;$i < $numero_filas;$i++){
                $ListaProformas[$i] =mysqli_fetch_array($resultado);
            }            
            return ($ListaProformas);           
        }

        public function BuscarProformaFecha($fecha){
            $conn=$this->conectar();
            $SQLP ="SELECT * FROM proforma WHERE fecha='$fecha'";
            $resultado = mysqli_query($conn,$SQLP);  
            $this->desconectar($conn); 
            $ListaProformas=array();
            $numero_filas = mysqli_num_rows($resultado); 
            for($i=0;$i < $numero_filas;$i++){
                $ListaProformas[$i] =mysqli_fetch_array($resultado);
            }            
            return ($ListaProformas);           
        }
    }
?>