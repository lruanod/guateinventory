<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    protected $fillable =['fachafactura','firma','fpago_id','cliente_id','venta_id','usuario_id','tienda_id','numero','fautorizacion'];

    /**  relacion de factura solo tiene una tienda**/
    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }

    /**  relacion de factura solo tiene una tienda**/
    public function usuario(){
        return $this->belongsTo('App\Usuario');
    }

    /**  relacion de factura solo tiene una venta**/
    public function venta(){
        return $this->belongsTo('App\Venta');
    }

    /**  relacion de factura solo tiene una cliente**/
    public function cliente(){
        return $this->belongsTo('App\Cliente');
    }

    /**  relacion de factura solo tiene una fpago**/
    public function fpago(){
        return $this->belongsTo('App\Fpago');
    }

}
