@extends('layouts.base2')
@section('title', 'categoría')
@section('content')
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Usuarios</h4>
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
            <div class=" row justify-content-center">
                <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #1B92F0 );">
                    <form action="{{route('edit_usuario',$usuario->id)}}" method="post">
                        @csrf @method('PATCH')
                        <div class="card-header text-center text-white">
                            Regristro usuarios
                        </div>
                        <div class="card-body">
                            <div class="row form-group">
                                <label for="nombre" class="col-5 text-white">Nombre</label>
                                <input type="text" name="nombre" value="{{$usuario->nombre}}" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="usuario" class="col-5 text-white">Usuario</label>
                                <input type="text" name="usuario" value="{{$usuario->usuario}}" class="form-control col-md-7" readonly="readonly">
                            </div>

                            <div class="row form-group">
                                <label for="direccion" class="col-5 text-white">Dirección</label>
                                <input type="text" name="direccion" value="{{$usuario->direccion}}" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="email" class="col-5 text-white">Email</label>
                                <input type="email" name="email"  value="{{$usuario->email}}" class="form-control col-md-7" readonly="readonly" >
                            </div>


                            <div class="row form-group">
                                <label for="rol" class="col-5 text-white">Rol</label>
                                <select class="form-control col-md-7" name="rol">
                                    <option value="{{$usuario->rol}}" selected>{{$usuario->rol}}</option>
                                    <option value="Administrador">Administrador</option>
                                    <option value="Vendedor">Vendedor</option>
                                </select>
                            </div>

                            <div class="row form-group">
                                <label for="cui" class="col-5 text-white">CUI</label>
                                <input type="number" name="cui" value="{{$usuario->cui}}" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="tel" class="col-5 text-white">Tel</label>
                                <input type="text"  placeholder="+502 56271490" name="tel" value="{{$usuario->tel}}" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="pass" class="col-5 text-white">Contraseña</label>
                                <input type="text" name="pass" value="{{$usuario->pass}}" minlength="8" class="form-control col-md-7">
                            </div>

                            <input type="hidden" name="tienda_id" value="{{session('tienda_id')}}">

                            <br>
                            <div class="row form-group">
                                <button type="submit" class="btn btn-danger col-md-6 ">Modificar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
