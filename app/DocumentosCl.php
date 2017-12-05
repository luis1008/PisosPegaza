<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class DocumentosCl extends Model
{
    protected $table      = "documentos_cl";

    protected $primaryKey = "id_documentos_cl";

    protected $fillable   =['cliente_id',
                            'hacienda',
                            'comprobante_domicilio', 
                            'ine'];

    public function cliente(){
        return $this->belongsTo('pegaza\Cliente','cliente_id');
    }
    
    //Mutators
    public function setHaciendaAttribute($valor){
        $this->attributes['hacienda'] = ($valor == null) ? "0" : "1";
    }

    public function setComprobanteDomicilioAttribute($valor){
        $this->attributes['comprobante_domicilio'] = ($valor == null) ? "0" : "1";
    }

    public function setIneAttribute($valor){
        $this->attributes['ine'] = ($valor == null) ? "0" : "1";
    }
}
