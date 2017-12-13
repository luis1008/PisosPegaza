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

class AjaxController extends Controller
{
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

    public function GetKilometrajeFinal(Request $request){
        if ($request->ajax()) {
            $viaje = Viaje::select('vi_kilometraje_final')->where('vehiculo_id',$request->placa)->orderBy('id_viaje','DESC')->first();
            $kilometraje = ($viaje) ? $viaje->vi_kilometraje_final : 0;
            return response()->json($kilometraje);
        }
    }

    public function GetProducto(Request $request){
        if ($request->ajax()) {
            $pd = Producto::where('pd_status','=','1')->orderBy('pd_nombre')->get();
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

    public function SetCuentas(Request $request){
        if ($request->ajax()) {
            //Validar campos required
            $this->validate($request, ['nombre' => 'required'],['nombre.required' => 'EL CAMPO NOMBRE ES OBLIGATORIO']);
            // INSERTAR NUEVA CUENTA
            $cue = new Cuenta();
            $cue->ct_nombre = $request->nombre;
            $cue->save();

            return response()->json("exito");
        }
    }

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
