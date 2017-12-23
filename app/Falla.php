<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Falla extends Model
{
    protected $table      = "fallas";
    
    protected $primaryKey = "id_falla";
    
    protected $fillable   = ['placas',   
                             'fa_descripcion', 
                             'fa_lugar', 
                             'fa_costo'];

    public function vehiculo(){
        return $this->belongsTo('pegaza\Vehiculo','placas');
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

    //Mutator
    public function getCreatedAtAttribute($valor){
        return Carbon::parse($valor)->format('d-m-Y');
    }
}
