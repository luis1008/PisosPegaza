<?php

namespace pegaza\Http\Controllers;

use Illuminate\Http\Request;
use pegaza\Http\Requests;
use pegaza\Empleado; //Agregar Modelo
use pegaza\Documentos; //Agregar Modelo
use pegaza\MateriaPrima; //Agregar Modelo
use pegaza\Producto; //Agregar Modelo
use pegaza\Vehiculo; //Agregar Modelo
use pegaza\Cliente;
use pegaza\Domicilio;
use pegaza\Proveedor;
use pegaza\Contacto;
use pegaza\DocumentosCl;
use pegaza\Usuario;
use pegaza\Contrato;
use pegaza\Falla;

class CatalogoController extends Controller
{

    // CLIENTE
    public function cliente(){
        $cliente = Cliente::paginate(25);
        return view('Catalogo.cliente')->with('clientes',$cliente);
    }

    public function post_cliente(Request $request){
        if ($request->ajax()) {
            //Validar campos required
            $this->validate($request, [
                'rfc'             => 'required',
                'nombre'          => 'required',
                'correo'          => 'email',
                'telefono'        => 'required',
                'nombre_contacto' => 'required',
                'nombre_dueno'    => 'required',
                'forma_pago'      => 'required',
                'tipo'            => 'required',
                'termino'         => 'required',
                'calle'           => 'required',
                'colonia'         => 'required',
                'ciudad'          => 'required',
                'codigo_postal'   => 'required',
            ],[
                'rfc.required'              => 'EL CAMPO RFC ES OBLIGATORIO',
                'nombre.required'           => 'EL CAMPO NOMBRE ES OBLIGATORIO',
                'correo.email'              => 'EL CAMPO CORREO DEBE SER DE TIPO CORREO (@live.com, @gmail.com, @hotmail.com, etc.)',
                'telefono.required'         => 'EL CAMPO TELEFONO ES OBLIGATORIO',
                'nombre_contacto.required'  => 'EL CAMPO NOMBRE CONTACTO ES OBLIGATORIO',
                'nombre_dueno.required'     => 'EL CAMPO NOMBRE DUEÑO ES OBLIGATORIO',
                'forma_pago.required'       => 'EL CAMPO FORMA PAGO ES OBLIGATORIO',
                'tipo.required'             => 'EL CAMPO TIPO CLIENTE ES OBLIGATORIO',
                'termino.required'          => 'EL CAMPO TERMINO ES OBLIGATORIO',
                'calle.required'            => 'EL CAMPO CALLE ES OBLIGATORIO',
                'colonia.required'          => 'EL CAMPO COLONIA ES OBLIGATORIO',
                'ciudad.required'           => 'EL CAMPO CIUDAD ES OBLIGATORIO',
                'codigo_postal.required'    => 'EL CAMPO CODIGO POSTAL ES OBLIGATORIO',
            ]
            );
        }
        $cliente = new Cliente();
        //$cliente->cl_factura         = $request->factura;
        $cliente->cl_rfc             = $request->rfc;
        $cliente->cl_nombre          = $request->nombre;
        $cliente->cl_correo          = $request->correo;
        $cliente->cl_telefono        = $request->telefono;
        $cliente->cl_nombre_contacto = $request->nombre_contacto;
        $cliente->cl_nombre_dueno    = $request->nombre_dueno;
        $cliente->cl_forma_pago      = $request->forma_pago;
        $cliente->cl_tipo_cliente    = $request->tipo;
        $cliente->cl_termino_credito = $request->termino;
        $cliente->cl_observacion     = $request->observaciones;

        $cliente->save();
        
        for ($i=0; $i < sizeof($request->calle); $i++) { 
            $domicilio = new Domicilio();
            $domicilio->dom_calle         = $request->calle[$i];
            $domicilio->dom_colonia       = $request->colonia[$i];
            $domicilio->dom_ciudad        = $request->ciudad[$i];
            $domicilio->dom_codigo_postal = $request->codigo_postal[$i];
            $domicilio->cliente_id        = $cliente->id_cliente;
            $domicilio->save();
        }

        $documentos_cl =  new DocumentosCl();
        //Lado izquierdo son los campos del modelo que especifico y del lado derecho son los names de los inputs de la vista del formulario
        $documentos_cl->cliente_id             = $cliente->id_cliente;
        $documentos_cl->hacienda               = $request->check_hacienda;
        $documentos_cl->comprobante_domicilio  = $request->check_domicilio;
        $documentos_cl->ine                    = $request->check_ine;
        $documentos_cl->save();//Guarda los datos en la base
        

        if ($request->ajax()) {
            return response()->json("exito");
        } else {
            return redirect()->route('cliente');
        }
    }

