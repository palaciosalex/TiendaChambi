<?php
    include_once("../shared/formulario.php");
    class formGestionarUsuario extends formulario{
        public function formGestionarUsuarioShow(){
                $this -> encabezadoShowSimple("Gestionar Usuarios");
                ?>
                <div class="container usuario">
                <div class="row">
                    <div class="col-10">
                        <!--<p><i class='fas fa-user-alt'></i><?php echo $_SESSION['login'] ?>-->
                    </div>
                    <div class="col">
                        <form name="form3" method="post" action="../moduloSeguridad/getUsuario.php">                                                       
                                <button  style="color: white" name="retrocede" type="submit" class="btn btn-info" id="retrocede">
                                    VOLVER<i class="fa fa-arrow-circle-left"  style="margin-left:10px"></i>
                                </button>
                                <input name="login" type="hidden" id="login" value="<?php echo $_SESSION['login'] ?>">					
                        </form></p>
                    </div>
                </div>
            </div>
                <div class="container">
                    <div class="row">
                        <div class="col-4 lista">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h3 class="text-center" style="color:white">Registro de usuarios</h3>
                                </div>
                                <div class="card-body">
                                <form action="" method="post" id="frm">
                                    <div class="form-group">
                                        <label for="">LOGIN:</label>
                                        <input type="hidden" name="idp" id="idp" value="">
                                        <input type="text" name="user" id="user" placeholder="Login" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">CONTRASEÑA:</label>
                                        <input type="text" name="contra" id="contra" placeholder="Contraseña" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">NOMBRE:</label>
                                        <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">DNI</label>
                                        <input type="text" name="dni" id="dni" placeholder="Dni" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">PREG. SECRETA:</label>
                                        <input type="text" name="pes" id="pes" placeholder="Pregunta secreta" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">RESP. SECRETA:</label>
                                        <input type="text" name="res" id="res" placeholder="Respuesta secreta" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">ROL:</label>
                                        <select class="form-select form-select-sm" id="rol" aria-label=".form-select-sm example">
                                            <option value="Administrador">ADMINISTRADOR</option>
                                            <option value="Cajero">CAJERO</option>
                                            <option value="Vendedor">VENDEDOR</option>
                                            <option value="Despachador">DESPACHADOR</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <input type="button" value="Crear Usuario" id="registrar" onclick="registrarUsuario()" class="btn btn-primary btnRegistrarUsuarios">
                                        <input type="button" value="Modificar" id="editar" onclick="guardarUsuario()" class="btn btn-primary btnModificarUsuarios">
                                    </div>
                                    </form>    
                                </div>
                                </div>
                                
                        </div>
                        <div class="col-lg-8">
                            <div class="row">
                                <div class="col-lg-6 ml-auto">
                                    <form action="" method="post">
                                        <div class="form-group">
                                            <label for="buscra">BUSCAR POR LOGIN:</label>
                                            <input type="hidden" id="idOcultoModificar">
                                            <input type="text" onkeyup="BuscarUsuarioLogin()" name="buscar" id="buscar" placeholder="Ingrese su LOGIN" class="form-control">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <table class="table table-hover table-resposive text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>LOGIN</th>
                                        <th>CONTRASEÑA</th>
                                        <th>NOMBRE</th>
                                        <th>DNI</th>
                                        <th>P. SECRETA</th>
                                        <th>R. SECRETA</th>
                                        <th>ROL</th>
                                        <th>EDITAR</th>
                                        <th>ELIMINAR</th>
                                    </tr>
                                </thead>
                                <tbody id="lista_usuarios">
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
            <script>
                $('#editar').hide();
                ExtraerUsuarios();
                function guardarUsuario(){
                    var idGuardarUsuarioM = $('#idOcultoModificar').val();
                    var userM = $('#user').val();
                    var contraM = $('#contra').val();
                    var nombreM = $('#nombre').val();
                    var dniModificar = $('#dni').val();
                    var pesM = $('#pes').val();
                    var resM = $('#res').val();
                    var rolM = $('#rol').val();
                    $.post("getGestion.php",{idGuardarUsuarioM: idGuardarUsuarioM,userM: userM,contraM:contraM,nombreM:nombreM,dniModificar:dniModificar,pesM:pesM,resM:resM,rolM:rolM}, function (data) {                        
                        if(data == "Hay valores NO Validos"){
                            Swal.fire({
                                title: data,
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            });
                        }
                        else{
                            Swal.fire({
                                icon: 'success',
                                title: 'Modificado exitosamente',
                                showConfirmButton: false,
                                timer: 1500
                            }) 
                            $('#user').val("");
                            $('#contra').val("");
                            $('#nombre').val("");
                            $('#dni').val("");
                            $('#pes').val("");
                            $('#res').val(""); 
                            ExtraerUsuarios();              
                        }
                    });
                }
                function ExtraerUsuarios(){
                        var ExtraerUsuarios=1;
                        $.post("getGestion.php",{ExtraerUsuarios: ExtraerUsuarios}, function (data) {                        
                            var ListaProductos = JSON.parse(data);
                            var resultado="";
                            for(var i=0;i<ListaProductos.length;i++){
                                resultado+="<tr><td>"+ListaProductos[i].idUsuario+"</td><td>"+ListaProductos[i].login+"</td><td>"+ListaProductos[i].password+"</td><td>"+ListaProductos[i].nombre+"</td><td>"+ListaProductos[i].dni+"</td><td>"+ListaProductos[i].preguntaS+"</td><td>"+ListaProductos[i].respuestaS+"</td><td>"+ListaProductos[i].rol+"</td><td><button class='btn btn-warning' onclick='editarUsuario("+ListaProductos[i].idUsuario+")'><i class='far fa-edit'></i></button></td><td><button class='btn btn-danger' onclick='eliminarUsuario("+ListaProductos[i].idUsuario+")'><i class='far fa-trash-alt'></i></button></td></tr>";
                                
                            }
                            document.getElementById("lista_usuarios").innerHTML=resultado;
                        });
                }
                function BuscarUsuarioLogin(){
                    var buscar = $('#buscar').val();
                    $.post("getGestion.php",{buscar: buscar}, function (data) {
                        var ListaProductos = JSON.parse(data);
                        var resultado="";
                        for(var i=0;i<ListaProductos.length;i++){
                            resultado+="<tr><td>"+ListaProductos[i].idUsuario+"</td><td>"+ListaProductos[i].login+"</td><td>"+ListaProductos[i].password+"</td><td>"+ListaProductos[i].nombre+"</td><td>"+ListaProductos[i].dni+"</td><td>"+ListaProductos[i].preguntaS+"</td><td>"+ListaProductos[i].respuestaS+"</td><td>"+ListaProductos[i].rol+"</td><td><button class='btn btn-warning' onclick='editarUsuario("+ListaProductos[i].idUsuario+")'><i class='far fa-edit'></i></button></td><td><button class='btn btn-danger' onclick='eliminarUsuario("+ListaProductos[i].idUsuario+")'><i class='far fa-trash-alt'></i></button></td></tr>";
                                
                        }
                        document.getElementById("lista_usuarios").innerHTML=resultado;
                          
                    });
                }
                function editarUsuario(id){
                    var idEditar = id;
                    $('#idOcultoModificar').val("");
                    $('#registrar').hide();
                    $('#editar').show();
                    $.post("getGestion.php",{idEditar: idEditar}, function (data) {
                        var UsuarioEncontrado = JSON.parse(data);
                        $('#idOcultoModificar').val(UsuarioEncontrado.idUsuario);
                        $('#user').val(UsuarioEncontrado.login);
                        $('#contra').val(UsuarioEncontrado.password);
                        $('#nombre').val(UsuarioEncontrado.nombre);
                        $('#dni').val(UsuarioEncontrado.dni);
                        $('#pes').val(UsuarioEncontrado.preguntaS);
                        $('#res').val(UsuarioEncontrado.respuestaS);
                        document.getElementById("rol").value = UsuarioEncontrado.rol;
                                               
                    });
                }
                function eliminarUsuario(id){
                    var idEliminar = id;
                    Swal.fire({
                        title: '¿Estas seguro de Eliminar Usuario?',
                        text: "¡Recuerda que esto ya no se podrá revertir!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: '¡ Sí, Eliminar!'
                        }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                            '¡Eliminado!',
                            'El Usuario ha sido Eliminado.',
                            'success'
                            )
                            $.post("getGestion.php",{idEliminar: idEliminar}, function (data) {
                            ExtraerUsuarios(); 
                            });
                        }
                    })
                    
                }
                function registrarUsuario(){
                    var user = $('#user').val();
                    var contra = $('#contra').val();
                    var nombre = $('#nombre').val();
                    var dniRegistro = $('#dni').val();
                    var pes = $('#pes').val();
                    var res = $('#res').val();
                    var rol = $('#rol').val();
                    $.post("getGestion.php",{user: user,contra:contra,nombre:nombre,dniRegistro:dniRegistro,pes:pes,res:res,rol:rol}, function (data) {                        
                        if(data == "Hay valores NO Validos"){
                            Swal.fire({
                                title: data,
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            });
                        }
                        else{
                            Swal.fire({
                                icon: 'success',
                                title: 'Registro realizado con exito',
                                showConfirmButton: false,
                                timer: 1500
                            }) 
                            $('#user').val("");
                            $('#contra').val("");
                            $('#nombre').val("");
                            $('#dni').val("");
                            $('#pes').val("");
                            $('#res').val(""); 
                            ExtraerUsuarios();              
                        }
                    });
                }
            </script>

            <?php          
                $this->piePaginaShow();
            }
    }
?>