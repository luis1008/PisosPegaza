<?php

namespace pegaza\Http\Controllers;

use Illuminate\Http\Request;

use pegaza\Http\Requests;
use pegaza\MovimientoTemporal;
use pegaza\ConceptoTemporal;
use pegaza\Empleado;
use pegaza\Prestamo;
use pegaza\Proveedor;
use pegaza\Cuenta;
use pegaza\Compra;
use pegaza\AbonoCompra;
use pegaza\AbonoPedido;
use pegaza\AbonoPrestamo;
use pegaza\Cliente;
use pegaza\Producto;
use pegaza\Pedido;
use pegaza\Inventario;
use pegaza\Domicilio;
use pegaza\Vehiculo;
use pegaza\Viaje;
use pegaza\MateriaPrima;
use pegaza\Produccion;
use pegaza\Gastos;
use pegaza\GastoFijo;
use pegaza\Egresos;
use pegaza\Persona;

class CajaController extends Controller
{
    public function caja(){
        $emp = Empleado::where('em_status','=','1')->orderBy('em_nombre')->get();
        $veh = Vehiculo::where('vh_status','=','1')->get();
        $cob = Pedido::where('pe_status','=','ENTREGADO')->where('pe_pago_status','!=','PAGADO')->get();
        $pre = Pedido::where('pe_status','=','PREPARADO PARA ENTREGAR')->get();
        $ciu = Pedido::select('pe_destino_ciudad')->distinct()->get();
        $mtp = MovimientoTemporal::where('mt_status','=','PENDIENTE')->get();
        $prp = Prestamo::where('pres_status','=','PENDIENTE')->get();
        $prv = Proveedor::where('pv_status','=','1')->get();
        $com = Compra:: where ('cm_bodega','=','0')->get();
        $cli = Cliente::where('cl_status','=','1')->orderBy('cl_nombre')->get();
        $ped = Pedido::where('pe_status','!=','ENTREGADO')->get();
        $ped_ade = Pedido::where('pe_pago_status','!=','PAGADO')->get();
        $prod = Producto::where('pd_status','=','1')->orderBy('pd_nombre')->get();
        $mp = MateriaPrima::where('mp_status','=','1')->orderBy('mp_nombre')->get();
        $u_pe = Pedido::select('pe_nota')->orderBy('id_pedido','DESC')->first();
        $u_pe = ($u_pe) ? $u_pe->pe_nota + 1 : "0";
        $viaj = Viaje::where('vi_status','0')->get();
        /*$pega = PedidoPegaza::where('pp_status','PENDIENTE')->get();*/
        $mov_comp = Compra::where('cm_status','PENDIENTE')->where('cm_movimiento','0')->where('cm_proveedor','0')->get();
        $pend = \DB::table('detalle_viaje')->join('pedidos','pedidos.id_pedido','=','detalle_viaje.pedido_id')->select('pedidos.id_pedido')->where('detalle_viaje.det_status','PENDIENTE')->get();
        $pedidos_pendientes_produccion = Pedido::where('pe_status','PENDIENTE PARA PRODUCCION')->get();
        $ClientesPendientesPorPagar    = Pedido::where('pe_pago_status','!=','PAGADO')->where('pe_status','=','ENTREGADO')->orderBy('pe_fecha_pedido')->groupBy('cliente_id')->get();
        $ProveedoresPendientesPorPagar = Compra::where('cm_status','!=','PAGADO')->orderBy('created_at')->groupBy('proveedor_id')->get();
        $EmpleadosPendientesPorPagar   = Prestamo::where('pres_tipo','=','PERSONAL')->where('pres_status','=','APROBADO')->whereRaw('pres_abonado < pres_cantidad')->orderBy('created_at')->groupBy('empleado_id')->get();
        $CatalogoCuentas               = Cuenta::where('ct_status','1')->orderBy('ct_nombre')->get();
        $PedidosProduccion             = Produccion::where('pr_completo','PENDIENTE')->orderBy('created_at')->get();
        $CatalogoGastos                = Gastos::where('ga_status','1')->orderBy('ga_concepto')->get();
        //dd($CatalogoGastos);
        return view('Caja.Caja')->with('empleados',$emp)
                                ->with('vehiculos',$veh)
                                ->with('mtPendientes',$mtp)
                                ->with('proveedores',$prv)
                                ->with('compras',$com)
                                ->with('PPendientes',$prp)
                                ->with('clientes',$cli)
                                ->with('ClientesPendientes',$ClientesPendientesPorPagar)
                                ->with('ProveedoresPendientes',$ProveedoresPendientesPorPagar)
                                ->with('EmpleadosPendientes',$EmpleadosPendientesPorPagar)
                                ->with('PedidosProduccion',$PedidosProduccion)
                                ->with('pedidos',$ped)
                                ->with('cobranza',$cob)
                                ->with('ultima_nota',$u_pe)
                                ->with('preparados',$pre)
                                ->with('ciudades',$ciu)
                                ->with('viajes',$viaj)
                                ->with('pedidos_asignados',$pend)
                                /*->with('pedidos_pegaza',$pega)*/
                                ->with('pedidos_adeuda',$ped_ade)
                                ->with('mov_compras',$mov_comp)
                                ->with('mat_primas',$mp)
                                ->with('cuentas',$CatalogoCuentas)
                                ->with('pendientes',$pedidos_pendientes_produccion)
                                ->with('productos',$prod)
                                ->with('cat_gastos',$CatalogoGastos);

    }

