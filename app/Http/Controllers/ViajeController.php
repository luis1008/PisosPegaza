<?php

namespace pegaza\Http\Controllers;

use Illuminate\Http\Request;

use pegaza\Http\Requests;

use pegaza\Viaje;
use pegaza\Empleado;
use pegaza\Vehiculo;
use pegaza\Pedido;
use pegaza\Gastos;
use pegaza\CatGastos;

class ViajeController extends Controller
{

    public function get_viaje($id){
        //dd($id);
        $via  = Viaje::find($id);
        $gast = CatGastos::where('catga_status','=','1')->orderBy('catga_gastos')->get();
        
        return view('Viajes.Reporte')->with('viajes',$via)
                                     ->with('gastos',$gast);
    }
 

    public function get_viaje_caja($id){
        //dd($id);
        $via  = Viaje::find($id);
        $gasto  = Gastos::find($id);
        
        return view('Viajes.Reporte_Caja')->with('viajes',$via)
                                          ->with('gastos',$gasto);
    }

    /*public function get_gastos_viaje($id){
        dd($id);
        $gasto  = Gastos::find($id);
        
        return view('Viajes.Reporte_Caja')->with('gastos',$gasto);
    }*/

}
