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

              //Scope
    public function scopeFechas($query, $Inicio , $Final)
    {
        if(trim($Inicio) != "" && trim($Final) == ""){
            
            return $query->whereRaw("created_at >= '$Inicio'");

        } elseif(trim($Inicio) != "" && trim($Final) != "") {

            return $query->whereRaw("created_at BETWEEN '$Inicio' AND '$Final'");

        }
    }
}
