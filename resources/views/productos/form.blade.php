@extends('layouts.base2')
@section('title', 'categoría')
@section('content')
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Productos</h4>
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
                    <form action="{{url('/saveproducto')}}" method="post">
                        @csrf
                        <div class="card-header text-center text-white">
                            Regristro de producto
                        </div>
                        <div class="card-body">
                            <div class="row form-group">
                                <label for="codigo" class="col-5 text-white">Codigo de barras</label>
                                <input type="number" name="codigo"  placeholder="0"  min="0">
                            </div>

                            <div class="row form-group">
                                <label for="nombre" class="col-5 text-white">Nombre del producto</label>
                                <input type="text" name="nombre" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="precio" class="col-5 text-white">Precio</label>
                                <input type="number" name="precio"  placeholder="0.00"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="precioventa" class="col-5 text-white">Precio de venta</label>
                                <input type="number" name="precioventa"  placeholder="0.00"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="descripcion" class="col-5 text-white">Descripción</label>
                                <textarea class="form-control" name="descripcion"  rows="3"></textarea>
                            </div>

                            <div class="row form-group">
                                <label for="marca" class="col-5 text-white">Marca</label>
                                <input type="text" name="marca" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="stock" class="col-5 text-white">Stock</label>
                                <input type="number" name="stock"  placeholder="0"  min="0">
                            </div>

                            <div class="row form-group">
                                <label for="medida_id" class="col-5 text-white">Unidad de medida</label>
                                <select class="form-control col-md-7" name="medida_id">
                                    <option value="">Seleccionar medida</option>
                                    @foreach($medidas as $medida)
                                    <option value="{{$medida->id}}">{{$medida->medida}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row form-group">
                                <label for="categoria_id" class="col-5 text-white">Categoría</label>
                                <select class="form-control col-md-7" name="categoria_id">
                                    <option value="">Seleccionar categoría</option>
                                    @foreach($categorias as $categoria)

                                        <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                                    @endforeach


                                </select>
                            </div>

                            <input type="hidden" name="tienda_id" value="{{session('tienda_id')}}">
                            <input type="hidden" name="usuario_id" value="{{session('usuario_id')}}">
                            <input type="hidden" name="estado" value="Habilitado">
                            <input type="hidden" name="descuento" value="0.00">
                            <br>
                            <div class="row form-group">
                                <button type="submit" class="btn btn-danger col-md-4 ">Registrar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
