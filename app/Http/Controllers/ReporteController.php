<?php

namespace pegaza\Http\Controllers;

use Illuminate\Http\Request;
use pegaza\Compra;
use pegaza\Pedido;
use pegaza\Produccion;
use pegaza\Prestamo;
use pegaza\AbonoPedido;
use pegaza\Gastos;
use pegaza\Inventario;
use pegaza\MovimientoTemporal;

use pegaza\Http\Requests;

class ReporteController extends Controller
{

	public function get_pedidos(Request $request){
        //dd($id);

        $ped = Pedido::Fechas($request->inicial, $request->final)->where('pe_pago_status','!=','PAGADO')->get();
        
        return view('Reportes.ReporteCobranza')->with('pedidos',$ped);
    }

    public function get_cuentas(Request $request){
        //dd($id);

        $cuent = AbonoPedido::Fechas($request->inicial, $request->final)->get();
        
        return view('Reportes.ReporteCuentas')->with('cuentas',$cuent);
    }
    public function get_egresos(Request $request){
        //dd($id);

        $gasto = Gastos::Fechas($request->inicial, $request->final)->get();
        
        return view('Reportes.ReporteEgresos')->with('gastos',$gasto);
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

        public function get_inventario(Request $request){
        //dd($id);
        $inv = Inventario::Fechas($request->inicial, $request->final)->SUM('in_cantidad')->GROUPBY('producto_id')->get();
        
        return view('Reportes.ReporteInventario')->with('inventarios',$inv);
    }

     public function get_pedido_entregado(Request $request){
        //dd($id);
         $ped = Pedido::Fechas($request->inicial, $request->final)->where('pe_status','=','ENTREGADO')->get();
        
        return view('Reportes.ReportePedidos')->with('pedidos',$ped);
    }

      public function get_prestamo(Request $request){
        //dd($id);
         $pres = Prestamo::Fechas($request->inicial, $request->final)->where('pres_status','=','APROBADO')->get();
        
        return view('Reportes.ReportePrestamo')->with('prestamos',$pres);
    }
}
