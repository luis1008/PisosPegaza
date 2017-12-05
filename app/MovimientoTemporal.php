<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class MovimientoTemporal extends Model
{
    protected $table      = "movimiento_temporal";
    
    protected $primaryKey = "id_movimiento_temporal";

    protected $fillable   = [   'mt_entregado',
                                'mt_firma', 
                                'mt_status',
                                'mt_gasto',
                                'empleado_id'];

    public function empleado(){
        return $this->belongsTo('pegaza\Empleado','empleado_id');
    }

    public function prestamo(){
        return $this->hasOne('pegaza\Prestamo','movimiento_temporal_id');
    }

    public function compras(){
        return $this->belongsToMany('pegaza\Compra', 'detalle_movimientos', 'movimiento_temporal_id', 'compra_id')->withPivot('ct_concepto','ct_gasto','ct_nota');
    }

    //MUTATORS
    public function getCreatedAtAttribute($valor){
        return Carbon::parse($valor)->format('d-m-Y');
    }
}
