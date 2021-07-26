
<?php
    include_once("../shared/formulario.php");
    class formEmitirComprobante extends formulario{


        public function formEmitirComprobanteShow(){
                date_default_timezone_set('America/Los_Angeles');
                $this -> encabezadoShowSimple("Emitir Comprobante");
                ?>
                
                <div class="container">
                    <p class="usuario">Usuario activo:<?php echo $_SESSION['login'] ?> </p>
                    <div class="row">
                        <div class="col-6 lista">
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="Buscar">Buscar por fecha:</label>
                                    <input type="date" class="form-control" id="fecha_buscar" value="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="col-md-2">
                                    <label for=""></label>
                                    <button type="button" class="btn btn-success" onclick="BuscarProformaFecha()">Buscar</button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="Buscar">Buscar por codigo:</label>
                                    <input type="text" class="form-control" id="txtCodigo" placeholder="PF-0001">
                                </div>
                                <div class="col-md-2">
                                    <label for=""></label>
                                    <button type="button" class="btn btn-success" onclick="BuscarProformaCodigo()">Buscar</button>
                                </div>
                                <div class="col-md-2">
                                    <label for=""></label>
                                    <button type="button" class="btn btn-secondary" onclick="ExtraerProformas();">Refrescar</button>
                                </div>
                            </div>
                            <br>
                            <p>Seleccionar una proforma:</p>
                            <table class="table table-hover table-sm" id="datos">
                                <thead>
                                    <tr>
                                        <th scope="col">Codigo</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Monto Total</th>
                                        <th scope="col">Accion</th>
                                    </tr>
                                </thead>
                                <tbody id="lista_proformas">
                                </tbody>
                            </table>
                        </div>
                        <div class="col-6 proforma">
                            <div class="form-group row">
                                <div class="col-md-3">
                                    <label for="Buscar">Codigo</label>
                                    <input type="text" class="form-control" id="codigo" disabled/>
                                </div>
                                <div class="col-md-4">
                                    <label for="Buscar">Fecha</label>
                                    <input type="date" class="form-control" id="fecha" value="<?php echo date('Y-m-d'); ?>" disabled/>
                                </div>
                                <div class="col-md-5">
                                    <label>Tipo de comprobante</label>
                                    <select id="tipo_comprobante" class="form-select">
                                        <option value="B">Boleta de venta</option>
                                        <option value="F">Factura</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-8">
                                    <label for="nom_cliente">Nombre o Razón social</label>
                                    <input type="text" class="form-control" id="nom_cliente">
                                </div>
                                <div class="col-md-4">
                                    <label for="documento">DNI o RUC</label>
                                    <input type="text" class="form-control" id="documento">
                                </div>
                            </div>
                            <br>
                            <p>Descripción de proforma seleccionada:</p>
                            <p id="codigo_proforma"></p>
                            <table class="table table-hover table-sm" id="datos">
                                <thead>
                                    <tr>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Precio U.</th>
                                        <th scope="col">Envases</th>
                                        <th scope="col">Monto</th>
                                    </tr>
                                </thead>
                                <tbody id="detalle_proforma">
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end">
                                <p id="monto_total_proforma"></p>
                            </div>
                            
                        </div>  
                    </div>
                    <div class="row">
                        <div class="col">
                        </div>
                        <div class="col">
                        </div>
                        <div class="col">
                            <button id="emitirComprobante" class="btn btn-primary" onclick="EmitirComprobante()" disabled>Emitir Comprobante</button>
                            <form class="cancelar" method="post" action="../moduloSeguridad/getUsuario.php">                                                       
                                <button  style="color: white" name="retrocede" type="submit" class="btn btn-info" id="retrocede">
                                    Cancelar
                                </button>
                                <input name="login" type="hidden" id="login" value="<?php echo $_SESSION['login'] ?>">					
                            </form>
                        </div>
                    </div>
                </div>

                <script>

                var ListaProformas=new Array();
                var DetalleProforma=new Array();
                var Proforma=new Array();
                ExtraerProformas();
                ObtenerCodigoNuevo();


                function ExtraerProformas(){
                    var ExtraerProformas=1;
                    $.post("getEmitirComprobante.php",{ExtraerProformas: ExtraerProformas}, function (data) {
                        var Respuesta=JSON.parse(data);
                        document.getElementById("lista_proformas").innerHTML=Respuesta.resultado;
                        ListaProformas=Respuesta.ListaProformas;
                    });
                }

                function BuscarProformaCodigo(){
                    var codigoProforma=document.getElementById("txtCodigo").value;
                    $.post("getEmitirComprobante.php",{codigoProforma: codigoProforma}, function (data) {
                        var Respuesta=JSON.parse(data);
                        document.getElementById("lista_proformas").innerHTML=Respuesta.resultado;
                        ListaProformas=Respuesta.ListaProformas;
                    });
                }

                function ObtenerCodigoNuevo(){
                    var ObtenerCodigoNuevo=1;
                    $.post("getEmitirComprobante.php",{ObtenerCodigoNuevo: ObtenerCodigoNuevo}, function (data) {
                        var CodigoNuevo=data;
                        document.getElementById("codigo").value=CodigoNuevo;
                    });
                }

                function BuscarProformaFecha(){
                    var fecha=document.getElementById("fecha_buscar").value;
                    $.post("getEmitirComprobante.php",{fecha: fecha}, function (data) {
                        var Respuesta=JSON.parse(data);
                        document.getElementById("lista_proformas").innerHTML=Respuesta.resultado;
                        ListaProformas=Respuesta.ListaProformas;
                    });
                }

                function SeleccionarProforma(fila){
                    var _Proforma=ListaProformas[fila];
                    $.post("getEmitirComprobante.php",{Proforma: _Proforma}, function (data) {
                        if(data=="0"){
                            Swal.fire({
                                title: "La proforma a caducado",
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })

                            
                        }else{
                            Proforma=_Proforma;
                            Respuesta=JSON.parse(data);
                            DetalleProforma=Respuesta.DetalleProforma;
                            document.getElementById("detalle_proforma").innerHTML=Respuesta.resultado;
                            document.getElementById("codigo_proforma").innerHTML="Codigo: "+Proforma.codigo;
                            document.getElementById("monto_total_proforma").innerHTML="Monto total: S/. "+Proforma.monto_total;
                            $("#emitirComprobante").removeAttr("disabled");
                        }
                    });
                }

                function EmitirComprobante(){

                    var _codigo=document.getElementById("codigo").value;
                    var _fecha=document.getElementById("fecha").value;
                    var _monto_total=Proforma.monto_total;
                    var _nom_cliente=document.getElementById("nom_cliente").value;
                    var _documento=document.getElementById("documento").value;
                    var _tipo=document.getElementById("tipo_comprobante").value;

                    var _Comprobante= {
                            codigo:_codigo,
                            fecha:_fecha,
                            monto_total:_monto_total,
                            nom_cliente:_nom_cliente,
                            documento:_documento,
                            tipo:_tipo
                            };
                    var _DetalleComprobante=new Array();

                    for(var i=0;i<DetalleProforma.length;i++){

                        var id_producto=DetalleProforma[i].id;
                        var cantidad=DetalleProforma[i].cantidad;
                        var monto=DetalleProforma[i].monto;
                        var envases=DetalleProforma[i].envases;
                        var precioU=(monto-envases)/cantidad;

                        _DetalleComprobante[i]={
                            id_producto:id_producto,
                            cantidad:cantidad,
                            monto:monto,
                            envases:envases,
                            precioU:precioU
                        };
                    }

                    $.post("getEmitirComprobante.php",{Comprobante: _Comprobante,DetalleComprobante: _DetalleComprobante}, function (data) {
                        var respuesta=data;
                        if(respuesta==="1"){
                            print();
                            location.reload();
                        }else{
                            Swal.fire({
                                title: respuesta,
                                showClass: {
                                    popup: 'animate__animated animate__fadeInDown'
                                },
                                hideClass: {
                                    popup: 'animate__animated animate__fadeOutUp'
                                }
                            })
                        }
                    });
                }
                </script>
            <?php          
                $this->piePaginaShow();
            }
    }
?>