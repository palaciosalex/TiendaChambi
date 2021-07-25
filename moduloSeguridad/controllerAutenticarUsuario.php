<?php
    class controllerAutenticarUsuario{
        public function ValidarUsuario($login,$password){
            include_once("../model/usuario.php");
            $objUsuario = new usuario;
            $resultado = $objUsuario->VerificarUsuario($login,$password);
            if($resultado == 0)
			{
				include_once("../shared/formMensajeSistema.php");	
				$objMensaje = new formMensajeSistema;
				$objMensaje  -> formMensajeSistemaShow("Usuario no encontrado o está inactivo","<a href='../index.php'>Ir al inicio</a>");		
			}
			else{
                session_start();
                include_once("../model/usuarioPrivilegio.php");
                $objPrivilegio = new usuarioPrivilegio;
                $listaPrivilegios = $objPrivilegio -> obtenerPrivilegiosUsuario($resultado[0]['idUsuario']);
                $_SESSION['login'] = $resultado[0]['login'];
                include_once("formMenuPrincipal.php");
                $objMenuPrincipal = new formMenuPrincipal;
                $objMenuPrincipal -> formMenuPrincipalShow($listaPrivilegios);
            } 
        }

        public function ObtenerIDUsuario($login){
            include_once("../model/usuario.php");
            $objUsuario = new usuario;
            $resultado = $objUsuario->ObtenerIDUsuario($login);
            return $resultado;
        }
    }
?>