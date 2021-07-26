<?php
 //$boton = $_POST['bntOk'];
 if(isset($_POST['bntOk'])){
     session_start();
     $_SESSION['login'];
     include_once("formGestionarReclamo.php");
     $objGestionarRe = new formGestionarReclamo;
     $objGestionarRe -> formGestionarReclamoShow();
 }
 else{
     include_once("../shared/formMensajeSistema.php");
     $objMensaje = new formMensajeSistema;
     $objMensaje -> formMensajeSistemaShow("Se ha detectado un acceso no permitido","<a href='../index.php'>Ingrese adecuadamente</a>");
 }
 ?>