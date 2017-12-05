<?php

namespace pegaza\Http\Controllers;

use Illuminate\Http\Request;

use pegaza\Http\Requests;

class CobranzaController extends Controller
{
    public function reporte_viaje(/*$id*/){
    	return view('Viajes.Reporte');
    }
}
