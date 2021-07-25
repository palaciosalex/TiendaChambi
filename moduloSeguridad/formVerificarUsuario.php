<?php
    include_once("../shared/formulario.php");
    class formVerificarUsuario extends formulario{
        public function formVerificarUsuarioShow(){
            $this -> encabezadoShow("Verificar Usuario");
            ?>            
            
            <form action="../moduloSeguridad/getUsuario.php" method="POST" >
            <table class="ADSLogin">
                <tr>
                    <td class="tdEspecial">Verificar Usuario</td>
                </tr>
                <tr >
                    <td><label for="login" class="tituloPass">INGRESE SU USUARIO</label></td>
                </tr>
                <tr >
                    <td><input type="text" name="login" id="login" class="inpPass"></td>
                </tr>
               
                <tr>
                    <td><input type="submit" class="btncontra" value="ACEPTAR" name="btnAceptar"></td>
                </tr>
            </table>
            </form>
            <?php          
            $this->piePaginaShow();
        }
    }
?>