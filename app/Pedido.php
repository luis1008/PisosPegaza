<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pedido extends Model
{
    protected $table      = "pedidos";
    
    protected $primaryKey = "id_pedido";
    
    protected $fillable   = ['pe_nota',
                             'cliente_id',   
                             'pe_fecha_entrega', 
                             'pe_fecha_pedido', 
                             'pe_importe', 
                             'pe_total_abonado', 
                             'pe_memo', 
                             'pe_destino_pedido',
                             'pe_destino_ciudad',
                             //'pe_status_cheque',
                             //'pe_no_cheque',
                             'pe_termino',
                             'pe_forma_pago',
                             'pe_pago_status',
                             'pe_status'];

    public function productos(){
        return $this->belongsToMany('pegaza\Producto', 'detalle_pedido','pedido_id','producto_id')->withPivot('det_prod_cantidad','det_prod_precio','det_prod_subtotal','det_prod_status');
    }

    public function producciones(){
        return $this->belongsToMany('pegaza\Produccion', 'detalle_produccion','pedido_id','produccion_id');
    } 

    public function viajes(){
        return $this->belongsToMany('pegaza\Viaje', 'detalle_viaje','pedido_id','viaje_id')->withPivot('det_tipo','det_status');
    }  

    public function cliente(){
        return $this->belongsTo('pegaza\Cliente','cliente_id');
    }      

    public function abonos(){
        return $this->hasMany('pegaza\AbonoPedido','pedido_id');
    }    

    //Mutators
    public function getPeFechaPedidoAttribute($valor){
        return Carbon::parse($valor)->format('d-m-Y');
    }   

    public function getPeFechaEntregaAttribute($valor){
        return Carbon::parse($valor)->format('d-m-Y');
    }  


      //Scope
    public function scopeFechas($query, $Inicio , $Final)
    {
        if(trim($Inicio) != "" && trim($Final) == ""){
            
            return $query->whereRaw("pe_fecha_pedido >= '$Inicio'");

        } elseif(trim($Inicio) != "" && trim($Final) != "") {

            return $query->whereRaw("pe_fecha_pedido BETWEEN '$Inicio' AND '$Final'");

        }
    }            
}
