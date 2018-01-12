<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Compra extends Model
{
    protected $table      = "compras";
    
    protected $primaryKey = "id_compra";

    protected $fillable   = ['proveedor_id',
                                'cm_pago',
                                'cm_status',
                                'cm_termino',
                                'cm_proveedor',
                                'cm_movimiento',
                                //'cm_nota',
                                'cm_tipo',
                                'cm_bodega',
                                'empleado_id',
                                'cm_num_entrada',
                                'cm_total_abonado',
                                'cm_total'];

    public function materiasprimas(){
        return $this->belongsToMany('pegaza\MateriaPrima', 'compra_mp', 'compra_id', 'mp_id')->withPivot('det_cantidad','det_precio','det_subtotal');        
    }

    public function productoscompra(){
        return $this->belongsToMany('pegaza\Producto', 'compra_producto', 'compra_id', 'producto_id')->withPivot('det_cantidad','det_precio','det_subtotal');        
    }

    public function gastos(){
        return $this->hasMany('pegaza\GastoFijo', 'compra_id');        
    }

    public function proveedor(){
        return $this->belongsTo('pegaza\Proveedor','proveedor_id');
    }

    public function abonos(){
        return $this->hasMany('pegaza\AbonoCompra','compra_id');
    }

     public function empleados(){
        return $this->hasMany('pegaza\Empleado','empleado_id');
    }

    public function movimientos(){
        return $this->belongsToMany('pegaza\MovimientoTemporal', 'detalle_movimientos', 'compra_id', 'movimiento_temporal_id')->withPivot('ct_concepto','ct_gasto','ct_nota');
    }

    //MUTATORS
    public function getCreatedAtAttribute($valor){
        return Carbon::parse($valor)->format('d-m-Y');
    }

     public function setCmProveedorAttribute($valor){
        $this->attributes['cm_proveedor'] = ($valor == null) ? "0" : "1";
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
