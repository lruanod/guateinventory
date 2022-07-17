<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
    protected $fillable =['fechaentrada','precio','precioventa','stock','precioentrda','precioentradaven','stockentrada','descripcion','producto_id','usuario_id','tienda_id','proveedore_id'];

    /***  relacion de producto solo tiene una usuario**/
    public function producto(){
        return $this->belongsTo('App\Producto');
    }

    /**  relacion de producto solo tiene una tienda**/
    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }

    /***  relacion de producto solo tiene una usuario**/
    public function usuario(){
        return $this->belongsTo('App\Usuario');
    }
    /**  relacion de entrada solo tiene un proveedore**/
    public function proveedore(){
        return $this->belongsTo('App\Proveedore');
    }
}
