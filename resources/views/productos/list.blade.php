@extends('layouts.base2')
@section('title', 'categoría')
@section('content')
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Productos</h4>
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
                        Categorías
                    </div>
                    <div class="card-body">
                        <div class="row">

                                <div class="col-md-3">
                                    <form action="{{url('/list_producto')}}" method="get">
                                    <div class="row form-group">
                                        <label for="buscar" class="text-white">Descripción del producto</label>
                                        <input type="text" placeholder="buscar" name="buscar" class="form-control col-md-3">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label  class="text-white">Buscar</label><br>
                                        <button type="submit" class="btn btn-warning text-white col-md-4" title="Buscar producto">
                                            <i class="bi-search"></i>
                                        </button>

                                    </form>
                                    <a href="{{url('/list_producto')}}" class="btn btn-info text-white col-md-4" title="todos los registros">
                                        <i class="bi-clipboard-data"></i>
                                    </a>
                                </div>


                            <div class="col-md-2">
                                <label  class="text-white">+ prducto</label><br>
                                <a href="/form_producto" type="submit" class="btn btn-success col-md-4" title="Agragar producto">
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
                                <label  class="text-white">+ medidas</label><br>
                                <a  href="list_medida" type="submit" class="btn btn-success col-md-4" title="Agragar unidades de medida">
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
            <h4 class="text-center text-white">Productos</h4>
        </div><br>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    codigo
                </th>
                <th>
                    producto
                </th>
                <th>
                    descripción
                </th>
                <th>
                    precio compra
                </th>
                <th>
                    precio venta
                </th>
                <th>
                    descuento
                </th>
                <th>
                    marca
                </th>
                <th>
                    stock
                </th>
                <th>
                    estado
                </th>

                <th>
                    acción
                </th>

            </tr>
            </thead>
            <tbody>
            @foreach($productos as $producto)
             <tr>
                <td>
                    {{$producto->codigo}}
                </td>
                <td>
                    {{$producto->nombre}}
                </td>
                 <td>
                     {{$producto->descripcion}}, Categoría:
                     {{$producto->categoria->categoria}},
                     Medida: {{$producto->medida->medida}}
                 </td>
                 <td>
                     {{$producto->precio}}
                 </td>
                 <td>
                     {{$producto->precioventa}}
                 </td>
                 <td>
                     {{$producto->descuento}}
                 </td>
                 <td>
                     {{$producto->marca}}
                 </td>
                 <td>
                     {{$producto->stock}}
                 </td>
                 <td>
                     {{$producto->estado}}
                 </td>
                <td>
                    <div class="row">
                        <div class="col-12">
                            <div class="row ">
                                <div class="col-10">

                                    <a href="{{route('form_edit_producto',$producto->id)}}" class="btn btn-info col-8" title="Editar producto">
                                        <i class="bi-pencil-fill text-white"></i>
                                    </a>

                                </div>
                                <div class="col-10">
                                    <a href="{{route('form_des_producto',$producto->id)}}"  class="btn btn-danger col-8" title="Deshabilitar producto">
                                        <i class="bi-scissors text-white"></i>
                                    </a>
                                </div>
                                <div class="col-10">
                                    <a href="{{route('form_descuento_producto',$producto->id)}}"  class="btn btn-warning col-8" title="Aplicar descuento">
                                        <i class="bi-percent text-white"></i>
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
        {{$productos->links()}}

    </div>
@endsection
