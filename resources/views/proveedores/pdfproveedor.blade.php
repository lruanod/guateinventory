<!doctype html>
<html lang="es">
<head>
    <title>Reporte de proveedores</title>
    <!-- Bootstrap core CSS
         -->
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<body>
<div class="row">
     <div class="col-12">

         <table class="table table-bordered">
             <thead  class="thead-primary">
             <tr>
                 <th>
                      Proveedor
                 </th>
                 <th>
                      Direccion
                 </th>
                 <th>
                      Tel
                 </th>
                 <th>
                      Estado
                 </th>
                 <th>
                     Producto
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
                                 {{$pro->estado}}
                             </td>
                             <td>
                                 @foreach($detalleproveedores as $deta)
                                     @if($deta->proveedore_id==$pro->id)
                                         {{$deta->producto->nombre}}/Codigo:{{$deta->producto->codigo}}/Marca:{{$deta->producto->marca}}<br>
                                     @endif
                                 @endforeach
                             </td>

                         </tr>
             @endforeach
                 </tbody>
         </table>
     </div>
</div>
</body>

</html>
