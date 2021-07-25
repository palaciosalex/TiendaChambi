
<?php
    include_once("../shared/formulario.php");
    class formEmitirProforma extends formulario{


        public function formEmitirProformaShow(){
                $this -> encabezadoShowSimple("Emitir Proforma");
                ?>
                
                <div class="container">
                    <p class="usuario">Usuario activo:<?php echo $_SESSION['login'] ?> </p>
                    <div class="row">
                        <div class="col-6 lista">
                                <input type="text" id="txtNombre" placeholder="Buscar por nombre" size="60"/>
                                <button onclick="BuscarProductoNombre()" class="btnBuscarPr">Buscar</button>
                            <div id="lista_productos" class="lista_productos">
                            </div>
                        </div>
                        <div class="col-6 proforma">
                            <label>Codigo: </label>
                            <input type="text" id="codigo" value="" disabled/>
                            <label>Fecha: </label>
                            <input type="date" id="fecha" value="<?php echo date('Y-m-d'); ?>" disabled/>
                            <table class="table table-hover table-sm" id="datos">
                                <thead>
                                    <tr>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Producto</th>
                                        <th scope="col">Precio unitario</th>
                                        <th scope="col">Envases</th>
                                        <th scope="col">Monto</th>
                                        <th scope="col" class="moverimpri">Accion</th>
                                    </tr>
                                </thead>
                                <tbody id="lista-proforma">
                                </tbody>
                            </table>
                            <!--<a onclick="print()" id="btncon"  class="btn btn-primary">IMPRIMIR</a>-->
                            <div class="sec_total">
                                <label >Monto total:</label>
                                <input type="text" size="6" id="monto_total" value="0.00" disabled/>
                            </div> 

                        </div>  
                    </div>
                    <div class="row">
                        <div class="col">
                        </div>
                        <div class="col">
                            
                        </div>
                        <div class="col">
                            <button id="emitir" class="btn btn-primary" onclick="EmitirProforma()">Emitir</button>
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
                ExtraerProductos();
                ObtenerCodigoNuevo();
                
                var ListaProforma = new Array();
                function enviarPro(idlngp){

                    $.post("getProforma.php",{idlngp: idlngp}, function (data) {
                            const producto = JSON.parse(data);

                            if(ListaProforma.indexOf(producto.id)==-1){
                                ListaProforma.push(producto.id);                        

                                $('#lista-proforma').append('<tr id="elemento'+producto.id+'">'+
                                '<td><input type="text" value="1" size="4" id="cant'+producto.id+
                                    '" onkeyup="ActualizarMontos('+producto.id+')" /></td>'+
                                '<td>'+producto.producto+'</td>'+
                                '<td><input type="text" value="'+producto.precioU+'" size="4" id="prec'+producto.id+
                                    '" onkeyup="ActualizarMontos('+producto.id+')"/></td>'+
                                '<td><input type="text" value="0" size="4" id="enva'+producto.id+
                                    '" onkeyup="ActualizarMontos('+producto.id+')"/></td>'+
                                '<td><input type="text" id="monto'+producto.id+'" value="'+producto.precioU+'" size="4" disabled /></td>'+
                                '<td><button class="quitar btn" onclick="EliminarProductoLista('+producto.id+')"><i class="far fa-trash-alt"></i></button></td>'+
                                '</tr>');
                            }else{
                                var valor=parseInt(document.getElementById("cant"+producto.id).value);
                                valor++;
                                document.getElementById("cant"+producto.id).value=valor.toString();
                                ActualizarMontos(producto.id);
                            }

                            ActualizarMontoTotal();
                    });
                }

                function ActualizarMontos(id){
                    var cantidad=parseFloat(document.getElementById("cant"+id).value);
                    var precioUnitario=parseFloat(document.getElementById("prec"+id).value);
                    var envases=parseInt(document.getElementById("enva"+id).value);
                    var monto= (cantidad*precioUnitario)+envases;
                    document.getElementById("monto"+id).value=monto.toString();
                    ActualizarMontoTotal();
                }

                function ActualizarMontoTotal(){
                    var monto_total=0;
                    for(var i=0;i<ListaProforma.length;i++){
                        monto_total+=parseFloat(document.getElementById("monto"+ListaProforma[i]).value);
                    }
                    document.getElementById("monto_total").value=monto_total.toString();
                }

                function EliminarProductoLista(id){
                    document.getElementById("elemento"+id).remove();
                    ListaProforma.splice(ListaProforma.indexOf(id.toString()), 1);
                    ActualizarMontoTotal();
                }

                function BuscarProductoNombre(){
                    var txtNombre=document.getElementById("txtNombre").value;
                    $.post("getProforma.php",{txtNombre: txtNombre}, function (data) {
                        var listaProductos = JSON.parse(data);
                        var resultado="";
                        if(listaProductos.length==0){
                            $( "#lista_productos" ).removeClass( "lista_productos" )
                            resultado="<div class='alert alert-danger' role='alert'>NO EXISTE PRODUCTO</div>";
                        }else{
                            //var listaProductos = JSON.parse(data);
                            
                            for(var i=0;i<listaProductos.length;i++){
                                resultado+="<div class='producto' onclick='enviarPro("+listaProductos[i].id+")'>"+
                                            "<img src='../imagenes/"+listaProductos[i].imagen+"' />"+
                                            "<span class='nombre'>"+listaProductos[i].producto+"</span><br>"+
                                            "<span class='precio'>Precio: "+listaProductos[i].precioU+"</span><br>"+
                                            "<span class='stock'>Stock: "+listaProductos[i].stock+"</span>"+
                                        "</div>";
                            }
                            $('#lista_productos').addClass("lista_productos");
                        }                        
                        document.getElementById("lista_productos").innerHTML=resultado;
                    });
                }

                function ExtraerProductos(){
                    var extraerProductos=1;
                    $.post("getProforma.php",{extraerProductos: extraerProductos}, function (data) {
                        var ListaProductos = JSON.parse(data);
                        var resultado="";
                        for(var i=0;i<ListaProductos.length;i++){
                            resultado+="<div class='producto' onclick='enviarPro("+ListaProductos[i].id+")'>"+
                                            "<img src='../imagenes/"+ListaProductos[i].imagen+"' />"+
                                            "<span class='nombre'>"+ListaProductos[i].producto+"</span><br>"+
                                            "<span class='precio'>Precio: "+ListaProductos[i].precioU+"</span><br>"+
                                            "<span class='stock'>Stock: "+ListaProductos[i].stock+"</span>"+
                                        "</div>";
                            
                        }
                        document.getElementById("lista_productos").innerHTML=resultado;
                    });
                }

                function ObtenerCodigoNuevo(){
                    var ObtenerCodigoNuevo=1;
                    $.post("getProforma.php",{ObtenerCodigoNuevo: ObtenerCodigoNuevo}, function (data) {
                        var codigoNuevo = data;
                        document.getElementById("codigo").value=codigoNuevo;
                    });
                }


                function EmitirProforma(){                    
                    var _codigo = document.getElementById("codigo").value;
                    var _fecha = document.getElementById("fecha").value;
                    var _monto_total = parseFloat(document.getElementById("monto_total").value);

                    var _Proforma= {codigo:_codigo, fecha:_fecha, monto_total:_monto_total};
                    var _DetalleProforma = new Array();
                    for(var i=0;i<ListaProforma.length;i++){
                        var _id_producto=ListaProforma[i];
                        var _cantidad=parseFloat(document.getElementById("cant"+_id_producto).value);
                        var _envases=parseInt(document.getElementById("enva"+_id_producto).value);
                        var _monto=parseFloat(document.getElementById("monto"+_id_producto).value);

                        _DetalleProforma[i]={id_producto:_id_producto, cantidad:_cantidad, envases:_envases,monto:_monto};
                    }


                    $.post("getProforma.php",{Proforma: _Proforma,DetalleProforma: _DetalleProforma}, function (data) {
                        var respuesta = data;
                        if($.isEmptyObject(respuesta)){
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