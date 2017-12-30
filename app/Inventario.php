<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Inventario extends Model
{
    protected $table      = "inventario";
    
    protected $primaryKey = "id_inventario";
    
    protected $fillable   = ['in_memo',
                             'in_cantidad',
                             'in_operacion',
                             'producto_id',
                             'mp_id',
                             'produccion_id'];

    public function producto(){
        return $this->belongsTo('pegaza\Producto', 'producto_id');
    }  

    public function materia_prima(){
        return $this->belongsTo('pegaza\MateriaPrima', 'mp_id');
    }  

    public function produccion(){
        return $this->belongsTo('pegaza\Produccion', 'produccion_id');
    }  

    //MUTATORS
    public function getCreatedAtAttribute($valor){
        return Carbon::parse($valor)->format('d-m-Y');
    }
}
