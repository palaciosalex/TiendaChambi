<?php
class controllerGestionarUsuario{

        public function ExtraerUsuarios(){
            include_once("../model/usuario.php");
            $objUsuario = new usuario;
            $ListaUsuario = $objUsuario->ExtraerUsuarios();
            $filas=count($ListaUsuario);
            $arr=array();
            for($i=0;$i<$filas;$i++){
                $arr[$i] = array(
                    'idUsuario' => $ListaUsuario[$i]['idUsuario'],
                    'login' => $ListaUsuario[$i]['login'],
                    'dni' => $ListaUsuario[$i]['DNI'], 
                    'nombre' => $ListaUsuario[$i]['nombre'],
                    'password' => $ListaUsuario[$i]['password'],
					'preguntaS' => $ListaUsuario[$i]['preguntaS'],
                    'respuestaS' => $ListaUsuario[$i]['respuestaS'],
                    'rol' => $ListaUsuario[$i]['rol'],
                    'estado' => $ListaUsuario[$i]['estado'],
                );
            }
            echo json_encode($arr);
        
        }
        public function UpdateUsuarios($idGuardarUsuarioM,$user,$contra,$nombre,$dni,$pes,$res,$rol){
            include_once("../model/usuario.php");
            $objUsuario = new usuario;
            $objUsuario->UpdateUsuarios($idGuardarUsuarioM,$user,$contra,$nombre,$dni,$pes,$res,$rol);
        }
        public function BuscarUsuarioEdit($idEditar){
            include_once("../model/usuario.php");
            $objUsuario = new usuario;
            $resultado = $objUsuario->BuscarUsuarioEdit($idEditar);
            $arr =  array(
                        'idUsuario' => $resultado[0]['idUsuario'],
                        'login' => $resultado[0]['login'],
                        'dni' => $resultado[0]['DNI'], 
                        'nombre' => $resultado[0]['nombre'],
                        'password' => $resultado[0]['password'],
                        'preguntaS' => $resultado[0]['preguntaS'],
                        'respuestaS' => $resultado[0]['respuestaS'],
                        'rol' => $resultado[0]['rol'],
                        'estado' => $resultado[0]['estado']
                    );
            echo json_encode($arr);
        }
        public function insertarUsuarios($user,$contra,$nombre,$dni,$pes,$res,$rol){
            include_once("../model/usuario.php");
            $objUsuario = new usuario;
            $objUsuario->insertarUsuarios($user,$contra,$nombre,$dni,$pes,$res,$rol);
        }
        public function EliminarUsuario($idEliminar){
            include_once("../model/usuario.php");
            $objUsuario = new usuario;
            $objUsuario->EliminarUsuario($idEliminar);
        }
        
        public function BuscarUsuarioLogin($buscar){
            include_once("../model/usuario.php");
            $objUsuario = new usuario;
            $ListaUsuario = $objUsuario->BuscarUsuarioLogin($buscar);
            $filas=count($ListaUsuario);
            $arr=array();
            for($i=0;$i<$filas;$i++){
                $arr[$i] = array(
                    'idUsuario' => $ListaUsuario[$i]['idUsuario'],
                    'login' => $ListaUsuario[$i]['login'],
                    'dni' => $ListaUsuario[$i]['DNI'], 
                    'nombre' => $ListaUsuario[$i]['nombre'],
                    'password' => $ListaUsuario[$i]['password'],
					'preguntaS' => $ListaUsuario[$i]['preguntaS'],
                    'respuestaS' => $ListaUsuario[$i]['respuestaS'],
                    'rol' => $ListaUsuario[$i]['rol'],
                    'estado' => $ListaUsuario[$i]['estado'],
                );
            }
            echo json_encode($arr);
        
        }
        
    }
?>