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



    @if(request('pagina')=='categoria')
        <script type="text/javascript">
            $(document).ready(function (ev) {
                var obj=document.getElementById('btn_mcate');
                obj.click();
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
    <div class="col-md-6 mt-3">
        <div class=" row justify-content-center">
            <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );">
                    <div class="card-header text-center text-white">
                        Producto
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <form action="{{url('/vista_fechas_facturastock')}}" method="get">
                                <div class="row form-group">
                                    <label for="codigo"  class="text-white">Codigo de barras</label>
                                    <input type="number"  name="codigo" id='codigo' class="form-control col-md-4" readonly="readonly">
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
                                    <form action="{{url('/productosex')}}" method="get">
                                        <input name="codigo"  value="{{session('codigo')}}" type="hidden">
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
                                <form action="{{url('/vista_fechas_facturastock')}}" method="get">
                                    <div class="row form-group">
                                        <label for="categoria"  class="text-white">Categoría</label>
                                        <input type="text"  name="categoria" id='categoria' class="form-control col-md-4" readonly="readonly">
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
                                <form action="{{url('/stockcategoriaex')}}" method="get">
                                    <input name="categoria"  value="{{session('categoria')}}" type="hidden">
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
                                <form action="{{url('/vista_fechas_facturastock')}}" method="get">

                            </div>
                            <div class="col-md-3">
                                <label for="pdf" class="text-white">Reporte</label><br>
                                <button type="submit" onclick="spinner()" class="btn btn-danger col-md-5" title="Generar reporte">
                                    <i class="bi-file-earmark-pdf"></i>
                                </button>
                                </form>

                                <form action="{{url('/stocksinex')}}" method="get">
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
                                        <form action="/form_reportestock" method="get">
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
                                        <a href="{{url('/form_reportestock')}}" class="btn btn-warning text-white col-md-4" title="todos los registros">
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
                                    <form action="/form_reportestock" method="get">
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



    <!-- modal categoria-->
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
                                        <form  method="get"  action="form_reportestock">
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
                                        <a href="{{url('/form_reportestock')}}" class="btn btn-warning text-white col-md-4" title="todos los registros">
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

                                        <form action="form_reportestock" method="get">
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








