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
                                'empleado'];


    public function prestamo(){
        return $this->hasOne('pegaza\Prestamo','movimiento_temporal_id');
    }

    public function compras(){
        return $this->belongsToMany('pegaza\Compra', 'detalle_movimientos', 'movimiento_temporal_id', 'compra_id')->withPivot('ct_concepto','ct_gasto','ct_nota');
    }

    public function abonos(){
        return $this->belongsToMany('pegaza\AbonoCompra', 'detalle_movimientos', 'movimiento_temporal_id', 'compra_id')->withPivot('ab_abono','ab_pago');
    }

    //MUTATORS
    public function getCreatedAtAttribute($valor){
        return Carbon::parse($valor)->format('d-m-Y');
    }
}
