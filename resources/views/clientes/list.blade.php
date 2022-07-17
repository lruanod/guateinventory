@extends('layouts.base2')
@section('title', 'cliente')
@section('content')
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Clientes</h4>
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
                        Clientes
                    </div>
                    <div class="card-body">
                        <div class="row">

                                <div class="col-md-3">
                                    <form action="{{url('/list_cliente')}}" method="get">
                                        <div class="row form-group">
                                            <label for="buscar" class="text-white">NIT / nombre</label>
                                            <input type="text"  name="buscar" class="form-control col-md-5">
                                        </div>
                                </div>

                                <div class="col-md-2">
                                    <label  class="text-white">Buscar</label><br>
                                        <button type="submit" class="btn btn-warning text-white col-md-4" title="Buscar cliente">
                                            <i class="bi-search"></i>
                                        </button>

                                    </form>
                                    <a href="{{url('/list_cliente')}}" class="btn btn-info text-white col-md-4" title="todos los registros">
                                        <i class="bi-clipboard-data"></i>
                                    </a>
                                </div>


                                <div class="col-md-2">
                                    <label  class="text-white">+ cliente</label><br>
                                    <a href="/form_cliente" type="submit" class="btn btn-success col-md-4" title="Agragar cliente">
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
            <h4 class="text-center text-white">Lista de clientes</h4>
        </div><br>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    NIT
                </th>
                <th>
                    Nombre
                </th>
                <th>
                    Dirección
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
                    <div class="row">
                        <div class="col-12">
                            <div class="row ">
                                <div class="col-8">

                                    <a href="{{route('form_edit_cliente',$cliente->id)}}" class="btn btn-info col-8" title="Editar cliente">
                                        <i class="bi-pencil-fill text-white"></i>
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
        {{$clientes->links()}}

    </div>
@endsection
