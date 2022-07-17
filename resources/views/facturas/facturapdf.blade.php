<!doctype html>
<html lang="es">
<head>
    <title>Factura en pdf</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/dist/css/bootstrap.min.css') }}" rel="stylesheet">
</head>
<body>
<div class="row">
     <div class="col-3">
@foreach($facturas as $fac)
    <h5>{{$fac->tienda->nombre}}</h5>
    <h5>{{$fac->tienda->nit}}</h5>
    <h5>{{$fac->tienda->direccion}}</h5>
    <h5>{{$fac->tienda->tel}}</h5>
    <h5 class="text-center">DOCUMENTO TRIBUTARIO ELECTRONICO</h5>
    <h5 class="text-center">FACTURA</h5>
    <h5 class="text-center">AUTORIZACIÓN:{{$fac->firma}}</h5>
    <h5 class="text-center">SERIE:{{$fac->tienda->serie}}</h5>
    <h5 class="text-center">NUMERO:{{$fac->numero}}</h5>
    <h5 class="text-center">FECHA HORA CERTIFICACIÓN:{{\carbon\carbon::parse($fac->fautorizacion)->format('d/m/Y, H:i:s')}}</h5>
    <h5>ATENDIDO: {{$fac->usuario->usuario}}/{{$fac->usuario->nombre}}</h5>
    <h5>FECHA: {{\carbon\carbon::parse($fac->fechafactura)->format('d/m/Y')}}</h5>
    <h5>NIT: {{$fac->cliente->nit}}</h5>
    <h5>NOMBRE: {{$fac->cliente->nombre}}</h5>
    <h5>DIRECCIÓN: {{$fac->cliente->direccion}}</h5>
         <br>
    <table>
        <tbody>
    @foreach($detalles as $detalle)
        <tr>
            <td>
               <h5> &nbsp;{{$detalle->cantidad}}&nbsp;&nbsp;{{$detalle->producto->nombre}}&nbsp;{{$detalle->producto->medida->medida}}&nbsp;&nbsp;&nbsp;Q.{{number_format($detalle->preciodetalleven,2)}}&nbsp; descuento:Q.{{number_format($detalle->descuentodetalle,2)}}&nbsp; </h5>
            </td>
            <td>
                <h5>Q.{{number_format($detalle->subtotal,2)}}</h5>
            </td>
        </tr>
    @endforeach
        <tr>
            <td>
                &nbsp;
            </td>
            <td>
                &nbsp;
            </td>
        </tr>
        <tr>
            <td>
                <h5>Descuentos</h5>
            </td>
            <td>
                <h5>Q.{{number_format($fac->venta->descuento,2)}}</h5>
            </td>

        </tr>
        <tr>
            <td>
                <h5>Total</h5>
            </td>
            <td>
                <h5>Q.{{number_format($fac->venta->total,2)}}</h5>
            </td>
        </tr>
        <tr>
            <td>
                <h5>Impuesto</h5>
            </td>
            <td>
                <h5>Q.{{number_format($fac->venta->impuesto,2)}}</h5>
            </td>
        </tr>

    <tr>
        <td>
            <h5>Efectivo</h5>
        </td>
        <td>
            <h5>Q.{{number_format($fac->venta->efectivo,2)}}</h5>
        </td>
    </tr>

    <tr>
        <td>
            <h5>Cambio</h5>
        </td>
        <td>
            <h5>Q.{{number_format($fac->venta->cambio,2)}}</h5>
        </td>
    </tr>

        </tbody>
    </table>
    <br>

    <h5 class="text-center">Gracias por su compra {{$fac->cliente->nombre}}</h5>


@endforeach

     </div>
</div>
</body>

</html>
