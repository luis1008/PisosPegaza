<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Documentos extends Model
{
    protected $table      = "documentos";

    protected $primaryKey = "id_documentos";

    protected $fillable   = ['empleado_id',
                            'acta_nacimiento',
                            'comprobante_domicilio', 
                            'seguro_social', 
                            'curp', 
                            'ine', 
                            'licencia_conducir'];

    public function empleado(){
        return $this->belongsTo('pegaza\Empleado','empleado_id');
    }
    
    //Mutators
    public function setActaNacimientoAttribute($valor){
        $this->attributes['acta_nacimiento'] = ($valor == null) ? "0" : "1";
    }

    public function setComprobanteDomicilioAttribute($valor){
        $this->attributes['comprobante_domicilio'] = ($valor == null) ? "0" : "1";
    }

    public function setSeguroSocialAttribute($valor){
        $this->attributes['seguro_social'] = ($valor == null) ? "0" : "1";
    }

    public function setCurpAttribute($valor){
        $this->attributes['curp'] = ($valor == null) ? "0" : "1";
    }

    public function setIneAttribute($valor){
        $this->attributes['ine'] = ($valor == null) ? "0" : "1";
    }

    public function setLicenciaConducirAttribute($valor){
        $this->attributes['licencia_conducir'] = ($valor == null) ? "0" : "1";
    }
}
