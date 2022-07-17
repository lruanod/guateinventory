@extends('layouts.base2')
@section('title', 'Proveedores')
@section('content')
    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Proveedores</h4>
        </div>

    </div>

            <!-- mesajes de confirmacion -->
            @if(session('exito'))
                <div class="alert alert-success">
                    {{session('exito')}}
                </div>
            @endif
    <!-- mesajes de confirmacion -->
    @if(session('eliminado'))
        <div class="alert alert-success">
            {{session('eliminado')}}
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
                        Proveedores
                    </div>
                    <div class="card-body">
                        <div class="row">

                                <div class="col-md-3">
                                    <form action="{{url('/list_proveedore')}}" method="get">
                                        <div class="row form-group">
                                            <label for="buscar" class="text-white">nombre</label>
                                            <input type="text"  name="buscar" class="form-control col-md-5">
                                        </div>
                                </div>

                                <div class="col-md-2">
                                    <label  class="text-white">Buscar</label><br>
                                        <button type="submit" class="btn btn-warning text-white col-md-4" title="Buscar cliente">
                                            <i class="bi-search"></i>
                                        </button>

                                    </form>
                                    <a href="{{url('/reporteproveedorpdf')}}" onclick="spinner()" class="btn btn-danger text-white col-md-4" title="generar pdf">
                                            <i class="bi-file-earmark-pdf"></i>
                                    </a>
                                </div>
                                <div class="col-md-2"><br>
                                    <a href="{{url('/list_proveedore')}}" class="btn btn-info text-white col-md-4" title="todos los registros">
                                        <i class="bi-clipboard-data"></i>
                                    </a>
                                </div>

                                <div class="col-md-2">
                                    <label  class="text-white">+ Proveedores</label><br>
                                    <a href="/form_proveedore" type="submit" class="btn btn-success col-md-4" title="Agragar proveedor">
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
            <h4 class="text-center text-white">Lista de proveedores</h4>
        </div><br>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>
                    Nombre
                </th>
                <th>
                    Dirección
                </th>
                <th>
                    Tel
                </th>
                <th>
                    Productos
                </th>
                <th>
                    estado
                </th>
                <th>
                    Acción
                </th>

            </tr>
            </thead>
            <tbody>
            @foreach($proveedores as $pro)
             <tr>
                <td>
                    {{$pro->nombre}}
                </td>
                <td>
                    {{$pro->direccion}}
                </td>
                 <td>
                     {{$pro->tel}}
                 </td>
                 <td>
                     @foreach($detalleproveedores as $deta)
                         @if($deta->proveedore_id==$pro->id)
                             <div class="row mt-1">
                                 <div class="col-sm-6">
                              {{$deta->producto->nombre}}
                                 </div>

                             <div class="col-sm-1">
                             <form action="{{route('deletedetalleproveedore',$deta->id)}}" method="post">
                                 @csrf @method('DELETE')
                                 <button type="submit" onclick="return confirm('borrar?');" class="btn btn-danger  text-white" title="desasignar producto">
                                     <i class="bi-scissors"></i>
                                 </button>
                             </form>
                         </div>
                         </div>
                         @endif
                     @endforeach
                 </td>
                 <td>
                     {{$pro->estado}}
                 </td>
                <td>
                    <div class="row mt-1">
                        <div class="col-6">
                            <div class="row mt-1">
                                <div class="col-5 mt-1">

                                    <a href="{{route('form_edit_proveedore',$pro->id)}}" class="btn btn-info " title="Editar Proveedor">
                                        <i class="bi-pencil-fill text-white"></i>
                                    </a>
                                    <a href="{{route('form_productoasig',$pro->id)}}" class="btn btn-success " title="Asignar Producto">
                                        <i class="bi-arrow-return-right text-white"></i>
                                    </a>
                                    <a href="{{route('form_des_proveedore',$pro->id)}}" class="btn btn-warning " title="Deshabilitar proveedor">
                                        <i class="bi-scissors text-white"></i>
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
        {{$proveedores->links()}}

    </div>
@endsection
