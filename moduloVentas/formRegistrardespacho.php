<?php
    include_once("../shared/formulario.php");
    class formRegistrardespacho extends formulario{
        public function formRegistrardespachoShow(){
                $this -> encabezadoShowSimple("Registrar despacho");
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
                    <div class="col-3"></div>
                        <div class="col-6">
                            <div class="mb-3 row">
                                <label for="boleta" class="col-sm-4 col-form-label">Codigo</label>
                                <div class="col-sm-6">
                                        <input type="text" class="form-control" id="boleta">
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-danger" onclick="BuscarComprobante()"><i class="fa fa-search"></i></button>
                                    </div>  
                            </div>  
                               
                           <div class="mb-3 row">
                                    <label for="id" class="col-sm-4 col-form-label">IdComprobante</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="id" disabled>
                                        <input type="hidden" class="form-control" id="idhidden" disabled>
                                    </div>
                            </div>

                            <div class="mb-3 row">
                                    <label for="codigo" class="col-sm-4 col-form-label">Cliente</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="cliente" disabled>
                                    </div>
                            </div>

                            <div class="mb-3 row">
                                    <label for="monto" class="col-sm-4 col-form-label">MontoTotal</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="monto" disabled>
                                    </div>
                            </div>

                            <div class="mb-3 row">
                                    <label for="fecha" class="col-sm-4 col-form-label">Fecha</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="fecha" disabled>
                                    </div>
                            </div>

                             <br>
                            
                                <button  onclick="modificarEstadoDespacho()" class="btn btn-info btndespacho">Despachar</button>
                             
                            <div id="lista_productos" class="lista_productos">
                            </div>
                        </div>
                        
                    </div>
                </div>
                <script>

                function BuscarComprobante(){
                    var boleta = $('#boleta').val(); 
                    $('#id').val("");
                    $('#fecha').val("");
                    $('#monto').val("");
                    $('#cliente').val(""); 
                    $('#idhidden').val("");
                    $.post("getDespacho.php",{boleta: boleta}, function (data) {
                        if(data == "Comprobante no valido" || data == "No existe comprobante para despacho"){
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
                            const comprobanteAJAX = JSON.parse(data);                         
                            $('#id').val(comprobanteAJAX.idComprobante);
                            $('#fecha').val(comprobanteAJAX.Fecha);
                            $('#monto').val(comprobanteAJAX.MontoTotal);
                            $('#cliente').val(comprobanteAJAX.Cliente);
                            $('#idhidden').val(comprobanteAJAX.idComprobante);   
                                                     
                        }     
                    });
                }
                function modificarEstadoDespacho(){
                    var idDespacho = $('#idhidden').val();
                    $.post("getDespacho.php",{idDespacho: idDespacho}, function (data) {
                        if(data == "Busque su comprobante"){
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
                                title: 'Despachado exitosamente',
                                showConfirmButton: false,
                                timer: 1500
                            }) 
                            $('#id').val("");
                            $('#fecha').val("");
                            $('#monto').val("");
                            $('#cliente').val(""); 
                            $('#idhidden').val("");
                            $('#boleta').val("");                          
                        }   
                            
                    });
                }
            </script>
            <?php          
            $this->piePaginaShow();
        }
    }
?>