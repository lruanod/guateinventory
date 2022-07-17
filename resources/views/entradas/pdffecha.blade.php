<!doctype html>
<html lang="es">
<head>
    <title>Reporte pdf de entradas</title>
    <!-- Bootstrap core CSS
         -->
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="row">
     <div class="col-12">
         <h5>De {{\carbon\carbon::parse($inicio)->format('d/m/Y')}} a {{\carbon\carbon::parse($final)->format('d/m/Y')}}</h5>
         <table class="table table-bordered">
             <thead  class="thead-primary">
             <tr>
                 <th>
                     Fecha
                 </th>
                 <th>
                     Producto
                 </th>
                 <th>
                     Categoría
                 </th>
                 <th>
                     Precio compra
                 </th>
                 <th>
                     Precio venta
                 </th>
                 <th>
                     Stock en almacen
                 </th>
                 <th>
                     Precio compra de entrada
                 </th>
                 <th>
                     Precio venta de entrada
                 </th>
                 <th>
                     Stock de entrada
                 </th>
                 <th>
                     Descripción
                 </th>
                 <th>
                     Proveedor
                 </th>
                 <th>
                     Operador
                 </th>
             </tr>
             </thead>

             @foreach($entradas as $entrada)
                 <tr>
                     <td>
                         {{\carbon\carbon::parse($entrada->fechaentrada)->format('d/m/Y')}}
                     </td>
                     <td>
                         {{$entrada->producto->nombre}}/{{$entrada->producto->medida->medida}}
                     </td>
                     <td>
                         {{$entrada->producto->categoria->categoria}}
                     </td>
                     <td>
                         {{number_format($entrada->precio,2)}}
                     </td>
                     <td>
                         {{number_format($entrada->precioventa,2)}}
                     </td>
                     <td>
                         {{$entrada->stock}}
                     </td>
                     <td>
                         {{number_format($entrada->precioentrada,2)}}
                     </td>
                     <td>
                         {{number_format($entrada->precioentradaven,2)}}
                     </td>
                     <td>
                         {{$entrada->stockentrada}}
                     </td>
                     <td>
                         {{$entrada->descripcion}}
                     </td>
                     <td>
                         {{$entrada->proveedore->nombre}}
                     </td>
                     <td>
                         {{$entrada->usuario->usuario}}/{{$entrada->usuario->nombre}}
                     </td>
                 </tr>
         @endforeach
                 <tr>
                    <td>
                    </td>
                     <td>
                     </td>
                     <td>
                         Totales con precio de
                         entrada actual->
                     </td>
                     <td>
                         compra:{{number_format($totalprecioentrada,2)}}

                     </td>
                     <td>
                         venta:{{number_format($totalprecioentradaven,2)}}
                     </td>
                     </td>
                     <td>
                     </td>
                     <td>
                     </td>
                     <td>
                     </td>
                     <td>
                     </td>
                     <td>
                 </tr>
             </tbody>
         </table>
     </div>
</div>
</body>

</html>