    // MOVIMIENTOS TEMPORALES
    public function post_movimiento(Request $request){
        //dd($request);
        $mov = new MovimientoTemporal();
        $mov->mt_entregado = $request->entregado;
        $mov->mt_fecha = $request->fecha_movimiento;
        $mov->empleado  = $request->empleado;
        $mov->save();

        for ($i=0; $i < sizeof($request->concepto); $i++) { 
            $mov->compras()->attach("0", ['ct_concepto'=>$request->concepto[$i]]);
        }

        for ($i=0; $i < sizeof($request->compras); $i++) { 
            $mov->compras()->attach($request->compras[$i]);
        }

           $datos = [
            'id' => $mov->id_movimiento_temporal,
            'fecha'   => $mov->created_at,
        ];
        return view('Imprimir.ticket_movimiento',['datos'=>$datos]);
        
    }

    public function put_MTPendiente(Request $request){
        //dd($request);
        $mov = MovimientoTemporal::find($request->movimiento);
        $mov->mt_gasto  = $request->total_gasto;
        $mov->mt_firma  = "1";
        $mov->mt_status = "FINALIZADO";

        for ($i=0; $i < sizeof($request->id_concepto); $i++) { 
            \DB::table('detalle_movimientos')->where('id_concepto',$request->id_concepto[$i])->update(['ct_gasto'=>$request->gasto_concepto[$i],'ct_nota'=>$request->nota_concepto[$i]]);
        }

        for ($i=0; $i < sizeof($request->gasto_compra); $i++) { 
            $GLOBALS['gasto_compra'.$i] = $request->gasto_compra[$i];
            $GLOBALS['nota_compra'.$i]  = $request->nota_compra[$i];
        }

        // Los que tengan relacion con compra
        $mov->compras->each(function($concepto, $pos){
            $concepto->pivot->ct_gasto = $GLOBALS['gasto_compra'.$pos];
            $concepto->pivot->ct_nota  = $GLOBALS['nota_compra'.$pos];
            $concepto->pivot->save();
            $concepto->cm_movimiento = 1;
            $concepto->save();
        });

        $mov->save();
        //dd("Guardado");
        $res = $mov->mt_entregado - $mov->mt_gasto;

        // SI ES NEGATIVO SE CREA UN PRESTAMO
        if ($res < 0) {
            $pre = new Prestamo();
            $pre->pres_cantidad          = $res * -1;
            $pre->pres_descripcion       = "PRESTAMO POR MOVIMIENTOS TEMPORALES";
            $pre->movimiento_temporal_id = $mov->id_movimiento_temporal;
            $pre->pres_tipo              = "GASTO";
            $pre->empleado               = $mov->empleado;
            $pre->save();
        }

        return redirect()->route('caja');


    }

