@extends('layouts.base2')
@section('title', 'entradas')
@section('content')

    <script type="text/javascript">
        $(document).ready(function (ev) {
            $("#inicio").on("change", function () {

                var finicio = document.getElementById('inicio').value;
                var finiciopdf=document.getElementById('iniciopdf');
                finiciopdf.value=finicio;

            })
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function (ev) {
            $("#final").on("change", function () {
                var ffinal=document.getElementById('final').value;
                var ffinalpdf=document.getElementById('finalpdf');
                ffinalpdf.value=ffinal;
            })
        })
    </script>

    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Entradas</h4>
        </div>

    </div>

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

    <div class="col-md-10 mt-3">
        <div class=" row justify-content-center">
            <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );">
                    <div class="card-header text-center text-white">
                        Categorías
                    </div>
                    <div class="card-body">
                        <div class="row">

                                      <div class="col-md-4">
                                          <form action="{{url('/list_entrada')}}" method="get">
                                              <div class="row form-group">
                                                  <label for="inicio" class="text-white">Fecha inicio</label>
                                                  <input type="date"  id="inicio" name="inicio" class="form-control col-md-5" required="required">
                                              </div>
                                              <div class="row form-group">
                                                  <label for="final" class="text-white">Fecha final</label>
                                                  <input type="date"  id="final" name="final" class="form-control col-md-5" required="required">
                                              </div>
                                      </div>

                                        <div class="col-md-2">
                                            <label  class="text-white">Buscar</label><br>
                                                <button type="submit" class="btn btn-warning text-white col-md-4" title="Buscar producto">
                                                    <i class="bi-search"></i>
                                                </button>
                                           </form>
                                            <a href="{{url('/list_entrada')}}" class="btn btn-info text-white col-md-4" title="todos los registros">
                                                <i class="bi-clipboard-data"></i>
                                            </a>
                                            <form action="{{url('/vista_fechas_entrada')}}" method="get">
                                                <input type="hidden" name="iniciopdf" id="iniciopdf">
                                                <input type="hidden" name="finalpdf" id="finalpdf">
                                                <button  type="submit" onclick="spinner()" class="btn btn-danger text-white col-md-4" title="generar pdf">
                                                    <i class="bi-file-earmark-pdf"></i>
                                                </button>
                                            </form>
                                        </div>


                            <div class="col-md-2">
                                <label  class="text-white">+ entrada</label><br>
                                <a href="/form_entrada" type="submit" class="btn btn-success col-md-4" title="Agragar entrada">
                                    <i class="bi-arrow-return-right"></i>
                                </a>
                            </div>

                            <div class="col-md-2">
                                <label  class="text-white">+ producto</label><br>
                                <a href="/list_categoria" type="submit" class="btn btn-success col-md-4" title="Agragar producto">
                                    <i class="bi-arrow-return-right"></i>
                                </a>
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div class="row col-12  mt-3">
        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Lista de entradas</h4>
        </div><br>

        <table class="table  table-responsive">
            <thead>
            <tr>
                <th>
                    Fecha
                </th>
                <th>
                    Producto
                </th>
                <th>
                    Precio compra actual
                </th>
                <th>
                    Precio venta actual
                </th>
                <th>
                    Stock actual
                </th>
                <th>
                    Precio de entrada
                </th>
                <th>
                    Stock de entrada
                </th>
                <th>
                    Descripción
                </th>
                <th>
                    Proveedor
                </th>
                <th>
                    Operador
                </th>
                <th>
                    Acción
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($entradas as $entrada)
             <tr>
                <td>
                    {{$entrada->fechaentrada}}
                </td>
                <td>
                    {{$entrada->producto->nombre}}/{{$entrada->producto->medida->medida}}
                </td>
                 <td>
                     {{$entrada->precio}}
                 </td>
                 <td>
                     {{$entrada->precioventa}}
                 </td>
                 <td>
                     {{$entrada->stock}}
                 </td>
                 <td>
                     {{$entrada->precioentrada}}
                 </td>
                 <td>
                     {{$entrada->stockentrada}}
                 </td>
                 <td>
                     {{$entrada->descripcion}}
                 </td>
                 <td>
                     {{$entrada->proveedore->nombre}}
                 </td>
                 <td>
                     {{$entrada->usuario->nombre}}
                 </td>
                <td>
                    <div class="row">
                        <div class="col-12">
                            <div class="row ">
                                <div class="col-8">

                                    <a href="{{route('form_edit_entrada',$entrada->id)}}" class="btn btn-info col-12" title="Editar entrada">
                                        <i class="bi-pencil-fill text-white"></i>
                                    </a>

                                </div>
                                <div class="col-8">
                                    <a href="{{route('imprimir_pdf',$entrada->id)}}"  class="btn btn-danger col-12" title="Imprimir">
                                        <i class="bi-printer-fill"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
             </tr>
            @endforeach

            </tbody>
        </table>
        <br>
        {{$entradas->links()}}

    </div>
@endsection
