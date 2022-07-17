@extends('layouts.base2')
@section('title', 'categoría')
@section('content')
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Clientes</h4>
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
                    <form action="{{route('edit_cliente',$cliente->id)}}" method="post">
                        @csrf @method('PATCH')
                        <div class="card-header text-center text-white">
                            Regristro clientes
                        </div>
                        <div class="card-body">

                            <div class="row form-group">
                                <label for="nombre" class="col-5 text-white">Nombre</label>
                                <input type="text" name="nombre" value="{{$cliente->nombre}}" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="direccion" class="col-5 text-white">Dirección</label>
                                <input type="text" name="direccion"  value="{{$cliente->direccion}}" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="nit" class="col-5 text-white">NIT</label>
                                <input type="text"  pattern="[0-9]+[-]+[0-9]" name="nit" value="{{$cliente->nit}}" class="form-control col-md-7">
                            </div>

                            <input type="hidden" name="tienda_id" value="{{session('tienda_id')}}">
                            <input type="hidden" name="usuario_id" value="{{session('usuario_id')}}">


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
