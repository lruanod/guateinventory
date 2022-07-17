<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{

    protected $fillable =['fechaventa','impuesto','descuento','total','usuario_id','tienda_id','efectivo','cambio'];

    /**  relacion de venta solo tiene una tienda**/
    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }

    /***  relacion de venta solo tiene una usuario**/
    public function usario(){
        return $this->belongsTo('App\Usuario');
    }

    /***  relacion de venta solo tiene muhos **/
    public function ventas(){
        return $this->hasMany('App\Detalle','App\Factura');
    }

}
