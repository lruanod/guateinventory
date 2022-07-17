@extends('layouts.base2')
@section('title', 'categoría')
@section('content')
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Forma de pagos</h4>
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
                        Forma de pago
                    </div>
                    <div class="card-body">
                        <div class="row">

                                <div class="col-md-3">
                                    <form action="{{url('/list_fpago')}}" method="get">
                                    <div class="row form-group">
                                        <label for="buscar" class="text-white">Forma de pago</label>
                                        <input type="text" placeholder="buscar" name="buscar" class="form-control col-md-3">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label  class="text-white">Buscar</label><br>
                                        <button type="submit" class="btn btn-warning text-white col-md-4" title="Buscar forma de pago">
                                            <i class="bi-search"></i>
                                        </button>

                                    </form>
                                    <a href="{{url('/list_fpago')}}" class="btn btn-info text-white col-md-4" title="todos los registros">
                                        <i class="bi-clipboard-data"></i>
                                    </a>
                                </div>


                            <div class="col-md-2">
                                <label  class="text-white">+ forma de pago</label><br>
                                <a href="/form_fpago" type="submit" class="btn btn-success col-md-4" title="Agragar forma de pago">
                                    <i class="bi-arrow-return-right"></i>
                                </a>
                            </div>

                            <div class="col-md-2">
                                <label  class="text-white">+ categoría</label><br>
                                <a href="/list_categoria" type="submit" class="btn btn-success col-md-4" title="Agragar categoría">
                                    <i class="bi-arrow-return-right"></i>
                                </a>

                            </div>

                            <div class="col-md-2">
                                <label  class="text-white">+ producto</label><br>
                                <a href="list_producto" type="submit" class="btn btn-success col-md-4" title="Agragar productos">
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
            <h4 class="text-center text-white">Lista de formas de pago</h4>
        </div><br>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    Codigo
                </th>
                <th>
                    forma de pago
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
            @foreach($fpagos as $fpago)
             <tr>
                <td>
                    {{$fpago->id}}
                </td>
                <td>
                    {{$fpago->formapago}}
                </td>
                 <td>
                     {{$fpago->estado}}
                 </td>
                <td>
                    <div class="row">
                        <div class="col-12">
                            <div class="row ">
                                <div class="col-5">

                                    <a href="{{route('form_edit_fpago',$fpago->id)}}" class="btn btn-info col-5" title="Editar forma de pago">
                                        <i class="bi-pencil-fill text-white"></i>
                                    </a>

                                </div>
                                <div class="col-5">
                                    <a href="{{route('form_des_fpago',$fpago->id)}}"  class="btn btn-danger col-5" title="Deshabilitar forma de pago">
                                        <i class="bi-scissors"></i>
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
        {{$fpagos->links()}}

    </div>
@endsection
