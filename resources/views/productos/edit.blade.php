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
                    <form action="{{route('edit_producto',$producto->id)}}" method="post">
                        @csrf @method('PATCH')
                        <div class="card-header text-center text-white">
                            Regristro producto
                        </div>
                        <div class="card-body">
                            <div class="row form-group">
                                <label for="codigo" class="col-5 text-white">Codigo de barras</label>
                                <input type="number" name="codigo" value="{{$producto->codigo}}"  placeholder="0"  min="0">
                            </div>

                            <div class="row form-group">
                                <label for="nombre" class="col-5 text-white">Nombre del producto</label>
                                <input type="text" name="nombre" value="{{$producto->nombre}}" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="precio" class="col-5 text-white">Precio</label>
                                <input type="number" name="precio"  value="{{$producto->precio}}" placeholder="0.00"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" class="form-control col-md-7">
                            </div>
                            <div class="row form-group">
                                <label for="precioventa" class="col-5 text-white">Precio de venta</label>
                                <input type="number" name="precioventa"  placeholder="0.00"  value="{{$producto->precioventa}}" min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="descuento" class="col-5 text-white">Descuento</label>
                                <input type="number" name="descuento"  placeholder="0.00"  value="{{$producto->descuento}}" min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="descripcion" class="col-5 text-white">Descripción</label>
                                <textarea class="form-control" name="descripcion"  rows="3">{{$producto->descripcion}}</textarea>
                            </div>

                            <div class="row form-group">
                                <label for="marca" class="col-5 text-white">Marca</label>
                                <input type="text" name="marca"  value="{{$producto->marca}}" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="stock" class="col-5 text-white">Stock</label>
                                <input type="number" name="stock"  value="{{$producto->stock}}" placeholder="0"  min="0">
                            </div>

                            <div class="row form-group">
                                <label for="medida_id" class="col-5 text-white">Unidad de medida</label>
                                <select class="form-control col-md-7" name="medida_id">
                                    <option value="{{$producto->medida_id}}" selected>{{$producto->medida->medida}}</option>
                                    @foreach($medidas as $medida)
                                        <option value="{{$medida->id}}">{{$medida->medida}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="row form-group">
                                <label for="categoria_id" class="col-5 text-white">Categoría</label>
                                <select class="form-control col-md-7" name="categoria_id">
                                    <option value="{{$producto->categoria_id}}" selected>{{$producto->categoria->categoria}}</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <input type="hidden" name="tienda_id" value="{{session('tienda_id')}}">
                            <input type="hidden" name="usuario_id" value="{{session('usuario_id')}}">

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
