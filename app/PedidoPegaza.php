<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class PedidoPegaza extends Model
{
    protected $table      = "pedido_pegaza";
    
    protected $primaryKey = "id_pegaza";
    
    protected $fillable   = ['pp_nota',
                             'pp_memo',
                             'pp_status'];

    public function productos(){
        return $this->belongsToMany('pegaza\Producto', 'detalle_pedido','pegaza_id','producto_id')->withPivot('det_prod_cantidad','det_prod_status');
    }  

    //MUTATORS
    public function getCreatedAtAttribute($valor){
        return Carbon::parse($valor)->format('d-m-Y');
    }
}
