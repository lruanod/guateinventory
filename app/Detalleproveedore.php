<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalleproveedore extends Model
{
    protected $fillable =['producto_id','proveedore_id','tienda_id'];

    /**  relacion de detalleproveedore solo tiene una tienda**/
    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }

    /**  relacion de detalleproveedore solo tiene un proveedore**/
    public function proveedore(){
        return $this->belongsTo('App\Proveedore');
    }

    /**  relacion de detalleproveedore solo tiene un producto**/
    public function producto(){
        return $this->belongsTo('App\Producto');
    }
}
