@extends('layouts.base2')
@section('title', 'entradas')
@section('content')






  @if(request('pagina')==='producto')
      <script type="text/javascript">
          $(document).ready(function (ev) {
              var obj=document.getElementById('btn-modal');
              obj.click();
          })
      </script>
  @endif

  @if(request('pagina')==='proveedor')
      <script type="text/javascript">
          $(document).ready(function (ev) {
              var obj=document.getElementById('btn-modalpro');
              obj.click();
          })
      </script>
  @endif

  @if(!empty(session('producto_id')))
  <script type="text/javascript">
      $(document).ready(function (ev) {

              var productoid=document.getElementById('producto_id');
              productoid.value="{{session('producto_id')}}";

              var precio=document.getElementById('precio');
              precio.value="{{session('precio')}}";

              var stock=document.getElementById('stock');
              stock.value="{{session('stock')}}";

              var nombre=document.getElementById('nombre');
              nombre.value="{{session('nombre')}}";

              var medida=document.getElementById('medida');
              medida.value="{{session('medida')}}";

              var codigo=document.getElementById('codigo');
              codigo.value="{{session('codigo')}}";

              var precioventa=document.getElementById('precioventa');
              precioventa.value="{{session('precioventa')}}";

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


    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Entradas</h4>
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
                    <form action="{{url('/saveentrada')}}" method="post">
                        @csrf
                        <div class="card-header text-center text-white">
                            Regristro de entradas
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <input type="hidden" name="producto_id" id="producto_id" readonly="readonly">
                                <input type="hidden" name="proveedore_id" id="proveedor_id" readonly="readonly">
                                <div class="col-9">
                                    <div class="row form-group">
                                        <label for="codigo" class="text-white">Codigo de barras / producto</label>
                                        <input type="number"  name="codigo" id="codigo"  class="form-control col-md-7" readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label  class="text-white">Buscar</label><br>
                                    <form action="/" method="post">
                                        <button type="button" class="btn btn-success col-md-5" id="btn-modal" data-toggle="modal" data-target="#addproducto">
                                            <i class="bi-search"></i>
                                        </button>
                                    </form>
                                </div>

                                <div class="row form-group">
                                    <label for="nombre" class="col-5 text-white">Nombre del producto</label>
                                    <input type="text" name="nombre" id="nombre" class="form-control col-md-7" readonly="readonly">
                                </div>

                                <div class="row form-group">
                                    <label for="medida" class="col-5 text-white">Medida/unidad</label>
                                    <input type="text" name="medida" id="medida" class="form-control col-md-7" readonly="readonly" >
                                </div>
                            </div>
                            <div class="row form-group">
                                <label for="precio" class="col-5 text-white">Precio de compra actual</label>
                                <input type="number" name="precio"  id="precio" placeholder="0.00"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" class="form-control col-md-7" readonly="readonly">
                            </div>

                            <div class="row form-group">
                                <label for="precioventa" class="col-5 text-white">Precio de venta actual</label>
                                <input type="number" name="precioventa"  id="precioventa" placeholder="0.00"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" class="form-control col-md-7" readonly="readonly">
                            </div>

                            <div class="row form-group">
                                <label for="stock" class="col-5 text-white">Stock actual</label>
                                <input type="number" name="stock"  id="stock" placeholder="0"  min="0"  class="form-control col-md-7" readonly="readonly">
                            </div>

                            <div class="row">
                                <div class="col-9">
                                    <div class="row form-group">
                                        <label for="medida" class=" text-white">Proveedor</label>
                                        <input type="text" name="proveedor" id="proveedor" class="form-control col-md-7" readonly="readonly" >
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
                                <input type="date" name="fechaentrada" class="form-control col-md-7" required="required">
                            </div>

                            <div class="row form-group">
                                <label for="precioentrada" class="col-5 text-white">Precio entrada</label>
                                <input type="number" name="precioentrada"  placeholder="0.00"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="precioentradaven" class="col-5 text-white">Precio de venta de entrada</label>
                                <input type="number" name="precioentradaven"  placeholder="0.00"  min="0" step="0.01" pattern="^\d+(?:\.\d{1,2})?$" onblur="this.parentNode.parentNode.style.backgroundColor=/^\d+(?:\.\d{1,2})?$/.test(this.value)?inherit':'red'" class="form-control col-md-7">
                            </div>

                            <div class="row form-group">
                                <label for="stockentrada" class="col-5 text-white">Stock entrada</label>
                                <input type="number" name="stockentrada"  placeholder="0"  min="0"  class="form-control col-md-7">
                            </div>


                                <div class="row form-group">
                                    <label for="descripcion" class="col-5 text-white">Descripción</label>
                                    <textarea class="form-control" name="descripcion"  rows="3"></textarea>
                                </div>


                            <input type="hidden" name="tienda_id" value="{{session('tienda_id')}}">
                            <input type="hidden" name="usuario_id" value="{{session('usuario_id')}}">
                            <br>
                            <div class="row form-group">
                                <button type="submit" class="btn btn-danger col-md-4 ">Registrar</button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- modal addproducto-->
                <div class="modal fade bd-example-modal-lg" id="addproducto" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addproducto">Buscar producto</h5>
                                <!-- mesajes de confirmacion -->
                                @if(session('exito'))
                                    <div class="alert alert-success">
                                        {{session('exito')}}
                                    </div>
                                @endif
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true" class="text-danger"><i class="bi-backspace-reverse"></i></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <br>
                                <div class="form-group">
                                    <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #1B92F0 );">
                                        <div class="card-header text-center text-white">
                                            Buscar producto
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <form  method="get"  action="form_entrada">
                                                    <div class="row form-group">
                                                        <label for="buscar" class="text-white">Descripción del producto</label>
                                                        <input type="text"  name=" buscar" class="form-control col-md-4">
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
                                        <h4 class="text-center text-white">Productos</h4>
                                    </div><br>

                                    <table class="table table-striped table-responsive">
                                        <thead>
                                        <tr>
                                            <th>
                                                Codigo
                                            </th>
                                            <th>
                                                Producto
                                            </th>
                                            <th>
                                                Precio compra
                                            </th>
                                            <th>
                                                Precio venta
                                            </th>
                                            <th>
                                                Acción
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
                                                {{$producto->nombre}} / {{$producto->medida->medida}}
                                            </td>
                                            <td>
                                                {{$producto->precio}}
                                            </td>
                                            <td>
                                                {{$producto->precioventa}}
                                            </td>
                                            <td>

                                                <form action="form_entrada" method="get">
                                                    <input type="hidden" name="buscarproducto" value="{{$producto->id}}">

                                                    <button  type="submit" class="btn btn-danger col-md-8" title="Agregar">
                                                        <i class="bi-arrow-return-right"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                        @endforeach

                                        </tbody>
                                    </table>
                                    {{$productos->appends(['pagina'=>'producto'])->links()}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- modal addproducto-->


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

                                                    <form action="form_entrada" method="get">
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
        </div>

@endsection








