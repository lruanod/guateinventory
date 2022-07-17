@extends('layouts.base2')
@section('title', 'categoría')
@section('content')
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Deshabilitar Categorías</h4>
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
                    <form action="{{route('des_categoria',$categoria->id)}}" method="post">
                        @csrf @method('PATCH')
                        <div class="card-header text-center text-white">
                            Regristro categorías
                        </div>
                        <div class="card-body">

                            <div class="row form-group">
                                <label for="" class="col-6 text-white">Nombre de la categoría</label>
                                <input type="text" name="categoria" value="{{$categoria->categoria}}" class="form-control col-md-6" readonly="readonly">
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
