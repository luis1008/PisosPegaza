<?php

namespace pegaza\Http\Controllers;

use Illuminate\Http\Request;
use pegaza\Compra;
use pegaza\Pedido;
use pegaza\Produccion;
use pegaza\Prestamo;

use pegaza\Http\Requests;

class ReporteController extends Controller
{
	public function get_pedidos(Request $request){
        //dd($id);

        $ped = Pedido::Fechas($request->inicial, $request->final)->where('pe_status','=','EN CAMINO A COBRAR')->get();
        
        return view('Reportes.ReporteCobranza')->with('pedidos',$ped);
    }

    public function get_compras(Request $request){
        //dd($id);
        $com = Compra::Fechas($request->inicial, $request->final)->where('cm_bodega','=','1')->get();
        
        return view('Reportes.ReporteCompras')->with('compras',$com);
    }

    public function get_caja(Request $request){
        //dd($id);
        $caja = Pedido::Fechas($request->inicial, $request->final)->where('pe_pago_status','!=','PENDIENTE')->get();

        return view('Reportes.ReporteCaja')->with('cajas',$caja);
    }

    	public function get_produccion(Request $request){
        //dd($id);
        $prod = Produccion::Fechas($request->inicial, $request->final)->where('pr_completo','=','FINALIZADO')->get();
        
        return view('Reportes.ReporteProduccion')->with('producciones',$prod);
    }
}
