<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Produccion extends Model
{
    protected $table      = "produccion";
    
    protected $primaryKey = "id_produccion";
    
    protected $fillable   = ['pr_encargado',
                             'pr_ayudante',
                             'pr_turno',
                             'pr_completo',
                             'pr_recibido'];

    public function pedidos(){
        return $this->belongsToMany('pegaza\Pedido', 'detalle_produccion','produccion_id','pedido_id');
    } 

    public function inventarios(){
        return $this->hasMany('pegaza\Inventario', 'produccion_id');
    } 

    public function getCreatedAtAttribute($valor){
        return Carbon::parse($valor)->format('d-m-Y');
    }

      //Scope
    public function scopeFechas($query, $Inicio , $Final)
    {
        if(trim($Inicio) != "" && trim($Final) == ""){
            
            return $query->whereRaw("created_at >= '$Inicio'");

        } elseif(trim($Inicio) != "" && trim($Final) != "") {

            return $query->whereRaw("created_at BETWEEN '$Inicio' AND '$Final'");

        }
    } 
}
