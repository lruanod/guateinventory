@extends('layouts.base2')
@section('title', 'editar entrada')
@section('content')
    <div class="col-md-12 mt-3">
        @if(request('pagina')==='proveedor')
            <script type="text/javascript">
                $(document).ready(function (ev) {
                    var obj=document.getElementById('btn-modalpro');
                    obj.click();
                })
            </script>
        @endif

            @if(!empty(session('proveedor_id')))
                <script type="text/javascript">
                    $(document).ready(function (ev) {

                        var proveedorid=document.getElementById('proveedor_id');
                        proveedorid.value="{{session('proveedor_id')}}";

                        var nombre=document.getElementById('proveedor');
                        nombre.value="{{session('nombrep')}}";

                    })
                </script>

            @endif

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Editar entradas</h4>
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
                    <form action="{{route('edit_entrada',$entrada->id)}}" method="post">
                        @csrf @method('PATCH')
                        <div class="card-header text-center text-white">
                            Regristro entrada
                        </div>
                        <div class="card-body">
                                <input type="hidden" name="producto_id" id="producto_id"  value="{{$entrada->producto_id}}" readonly="readonly">
                                <input type="hidden" name="proveedore_id" id="proveedor_id" value="{{$entrada->proveedore_id}}" readonly="readonly">
                                <div class="row form-group">
                                    <label for="codigo" class="col-6  text-white">Codigo de barras / producto</label>
                                    <input type="number"  name="codigo" id="codigo"  value="{{$entrada->producto->codigo}}" class="form-control col-md-7" readonly="readonly">
                                </div>

                                <div class="row form-group">
                                    <label for="nombre" class="col-5 text-white">Nombre del producto</label>
                                    <input type="text" name="nombre" id="nombre" value="{{$entrada->producto->nombre}}" class="form-control col-md-7" readonly="readonly">
                                </div>

                                <div class="row form-group">
                                    <label for="medida" class="col-5 text-white">Medida/unidad</label>
                                    <input type="text" name="medida" id="medida" value="{{$entrada->producto->medida->medida}}" class="form-control col-md-7" readonly="readonly" >
                                </div>

                            <div class="row form-group">
                                <label for="precio" class="col-5 text-white">Precio actual</label>
                                <input type="number" name="precio"  id="precio" placeholder="0.00"  value="{{$entrada->precio}}"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" class="form-control col-md-7" readonly="readonly">
                            </div>

                            <div class="row form-group">
                                <label for="precioventa" class="col-5 text-white">Precio de venta actual</label>
                                <input type="number" name="precioventa"  id="precioventa"   value="{{$entrada->precioventa}}"  placeholder="0.00"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" class="form-control col-md-7" readonly="readonly">
                            </div>

                            <div class="row form-group">
                                <label for="stock" class="col-5 text-white">Stock actual</label>
                                <input type="number" name="stock"  id="stock" placeholder="0"  min="0" value="{{$entrada->stock}}"  class="form-control col-md-7" readonly="readonly">
                            </div>
                            <div class="row">
                                <div class="col-9">
                                    <div class="row form-group">
                                        <label for="medida" class=" text-white">Proveedor</label>
                                        <input type="text" name="proveedor" id="proveedor" value="{{$entrada->proveedore->nombre}}" class="form-control col-md-7" readonly="readonly" >
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label  class="text-white">Buscar</label><br>
                                    <button type="button" class="btn btn-success col-md-5" id="btn-modalpro" data-toggle="modal" data-target="#addproveedor">
                                        <i class="bi-search"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row form-group">
                                <label for="fechaentrada" class="col-5 text-white">Fecha de recepción</label>
                                <input type="date" name="fechaentrada" value="{{$entrada->fechaentrada}}"  class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="precioentrada" class="col-5 text-white">Precio entrada</label>
                                <input type="number" name="precioentrada" value="{{$entrada->precioentrada}}"  placeholder="0.00"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="precioentradaven" class="col-5 text-white">Precio de venta de entrada</label>
                                <input type="number" name="precioentradaven" value="{{$entrada->precioentradaven}}"  placeholder="0.00"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="stockentrada" class="col-5 text-white">Stock entrada</label>
                                <input type="number" name="stockentrada" value="{{$entrada->stockentrada}}" placeholder="0"  min="0"  class="form-control col-md-7">
                            </div>



                            <div class="row form-group">
                                <label for="descripcion" class="col-5 text-white">Descripción</label>
                                <textarea class="form-control" name="descripcion"  rows="3">{{$entrada->descripcion}}</textarea>
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
            <!-- modal addproveedor-->
            <div class="modal fade bd-example-modal-lg" id="addproveedor" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addproveedor">Buscar Proveedor</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true" class="text-danger"><i class="bi-backspace-reverse"></i></span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <br>
                            <div class="form-group">
                                <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #1B92F0 );">
                                    <div class="card-header text-center text-white">
                                        Buscar proveedor
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <form  method="get"  action="form_entrada">
                                                    <div class="row form-group">
                                                        <label for="buscarp" class="text-white">Descripción del proveedor</label>
                                                        <input type="text"  name=" buscarp" class="form-control col-md-4">
                                                    </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label  class="text-white">Buscar</label><br>

                                                <button type="submit"  class="btn btn-success col-md-5" >
                                                    <i class="bi-search"></i>
                                                </button>
                                                </form>
                                                <a href="{{url('/form_entrada')}}" class="btn btn-warning text-white col-md-4" title="todos los registros">
                                                    <i class="bi-clipboard-data"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="row col-md-12  mt-3">
                                <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
                                    <h4 class="text-center text-white">Proveedores</h4>
                                </div><br>

                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>
                                            Proeveedor
                                        </th>
                                        <th>
                                            Dirección
                                        </th>
                                        <th>
                                            Tel
                                        </th>
                                        <th>
                                            Producto que surte
                                        </th>
                                        <th>
                                            Acción
                                        </th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($proveedores as $prove)
                                        <tr>
                                            <td>
                                                {{$prove->nombre}}
                                            </td>
                                            <td>
                                                {{$prove->direccion}}
                                            </td>
                                            <td>
                                                {{$prove->tel}}
                                            </td>
                                            <td>
                                                @foreach($detalleproveedores as $detallepro)
                                                    @if($prove->id==$detallepro->proveedore_id)
                                                        {{$detallepro->producto->nombre}},
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>

                                                <form action="/form_edit_entrada/{{$entrada->id}}" method="get">
                                                    <input type="hidden" name="buscarproveedor" value="{{$prove->id}}">

                                                    <button  type="submit" class="btn btn-danger col-md-8" title="Agregar">
                                                        <i class="bi-arrow-return-right"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                {{$proveedores->appends(['pagina'=>'proveedor'])->links()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- modal addproducto-->
        </div>
@endsection