    public function put_cliente(Request $request){

        $cliente = Cliente::find($request->cliente);
        $cliente->cl_status = $request->status;
        $cliente->save();

        return redirect()->route('cliente');

    }
     public function put_datos_cliente(Request $request,$id){
            //dd($request);
        $cli = Cliente::find($id);
        $cli->cl_correo          = $request->correo;
        $cli->cl_telefono        = $request->telefono;
        $cli->cl_nombre_contacto = $request->nombre_contacto;
        $cli->cl_forma_pago      = $request->forma_pago;
        $cli->cl_tipo_cliente    = $request->tipo;
        $cli->cl_termino_credito = $request->termino;
        $cli->cl_observacion     = $request->observaciones;
        $cli->save();

        for ($i=0; $i < sizeof($request->calle); $i++) { 
            $domicilio = new Domicilio();
            $domicilio->dom_calle         = $request->calle[$i];
            $domicilio->dom_colonia       = $request->colonia[$i];
            $domicilio->dom_ciudad        = $request->ciudad[$i];
            $domicilio->dom_codigo_postal = $request->codigo_postal[$i];
            $domicilio->cliente_id        = $cli->id_cliente;
            $domicilio->save();
        }


        return redirect()->route('cliente');

    }
    
    // MATERIA PRIMA
    public function mat_prima(){
        $mat_prima = MateriaPrima::paginate(25);
        return view('Catalogo.MateriaPrima')->with('mat_primas',$mat_prima);
    }

    public function post_mat_prima(Request $request){
        if ($request->ajax()) {
            //Validar campos required
            $this->validate($request, [
                'nombre'   => 'required',
                'cantidad' => 'required|numeric',
                'unidad' => 'required',
                'precio'   => 'required|min:2'
            ],[
                'nombre.required'   => 'EL CAMPO NOMBRE ES OBLIGATORIO',
                'precio.required'   => 'EL CAMPO PRECIO ES OBLIGATORIO',
                'cantidad.required' => 'EL CAMPO CANTIDAD ES OBLIGATORIO',
                'unidad.required'   => 'EL CAMPO UNIDAD ES OBLIGATORIO',
                'cantidad.numeric'  => 'EL CAMPO CANTIDAD DEBE CONTENER SOLO NUMEROS',
                'precio.min'        => 'EL CAMPO PRECIO DEBE SER MAYOR A CERO'
            ]
            );
        }
        $mat_prima = new MateriaPrima();
        $mat_prima->mp_nombre      = $request->nombre;
        $mat_prima->mp_cantidad    = $request->cantidad;
        $mat_prima->mp_unidad    = $request->unidad;
        $mat_prima->mp_precio      = $request->precio;
        $mat_prima->mp_observacion = ($request->observacion) ? $request->observacion : "NINGUNO";

        $mat_prima->save();//Guarda los datos en la base
        
        if ($request->ajax()) {
            return response()->json("exito");
        } else {
            return redirect()->route('mat_prima');//Lo redirecciona a la vista
        }
        
    }

    public function put_mat_prima(Request $request){

        $mat_prima = MateriaPrima::find($request->mat_prima);
        $mat_prima->mp_status = $request->status;
        $mat_prima->save();

        return redirect()->route('mat_prima');

    }
    
    // VEHICULO
    public function vehiculo(){
        $vehiculo = Vehiculo::paginate(25);
        return view('Catalogo.Vehiculo')->with('vehiculos',$vehiculo);
    }

    public function post_vehiculo(Request $request){
        //dd($request);
         //Lado izquierdo son los campos del modelo que especifico y del lado derecho son los names de los inputs de la vista del formulario
        $vehiculo = new Vehiculo();
        $vehiculo->placas                  = $request->placas;
        $vehiculo->vh_nombre               = $request->nombre;
        $vehiculo->vh_caracteristicas      = $request->caracteristicas;

        $vehiculo->save();//Guarda los datos en la base
        
        return redirect()->route('vehiculo');//Lo redirecciona a la vista
    }