    public function post_AddOtroConcepto(Request $request){
        //dd($request);
        $mov = MovimientoTemporal::find($request->movimiento);

        for ($i=0; $i < sizeof($request->compras); $i++) { 
            $mov->compras()->attach($request->compras[$i]);
        }

        if ($request->concepto != "") {
            $mov->compras()->attach("0", ['ct_concepto'=>$request->concepto]);
        }

        return redirect()->route('caja');
    }

    // PRESTAMO
    public function post_prestamo(Request $request, $id){
        //dd($request);
        $pre = new Prestamo();
        $pre->pres_cantidad     = $request->prestamo;
        $pre->pres_descripcion  = $request->descripcion;
        $pre->pres_tipo         = $request->tipo;
        $pre->empleado_id       = $id;
        $pre->save();

        return redirect()->route('caja');
    }

    //PRESTAMO PENDIENTE
    public function put_PPendiente(Request $request){
        $pre = Prestamo::find($request->prestamo);
        $pre->pres_status = $request->estatus;
        $pre->save();

        return redirect()->route('caja');
    }

    public function post_persona(Request $request){
        //dd($request);
        $per = new Persona();
        $per->per_nombre        = $request->nombre;
        $per->per_telefono      = $request->telefono;
        $per->save();

                if ($request->ajax()) {
            return response()->json("exito");
        }else {
            return redirect()->route('caja');
        }
    }

    // COMPRAS
    public function post_compra(Request $request){
        //dd($request);
        $compra = new Compra();
        $compra->proveedor_id = $request->proveedor;
        $compra->cm_termino   = $request->termino;
        $compra->cm_total     = $request->importe;
        $compra->cm_tipo      = $request->tipo_compra;
        $compra->cm_proveedor = $request->check_proveedor;
        $compra->cm_nota      = $request->no_nota;
        $compra->cm_pago      = ($request->termino != "CONTADO") ? "CREDITO" : $request->termino;
        $compra->save();

        for ($i=0; $i < sizeof($request->cantidad); $i++) { 
            if ($request->tipo_compra == "MATERIA PRIMA") {
                //dd($request);
                // GUARDAR TABLA DETALLE compra_mp
                $compra->materiasprimas()->attach($request->material[$i], ['det_cantidad'=>$request->cantidad[$i],'det_precio'=>$request->precio[$i],'det_subtotal'=>$request->subtotal[$i]]);
            } elseif($request->tipo_compra == "GASTO") {
                // GUARDAR TABLA DETALLE compra_cuenta
                $gasto = new GastoFijo();
                $gasto->gf_concepto = $request->material[$i];
                $gasto->gf_cantidad = $request->cantidad[$i];
                $gasto->gf_importe  = $request->precio[$i];
                $gasto->gf_subtotal = $request->subtotal[$i];
                $gasto->compra_id   = $compra->id_compra;
                $gasto->save();
            }  else{
                //dd($request);
                 // GUARDAR TABLA DETALLE compra_producto
                $compra->productoscompra()->attach($request->material[$i], ['det_cantidad'=>$request->cantidad[$i],'det_precio'=>$request->precio[$i],'det_subtotal'=>$request->subtotal[$i]]);
            }
        }

        return redirect()->route('caja');
    }

    public function put_CompraBodega(Request $request, $id){
        $compra = Compra::find($id);
        $compra->cm_bodega = 1;
        $compra->empleado_id = $request->empleado;
        $compra->cm_num_entrada = $request->num_entrada;
        $compra->save();

        return redirect()->route('caja');
    }

