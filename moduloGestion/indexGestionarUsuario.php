<?php
 $boton = $_POST['bntOk'];
 if(isset($boton)){ 
     session_start();
     $_SESSION['login'];
     include_once("formGestionarUsuario.php");
     $objCierreCaja = new formGestionarUsuario;
     $objCierreCaja -> formGestionarUsuarioShow();

 }
 else{
     include_once("../shared/formMensajeSistema.php");
     $objMensaje = new formMensajeSistema;
     $objMensaje -> formMensajeSistemaShow("ACCESO NO AUTORIZADO","<a href='../index.php'>Volver a Formulario Autenticar</a>");
 }
 ?>