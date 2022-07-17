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

    @if(!empty(request('buscarprov')))
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn_proveedore');
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
    @if(request('pagina')==='proveedore')
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn_proveedore');
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


    @if(!empty(session('usuario_id2')))
        <script type="text/javascript">
            $(document).ready(function (ev) {

                var usuario=document.getElementById('usuario');
                usuario.value="{{session('usuario2')}}";

            })
        </script>

    @endif
    @if(!empty(session('proveedore_id')))
        <script type="text/javascript">
            $(document).ready(function (ev) {

                var proveedore=document.getElementById('proveedor');
                proveedore.value="{{session('proveedore')}}";

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
    <script type="text/javascript">
      function reporteexcel() {
          var ffinal=$('#ffinal').val();
          var finicio=$('#finicio').val();
          $('#ffinal2').val(ffinal);
          $('#finicio2').val(finicio);
          $('#codigo2').val({{session('codigo')}});
      }

    </script>

    <script type="text/javascript">
        $(document).ready(function (ev) {
            $("#finicioca").on("change", function () {
                var finicioca=$('#finicioca').val();
                $('#finicioca2').val(finicioca);
                $('#categoria2').val({{session('categoria_id')}});
            })

            $("#ffinalca").on("change", function () {
                var ffinalca=$('#ffinalca').val();
                $('#ffinalca2').val(ffinalca);
                $('#categoria2').val({{session('categoria_id')}});
            })

            $("#finicious").on("change", function () {
                var finicious=$('#finicious').val();
                $('#finicious2').val(finicious);
                $('#usuario2').val({{session('usuario_id2')}});
            })

            $("#ffinalus").on("change", function () {
                var ffinalus=$('#ffinalus').val();
                $('#ffinalus2').val(ffinalus);
                $('#usuario2').val({{session('usuario_id2')}});
            })

            $("#finiciopr").on("change", function () {
                var finiciopr=$('#finiciopr').val();
                $('#finiciopr2').val(finiciopr);
                $('#proveedor2').val({{session('proveedore_id')}});
            })

            $("#ffinalpr").on("change", function () {
                var ffinalpr=$('#ffinalpr').val();
                $('#ffinalpr2').val(ffinalpr);
                $('#proveedor2').val({{session('proveedore_id')}});
            })

            $("#iniciopdf").on("change", function () {
                var iniciopdf=$('#iniciopdf').val();
                $('#finiciosi2').val(iniciopdf);
            })

            $("#finalpdf").on("change", function () {
                var finalpdf=$('#finalpdf').val();
                $('#ffinalsi2').val(finalpdf);

            })
        })
    </script>


    @if(!empty(session('categoria')))
        <script type="text/javascript">
            $(document).ready(function (ev) {

                var formapago=document.getElementById('categoria');
                formapago.value="{{session('categoria')}}";

            })
        </script>

    @endif
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Reportes de entrada</h4>
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
    <div class="col-md-6 mt-3">
        <div class=" row justify-content-center">
            <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );">
                    <div class="card-header text-center text-white">
                        Producto
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{url('/vista_fechas_entrada2')}}" method="get">
                                <div class="row form-group">
                                    <label for="codigo"  class="text-white">Codigo de barras</label>
                                    <input type="number"  name="codigo" id='codigo' class="form-control col-md-4" readonly="readonly">
                                </div>
                                <div class="row form-group">
                                    <label for="finicio" class="text-white">Fecha inicio</label>
                                    <input type="date"  id="finicio"  name="finicio" class="form-control col-md-5" required="required">
                                </div>
                                <div class="row form-group">
                                    <label for="ffinal" class="text-white">Fecha final</label>
                                    <input type="date"  name="ffinal" id="ffinal"  class="form-control col-md-5"  required="required">
                                </div>
                                </div>
                                <div class="col-md-3">
                                <label  class="text-white">Buscar</label><br>
                                    <button type="button" class="btn btn-success col-md-5" id='btn_mpro' data-toggle="modal"  data-target="#addproducto">
                                        <i class="bi-search"></i>
                                    </button>
                                    <br>
                                    <label for="pdf" class="text-white">Reporte PDF</label><br>
                                    <button type="submit" onclick="spinner()" class="btn btn-danger col-md-5" title="Generar reporte">
                                        <i class="bi-file-earmark-pdf"></i>
                                    </button>
                                </form>

                                    <form action="{{url('/vista_fechas_facturastockex')}}" method="get">
                                        <input name="codigo" id="codigo2" type="hidden">
                                        <input name="finicio" id="finicio2" type="hidden">
                                        <input name="ffinal" id="ffinal2" type="hidden">
                                        <label for="pdf" class="text-white">Reporte Excel</label><br>
                                        <button   onclick="reporteexcel()"  type="submit"  class="btn btn-success col-md-5" title="Generar excel">
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
                                <form action="{{url('/vista_fechas_entrada2')}}" method="get">
                                    <div class="row form-group">
                                        <label for="categoria"  class="text-white">Categoría</label>
                                        <input type="text"  name="categoria" id='categoria' class="form-control col-md-4" readonly="readonly">
                                    </div>
                                    <div class="row form-group">
                                        <label for="finicioca" class="text-white">Fecha inicio</label>
                                        <input type="date"  name="finicio" id="finicioca"   class="form-control col-md-5" required="required">
                                    </div>
                                    <div class="row form-group">
                                        <label for="ffinalca" class="text-white">Fecha final</label>
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
                                <form action="{{url('/vista_fechas_facturastockcaex')}}" method="get">
                                    <input name="categoria" id="categoria2" type="hidden">
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
                                <form action="{{url('/vista_fechas_entrada2')}}" method="get">
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
                                <form action="{{url('/vista_fechas_facturastockusex')}}" method="get">
                                    <input name="usuario" id="usuario2" type="hidden">
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
                        Proveedor
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{url('/vista_fechas_entrada2')}}" method="get">
                                    <div class="row form-group">
                                        <label for="proveedor"  class="text-white">Proveedor</label>
                                        <input type="text"  name="proveedor" id='proveedor' class="form-control col-md-4" readonly="readonly">
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
                                <button type="button" class="btn btn-success col-md-5" id='btn_proveedore' data-toggle="modal"  data-target="#modalproveedore">
                                    <i class="bi-search"></i>
                                </button>
                                <br>
                                <label for="pdf" class="text-white">Reporte</label><br>
                                <button type="submit" onclick="spinner()" class="btn btn-danger col-md-5" title="Generar reporte">
                                    <i class="bi-file-earmark-pdf"></i>
                                </button>
                                </form>
                                <form action="{{url('/vista_fechas_facturastockprex')}}" method="get">
                                    <input name="proveedor" id="proveedor2" type="hidden">
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
                        Sín filtro
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{url('/vista_fechas_entrada')}}" method="get">
                                    <div class="row form-group">
                                        <label for="iniciopdf" class="text-white">Fecha inicio</label>
                                        <input type="date"  id="iniciopdf"  name="iniciopdf" class="form-control col-md-5" required="required">
                                    </div>
                                    <div class="row form-group">
                                        <label for="finalpdf" class="text-white">Fecha final</label>
                                        <input type="date"  name="finalpdf" id="finalpdf"  class="form-control col-md-5"  required="required">
                                    </div>
                            </div>
                            <div class="col-md-3">
                                <label for="pdf" class="text-white">Reporte</label><br>
                                <button type="submit" onclick="spinner()" class="btn btn-danger col-md-5" title="Generar reporte">
                                    <i class="bi-file-earmark-pdf"></i>
                                </button>
                                </form>
                                <form action="{{url('/vista_fechas_facturastocksiex')}}" method="get">
                                    <input name="iniciopdf" id="finiciosi2" type="hidden">
                                    <input name="finalpdf" id="ffinalsi2" type="hidden">
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
                                        <form action="/form_reporte_entrada" method="get">
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
                                        <a href="{{url('/form_reporte_entrada')}}" class="btn btn-warning text-white col-md-4" title="todos los registros">
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
                                    <form action="/form_reporte_entrada" method="get">
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
                                        <form  method="get"  action="form_reporte_entrada">
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
                                        <a href="{{url('/form_reporte_entrada')}}" class="btn btn-warning text-white col-md-4" title="todos los registros">
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

                                        <form action="form_reporte_entrada" method="get">
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


    <!-- modal proveedore-->
    <div class="modal fade bd-example-modal-lg" id="modalproveedore" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalproveedore">Buscar proveedor</h5>
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
                                Buscar proveedor
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <form  method="get"  action="form_reporte_entrada">
                                            <div class="row form-group">
                                                <label for="buscarus" class="text-white">nombre</label>
                                                <input type="text"  name=" buscarprov" class="form-control col-md-4">
                                            </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label  class="text-white">Buscar</label><br>

                                        <button type="submit"  class="btn btn-success col-md-5"  title="buscar proveedor">
                                            <i class="bi-search"></i>
                                        </button>
                                        </form>
                                        <a href="{{url('/form_reporte_entrada')}}" class="btn btn-warning text-white col-md-4" title="todos los registros">
                                            <i class="bi-clipboard-data"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="row col-md-12  mt-3">
                        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
                            <h4 class="text-center text-white">proveedores</h4>
                        </div><br>

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>
                                    Nombre
                                </th>
                                <th>
                                    Dirección
                                </th>
                                <th>
                                    Tel
                                </th>
                                <th>
                                    Estado
                                </th>
                                <th>
                                    Acción
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($proveedores as $prov)
                                <tr>
                                    <td>
                                        {{$prov->nombre}}
                                    </td>
                                    <td>
                                        {{$prov->direccion}}
                                    </td>
                                    <td>
                                        {{$prov->tel}}
                                    </td>
                                    <td>
                                        {{$prov->estado}}
                                    </td>
                                    <td>

                                        <form action="form_reporte_entrada" method="get">
                                            <input type="hidden" name="proveedore_id" value="{{$prov->id}}">

                                            <button  type="submit" class="btn btn-danger col-md-8" title="Agregar">
                                                <i class="bi-arrow-return-right"></i>
                                            </button>
                                        </form>

                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{$proveedores->appends(['pagina'=>'proveedore'])->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- modal buscarprove-->


    <!-- modal fcategotia-->
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
                                        <form  method="get"  action="form_reporte_entrada">
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
                                        <a href="{{url('/form_reporte_entrada')}}" class="btn btn-warning text-white col-md-4" title="todos los registros">
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

                                        <form action="form_reporte_entrada" method="get">
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

    <!-- modal categoria-->


@endsection








