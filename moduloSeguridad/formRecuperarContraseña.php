<?php
    include_once("../shared/formulario.php");
    class formRecuperarContraseña extends formulario{
        public function formRecuperarContraseñaShow($login){
            $this -> encabezadoShow("Recuperar Contraseña");
            ?>            
            
            <form action="../moduloSeguridad/getUsuario.php" method="POST" >
            <table class="ADSLogin">
                <tr>
                    <td class="tdEspecial">Recuperar Contraseña</td>
                
                <tr >
                    <td><label for="ncontra" class="tituloPass">INGRESE SU NUEVA CONTRASEÑA</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="ncontra" id="ncontra" class="inpPass"></td>
                </tr>
                <tr >
                    <td><label for="ccontra" class="tituloPass">CONFIRME SU NUEVA CONTRASEÑA</label></td>
                </tr>
                <tr>
                    <td><input type="text" name="ccontra" id="ccontra" class="inpPass"></td>
                    <input value="<?php echo $login; ?>" type="hidden" name="login" id="login" class="inpPass">
                </tr>
                <tr>
                    <td><input type="submit" class="btncontra" value="ACEPTAR" name="btnContrasena2"></td>
                </tr>
            </table>
            </form>
            <?php          
            $this->piePaginaShow();
        }
    }
?>