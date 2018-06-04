<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Prestamo extends Model
{
    protected $table      = "prestamo";
    
    protected $primaryKey = "id_prestamo";
    
    protected $fillable   = ['pres_cantidad', 
                            'pres_status', 
                            'pres_descripcion', 
                            'viaje_id', 
                            'empleado',
                            'pres_tipo',
                            'movimiento_temporal_id'];

    public function viaje(){
        return $this->hasOne('pegaza\Viaje','viaje_id');
    }

    public function movimiento(){
        return $this->belongsTo('pegaza\MovimientoTemporal','movimiento_temporal_id');
    }

    public function abonos(){
        return $this->hasMany('pegaza\AbonoPrestamo','prestamo_id');
    }

    public function empleado(){
        return $this->belongsTo('pegaza\Empleado','empleado_id');
    }

    //MUTATORS
    public function getCreatedAtAttribute($valor){
        return Carbon::parse($valor)->format('d-m-Y');
    }

        //Scope
    public function scopeFechas($query, $Inicio , $Final)
    {
        if(trim($Inicio) != "" && trim($Final) == ""){
            
            return $query->whereRaw("pe_fecha_pedido >= '$Inicio'");

        } elseif(trim($Inicio) != "" && trim($Final) != "") {

            return $query->whereRaw("pe_fecha_pedido BETWEEN '$Inicio' AND '$Final'");

        }
    } 
}
