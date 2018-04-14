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
use pegaza\Cuenta;
use pegaza\Contacto;
use pegaza\DocumentosCl;
use pegaza\Usuario;
use pegaza\Contrato;
use pegaza\Falla;
use pegaza\Gastos;

class CatalogoController extends Controller
{

    // CLIENTE
    public function cliente(){
        $cliente = Cliente::paginate(25);
        return view('Catalogo.cliente')->with('clientes',$cliente);
    }

    public function post_cliente(Request $request){
            //Validar campos required
            $this->validate($request, [
                'rfc' => 'unique:cliente,cl_rfc',
                'correo'          => 'email',
            ],[
                'correo.email'    => 'EL CAMPO CORREO DEBE SER DE TIPO CORREO (@live.com, @gmail.com, @hotmail.com, etc.)',

                'rfc.unique'         => 'EL RFC YA EXISTE CON OTRO CLIENTE. 
                                        REGISTRO NO INSERTADO. 
                                        REGISTRELO NUEVAMENTE.',
            ]
            );
            
        $cliente = new Cliente();
        if (trim($request->rfc)!="") {
        $cliente->cl_rfc             = $request->rfc; 
        }
        //$cliente->cl_factura         = $request->factura;
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

    public function put_cliente($id){

        $cliente = Cliente::find($id);
        $cliente->cl_status = !$cliente->cl_status;
        $cliente->save();

        return redirect()->route('cliente');

    }
    
    public function put_datos_cliente(Request $request,$id){
        //dd($request);
        $cli = Cliente::find($id);
        if ($cli->cl_correo != $request->correo) {
            $this->validate($request, [
                    'correo'    => 'email|unique:cliente,cl_correo'
                ],[
                    'correo.email'  => 'EL CAMPO CORREO DEBE SER DE TIPO CORREO (@live.com, @gmail.com, @hotmail.com, etc.)',
                    'correo.unique' => 'EL CORREO YA EXISTE'
                ]);
            $cli->cl_correo  = $request->correo;
        }
        $cli->cl_telefono        = $request->telefono;
        $cli->cl_nombre_contacto = $request->nombre_contacto;
        $cli->cl_forma_pago      = $request->forma_pago;
        $cli->cl_tipo_cliente    = $request->tipo;
        $cli->cl_termino_credito = $request->termino;
        $cli->cl_observacion     = $request->observaciones;
        $cli->save();

        return redirect()->route('cliente');

    }

    public function add_domicilio_cliente(Request $request, $id){
        
        $domicilio = new Domicilio();
        $domicilio->dom_calle         = $request->calle;
        $domicilio->dom_colonia       = $request->colonia;
        $domicilio->dom_ciudad        = $request->ciudad;
        $domicilio->dom_codigo_postal = $request->codigo_postal;
        $domicilio->cliente_id        = $id;
        $domicilio->save();
        
        return redirect()->route('cliente');
    }

    // CUENTA
    public function cuentas(){
        $cuentas = Cuenta::paginate(25);
        return view('Catalogo.cuentas')->with('cuentas',$cuentas);
    }

    public function post_cuenta(Request $request){

        $cuenta = new Cuenta();
        $cuenta->ct_nombre = $request->nombre;
        $cuenta->save();
        
        return redirect()->route('cuentas');
        
    }

    public function put_cuenta($id){

        $cuenta = Cuenta::find($id);
        $cuenta->ct_status = !$cuenta->ct_status;
        $cuenta->save();

        return redirect()->route('cuentas');

    }

    public function put_datos_cuenta(Request $request, $id){

        $cuenta = Cuenta::find($id);
        $cuenta->ct_nombre = $request->nombre;
        $cuenta->save();

        return redirect()->route('cuentas');

    }

    
            //GASTOS
        public function gastos(Request $request){
        $gasto = Gastos::paginate(25);
        return view('Catalogo.gastos')->with('gastos',$gasto);
    }

    public function post_gasto(Request $request){
        //Lado izquierdo son los campos del modelo que especifico y del lado derecho son los names de los inputs de la vista del formulario
        $gastos =  new Gastos();

        $gastos->ga_concepto = $request->concepto;
        $gastos->save();

        return redirect()->route('gastos');
    }

    public function put_gasto($id){

        $gastos = Gastos::find($id);
        $gastos->ga_status = !$gastos->ga_status;
        $gastos->save();

        return redirect()->route('gastos');

    }

    public function put_datos_gasto(Request $request, $id){

        $gastos = Gastos::find($id);
        $gastos->ga_concepto = $request->concepto;
        $gastos->save();

        return redirect()->route('gastos');

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

    public function put_mat_prima($id){

        $mat_prima = MateriaPrima::find($id);
        $mat_prima->mp_status = !$mat_prima->mp_status;
        $mat_prima->save();

        return redirect()->route('mat_prima');

    }

    public function put_datos_mat_prima(Request $request, $id){

        $mat_prima = MateriaPrima::find($id);
        $mat_prima->mp_nombre      = $request->nombre;
        //$mat_prima->mp_cantidad    = $request->cantidad;
        $mat_prima->mp_unidad      = $request->unidad;
        $mat_prima->mp_precio      = $request->precio;
        $mat_prima->mp_observacion = $request->observacion;

        $mat_prima->save();

        return redirect()->route('mat_prima');

    }
    
    // VEHICULO
    public function vehiculo(){
        $vehiculo = Vehiculo::paginate(25);
        return view('Catalogo.Vehiculo')->with('vehiculos',$vehiculo);
    }

    public function post_vehiculo(Request $request){
        
        $vehiculo = new Vehiculo();
        $vehiculo->placas             = $request->placas;
        $vehiculo->vh_nombre          = $request->nombre;
        $vehiculo->vh_caracteristicas = $request->caracteristicas;

        $vehiculo->save();
        
        return redirect()->route('vehiculo');
    }

    public function add_fallas_vehiculo(Request $request, $id){
        
        $vehiculo = new Falla();
        $vehiculo->placas         = $id;
        $vehiculo->fa_descripcion = $request->descripcion;
        $vehiculo->fa_lugar       = $request->lugar;
        $vehiculo->fa_costo       = $request->costo;

        $vehiculo->save();
        
        return redirect()->route('vehiculo');
    }

    public function put_vehiculo($id){

        $vehiculo = Vehiculo::find($id);
        $vehiculo->vh_status = !$vehiculo->vh_status;
        $vehiculo->save();

        return redirect()->route('vehiculo');

    }

    public function put_datos_vehiculo(Request $request, $id){
        
        $vehiculo = Vehiculo::find($id);
        $vehiculo->vh_nombre          = $request->nombre;
        $vehiculo->vh_caracteristicas = $request->caracteristicas;

        $vehiculo->save();

        return redirect()->route('vehiculo');
    }

    public function view_fallas(Request $request, $placas){
        $vehiculo = Vehiculo::find($placas);
        $falla    = Falla::where('placas','=',$placas)->Fechas($request->inicial,$request->final)->orderBy('created_at')->get();
        return view('Catalogo.fallas')->with('vehiculo', $vehiculo)->with('fallas', $falla);
    }

    // PRODUCTO
    public function producto(){
        $producto = Producto::paginate(25);
        $materiales = MateriaPrima::where('mp_status', 1)->get();
        return view('Catalogo.Producto')->with('productos',$producto)->with('materiales',$materiales);
    }

    public function post_producto(Request $request){
        
        $producto = new Producto();
        $producto->pd_nombre        = $request->nombre;
        $producto->pd_tipo          = $request->tipo;
        $producto->pd_cantidad      = $request->cantidad_unidad;
        $producto->pd_costo         = $request->costo;
        $producto->pd_precio_venta  = $request->precio_venta;
        $producto->save();
        
        //Guardar Tabla detalle -> Materia Prima
        for ($i=0; $i < sizeof($request->cantidad); $i++) { 
            $producto->materiasprimas()->attach($request->material[$i], ['det_cantidad'=>$request->cantidad[$i],'det_precio'=>$request->precio[$i],'det_subtotal'=>$request->subtotal[$i]]);
        }

        //Guardar Tabla detalle -> Producto
        for ($i=0; $i < sizeof($request->cantidad_producto); $i++) { 
            $producto->productos()->attach($request->productos[$i], ['det_pd_cantidad'=>$request->cantidad_producto[$i],'det_pd_precio'=>$request->precio_producto[$i],'det_pd_subtotal'=>$request->subtotal_producto[$i]]);
        }

        return redirect()->route('producto');
    }

    public function post_agregar_material(Request $request, $id){
        //dd($request);
        $producto = Producto::find($id);

        //Guardar Tabla detalle -> Materia Prima
        for ($i=0; $i < sizeof($request->cantidad); $i++) { 
            $producto->materiasprimas()->attach($request->material[$i], ['det_cantidad'=>$request->cantidad[$i],'det_precio'=>$request->precio[$i],'det_subtotal'=>$request->subtotal[$i]]);
        }
         return redirect()->route('producto');
    }

    public function put_datos_producto(Request $request, $id){
        
        $producto = Producto::find($id);
        $producto->pd_nombre        = $request->nombre;
        $producto->pd_costo         = $request->costo;
        $producto->pd_precio_venta  = $request->precio_venta;
        $producto->save();
        
        return redirect()->route('producto');
    }

    public function put_producto($id){

        $producto = Producto::find($id);
        $producto->pd_status = !$producto->pd_status;
        $producto->save();

        return redirect()->route('producto');

    }

    public function post_requisitos(Request $request, $id){
        //dd($request);
        $producto = Producto::find($id);
        // Vacias Tablas 
        $producto->materiasprimas()->detach();
        $producto->productos()->detach();

        //Guardar Tabla detalle -> Materia Prima
        for ($i=0; $i < sizeof($request->cantidad); $i++) { 
            $producto->materiasprimas()->attach($request->material[$i], ['det_cantidad'=>$request->cantidad[$i],'det_precio'=>$request->precio[$i],'det_subtotal'=>$request->subtotal[$i]]);
        }

        //Guardar Tabla detalle -> Producto
        for ($i=0; $i < sizeof($request->cantidad_producto); $i++) { 
            $producto->productos()->attach($request->productos[$i], ['det_pd_cantidad'=>$request->cantidad_producto[$i],'det_pd_precio'=>$request->precio_producto[$i],'det_pd_subtotal'=>$request->subtotal_producto[$i]]);
        }

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
                'correo'    => 'email|unique:proveedor,pv_correo',
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
            ]);
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

    public function add_contacto_proveedor(Request $request, $id){
        
        $contacto = new Contacto();
        $contacto->cn_nombre    = $request->contacto;
        $contacto->cn_telefono  = $request->telefono;
        $contacto->proveedor_id = $id;
        $contacto->save();
        
        return redirect()->route('proveedor');
    }


    public function put_proveedor($id){
        //dd($request);
        $prov = Proveedor::find($id);
        $prov->pv_status = !$prov->pv_status;
        $prov->save();

        return redirect()->route('proveedor');

    }

    public function put_datos_proveedor(Request $request,$id){
        //dd($request);
        $prove = Proveedor::find($id);
        if ($prove->pv_correo != $request->correo) {
            $this->validate($request, [
                    'correo'    => 'email|unique:proveedor,pv_correo'
                ],[
                    'correo.email'       => 'EL CAMPO CORREO DEBE SER DE TIPO CORREO (@live.com, @gmail.com, @hotmail.com, etc.)',
                    'correo.unique'      => 'EL CORREO YA EXISTE'
                ]);
            $prove->pv_correo  = $request->correo;
        }
        $prove->pv_domicilio  = $request->domicilio;
        $prove->pv_ciudad     = $request->ciudad;
        $prove->save();

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

        $empleado->em_nombre            = $request->nombre;
        $empleado->em_telefono          = $request->telefono;
        $empleado->em_curp              = $request->curp;
        $empleado->em_num_seg_social    = $request->seg_social;
        $empleado->em_fecha_inicio      = $request->fecha_inicio;
        $empleado->em_num_licencia      = $request->num_licencia;
        $empleado->em_vigencia_licencia = $request->vigencia_licencia;
        $empleado->em_tipo              = $request->tipo;
        $empleado->save();
    
        $documentos =  new Documentos();

        $documentos->empleado_id            = $empleado->id_empleado;
        $documentos->acta_nacimiento        = $request->check_nacimiento;
        $documentos->comprobante_domicilio  = $request->check_domicilio;
        $documentos->seguro_social          = $request->check_seguro;
        $documentos->curp                   = $request->check_curp;
        $documentos->ine                    = $request->check_ine;
        $documentos->licencia_conducir      = $request->check_licencia;
        $documentos->save();

        $usuarios =  new Usuario();

        $usuarios->empleado_id = $empleado->id_empleado;
        $usuarios->perfil      = $request->perfil;
        $usuarios->usuario     = $request->usuario;
        $usuarios->password    = bcrypt ($request->password);
        $usuarios->save();

        if ($request->tipo == 'CONTRATO') {

            $contrato =  new Contrato();

            $contrato->empleado_id          = $empleado->id_empleado;
            $contrato->cont_fecha_inicio    = $empleado->em_fecha_inicio;
            $contrato->cont_fecha_fin       = $request->fecha_final;
            $contrato->save();

        }

        if ($request->ajax()) {
            return response()->json("exito");
        }else {
            return redirect()->route('empleado');
        }
    }

    public function put_empleado($id){
        $emp = Empleado::find($id);
        $emp->em_status = !$emp->em_status;
        $emp->save();

        return redirect()->route('empleado');

    }

    public function put_datos_empleado(Request $request,$id){
        
        $this->validate($request, [
                'password'    => 'confirmed'
            ],[
                'password.confirmed'    => 'NO COINCIDEN LAS CONTRASEÑAS!'
            ]
        );

        $emp = Empleado::find($id);

            $emp->em_fecha_inicio      = $request->fecha_inicio;  
            //$emp->em_fecha_final       = $request->fecha_final;
            $emp->em_num_licencia      = $request->num_licencia;
            $emp->em_vigencia_licencia = $request->vigencia_licencia;
            $emp->em_num_seg_social    = $request->seg_social;
            $emp->em_tipo              = $request->tipo;

            if ($request->curp != null) {
                $emp->em_curp = $request->curp;            
            }

            $emp->save();

            $emp->documentos->acta_nacimiento        = $request->check_nacimiento;
            $emp->documentos->comprobante_domicilio  = $request->check_domicilio;
            $emp->documentos->seguro_social          = $request->check_seguro;
            $emp->documentos->curp                   = $request->check_curp;
            $emp->documentos->ine                    = $request->check_ine;
            $emp->documentos->licencia_conducir      = $request->check_licencia;
            $emp->documentos->save();

            if ($emp->usuario->usuario != $request->usuario) {
                $this->validate($request, [
                    'usuario' => 'unique:usuario,usuario'
                ],[
                    'usuario.unique' => 'EL NOMBRE DE USUARIO YA EXISTE'
                ]);
                $emp->usuario->usuario = $request->usuario;
            }
            $emp->usuario->perfil  = $request->perfil;
            if ($request->password != "" || $request->password != null) {
                $emp->usuario->password = bcrypt ($request->password);
            }
            $emp->usuario->save();

            if ($request->tipo != "BASE" && count($emp->contratos) < 1) {
                $contrato =  new Contrato();

                $contrato->empleado_id          = $emp->id_empleado;
                $contrato->cont_fecha_inicio    = $emp->em_fecha_inicio;
                $contrato->cont_fecha_fin       = $request->fecha_final;
                $contrato->save();
            }

        return redirect()->route('empleado');

    }

    public function contrato_empleado(Request $request,$id){

        $contrato =  new Contrato();

        $contrato->empleado_id          = $id;
        $contrato->cont_fecha_inicio    = $request->fecha_inicio;
        $contrato->cont_fecha_fin       = $request->fecha_final;
        $contrato->save();

        return redirect()->route('empleado');
    }
    
}