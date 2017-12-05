<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Domicilio extends Model
{
    protected $table = "domicilio";

    protected $primaryKey = "id_domicilio";

    protected $fillable = [ 'dom_calle',
                            'dom_colonia',
                            'dom_ciudad',
                            'dom_codigo_postal',
                            'cliente_id'];

    public function cliente(){
        return $this->belongsTo('pegaza\Cliente','cliente_id');
    }
    
}