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
		CalcularPagoTecleado($(this).val(), 'CheckPagoCliente', 'TdResto');
	});

	$('#pago').keyup(function(){
		CalcularPagoTecleado($(this).val(), 'CheckPagoCliente', 'TdResto');
	});

	$(document).on('change', '.CheckPagoCliente', function(){
		var pago = 0;
		$('#pago').val("0");
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
		$('#pago').val(pago);
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
		CalcularPagoTecleado($(this).val(), 'CheckPagoProveedor', 'TdRestoProveedor');
	});

	$('#pago_proveedor').keyup(function(){
		CalcularPagoTecleado($(this).val(), 'CheckPagoProveedor', 'TdRestoProveedor');
	});

	$(document).on('change', '.CheckPagoProveedor', function(){
		var pago = 0;
		$('#pago_proveedor').val("0");
		$('.CheckPagoProveedor').each(function(index){
			if(this.checked){
				$('.TdRestoProveedor').each(function(pos){
					if (pos === index) {
						pago += parseFloat($(this).val());
						return false;
					}
				});
			}
		});
		$('#pago_proveedor').val(pago);
	});

	function AppendPedidosCliente(respuesta){
		var pedidos = '', resto = 0;
		$.each(respuesta, function(index, pedido){
			//required = (index == 0) ? "required" : "";
			pedidos += 	'<tr>'+
							'<input type="hidden" class="TdResto" name="resto[]" value="'+(parseFloat(pedido.pe_importe) - parseFloat(pedido.pe_total_abonado))+'"/>'+
							//'<td><input type="checkbox" class="CheckPagoCliente" name="pedidos[]" '+required+' value="'+pedido.pe_nota+'"/></td>'+
							'<td><input type="checkbox" class="CheckPagoCliente" name="pedidos[]" value="'+pedido.id_pedido+'"/></td>'+
							'<th class="text-center">'+pedido.pe_nota+'</th>'+
							'<td>'+pedido.pe_fecha_pedido+'</td>'+
							'<td>'+pedido.pe_termino+'</td>'+
							'<td>$'+FormatMoney(parseFloat(pedido.pe_importe) - parseFloat(pedido.pe_total_abonado))+'</td>'+
							'<td>$'+FormatMoney(pedido.pe_total_abonado)+'</td>'+
					    '</tr>';
					    resto += (parseFloat(pedido.pe_importe) - parseFloat(pedido.pe_total_abonado));
		});
		$('#BodyPedidosCliente').empty().append(pedidos);
		$('#pago').prop('max',resto);
	}

	function AppendComprasProveedor(respuesta){
		var compras = '', resto = 0;
		$.each(respuesta, function(index, compra){
			//required = (index == 0) ? "required" : "";
			compras += 	'<tr>'+
							'<input type="hidden" class="TdRestoProveedor" name="resto[]" value="'+(parseFloat(compra.cm_total) - parseFloat(compra.cm_total_abonado))+'"/>'+
							'<td><input type="checkbox" class="CheckPagoProveedor" name="compras[]" value="'+compra.id_compra+'"/></td>'+
							'<th class="text-center">'+compra.cm_nota+'</th>'+
							'<td>'+compra.created_at+'</td>'+
							'<td>'+compra.cm_termino+'</td>'+
							'<td>$'+FormatMoney(parseFloat(compra.cm_total) - parseFloat(compra.cm_total_abonado))+'</td>'+
							'<td>$'+FormatMoney(compra.cm_total_abonado)+'</td>'+
					    '</tr>';
					    resto += (parseFloat(compra.cm_total) - parseFloat(compra.cm_total_abonado));
		});
		$('#BodyComprasProveedor').empty().append(compras);
		$('#pago_proveedor').prop('max',resto);
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

    function CalcularPagoTecleado(PagoTecleado, CampoCheck, CampoResto){
    	var pago = PagoTecleado, resto = 0;
		$('.'+CampoCheck).prop('checked',false);
		$('.'+CampoResto).each(function(index){
			resto += parseFloat($(this).val());
			if ((resto <= pago) || pago > 0) {
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