    public function put_vehiculo(Request $request){

        $vehiculo = Vehiculo::find($request->vehiculo);
        $vehiculo->vh_status = $request->status;
        $vehiculo->save();

        return redirect()->route('vehiculo');

    }

    public function post_datos_vehiculo(Request $request){
        //dd($request);
        $falla = new Falla();
        $falla->placas              = $request->placas;
        $falla->fa_descripcion      = $request->descripcion;
        $falla->fa_lugar            = $request->lugar;
        $falla->fa_costo            = $request->costo;
        $falla->save();

        return redirect()->route('vehiculo');

    }


    // PRODUCTO
    public function producto(){
        $producto = Producto::paginate(25);
        return view('Catalogo.Producto')->with('productos',$producto);
    }

    public function post_producto(Request $request){
        //dd($request->cantidad);
        $producto = new Producto();
        $producto->pd_nombre        = $request->nombre;
        $producto->pd_tipo          = $request->tipo;
        $producto->pd_cantidad      = $request->cantidad;
        $producto->pd_costo         = $request->costo;
        $producto->pd_precio_venta  = $request->precio_venta;
        $producto->save();
        
        //Guardar Tabla detalle
        for ($i=0; $i < sizeof($request->cantidad); $i++) { 
            $producto->materiasprimas()->attach($request->material[$i], ['det_cantidad'=>$request->cantidad[$i],'det_precio'=>$request->precio[$i],'det_subtotal'=>$request->subtotal[$i]]);
        }
        return redirect()->route('producto');//Lo redirecciona a la vista
    }

    public function put_producto(Request $request){

        $producto = Producto::find($request->producto);
        $producto->pd_status = $request->status;
        $producto->save();

        return redirect()->route('producto');

    }

    // PROVEEDOR
    public function proveedor(){
        $proveedor = Proveedor::paginate(25);
        return view('Catalogo.proveedor')->with('proveedores',$proveedor);
    }

    public function post_proveedor(Request $request){
        //dd($request);
        if ($request->ajax()) {
            //Validar campos required
            $this->validate($request, [
                'nombre'    => 'required',
                'domicilio' => 'required',
                'correo'    => 'email',
                'rfc'       => 'unique:proveedor,pv_rfc',
                'contacto'  => 'required',
                'telefono'  => 'required'
            ],[
                'nombre.required'    => 'EL CAMPO NOMBRE ES OBLIGATORIO',
                'domicilio.required' => 'EL CAMPO DOMICILIO ES OBLIGATORIO',
                'contacto.required'  => 'EL CAMPO CONTACTO ES OBLIGATORIO',
                'telefono.required'  => 'EL CAMPO TELEFONO ES OBLIGATORIO',
                'rfc.unique'         => 'LA RFC QUE SE INGRESO YA EXISTE EN OTRO PROVEEDOR',
                'correo.email'       => 'EL CAMPO CORREO DEBE SER DE TIPO CORREO (@live.com, @gmail.com, @hotmail.com, etc.)'
            ]
            );
        }
        $proveedor = new Proveedor();
        $proveedor->pv_nombre     = $request->nombre;
        $proveedor->pv_domicilio  = $request->domicilio;
        $proveedor->pv_correo     = ($request->correo) ? $request->correo : "NO TIENE";
        $proveedor->pv_ciudad     = $request->ciudad;
        $proveedor->pv_rfc        = ($request->rfc != "") ? $request->rfc : NULL;
        $proveedor->pv_correo     = $request->correo;

        $proveedor->save();
        
        for ($i=0; $i < sizeof($request->contacto); $i++) { 
            $contacto = new Contacto();
            $contacto->cn_nombre         = $request->contacto[$i];
            $contacto->cn_telefono       = $request->telefono[$i];
            $contacto->proveedor_id      = $proveedor->id_proveedor;
            $contacto->save();
        }

        if ($request->ajax()) {
            return response()->json("exito");
        }else {
            return redirect()->route('proveedor');
        }
    }


     public function put_proveedor(Request $request){
        //dd($request);
        $prov = Proveedor::find($request->proveedor);
        $prov->pv_status = $request->status;
        $prov->save();

        return redirect()->route('proveedor');

    }

