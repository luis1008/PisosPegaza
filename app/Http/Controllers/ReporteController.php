<?php

namespace pegaza\Http\Controllers;

use Illuminate\Http\Request;
use pegaza\Compra;
use pegaza\Pedido;
use pegaza\Produccion;

use pegaza\Http\Requests;

class ReporteController extends Controller
{
	public function get_pedidos(){
        //dd($id);
        $ped = Pedido::where('pe_status','=','ENTREGADO')->get();
        
        return view('Reportes.ReporteCobranza')->with('pedidos',$ped);
    }

    public function get_compras(){
        //dd($id);
        $com = Compra::all();
        
        return view('Reportes.ReporteCompras')->with('compras',$com);
    }

    	public function get_produccion(){
        //dd($id);
        $prod = Produccion::where('pr_completo','=','FINALIZADO')->get();
        
        return view('Reportes.ReporteProduccion')->with('producciones',$prod);
    }
}
