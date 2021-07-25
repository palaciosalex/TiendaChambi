<?php
    include_once("../shared/formulario.php");
    class formPreguntaSecreta extends formulario{
        public function formPreguntaSecretaShow($data=null,$login){
            $this -> encabezadoShow("Pregunta Secreta");
            ?>            
            
            <form action="../moduloSeguridad/getUsuario.php" method="POST" >
            <table class="ADSLogin">
                <tr>
                    <td class="tdEspecial">Pregunta Secreta</td>
                </tr>
                <tr >
                    <td>
                        <label for="respuestaS" class="tituloPass">
                            <?php if(!is_null($data)){ echo $data['preguntaS'];} ?> 
                        </label>
                    </td>
                </tr>
                <tr >
                    <td><input type="text" name="respuestaS" id="respuestaS" class="inpPass"></td>
                    <input value="<?php echo $login; ?>" type="hidden" name="login" id="login" class="inpPass">
                </tr>
                
                
                <tr>
                    <td><input type="submit" class="btncontra" value="ACEPTAR" name="btnAceptar2"></td>
                </tr>
            </table>
            </form>
            <?php          
            $this->piePaginaShow();
        }
    }
?>