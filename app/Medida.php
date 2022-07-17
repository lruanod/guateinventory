<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    protected $fillable =['medida','usuario_id','tienda_id', 'estado'];


    /***  relacion de medida solo tiene una tienda**/
    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }

    /***  relacion de medida solo tiene una tienda**/
    public function usario(){
        return $this->belongsTo('App\Usuario');
    }

    /***  relacion de medida a muchos productos**/
    public function  medidas(){
        return $this->hasMany('App\Producto');
    }

}