    public function put_AbonarPagarCompra(Request $request, $id){
        //dd($request->bodega);
        $compra = Compra::find($id);
        $compra->cm_total_abonado += $request->pago; 
        

        if ($compra->cm_total == $compra->cm_total_abonado) {
            $compra->cm_status = "PAGADO";
        } else if($compra->cm_total_abonado > 0 && $compra->cm_status == "PENDIENTE") {
            $compra->cm_status = "ABONADO";
        }

        $compra->save();

        $abono = new AbonoCompra();
        $abono->compra_id = $id;
        $abono->ab_numero = $compra->abonos->count() + 1;
        $abono->ab_abono  = $request->pago;
        $abono->ab_pago   = $request->forma_pago;
        $abono->save();

        return redirect()->route('caja');
    }

    // PEDIDO
    public function post_pedido(Request $request){
        //dd($request);
        $pos = strpos($request->destino, '>');
        //dd(substr($request->destino, 0, $pos));
        if ($request->ajax()) {
            //Validar campos required
            $this->validate($request, [
                'rfc'       => 'unique:pedido,pe_nota',
                ],[
                    'nota.unique'  => 'EL NUMERO DE NOTA YA EXISTE.',
                    ]
            );
        }
        $pedido = new Pedido();
        $pedido->cliente_id         = $request->cliente;
        $pedido->pe_nota            = ($request->nota!= "") ? $request->nota : NULL;
        $pedido->pe_fecha_entrega   = $request->fecha_programada;
        $pedido->pe_fecha_pedido    = $request->fecha_pedido;
        $pedido->pe_destino_pedido  = substr($request->destino, 0, $pos);
        $pedido->pe_destino_ciudad  = substr($request->destino, $pos+1);
        $pedido->pe_memo            = $request->memo;
        //$pedido->pe_status_cheque   = ($request->no_cheque != "0") ? "VERIFICANDO" : "NINGUNO";
        //$pedido->pe_no_cheque       = ($request->no_cheque != "") ? $request->no_cheque : 0;
        $pedido->pe_termino         = $request->termino;
        $pedido->pe_importe         = $request->importe;
        $pedido->pe_forma_pago      = $request->forma_pago;
        $pedido->pe_notas_cl        = $request->notas;
        $pedido->pe_status          = $request->status;
        //$pedido->pe_pago_status     = $request->pago_status;
        if($pedido->pe_forma_pago == "ABONADO"){
            $pedido->pe_total_abonado   = $request->abono_pedido;
        } else if($pedido->pe_forma_pago == "PAGADO"){
            $pedido->pe_total_abonado   = $pedido->pe_importe;
        }
        $pedido->save();
        
        //Guardar Tabla detalle
        for ($i=0; $i < sizeof($request->cantidad); $i++) { 
            $pedido->productos()->attach($request->producto[$i], ['det_prod_cantidad'=>$request->cantidad[$i],'det_prod_precio'=>$request->precio[$i],'det_prod_subtotal'=>$request->subtotal[$i]]);
        }

        if($request->pago_status != "PENDIENTE"){
            $abonos = new AbonoPedido();
            $abonos->ap_abono     = ($request->pago_status != "PAGADO") ? $request->abono_pedido : $pedido->pe_importe;
            $abonos->ap_numero    = $pedido->abonos->count() + 1;
            $abonos->pedido_id    = $pedido->id_pedido;
            $abonos->ap_pago      = ($request->forma_pago == "DEPOSITO" || $request->forma_pago == "TRANSFERENCIA") ? 'BANCARIA' : $request->forma_pago;
            $abonos->ap_folio     = $pedido->pe_nota;

            if($pedido->pe_forma_pago == "CHEQUE"){
                $abonos->ap_no_cheque     = $request->no_cheque;
                $abonos->ap_status_cheque = "VERIFICANDO";
            } 

            $abonos->save();
        }

        //GENERAR NOTA DE ABONO????
        
        $datos = [
            'no_nota' => $pedido->pe_nota,
            'id'      => $pedido->id_pedido,
            'orden'   => ($pedido->pe_status == "PENDIENTE PARA PRODUCCION" /*|| $pedido->pe_status == "EN PRODUCCION"*/) ? 1 : 0,
        ];
        
        //dd($datos);
        return view('Imprimir.nota_pedido',['datos'=>$datos]);
        //return redirect()->route('pdf_pedido',['id'=>$pedido->id_pedido,'preorden'=>1]);//Lo redirecciona a la vista
        //return redirect()->route('caja');//Lo redirecciona a la vista
    }

