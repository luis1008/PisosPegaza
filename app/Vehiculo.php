<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    protected $table = "vehiculo";
    
    protected $primaryKey = "placas";
    
    public $incrementing = false;
    
    protected $fillable = ['vh_nombre', 
                           'vh_caracteirsticas',
                           'vh_falla',
                           'vh_status'];

   	public function viajes(){
        return $this->hasMany('pegaza\Viaje','vehiculo_id');
    }

    public function fallas(){
        return $this->hasMany('pegaza\Falla','placas');
    }

}
