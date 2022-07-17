@extends('layouts.base2')
@section('title', 'categoría')
@section('content')
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Usuarios</h4>
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
                        Usuarios
                    </div>
                    <div class="card-body">
                        <div class="row">

                                <div class="col-md-3">
                                    <form action="{{url('/list_usuario')}}" method="get">
                                    <div class="row form-group">
                                        <label for="buscar" class="text-white">Nombre del usuario/nit/cui</label>
                                        <input type="text" placeholder="buscar" name="buscar" class="form-control col-md-3">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label  class="text-white">Buscar</label><br>
                                        <button type="submit" class="btn btn-warning text-white col-md-4" title="Buscar usuario">
                                            <i class="bi-search"></i>
                                        </button>

                                    </form>
                                    <a href="{{url('/list_usuario')}}" class="btn btn-info text-white col-md-4" title="todos los registros">
                                        <i class="bi-clipboard-data"></i>
                                    </a>
                                </div>


                            <div class="col-md-2">
                                <label  class="text-white">+ usuarios</label><br>
                                <a  href="/form_usuario"type="submit" class="btn btn-success col-md-4" title="Agragar usuario">
                                    <i class="bi-arrow-return-right"></i>
                                </a>
                            </div>


                            <div class="col-md-2">
                                <label  class="text-white">+ cliente</label><br>
                                <a href="/list_cliente" type="submit" class="btn btn-success col-md-4" title="Agragar cliente">
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
            <h4 class="text-center text-white">Lista de usuarios</h4>
        </div><br>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    CUI
                </th>
                <th>
                    Nombre
                </th>
                <th>
                    Dirección
                </th>
                <th>
                    Rol
                </th>
                <th>
                    Tel
                </th>
                <th>
                    Usuario
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
            @foreach($usuarios as $usuario)
             <tr>
                <td>
                    {{$usuario->cui}}
                </td>
                <td>
                    {{$usuario->nombre}}
                </td>
                 <td>
                     {{$usuario->direccion}}
                 </td>
                 <td>
                     {{$usuario->rol}}
                 </td>
                 <td>
                     {{$usuario->tel}}
                 </td>
                 <td>
                     {{$usuario->usuario}}
                 </td>
                 <td>
                     {{$usuario->estado}}
                 </td>
                <td>
                    <div class="row">
                        <div class="col-12">
                            <div class="row ">
                                <div class="col-8">

                                    <a href="{{route('form_edit_usuario',$usuario->id)}}" class="btn btn-info col-8" title="Editar usuario">
                                        <i class="bi-pencil-fill text-white"></i>
                                    </a>

                                </div>
                                <div class="col-8">
                                    <a href="{{route('form_des_usuario',$usuario->id)}}"  class="btn btn-danger col-8" title="Deshabilitar usuario">
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
        {{$usuarios->links()}}

    </div>
@endsection
