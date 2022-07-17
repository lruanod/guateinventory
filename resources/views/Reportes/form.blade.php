@extends('layouts.base2')
@section('title', 'Reportes')
@section('content')

    @if(!empty(request('buscar')))
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn_mpro');
                obj.click();
            })
        </script>
    @endif


    @if(!empty(request('buscarc')))
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn-modal2');
                obj.click();
            })
        </script>
    @endif
    @if(!empty(request('buscarf')))
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn_mfp');
                obj.click();
            })
        </script>
    @endif

    @if(!empty(request('buscarca')))
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn_mcate');
                obj.click();
            })
        </script>
    @endif

    @if(!empty(request('buscarus')))
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn_usuario');
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
    @if(request('pagina')==='usuario')
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn_usuario');
                obj.click();
            })
        </script>
    @endif

    @if(request('pagina')=='cliente')
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn-modal2');
                obj.click();
            })
        </script>
    @endif
    @if(request('pagina')=='fpago')
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn_mfp');
                obj.click();
            })
        </script>
    @endif
    @if(request('pagina')=='categoria')
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn_mcate');
                obj.click();
            })
        </script>
    @endif


    @if(!empty(session('cliente_id')))
        <script type="text/javascript">
            $(document).ready(function (ev) {

                var nit=document.getElementById('nit');
                nit.value="{{session('nit')}}";

            })
        </script>

    @endif
    @if(!empty(session('usuario_id2')))
        <script type="text/javascript">
            $(document).ready(function (ev) {

                var usuario=document.getElementById('usuario');
                usuario.value="{{session('usuario2')}}";

            })
        </script>

    @endif
    @if(!empty(session('codigo')))
        <script type="text/javascript">
            $(document).ready(function (ev) {

                var codigo=document.getElementById('codigo');
                codigo.value="{{session('codigo')}}";

            })
        </script>

    @endif
    @if(!empty(session('formapago')))
        <script type="text/javascript">
            $(document).ready(function (ev) {

                var formapago=document.getElementById('formapagoid');
                formapago.value="{{session('formapago')}}";

            })
        </script>

    @endif
    @if(!empty(session('categoria')))
        <script type="text/javascript">
            $(document).ready(function (ev) {

                var categoria=document.getElementById('categoria');
                categoria.value="{{session('categoria')}}";

            })
        </script>

    @endif

    <script type="text/javascript">
        $(document).ready(function (ev) {
            $("#finiciocl").on("change", function () {
                var finiciocl=$('#finiciocl').val();
                $('#finiciocl2').val(finiciocl);
                $('#nit2').val({{session('nit')}});
            })

            $("#ffinalcl").on("change", function () {
                var ffinalcl=$('#ffinalcl').val();
                $('#ffinalcl2').val(ffinalcl);
                $('#nit2').val({{session('nit')}});

            })

            $("#finiciofp").on("change", function () {
                var finiciofp=$('#finiciofp').val();
                $('#finiciofp2').val(finiciofp);
            })

            $("#ffinalfp").on("change", function () {
                var ffinalfp=$('#ffinalfp').val();
                $('#ffinalfp2').val(ffinalfp);
            })

            $("#finiciopr").on("change", function () {
                var finiciopr=$('#finiciopr').val();
                $('#finiciopr2').val(finiciopr);
            })

            $("#ffinalpr").on("change", function () {
                var ffinalpr=$('#ffinalpr').val();
                $('#ffinalpr2').val(ffinalpr);
            })

            $("#finicioca").on("change", function () {
                var finicioca=$('#finicioca').val();
                $('#finicioca2').val(finicioca);
            })

            $("#ffinalca").on("change", function () {
                var ffinalca=$('#ffinalca').val();
                $('#ffinalca2').val(ffinalca);
            })
            $("#finicious").on("change", function () {
                var finicious=$('#finicious').val();
                $('#finicious2').val(finicious);
            })

            $("#ffinalus").on("change", function () {
                var ffinalus=$('#ffinalus').val();
                $('#ffinalus2').val(ffinalus);
            })

            $("#iniciopdfsi").on("change", function () {
                var iniciopdfsi=$('#iniciopdfsi').val();
                $('#iniciopdfsi2').val(iniciopdfsi);
            })

            $("#finalpdfsi").on("change", function () {
                var finalpdfsi=$('#finalpdfsi').val();
                $('#finalpdfsi2').val(finalpdfsi);
            })
        })
    </script>
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Reportes</h4>
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
                                <div class="col-md-8">
                                    <form action="{{url('/vista_fechas_factura2')}}" method="get">
                                        @csrf
                                    <div class="row form-group">
                                        <label for="nit" class="text-white">NIT</label>
                                        <input type="text"  pattern="[0-9]+[-]+[0-9]" id="nit" name="nit" class="form-control col-md-4" readonly="readonly">
                                    </div>
                                    <div class="row form-group">
                                        <label for="finicio" class="text-white">Fecha inicio</label>
                                        <input type="date"  id="finiciocl"  name="finicio" class="form-control col-md-5" required="required">
                                    </div>
                                    <div class="row form-group">
                                        <label for="ffinal" class="text-white">Fecha final</label>
                                        <input type="date"  name="ffinal" id="ffinalcl"  class="form-control col-md-5"  required="required">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="buscar" class="text-white">Buscar</label><br>
                                        <button type="button" class="btn btn-success col-md-5" id="btn-modal2" data-toggle="modal" data-target="#buscarclientem">
                                            <i class="bi-search"></i>
                                        </button>
                                    <br>
                                    <label for="pdf" class="text-white">Reporte</label><br>
                                    <button type="submit" onclick="spinner()" class="btn btn-danger col-md-5" title="Generar reporte">
                                        <i class="bi-file-earmark-pdf"></i>
                                    </button>
                                </form>
                                    <form action="{{url('/vista_fechas_factura2clex')}}" method="get">
                                        <input name="nit" id="nit2" type="hidden">
                                        <input name="finicio" id="finiciocl2" type="hidden">
                                        <input name="ffinal" id="ffinalcl2" type="hidden">
                                        <label for="pdf" class="text-white">Reporte Excel</label><br>
                                        <button type="submit"  class="btn btn-success col-md-5" title="Generar excel">
                                            <i class="bi-file-earmark-spreadsheet"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6"> <!-- /.row forma de pago -->
        <div class=" row justify-content-center">
            <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );">
                <div class="card-header text-center text-white">
                    Formas de pago
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                    <form action="{{url('/vista_fechas_factura2')}}" method="get">
                        <div class="row form-group">
                            <label for="formapago"  class="text-white">Forma de pago</label>
                            <input type="text"  name="formapago" id='formapagoid' class="form-control col-md-4" readonly="readonly">
                        </div>
                        <div class="row form-group">
                            <label for="finicio" class="text-white">Fecha inicio</label>
                            <input type="date"  id="finiciofp"  name="finicio" class="form-control col-md-5" required="required">
                        </div>
                        <div class="row form-group">
                            <label for="ffinal" class="text-white">Fecha final</label>
                            <input type="date"  name="ffinal" id="ffinalfp"  class="form-control col-md-5"  required="required">
                        </div>
                     </div>
                <div class="col-md-3">
                    <label  class="text-white">Buscar</label><br>
                    <button type="button" class="btn btn-success col-md-5" id='btn_mfp' data-toggle="modal"  data-target="#modalfpago">
                        <i class="bi-search"></i>
                    </button>
                    <br>
                    <label for="pdf" class="text-white">Reporte</label><br>
                    <button type="submit" onclick="spinner()" class="btn btn-danger col-md-5" title="Generar reporte">
                        <i class="bi-file-earmark-pdf"></i>
                    </button>
                    </form>
                    <form action="{{url('/vista_fechas_factura2fpex')}}" method="get">
                        <input name="formapago"  value="{{session('formapago')}}" type="hidden">
                        <input name="finicio" id="finiciofp2" type="hidden">
                        <input name="ffinal" id="ffinalfp2" type="hidden">
                        <label for="pdf" class="text-white">Reporte Excel</label><br>
                        <button type="submit"  class="btn btn-success col-md-5" title="Generar excel">
                            <i class="bi-file-earmark-spreadsheet"></i>
                        </button>
                    </form>
                </div>
                </div>
                </div>
            </div>
        </div>


    </div><!-- /.row forma de pago -->

    <div class="col-md-6 mt-3">
        <div class=" row justify-content-center">
            <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );">
                    <div class="card-header text-center text-white">
                        Producto
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{url('/vista_fechas_factura2')}}" method="get">
                                <div class="row form-group">
                                    <label for="codigo"  class="text-white">Codigo de barras</label>
                                    <input type="number"  name="codigo" id='codigo' class="form-control col-md-4" readonly="readonly">
                                </div>
                                <div class="row form-group">
                                    <label for="finicio" class="text-white">Fecha inicio</label>
                                    <input type="date"  id="finiciopr"  name="finicio" class="form-control col-md-5" required="required">
                                </div>
                                <div class="row form-group">
                                    <label for="ffinal" class="text-white">Fecha final</label>
                                    <input type="date"  name="ffinal" id="ffinalpr"  class="form-control col-md-5"  required="required">
                                </div>
                                </div>
                                <div class="col-md-3">
                                <label  class="text-white">Buscar</label><br>
                                    <button type="button" class="btn btn-success col-md-5" id='btn_mpro' data-toggle="modal"  data-target="#addproducto">
                                        <i class="bi-search"></i>
                                    </button>
                                    <br>
                                    <label for="pdf" class="text-white">Reporte</label><br>
                                    <button type="submit" onclick="spinner()" class="btn btn-danger col-md-5" title="Generar reporte">
                                        <i class="bi-file-earmark-pdf"></i>
                                    </button>
                                </form>
                                    <form action="{{url('/vista_fechas_factura2prex')}}" method="get">
                                        <input name="codigo"  value="{{session('codigo')}}" type="hidden">
                                        <input name="finicio" id="finiciopr2" type="hidden">
                                        <input name="ffinal" id="ffinalpr2" type="hidden">
                                        <label for="pdf" class="text-white">Reporte Excel</label><br>
                                        <button type="submit"  class="btn btn-success col-md-5" title="Generar excel">
                                            <i class="bi-file-earmark-spreadsheet"></i>
                                        </button>
                                    </form>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <div class="col-md-6 mt-3">
            <div class=" row justify-content-center">
                <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );">
                    <div class="card-header text-center text-white">
                        Categoría
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{url('/vista_fechas_factura2')}}" method="get">
                                    <div class="row form-group">
                                        <label for="categoria"  class="text-white">Categoría</label>
                                        <input type="text"  name="categoria" id='categoria' class="form-control col-md-4" readonly="readonly">
                                    </div>
                                    <div class="row form-group">
                                        <label for="finicio" class="text-white">Fecha inicio</label>
                                        <input type="date"  id="finicioca"  name="finicio" class="form-control col-md-5" required="required">
                                    </div>
                                    <div class="row form-group">
                                        <label for="ffinal" class="text-white">Fecha final</label>
                                        <input type="date"  name="ffinal" id="ffinalca"  class="form-control col-md-5"  required="required">
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <label  class="text-white">Buscar</label><br>
                                <button type="button" class="btn btn-success col-md-5" id='btn_mcate' data-toggle="modal"  data-target="#modalcate">
                                    <i class="bi-search"></i>
                                </button>
                                <br>
                                <label for="pdf" class="text-white">Reporte</label><br>
                                <button type="submit" onclick="spinner()" class="btn btn-danger col-md-5" title="Generar reporte">
                                    <i class="bi-file-earmark-pdf"></i>
                                </button>
                                </form>
                                <form action="{{url('/vista_fechas_factura2caex')}}" method="get">
                                    <input name="categoria"  value="{{session('categoria')}}" type="hidden">
                                    <input name="finicio" id="finicioca2" type="hidden">
                                    <input name="ffinal" id="ffinalca2" type="hidden">
                                    <label for="pdf" class="text-white">Reporte Excel</label><br>
                                    <button type="submit"  class="btn btn-success col-md-5" title="Generar excel">
                                        <i class="bi-file-earmark-spreadsheet"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-6 mt-3">
            <div class=" row justify-content-center">
                <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );">
                    <div class="card-header text-center text-white">
                        Usuario
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{url('/vista_fechas_factura2')}}" method="get">
                                    <div class="row form-group">
                                        <label for="usuario"  class="text-white">Usuario</label>
                                        <input type="text"  name="usuario" id='usuario' class="form-control col-md-4" readonly="readonly">
                                    </div>
                                    <div class="row form-group">
                                        <label for="finicio" class="text-white">Fecha inicio</label>
                                        <input type="date"  id="finicious"  name="finicio" class="form-control col-md-5" required="required">
                                    </div>
                                    <div class="row form-group">
                                        <label for="ffinal" class="text-white">Fecha final</label>
                                        <input type="date"  name="ffinal" id="ffinalus"  class="form-control col-md-5"  required="required">
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <label  class="text-white">Buscar</label><br>
                                <button type="button" class="btn btn-success col-md-5" id='btn_usuario' data-toggle="modal"  data-target="#modalusuario">
                                    <i class="bi-search"></i>
                                </button>
                                <br>
                                <label for="pdf" class="text-white">Reporte</label><br>
                                <button type="submit" onclick="spinner()" class="btn btn-danger col-md-5" title="Generar reporte">
                                    <i class="bi-file-earmark-pdf"></i>
                                </button>
                                </form>
                                <form action="{{url('/vista_fechas_factura2usex')}}" method="get">
                                    <input name="usuario"  value="{{session('usuario2')}}" type="hidden">
                                    <input name="finicio" id="finicious2" type="hidden">
                                    <input name="ffinal" id="ffinalus2" type="hidden">
                                    <label for="pdf" class="text-white">Reporte Excel</label><br>
                                    <button type="submit"  class="btn btn-success col-md-5" title="Generar excel">
                                        <i class="bi-file-earmark-spreadsheet"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="col-md-6 mt-3">
            <div class=" row justify-content-center">
                <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );">
                    <div class="card-header text-center text-white">
                        Sín filtro
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{url('/vista_fechas_factura')}}" method="get">
                                    <div class="row form-group">
                                        <label for="iniciopdf" class="text-white">Fecha inicio</label>
                                        <input type="date"  id="iniciopdfsi"  name="iniciopdf" class="form-control col-md-5" required="required">
                                    </div>
                                    <div class="row form-group">
                                        <label for="finalpdf" class="text-white">Fecha final</label>
                                        <input type="date"  name="finalpdf" id="finalpdfsi"  class="form-control col-md-5"  required="required">
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <label for="pdf" class="text-white">Reporte</label><br>
                                <button type="submit" onclick="spinner()"  target="_blank" class="btn btn-danger col-md-5" title="Generar reporte">
                                    <i class="bi-file-earmark-pdf"></i>
                                </button>
                                </form>
                                <form action="{{url('/vista_fechas_factura2siex')}}" method="get">
                                    <input name="finicio" id="iniciopdfsi2" type="hidden">
                                    <input name="ffinal" id="finalpdfsi2" type="hidden">
                                    <label for="pdf" class="text-white">Reporte Excel</label><br>
                                    <button type="submit"  class="btn btn-success col-md-5" title="Generar excel">
                                        <i class="bi-file-earmark-spreadsheet"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>

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
                                        <form action="/form_reporte" method="get">
                                        <div class="row form-group">
                                            <label for="buscar" class="text-white">Descripción del producto</label>
                                            <input type="text"  name="buscar" class="form-control col-md-4">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label  class="text-white">Buscar</label><br>

                                            <button type="submit" class="btn btn-success col-md-5" data-toggle="modal" data-target="#addproducto">
                                                <i class="bi-search"></i>
                                            </button>
                                        </form>
                                        <a href="{{url('/form_reporte')}}" class="btn btn-warning text-white col-md-4" title="todos los registros">
                                            <i class="bi-clipboard-data"></i>
                                        </a>
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
                            <tbody>
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
                                    <form action="/form_reporte" method="get">
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

    <!-- modal buscarus-->
    <div class="modal fade bd-example-modal-lg" id="modalusuario" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalusuario">Buscar usuario</h5>
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
                                Buscar usuario
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <form  method="get"  action="form_reporte">
                                            <div class="row form-group">
                                                <label for="buscarus" class="text-white">nombre/usuario</label>
                                                <input type="text"  name=" buscarus" class="form-control col-md-4">
                                            </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label  class="text-white">Buscar</label><br>

                                        <button type="submit"  class="btn btn-success col-md-5"  title="buscar usuario">
                                            <i class="bi-search"></i>
                                        </button>
                                        </form>
                                        <a href="{{url('/form_reporte')}}" class="btn btn-warning text-white col-md-4" title="todos los registros">
                                            <i class="bi-clipboard-data"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row col-md-12  mt-3">
                        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
                            <h4 class="text-center text-white">usuarios</h4>
                        </div><br>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    Usuario
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    CUI
                                </th>
                                <th>
                                    Rol
                                </th>
                                <th>
                                    Acción
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usuarios as $usuario)
                                <tr>
                                    <td>
                                        {{$usuario->usuario}}
                                    </td>
                                    <td>
                                        {{$usuario->nombre}}
                                    </td>
                                    <td>
                                        {{$usuario->cui}}
                                    </td>
                                    <td>
                                        {{$usuario->rol}}
                                    </td>
                                    <td>

                                        <form action="form_reporte" method="get">
                                            <input type="hidden" name="usuario_id" value="{{$usuario->id}}">

                                            <button  type="submit" class="btn btn-danger col-md-8" title="Agregar">
                                                <i class="bi-arrow-return-right"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{$usuarios->appends(['pagina'=>'usuario'])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal buscarcliente-->



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
                                        <form  method="get"  action="form_reporte">
                                            <div class="row form-group">
                                                <label for="buscarc" class="text-white">nombre/nit cliente</label>
                                                <input type="text"  name=" buscarc" class="form-control col-md-4">
                                            </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label  class="text-white">Buscar</label><br>

                                        <button type="submit"  class="btn btn-success col-md-5"  title="buscar cliente">
                                            <i class="bi-search"></i>
                                        </button>
                                        </form>
                                        <a href="{{url('/form_reporte')}}" class="btn btn-warning text-white col-md-4" title="todos los registros">
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
                            <tbody>
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

                                        <form action="form_reporte" method="get">
                                            <input type="hidden" name="cliente_id" value="{{$cliente->id}}">

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


    <!-- modal forma depago-->
    <div class="modal fade bd-example-modal-lg" id="modalfpago" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalfpago">Buscar forma de pago</h5>
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
                                Buscar forma de pago
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <form  method="get"  action="form_reporte">
                                            <div class="row form-group">
                                                <label for="buscarf" class="text-white">nombre/forma de pago</label>
                                                <input type="text"  name=" buscarf" class="form-control col-md-4">
                                            </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label  class="text-white">Buscar</label><br>
                                        <button type="submit"  class="btn btn-success col-md-5"  title="buscar forma de pago">
                                            <i class="bi-search"></i>
                                        </button>
                                        </form>
                                        <a href="{{url('/form_reporte')}}" class="btn btn-warning text-white col-md-4" title="todos los registros">
                                            <i class="bi-clipboard-data"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row col-md-12  mt-3">
                        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
                            <h4 class="text-center text-white">formas de pago</h4>
                        </div><br>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    Forma de pago
                                </th>

                                <th>
                                    Acción
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($fpagos as $fpago)
                                <tr>
                                    <td>
                                        {{$fpago->formapago}}
                                    </td>
                                    <td>

                                        <form action="form_reporte" method="get">
                                            <input type="hidden" name="fpago_id" value="{{$fpago->id}}">

                                            <button  type="submit" class="btn btn-danger col-md-2" title="Agregar">
                                                <i class="bi-arrow-return-right"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{$fpagos ->appends(['pagina'=>'fpago'])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal buscarcliente-->

    <!-- modal forma depago-->
    <div class="modal fade bd-example-modal-lg" id="modalcate" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalcate">Buscar forma de pago</h5>
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
                                Buscar categoria
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <form  method="get"  action="form_reporte">
                                            <div class="row form-group">
                                                <label for="buscarca" class="text-white">nombre/categoría</label>
                                                <input type="text"  name=" buscarca" class="form-control col-md-4">
                                            </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label  class="text-white">Buscar</label><br>
                                        <button type="submit"  class="btn btn-success col-md-5"  title="buscar forma de pago">
                                            <i class="bi-search"></i>
                                        </button>
                                        </form>
                                        <a href="{{url('/form_reporte')}}" class="btn btn-warning text-white col-md-4" title="todos los registros">
                                            <i class="bi-clipboard-data"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row col-md-12  mt-3">
                        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
                            <h4 class="text-center text-white">categorias</h4>
                        </div><br>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    Categoría
                                </th>

                                <th>
                                    Acción
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categorias as $cate)
                                <tr>
                                    <td>
                                        {{$cate->categoria}}
                                    </td>
                                    <td>

                                        <form action="form_reporte" method="get">
                                            <input type="hidden" name="categoria_id" value="{{$cate->id}}">

                                            <button  type="submit" class="btn btn-danger col-md-2" title="Agregar">
                                                <i class="bi-arrow-return-right"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{$categorias ->appends(['pagina'=>'catagoria'])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal buscarcliente-->


@endsection








