<?php

namespace pegaza\Http\Controllers;

use Illuminate\Http\Request;

use pegaza\Http\Requests;

class LoginController extends Controller
{
    public function autentificar(Request $request){
    	if (\Auth::guard('web')->attempt(['usuario' => $request->usuario, 'password' => $request->password])) {
    		if(\Auth::user()->us_status){
    			return redirect()->route('caja');
    		}
    	} 
    	return redirect()->route('login')->withErrors('Usuario/Contraseña Incorrecta');
    }

    public function logout(){
    	\Auth::logout();
    	return redirect()->route('login');
    }
}
