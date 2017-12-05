<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected $table = "contacto";
    
    protected $primaryKey = "id_contacto";

    protected $fillable = [ 'cn_nombre',
                            'cn_telefono', 
                            'proveedor_id'];

    public function proveedor(){
        return $this->belongsTo('pegaza\Proveedor','proveedor_id');
    }
}
