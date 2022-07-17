<?php

namespace App\Exports;

use App\Producto;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductossinExport implements FromQuery,withHeadings
{
    use Exportable;
    public function headings(): array
    {
        return [
            'Codigo de barras',
            'Producto',
            'Medida',
            'Categoria',
            'Marca',
            'Descripción',
            'Precio de compra',
            'Precio de venta',
            'Descuento',
            'Stock actual',
        ];

    }

    public function __construct( string $tienda_id)
    {
        $this->tienda_id = $tienda_id;
    }
    public function query()
    {

        return Producto::query()->join('categorias','productos.categoria_id','categorias.id')->join('medidas','productos.medida_id','medidas.id')->where('productos.tienda_id','=',$this->tienda_id)->orderBy("productos.created_at", "desc")->select("productos.codigo","productos.nombre","medidas.medida","categorias.categoria","productos.marca","productos.descripcion","productos.precio","productos.precioventa","productos.descuento","productos.stock");;

    }
}
