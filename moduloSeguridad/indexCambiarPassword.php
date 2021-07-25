<?php
 $boton = $_POST['bntOk'];
 if(isset($boton)){
     session_start();
     $_SESSION['login'];
     include_once("formCambiarContrasena.php");
     $objCambirContra = new formCambiarContrasena;
     $objCambirContra -> formCambiarContrasenaShow();    
 }
 else{
     include_once("../shared/formMensajeSistema.php");
     $objMensaje = new formMensajeSistema;
     $objMensaje -> formMensajeSistemaShow("Se ha detectado un acceso no permitido","<a href='../index.php'>Ingrese adecuadamente</a>");
 }
 ?>