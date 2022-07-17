@extends('layouts.base2')
@section('title', 'categoría')
@section('content')
    <script>
        $(document).ready(function (ev) {
            $('#buscarsubmit').click(function () {
                var buscar=$('#buscar').val();
              $.ajax({
                  url:'{{route('rest.list_categoriabuscar')}}',
                  type:'get',
                  dataType: 'json',
                  data:{
                      buscar: buscar
                  },
                  success:function f(r) {
                      let lista = r;
                      let htmlcode='';
                      $.each(lista, function (key,item) {
                          htmlcode+=' <tr>' +
                              '<td>'+item.id+'</td> ' +
                              '<td>'+item.categoria+'</td> ' +
                              '<td>'+item.estado+'</td> ' +
                              '<td> ' +
                              '<div class="row"> ' +
                              '<div class="col-12"> ' +
                              '<div class="row "> ' +
                              '<div class="col-5"> ' +
                              '<a href="form_edit_categoria/'+item.id+'" class="btn btn-info col-5" title="Editar categoría"> ' +
                              '<i class="bi-pencil-fill text-white"></i> ' +
                              '</a> ' +
                              '</div> ' +
                              '<div class="col-5"> ' +
                              '<a href="form_des_categoria/'+item.id+'"  class="btn btn-danger col-5" title="Deshabilitar categoría"> ' +
                              '<i class="bi-scissors"></i> ' +
                              '</a> ' +
                              '</div> ' +
                              '</div> ' +
                              '</div>' +
                              '</div>' +
                              '</td> ' +
                              '</tr>';

                      });
                      $('#tablare').html(htmlcode);

                  }
              })
          });
        });

    </script>

    <div class="col-md-12 mt-3">

        <div class="card" style="background: linear-gradient(to bottom, #3C3E40  , #07459F );" >
            <h4 class="text-center text-white">Categorías</h4>
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

                                    <div class="row form-group">
                                        <label for="buscar" class="text-white">Nombre de la categoría</label>
                                        <input type="text" placeholder="buscar" name="buscar"  id='buscar' class="form-control col-md-3">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <label  class="text-white">Buscar</label><br>
                                        <button type="submit" id="buscarsubmit" class="btn btn-warning text-white col-md-4" title="Buscar categoria">
                                            <i class="bi-search"></i>
                                        </button>


                                    <a href="{{url('/list_categoria')}}" class="btn btn-info text-white col-md-4" title="todos los registros">
                                        <i class="bi-clipboard-data"></i>
                                    </a>
                                </div>


                            <div class="col-md-2">
                                <label  class="text-white">+ categoría</label><br>
                                <a href="/form_categoria" type="submit" class="btn btn-success col-md-4" title="Agragar categoría">
                                    <i class="bi-arrow-return-right"></i>
                                </a>
                            </div>

                            <div class="col-md-2">
                                <label  class="text-white">+ medidas</label><br>
                                <a  href="list_medidas" type="submit" class="btn btn-success col-md-4" title="Agragar unidades de medida">
                                    <i class="bi-arrow-return-right"></i>
                                </a>
                            </div>

                            <div class="col-md-2">
                                <label  class="text-white">+ producto</label><br>
                                <a  href="list_producto"type="submit" class="btn btn-success col-md-4" title="Agragar productos">
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
            <h4 class="text-center text-white">Categorías</h4>
        </div><br>

        <table class="table table-striped" id="tablacategoria">
            <thead>
            <tr>
                <th>
                    Codigo
                </th>
                <th>
                    Nombre de la categoría
                </th>
                <th>
                    Estado
                </th>

                <th>
                    Acción
                </th>

            </tr>
            </thead>
            <tbody id="tablare">
            @foreach($categorias as $categoria)
             <tr>
                <td>
                    {{$categoria->id}}
                </td>
                <td>
                    {{$categoria->categoria}}
                </td>
                 <td>
                     {{$categoria->estado}}
                 </td>
                <td>
                    <div class="row">
                        <div class="col-12">
                            <div class="row ">
                                <div class="col-5">

                                    <a href="{{route('form_edit_categoria',$categoria->id)}}" class="btn btn-info col-5" title="Editar categoría">
                                        <i class="bi-pencil-fill text-white"></i>
                                    </a>

                                </div>
                                <div class="col-5">
                                    <a href="{{route('form_des_categoria',$categoria->id)}}"  class="btn btn-danger col-5" title="Deshabilitar categoría">
                                        <i class="bi-scissors"></i>
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
        {{$categorias->links()}}
    </div>

@endsection

