<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Produccion extends Model
{
    protected $table      = "produccion";
    
    protected $primaryKey = "id_produccion";
    
    protected $fillable   = ['pr_encargado',
                             'pr_ayudante',
                             'pr_turno',
                             'pr_completo',
                             'pr_recibido'];
}
