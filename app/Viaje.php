<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Viaje extends Model
{
    protected $table      = "viaje";
    
    protected $primaryKey = "id_viaje";
    
    protected $fillable   = ['empleado_id',
                             'vehiculo_id',   
                             'vi_kilometraje_inicial', 
                             'vi_destino', 
                             'vi_viaticos'];

    public function pedidos(){
        return $this->belongsToMany('pegaza\Pedido', 'detalle_viaje','viaje_id','pedido_id')->withPivot('det_tipo','det_status');
    }

    public function empleado(){
        return $this->belongsTo('pegaza\Empleado','empleado_id');
    }

    public function vehiculo(){
        return $this->belongsTo('pegaza\Vehiculo','vehiculo_id');
    }

    public function gastos(){
        return $this->belongsTo('pegaza\Viaje','viaje_id');
    }

    public function egresos(){
        return $this->belongsTo('pegaza\Viaje','viaje_id');
    }

      public function prestamo(){
        return $this->belongsTo('pegaza\Prestamo','viaje_id');
    }

    //MUTATORS
    public function getCreatedAtAttribute($valor){
        return Carbon::parse($valor)->format('d-m-Y');
    }
}
