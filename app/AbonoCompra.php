<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AbonoCompra extends Model
{
    protected $table      = "abono_compra";
    
    protected $primaryKey = "id_abono";

    protected $fillable   = ['compra_id',
                                'ab_numero',
                                'ab_abono',
                                'ab_pago'];

    public function compra(){
        return $this->belongsTo('pegaza\Compra', 'compra_id');        
    }

    public function movimientos(){
        return $this->belongsToMany('pegaza\MovimientoTemporal', 'detalle_movimientos', 'movimiento_temporal_id', 'compra_id')->withPivot('ab_abono','ab_pago');
    }
    //MUTATORS
    public function getCreatedAtAttribute($valor){
        return Carbon::parse($valor)->format('d/m/Y');
    }
}
