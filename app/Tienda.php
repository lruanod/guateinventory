<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Tienda extends Model
{
    protected $fillable =['nombre','nit','serie','direccion','tel','estado'];

    /***  relacion de tienda a muchos usuarios**/
    public function tiendas(){
        return $this->hasMany('App\Usuario','App\Categoria','App\Medida','App\Producto','App\Cliente','App\Fpago','App\Entrada');
    }


}
