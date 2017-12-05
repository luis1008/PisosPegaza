<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = "proveedor";
    
    protected $primaryKey = "id_proveedor";

    protected $fillable = [ 'pv_nombre',
                            'pv_domicilio',
                            'pv_ciudad',
                            'pv_rfc',
                            'pv_correo', 
                            'pv_status'];

    public function contactos(){
        return $this->hasMany('pegaza\Contacto','proveedor_id');
    }

    public function compras(){
        return $this->hasMany('pegaza\Compra','proveedor_id');
    }

    public function conceptos(){
        return $this->hasMany('pegaza\ConceptoTemporal','proveedor_id');
    }
}
