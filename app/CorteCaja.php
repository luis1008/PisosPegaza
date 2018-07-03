<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class CorteCaja extends Model
{
    protected $table = "corte_caja";

    protected $primaryKey = "id_corte";

    protected $fillable = [ //'cl_factura',
                            'crt_ingresos',
                            'crt_egresos',
                            'crt_saldo'];
}
