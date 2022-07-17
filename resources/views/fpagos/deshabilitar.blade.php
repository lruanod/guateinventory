@extends('layouts.base2')
@section('title', 'fpago')
@section('content')
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Deshabilitar Forma de pago</h4>
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
                    <form action="{{route('des_fpago',$fpago->id)}}"method="post">
                        @csrf @method('PATCH')
                        <div class="card-header text-center text-white">
                            Regristro de formas de pago
                        </div>
                        <div class="card-body">

                            <div class="row form-group">
                                <label for="formapago" class="col-5 text-white">Forma de pago</label>
                                <input type="text" name="formapago" value="{{$fpago->formapago}}" class="form-control col-md-7" readonly="readonly">
                            </div>

                            <div class="row form-group">
                                <label for="" class="col-6 text-white" >Estado</label>
                                <select class="form-control col-md-6" name="estado">
                                    <option value="">Seleccionar Estado</option>
                                    <option value="Habilitado">Habilitado</option>
                                    <option value="Deshabilitado">Deshabilitado</option>
                                </select>
                            </div>

                            <input type="hidden" name="tienda_id" value="{{session('tienda_id')}}">
                            <br>
                            <div class="row form-group">
                                <button type="submit" class="btn btn-danger col-md-4 ">Modificar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
