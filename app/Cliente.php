<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = "cliente";

    protected $primaryKey = "id_cliente";

    protected $fillable = [ //'cl_factura',
                            'cl_rfc',
                            'cl_nombre',
                            'cl_observacion',
                            'cl_correo', 
                            'cl_telefono', 
                            'cl_nombre_contacto', 
                            'cl_nombre_dueno', 
                            'cl_forma_pago', 
                            'cl_tipo_cliente', 
                            'cl_termino_credito', 
                            'cl_status'];

    public function domicilios(){
        return $this->hasMany('pegaza\Domicilio','cliente_id');
    }

    public function documentos(){
        return $this->hasOne('pegaza\Documentos_Cl','cliente_id');
    }

      public function pedido(){
        return $this->belongsTo('pegaza\Pedido','cliente_id');
    }
}