    public function put_pedido(Request $request){

        $pedido = Pedido::find($request->pedido);
        $pedido->pe_status = $request->status;
        $pedido->save();

        return redirect()->route('Caja');

    }

    public function get_view_update_pedido($id){
        //dd($id);
        $ped  = Pedido::find($id);
        $prod = Producto::where('pd_status','=','1')->get();
        return view('Update.pedido')->with('pedido',$ped)->with('productos',$prod);
    }

    public function put_abona_pedido(Request $request, $id){
        //dd($request);
        $pedido = Pedido::find($id);
        $pedido->pe_total_abonado   = $request->abona;
        $pedido->pe_forma_pago      = $request->forma_pago;
        $pedido->save();
        
        return redirect()->route('caja');

    }
    public function put_datos_pedido(Request $request, $id){
        //dd($request);
        $pedido = Pedido::find($id);
        $pedido->pe_nota            = $request->nota;
        $pedido->pe_fecha_entrega   = $request->fecha_programada2;
        $pedido->pe_fecha_pedido    = $request->fecha_pedido2;
        $pedido->pe_memo            = $request->memo;
        //$pedido->pe_status_cheque   = ($request->no_cheque != "0") ? "VERIFICANDO" : "NINGUNO";
        //$pedido->pe_no_cheque       = ($request->no_cheque != "") ? $request->no_cheque : 0;
        $pedido->pe_termino         = $request->termino;
        $pedido->pe_importe         = $request->importe;
        //$pedido->pe_forma_pago      = $request->forma_pago;
        $pedido->pe_status          = $request->status;
        //$pedido->pe_pago_status     = $request->pago_status;

        if($request->destino != "0"){
            //dd("SI entra");
            $pos = strpos($request->destino, '>');
            $pedido->pe_destino_pedido  = substr($request->destino, 0, $pos);
            $pedido->pe_destino_ciudad  = substr($request->destino, $pos+1);
        }

        $pedido->save();

        //Vaciar Tabla detalle
        $pedido->productos()->detach();
        //Guardar Nuevos Datos -> Tabla detalle
        for ($i=0; $i < sizeof($request->cantidad2); $i++) { 
            $pedido->productos()->attach($request->producto2[$i], ['det_prod_cantidad'=>$request->cantidad2[$i],'det_prod_precio'=>$request->precio2[$i],'det_prod_subtotal'=>$request->subtotal2[$i]]);
        }

        /*$exs_abonos = AbonoPedido::where('pedido_id',$pedido->id_pedido)->first();
        if($exs_abonos){
            $exs_abonos->destroy($exs_abonos->id_abono_pedido);
        }

        $abonos = new AbonoPedido();
        $abonos->ap_abono     = ($request->) ? $request->abono_pedido : $pedido->pe_importe;
        $abonos->ap_numero    = $pedido->abonos->count() + 1;
        $abonos->pedido_id    = $pedido->id_pedido;
        $abonos->ap_pago      = ($request->forma_pago == "DEPOSITO" || $request->forma_pago == "TRANSFERENCIA") ? 'BANCARIA' : $request->forma_pago;
        $abonos->ap_folio     = $pedido->pe_nota;

        if($pedido->forma_pago == "CHEQUE"){
            $abonos->ap_no_cheque     = ($request->no_cheque != 0) ? $request->no_cheque : 0;
            $abonos->ap_status_cheque = "VERIFICANDO";
        }

        $abonos->save();*/

        $datos = [
            'no_nota' => $pedido->pe_nota,
            'id'      => $pedido->id_pedido,
            'orden'   => ($pedido->pe_status == "PENDIENTE PARA PRODUCCION") ? 1 : 0,
        ];
        
        //dd($datos);
        return view('Imprimir.nota_pedido',['datos'=>$datos]);
    }

