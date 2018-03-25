<?php

namespace pegaza\Http\Controllers;

use Illuminate\Http\Request;

use pegaza\Http\Requests;

use pegaza\Viaje;
use pegaza\Empleado;
use pegaza\Vehiculo;
use pegaza\Pedido;
use pegaza\Gastos;
use pegaza\Egresos;

class ViajeController extends Controller
{

    public function get_viaje($id){
        //dd($id);
        $via  = Viaje::find($id);
        
        return view('Viajes.Reporte')->with('viajes',$via);
    }
 

    public function get_viaje_caja($id){
        //dd($id);
        $via  = Viaje::find($id);
        
        return view('Viajes.Reporte_Caja')->with('viajes',$via);
    }

    public function get_egresos_viaje($id){
        //dd($id);
        $egre  = Egresos::find($id);
        
        return view('Viajes.Reporte_Caja')->with('egresos',$egre);
    }

}
