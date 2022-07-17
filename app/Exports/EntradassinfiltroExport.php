<?php

namespace App\Exports;

use App\Entrada;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EntradassinfiltroExport implements FromQuery,withHeadings
{
    use Exportable;

    public function headings(): array
    {
        return [
            'Fecha',
            'Precio de compra actual de almacen',
            'Stock actual de almacen',
            'Precio de venta actual de almacen',
            'Stock de entrada',
            'Precio de compra de entrada',
            'Precio de venta de entrada',
            'Descripción',
            'Categoría',
            'Producto codigo',
            'Producto nombre',
            'Usuario operador',
            'Proveedor',
        ];

    }



    public function __construct( string $tienda_id,$inicio,$final)
    {
        $this->tienda_id = $tienda_id;
        $this->inicio = $inicio;
        $this->final = $final;
    }
    public function query()
    {
        return Entrada::query()->join('productos','entradas.producto_id','productos.id')->join('usuarios','entradas.usuario_id','usuarios.id')->join('proveedores','entradas.proveedore_id','proveedores.id')->join('categorias','productos.categoria_id','categorias.id')->where('entradas.tienda_id','=',$this->tienda_id)->whereBetween('entradas.fechaentrada',array($this->inicio,$this->final))->orderBy("entradas.created_at", "desc")->select("entradas.fechaentrada","entradas.precio","entradas.stock","entradas.precioentrada","entradas.stockentrada","entradas.precioventa","entradas.precioentradaven","entradas.descripcion","categorias.categoria","productos.codigo","productos.nombre","usuarios.usuario","proveedores.nombre as nombrepro");
    }
}
