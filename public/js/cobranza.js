$(document).ready(function(){

	// Cliente
	$('#SelectClientePendiente').change(function(){
		var valor = $(this).val();
		if (valor != "") {
			var flag = PeticionesAjax("/GetPedidosPendientesPago", "GET", {id:valor}, AppendPedidosCliente);
			$('#BtnPagoClientePedidos').prop('disabled',!flag);
			$('#pago').prop('readonly',!flag);
		}
	});

	$('#pago').change(function(){
		CalcularPagoTecleado($(this).val(), 'CheckPagoCliente', 'TdResto', 'pago');
	});

	$('#pago').keyup(function(){
		CalcularPagoTecleado($(this).val(), 'CheckPagoCliente', 'TdResto', 'pago');
	});

	// Proveedor
	$('#SelectProveedorPendiente').change(function(){
		var valor = $(this).val();
		if (valor != "") {
			var flag = PeticionesAjax("/GetComprasPendientesPago", "GET", {id:valor}, AppendComprasProveedor);
			$('#BtnPagoProveedorCompra').prop('disabled',!flag);
			$('#pago_proveedor').prop('readonly',!flag);
		}
	});

	$('#pago_proveedor').change(function(){
		CalcularPagoTecleado($(this).val(), 'CheckPagoProveedor', 'TdRestoProveedor', 'pago_proveedor');
	});

	$('#pago_proveedor').keyup(function(){
		CalcularPagoTecleado($(this).val(), 'CheckPagoProveedor', 'TdRestoProveedor', 'pago_proveedor');
	});

	// Prestamo
	$('#SelectEmpleadoPendiente').change(function(){
		var valor = $(this).val();
		console.log(valor);
		if (valor != "") {
			var flag = PeticionesAjax("/GetPrestamosPendientes", "GET", {id:valor}, AppendPrestamo);
			$('#BtnPagoEmpleado').prop('disabled',!flag);
			$('#pago_empleado').prop('readonly',!flag);
		}
	});

	$('#pago_empleado').change(function(){
		CalcularPagoTecleado($(this).val(), 'CheckPagoPrestamo', 'TdRestoPrestamo', 'pago_empleado');
	});

	$('#pago_empleado').keyup(function(){
		CalcularPagoTecleado($(this).val(), 'CheckPagoPrestamo', 'TdRestoPrestamo', 'pago_empleado');
	});

	//INPUT DE ABONADO PROVEEDOR.
	$(document).on('keyup', '.abonado', function(){
		//VALIDA QUE NO QUEDE VACIO, PONE "0.00"
		var cantidad = $(this).val();
		if (cantidad == "") {
			$(this).val('0.00');
			$(this).parent('td').parent('tr').find('td.TDcheck').find('.CheckPagoProveedor').prop('checked', false);
		}else{
			$(this).parent('td').parent('tr').find('td.TDcheck').find('.CheckPagoProveedor').prop('checked', true);
		}

		var total = 0;
		$('.abonado').each(function(){
			var abono = $(this).val();
			total += parseFloat(abono);
		});
		$('#pago_proveedor').val(total);
	});

	//INPUT DE ABONADO CLIENTES.
	$(document).on('keyup', '.abonado', function(){
		//VALIDA QUE NO QUEDE VACIO, PONE "0.00"
		var cantidad = $(this).val();
		if (cantidad == "") {
			$(this).val('0.00');
			$(this).parent('td').parent('tr').find('td.TDcheck').find('.CheckPagoCliente').prop('checked', false);
		}else{
			$(this).parent('td').parent('tr').find('td.TDcheck').find('.CheckPagoCliente').prop('checked', true);
		}

		var total = 0;
		$('.abonado').each(function(){
			var abono = $(this).val();
			total += parseFloat(abono);
		});
		$('#pago').val(total);
	});

	//INPUT DE ABONADO PRESTAMOS.
	$(document).on('keyup', '.abonado', function(){
		//VALIDA QUE NO QUEDE VACIO, PONE "0.00"
		var cantidad = $(this).val();
		if (cantidad == "") {
			$(this).val('0.00');
			$(this).parent('td').parent('tr').find('td.TDcheck').find('.CheckPagoPrestamo').prop('checked', false);
		}else{
			$(this).parent('td').parent('tr').find('td.TDcheck').find('.CheckPagoPrestamo').prop('checked', true);
		}

		var total = 0;
		$('.abonado').each(function(){
			var abono = $(this).val();
			total += parseFloat(abono);
		});
		$('#pago_empleado').val(total);
	});


		//CLIENTES
	$(document).on('change', '.CheckPagoCliente', function(){
		var pago = 0;
		/*$('#pago').val("0");
		$('.CheckPagoCliente').each(function(index){
			if(this.checked){
				$('.TdResto').each(function(pos){
					if (pos === index) {
						pago += parseFloat($(this).val());
						return false;
					}
				});
			}
		});
		$('#pago').val(pago);*/

			if (!$(this).prop('checked')) {
			$(this).parent('td').parent('tr').find('td.TDabono').find('.abonado').val('0.00');
		}else{
			var resto = $(this).parent('td').parent('tr').find('.TdResto').val();
			$(this).parent('td').parent('tr').find('td.TDabono').find('.abonado').val(resto);
		}
		$('.abonado').each(function(){
			var abono = $(this).val();
			pago += parseFloat(abono);
		});
		$('#pago').val(pago);
	});
	

	//PROVEEDOR
	$(document).on('change', '.CheckPagoProveedor', function(){
		var pago = 0;
		//$('#pago_proveedor').val("0");
		/*$('.CheckPagoProveedor').each(function(index){
			if(this.checked){
				$('.TdRestoProveedor').each(function(pos){
					if (pos === index) {
						pago += parseFloat($(this).val());
						return false;
					}
				});
			}
		});*/
		//$('#pago_proveedor').val(pago);

		if (!$(this).prop('checked')) {
			$(this).parent('td').parent('tr').find('td.TDabono').find('.abonado').val('0.00');
		}else{
			var resto = $(this).parent('td').parent('tr').find('.TdRestoProveedor').val();
			$(this).parent('td').parent('tr').find('td.TDabono').find('.abonado').val(resto);
		}
		$('.abonado').each(function(){
			var abono = $(this).val();
			pago += parseFloat(abono);
		});
		$('#pago_proveedor').val(pago);
	});

	//PRESTAMO EMPLEADO
	$(document).on('change', '.CheckPagoPrestamo', function(){
		var pago = 0;

		if (!$(this).prop('checked')) {
			$(this).parent('td').parent('tr').find('td.TDabono').find('.abonado').val('0.00');
		}else{
			var resto = $(this).parent('td').parent('tr').find('.TdRestoPrestamo').val();
			$(this).parent('td').parent('tr').find('td.TDabono').find('.abonado').val(resto);
		}
		$('.abonado').each(function(){
			var abono = $(this).val();
			pago += parseFloat(abono);
		});
		$('#pago_empleado').val(pago);
	});


	/*Empleado
	$('#SelectEmpleadoPendiente').change(function(){
		var valor = $(this).val();
		if (valor != "") {
			var flag = PeticionesAjax("/GetPrestamosPendientes", "GET", {id:valor}, AppendPrestamo);
			$('#BtnPagoEmpleado').prop('disabled',!flag);
			$('#pago_empleado').prop('readonly',!flag);
		}
	}); */

	function AppendPedidosCliente(respuesta){
		var pedidos = '', resto = 0;
		$.each(respuesta, function(index, pedido){
			//required = (index == 0) ? "required" : "";
			pedidos += 	'<tr>'+
							'<input type="hidden" class="TdResto" name="resto[]" value="'+(parseFloat(pedido.pe_importe) - parseFloat(pedido.pe_total_abonado))+'"/>'+
							//'<td><input type="checkbox" class="CheckPagoCliente" name="pedidos[]" '+required+' value="'+pedido.pe_nota+'"/></td>'+
							'<td class="TDcheck"><input type="checkbox" class="CheckPagoCliente" name="pedidos[]" value="'+pedido.id_pedido+'"/></td>'+
							'<th class="text-center">'+pedido.pe_nota+'</th>'+
							'<td>'+pedido.pe_fecha_pedido+'</td>'+
							'<td>'+pedido.pe_termino+'</td>'+
							'<td>$'+FormatMoney(parseFloat(pedido.pe_importe) - parseFloat(pedido.pe_total_abonado))+'</td>'+
							'<td>$'+FormatMoney(pedido.pe_total_abonado)+'</td>'+
							'<td class="TDabono"><input type="number" class="form-control abonado" name="abono[]" value="0.00" step="0.01" max="'+(parseFloat(pedido.pe_importe) - parseFloat(pedido.pe_total_abonado))+'" required/></td>'+
					    '</tr>';


					    resto += (parseFloat(pedido.pe_importe) - parseFloat(pedido.pe_total_abonado));
		});
		$('#BodyPedidosCliente').empty().append(pedidos);
		$('#pago').prop('max',resto);
	}

	function AppendComprasProveedor(respuesta){
		var compras = '', resto = 0, total = 0;
		$.each(respuesta, function(index, compra){
			//required = (index == 0) ? "required" : "";
			compras += 	'<tr>'+
							'<input type="hidden" class="TdRestoProveedor" name="resto[]" value="'+(parseFloat(compra.cm_total) - parseFloat(compra.cm_total_abonado))+'"/>'+
							'<td class="TDcheck"><input type="checkbox" class="CheckPagoProveedor" name="compras[]" value="'+compra.id_compra+'"/></td>'+
							'<th class="text-center">'+compra.cm_nota+'</th>'+
							'<td>'+compra.created_at+'</td>'+
							'<td>'+compra.cm_termino+'</td>'+
							'<td>$'+FormatMoney(parseFloat(compra.cm_total) - parseFloat(compra.cm_total_abonado))+'</td>'+
							'<td>$'+FormatMoney(compra.cm_total_abonado)+'</td>'+
							'<td class="TDabono"><input type="number" class="form-control abonado" name="abono[]" value="0.00" step="0.01" max="'+(parseFloat(compra.cm_total) - parseFloat(compra.cm_total_abonado))+'" required/></td>'+
					    '</tr>';

					    resto += (parseFloat(compra.cm_total) - parseFloat(compra.cm_total_abonado));
		});
		$('#BodyComprasProveedor').empty().append(compras);
		$('#pago_proveedor').prop('max',resto);
	}

	function AppendPrestamo(respuesta){
		var prestamos = '', resto = 0, totales = 0;

		$.each(respuesta, function(index, prestamo){
			//required = (index == 0) ? "required" : "";
			prestamos += '<tr>'+
							'<input type="hidden" class="TdRestoPrestamo" name="resto[]" value="'+(parseFloat(prestamo.pres_cantidad) - parseFloat(prestamo.pres_abonado))+'"/>'+
							'<td class="TDcheck"><input type="checkbox" class="CheckPagoPrestamo" name="prestamos[]" value="'+respuesta.id_prestamo+'"/></td>'+
							'<th class="text-center">'+prestamo.id_prestamo+'</th>'+
							'<td>$'+FormatMoney(prestamo.pres_cantidad)+'</td>'+
							'<td>$'+FormatMoney(prestamo.pres_abonado)+'</td>'+
							'<td>$'+FormatMoney(parseFloat(prestamo.pres_cantidad) - parseFloat(prestamo.pres_abonado))+'</td>'+
							'<td>'+prestamo.created_at+'</td>'+
							'<td class="TDabono"><input type="number" class="form-control abonado" name="abono[]" value="0.00" step="0.01" max="'+(parseFloat(prestamo.pres_cantidad) - parseFloat(prestamo.pres_abonado))+'" required/></td>'+
							'<th>'+prestamo.pres_descripcion+'</th>'+
					    '</tr>';

					    resto += (parseFloat(prestamo.pres_cantidad) - parseFloat(prestamo.pres_abonado));
		});
		$('#BodyEmpleadoPrestamo').empty().append(prestamos);
		$('#pago_empleado').prop('max',resto);





		/*prestamo += '<tr>'+
						//'<input type="hidden" class="TdResto" name="resto" value="'+(parseFloat(respuesta.pres_cantidad) - parseFloat(respuesta.pres_abonado))+'"/>'+
						'<td class="text-center">'+respuesta.id_prestamo+'</td>'+
						'<td>$'+FormatMoney(parseFloat(respuesta.pres_cantidad) - parseFloat(respuesta.pres_abonado))+'</td>'+
						'<td>$'+FormatMoney(respuesta.pres_abonado)+'</td>'+
						'<th>'+respuesta.pres_descripcion+'</th>'+
				    '</tr>';

		resto += (parseFloat(respuesta.pres_cantidad) - parseFloat(respuesta.pres_abonado));

		$('#BodyEmpleadoPrestamo').empty().append(prestamo);
		$('#pago_empleado').prop('max',resto);*/
	}

	function PeticionesAjax(url,tipo,datos = {},funcion = ""){
        var flag = true;
        $.ajax({
            url:url,
            type:tipo,
            dataType:"json",
            async:false,
            data:datos
        }).done(function(data){
            if(funcion != ""){
                funcion(data);
            }
        }).fail(function(error){
            $('.mensaje-error-ajax').empty();
            $.each(error.responseJSON,function(index, mensaje){
                $('.mensaje-error-ajax').append("<li style='color:red;font-weight:bold;'>"+mensaje[0]+"</li>");
            });
            $('#MensajeError').modal('show');
            flag = false;
        });

        return flag;
    }

    function CalcularPagoTecleado(PagoTecleado, CampoCheck, CampoResto, CampoTotal){
    	var pago = PagoTecleado, resto = 0;
		$('.'+CampoCheck).prop('checked',false);
		if (PagoTecleado == "" || PagoTecleado == 0) {
			$('#'+CampoTotal).val('0.00');
			$('.abonado').val('0.00');
		}
		$('.'+CampoResto).each(function(index){
			resto += parseFloat($(this).val());
			if ((resto <= pago) || pago > 0) {
				if (resto <= pago) {

					$(this).parent('tr').find('td.TDabono').find('.abonado').val(resto);
					
				}else if(pago > 0){
					$(this).parent('tr').find('td.TDabono').find('.abonado').val(pago);
				}

				$('.'+CampoCheck).each(function(pos){
					if (index == pos) {
						$(this).prop('checked',true);
						return false;
					}
				});	
			}
			pago -= resto;
		});
    }

    function FormatMoney(money){
        var v_money = money.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g,"$1,");
        return v_money;
    }
});