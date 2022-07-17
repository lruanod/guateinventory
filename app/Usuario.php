<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable =['usuario','nombre','direccion','email','rool','cui','tel','estado','pass','tienda_id'];


    /***  relacion de usuario solo tiene una tienda**/
    public function tienda(){
        return $this->belongsTo('mytienda\Tienda');
    }

    /***  relacion de usuario solo tiene una tienda**/
    public function usuarios(){
        return $this->hasMany('App\Medida','App\Categoria','App\Producto','App\Cliente','App\Entrada');
    }


}
