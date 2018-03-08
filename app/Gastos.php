<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    protected $table      = "gastos";
    
    protected $primaryKey = "id_gastos";
    
    protected $fillable   = ['ga_concepto',                          
                             'ga_status'];

    public function viajes(){
        return $this->hasMany('pegaza\Viaje','viaje_id');
    }
}
