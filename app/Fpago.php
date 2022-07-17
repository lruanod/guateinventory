<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fpago extends Model
{
    /**  relacion de fpago solo tiene una tienda**/
    public function tienda(){
        return $this->belongsTo('App\Tienda');
    }
}
