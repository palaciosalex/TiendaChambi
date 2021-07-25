<?php
    class controllerCambiarContrasena{
        public function ValidarControllerContras($ncontra,$acontra,$loginc){
            include_once("../model/usuario.php");
            $objUsuario = new usuario;
            $resultado = $objUsuario->VerificarUsuario($loginc,$acontra);
            if($resultado == 0)
			{
				include_once("../shared/formMensajeSistema.php");	
				$objMensaje = new formMensajeSistema;
                $dirigir = "<form method='POST' action='indexCambiarPassword.php'>
                        <input type='hidden' name='login' value='$loginc'/>
                        <input type='submit' class='btnTacza' name='bntOk' value='Volver'/>
                </form>";
				$objMensaje  -> formMensajeSistemaShow("La Contraseña no Existe",$dirigir);		
			}
			else{
                $objUsuario->AcualizarContra($loginc,$ncontra);
                include_once("../shared/formMensajeSistema.php");	
				$objMensaje = new formMensajeSistema;
				$objMensaje  -> formMensajeSistemaShow("Contraseña Cambiada exitosamente","<a href='../index.php'>Vuelva Loguearse</a>");	
            }
        }
    }
?>