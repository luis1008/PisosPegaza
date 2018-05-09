<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class AbonoPedido extends Model
{
    protected $table      = "abono_pedido";
    
    protected $primaryKey = "id_abono_pedido";

    protected $fillable   = ['pedido_id',
                                'ap_abono',
                                'ap_numero',
                                'ap_no_cheque',
                                'ap_status_cheque',
                                'ap_folio',
                                'ap_pago'];

    public function pedido(){
        return $this->belongsTo('pegaza\Pedido', 'pedido_id');        
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
