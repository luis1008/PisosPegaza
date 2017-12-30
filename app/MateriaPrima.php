<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class MateriaPrima extends Model
{
    protected $table      = "materia_prima";
    
    protected $primaryKey = "id_materia_prima";
    
    protected $fillable   = ['mp_nombre', 
                           'mp_cantidad', 
                           'mp_unidad', 
                           'mp_precio', 
                           'mp_status',
                           'mp_observacion'];

    public function productos(){
        return $this->belongsToMany('pegaza\Producto', 'detalle_requisitos', 'mp_id', 'producto_id')->withPivot('det_cantidad','det_precio','det_subtotal','det_status');        
    }

    public function compras(){
        return $this->belongsToMany('pegaza\Compra', 'compra_mp', 'mp_id', 'compra_id')->withPivot('det_cantidad','det_precio','det_subtotal');        
    }

    public function inventarios(){
        return $this->hasMany('pegaza\Inventario', 'mp_id');
    } 
}
