<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable =['categoria','estado','usuario_id','tienda_id'];


    /***  relacion de categoria solo tiene una tienda**/
    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }

    /***  relacion de categoria solo tiene una tienda**/
    public function usario(){
        return $this->belongsTo('App\Usuario');
    }

    /***  relacion de categoria a muchos productos**/
    public function categorias(){

        return $this->hasMany('App\Producto');
    }

}
