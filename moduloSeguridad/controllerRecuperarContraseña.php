<?php
    class controllerRecuperarContraseña{
        public function ComprobarUsuario($login){
            include_once("../model/usuario.php");
            $objUsuario = new usuario;
            $resultado = $objUsuario->ComprobarUsuario($login);
            if(is_null($resultado))
			{
				include_once("../shared/formMensajeSistema.php");	
				$objMensaje = new formMensajeSistema;
				$objMensaje  -> formMensajeSistemaShow("Usuario no encontrado o está inactivo","<a href='IndexRecuperarContraseña.php'>Ir al inicio</a>");		
			}
			else{
                include_once("formPreguntaSecreta.php");
                $objPreguntaSecreta = new formPreguntaSecreta;
                $objdata = ["preguntaS" => $resultado ];
                $objPreguntaSecreta -> formPreguntaSecretaShow($objdata,$login);
            } 
        }
        public function ExtraerRespuesta($respuestaS,$login){
            include_once("../model/usuario.php");
            $objUsuario = new usuario;
            $resultado = $objUsuario->ExtraerRespuesta($respuestaS,$login);
            if($resultado == 0)
			{
				include_once("../shared/formMensajeSistema.php");	
				$objMensaje = new formMensajeSistema;
				$objMensaje  -> formMensajeSistemaShow("Usuario no encontrado o está inactivo","<a href='../index.php'>Ir al inicio</a>");		
			}
			else{
                include_once("formRecuperarContraseña.php");
                $objPreguntaSecreta = new formRecuperarContraseña;
                $objPreguntaSecreta -> formRecuperarContraseñaShow($login);
            } 
        }
        public function ValidarControllerContras2($ncontra,$login){
            include_once("../model/usuario.php");
            $objUsuario = new usuario;
            $objUsuario->AcualizarContra($login,$ncontra);
            include_once("../shared/formMensajeSistema.php");	
			$objMensaje = new formMensajeSistema;
			$objMensaje  -> formMensajeSistemaShow("Contraseña Cambiada exitosamente","<a href='../index.php'>Vuelva Loguearse</a>");	
            
        }
    }
?>