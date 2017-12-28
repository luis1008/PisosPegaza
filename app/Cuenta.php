<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $table      = "cuentas";
    
    protected $primaryKey = "id_cuentas";

    protected $fillable   = ['ct_nombre, ct_status'];
}
