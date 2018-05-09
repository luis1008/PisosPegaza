<?php

Route::get('/', function () {
    return view('welcome');
})->name('login');

Route::post('/Login',[
	'uses' => 'LoginController@autentificar',
	'as'   => 'autentificacion'
]);

Route::get('/Logout',[
	'uses' => 'LoginController@logout',
	'as'   => 'logout'
]);

Route::group(['middleware' => 'auth'],function(){
	/**************
	*	CATALOGOS *
	***************/

	// CLIENTE
	Route::get('/Cliente',[
		'uses'  => 'CatalogoController@cliente',
		'as'	=> 'cliente'
	]);

	Route::post('/Cliente',[
		'uses'  => 'CatalogoController@post_cliente',
		'as'	=> 'post_cliente'
	]);

	Route::post('/AgregarDomicilioCliente/{id}',[
		'uses'  => 'CatalogoController@add_domicilio_cliente',
		'as'	=> 'add_domicilio_cliente'
	]);

	Route::put('/Cliente/{id}',[
		'uses'  => 'CatalogoController@put_datos_cliente',
		'as'	=> 'put_datos_cliente'
	]);

	Route::get('/Cliente/{id}',[
		'uses'  => 'CatalogoController@put_cliente',
		'as'	=> 'put_cliente'
	]);

	// CUENTAS
	Route::get('/Cuenta',[
		'uses'  => 'CatalogoController@cuentas',
		'as'	=> 'cuentas'
	]);

	Route::post('/Cuenta',[
		'uses'  => 'CatalogoController@post_cuenta',
		'as'	=> 'post_cuenta'
	]);

	Route::get('/Cuenta/{id}',[
		'uses'  => 'CatalogoController@put_cuenta',
		'as'	=> 'put_cuenta'
	]);

	Route::put('/Cuenta/{id}',[
		'uses'  => 'CatalogoController@put_datos_cuenta',
		'as'	=> 'put_datos_cuenta'
	]);


		// GASTOS
	Route::get('/Gastos',[
		'uses'  => 'CatalogoController@gastos',
		'as'	=> 'gastos'
	]);

	Route::post('/Gastos',[
		'uses'  => 'CatalogoController@post_gasto',
		'as'	=> 'post_gasto'
	]);
	

	Route::get('/Gastos/{id}',[
		'uses'  => 'CatalogoController@put_gasto',
		'as'	=> 'put_gasto'
	]);

	Route::put('/Gastos/{id}',[
		'uses'  => 'CatalogoController@put_datos_gasto',
		'as'	=> 'put_datos_gasto'
	]);

	// MATERIA PRIMA
	Route::get('/MateriaPrima',[
		'uses'  => 'CatalogoController@mat_prima',
		'as'	=> 'mat_prima'
	]);

	Route::post('/MateriaPrima',[
		'uses'  => 'CatalogoController@post_mat_prima',
		'as'	=> 'post_mat_prima'
	]);

	Route::get('/MateriaPrima/{id}',[
		'uses'  => 'CatalogoController@put_mat_prima',
		'as'	=> 'put_mat_prima'
	]);

	Route::put('/MateriaPrima/{id}',[
		'uses'  => 'CatalogoController@put_datos_mat_prima',
		'as'	=> 'put_datos_mat_prima'
	]);


	// VEHICULO
	Route::get('/Vehiculo',[
		'uses'  => 'CatalogoController@vehiculo', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'vehiculo' //Nombre de la ruta
	]);

	Route::post('/Vehiculo',[
		'uses'  => 'CatalogoController@post_vehiculo', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'post_vehiculo' //Nombre de la ruta
	]);

	Route::post('/FallasVehiculo/{id}',[
		'uses'  => 'CatalogoController@add_fallas_vehiculo', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'add_fallas_vehiculo' //Nombre de la ruta
	]);

	Route::put('/Vehiculo/{id}',[
		'uses'  => 'CatalogoController@put_datos_vehiculo',
		'as'	=> 'put_datos_vehiculo'
	]);

	Route::get('/Vehiculo/{id}',[
		'uses'  => 'CatalogoController@put_vehiculo', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'put_vehiculo' //Nombre de la ruta
	]);

	Route::get('/Fallas/{placas}',[
		'uses'  => 'CatalogoController@view_fallas', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'view_fallas' //Nombre de la ruta
	]);

	// PRODUCTO
	Route::get('/Producto',[
		'uses'  => 'CatalogoController@producto', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'producto' //Nombre de la ruta
	]);

	Route::post('Producto',[
		'uses'  => 'CatalogoController@post_producto', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'post_producto' //Nombre de la ruta
	]);

	Route::put('/Producto/{id}',[
		'uses'  => 'CatalogoController@put_datos_producto',
		'as'	=> 'put_datos_producto'
	]);

	Route::get('/Producto/{id}',[
		'uses'  => 'CatalogoController@put_producto', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'put_producto' //Nombre de la ruta
	]);

	Route::post('/RequisitosProducto/{id}',[
		'uses'  => 'CatalogoController@post_requisitos', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'post_requisitos' //Nombre de la ruta
	]);

	Route::post('/AgregarMaterial/{id}',[
		'uses'  => 'CatalogoController@post_agregar_material', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'post_agregar_material' //Nombre de la ruta
	]);

	// PROVEEDOR
	Route::get('/Proveedor',[
		'uses'  => 'CatalogoController@proveedor',
		'as'	=> 'proveedor'
	]);

	Route::post('/Proveedor',[
		'uses'  => 'CatalogoController@post_proveedor',
		'as'	=> 'post_proveedor'
	]);

	Route::post('/AgregarContactoProveedor/{id}',[
		'uses'  => 'CatalogoController@add_contacto_proveedor',
		'as'	=> 'add_contacto_proveedor'
	]);

	Route::put('/Proveedor/{id}',[
		'uses'  => 'CatalogoController@put_datos_proveedor',
		'as'	=> 'put_datos_proveedor'
	]);

	Route::get('/Proveedor/{id}',[
		'uses'  => 'CatalogoController@put_proveedor',
		'as'	=> 'put_proveedor'
	]);

	// EMPLEADO
	Route::get('/Empleado',[
		'uses'  => 'CatalogoController@empleado',
		'as'	=> 'empleado'
	]);

	Route::post('/Empleado',[
		'uses'  => 'CatalogoController@post_empleado', 
		'as'	=> 'post_empleado'
	]);

	Route::put('/Empleado/{id}',[
		'uses'  => 'CatalogoController@put_datos_empleado',
		'as'	=> 'put_datos_empleado'
	]);

	Route::get('/Empleado/{id}',[
		'uses'  => 'CatalogoController@put_empleado',
		'as'	=> 'put_empleado'
	]);

	Route::post('/ContratoEmpleado/{id}',[
		'uses'  => 'CatalogoController@contrato_empleado', 
		'as'	=> 'contrato_empleado'
	]);



	// --------------------

	Route::get('/ReporteViaje',[
		'uses'  => 'CobranzaController@reporte_viaje',
		'as'	=> 'reporte_viaje'
	]);
		
	/************
	*	CAJAS	*
	*************/
	Route::get('/Caja',[
		'uses'  => 'CajaController@caja',
		'as'	=> 'caja'
	]);

	// MOVIMIENTO TEMPORAL
	Route::post('/MovimientoTemporal',[
		'uses' => 'CajaController@post_movimiento',
		'as'   => 'post_movimiento'
	]);

	Route::put('/MovimientoTemporalPendiente',[
		'uses' => 'CajaController@put_MTPendiente',
		'as'   => 'put_MTPendiente'
	]);

	Route::post('/ConceptoOtro',[
		'uses' => 'CajaController@post_AddOtroConcepto',
		'as'   => 'post_AddOtroConcepto'
	]);

	// PRESTAMO
	Route::post('/Prestamo/{id}',[
		'uses' => 'CajaController@post_prestamo',
		'as'   => 'post_prestamo'
	]);

	Route::put('/Prestamo',[
		'uses' => 'CajaController@put_PPendiente',
		'as'   => 'put_PPendiente'
	]);

	// PEDIDO
	Route::post('/Pedido',[
		'uses' => 'CajaController@post_pedido',
		'as'   => 'post_pedido'
	]);

	Route::put('/Pedido',[
		'uses' => 'CajaController@put_pedido',
		'as'   => 'put_pedido'
	]);

	Route::get('/Pedido/{id}',[
		'uses' => 'CajaController@get_view_update_pedido',
		'as'   => 'get_view_update_pedido'
	]);

	Route::put('/AbonaPedido/{id}',[
		'uses' => 'CajaController@put_abona_pedido',
		'as'   => 'put_abona_pedido'
	]);

	Route::put('/Pedido/{id}',[
		'uses' => 'CajaController@put_datos_pedido',
		'as'   => 'put_datos_pedido'
	]);

	// COMPRAS
	Route::post('/Compras',[
		'uses' => 'CajaController@post_compra',
		'as'   => 'post_compra'
	]);

	Route::put('/CompraBodega/{id}',[
		'uses' => 'CajaController@put_CompraBodega',
		'as'   => 'put_CompraBodega'
	]);

	Route::put('/AbonarPagarCompra/{id}',[
		'uses' => 'CajaController@put_AbonarPagarCompra',
		'as'   => 'put_AbonarPagarCompra'
	]);

	// VIAJES
	Route::post('/Viaje',[
		'uses' => 'CajaController@post_viaje',
		'as'   => 'post_viaje'
	]);

	Route::post('/FinalizarViaje/{id}',[
		'uses' => 'CajaController@post_finalizar_viaje',
		'as'   => 'post_finalizar_viaje'
	]);

	Route::get('/Viaje/{id}',[
		'uses' => 'ViajeController@get_viaje',
		'as'   => 'get_viaje'
	]);

	Route::get('/ViajeCaja/{id}',[
		'uses' => 'ViajeController@get_viaje_caja',
		'as'   => 'get_viaje_caja'
	]);

	//GASTOS
	Route::post('/Gastos/{id}',[
		'uses' => 'CajaController@post_gastos',
		'as'   => 'post_gastos'
		]);

	// PRODUCCION
	Route::post('/PedidoProduccion',[
		'uses' => 'CajaController@post_pedido_produccion',
		'as'   => 'post_pedido_produccion'
	]);

	Route::post('/AgregarProduccion',[
		'uses' => 'CajaController@agregar_produccion',
		'as'   => 'agregar_produccion'
	]);

	Route::get('/PedidoProduccion/{id}',[
		'uses' => 'CajaController@cancelacion_produccion',
		'as'   => 'cancelacion_produccion'
	]);

	Route::put('/PedidoProduccion/{id}',[
		'uses' => 'CajaController@finalizar_produccion',
		'as'   => 'finalizar_produccion'
	]);

	// AJUSTE DE INVENTARIO
	Route::post('/AjusteInventario',[
		'uses' => 'CajaController@ajuste_inventario',
		'as'   => 'ajuste_inventario'
	]);

	//COBRANZA
	Route::post('/PagoPedidoCliente',[
		'uses' => 'CajaController@post_pago_pedido',
		'as'   => 'post_pago_pedido'
	]);

	Route::post('/PagoCompraProveedor',[
		'uses' => 'CajaController@post_pago_compra',
		'as'   => 'post_pago_compra'
	]);

	Route::post('/PagoPrestamoEmpleado',[
		'uses' => 'CajaController@post_pago_prestamo',
		'as'   => 'post_pago_prestamo'
	]);
	
	//REPORTES
	Route::get('/ReportesCobranza',[
		'uses'  => 'ReporteController@get_pedidos', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'get_pedidos' //Nombre de la ruta
	]);

	Route::get('/ReportesCompras',[
		'uses'  => 'ReporteController@get_compras', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'get_compras' //Nombre de la ruta
	]);

	Route::get('/ReportesCaja',[
		'uses'  => 'ReporteController@get_caja', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'get_caja' //Nombre de la ruta
	]);

	Route::get('/ReportesCuentas',[
		'uses'  => 'ReporteController@get_cuentas', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'get_cuentas' //Nombre de la ruta
	]);


	Route::get('/ReportesEgresos',[
		'uses'  => 'ReporteController@get_egresos', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'get_egresos' //Nombre de la ruta
	]);

	Route::get('/ReportesProduccion',[
		'uses'  => 'ReporteController@get_produccion', //A que controlador y despues del @ es a que funcion dentro del controlador
		'as'	=> 'get_produccion' //Nombre de la ruta
	]);

	//PDF
	Route::get('/NotaPedido/{id}/{preorden?}/{copia?}', 'PdfController@pdf_pedido')->name('pdf_pedido');
	Route::get('/TicketViaje/{id}/{copia?}', 'PdfController@ticket_viaje')->name('ticket_viaje');
	Route::get('/TicketMovimiento/{id}/{copia?}', 'PdfController@ticket_movimiento')->name('ticket_movimiento');
	Route::get('/NotaProduccion/{id}', 'PdfController@pdf_produccion')->name('pdf_produccion');
	
	//AJAX
	Route::get('/GetMateriaPrima', 'AjaxController@GetMateriaPrima');
	Route::get('/GetProductoNoEnsamblado', 'AjaxController@GetProductoNoEnsamblado');
	Route::get('/GetPrecioProductoSelected', 'AjaxController@GetPrecioProductoSelected');
	Route::get('/GetPrecioMateriaPrimaSelected', 'AjaxController@GetPrecioMateriaPrimaSelected');
	Route::get('/GetProveedor', 'AjaxController@GetProveedor');
	Route::get('/GetEmpleado', 'AjaxController@GetEmpleado');
	Route::post('/SetEmpleado', 'AjaxController@SetEmpleado');
	Route::get('/GetCliente', 'AjaxController@GetCliente');
	Route::get('/GetClienteSelected', 'AjaxController@GetClienteSelected');
	Route::get('/GetPrecioUltimaCompra', 'AjaxController@GetPrecioUltimaCompra');
	Route::get('/GetCuentas', 'AjaxController@GetCuentas');
	//Route::post('/SetCuentas', 'AjaxController@SetCuentas');
	Route::post('/SetDomicilios', 'AjaxController@SetDomicilios');
	Route::get('/GetProducto', 'AjaxController@GetProducto');
	Route::get('/GetProductoInventario', 'AjaxController@GetProductoInventario');
	Route::get('/GetPrecioUltimaVenta', 'AjaxController@GetPrecioUltimaVenta');
	Route::get('/GetDomicilioCliente', 'AjaxController@GetDomicilioCliente');
	Route::get('/GetKilometrajeFinal', 'AjaxController@GetKilometrajeFinal');
	Route::get('/GetImporteCompra', 'AjaxController@GetImporteCompra');
	Route::get('/GetPedidosPendientesPago', 'AjaxController@GetPedidosPendientesPago');
	Route::get('/GetComprasPendientesPago', 'AjaxController@GetComprasPendientesPago');
	Route::get('/GetPrestamosPendientes', 'AjaxController@GetPrestamosPendientes');
	Route::get('/SetEliminacionDomicilioCliente', 'AjaxController@SetEliminacionDomicilioCliente');
	Route::get('/SetEliminacionContactoProveedor', 'AjaxController@SetEliminacionContactoProveedor');
});// EDN group -> AUTH