    public function put_datos_proveedor(Request $request,$id){
        //dd($request);
        $prove = Proveedor::find($id);
        $prove->pv_correo     = ($request->correo) ? $request->correo : "NO TIENE";
        $prove->pv_domicilio  = $request->domicilio;
        $prove->pv_ciudad     = $request->ciudad;
        $prove->save();

        for ($i=0; $i < sizeof($request->contacto); $i++) { 
            $contacto = new Contacto();
            $contacto->cn_nombre         = $request->contacto[$i];
            $contacto->cn_telefono       = $request->telefono[$i];
            $contacto->proveedor_id      = $prove->id_proveedor;
            $contacto->save();
        }

        return redirect()->route('proveedor');

    }

    // EMPLEADO

    public function empleado(){
        $empleado = Empleado::paginate(25);
        return view('Catalogo.empleado')->with('empleados',$empleado);
    }

    public function post_empleado(Request $request){
        //dd($request);
         $this->validate($request, [
                'password'    => 'confirmed'
            ],[
                'password.confirmed'    => 'NO COINCIDEN LAS CONTRASEÑAS!'
            ]
            );
        $empleado =  new Empleado();
        //Lado izquierdo son los campos del modelo que especifico y del lado derecho son los names de los inputs de la vista del formulario
        $empleado->em_nombre            = $request->nombre;
        $empleado->em_curp              = $request->curp;
        $empleado->em_num_seg_social    = $request->seg_social;
        $empleado->em_fecha_inicio      = $request->fecha_inicio;  
        $empleado->em_fecha_final       = $request->fecha_final;
        $empleado->em_num_licencia      = $request->num_licencia;
        $empleado->em_vigencia_licencia = $request->vigencia_licencia;
        $empleado->em_tipo              = $request->tipo;
        $empleado->save();//Guarda los datos en la base
    
        //DOBLE INSERCION

        $documentos =  new Documentos();
        //Lado izquierdo son los campos del modelo que especifico y del lado derecho son los names de los inputs de la vista del formulario
        $documentos->empleado_id            = $empleado->id_empleado;
        $documentos->acta_nacimiento        = $request->check_nacimiento;
        $documentos->comprobante_domicilio  = $request->check_domicilio;
        $documentos->seguro_social          = $request->check_seguro;
        $documentos->curp                   = $request->check_curp;
        $documentos->ine                    = $request->check_ine;
        $documentos->licencia_conducir      = $request->check_licencia;
        $documentos->save();//Guarda los datos en la base

        //INSERCION A USUARIOS

         $usuarios =  new Usuario();
        //Lado izquierdo son los campos del modelo que especifico y del lado derecho son los names de los inputs de la vista del formulario
        $usuarios->empleado_id = $empleado->id_empleado;
        $usuarios->perfil      = $request->perfil;
        $usuarios->usuario     = $request->usuario;
        $usuarios->password    = bcrypt ($request->password);
        $usuarios->save();//Guarda los datos en la base

        //INSERCION A CONTRATOS
        if ($request->tipo == 'CONTRATO') {
            $contrato =  new Contrato();
            //Lado izquierdo son los campos del modelo que especifico y del lado derecho son los names de los inputs de la vista del formulario
            $contrato->empleado_id          = $empleado->id_empleado;
            $contrato->cont_fecha_inicio    = $empleado->em_fecha_inicio;
            $contrato->cont_fecha_fin       = $empleado->em_fecha_final;
            $contrato->save();//Guarda los datos en la base


        }else{
            return redirect()->route('empleado');
        }
        return redirect()->route('empleado');
    }

    public function put_empleado(Request $request){
        //dd($request);
        $emp = Empleado::find($request->empleado);
        $emp->em_status = $request->status;
        $emp->save();

        return redirect()->route('empleado');

    }

       public function put_datos_empleado(Request $request,$id){
        //dd($request);
        $emp = Empleado::find($id);
            $emp->em_fecha_inicio      = $request->fecha_inicio;  
            $emp->em_fecha_final       = $request->fecha_final;
            $emp->em_num_licencia      = $request->num_licencia;
            $emp->em_vigencia_licencia = $request->vigencia_licencia;
            $emp->em_tipo              = $request->tipo;
            $emp->save();

        $documentos =  new Documentos();

            $documentos->comprobante_domicilio  = $request->check_domicilio;
            $documentos->licencia_conducir      = $request->check_licencia;
            $documentos->save();//Guarda los datos en la base


        return redirect()->route('empleado');

    }

    
}