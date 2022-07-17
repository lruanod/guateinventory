<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    protected $fillable =['cantidad','preciodetalle','preciodetalleventa','subtotal','producto_id','venta_id','tienda_id'];


    /**  relacion de detalle solo tiene una tienda**/
    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }

    /**  relacion de detalle solo tiene una venta**/
    public function venta(){
        return $this->belongsTo('App\Venta');
    }

    /***  relacion de producto solo tiene una usuario**/
    public function producto(){
        return $this->belongsTo('App\Producto');
    }
}
