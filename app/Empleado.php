<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    protected $table      = "empleado";

    protected $primaryKey = "id_empleado";
    
    protected $fillable   = ['em_nombre', 
                            'em_curp', 
                            'em_num_seg_social', 
                            'em_fecha_inicio', 
                            'em_num_licencia', 
                            'em_vigencia_licencia',
                            'em_fecha_final',
                            'em_tipo',
                            'em_status'];

    public function documentos(){
        return $this->hasOne('pegaza\Documentos','empleado_id');
    }

    public function usuario(){
        return $this->hasOne('pegaza\Usuario','empleado_id');
    }

    public function viajes(){
        return $this->hasMany('pegaza\Viaje','empleado_id');
    }

    public function contratos(){
        return $this->hasMany('pegaza\Contrato','empleado_id');
    }

    public function compras(){
        return $this->hasOne('pegaza\Compra','empleado_id');
    }

    public function prestamos(){
        return $this->hasMany('pegaza\Prestamo','empleado_id');
    }

    // Mutators
    public function setEmCurpAttribute($valor){
        if ($valor == null || $valor == "") {
            $this->attributes['em_curp'] = NULL;
        } else {
            $this->attributes['em_curp'] = $valor;
        }
    }

    public function setEmNumSegSocialAttribute($valor){
        if ($valor == null || $valor == "") {
            $this->attributes['em_num_seg_social'] = NULL;
        } else {
            $this->attributes['em_num_seg_social'] = $valor;
        }
    }

    public function setEmNumLicenciaAttribute($valor){
        if ($valor == null || $valor == "") {
            $this->attributes['em_num_licencia'] = NULL;
        } else {
            $this->attributes['em_num_licencia'] = $valor;
        }
    }

    public function setEmVigenciaLicenciaAttribute($valor){
        if ($valor == null || $valor == "") {
            $this->attributes['em_vigencia_licencia'] = NULL;
        } else {
            $this->attributes['em_vigencia_licencia'] = $valor;
        }
    }
}
