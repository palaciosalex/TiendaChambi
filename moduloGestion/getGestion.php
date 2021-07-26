<?php
    function validacionCampos($user,$contra,$nombre,$dni,$pes,$res){
        if($user!="" and strlen($contra)>3 and $nombre!="" and strlen($dni)==8 and $pes!="" and $res!= ""){
            return 1;
        }else {
            return 0;
        }
    }
    if(isset($_POST['ExtraerUsuarios'])){
        include_once("controllerGestionarUsuario.php");
        $objController = new controllerGestionarUsuario;
        $objController->ExtraerUsuarios();
    }
    else if(isset($_POST['dniRegistro'])){
        $user = trim($_POST['user']);
        $contra = trim($_POST['contra']);
        $nombre = trim($_POST['nombre']);
        $dni = trim($_POST['dniRegistro']);
        $pes = trim($_POST['pes']);
        $res = trim($_POST['res']);
        $rol = trim($_POST['rol']);
        $validacion = validacionCampos($user,$contra,$nombre,$dni,$pes,$res);
        if($validacion==0){
            echo "Hay valores NO Validos";
        }else{
            include_once("controllerGestionarUsuario.php");
            $objController = new controllerGestionarUsuario;
            $objController->insertarUsuarios($user,$contra,$nombre,$dni,$pes,$res,$rol);
        }
    }
    else if (isset($_POST['buscar'])){
        $buscar = trim($_POST['buscar']);
        include_once("controllerGestionarUsuario.php");
        $objController = new controllerGestionarUsuario;
        $objController->BuscarUsuarioLogin($buscar);
    }
    else if (isset($_POST['idEliminar'])){
        $idEliminar = $_POST['idEliminar'];
        include_once("controllerGestionarUsuario.php");
        $objController = new controllerGestionarUsuario;
        $objController->EliminarUsuario($idEliminar);
    }
    else if(isset($_POST['idEditar'])){
        $idEditar = $_POST['idEditar'];
        include_once("controllerGestionarUsuario.php");
        $objController = new controllerGestionarUsuario;
        $objController->BuscarUsuarioEdit($idEditar);        
    }
    else if(isset($_POST['idGuardarUsuarioM'])){                     
        $idGuardarUsuarioM = trim($_POST['idGuardarUsuarioM']);          
        $user = trim($_POST['userM']);
        $contra = trim($_POST['contraM']);
        $nombre = trim($_POST['nombreM']);
        $dni = trim($_POST['dniModificar']);
        $pes = trim($_POST['pesM']);
        $res = trim($_POST['resM']);
        $rol = trim($_POST['rolM']);
        $validacion2 = validacionCampos($user,$contra,$nombre,$dni,$pes,$res);
        if($validacion2==0){
            echo "Hay valores NO Validos";
        }else{
            include_once("controllerGestionarUsuario.php");
            $objController = new controllerGestionarUsuario;
            $objController->UpdateUsuarios($idGuardarUsuarioM,$user,$contra,$nombre,$dni,$pes,$res,$rol); 
        }
    }
    else{
        include_once("../shared/formMensajeSistema.php");
        $objMensaje = new formMensajeSistema;
        $objMensaje -> formMensajeSistemaShow("Se ha detectado un acceso no permitido","<a href='../index.php'>Ingrese adecuadamente</a>");
  
    }
    
?>