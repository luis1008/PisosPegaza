<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $table      = "cuentas";
    
    protected $primaryKey = "id_cuentas";

    protected $fillable   = ['ct_nombre'];

    public function compras(){
        return $this->belongsToMany('pegaza\Compra', 'compra_cuentas', 'cuentas_id', 'compra_id')->withPivot('det_cantidad','det_precio','det_subtotal');        
    }
}
