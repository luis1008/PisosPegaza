<?php

namespace pegaza\Http\Controllers;

use Illuminate\Http\Request;

use pegaza\Http\Requests;
use pegaza\MateriaPrima;
use pegaza\Proveedor;
use pegaza\Cuenta;
use pegaza\Producto;
use pegaza\Pedido;
use pegaza\Cliente;
use pegaza\Viaje;
use pegaza\Domicilio;
use pegaza\Compra;
use pegaza\Contacto;
use pegaza\Prestamo;
use pegaza\Gasto;
use pegaza\Empleado;

class AjaxController extends Controller
{
    public function SetEliminacionDomicilioCliente(Request $request){
        if ($request->ajax()) {
            $dom = Domicilio::find($request->id);
            $dom->dom_status = !$dom->dom_status;
            $dom->save();
            return response()->json("OK");
        }
    }

    public function SetEliminacionContactoProveedor(Request $request){
        if ($request->ajax()) {
            $cn = Contacto::find($request->id);
            $cn->cn_status = !$cn->cn_status;
            $cn->save();
            return response()->json("OK");
        }
    }

    public function GetPedidosPendientesPago(Request $request){
        if ($request->ajax()) {
            $pedidos = Pedido::where('cliente_id','=',$request->id)->where('pe_pago_status','!=','PAGADO')->where('pe_status','=','ENTREGADO')->orderBy('pe_fecha_pedido')->groupBy('cliente_id')->get();
            return response()->json($pedidos);
        }
    }

    public function GetComprasPendientesPago(Request $request){
        if ($request->ajax()) {
            $compras = Compra::where('proveedor_id','=',$request->id)->where('cm_status','!=','PAGADO')->get();
            return response()->json($compras);
        }
    }

    public function GetPrestamosPendientes(Request $request){
        if ($request->ajax()) {
            $prestamos = Prestamo::where('empleado_id','=',$request->id)->where('pres_status','=','APROBADO')->get();
            return response()->json($prestamos);
        }
    }

    public function GetImporteCompra(Request $request){
        if ($request->ajax()) {
            $importe = Compra::find($request->id);
            return response()->json($importe->cm_total);
        }
    }

    public function GetMateriaPrima(Request $request){
        if ($request->ajax()) {
            $mp = MateriaPrima::where('mp_status','=','1')->orderBy('mp_nombre','mp_cantidad','mp_unidad')->get();
            return response()->json($mp);
        }
    }

    public function GetConcepto(Request $request){
        if ($request->ajax()) {
            $gas = Gasto::where('ga_status','=','1')->orderBy('ga_concepto')->get();
            return response()->json($gas);
        }
    }

    public function GetProductoInventario(Request $request){
         if ($request->ajax()) {
            $pd = Producto::where('pd_status','=','1')->orderBy('pd_nombre')->get();
            return response()->json($pd);
        }
    }

    public function GetKilometrajeFinal(Request $request){
        if ($request->ajax()) {
            $viaje = Viaje::select('vi_kilometraje_final')->where('vehiculo_id',$request->placa)->orderBy('id_viaje','DESC')->first();
            $kilometraje = ($viaje) ? $viaje->vi_kilometraje_final : 0;
            return response()->json($kilometraje);
        }
    }

    public function GetProducto(Request $request){
        if ($request->ajax()) {
            $pd = Producto::where('pd_tipo','=','ENSAMBLADO')->where('pd_status','=','1')->orderBy('pd_nombre')->get();
            return response()->json($pd);
        }
    }

    public function GetProductoNoEnsamblado(Request $request){
        if ($request->ajax()) {
            $pd = Producto::where('pd_tipo','=','NO ENSAMBLADO')->where('pd_status','=','1')->orderBy('pd_nombre')->get();
            return response()->json($pd);
        }
    }

    public function GetDomicilioCliente(Request $request){
        if ($request->ajax()) {
            $cl = Cliente::find($request->id);
            //$mp = $mp->mp_precio;
            return response()->json($cl->domicilios);
        }
    }

    public function GetPrecioMateriaPrimaSelected(Request $request){
        if ($request->ajax()) {
            $mp = MateriaPrima::find($request->id);
            //$mp = $mp->mp_precio;
            return response()->json($mp);
        }
    }

    public function GetPrecioProductoSelected(Request $request){
        if ($request->ajax()) {
            $pd = Producto::find($request->id);
            //$mp = $mp->mp_precio;
            return response()->json($pd);
        }
    }

