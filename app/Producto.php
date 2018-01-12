<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table      = "producto";
    
    protected $primaryKey = "id_producto";
    
    protected $fillable   = ['pd_nombre', 
                           'pd_tipo', 
                           'pd_cantidad', 
                           'pd_costo', 
                           'pd_precio_venta',
                           'pd_status'];

    public function materiasprimas(){
      return $this->belongsToMany('pegaza\MateriaPrima', 'detalle_requisitos', 'producto_id', 'mp_id')->withPivot('det_cantidad','det_precio','det_subtotal','det_status');
    }


    public function compras(){
        return $this->belongsToMany('pegaza\Compra', 'compra_producto', 'producto_id', 'compra_id')->withPivot('det_cantidad','det_precio','det_subtotal');        
    }

    public function productos(){
      return $this->belongsToMany('pegaza\Producto', 'detalle_requisito_producto', 'producto_id', 'pd_id')->withPivot('det_pd_cantidad','det_pd_precio','det_pd_subtotal','det_pd_status');
    }

    public function pedidos(){
      return $this->belongsToMany('pegaza\Pedido', 'detalle_pedido','producto_id','pedido_id')->withPivot('det_prod_cantidad','det_prod_precio','det_prod_subtotal','det_prod_status');
    }

    public function inventarios(){
        return $this->hasMany('pegaza\Inventario', 'producto_id');
    } 
}
