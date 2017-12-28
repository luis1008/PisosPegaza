<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class GastoFijo extends Model
{
    protected $table      = "gasto_fijo";
    
    protected $primaryKey = "id_gasto_fijo";

    protected $fillable   = ['gf_concepto, gf_cantidad','gf_importe','gf_subtotal', 'compra_id'];

    public function compra(){
        return $this->belongsTo('pegaza\Compra', 'compra_id');        
    }
}
