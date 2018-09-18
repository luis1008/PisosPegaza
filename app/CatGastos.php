<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class CatGastos extends Model
{
    protected $table      = "catalogo_gastos";
    
    protected $primaryKey = "id_cat_gastos";
    
    protected $fillable   = ['catga_gastos',                          
                             'catga_status'];
    

    public function viajes(){
        return $this->hasMany('pegaza\Viaje','gasto_id');
    }
}
