<?php

namespace App\Exports;

use App\Detalle;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DetallescategoriaExport implements FromQuery,withHeadings
{
    use Exportable;

    public function headings(): array
    {
        return [
            'Fecha',
            'No.factura',
            'Categoria',
            'Codigo barras',
            'Producto',
            'Precio de compra ',
            'Precio de venta ',
            'Descuento',
            'Cantidad',
            'Subtotal',
            'Cliente',
            'NIT',
            'Forma de pago',
            'Usuario operador',
        ];

    }



    public function __construct( string $id ,$tienda_id,$inicio,$final)
    {
        $this->id = $id;
        $this->tienda_id = $tienda_id;
        $this->inicio = $inicio;
        $this->final = $final;
    }
    public function query()
    {
        return Detalle::query()->join('productos','detalles.producto_id','productos.id')->join('ventas','detalles.venta_id','ventas.id')->join('categorias','productos.categoria_id','categorias.id')->join('facturas','ventas.id','facturas.venta_id')->join('clientes','facturas.cliente_id','clientes.id')->join('usuarios','facturas.usuario_id','usuarios.id')->join('fpagos','facturas.fpago_id','fpagos.id')->where('detalles.tienda_id','=',$this->tienda_id)->where('categorias.id','=',$this->id)->whereBetween('ventas.fechaventa',array($this->inicio,$this->final))->orderBy("detalles.created_at", "desc")->select("facturas.fechafactura","facturas.numero","categorias.categoria","productos.codigo","productos.nombre","detalles.preciodetalle","detalles.preciodetalleven","detalles.descuentodetalle","detalles.cantidad","detalles.subtotal","clientes.nombre as cliente","clientes.nit","fpagos.formapago","usuarios.usuario");
    }
}
