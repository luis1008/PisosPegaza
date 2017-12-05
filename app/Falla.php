<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Falla extends Model
{
    protected $table      = "fallas";
    
    protected $primaryKey = "id_falla";
    
    protected $fillable   = ['placas',   
                             'fa_descripcion', 
                             'fa_lugar', 
                             'fa_costo'];

    public function vehiculo(){
        return $this->belongsTo('pegaza\Vehiculo','placas');
    }
}
