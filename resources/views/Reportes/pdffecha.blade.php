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
         @foreach($facturas as $factura)
         <table class="table table-bordered">
             <thead  class="thead-primary">
             <tr>
                 <th>
                     Fecha
                 </th>
                 <th>
                     Autorización
                 </th>
                 <th>
                     Numero
                 </th>
                 <th>
                     Fecha de autorización
                 </th>
                 <th>
                     Forma de pago
                 </th>
                 <th>
                     Cliente
                 </th>
                 <th>
                     Operador
                 </th>
             </tr>
             </thead>
             <tbody>
                 <tr>
                     <td>
                         {{\carbon\carbon::parse($factura->fechafactura)->format('d/m/Y')}}
                     </td>
                     <td>
                         {{$factura->firma}}
                     </td>
                     <td>
                         {{$factura->numero}}
                     </td>
                     <td>
                         {{\carbon\carbon::parse($factura->fautorizacion)->format('d/m/Y H:i:s')}}
                     </td>
                     <td>
                         {{$factura->fpago->formapago}}
                     </td>
                     <td>
                         {{$factura->cliente->nit}}/{{$factura->cliente->nombre}}
                     </td>
                     <td>
                         {{$factura->usuario->usuario}}/{{$factura->usuario->nombre}}
                     </td>
                 </tr>

             </tbody>
         </table>
         <table class="table table-bordered">
             <thead  class="thead-primary">
             <tr>
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
             @foreach($detalles as $detalle)
                 @if($detalle->venta_id==$factura->venta_id)
                 <tr>
                     <td>
                         {{$detalle->cantidad}}
                     </td>
                     <td>
                         {{$detalle->producto->medida->medida}} /{{$detalle->producto->nombre}}/descuento:{{$detalle->descuentodetalle}}
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

                     <tr>
                         <td>
                         </td>
                         <td>
                         </td>
                         <td>
                         </td>
                         <td>
                             Total facturado
                         </td>
                         <td>
                             Q.{{number_format($factura->venta->total,2)}}
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
                             Descuento
                         </td>
                         <td>
                             Q.{{number_format($factura->venta->descuento,2)}}
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
                             Impuesto
                         </td>
                         <td>
                             Q.{{number_format($factura->venta->impuesto,2)}}
                         </td>
                     </tr>
                 </tbody>
         </table>
         @endforeach

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
                         Total descuento
                     </td>
                     <td>
                         Q.{{$descuento}}
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
