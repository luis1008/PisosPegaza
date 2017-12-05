<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    protected $table = "contratos";
    
    protected $primaryKey = "id_contrato";

    public $timestamps = false;
    
    protected $fillable = ['empleado_id',
    					   'cont_fecha_inicio', 
                           'cont_fecha_fin'];

	
     public function empleado(){
    	return $this->belongsTo('pegaza\Empleado','empleado_id');
    }

}
