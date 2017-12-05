<?php

namespace pegaza;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Auth\Authenticatable;
//use Illuminate\Foundation\Auth\Access\Authorizable;
//use Illuminate\Auth\Passwords\CanResetPassword;
//use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
//use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Usuario extends Authenticatable
{
    //use Authenticatable;
    protected $table      = "usuario";
    
    protected $primaryKey = "id_usuario";
    
    protected $fillable   = ['empleado_id',
                             'perfil',   
                             'usuario', 
                             'us_status', 
                             'password'];

    public function empleado(){
    	return $this->belongsTo('pegaza\Empleado','empleado_id');
    }
}
