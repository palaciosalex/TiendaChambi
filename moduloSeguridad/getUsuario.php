<?php

function ComprobarRespuesta($respuestaS){
    if(strlen($respuestaS)>3  ){
        return (1);
    }
    else{
        return (0);
    }
}
function ComprobarCampo($login){
    if(strlen($login)>3  ){
        return (1);
    }
    else{
        return (0);
    }
}
function validarCampos($login,$password){
    if(strlen($login)>3 and strlen($password)>3){
        return (1);
    }
    else{
        return (0);
    }
}
function validarContras2($ncontra,$ccontra){
    if(strlen($ncontra)>0 and strlen($ccontra)>0){
        return (1);
    }
    else{
        return (0);
    }
}
function validarContras($ncontra,$acontra,$ccontra){
    if(strlen($ncontra)>0 and strlen($acontra)>0 and strlen($ccontra)>0){
        return (1);
    }
    else{
        return (0);
    }
}
function validarIgualdad($ncontra,$ccontra){
    if($ncontra == $ccontra){
        return (1);
    }
    else{
        return (0);
    }
}

/********************************** */
//$botonLogin = $_POST['btnEnviar'];
//$botonContra = $_POST['btnContrasena'];
if(isset($_POST['btnEnviar'])){
    $login = trim(strtolower($_POST['login']));
    $password = trim($_POST['password']);
    $resultado_validacion_campos= validarCampos($login,$password);
    if($resultado_validacion_campos==0){
        include_once("../shared/formMensajeSistema.php");
        $objMensaje = new formMensajeSistema;
        $objMensaje -> formMensajeSistemaShow("Los datos ingresados no son válidos para cotejo","<a href='../index.php'>Intente nuevamente</a>");
    }else{
        include_once("controllerAutenticarUsuario.php");
        $objController = new controllerAutenticarUsuario;
        $objController -> ValidarUsuario($login,$password);
    }
}
else if(isset($_POST['btnContrasena'])){
    $ncontra = trim($_POST['ncontra']);
    $acontra = trim($_POST['acontra']);
    $ccontra = trim($_POST['ccontra']);
    $login = $_POST['loginc'];
    $resultado_validacion_contras= validarContras($ncontra,$acontra,$ccontra);
    $resultado_igual_contras= validarIgualdad($ncontra,$ccontra);
    $dirigir = "<form method='POST' action='indexCambiarPassword.php'>
                        <input type='submit' class='btnTacza' name='bntOk' value='Volver' />
                </form>";
    if($resultado_igual_contras==0){
        include_once("../shared/formMensajeSistema.php");
        $objMensaje = new formMensajeSistema;        
        $objMensaje -> formMensajeSistemaShow("Los campos no son coinciden",$dirigir);
    }else if($resultado_validacion_contras==0){
        include_once("../shared/formMensajeSistema.php");
        $objMensaje = new formMensajeSistema;
        $objMensaje -> formMensajeSistemaShow("Los datos ingresados no son válidos para cotejo",$dirigir);
    }else{
        include_once("controllerCambiarContrasena.php");
        $objControllerContra = new controllerCambiarContrasena;
        $objControllerContra -> ValidarControllerContras($ncontra,$acontra,$login);
    }
} else if(isset($_POST['retrocede'])){
    session_start();
    include_once("../model/usuarioPrivilegio.php");
    include_once("controllerAutenticarUsuario.php");
    $objController = new controllerAutenticarUsuario;
    $idUsuario= $objController -> ObtenerIDUsuario($_SESSION['login']);

    $objPrivilegio = new usuarioPrivilegio;
    $listaPrivilegios = $objPrivilegio -> obtenerPrivilegiosUsuario($idUsuario);
    $_SESSION['login'] = $_POST['login'];
    include_once("formMenuPrincipal.php");
    $objMenuPrincipal = new formMenuPrincipal;
    $objMenuPrincipal -> formMenuPrincipalShow($listaPrivilegios);
}
else if(isset($_POST['btnAceptar'])){
    $login = trim(strtolower($_POST['login']));
    $resultado_comprobar_campos= ComprobarCampo($login);
    if($resultado_comprobar_campos==0){
        include_once("../shared/formMensajeSistema.php");
        $objMensaje = new formMensajeSistema;
        $objMensaje -> formMensajeSistemaShow("Los datos ingresados no son válidos para cotejo","<a href='IndexRecuperarContraseña.php'>Intente nuevamente</a>");
    }else{
        include_once("controllerRecuperarContraseña.php");
        $objController = new controllerRecuperarContraseña;
        $objController -> ComprobarUsuario($login);
    }
}
else if(isset($_POST['btnAceptar2'])){
    $respuestaS = trim(strtolower($_POST['respuestaS']));
    $login =  trim(strtolower($_POST['login']));

    
    $resultado_comprobar_respuesta= ComprobarRespuesta($respuestaS);
    if($resultado_comprobar_respuesta==0){
        include_once("../shared/formMensajeSistema.php");
        $objMensaje = new formMensajeSistema;
        $objMensaje -> formMensajeSistemaShow("Los datos ingresados no son válidos para cotejo","<a href='IndexRecuperarContraseña.php'>Intente nuevamente</a>");
    }else{
        include_once("controllerRecuperarContraseña.php");
        $objController = new controllerRecuperarContraseña;
        $objController -> ExtraerRespuesta($respuestaS,$login);
    }
}
else if(isset($_POST['btnContrasena2'])){
    $ncontra = trim($_POST['ncontra']);
    $ccontra = trim($_POST['ccontra']);
    $login = trim($_POST['login']);
    $resultado_validacion_contras= validarContras2($ncontra,$ccontra);
    $resultado_igual_contras= validarIgualdad($ncontra,$ccontra);
    $dirigir = "<form method='POST' action='IndexRecuperarContraseña.php'>
                        <input type='submit' class='btnTacza' name='bntOk' value='Volver' />
                </form>";
    if($resultado_igual_contras==0){
        include_once("../shared/formMensajeSistema.php");
        $objMensaje = new formMensajeSistema;        
        $objMensaje -> formMensajeSistemaShow("Los campos no coinciden",$dirigir);
    }else if($resultado_validacion_contras==0){
        include_once("../shared/formMensajeSistema.php");
        $objMensaje = new formMensajeSistema;
        $objMensaje -> formMensajeSistemaShow("Los datos ingresados no son válidos para cotejo",$dirigir);
    }else{
        include_once("controllerRecuperarContraseña.php");
        $objControllerContra = new controllerRecuperarContraseña;
        $objControllerContra -> ValidarControllerContras2($ncontra,$login);
    }
}
else{
    include_once("../shared/formMensajeSistema.php");
    $objMensaje = new formMensajeSistema;
    $objMensaje -> formMensajeSistemaShow("Se ha detectado un acceso no permitido","<a href='../index.php'>Ingrese adecuadamente</a>");
}
 ?>