<?php
    include_once("formulario.php");
    class formMensajeConfirmar extends formulario{
        public function formMensajeConfirmarShow($mensaje){
            $this -> encabezadoShow("Mensaje Confirmacion");
            ?>
            <form method="POST" action="#">
            <table class="ADSLogin">
                <tr>  
                    <td class="tdConfirm" colspan="2">MENSAJE DE CONFIRMACION</td>
                </tr>
                <tr>
                    <td class="imgLogin" colspan="2"><img src="../imagenes/mconfirm.png" alt=""></td>
                </tr>
                <tr>
                    <td class="tdMensajeSecu" colspan="2"><?php echo $mensaje; ?></td> 
                </tr>
                <tr>
                    <td><button class='btnleft' type='submit'>ACEPTAR </button></td>
                    <td><button class="btnrigth" type='submit'>CANCELAR</button></td>
                </tr>
            </table>
            </form>
            <?php 
                 
            $this->piePaginaShow();            
        }
    }
?>