<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Egresos extends Model
{
    protected $table      = "egresos";
    
    protected $primaryKey = "id_egresos";
    
    protected $fillable   = ['eg_nota',                          
                             'eg_concepto',
                         	 'eg_importe',                          
                             'viaje_id'];

    public function viajes(){
        return $this->hasMany('pegaza\Viaje','viaje_id');
    }
}