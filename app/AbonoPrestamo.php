<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class AbonoPrestamo extends Model
{
    protected $table      = "abono_prestamo";
    
    protected $primaryKey = "id_ab_prestamo";

    protected $fillable   = ['ab_numero',
                             'prestamo_id',
                             'ab_abono',
                             'ab_pago'];

    public function prestamo(){
        return $this->belongsTo('pegaza\Prestamo', 'prestamo_id');        
    }

    //MUTATORS
    public function getCreatedAtAttribute($valor){
        return Carbon::parse($valor)->format('d/m/Y');
    }
}