    // VIAJE
    public function post_viaje(Request $request){
        //dd($request);
        $viaje = new Viaje();
        $viaje->vi_kilometraje_inicial = $request->inicial;
        $viaje->vi_fecha               = $request->fecha;
        $viaje->empleado_id            = $request->repartidor;
        $viaje->vehiculo_id            = $request->transporte;
        $viaje->vi_destino             = $request->destino;
        $viaje->vi_viaticos            = $request->viaticos;
        $viaje->save();

        for ($i=0; $i < sizeof($request->pedidos); $i++) { 
            $viaje->pedidos()->attach($request->pedidos[$i], ['det_tipo'=>'ENTREGA']);
            $pedido = Pedido::find($request->pedidos[$i]);
            $pedido->pe_status = "EN CAMINO A ENTREGAR";
            $pedido->save();
        }

        for ($i=0; $i < sizeof($request->cobrar); $i++) { 
            $viaje->pedidos()->attach($request->cobrar[$i], ['det_tipo'=>'COBRANZA']);
            $pedido = Pedido::find($request->cobrar[$i]);
            $pedido->pe_status = "EN CAMINO A COBRAR";
            $pedido->save();
        }

        $datos = [
            'destino' => $viaje->vi_destino,
            'id'      => $viaje->id_viaje,
            'fecha'   => $viaje->created_at,
        ];
        return view('Imprimir.ticket_viaje',['datos'=>$datos]);
    }

    //GASTOS EN VIAJE
    public function post_gastos(Request $request, $id){

        $gastos = new Gastos();
        $gastos->ga_nota       = $request->nota;
        $gastos->ga_importe    = $request->importe;
        $gastos->ga_concepto   = $request->concepto;
        $gastos->viaje_id      = $request->id;
        $gastos->save();
        
        return view('Viajes.Reporte');  
}

        public function post_finalizar_viaje(Request $request, $id){

            //TABLA VIAJE
            $viaje = Viaje::find($id);
            $viaje->vi_kilometraje_final        = $request->final;
            $viaje->vi_status                   = 1;
            $viaje->vi_observaciones            = $request->descripcion;
            $viaje->save();

            //TABLA ABONO_PEDIDO
            for ($i=0; $i < sizeof($request->abono) ; $i++) { 
                $this->AbonarPedidoCliente($request->id_pedido[$i], $request->abono[$i], $request->forma_pago[$i]);
            }

            //TABLA GASTOS
            for ($i=0; $i < sizeof($request->nota) ; $i++) { 

                $gastos = new Gastos();
                $gastos->ga_nota       = $request->nota[$i];
                $gastos->ga_concepto   = $request->concepto[$i];
                $gastos->ga_importe    = $request->importe[$i];
                $gastos->viaje_id      = $request->id;
                $gastos->save();
            }


        return redirect()->route('get_viaje_caja', $viaje->id_viaje);

    }
    
    // PRODUCCION
    public function post_pedido_produccion(Request $request){

        $produccion = new Produccion();
        $produccion->pr_memo       = $request->memo;
        $produccion->pr_productos  = collect($request->productos)->implode('|');
        if (sizeof($request->materiales) < 1) {
            $produccion->pr_materiales = collect($request->requisitos)->implode('|');
        } else {
            $produccion->pr_materiales = collect($request->materiales)->implode('|') . '|' . collect($request->requisitos)->implode('|');
        }
        $produccion->save();

        for ($i=0; $i < sizeof($request->pedidos); $i++) { 
            $produccion->pedidos()->attach($request->pedidos[$i]);
            $ped = Pedido::find($request->pedidos[$i]);
            $ped->pe_status = "EN PRODUCCION";
            $ped->save();
        }

        return redirect()->route('caja');
    }

    public function cancelacion_produccion($id){
        $produccion = Produccion::find($id);
        $produccion->pr_completo = "CANCELADO";
        $produccion->save();

        $produccion->pedidos->each(function($pedido,$pos){
            $pedido->pe_status = "PENDIENTE PARA PRODUCCION";
            $pedido->save();
        });

        return redirect()->route('caja');
    }

