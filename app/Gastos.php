<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Gastos extends Model
{
    protected $table      = "gastos";
    
    protected $primaryKey = "id_gastos";
    
    protected $fillable   = ['ga_no_nota',   
                             'ga_importe', 
                             'ga_concepto',
                             'viaje_id'];

    public function viajes(){
        return $this->hasMany('pegaza\Viaje','viaje_id');
    }
}
