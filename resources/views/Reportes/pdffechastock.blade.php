<!doctype html>
<html lang="es">
<head>
    <title>Reporte stock producto</title>
    <!-- Bootstrap core CSS
         -->
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">

</head>
<body>
<div id="contenedor_carga"><div id="carga"></div></div>
<div class="row">
     <div class="col-12">

         <table class="table table-bordered">
             <thead  class="thead-primary">
             <tr>
                 <th>
                      Cadigo de barras
                 </th>
                 <th>
                      Nombre
                 </th>
                 <th>
                      Medida
                 </th>
                 <th>
                      categoria
                 </th>
                 <th>
                     Marca
                 </th>
                 <th>
                     Descripción
                 </th>
                 <th>
                     Precio compra
                 </th>
                 <th>
                     Precio venta
                 </th>
                 <th>
                     Descuento
                 </th>
                 <th>
                     Stock actual
                 </th>
             </tr>
             </thead>
             <tbody>
             @foreach($productos as $pro)
                         <tr>
                             <td>
                                {{$pro->codigo}}
                             </td>
                             <td>
                                 {{$pro->nombre}}
                             </td>
                             <td>
                                 {{$pro->medida->medida}}
                             </td>
                             <td>
                                 {{$pro->categoria->categoria}}
                             </td>
                             <td>
                                 {{$pro->marca}}
                             </td>
                             <td>
                                 {{$pro->descripcion}}
                             </td>
                             <td>
                                 {{number_format($pro->precio,2)}}
                             </td>
                             <td>
                                 {{number_format($pro->precioventa,2)}}
                             </td>
                             <td>
                                 {{number_format($pro->descuento,2)}}
                             </td>
                             <td>
                                 {{$pro->stock}}
                             </td>

                         </tr>
             @endforeach
                 </tbody>
         </table>


             <table class="table table-bordered">
                 <thead  class="thead-primary">
                 <tr>
                     <th>
                     </th>
                     <th>
                     </th>
                     <th>
                     </th>
                     <th>
                     </th>
                     <th>
                     </th>
                     <th>
                     </th>
                     <th>
                     </th>
                     <th>
                     </th>
                     <th>
                     </th>

                 </tr>
                 </thead>
                 <tbody>
                 <tr>
                     <td>
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
                     </td>
                     <td>
                     </td>
                     <td>
                         Total mercaderia precio compra
                     </td>
                     <td>
                         Q.{{number_format($preciocompra,2)}}
                     </td>
                 </tr>
                 <tr>
                     <td>
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
                     </td>
                     <td>
                     </td>
                     <td>
                         Total mercaderia precio venta
                     </td>
                     <td>
                         Q.{{number_format($precioventa,2)}}
                     </td>
                 </tr>
                 <tr>
                     <td>
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
                     </td>
                     <td>
                     </td>
                     <td>
                         Stock actual
                     </td>
                     <td>
                         {{$stock}}
                     </td>
                 </tr>
                 </tbody>
             </table>

     </div>
</div>
</body>

</html>