    public function finalizar_produccion(Request $request, $id){
        $produccion = Produccion::find($id);
        $produccion->pr_encargado = $request->encargado;
        $produccion->pr_ayudante  = $request->ayudante;
        $produccion->pr_turno     = $request->turno;
        $produccion->pr_completo  = "FINALIZADO";
        $produccion->save();

        $produccion->pedidos->each(function($pedido,$pos){
            $pedido->pe_status = "PREPARADO PARA ENTREGAR";
            $pedido->save();
        });

        for ($i=0; $i < sizeof($request->CantidadExcesos); $i++) { 
            $inv = new Inventario();
            $inv->producto_id   = $request->ProductosExcesos[$i];
            $inv->produccion_id = $id;
            $inv->in_cantidad   = $request->CantidadExcesos[$i];
            $inv->in_operacion  = "SUMA";
            $inv->save();
        }

        return redirect()->route('caja');
    }

    public function agregar_produccion(Request $request){

        $produccion = new Produccion();
        $produccion->pr_encargado = $request->encargado;
        $produccion->pr_ayudante  = $request->ayudante;
        $produccion->pr_turno     = $request->turno;
        $produccion->pr_completo  = "FINALIZADO";
        $produccion->pr_memo      = $request->memo;
        //$produccion->pr_fecha     = $request->fecha;
        $produccion->save();

        for ($i=0; $i < sizeof($request->CantidadExcesos); $i++) {
        $inv = new Inventario();
        $inv->producto_id   = $request->ProductosExcesos[$i];
        $inv->produccion_id = $produccion->id_produccion;
        $inv->in_memo       = $produccion->pr_memo;
        $inv->in_cantidad   = $request->CantidadExcesos[$i];
        $inv->in_operacion  = "SUMA";
        $inv->save();
        }

        return redirect()->route('caja');
    }

    // AJUSTE DE INVENTARIO
    public function ajuste_inventario(Request $request){

        for ($i=0; $i < sizeof($request->CantProducto); $i++) { 
            $inv = new Inventario();
            $inv->producto_id  = $request->AjusteProducto[$i];
            $inv->in_cantidad  = $request->CantProducto[$i];
            $inv->in_operacion = $request->OperacionProducto[$i];
            $inv->in_memo      = $request->memo;
            $inv->save();
        }

        for ($i=0; $i < sizeof($request->CantMaterial); $i++) { 
            $inv = new Inventario();
            $inv->mp_id        = $request->AjusteMaterial[$i];
            $inv->in_cantidad  = $request->CantMaterial[$i];
            $inv->in_operacion = $request->OperacionMaterial[$i];
            $inv->in_memo      = $request->memo;
            $inv->save();
        }

        return redirect()->route('caja');
    }

    //COBRANZA
    public function post_pago_pedido(Request $request){

        $v_pago  = $request->pago_total;

       for ($i = 0; $i < sizeof($request->pedidos); $i++) {

            /*$v_resto = $request->resto[$i];

            if ($v_resto <= $v_pago) {
                $this->AbonarPedidoCliente($request->pedidos[$i], $v_resto, $request->cuenta);
            } elseif ($v_pago > 0){
                $this->AbonarPedidoCliente($request->pedidos[$i], $v_pago, $request->cuenta);
            }

            $v_pago -= $v_resto;*/
            $this->AbonarPedidoCliente($request->pedidos[$i], $request->abono[$i], $request->cuenta);
        }

        return redirect()->route('caja');
    }

    public function post_pago_compra(Request $request){
        
        $v_pago  = $request->pago_total;

        for ($i = 0; $i < sizeof($request->compras); $i++) {

          /*  $v_resto = $request->resto[$i];

            if ($v_resto <= $v_pago) {
                $this->AbonarCompraProveedor($request->compras[$i], $v_resto, $request->cuenta);
            } elseif ($v_pago > 0){
                $this->AbonarCompraProveedor($request->compras[$i], $v_pago, $request->cuenta);
            }

            $v_pago -= $v_resto;*/
            $this->AbonarCompraProveedor($request->compras[$i], $request->abono[$i], $request->cuenta);
        }

        return redirect()->route('caja');
    }

