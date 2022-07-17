<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proveedore extends Model
{
    protected $fillable =['nombre','direccion','tel','estado','tienda_id'];

    /**  relacion de proveedor solo tiene una tienda**/
    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }

    /***  relacion de tienda a muchos usuarios**/
    public function entradas(){
        return $this->hasMany('App\Entrada');
    }

    /***  relacion de tienda a muchos usuarios**/
    public function detalleproveedores(){
        return $this->hasMany('App\Detalleproveedore');
    }
}
