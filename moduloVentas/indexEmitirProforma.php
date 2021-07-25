<?php
 //$boton = $_POST['bntOk'];
 if(isset($_POST['bntOk'])){
     session_start();
     $_SESSION['login'];
     include_once("formEmitirProforma.php");
     $objEmitirP = new formEmitirProforma;
     $objEmitirP -> formEmitirProformaShow();
 }
 else{
     include_once("../shared/formMensajeSistema.php");
     $objMensaje = new formMensajeSistema;
     $objMensaje -> formMensajeSistemaShow("Se ha detectado un acceso no permitido","<a href='../index.php'>Ingrese adecuadamente</a>");
 }
 ?>