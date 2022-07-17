<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cohensive\Embed\Facades\Embed;

class Producto extends Model
{
    protected $fillable =['codigo','nombre','precio','precioventa','descripcion','marca','stock','estado','medida_id','categoria_id','usuario_id','tienda_id','descuento'];

    /***  relacion de producto solo tiene una categoria**/
    public function categoria(){
        return $this->belongsTo('App\Categoria');
    }

    /***  relacion de producto solo tiene una medida**/
    public function medida(){
        return $this->belongsTo('App\Medida');
    }

    /**  relacion de producto solo tiene una tienda**/
    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }

    /***  relacion de producto solo tiene una usuario**/
    public function usuario(){
        return $this->belongsTo('App\Usuario');
    }

    /***  relacion de tienda a muchos usuarios**/
    public function entradas(){
        return $this->hasMany('App\Entrada');
    }
    /***  relacion de tienda a muchos usuarios**/
    public function detalleproveedores(){
        return $this->hasMany('App\Detelleproveedore');
    }
}