    public function post_pago_prestamo(Request $request){
        
        $v_pago  = $request->pago_total;

        for ($i = 0; $i < sizeof($request->deudor); $i++) {

          /*  $v_resto = $request->resto[$i];

            if ($v_resto <= $v_pago) {
                $this->AbonarCompraProveedor($request->compras[$i], $v_resto, $request->cuenta);
            } elseif ($v_pago > 0){
                $this->AbonarCompraProveedor($request->compras[$i], $v_pago, $request->cuenta);
            }

            $v_pago -= $v_resto;*/
            $this->AbonarPrestamoEmpleado($request->deudor[$i], $request->abono[$i], $request->cuenta);
        }

        return redirect()->route('caja');
    }

    public function AbonarPrestamoEmpleado($id, $pago, $cuenta){

        $prestamo = Prestamo::find($id);
        //dd($id, $pago, $cuenta);
        $prestamo->pres_abonado += $pago;
        if (($prestamo->pres_abonado >= $prestamo->pres_cantidad) && $prestamo->pres_pago_status != "PAGADO") {
            $prestamo->pres_pago_status = "PAGADO";
        } elseif (($prestamo->pres_abonado < $prestamo->pres_cantidad) && $prestamo->pres_pago_status == "PENDIENTE"){
            $prestamo->pres_pago_status = "ABONADO";
        }
        $prestamo->save();

        $abono = new AbonoPrestamo();
        $abono->ab_abono    = $pago;
        $abono->ab_pago     = $cuenta;
        $abono->ab_numero   = $prestamo->abonos->count() + 1;
        $abono->empleado    = $id;
        $abono->save();

        return redirect()->route('caja');
    }

    // FUNCION RECICLABLES
    public function AbonarPedidoCliente($id, $pago, $cuenta){

        $pedido = Pedido::find($id);
        $pedido->pe_total_abonado += $pago;
        if (($pedido->pe_total_abonado >= $pedido->pe_importe) && $pedido->pe_pago_status != "PAGADO") {
            $pedido->pe_pago_status = "PAGADO";
        } elseif (($pedido->pe_total_abonado < $pedido->pe_importe) && $pedido->pe_pago_status == "PENDIENTE"){
            $pedido->pe_pago_status = "ABONADO";
        }
            //ACTUALIZA EL STATUS DEL PEDIDO
        $pedido->pe_status        = 'ENTREGADO';
        $pedido->save();

        $abonos = new AbonoPedido();
        $abonos->ap_abono     = $pago;
        $abonos->ap_numero    = $pedido->abonos->count() + 1;
        $abonos->pedido_id    = $id;
        $abonos->ap_pago      = $cuenta;
        $abonos->ap_folio     = $pedido->pe_nota;//AQUI QUE ONDA?
        $abonos->save();
    }

    public function AbonarCompraProveedor($id, $pago, $cuenta){

        $compra = Compra::find($id);
        $compra->cm_total_abonado += $pago;
        if (($compra->cm_total_abonado >= $compra->cm_total) && $compra->cm_status != "PAGADO") {
            $compra->cm_status = "PAGADO";
        } elseif (($compra->cm_total_abonado < $compra->cm_total) && $compra->cm_status == "PENDIENTE"){
            $compra->cm_status = "ABONADO";
        }
        $compra->save();

        $abonos = new AbonoCompra();
        $abonos->ab_abono     = $pago;
        $abonos->ab_numero    = $compra->abonos->count() + 1;
        $abonos->compra_id    = $id;
        $abonos->ab_pago      = $cuenta;
        //$abonos->ap_folio     = $pedido->pe_nota;//AQUI QUE ONDA?
        $abonos->save();
    }
}