    public function GetPrecioUltimaCompra(Request $request){
        if ($request->ajax()) {
            if ($request->tipo == "material") {
                $consulta = \DB::table('compra_mp')->select('det_precio')->where('mp_id','=',$request->id)->orderBy('id_detalle','DESC')->first();
            } else {
                $consulta = \DB::table('compra_cuentas')->select('det_precio')->where('cuentas_id','=',$request->id)->orderBy('id_detalle','DESC')->first();
            }

            $precio_base = MateriaPrima::find($request->id);

            $consulta = ($consulta) ? $consulta->det_precio : $precio_base->mp_precio;
            
            return response()->json($consulta);
        }
    }


    public function GetPrecioUltimaVenta(Request $request){
        if ($request->ajax()) {
            
                 $consulta = \DB::table('detalle_pedido')->select('det_prod_precio')->where('producto_id','=',$request->id)->orderBy('id_det_pedido','DESC')->first();    

            $precio_base = Producto::find($request->id);

            $consulta = ($consulta) ? $consulta->det_prod_precio : $precio_base->pd_precio_venta;
            
            return response()->json($consulta);
        }
    }

    public function GetProveedor(Request $request){
        if ($request->ajax()) {
            $prov = Proveedor::where('pv_status','=','1')->orderBy('pv_nombre')->get();
            return response()->json($prov);
        }
    }

    public function GetEmpleado(Request $request){
        if ($request->ajax()) {
            $emp = Empleado::where('em_status','=','1')->orderBy('em_nombre')->get();
            return response()->json($emp);
        }
    }

    public function SetEmpleado(Request $request){
        if ($request->ajax()) {
            //Validar campos required
            $this->validate($request, ['nombre' => 'required','telefono' => 'required'],['nombre.required' => 'EL CAMPO NOMBRE ES OBLIGATORIO', 'telefono.required' => 'EL CAMPO TELEFONO ES OBLIGATORIO']);
            // INSERTAR NUEVA CUENTA
            $emp = new Empleado();
            $emp->em_nombre    = $request->nombre;
            $emp->em_telefono  = $request->telefono;
            $emp->save();

            return response()->json("exito");
        }
    }

    public function GetCliente(Request $request){
        if ($request->ajax()) {
            $cli = Cliente::where('cl_status','=','1')->orderBy('cl_nombre')->get();
            return response()->json($cli);
        }
    }

    public function GetClienteSelected(Request $request){
        if ($request->ajax()) {
            $cli = Cliente::find($request->id);
            return response()->json($cli);
        }
    }

    /*public function SetCuentas(Request $request){
        if ($request->ajax()) {
            //Validar campos required
            $this->validate($request, ['nombre' => 'required'],['nombre.required' => 'EL CAMPO NOMBRE ES OBLIGATORIO']);
            // INSERTAR NUEVA CUENTA
            $cue = new Cuenta();
            $cue->ct_nombre = $request->nombre;
            $cue->save();

            return response()->json("exito");
        }
    }*/

    public function SetDomicilios(Request $request){
        if ($request->ajax()) {
            //Validar campos required
            $this->validate($request, 
                [
                    'id'            => 'required',
                    'calle'         => 'required',
                    'colonia'       => 'required',
                    'ciudad'        => 'required',
                    'codigo_postal' => 'required'
                ],
                [
                    'id.required'               => 'EL CAMPO CLIENTE ES OBLIGATORIO',
                    'calle.required'            => 'EL CAMPO CALLE ES OBLIGATORIO',
                    'colonia.required'          => 'EL CAMPO COLONIA ES OBLIGATORIO',
                    'ciudad.required'           => 'EL CAMPO CIUDAD ES OBLIGATORIO',
                    'codigo_postal.required'    => 'EL CAMPO CODIGO POSTAL ES OBLIGATORIO'
                ]);
            // INSERTAR NUEVA CUENTA
            $dom = new Domicilio();
            $dom->dom_calle         = $request->calle;
            $dom->dom_colonia       = $request->colonia;
            $dom->dom_ciudad        = $request->ciudad;
            $dom->dom_codigo_postal = $request->codigo_postal;
            $dom->cliente_id        = $request->id;
            $dom->save();

            return response()->json("exito");
        }
    }

    public function GetCuentas(Request $request){
        if ($request->ajax()) {
            
            $cuentas = Cuenta::all();
            return response()->json($cuentas);

        }
    }
}
