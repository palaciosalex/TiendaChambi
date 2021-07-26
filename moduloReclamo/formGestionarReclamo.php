<?php
    include_once("../shared/formulario.php");
    class formGestionarReclamo extends formulario{
        public function formGestionarReclamoShow(){
            $this -> encabezadoShowSimple("Gestionar Reclamo");
            ?> 
            
            <div class="container">
                <div class="row">
                    <div class="col-6">
                                <div class="mb-3 row">
                                    <label for="boleta" class="col-sm-4 col-form-label"><strong>N° BOLETA</strong></label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="boleta">
                                    </div>
                                    <div class="col-sm-2">
                                        <button class="btn btn-danger" onclick="BuscarComprobante()"><i class="fa fa-search"></i></button>
                                    </div>  
                                </div>
                                <div class="mb-3 row">
                                    <label for="fecha" class="col-sm-4 col-form-label">FECHA DE COMPRA</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="fecha" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="razonS" class="col-sm-4 col-form-label">NOMBRE O RAZON SOCIAL</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="razonS" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="motivo" class="col-sm-4 col-form-label">MOTIVO DEL RECLAMO</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" id="motivo" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="monto" class="col-sm-4 col-form-label">MONTO A RECLAMAR</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="monto">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="fechaR" class="col-sm-4 col-form-label" >FECHA DE RECLAMO</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" id="fechaR" value="<?php echo date('Y-m-d'); ?>" disabled>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-lg-6 mx-auto">
                                        <button class="btn btn-success" onclick="RegistrarReclamo()">REGISTRAR</button>
                                    </div>
                                </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3 row">
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="solucionarC" placeholder="NUMERO DE BOLETA" style="text-align:center">
                            </div>
                            <div class="col-sm-2">
                                <button class="btn btn-danger" onclick="BSolucionar()"><i class="fa fa-search"></i></button>
                            </div>                            
                        </div>  
                        
                        <div class="row">
                            <table class="table table-hover table-sm text-center" id="datos">
                                    <thead>
                                        <tr>
                                            <th scope="col">Fecha</th>
                                            <th scope="col">Motivo</th>
                                            <th scope="col">Monto</th>
                                            <th scope="col">Estado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="tdfecha"></td>
                                            <td class="tdmotivo"></td>
                                            <td class="tdmonto"></td>
                                            <td class="tdestado"></td>
                                            <input type="hidden" class="tdestadoforAJAX">
                                            <input type="hidden" class="tdidforAJAX">
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                        <div class="col-lg-6 mx-auto">
                            <button class="btn btn-danger" onclick="SolucionarReclamo()">SOLUCIONAR</button>
                        </div>
                    </div>
                <section class="text-center">
                    <div class="row">
                        <div class="col-lg-6 mx-auto">
                            <form name="form3" method="post" action="../moduloSeguridad/getUsuario.php">                                                       
                                    <button  style="color: white" name="retrocede" type="submit" class="btn btn-info" id="retrocede">
                                        SALIR
                                    </button>
                                    <input name="login" type="hidden" id="login" value="<?php echo $_SESSION['login'] ?>">					
                            </form>                              
                        </div>
                    </div>
                </section>
            </div>
            
            <script>
                function RegistrarReclamo(){
                    var codigoBoleta = $('#boleta').val(); 
                    var motivo = $('#motivo').val();
                    var monto = $('#monto').val();
                    var fecha = $('#fecha').val();
                    $.post("getReclamo.php",{codigoBoleta: codigoBoleta,motivo: motivo,monto: monto,fecha: fecha}, function (data) {
                        if(data == "Rellene los campos con valores válidos" || data == "No existe boleta para reclamo"){
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
                                title: 'Reclamo guardado exitosamente',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            $('#boleta').val(""); 
                            $('#motivo').val("");
                            $('#monto').val("");
                            $('#fecha').val("");
                            $('#razonS').val("");                            
                        }
                    });
                }
                function BuscarComprobante(){
                    var boleta = $('#boleta').val(); 
                    $('#razonS').val("");
                    $('#fecha').val("");
                    $.post("getReclamo.php",{boleta: boleta}, function (data) {
                        if(data == "Numero de boleta Invalido" || data == "No existe boleta para reclamo"){
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
                            $('#razonS').val(comprobanteAJAX.Cliente);
                            $('#fecha').val(comprobanteAJAX.Fecha);
                        }
                    });
                }
                function BSolucionar(){
                    var boletaSolu = $('#solucionarC').val(); 
                    $('.tdestado').html("");
                            $('.tdfecha').html("");
                            $('.tdmonto').html("");
                            $('.tdmotivo').html("");
                            $('.tdestadoforAJAX').val("");
                            $('.tdidforAJAX').val("");
                    $.post("getReclamo.php",{boletaSolu: boletaSolu}, function (data) {
                        if(data == "Comprobante no existe" || data == "No existe comprobante en reclamo"){
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
                            $('.tdestado').html(comprobanteAJAX.estado);
                            $('.tdfecha').html(comprobanteAJAX.fecha);
                            $('.tdmonto').html(comprobanteAJAX.monto);
                            $('.tdmotivo').html(comprobanteAJAX.motivo);
                            $('.tdestadoforAJAX').val(comprobanteAJAX.estado);
                            $('.tdidforAJAX').val(comprobanteAJAX.id);
                        }
                    });
                    
                }
                function SolucionarReclamo(){
                    var hid = $('.tdestadoforAJAX').val();
                    var id = $('.tdidforAJAX').val();
                    $.post("getReclamo.php",{hid: hid,id: id}, function (data) {
                        if(data == "No hay nada que solucionar" || data == "Reclamo ya se soluciono antes"){
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
                                title: 'Estado cambiado exitosamente',
                                showConfirmButton: false,
                                timer: 1500
                            }) 
                            $('.tdestado').html("");
                            $('.tdfecha').html("");
                            $('.tdmonto').html("");
                            $('.tdmotivo').html("");
                            $('.tdestadoforAJAX').val("");
                            $('.tdidforAJAX').val(""); 
                            $('#solucionarC').val("");                     
                        }
                    });
                }
            </script>
            <?php          
            $this->piePaginaShow();
        }
    }
?>