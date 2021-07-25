<?php
    include_once("./shared/formulario.php");
    class formAutenticarUsuario extends formulario{
        public function formAutenticarUsuarioShow(){
            $this -> encabezadoShowInit("Autenticar Usuario");
            ?>
             <form action="./moduloSeguridad/getUsuario.php" method="POST" >
                <table class="ADSLogin">
                    <tr>
                        <td colspan="3" class="tdEspecial">Autenticar Usuario</td>
                    </tr>
                    <tr >
                        <td colspan="3" class="imgLogin"><img src="./imagenes/user.png" alt=""></td>                        
                    </tr>
                    <tr >
                        <td>Login</td>
                        <td><input type="text" name="login" id="login"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password" id="password"></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input type="submit" class="btnTacza" value="LOG IN" name="btnEnviar"></td>
                    </tr>
                    <tr>
                        <td colspan="3"><a href="./moduloSeguridad/IndexRecuperarContraseña.php" class="hiperaTaacza">Recuperar Contraseña</a></td>
                    </tr>
                </table>
             </form>
            <?php          
            $this->piePaginaShow();
        }
    }
?>