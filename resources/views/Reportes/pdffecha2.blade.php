<!doctype html>
<html lang="es">
<head>
    <title>Reporte pdf de facturas</title>
    <!-- Bootstrap core CSS
         -->
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<div id="contenedor_carga"><div id="carga"></div></div>
<div class="row">
     <div class="col-12">

         <h5>De {{\carbon\carbon::parse($inicio)->format('d/m/Y')}} a {{\carbon\carbon::parse($final)->format('d/m/Y')}}</h5>

         <table class="table table-bordered">
             <thead  class="thead-primary">
             <tr>
                 <th>
                      No.Factura
                 </th>
                 <th>
                     Categoría
                 </th>
                 <th>
                     Cantidad
                 </th>
                 <th>
                     Producto
                 </th>
                 <th>
                     Precio de compra
                 </th>
                 <th>
                     Precio de venta
                 </th>
                 <th>
                     Sub total
                 </th>
             </tr>
             </thead>
             <tbody>
             @foreach($facturas as $fac)
                 @foreach($detalles as $detalle)
                     @if($detalle->venta_id==$fac->venta_id)
                         <tr>
                             <td>
                                No.{{$fac->numero}} fecha:{{\carbon\carbon::parse($fac->fechafactura)->format('d/m/Y')}}
                             </td>
                             <td>
                                 {{$detalle->producto->categoria->categoria}}
                             </td>
                             <td>
                                 {{$detalle->cantidad}}
                             </td>
                             <td>
                                 {{$detalle->producto->medida->medida}} /{{$detalle->producto->nombre}}/descuento: {{$detalle->descuentodetalle}}
                             </td>
                             <td>
                                 {{number_format($detalle->preciodetalle,2)}}
                             </td>
                             <td>
                                 {{number_format($detalle->preciodetalleven,2)}}
                             </td>
                             <td>
                                 Q.{{number_format($detalle->subtotal,2)}}
                             </td>

                         </tr>
                     @endif
                 @endforeach
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
                         Total de venta
                     </td>
                     <td>
                         Q.{{$total}}
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
                         Total impuesto
                     </td>
                     <td>
                         Q.{{$impuesto}}
                     </td>
                 </tr>
                 </tbody>
             </table>

     </div>
</div>
</body>


</html>
