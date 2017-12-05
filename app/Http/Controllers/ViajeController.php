<?php

namespace pegaza\Http\Controllers;

use Illuminate\Http\Request;

use pegaza\Http\Requests;

use pegaza\Viaje;
use pegaza\Empleado;
use pegaza\Vehiculo;

class ViajeController extends Controller
{

     public function get_viaje($id){
        //dd($id);
        $via  = Viaje::find($id);
        
        return view('Viajes.Reporte')->with('viajes',$via);
    }
}