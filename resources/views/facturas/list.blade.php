@extends('layouts.base2')
@section('title', 'facturas')
@section('content')

    <script type="text/javascript">
        $(document).ready(function (ev) {
            $("#finicio").on("change", function () {

                var finicio = document.getElementById('finicio').value;
                var finiciopdf=document.getElementById('iniciopdf');
                finiciopdf.value=finicio;

            })
        })
    </script>

    <script type="text/javascript">
        $(document).ready(function (ev) {
            $("#ffinal").on("change", function () {
                var ffinal=document.getElementById('ffinal').value;
                var ffinalpdf=document.getElementById('finalpdf');
                ffinalpdf.value=ffinal;
            })
        })
    </script>
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Facturas</h4>
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

    <div class="col-md-9 mt-3">
        <div class=" row justify-content-center">
            <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );">
                    <div class="card-header text-center text-white">
                        Facturas
                    </div>
                    <div class="card-body">

                        <div class="row">

                                    <div class="col-md-4">
                                        <form action="{{url('/list_factura')}}" method="get">
                                        <div class="row form-group">
                                            <label for="finicio" class="text-white">Fecha inicio</label>
                                            <input type="date"  id="finicio"  name="finicio" class="form-control col-md-5">
                                        </div>
                                        <div class="row form-group">
                                            <label for="ffinal" class="text-white">Fecha final</label>
                                            <input type="date"  name="ffinal" id="ffinal"  class="form-control col-md-5">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <label  class="text-white">Buscar</label><br>
                                            <button type="submit" class="btn btn-warning text-white col-md-4" title="Buscar producto">
                                                <i class="bi-search"></i>
                                            </button>
                                      </form>
                                    <a href="{{url('/list_factura')}}" class="btn btn-info text-white col-md-4" title="todos los registros">
                                        <i class="bi-clipboard-data"></i>
                                    </a>
                                     <br><br>
                                        <form action="{{url('/vista_fechas_factura')}}" method="get">
                                            <input type="hidden" name="iniciopdf" id="iniciopdf">
                                            <input type="hidden" name="finalpdf" id="finalpdf">
                                            <button  type="submit" class="btn btn-danger text-white col-md-4" title="generar pdf">
                                                <i class="bi-file-earmark-pdf"></i>
                                            </button>
                                        </form>
                                    </div>

                            <div class="col-md-2">
                                <label  class="text-white">+ Facturas</label><br>
                                <a  href="/form_factura"  class="btn btn-success col-md-4" title="Agragar factura">
                                    <i class="bi-arrow-return-right"></i>
                                </a>
                            </div>


                            <div class="col-md-2">
                                <label  class="text-white">+ Entradas</label><br>
                                <a href="/list_entrada" type="submit" class="btn btn-success col-md-4" title="Agragar entradas">
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
            <h4 class="text-center text-white">Lista de facturas</h4>
        </div><br>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    Fecha
                </th>
                <th>
                    cliente
                </th>
                <th>
                    forma de pago
                </th>

                <th>
                    Total
                </th>
                <th>
                    Descuento
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
            @foreach($facturas as $factura)
             <tr>
                <td>
                    {{$factura->fechafactura}}
                </td>
                <td>
                    {{$factura->cliente->nombre}}
                </td>
                 <td>
                     {{$factura->fpago->formapago}}
                 </td>
                 <td>
                     {{$factura->venta->total}}
                 </td>
                 <td>
                     {{$factura->venta->descuento}}
                 </td>
                 <td>
                     usuario:{{$factura->usuario->usuario}}/ nombre:{{$factura->usuario->nombre}}
                 </td>
                <td>
                    <div class="row">
                        <div class="col-12">
                            <div class="row ">
                                <div class="col-10">
                                    <a href="{{route('factura_pdf',$factura->id)}}"  class="btn btn-danger col-10"  title="Imprimir factura">
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
        {{$facturas->links()}}

    </div>
@endsection
