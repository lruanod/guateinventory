@extends('layouts.base2')
@section('title', 'facturas')
@section('content')

    <script>
        $(document).ready(function (ev) {
            $("#nocodigotxt").on("change", function () {
                var obj=document.getElementById('bntcodigotxt');
                obj.click();
                $("#nocodigotxt").val("");
            });
            $('#btnbcliente').click(function () {
                var buscarc=$('#textcliente').val();
                $.ajax({
                    url:'{{route('rest.list_clientesbuscar')}}',
                    type:'get',
                    dataType: 'json',
                    data:{
                        buscarc: buscarc
                    },
                    success:function f(r) {
                        let lista = r;
                        let htmlcode='';
                        $.each(lista, function (key,item) {
                            htmlcode+=' <tr>' +
                                '<td>'+item.nit+'</td> ' +
                                '<td>'+item.nombre+'</td> ' +
                                '<td>'+item.direccion+'</td> ' +
                                '<td> ' +
                                '<a href="form_factura/?buscarcliente='+item.id+'" class="btn btn-danger col-md-8"  title="Agregar"> ' +
                                '<i class="bi-arrow-return-right text-white"></i> ' +
                                '</a> ' +
                                '</td> ' +
                                '</tr>';
                        });
                        $('#tablacliente').html(htmlcode);

                    }
                })
            });

            $('#btnsesionarcliente').click(function () {
                var buscarcliente=$('#textbuscarcliente').val();
                $.ajax({
                    url:'{{route('rest.sesionarcliente')}}',
                    type:'get',
                    dataType: 'json',
                    data:{
                        buscarcliente: buscarcliente
                    }

                })
            });

            $('#btnbproducto').click(function () {
                var buscar=$('#textproducto').val();
                $.ajax({
                    url:'{{route('rest.list_productosbuscar')}}',
                    type:'get',
                    dataType: 'json',
                    data:{
                        buscar: buscar
                    },
                    success:function f(r) {
                        let lista = r;
                        let htmlcode='';
                        $.each(lista, function (key,producto) {
                            htmlcode+=' <tr>' +
                                '<td>'+producto.codigo+'</td> ' +
                                '<td>'+producto.nombre+'/'+producto.medida+'</td> ' +
                                '<td>'+producto.precioventa+'</td> ' +
                                '<td>' +
                                '<form id="formulario" action="/form_factura" > '+
                                '<input name="producto_id" value="'+producto.id+'" type="hidden"/>'+
                                '<button type="submit" class="btn btn-danger col-md-5" title="Agregar"> ' +
                                '<i class="bi-arrow-return-right"></i> ' +
                                '</button > ' +
                                '</form>'+
                                '</tr>';
                        });
                        $('#tablaproducto').html(htmlcode);
                        $('#addproducto').modal('show');
                    }
                })
            });

            $('#bntcodigotxt').click(function () {
                var totalquery=0;
                var totaldescuentoquery=0;
                var buscar=$('#nocodigotxt').val();
                $.ajax({
                    url:'{{route('rest.list_detallesbuscar')}}',
                    type:'get',
                    dataType: 'json',
                    data:{
                        codigo:buscar
                    },
                    success:function f(r) {
                        let lista = r;
                        let htmlcode='';
                        $.each(lista, function (key,detalle) {
                            totalquery+=detalle.subtotal;
                            totaldescuentoquery+=detalle.descuentodetalle;
                            htmlcode+='<tr>' +
                                '<td>'+
                                '<form action="deleteproducto/'+detalle.id+'" method="post">' +
                                '@csrf @method('DELETE')  <button type="submit" onclick="return confirm("borrar?");" class="btn btn-danger text-white" title="eliminar producto">'+
                                ' <i class="bi-scissors"></i>'+
                                '</button>' +
                                '</form>' +
                                '</td>'+
                                '<td>'+detalle.codigo+'</td> ' +
                                '<td>'+detalle.nombre+'/'+detalle.medida+'</td> ' +
                                '<td> ' +
                                '<form action="edit_detalle/'+detalle.id+'" method="post">'+
                                    '@csrf @method('PATCH')'+
                                        '<input type="number" id="cantidad" name="cantidad" class="form-control"  value="'+detalle.cantidad+'"  placeholder="0"  min="0">'+
                                    '<button type="submit" class="btn btn-info" title="Editar catidad">'+
                                      '<i class="bi-pencil-fill text-white"></i>'+
                                    '</button>'+
                                '</form>'+
                                '</td> ' +
                                '<td class="col-sm-3"><input type="number" name="precio" id="precio" readonly="readonly"  class="form-control" value="'+detalle.preciodetalleven+'" min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit":"red"" >  </td>'+
                                '<td class="col-sm-1"><input type="number" name="descuentodetalle" id="descuentodetalle" readonly="readonly" class="form-control" value="'+detalle.descuentodetalle+'" min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit":"red""></td>'+
                                '<td class="col-sm-5"><input type="number" name="subtotal" id="sub-total" readonly="readonly" value="'+detalle.subtotal+'" class="form-control"   min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit":"red""></td>'+
                                '</tr>';
                        });

                        htmlcode+='<tr>'+
                        '<td></td><td></td><td></td><td></td><td></td><td>Total --></td>'+
                        '<td class="col-sm-5"><input type="number" name="total" id="total" class="form-control"  value=""  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit":"red""></td>'+
                        '</tr>';
                        $('#tabladetalle').html(htmlcode);
                        $('#total').val(totalquery);
                        $('#totald').val(totalquery);
                        $('#iva').val((totalquery*12)/100);
                        $('#decuentod').val(totaldescuentoquery);
                        $("#refrescar").load(" #refrescar");
                    }
                })
            });
        });

    </script>

    <script type="text/javascript">
        $(document).ready(function (ev) {
            $("#efectivo").on("change", function () {

                var totaldetalle=$('#total').val();
                $('#totald').val(totaldetalle);
                var fpago_id = $('#form_fpago_id').val();
                var efectivo = $('#efectivo').val();
                var descuento =$('#descuentod').val();
                var ivad =$('#iva').val();

                var vuelto = 0;
                vuelto =(efectivo-totaldetalle).toFixed(2);
                $('#cambio').val(vuelto);
                $('#fpago_id').val(fpago_id);
            })
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function (ev) {
            $("#nocodigo").on("change", function () {
                var obj=document.getElementById('btncodigo');
                obj.click();
            })
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function (ev) {
            var iva=0;
            var totaldetalle=$('#total').val();
            $('#totald').val(totaldetalle);
            iva= ((totaldetalle*12)/100).toFixed(2);
            $('#iva').val(iva);
        })
    </script>

    @if($modal=='true')
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn_mpro');
                obj.click();
            })
        </script>
    @endif


    @if(request('pagina')==='producto')
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn_mpro');
                obj.click();
            })
        </script>
    @endif

    @if(request('pagina')==='cliente')
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn-modal2');
                obj.click();
            })
        </script>
    @endif

    @if(empty(session('cliente_id')))
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn-modal2');
                obj.click();
            })
        </script>
    @endif



    @if(!empty(session('cliente_id')))
        <script type="text/javascript">
            $(document).ready(function (ev) {

                var clienteid=document.getElementById('cliente_id');
                clienteid.value="{{session('cliente_id')}}";

                var nit=document.getElementById('nit');
                nit.value="{{session('nit')}}";

                var nombrec=document.getElementById('nombrec');
                nombrec.value="{{session('nombre')}}";

                var direccion=document.getElementById('direccion');
                direccion.value="{{session('direccion')}}";


            })
        </script>

    @endif
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Facturas</h4>
        </div>

    </div>
        <div class="col-md-6 mt-3">
            <!-- mesajes de confirmacion -->
            @if(session('exito'))
                <div class="alert alert-success">
                    {{session('exito')}}
                </div>
            @endif

        <!-- errores de validaciones -->
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors-> all() as $errors)
                            <li>{{$errors}}</li>
                        @endforeach

                    </ul>
                </div>
              @endif
        <!--fin error -->

            <!-- redireccionar factura -->
            @if(session('exito')=='registro de factura')
                <script>
                    window.open('/imprimir_factura');
                    location.reload();
                </script>
            @endif

        <!-- fin redireccionar factura -->

        </div>

    <div class="row">
        <div class="col-md-6 ">
            <div class=" row justify-content-center">
                <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );">

                        <input name="cliente_id" id="cliente_id" type="hidden">
                        <div class="card-header text-center text-white">
                            Cliente
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row form-group">
                                        <label for="nit" class="text-white">NIT</label>
                                        <input type="text"  pattern="[0-9]+[-]+[0-9]" id="nit" name="nit" class="form-control col-md-4">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="nit" class="text-white">Buscar</label><br>
                                        <button type="button" class="btn btn-danger col-md-5" id="btn-modal2" data-toggle="modal" data-target="#buscarclientem">
                                            <i class="bi-search"></i>
                                        </button>
                                </div>
                                <div class="col-md-3">
                                    <label for="nit" class="text-white">+Cliente</label><br>
                                        <button type="button" class="btn btn-success col-md-5" data-toggle="modal" data-target="#addcliente">
                                            <i class="bi-file-earmark-plus"></i>
                                        </button>
                                </div>
                            </div>


                            <div class="row form-group">
                                <label for="" class="col-5 text-white">Nombre del cliente</label>
                                <input type="text" name="nombre"  id="nombrec" class="form-control col-md-7">

                            </div>

                            <div class="row form-group">
                                <label for="direccion" class="col-5 text-white">Dirección</label>
                                <input type="text" name="direccion" id="direccion" class="form-control col-md-7">
                            </div>

                </div>
            </div>
        </div>
    </div> <!-- /.row cliente -->

    <div class="col-md-6"> <!-- /.row forma de pago -->
        <div class=" row justify-content-center">
            <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );">
                <div class="card-header text-center text-white">
                    Formas de pago
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <label for="fpago_id" class="col-6 text-white">Forma de pago</label>
                        <select class="form-control col-md-6" name="fpago_id" id="form_fpago_id">
                            @foreach($fpagos as $fpago)
                            <option value="{{$fpago->id}}">{{$fpago->formapago}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>


    </div><!-- /.row forma de pago -->

    <div class="col-md-6 mt-3">
        <div class=" row justify-content-center">
            <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );">
                    <div class="card-header text-center text-white">
                        Registro de producto
                    </div>
                    <div class="card-body">
                        <div class="row">

                                <div class="col-md-4">

                                            <div class="row form-group">
                                                <label for="codigo" class="text-white">Codigo de barras</label>
                                                <input type="number" id="nocodigotxt" name="codigo" autofocus="autofocus" tabindex="1" class="form-control col-md-4">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label  class="text-white">Agregar</label><br>
                                                <button type="submit" id="bntcodigotxt" class="btn btn-danger col-md-5">
                                                    <i class="bi-arrow-return-right"></i>
                                                </button>
                                       </div>
                            <div class="col-md-3">
                                <label  class="text-white">Producto</label><br>
                                <form action="/" method="post">
                                    <button type="button" class="btn btn-success col-md-5" id='btn_mpro' data-toggle="modal"  data-target="#addproducto">
                                        <i class="bi-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>


    <!-- /.detalle -->
    <br>
    <div class="row col-sm-8  mt-3">
        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );"  >
            <h4 class="text-center text-white">Detalle</h4>
        </div>
        <div id="refrescar">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    Acción
                </th>
                <th>
                    Codigo
                </th>
                <th>
                    Producto
                </th>

                <th>
                    Cantidad
                </th>
                <th>
                    Precio
                </th>
                <th>
                    Descuento
                </th>
                <th>
                    Sub-total
                </th>

            </tr>
            </thead>
            @if(!empty(session('venta_id')))
            <tbody id="tabladetalle">

                @foreach($detalles as $detalle)
                        <tr>
                            <td>
                                        <form action="{{route('deleteproducto',$detalle->id)}}" method="post">
                                            @csrf @method('DELETE')
                                            <button type="submit" onclick="return confirm('borrar?');" class="btn btn-danger col-12 text-white" title="eliminar producto">
                                                <i class="bi-scissors"></i>
                                            </button>
                                        </form>
                            </td>
                            <td>
                                 {{$detalle->producto->codigo}}
                            </td>
                            <td>
                                {{$detalle->producto->nombre}} / {{$detalle->producto->medida->medida}}
                            </td>
                            <td>
                                                <form action="{{route('edit_detalle',$detalle->id)}}" method="post">
                                                    @csrf @method('PATCH')
                                                    <input type="number" id="cantidad" name="cantidad" class="form-control" value="{{$detalle->cantidad}}"  placeholder="0"  min="0">
                                                    <button type="submit" class="btn btn-info" title="Editar catidad">
                                                        <i class="bi-pencil-fill text-white"></i>
                                                    </button>
                                                </form>
                            </td>
                            <td class="col-sm-2">
                                <input type="number" name="precio" id="precio"  class="form-control" readonly="readonly" value="{{$detalle->preciodetalleven}}"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" >
                            </td>
                            <td class="col-sm-2">
                                <input type="number" name="decuentodetalle" id="descuentodetalle"  class="form-control" readonly="readonly" value="{{$detalle->descuentodetalle}}"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'">
                            </td>
                            <td class="col-sm-2">
                                <input type="number" name="subtotal" id="sub-total" value="{{$detalle->subtotal}}" class="form-control"   min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" readonly="readonly">
                            </td>
                        </tr>
                @endforeach
            @endif


            <tr>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>

                </td>
                <td>
                    Total -->
                </td>
                <td>
                        <input type="number" name="total" id="total" class="form-control"  value="{{$total}}"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'">
                </td>
            </tr>
            </tbody>
        </table>
        </div>

    </div>

    <div class="col-md-4 mt-3">
        <div class=" row justify-content-center">
            <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );">
                <form action="{{url('/savefactura')}}" method="post">
                    @csrf
                    <div class="card-header text-center text-white">
                        Detalle de pagos
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <label for="total" class="col-5 text-white">Total compra</label>
                            <input type="number" name="total" class="form-control col-md-7" id="totald" min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" readonly="readonly">
                        </div>

                        <div class="row form-group">
                            <label for="iva" class="col-5 text-white">IVA</label>
                            <input type="number" name="impuesto" class="form-control col-md-7" id="iva"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" readonly="readonly">
                        </div>

                        <div class="row form-group">
                            <label for="descuento" class="col-5 text-white">Descuento</label>
                            <input type="number" name="descuento"   class="form-control col-md-7" id="descuentod"  tabindex="2" value="{{$descuentod}}" min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" readonly="readonly">
                        </div>


                        <div class="row form-group">
                            <label for="efectivo" class="col-5 text-white">Efecttivo</label>
                            <input type="number" name="efectivo" class="form-control col-md-7" id="efectivo" tabindex="3" min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'">
                        </div>

                        <div class="row form-group">
                            <label for="cambio" class="col-5 text-white">Cambio</label>
                            <input type="number" name="cambio" class="form-control col-md-7" id="cambio"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" readonly="readonly">
                        </div>
                        <input type="hidden" name="fpago_id" id="fpago_id">
                        <input type="hidden" name="venta_id" value="{{session('venta_id')}}">
                        <input type="hidden" name="cliente_id" value="{{session('cliente_id')}}">
                        <input type="hidden" name="tienda_id" value="{{session('tienda_id')}}">
                        <input type="hidden" name="usuario_id" value="{{session('usuario_id')}}">
                        <br>
                        <div class="row form-group">
                            <button type="submit" tabindex="4" class="btn btn-danger col-md-4 ">Registrar</button>
                        </div>
                    </div>
                </form>
                <a href="/cancelar" class="btn btn-danger col-md-4 ">Cancelar</a>
                <br>
            </div>
        </div>
    </div>
    <br>
    </div><!-- /.container -->

    <!-- modal addproducto-->
    <div class="modal fade bd-example-modal-lg" id="addproducto" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addproducto">Buscar producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-danger"><i class="bi-backspace-reverse"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <br>
                    <div class="form-group">
                        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #1B92F0 );">
                            <div class="card-header text-center text-white">
                                Buscar producto
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="row form-group">
                                            <label for="buscar" class="text-white">Descripción del producto</label>
                                            <input type="text"  name="buscar"  id="textproducto" class="form-control col-md-4">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label  class="text-white">Buscar</label><br>

                                            <button type="submit" id="btnbproducto" class="btn btn-success col-md-5" data-toggle="modal" data-target="#addproducto">
                                                <i class="bi-search"></i>
                                            </button>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row col-md-12  mt-3">
                        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
                            <h4 class="text-center text-white">Productos</h4>
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    Codigo
                                </th>
                                <th>
                                    Producto
                                </th>
                                <th>
                                    Precio
                                </th>
                                <th>
                                    Acción
                                </th>

                            </tr>
                            </thead>
                            <tbody id="tablaproducto">
                            @foreach($productos as $producto)
                            <tr>

                                <td>
                                    {{$producto->codigo}}
                                </td>
                                <td>
                                    {{$producto->nombre}} / {{$producto->medida->medida}}
                                </td>
                                <td>
                                    Q.{{$producto->precioventa}}
                                </td>
                                <td>
                                    <form id="formulario" action="/form_factura" method="get">
                                        <input type="hidden" name="producto_id" id="producto_id" value="{{$producto->id}}">
                                        <button type="submit" class="btn btn-danger col-md-5" title="Agregar">
                                            <i class="bi-arrow-return-right"></i>
                                        </button>
                                    </form>


                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{$productos->appends(['pagina'=>'producto'])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal addproducto-->


    <!-- modal addcliente-->
    <div class="modal fade" id="addcliente" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addcliente">Agregar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-danger"><i class="bi-backspace-reverse"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <br>
                    <div class="form-group">
                        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #1B92F0 );">

                                <div class="card-header text-center text-white">
                                    Registro de cliente
                                </div>
                                <div class="card-body">
                                    <form action="{{url('/savecliente2')}}" method="post">
                                        @csrf
                                        <div class="row form-group">
                                            <label for="nombre" class="col-5 text-white">Nombre</label>
                                            <input type="text" name="nombre" class="form-control col-md-7">
                                        </div>

                                        <div class="row form-group">
                                            <label for="direccion" class="col-5 text-white">Dirección</label>
                                            <input type="text" name="direccion" class="form-control col-md-7">
                                        </div>

                                        <div class="row form-group">
                                            <label for="nit" class="col-5 text-white">NIT</label>
                                            <input type="text"  pattern="[0-9]+[-]+[0-9]" name="nit" class="form-control col-md-7">
                                        </div>
                                        <input type="hidden" name="tienda_id" value="{{session('tienda_id')}}">
                                        <input type="hidden" name="usuario_id" value="{{session('usuario_id')}}">
                                        <br>
                                        <div class="row form-group">
                                            <button type="submit" class="btn btn-danger col-md-4 ">Registrar</button>
                                        </div>
                                    </form>
                                </div><br>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal addcliente-->



    <!-- modal buscarcliente-->
    <div class="modal fade bd-example-modal-lg" id="buscarclientem" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="buscarclientem">Buscar cliente</h5>
                    <!-- mesajes de confirmacion -->
                    @if(session('exito'))
                        <div class="alert alert-success">
                            {{session('exito')}}
                        </div>
                    @endif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="text-danger"><i class="bi-backspace-reverse"></i></span>
                    </button>
                </div>
                <div class="modal-body">
                    <br>
                    <div class="form-group">
                        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #1B92F0 );">
                            <div class="card-header text-center text-white">
                                Buscar cliente
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">

                                            <div class="row form-group">
                                                <label for="buscarc" class="text-white">nombre/nit cliente</label>
                                                <input type="text"  name="buscarc" id="textcliente" class="form-control col-md-4">
                                            </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label  class="text-white">Buscar</label><br>

                                        <button type="submit" id="btnbcliente" class="btn btn-success col-md-5"  title="buscar cliente">
                                            <i class="bi-search"></i>
                                        </button>

                                        <a href="{{url('/form_factura')}}" class="btn btn-warning text-white col-md-4" title="todos los registros">
                                            <i class="bi-clipboard-data"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row col-md-12  mt-3">
                        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
                            <h4 class="text-center text-white">clientes</h4>
                        </div><br>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    nit
                                </th>
                                <th>
                                    nombre
                                </th>
                                <th>
                                    dirección
                                </th>
                                <th>
                                    Acción
                                </th>

                            </tr>
                            </thead>
                            <tbody id="tablacliente">
                            @foreach($clientes as $cliente)
                                <tr>
                                    <td>
                                        {{$cliente->nit}}
                                    </td>
                                    <td>
                                        {{$cliente->nombre}}
                                    </td>
                                    <td>
                                        {{$cliente->direccion}}
                                    </td>
                                    <td>

                                        <form action="form_factura" method="get">
                                            <input type="hidden" name="buscarcliente" value="{{$cliente->id}}">

                                            <button  type="submit" class="btn btn-danger col-md-8" title="Agregar">
                                                <i class="bi-arrow-return-right"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{$clientes->appends(['pagina'=>'cliente'])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal buscarcliente-->


@endsection









