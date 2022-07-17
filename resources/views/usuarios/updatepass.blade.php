@extends('layouts.base2')
@section('title', 'usuario')
@section('content')
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Cambio de contraseña</h4>
        </div>

    </div>
        <div class="col-md-6 mt-3">
            <!-- mesajes de confirmacion -->
            @if(session('exito'))
                <div class="alert alert-success">
                    {{session('exito')}}
                </div>
            @endif

        <!-- mesajes de confirmacion -->
            @if(session('exito2'))
                <div class="alert alert-danger">
                    {{session('exito2')}}
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
                    <form action="{{url('/updatepass')}}" method="post">
                        @csrf
                        <div class="card-header text-center text-white">
                            Cambiar contraseña
                        </div>
                        <div class="card-body">

                            <div class="row form-group">
                                <label for="pass" class="col-5 text-white">Actual contraseña</label>
                                <input type="password" name="actual" class="form-control col-md-7">
                            </div>
                            <div class="row form-group">
                                <label for="pass" class="col-5 text-white">Nueva contraseña</label>
                                <input type="password" name="nueva" class="form-control col-md-7">
                            </div>

                            <input type="hidden" name="tienda_id" value="{{session('tienda_id')}}">
                            <input type="hidden" name="usuario_id" value="{{session('usuario_id')}}">

                            <br>
                            <div class="row form-group">
                                <button type="submit" class="btn btn-danger col-md-6 ">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
