<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $fillable =['nombre','direccion','nit','usuario_id','tienda_id'];

    /**  relacion de cliente solo tiene una tienda**/
    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }

    /***  relacion de cliente solo tiene una usuario**/
    public function usario(){
        return $this->belongsTo('App\Usuario');
    }
}
